<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Abk extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("abk_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA ABK";
		$data['layout'] = "abk/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->abk_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("abk?");
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
		$data['title'] = "FORM ABK";
		$data['layout'] = "abk/manage";

		$data['data'] = new StdClass();
		$data['data']->id_abk = "";
		$data['data']->nama_abk = "";
		$data['data']->judul = "";
		$data['data']->isi_abk = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->abk_model->get_by("id_abk",$id,true);
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
			
			if(!empty($post['id_abk']))
				$data['id_abk'] = $post['id_abk'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_abk']))
				$data['nama_abk'] = str_replace(".","",$post['nama_abk']) ;
			else
				$error[] = "nama abk tidak boleh kosong"; 
			
			
			if(!empty($post['isi_abk']))
				$data['isi_abk'] = $post['isi_abk'] ;
			// else
			// 	$error[] = "nama abk tidak boleh kosong"; 
		
			if(empty($error))
			{
				if(empty($id))
				{
					$cekabk = $this->abk_model->get_by("id_abk",$post['id_abk']);
					if(!empty($cekabk))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->abk_model->get_by("nama_abk",$post['nama_abk
					']);
					if(!empty($cek))
						$error[] = "nama abk sudah terdaftar"; 
				}
				else
				{
					$cek = $this->abk_model->cekName($id,$post['nama_abk']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->abk_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("abk/manage/".$id);
				else
					redirect("abk");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("abk/manage/".$id);
			}
		}
		else
		  redirect("abk");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->abk_model->get_by("id_abk",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("abk");
			}
			else
			{
				$cek = $this->abk_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("abk");
				// }
				// else
				{
					$this->abk_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("abk");
				}
			}
		}
		else
			redirect("abk");
	}
	
	public function generate_code()
	{
		$prefix = "ABK";
		$code = "01";
		
		$last = $this->abk_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_abk,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
