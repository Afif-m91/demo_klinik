<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profil extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("profil_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA INFO WEB";
		$data['layout'] = "profil/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->profil_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("profil?");
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
		$data['layout'] = "profil/manage";

		$data['data'] = new StdClass();
		$data['data']->id_profil = "";
		$data['data']->judul_profil = "";
		$data['data']->isi_profil = "";
		$data['data']->no_hp = "";
		$data['data']->no_fax = "";
		$data['data']->email = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->profil_model->get_by("id_profil",$id,true);
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
			
			if(!empty($post['id_profil']))
				$data['id_profil'] = $post['id_profil'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['judul_profil']))
				$data['judul_profil'] = $post['judul_profil'];
			else
				$error[] = "judul profil alamat  tidak boleh kosong"; 
			
			if(!empty($post['isi_profil']))
				$data['isi_profil'] = $post['isi_profil'];
			else
				$error[] = "isi profil klinik tidak boleh kosong"; 
		
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
					$cekprofil = $this->profil_model->get_by("id_profil",$post['id_profil']);
					if(!empty($cekprofil))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->profil_model->get_by("judul_profil",$post['judul_profil']);
					if(!empty($cek))
						$error[] = "nama profil sudah terdaftar"; 
				}
				else
				{
					$cek = $this->profil_model->cekName($id,$post['judul_profil']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->profil_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("profil/manage/".$id);
				else
					redirect("profil");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("profil/manage/".$id);
			}
		}
		else
		  redirect("profil");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->profil_model->get_by("id_profil",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("profil");
			}
			else
			{
				$cek = $this->profil_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("profil");
				// }
				// else
				{
					$this->profil_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("profil");
				}
			}
		}
		else
			redirect("profil");
	}
	
	public function generate_code()
	{
		$prefix = "PRO";
		$code = "01";
		
		$last = $this->profil_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_profil,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
