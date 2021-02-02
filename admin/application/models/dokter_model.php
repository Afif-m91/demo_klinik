<?php
class Dokter_Model extends CI_Model
{
	var $table  = 'dokter';
	var $key  = 'id_dokter';
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
								 or lower(d.nama_dokter) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(d.jenis_kelamin) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(d.tgl_dokter) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(d.telepon) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(d.alamat) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(s.nama_spesialis) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(s.id_spesialis) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								)";
			}

			if (!empty($filter->dokter))
			{
				  $cond[] = "lower(d.id_dokter) not in ('" . implode($filter->dokter,"', '") . "')";
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

		$query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS d.*,s.nama_spesialis spesialis,s.keterangan
								   FROM ".$this->table." d
								   LEFT JOIN spesialis s on s.id_spesialis = d.id_spesialis
								   $where ORDER BY $orderBy $orderType $limitOffset
								   ");

		$result = $query->result_array();
		$query->free_result();

    $total = $this->db->query('SELECT found_rows() total_row')->row()->total_row;

		return array($result,$total);
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
      $from = date("y-m-d", strtotime($params['from']));
      $to = date("y-m-d", strtotime($params['to']));
      if ($params['id_dokter'] != 'all') {
        $cat_str = "id_dokter = '$params[id_dokter]' AND ";
      }
    $str = "WHERE $cat_str tgl_dokter BETWEEN '$from' AND '$to'";
    }

    $query = "SELECT * FROM ".$this->table." $str";

    $result = $this->getRecordset($query);
    return $result;
  }

  function getItemId()
  {
    $query = "SELECT id_dokter FROM ".$this->table."";
    $result = $this->getRecordset($query);
    return $result;
  }

	//  Penarikan Database Edit

	public function get_by($field, $value = "",$obj = false)
	{
		if(!$field)
			$field = $this->key;

		$where = "WHERE $field = '".$this->db->escape_str(strtolower($value))."'";
		$query = $this->db->query("SELECT b.*,k.nama_spesialis spesialis,k.keterangan
								   FROM ".$this->table." b
								   LEFT JOIN spesialis k on k.id_spesialis = b.id_spesialis
								   $where ");

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
		$query = $this->db->query(" ( SELECT  ".$this->key." FROM dokter where ".$this->key." = '".$this->db->escape_str(strtolower($id))."' ) ");
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

}