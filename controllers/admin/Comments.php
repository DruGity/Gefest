<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {

         public function __construct()
        {
            parent::__construct();
	    $this->load->helper('login_helper');            
	    isAdminLogin();
            $this->load->model('Model_admin','ma');	    
            $this->load->model('Model_categories','cat');
            $this->load->model('Model_articles','art');
            $this->load->model('Model_comments','comments');
            $this->load->model('Model_users','users');
            $this->load->model('Model_pages','pages');
        }
	
	
        
        public function index()
	{
		  if(isset($_POST['save']) && isset($_POST['comment_id']))
		  {
			   $dbins = array(
				    'comment'	=> post('comment')
			   );
			   $this->db->where('id', post('comment_id'));
			   $this->db->limit(1);
			   $this->db->update('comments', $dbins);
		  }
		  elseif(isset($_POST['delete']))
		  {			   
			   $this->db->where('id', $_POST['id']);
			   $this->db->limit(1);
			   $this->db->delete('comments');
		  }
		  elseif(isset($_POST['add']))
		  {
			   $dbins = array(
				    'name'	=> $_POST['name'],
				    'msg'	=> $_POST['msg'],
				    'date'	=> date('Y-m-d')
			   );
			   $this->db->insert('comments', $dbins);
		  }
	 
            //$comments = $this->comments->getComments();
	    
	    
            // ПАГИНАЦИЯ //
            
            //////////
            //Pagination
            $page = 1;
            $page1 = 0;
            $per_page = 20;

            if (isset($_GET['page']))
            {
                $page = $_GET['page'];

                if ($page == "" || $page=="1")
                {
                    $page1=0;
                }
                else
                {
                    $page1 = ($page*$per_page)-$per_page;
                }

            }
            $data['comments'] = $this->comments->getComments($per_page,$page1);
            //vdd($data['comments']);
            $data['comments1'] = $comments1 =  $this->comments->getComments(10000,0);
            $count = count($comments1);

            $data['count1'] = ceil($count/$per_page);

            //Pagination

            
            //$data['comments']   = $this->comments->getComments($per_page, $from);
                
            
	    
            //$data['categories'] = $this->mcats->getCategories();

        $data['page'] = $page;
        $data['title']  = "Комментарии";
        $data['head'] = $this->load->view('common/head.php',$data, true);
        $data['header'] = $this->load->view('common/header.php',$data, true);
        $data['left_sidebar'] = $this->load->view('common/left_sidebar.php',$data, true);
        $data['footer'] = $this->load->view('common/footer.php',$data, true);
            $this->load->view('comments/comments', $data);
	}
        
        public function del($id)
        {
            $this->db->where('id',$id)->limit(1)->delete('comments');
	    
		  redirect("/admin/comments/");
        }


}