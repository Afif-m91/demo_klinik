<?php
class Booking_Model extends CI_Model
{
    public $table  = 'pemeriksaan';
    public $key  = 'id_pemeriksaan';
    public function __construct()
    {
        parent::__construct();
    }
    public function getAll($filter = null, $limit = 20, $offset = 0, $orderBy, $orderType)
    {
        $where = "";
        $cond = array();
        if (isset($filter)) {
            if (!empty($filter->keyword)) {
                $cond[] = "(lower(".$this->key.") like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(p.id_pasien) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(p.nama_pasien) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(s.nama_spesialis) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(pm.status) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(p.id_pasien) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								)";
            }

            if (!empty($filter->status)) {
                if (strtolower($filter->status) != "all") {
                    $cond[] = "(pm.status = '" . $this->db->escape_str(strtolower($filter->status)) . "')";
                }
            }

            if (!empty($filter->from) || !empty($filter->to)) {
                $cond[] = "(pm.tgl_booking >= '" . $this->db->escape_str($filter->from) . "' and pm.tgl_booking <= '" . $this->db->escape_str($filter->to) . "' )";
            }

            if (!empty($cond)) {
                $where = " where ". implode(" and ", $cond);
            }
        }

        $limitOffset = "LIMIT $offset,$limit";
        if ($limit == 0) {
            $limitOffset = "";
        }

        if (!$orderBy) {
            $orderBy = $this->key;
        }

        if (!$orderType) {
            $orderType = "asc";
        }

        // memasukkan database detail_pengiriman
        $query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS pm.*,s.nama_spesialis spesialis,s.keterangan,
                                            p.nama_pasien pasien_onlie,p.nama_pasien,pm.alamat
        FROM ".$this->table." pm
        LEFT JOIN spesialis s on s.id_spesialis = pm.id_spesialis
        LEFT JOIN pasien_online p on p.id_pasien = pm.id_pasien
        $where ORDER BY $orderBy $orderType $limitOffset
        ");

        $result = $query->result_array();
        $query->free_result();

        $total = $this->db->query('SELECT found_rows() total_row')->row()->total_row;

        return array($result,$total);
    }


    Public function get_by($field, $value = "",$obj = false)
        {
            if(!$field)
                $field = $this->key;
    
            $where = "WHERE $field = '".$this->db->escape_str(strtolower($value))."'";
            $query = $this->db->query(" SELECT SQL_CALC_FOUND_ROWS pm.*,s.nama_spesialis spesialis,s.keterangan,
                                        p.nama_pasien pasien_onlie,p.nama_pasien,pm.alamat
                                        FROM ".$this->table." pm
                                        LEFT JOIN spesialis s on s.id_spesialis = pm.id_spesialis
                                        LEFT JOIN pasien_online p on p.id_pasien = pm.id_pasien
                                        $where ");

        if (!$obj) {
            $result = $query->result_array();
        } else {
            $result = $query->row();
        }

        $query->free_result();
        return $result;
    }

    public function remove($id)
    {
        if (!is_array($id)) {
            $id = array($id);
        }

        $this->db->where_in($this->key, $id)->delete($this->table);
    }

    public function save($id = "", $data = array(), $insert_id = false)
    {
        if (!empty($id)) {
            $this->db->where($this->key, $id);
            $this->db->update($this->table, $data);
        } else {
            $this->db->insert($this->table, $data);
        }

        return $this->db->affected_rows();
    }

    public function get_last()
    {
        $query = $this->db->query("SELECT  * FROM ".$this->table." order by ".$this->key." desc limit 0,1");
        $result = $query->row();
        $query->free_result();

        return $result;
    }
    // public function remove_detail($id)
    // {
    //     if (!is_array($id)) {
    //         $id = array($id);
    //     }

    //     $this->db->where_in($this->key, $id)->delete("detail_pengiriman");
    // }

    // public function save_detail($data = array())
    // {
    //     $this->db->insert("detail_pengiriman", $data);
    //     return $this->db->affected_rows();
    // }
}
