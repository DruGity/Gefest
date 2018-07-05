<?php
class Model_productMarks extends CI_Model {

function getMarksPerProduct($product_id)
	{
        $this->db->where('product_id', $product_id);
        return $this->db->get('product_marks')->result_array();
	}

	function getMarksPerProductCount($product_id)
	{
        $this->db->where('product_id', $product_id);
        return count($this->db->get('product_marks')->result_array());
	}

	function getMarkPerProductUser($product_id,$user_id)
	{
		$this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $marked = $this->db->get('product_marks')->result_array();
        if($marked)
        {
        	return 1;
        }
        else
        {
        	return;
        }
	}

}