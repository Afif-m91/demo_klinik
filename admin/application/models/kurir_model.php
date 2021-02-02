<?php
class Kurir_Model extends CI_Model
{
	var $table  = 'kurir';
	var $key  = 'id_kurir';
	function __construct()
    {
        parent::__construct();
    }
	
/**
   * Helper to fetch data in array from database
   *
   * @param string $qry
   * @param string $qryParam
   * @return array
   * @author Afif
   */
  function getRecordset($qry, $qryParam = null)
  {
    $nilai = null;
    $query = $this->db->query($qry, $qryParam);
    if($query->num_rows() > 0)  {
      $nilai = $query->result();
    }
    return $nilai;
  }	
	
	function getAll($filter = null,$limit = 20,$offset = 0, $orderBy, $orderType)
	{
				   
		$where = "";
		$cond = array();
	  	if (isset($filter))
	  	{
			if (!empty($filter->keyword))
			{
				  $cond[] = "(lower(".$this->key.") like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(nama) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(telepon) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(jenis_kelamin) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								)";
			}
			
			if(!empty($cond))
				$where = " where ". implode(" and ", $cond);
	  	}
		  
		$limitOffset = "LIMIT $offset,$limit";
		if($limit == 0)
			$limitOffset = "";
		
		if(!$orderBy)
			$orderBy = $this->key;
		
		if(!$orderType)
			$orderType = "asc";
			
		$query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS *
								   FROM ".$this->table." 
								   $where ORDER BY $orderBy $orderType $limitOffset
								   ");
								   
		$result = $query->result_array();
		$query->free_result();
		
		$total = $this->db->query('SELECT found_rows() total_row')->row()->total_row;
		
		return array($result,$total);
	}
	
	public function get_by($field, $value = "",$obj = false)
	{
		if(!$field)
			$field = $this->key;
			
		$where = "WHERE $field = '".$this->db->escape_str(strtolower($value))."'";
		$query = $this->db->query("SELECT  *
								   FROM ".$this->table."
								   $where 
								   ");
		
		if(!$obj)
			$result = $query->result_array();
		else
			$result = $query->row();
			
		$query->free_result();
		
		return $result;
	}
	
	function remove($id)
    {
      if (!is_array($id))
		    $id = array($id);
			
		$this->db->where_in($this->key, $id)->delete($this->table);
    }
	
	function save($id = "",$data = array(), $insert_id = false)
	{
		
		if (!empty($id))
		{
			$this->db->where($this->key, $id);
			$this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
		}
		
		return $this->db->affected_rows();
	}
	
/**
   * Fetch data from database
   *
   * @param string $params
   * @return array
   * @author Afif
   */

  function getData($params = null)
  {
    $str = "";
    $cat_str = "";

    if ($params) {
      $date = date("y-m-d");
      if ($params != 'all') {
        $cat_str = "id_kurir =  AND ";
      }
    // $str = "WHERE $cat_str tgl_barang BETWEEN '$from' AND '$to'";
    }

    $query = "SELECT * FROM ".$this->table." $str";

    $result = $this->getRecordset($query);
    return $result;
  }



// Listing
	public function listing() 
	{

	$this->db->select('*');
	$this->db->from('kurir');
	$query = $this->db->get();
	return $query->result();

	}

	function tampil_data(){
		return $this->db->get('kurir')->row();

	}

	public function cekName($id,$name)
	{
		$where = "WHERE ".$this->key." <> '".$this->db->escape_str(strtolower($id))."' and nama = '".$this->db->escape_str(strtolower($name))."' ";
		$query = $this->db->query("SELECT  *
								   FROM ".$this->table." 
								   $where 
								   ");
								   
		$result = $query->result_array();
		
		$query->free_result();
		
		return $result;
	}
	
	public function cekAvalaible($id)
	{
		$query = $this->db->query(" ( SELECT  ".$this->key." FROM pengiriman where ".$this->key." = '".$this->db->escape_str(strtolower($id))."' ) ");
		$result = $query->row();
		$query->free_result();
		
		return $result;
	}
	
	public function get_last()
	{
		$query = $this->db->query("SELECT  * FROM ".$this->table." order by ".$this->key." desc limit 0,1");
		$result = $query->row();
		$query->free_result();
		
		return $result;
	}
	
	function authenticate($username,$password)
    {
        $this->db->select($this->key ." , nama");
		$this->db->from($this->table);
		$this->db->where('id_kurir', $this->db->escape_str($username));
		$this->db->where('password', $this->db->escape_str($password));
		$query = $this->db->get();
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return $query->row();
		}
    }
}