<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Spesialis extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("spesialis_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA SPESIALIS";
		$data['layout'] = "spesialis/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->spesialis_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("spesialis?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		$this->load->view('template',$data);
	}
	
	public function manage($id = "")
	{
		$data['title'] = "FORM SPESIALIS";
		$data['layout'] = "spesialis/manage";

		$data['data'] = new StdClass();
		$data['data']->id_spesialis = "";
		$data['data']->nama_spesialis = "";
		$data['data']->keterangan = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->spesialis_model->get_by("id_spesialis",$id,true);
			if(!empty($dt))
				$data['data'] = $dt;
		}
		
		$this->load->view('template',$data);
	}
	
	public function save()
	{
		$data = array();
		$post = $this->input->post();
		
		if($post)
		{
			$error = array();
			$id = $post['id'];
			
			if(!empty($post['id_spesialis']))
				$data['id_spesialis'] = $post['id_spesialis'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_spesialis']))
				$data['nama_spesialis'] = $post['nama_spesialis'];
			else
				$error[] = "nama spesialis tidak boleh kosong"; 
			
			if(!empty($post['keterangan']))
				$data['keterangan'] = $post['keterangan'];
			else
				$error[] = "keterangan tidak boleh kosong"; 
		
			if(empty($error))
			{
				if(empty($id))
				{
					$cekspesialis = $this->spesialis_model->get_by("id_spesialis",$post['id_spesialis']);
					if(!empty($cekspesialis))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->spesialis_model->get_by("nama_spesialis",$post['nama_spesialis
					']);
					if(!empty($cek))
						$error[] = "nama spesialis sudah terdaftar"; 
				}
				else
				{
					$cek = $this->spesialis_model->cekName($id,$post['nama_spesialis']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->spesialis_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("spesialis/manage/".$id);
				else
					redirect("spesialis");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("spesialis/manage/".$id);
			}
		}
		else
		  redirect("spesialis");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->spesialis_model->get_by("id_spesialis",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("spesialis");
			}
			else
			{
				$cek = $this->spesialis_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("spesialis");
				// }
				// else
				{
					$this->spesialis_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("spesialis");
				}
			}
		}
		else
			redirect("spesialis");
	}
	
	public function generate_code()
	{
		$prefix = "SPS";
		$code = "01";
		
		$last = $this->spesialis_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_spesialis,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
