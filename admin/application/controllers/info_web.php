<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Info_Web extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("info_web_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA INFO WEB";
		$data['layout'] = "info_web/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->info_web_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("info_web?");
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
		$data['title'] = "FORM INFO WEB";
		$data['layout'] = "info_web/manage";

		$data['data'] = new StdClass();
		$data['data']->id_web = "";
		$data['data']->nama_web = "";
		$data['data']->alamat_klinik = "";
		$data['data']->no_hp = "";
		$data['data']->no_fax = "";
		$data['data']->email = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->info_web_model->get_by("id_web",$id,true);
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
			
			if(!empty($post['id_web']))
				$data['id_web'] = $post['id_web'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_web']))
				$data['nama_web'] = $post['nama_web'];
			else
				$error[] = "nama alamat  tidak boleh kosong"; 
			
			if(!empty($post['alamat_klinik']))
				$data['alamat_klinik'] = $post['alamat_klinik'];
			else
				$error[] = "alamat klinik tidak boleh kosong"; 
		
				if(!empty($post['no_hp']))
				$data['no_hp'] = $post['no_hp'];
			// else
			// 	$error[] = "No Hp tidak boleh kosong"; 
		
				if(!empty($post['no_fax']))
				$data['no_fax'] = $post['no_fax'];
			// else
			// 	$error[] = "alamat klinik tidak boleh kosong"; 
		
				if(!empty($post['email']))
				$data['email'] = $post['email'];
			// else
			// 	$error[] = "alamat klinik tidak boleh kosong"; 
		


			if(empty($error))
			{
				if(empty($id))
				{
					$cekinfo_web = $this->info_web_model->get_by("id_web",$post['id_web']);
					if(!empty($cekinfo_web))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->info_web_model->get_by("nama_web",$post['nama_web']);
					if(!empty($cek))
						$error[] = "nama info_web sudah terdaftar"; 
				}
				else
				{
					$cek = $this->info_web_model->cekName($id,$post['nama_web']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->info_web_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("info_web/manage/".$id);
				else
					redirect("info_web");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("info_web/manage/".$id);
			}
		}
		else
		  redirect("info_web");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->info_web_model->get_by("id_web",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("info_web");
			}
			else
			{
				$cek = $this->info_web_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("info_web");
				// }
				// else
				{
					$this->info_web_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("info_web");
				}
			}
		}
		else
			redirect("info_web");
	}
	
	public function generate_code()
	{
		$prefix = "SPS";
		$code = "01";
		
		$last = $this->info_web_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_web,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
