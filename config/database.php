<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
//$active_record = TRUE;
$query_builder = TRUE;

//$CI = & get_instance();
//$CI->load->helper('other_helper');

$db['default']['hostname'] = 'umhh.mysql.ukraine.com.ua';
$db['default']['username'] = 'umhh_new';
$db['default']['password'] = '123qweasdzxc';
$db['default']['database'] = 'umhh_'.SITE;
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = ''; 
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */