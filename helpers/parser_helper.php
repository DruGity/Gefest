<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function isAlreadyParsed($type, $name, $content = false, $categoryName = false){
    $CI = &get_instance();
    $CI->db->where('name', $name);
    if($content)
        $CI->db->where('content', $content);
}