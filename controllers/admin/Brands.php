<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends CI_Controller {

         public function __construct()
        {
            parent::__construct();
	    $this->load->helper('login_helper');
	    isAdminLogin();
            $this->load->model('Model_admin','ma');
            $this->load->model('Model_brands','brands');
        }
	
	function upload_foto(){								// Функция загрузки и обработки фото
		  $config['upload_path'] 	= 'upload/fotos';
		  $config['allowed_types'] 	= 'jpg|png|gif|jpe';
		  $config['max_size']		= '0';
		  $config['max_width']  	= '0';
		  $config['max_height']  	= '0';
		  $config['encrypt_name']	= true;
		  $config['overwrite']  	= false;
  
		  $this->load->library('upload', $config);
		    
		  if ( ! $this->upload->do_upload())
		  {
			  echo $this->upload->display_errors();
			  die();
		  }
		  else
		  {
		    $ret = $this->upload->data();
			  return $ret;
		  }
	 }
	 
	 function upload_file($page_id){								// Функция загрузки и обработки фото
		  
		  if(!file_exists('upload/files/'.$page_id))
			   mkdir('upload/files/'.$page_id,0777);
		  $config['upload_path'] 	= 'upload/files/'.$page_id;
		  $config['allowed_types'] 	= 'jpg|png|gif|jpe|zip|rar|doc|docx|xls|xlsx';
		  $config['max_size']		= '0';
		  $config['max_width']  	= '0';
		  $config['max_height']  	= '0';
		  $config['encrypt_name']	= false;
		  $config['overwrite']  	= false;
  
		  $this->load->library('upload', $config);
		    
		  if ( ! $this->upload->do_upload())
		  {
			  echo $this->upload->display_errors();
			  die();
		  }
		  else
		  {
		    $ret = $this->upload->data();
			  return $ret;
		  }
	 }
           
	public function index()
	{
            $data['title']  = "Бренды";
            $data['brands'] = $this->brands->getBrands();
            $this->load->view('admin/brands',$data);
	}
        
        public function add()
        {
            $err = '';
            if(isset($_POST['name']) && $_POST['name'] != '')
            {
                if(!$this->brands->getBrand($_POST['name']))
                {
                    
                        $this->load->helper('translit_helper');
                        $url = translitRuToEn($_POST['name']);                        

                    $active = 0;
                    if(isset($_POST['active']) && $_POST['active'] == true) $active = 1;
		    
		    $social_buttons = 0;
                    if(isset($_POST['social_buttons']) && $_POST['social_buttons'] == true) $social_buttons = 1;
		    
		    $image = '';
		    if(isset($_POST['image'])) $image = $_POST['image'];
		    if (isset($_FILES['userfile'])) {					// проверка, выбран ли файл картинки 
			   if ($_FILES['userfile']['name'] != '') {
				  $imagearr = $this->upload_foto();
				  $image = '/upload/fotos/'.$imagearr['file_name'];
			   }
		    }
		    $template = '';
		    if(isset($_POST['template'])) $template = $_POST['template'];
		    
		    $_POST['title'] = $_POST['name'];
		    $_POST['keywords'] = $_POST['name'];
		    $_POST['description'] = $_POST['name'];
		    
                    $dbins = array(
                                   'name'           => $_POST['name'],
                                   'url'            => $url,
                                   'num'            => $_POST['num'],
				   'content'        => $_POST['content'],                                   
                                   'active'         => $active,
                                   'title'          => $_POST['title'],
                                   'keywords'       => $_POST['keywords'],
                                   'description'    => $_POST['description'],
                                   'seo'            => $_POST['seo'],
				   'template'		=> $template,
				   'image'	    => $image,
				   'social_buttons' => $social_buttons
                                   );
                    $this->db->insert('brands',$dbins);
                    redirect("/admin/brands/");
                }
                else $err = 'Такой бренд уже существует!';
            }
            $data['title']  = "Добавление бренда";
            $data['err'] = $err;
            $data['num'] = $this->brands->getNewNum();
            $data['brands'] = $this->brands->getBrands();
            $this->load->view('admin/brands_add',$data);
        }
        
        public function edit($id)
        {
		  if(isset($_GET['del_file']))
		  {
			   $this->db->where('id', $_GET['del_file']);
			   $this->db->limit(1);
			   $file = $this->db->get('files')->result_array();
			   if($file)
			   {
				    $file = $file[0];
				    if(file_exists($_SERVER['DOCUMENT_ROOT'].$file['path']))
				    {
					     unlink($_SERVER['DOCUMENT_ROOT'].$file['path']);
					     $this->db->where('id', $file['id']);
					     $this->db->limit(1);
					     $this->db->delete('files');
				    }
				    redirect("/admin/brands/edit/".$id."/#files");
			   }
		  }
		  
		  if(isset($_POST['add_file']))
		  {
			   
			   $file = "";
			   $path = "";
			   if (isset($_FILES['userfile'])) {					// проверка, выбран ли файл картинки			   
				    if ($_FILES['userfile']['name'] != '') {
					     
					   $imagearr = $this->upload_file($id);
					   $file = $imagearr['file_name'];
					   $path = '/upload/files/'.$id.'/'.$imagearr['file_name'];
				    }
			   }

			   if($file != '')
			   {
				    $dbins = array(
					     'page_id'	=> $id,
					     'name'	=> $_POST['name'],
					     'file'	=> $file,
					     'path'	=> $path
				    );
				    $this->db->insert('files', $dbins);
				    
				    redirect("/admin/brands/edit/".$id."/#files");
			   }
		  }
		  
            $err = '';
            if(isset($_POST['name']) && $_POST['name'] != '')
            {
                $url = $_POST['url'];
                if($_POST['url'] == '')
                {
                    $this->load->helper('translit_helper');
                    $url = translitRuToEn($_POST['name']);                    
                }
                
                $active = 0;
                if(isset($_POST['active']) && $_POST['active'] == true) $active = 1;
		
		$social_buttons = 0;
                  if(isset($_POST['social_buttons']) && $_POST['social_buttons'] == true) $social_buttons = 1;
		  
		  $template = '';
		  if(isset($_POST['template'])) $template = $_POST['template'];
		  	  
		
		$image = '';
		  if(isset($_POST['image'])) $image = $_POST['image'];
		  if(isset($_POST['image_del']) && $_POST['image_del'] == true)
		  {
			 unlink($_SERVER['DOCUMENT_ROOT'].$image);
			 $image = '';
			 
		  }
		  if (isset($_FILES['userfile'])) {					// проверка, выбран ли файл картинки			   
			   if ($_FILES['userfile']['name'] != '') {				    
				  $imagearr = $this->upload_foto();
				  if($image != '') unlink($_SERVER['DOCUMENT_ROOT'].$image);
				  $image = '/upload/fotos/'.$imagearr['file_name'];
			   }
		    }
		    
		    if($_POST['title'] == '') $_POST['title'] = $_POST['name'];
		    if($_POST['keywords'] == '') $_POST['keywords'] = $_POST['keywords'];
		    if($_POST['description'] == '') $_POST['description'] = $_POST['description'];
		  
                $dbins = array(
                                   'name'           => $_POST['name'],
                                   'url'            => $url,
                                   'num'            => $_POST['num'],
				   'content'        => $_POST['content'],                                   
                                   'active'         => $active,
                                   'title'          => $_POST['title'],
                                   'keywords'       => $_POST['keywords'],
                                   'description'    => $_POST['description'],
                                   'seo'            => $_POST['seo'],
				   'template'		=> $template,
				   'image'	    => $image,
				   'social_buttons' => $social_buttons
                               );
                $this->db->where('id',$id);
                $this->db->limit(1);
                $this->db->update('brands',$dbins);
		  if(isset($_POST['save_and_stay']))
			   redirect($_SERVER['REQUEST_URI']);
		  else
			   redirect("/admin/brands/");
            }
            $data['page'] = $this->brands->getBrandById($id);
            $data['title']  = "Редактирование бренда";
            $data['err'] = $err;
            $data['num'] = $this->brands->getNewNum();
            $data['brands'] = $this->brands->getBrands();
            $this->load->view('admin/brands_edit',$data);
        }
        
        public function up($id)
        {
            $cat = $this->brands->getBrandById($id);
            if(($cat) && $cat['num'] > 0)
            {
                $num = $cat['num']-1;
                $oldcat = $this->brands->getBrandByNum($num);
                $dbins = array('num' => $num);
                $this->db->where('id',$id)->limit(1)->update('brands',$dbins);
                if($oldcat)
                {
                    $dbins = array('num' => ($num+1));
                    $this->db->where('id',$oldcat['id'])->limit(1)->update('brands',$dbins);
                }
            }
            redirect('/admin/brands/');
        }
        public function down($id)
        {
            $cat = $this->brands->getBrandById($id);
            if(($cat) && $cat['num'] < ($this->brands->getNewNum()-1))
            {
                $num = $cat['num']+1;
                $oldcat = $this->brands->getBrandByNum($num);
                $dbins = array('num' => $num);
                $this->db->where('id',$id)->limit(1)->update('brands',$dbins);
                if($oldcat)
                {
                    $dbins = array('num' => ($num-1));
                    $this->db->where('id',$oldcat['id'])->limit(1)->update('brands',$dbins);
                }
            }
            redirect('/admin/brands/');
        }
        
        public function del($id)
        {
            $this->db->where('id',$id)->limit(1)->delete('brands');
            redirect("/admin/brands/");
        }
	
	public function active($id)
	{
		  $this->ma->setActive($id,'brands');
		  redirect('/admin/brands/');
	}
}