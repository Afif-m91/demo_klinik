<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Berita extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("berita_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA BERITA WEB";
		$data['layout'] = "berita/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->berita_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("berita?");
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
		$data['title'] = "FORM BERITA WEB";
		$data['layout'] = "berita/manage";

		$data['data'] = new StdClass();
		$data['data']->id_berita = "";
		$data['data']->judul_berita = "";
		$data['data']->isi_berita = "";
		$data['data']->gambar = "";
		$data['data']->tgl_update = "";
		// $data['data']->email = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->berita_model->get_by("id_berita",$id,true);
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
			
			if(!empty($post['id_berita']))
				$data['id_berita'] = $post['id_berita'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['judul_berita']))
				$data['judul_berita'] = $post['judul_berita'];
			else
				$error[] = "judul berita alamat  tidak boleh kosong"; 
			
			if(!empty($post['isi_berita']))
				$data['isi_berita'] = $post['isi_berita'];
			else
				$error[] = "isi berita klinik tidak boleh kosong"; 
		
				if(!empty($post['tgl_update']))
				$data['tgl_update'] = $post['tgl_update'];
			// else
			// 	$error[] = "No Hp tidak boleh kosong"; 
		
				if(!empty($post['no_fax']))
				$data['no_fax'] = $post['no_fax'];
			// else
			// 	$error[] = "alamat klinik tidak boleh kosong"; 
		
				// if(!empty($post['email']))
				// $data['email'] = $post['email'];
			// else
			// 	$error[] = "alamat klinik tidak boleh kosong"; 
		


			if(empty($error))
			{
				if(empty($id))
				{
					$cekberita = $this->berita_model->get_by("id_berita",$post['id_berita']);
					if(!empty($cekberita))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->berita_model->get_by("judul_berita",$post['judul_berita']);
					if(!empty($cek))
						$error[] = "nama berita sudah terdaftar"; 
				}
				else
				{
					$cek = $this->berita_model->cekName($id,$post['judul_berita']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->berita_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("berita/manage/".$id);
				else
					redirect("berita");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("berita/manage/".$id);
			}
		}
		else
		  redirect("berita");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->berita_model->get_by("id_berita",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("berita");
			}
			else
			{
				$cek = $this->berita_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("berita");
				// }
				// else
				{
					$this->berita_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("berita");
				}
			}
		}
		else
			redirect("berita");
	}
	
	public function generate_code()
	{
		$prefix = "BRT";
		$code = "001";
		
		$last = $this->berita_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_berita,3,3) +1;
			$code = str_pad($number, 3, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
