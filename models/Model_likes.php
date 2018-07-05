<?php
class Model_likes extends CI_Model
{
	function getLikesPerArticle($article_id = -1)
	{
		if ($article_id != -1)
            $this->db->where('article_id', $article_id);
        $likes = $this->db->get('likes')->result_array();
        return count($likes);
	}

	function getLikesPerUserInArticle($user_id = -1,$article_id = -1)
	{
        if ($user_id != -1)
            $this->db->where('user_id', $user_id);
        if ($article_id != -1)
            $this->db->where('article_id', $article_id);
        $likes = $this->db->get('likes')->result_array();
        return count($likes);
	}

    function getLikesPerUserInImage($user_id = -1,$image_id = -1)
    {
        if ($user_id != -1)
            $this->db->where('user_id', $user_id);
        if ($image_id != -1)
            $this->db->where('image_id', $image_id);
        $likes = $this->db->get('likes')->result_array();
        return count($likes);
    }

    function getLikesPerImage($image_id = -1)
    {
        if ($image_id != -1)
            $this->db->where('image_id', $image_id);
        $likes = $this->db->get('likes')->result_array();
        return count($likes);
    }
}