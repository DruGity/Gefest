<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('login_helper');
		$this->load->model('Model_users', 'users');
	}

    public function soc()
    {
        $user = false;
        $isAuth = false;
        $this->load->library('Uauth');
        //$this->load->library('Ulogin');
        require_once X_PATH."/application/libraries/Ulogin.php";
        $ulogin = new Ulogin();
        $this->load->model('Model_users','users');
        $s_user = $ulogin->userdata();
        if($_POST)vd($_POST);
        if($_GET)vd($_GET);
        if($s_user)
        {
            //vd($s_user);
            $this->db->where('profile', $s_user['profile']);
            $this->db->or_where('email', $s_user['email']);
            $this->db->limit(1);
            $user = $this->db->get('users')->result_array();

            if(!$user)
            {

                $dbins = array(
                    'login' 	=> $s_user['email'],
                    'email' 	=> $s_user['email'],
                    'type' 		=> 'user',
                    'active'	=> 1,
                    'reg_date'	=> date("Y-m-d H:i"),
                    'reg_ip'	=> $_SERVER['REMOTE_ADDR'],
                    'pass'		=> md5(getRandCode()),
                    'activation'	=> 1
                );

                if(isset($s_user['uid'])) $dbins['uid'] = $s_user['uid'];

                if(isset($s_user['identity'])) $dbins['identity'] = $s_user['identity'];
                if(isset($s_user['network'])) $dbins['network'] = $s_user['network'];
                if(isset($s_user['nikname'])) $dbins['nikname'] = $s_user['nikname'];
                if(isset($s_user['first_name'])) $dbins['name'] = $s_user['first_name'];
                if(isset($s_user['last_name'])) $dbins['lastname'] = $s_user['last_name'];
                if(isset($s_user['photo_big'])) $dbins['photo'] = $s_user['photo_big'];
                if(isset($s_user['bdate'])) $dbins['bdate'] = $s_user['bdate'];
                if(isset($s_user['photo'])) $dbins['avatar'] = $s_user['photo'];
                if(isset($s_user['profile'])) $dbins['profile'] = $s_user['profile'];
                if(isset($s_user['city'])) $dbins['city'] = $s_user['city'];
                if(isset($s_user['country'])) $dbins['country'] = $s_user['country'];



                $this->db->insert('users', $dbins);


                $user = $this->users->getUserByLogin($s_user['email']);

                if($user)
                {
                    $isAuth = $this->authorization($user);
                }
            }
            else
            {
                $user = $user[0];
                $this->users->editSocialUserDetails($user, $s_user);
                $isAuth = $this->authorization($user);
            }
                redirect($_SERVER['HTTP_REFERER']);
        }
        $data['title']  = "Авторизация";

        $this->load->view('login_soc.php', $data);

    }

    private function authorization($user)
    {


        if($user['active'] == 1){
            $this->session->set_userdata('user_id',$user['id']);
            $this->session->set_userdata('login',$user['login']);
            $this->session->set_userdata('pass',$user['pass']);
            $this->session->set_userdata('type',$user['type']);
            //vdd($user);
            $this->session->set_userdata('social', true);

            $this->users->setLastDateAndIp($user['login']);
            return true;
        }
        else set_userdata('login_err','Ваш профиль не активирован главным администратором!');

        return false;
    }
    public function logoff()
    {
        $logs = $this->model_options->getOption('logs');
        if($logs)
        {
            $dbins = array(
                'date'		=> date("Y-m-d"),
                'time'		=> date("H:i"),
                'text'		=> "Выход из админпанели",
                'login'		=> userdata("login"),
                'type'		=> "admin",
                'error'		=> "0"
            );
            $this->db->insert('logs', $dbins);
        }

        unset_userdata('login');
        unset_userdata('pass');
        unset_userdata('type');
        unset_userdata('name');

        redirect($_SERVER['HTTP_REFERER']);
    }

	public function index() {
	    if(post('action') == 'authByPass'){
	        var_dump("asd");
            $login = post('login');
            $pass = post('password');
            if($login != '' && $pass != '') {
                $user = $this->users->getUserByLogin($login);
                if($user){
                    if($user['pass'] == md5($pass)){
                        set_userdata('login', $login);
                        set_userdata('type', $user['type']);
                        set_userdata('pass', md5($pass));
                        set_userdata('msg','<h2>Вы успешно авторизировались!</h2>');
                    } else set_userdata('msg','<h2>Логин или пароль введены не верно!</h2>');
                } else set_userdata('msg','<h2>Логин или пароль введены не верно!</h2>');
            } else set_userdata('msg','<h2>Логин или пароль введены не верно!</h2>');
        } else {
            $this->load->library('uauth');
            $this->load->library('ulogin');
            $s_user = $this->ulogin->userdata();

            addOrEditUser($s_user);

            if ($_POST['ajax']) {
                echo json_encode(array('done' => false, 'err' => userdata('login_err')));
                exit();
            }

        }
        if (userdata('last_url')) {
            redirect(userdata('last_url'), '302');
        } else redirect('/', '302');
	}

	function getActiveCode($chars_min = 10, $chars_max = 20, $use_upper_case = false, $include_numbers = true, $include_special_chars = false) {
		getRandCode($chars_min, $chars_max, $use_upper_case, $include_numbers, $include_special_chars);
	}

	public function iframeLogin(){
        $this->load->view('users/login.tpl.php');
    }

	public function logout() {
	    echo 'Выходим из аккаунта...';
		unset_userdata('login');
		unset_userdata('name');
		unset_userdata('pass');
		unset_userdata('type');
		unset_userdata('user_id');

		set_userdata("msg",getLine('Вы успешно вышли из системы!'));


		if(userdata('last_url') != null)
		{
			redirect(userdata('last_url'),'302');
		}

		else
		redirect('/','302');

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */