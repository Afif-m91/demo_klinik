<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vaksin extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("vaksin_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA VAKSIN";
		$data['layout'] = "vaksin/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->vaksin_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("vaksin?");
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
		$data['title'] = "FORM VAKSIN";
		$data['layout'] = "vaksin/manage";

		$data['data'] = new StdClass();
		$data['data']->id_vaksin = "";
		$data['data']->nama_vaksin = "";
		$data['data']->usia = "";
		$data['data']->kegunaan = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->vaksin_model->get_by("id_vaksin",$id,true);
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
			
			if(!empty($post['id_vaksin']))
				$data['id_vaksin'] = $post['id_vaksin'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_vaksin']))
				$data['nama_vaksin'] = $post['nama_vaksin'];
			else
				$error[] = "nama vaksin tidak boleh kosong"; 
			
			if(!empty($post['usia']))
				$data['usia'] = str_replace(".","",$post['usia']) ;
			else
				$error[] = "usia tidak boleh kosong"; 
		
			if(!empty($post['kegunaan']))
				$data['kegunaan'] = $post['kegunaan'];
			else
				$error[] = "kegunaan vaksin tidak boleh kosong"; 
				

			if(empty($error))
			{
				if(empty($id))
				{
					$cekvaksin = $this->vaksin_model->get_by("id_vaksin",$post['id_vaksin']);
					if(!empty($cekvaksin))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->vaksin_model->get_by("nama_vaksin",$post['nama_vaksin
					']);
					if(!empty($cek))
						$error[] = "nama vaksin sudah terdaftar"; 
				}
				else
				{
					$cek = $this->vaksin_model->cekName($id,$post['nama_vaksin']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->vaksin_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("vaksin/manage/".$id);
				else
					redirect("vaksin");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("vaksin/manage/".$id);
			}
		}
		else
		  redirect("vaksin");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->vaksin_model->get_by("id_vaksin",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("vaksin");
			}
			else
			{
				$cek = $this->vaksin_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("vaksin");
				// }
				// else
				{
					$this->vaksin_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("vaksin");
				}
			}
		}
		else
			redirect("vaksin");
	}
	
	public function generate_code()
	{
		$prefix = "VKS";
		$code = "01";
		
		$last = $this->vaksin_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_vaksin,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
