<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parser extends CI_Controller
{
    private $model;

    public function index()
    {
        //$this->load->view('welcome_message');
    }

    public function __construct()
    {

        parent::__construct();
        $this->load->helper('login_helper');
        isAdminLogin();
        $this->load->model('Model_admin', 'ma');
        $this->load->helper('admin_helper');
        beforeOutput();
        $this->model = getModel('parser');
    }

    public function parse($id)
    {
        //$this->load->spark('ci-simplepie/1.0.1/');

        $parse = $this->model->getParserById($id);
        $typeModel = getModel($parse['type']);
        if ($parse) {
            $params = false;
            if ($parse['params'] != NULL)
                $params = json_decode($parse['params'], true);

            loadHelper('xml');
            $path = $parse['rss_url'];
            $ctx = stream_context_create(array('http' => array('timeout' => 6)));
            $xmlFile = file_get_contents($path, 0, $ctx);
            if ($xmlFile) {
                // Распарсить полученный XML
                $parseNext = true;
                $rss = simplexml_load_string($xmlFile);
                foreach ($rss->channel->item as $item) {
                    if ($parseNext) {
                        $content = '';

                        $allowedTags = '<img><p>';
                        if (isset($params['allowed_tags']))
                            $allowedTags = $params['allowed_tags'];

                        /** @var ищем весь контент в теге yandex:full-text, если он существует $namespaces */
                        $namespaces = $item->getNameSpaces(true);
                        //vd($namespaces);
                        if (isset($namespaces['yandex'])) {
                            $yandex = $item->children($namespaces['yandex']);
                            if ($yandex) {
                                // добавить проверку на namespace yandex
                                $content = (string)$yandex->{'full-text'};
                            }
                        }

                        if ($content == '') {
                            // Ищем контент в других местах
                            //
                            //
                            //
                            //
                        }

                        //

                        $content = strip_tags($content, $allowedTags);

                        /** Подставляем полный путь к картинкам, если он относительный */
                        if (isset($params['domain'])) {
                            $my_base = '//' . $params['domain'] . '/';
                            $content = preg_replace('|src="(?!https?://)/?([^"]+)"|', 'src="' . "$my_base\$1" . '"', $content);
                        }

                        $dbins = array();
                        $dbins['content'] = $content;

                        //vd($item);

                        $image = false;
                        /** перебираем все элементы внутри <item> и наполняем массив $dbins */
                        foreach ($item as $key => $value) {
                            $attr = $value->attributes();

                            $attrUrl = $attrType = false;
                            if (!empty($attr) && $key == 'enclosure') {   // Если тэг <enclosure>, достаём из параметров тип и путь к картинке
                                $attrUrl = (string)$attr['url'];
                                $attrType = (string)$attr['type'];
                                if (!empty($attrUrl)) {
                                    switch ($attrType) {
                                        case 'image/png':
                                        case 'image/jpeg':
                                        case 'image/jpg':
                                            $image = $attrUrl;
                                            break;
                                        default:
                                            echo 'Не подходящий тип файла: ' . $attrType;
                                    }
                                }
                            } elseif (!empty($attr)) {
                                echo "Найдены атрибуты у тэга: " . $key . " и я пока хз, нужны ли они нам...";
                            } else {                                    // Если у тэга нет атрибутов
                                $dbins[$key] = (string)$value;
                            }


                            /** Если есть картинка, обрабатываем ...  */
                            if ($image) {
                                $parser_download_images = getOption('parser_download_images');
                                if ($parser_download_images == 1) {           // Скачиваем и обрабатываем картинку статьи
                                    /** Не реализовано, т.к. пока не надо */
                                } else {
                                    $dbins['image'] = str_replace('http://', '//', $image);
                                }
                            }
                            //if(is_object($value)) vd($key . ' - is Object!');
                            //vd(get_class ($value));

                        }

                        if (!isset($dbins['name']))
                            $dbins['name'] = $dbins['title'];

                        if (!isset($dbins['short_content']))
                            $dbins['short_content'] = $dbins['content'];
                        if (!isset($dbins['description']))
                            $dbins['description'] = $dbins['content'];

                        $dbins['description'] = cropText($dbins['description'], 160, true, '.', true);

                        if (isset($params['short_content_max_chars']) && $params['short_content_max_chars'] != 0)
                            $dbins['short_content'] = cropText($dbins['content'], $params['short_content_max_chars'], true, '.', $allowedTags);


                        /** Определяем, в какой раздел будет добавлена статья */
                        $categoryName = $dbins['category'];

                        /** Проверяем, не была ли данная статья спарсена нами ранее... */
                        if(isset($dbins['link'])){
                            $parsed = $typeModel->getByParseUrl($dbins['link']);
                            if($parsed !== false){
                                echo 'Эта статья быда спарсена ранее! Полностью останавливаем текущий парсер...';
                                $parseNext = false;
                                break;
                            }
                        }

                        if (post('category_id') != 0) {       // Если указан определённый раздел
                            vdd("1");
                            $dbins['category_id'] = '*' . post('category_id') . '*';
                            $dbins['parent_category_id'] = post('category_id');
                        } else {
                            // Ищем раздел с таким же названием
                            vd('Search category by name: '.$categoryName);
                            $cat = $this->model_categories->getCategory($categoryName);
                           // vdd($cat);
                            if ($cat) {
                                $dbins['category_id'] = '*' . $cat['id'] . '*';
                                $dbins['first_category_id'] = $cat['id'];
                            } elseif ($parse['create_new_category'] == 1 || $parse['create_new_category'] == 'on') {  // Если раздел не найден и разрешено создание, то создаём
                                $newUrl = createUrl($categoryName);
                                $catDbins = array(
                                    'name' => $categoryName,
                                    'url' => $newUrl,
                                    'active' => 1,
                                    'template' => getOption('parser_category_default_template'),
                                    'content_template' => getOption('parser_category_content_default_template'),
                                    'type' => $parse['type'],
                                    'created_date' => date('Y-d-m H:i:s'),
                                    'created_by' => 'parser',
                                    'num' => $this->model_categories->getNewNum()
                                );

                                $result = $this->db->insert('categories', $catDbins);
                                if ($result) {
                                    $cat = $this->model_categories->getCategoryByUrl($newUrl);
                                    if (isset($cat['id'])) {
                                        $dbins['category_id'] = '*' . $cat['id'] . '*';
                                        $dbins['parent_category_id'] = $cat['id'];
                                    }
                                }
                            }
                        }

                        $dbins['url'] = createUrl($dbins['name']);
                        $dbins['created_date'] = $dbins['date'] = date("Y-m-d H:i");
                        $dbins['unix'] = $dbins['date_unix'] = time();
                        $dbins['source'] = $dbins['link'];
                        $dbins['status'] = 'parsing';
                        $dbins['created_by'] = 'parse';
                        $dbins['created_ip'] = getRealIp();
                        $dbins['parser_id'] = $parse['id'];
                        $dbins['num'] = $typeModel->getNewNum();
                        $dbins['parse_url'] = $dbins['link'];


                        // Убиваем лишние поля
                        if (isset($dbins['category'])) unset($dbins['category']);
                        if (isset($dbins['link'])) unset($dbins['link']);
                        if (isset($dbins['title'])) unset($dbins['title']);
                        if (isset($dbins['pubDate'])) unset($dbins['pubDate']);

                        $this->db->insert($parse['type'], $dbins);
                    }
                }
            }
        } else echo 'no parse';
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */