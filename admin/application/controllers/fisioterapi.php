<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fisioterapi extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("fisioterapi_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA FISIOTERAPI";
		$data['layout'] = "fisioterapi/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->fisioterapi_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("fisioterapi?");
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
		$data['title'] = "FORM FISIOTERAPI";
		$data['layout'] = "fisioterapi/manage";

		$data['data'] = new StdClass();
		$data['data']->id_fisioterapi = "";
		$data['data']->nama_fisioterapi = "";
		$data['data']->tarif = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->fisioterapi_model->get_by("id_fisioterapi",$id,true);
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
			
			if(!empty($post['id_fisioterapi']))
				$data['id_fisioterapi'] = $post['id_fisioterapi'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_fisioterapi']))
				$data['nama_fisioterapi'] = $post['nama_fisioterapi'];
			else
				$error[] = "nama fisioterapi tidak boleh kosong"; 
			
			if(!empty($post['tarif']))
				$data['tarif'] = str_replace(".","",$post['tarif']) ;
			else
				$error[] = "tarif tidak boleh kosong"; 
		
			if(empty($error))
			{
				if(empty($id))
				{
					$cekfisioterapi = $this->fisioterapi_model->get_by("id_fisioterapi",$post['id_fisioterapi']);
					if(!empty($cekfisioterapi))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->fisioterapi_model->get_by("nama_fisioterapi",$post['nama_fisioterapi
					']);
					if(!empty($cek))
						$error[] = "nama fisioterapi sudah terdaftar"; 
				}
				else
				{
					$cek = $this->fisioterapi_model->cekName($id,$post['nama_fisioterapi']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->fisioterapi_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("fisioterapi/manage/".$id);
				else
					redirect("fisioterapi");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("fisioterapi/manage/".$id);
			}
		}
		else
		  redirect("fisioterapi");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->fisioterapi_model->get_by("id_fisioterapi",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("fisioterapi");
			}
			else
			{
				$cek = $this->fisioterapi_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("fisioterapi");
				// }
				// else
				{
					$this->fisioterapi_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("fisioterapi");
				}
			}
		}
		else
			redirect("fisioterapi");
	}
	
	public function generate_code()
	{
		$prefix = "FSI";
		$code = "01";
		
		$last = $this->fisioterapi_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_fisioterapi,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
