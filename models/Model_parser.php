<?php

class Model_parser extends CI_Model
{
    function getParsers($active = -1, $type = false){
        if($active != -1) $this->db->where('active', $active);
        if($type) $this->db->where('type', $type);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('module_parsers')->result_array();
    }

    function getParserById($id)
    {
        $this->db->where('id',$id);
        $cat = $this->db->get('module_parsers')->result_array();
        if(!$cat) return false;
        else return $cat[0];
    }

    function getLatestParser()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $cat = $this->db->get('module_parsers')->result_array();
        if(!$cat) return false;
        else return $cat[0];
    }

    /**
     * Получаем инфу об конкретной опперации парсинга 1-го материала
     * @param $parser_id - id парсера
     * @param $original_url - адрес статьи, которую парсим
     * @param bool $returnInfo - если true, то вернуть всю найденную строку из базы. если false - то возвращаем bool, есть или нет
     * @return bool
     *
     */
    function isParsed($parser_id, $original_url, $returnInfo = false){
        if(!$returnInfo) $this->db->select('id');
        $this->db->where('parser_id', $parser_id);
        $this->db->where('original_url', $original_url);
        $this->db->limit(1);
        $result = $this->db->get('module_parser_actions')->result_array();
        if(!$returnInfo && isset($result[0])) return true;
        elseif($returnInfo == true && isset($result[0])) return $result[0];

        return false;
    }


    function getParserParams(){
        return $this->db->get('module_parser_params')->result_array();
    }
}