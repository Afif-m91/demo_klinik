<?php
class Gambar_Model extends CI_Model
{
	// var $table  = 'slider1';
	// var $key  = 'id_slider';
	function __construct()
    {
		$this->load->database();
		// $this->load->model('slider1');
        // parent::__construct();
	}

	public function get($table)
	{ 
		$this->db->order_by('nama_slider', 'ASC');
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function get_where($table,$where)
		{
			$query = $this->db->get_where($table, $where);
			return $query->row_array();
		}

	public function insert($table,$data)
		{
			$query = $this->db->insert($table,$data);
			return $query;
		}
		
	public function update($table,$data,$where)
		{
			$query = $this->db->update($table,$data,$where);
			return $query;
		}

	public function delete($table,$id)
	{
		$query = $this->db->delete($table,$id);
		return $query;
	}

	
	// 
	// public function get_by($field, $value = "",$obj = false)
	// {
	// 	if(!$field)
	// 		$field = $this->key;
			
	// 	$where = "WHERE $field = '".$this->db->escape_str(strtolower($value))."'";
	// 	$query = $this->db->query("SELECT  *
	// 							   FROM ".$this->table."
	// 							   $where 
	// 							   ");
		
	// 	if(!$obj)
	// 		$result = $query->result_array();
	// 	else
	// 		$result = $query->row();
			
	// 	$query->free_result();
		
	// 	return $result;
	// }
	
	// function remove($id)
    // {
    //   if (!is_array($id))
	// 	    $id = array($id);
			
	// 	$this->db->where_in($this->key, $id)->delete($this->table);
    // }
	
	// // function save($id = "",$data = array(), $insert_id = false)
	// // {
		
	// // 	if (!empty($id))
	// // 	{
	// // 		$this->db->where($this->key, $id);
	// // 		$this->db->update($this->table, $data);
	// // 	}
	// // 	else
	// // 	{
	// // 		$this->db->insert($this->table, $data);
	// // 	}
		
	// // 	return $this->db->affected_rows();
	// // }
	
	// // public function cekName($id,$name,$upload)
	// // {
	// // 	$where = "WHERE ".$this->key." <> '".$this->db->escape_str(strtolower($id))."' and nama_slider = '".$this->db->escape_str(strtolower($name))."' ";
	// // 	$query = $this->db->query("SELECT  *
	// // 							   FROM ".$this->table." 
	// // 							   $where 
	// // 							   ");
								   
	// // 	$result = $query->result_array();
		
	// // 	$query->free_result();
		
	// // 	return $result;
	// // }
	
	// // public function cekAvalaible($id)
	// // {
	// // 	$query = $this->db->query(" ( SELECT  ".$this->key." FROM slider where ".$this->key." = '".$this->db->escape_str(strtolower($id))."' ) ");
	// // 	$result = $query->row();
	// // 	$query->free_result();
		
	// // 	return $result;
	// // }
	
	// public function get_last()
	// {
	// 	$query = $this->db->query("SELECT  * FROM ".$this->table." order by ".$this->key." desc limit 0,1");
	// 	$result = $query->row();
	// 	$query->free_result();
		
	// 	return $result;
	// }
}