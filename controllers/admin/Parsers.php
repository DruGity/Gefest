<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parsers extends CI_Controller
{
    private $model;
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

    public function index(){
//        $this->load->library('rssparser', array($this, 'parseFile')); // parseFile method of current class
//        $this->rssparser->set_feed_url('http://odessamedia.net/ukrnetrss/'); 	// get feed
//        $this->rssparser->set_cache_life(30); 						// Set cache life time in minutes
//        $rss = $this->rssparser->getFeed(20); 						// Get six items from the feed
//        if($rss){
//            foreach ($rss as $item){
//                var_dump($item['yandex']);
//            }
//        }

//        loadHelper('xml');
//        $xml = file_get_contents('https://368.media/feed/');
//        $xml = simplexml_load_string($xml);
//        $s = $xml->channel->item;
//        vd($s);
//        $arr = xml2array($xml);
//        var_dump($arr);

        $type = false;
        if(isset($_GET['type']))
            $type = $_GET['type'];


        $data['title'] = "Парсеры";


        $data['parsers'] = $this->model->getParsers();

        $data['head'] = $this->load->view('common/head.php',$data, true);
        $data['header'] = $this->load->view('common/header.php',$data, true);
        $data['left_sidebar'] = $this->load->view('common/left_sidebar.php',$data, true);
        $data['footer'] = $this->load->view('common/footer.php',$data, true);

        $this->load->view('parsers/parsers', $data);
    }

    public function add()
    {
        $err = '';
        if (post('action') == 'add') {
            $dbins = array();
            $dbins['active'] = 0;
            if (isset($_POST['active']) && $_POST['active'] == true)
                $dbins['active'] = 1;

            $category_id = 0;
            if(post('category_id')) $category_id = post('category_id');
            if($category_id > 0){
                $cat = $this->model_categories->getCategoryById($category_id);
                if(isset($cat['type']))
                    $_POST['type'] = $cat['type'];
            }

            $dbins['create_new_category'] = 0;
            if (isset($_POST['create_new_category']) && $_POST['create_new_category'] == true)
                $dbins['create_new_category'] = 1;

            $type = post('type');
            if(!$type) $type = 'articles';


            $dbins['name']  = $_POST['name'];
            $dbins['rss_url']  = $_POST['rss_url'];
            $dbins['rss_type']  = $_POST['rss_type'];
            $dbins['content_template']  = $_POST['content_template'];
            $dbins['category_id']       = post('category_id');
            $dbins['type']              = $type;
            $dbins['not_finded_categoty_to_category_id'] = post('not_finded_categoty_to_category_id');

            $params = NULL;
            if (isset($_POST['params']) && is_array($_POST['params']) && count($_POST['params']) > 0) {
                $params = array();
                foreach ($_POST['params'] as $key => $value)
                    $params[$key] = $value;
            }
            if ($params != NULL)
                $params = json_encode($params);

            $dbins['params'] = $params;
            //          vdd($dbins);

            $result = $this->db->insert('module_parsers', $dbins);

            if($result){
                $parser = $this->model->getLatestParser();
                if($parser && isset($_POST['add']))
                    redirect('/admin/parsers/edit/'.$parser['id'].'/');
            }
            if(isset($_POST['add_and_close']))
                redirect("/admin/parsers/");

        }
        $data['title'] = "Добавление парсера";
        $data['err'] = $err;
        $data['type'] = 'parsers';
        $data['categories'] = $this->model_categories->getCategories();
        $data['action'] = 'add';

        $data['head'] = $this->load->view('common/head.php',$data, true);
        $data['header'] = $this->load->view('common/header.php',$data, true);
        $data['left_sidebar'] = $this->load->view('common/left_sidebar.php',$data, true);
        $data['footer'] = $this->load->view('common/footer.php',$data, true);

        $this->load->view('parsers/parsers_add_edit', $data);
    }

    public function edit($id)
    {
        $err = '';

        $parser = $this->model->getParserById($id);
        if (post('action') == 'edit') {
            $dbins['active'] = 0;
            if (isset($_POST['active']) && $_POST['active'] == true)
                $dbins['active'] = 1;

            $category_id = 0;
            if (post('category_id')) $category_id = post('category_id');
            if ($category_id > 0) {
                $cat = $this->model_categories->getCategoryById($category_id);
                if (isset($cat['type']))
                    $_POST['type'] = $cat['type'];
            }

            $dbins['create_new_category'] = 0;
            if (isset($_POST['create_new_category']) && $_POST['create_new_category'] == true)
                $dbins['create_new_category'] = 1;

            $type = post('type');
            if (!$type) $type = 'articles';

            $dbins['name'] = $_POST['name'];
            $dbins['rss_url'] = $_POST['rss_url'];
            $dbins['rss_type'] = $_POST['rss_type'];
            $dbins['content_template'] = $_POST['content_template'];
            $dbins['category_id'] = post('category_id');
            $dbins['type'] = $type;
            $dbins['not_finded_categoty_to_category_id'] = post('not_finded_categoty_to_category_id');

            $params = NULL;
            if (isset($_POST['params']) && is_array($_POST['params']) && count($_POST['params']) > 0) {
                $params = json_encode($_POST['params']);
            }

            $dbins['params'] = $params;

            //          vdd($dbins);

            $this->db->where('id', $id)->limit(1)->update('module_parsers', $dbins);

            if (isset($_POST['edit_and_close']))
                redirect("/admin/parsers/");
            else
                redirect("/admin/parsers/edit/" . $id . "/");

        }

        if($parser['params'] != NULL){
            $parser['params'] = json_decode($parser['params'], true);
        }

        $data['params'] = $this->model->getParserParams();
        $data['title'] = "Редактирование парсера";
        $data['err'] = $err;
        $data['type'] = 'parsers';
        $data['categories'] = $this->model_categories->getCategories();
        $data['action'] = 'edit';
        $data['item'] = $parser;

        $data['head'] = $this->load->view('common/head.php', $data, true);
        $data['header'] = $this->load->view('common/header.php', $data, true);
        $data['left_sidebar'] = $this->load->view('common/left_sidebar.php', $data, true);
        $data['footer'] = $this->load->view('common/footer.php', $data, true);

        $this->load->view('parsers/parsers_add_edit', $data);
    }

    function parseFile($data, $item)
    {
        $data['yandex'] = (string)$item->yandex;
        $data['image'] = (string)$item->image;
        $data['category'] = (string)$item->category;
        return $data;
    }
}