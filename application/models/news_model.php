<?php
class News_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
	}
	public function get($select = "*",$from = "",$join = "",$field = "",$value="")
	{
		if ($field && $value){
			$this->db->where($field,$value);
		}
		$query = $this->db->get('news');
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	public function insert($dataAdd)
	{
	    $this->db->insert("news",$dataAdd);
	//	return ;
	}
	public function update($dataEdit,$where = "")
	{
		if($where && $where != "")
		{
			$this->db->where($where);
		}
		return $this->db->update("news", $dataEdit);
	}
	public function del($field="",$value="")
	{
		if($value){
			$this->db->where($field, $value);
		}elseif(is_array($value)){
			
			$this->db->where_in($field,$value);
		}
		return $this->db->delete("news");
	}
}
?>