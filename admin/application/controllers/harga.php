<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Harga extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("harga_model");
		$this->cekLoginStatus("admin",true);
    }
	
	public function index()
	{
		$data['title'] = "DATA HARGA";
		$data['layout'] = "harga/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->harga_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("harga?");
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
		$data['title'] = "FORM HARGA";
		$data['layout'] = "harga/manage";

		$data['data'] = new StdClass();
		$data['data']->id_harga = "";
		$data['data']->kecamatan = "";
		$data['data']->harga = "";
		$data['data']->moda = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->harga_model->get_by("id_harga",$id,true);
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
			
			if(!empty($post['id_harga']))
				$data['id_harga'] = $post['id_harga'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['kecamatan']))
				$data['kecamatan'] = $post['kecamatan'];
			else
				$error[] = "kecamatan tidak boleh kosong"; 
			
			if(!empty($post['harga']))
				$data['harga'] = $post['harga'];
			else
				$error[] = "telepon tidak boleh kosong"; 
			
			if(!empty($post['moda']))
				$data['moda'] = $post['moda'];
			else
				$error[] = "moda tidak boleh kosong"; 
			
					
			if(empty($error))
			{
				if(empty($id))
				{
					$cekharga = $this->harga_model->get_by("id_harga",$post['id_harga']);
					if(!empty($cekharga))
						$error[] = "id sudah terdaftar"; 
				}
			}
			
			if(empty($error))
			{
				$save = $this->harga_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("harga/manage/".$id);
				else
					redirect("harga");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("harga/manage/".$id);
			}
		}
		else
		  redirect("harga");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->harga_model->get_by("id_harga",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("harga");
			}
			else
			{
				// $cek = $this->harga_model->cekAvalaible($id);
				// if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("harga");
				// }
				// else
				{
					$this->harga_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("harga");
				}
			}
		}
		else
			redirect("harga");
	}
	
	public function export_excel(){
		// $this->export($action, $data['data']);
		$data = array( 'title' => 'Laporan Data Harga',
		'harga' => $this->harga_model->listing());
		$data['title'] = "Rekap Data Harga";
		$data['data'] = $this->harga_model->getData($data);
		// $data['data'] = $this->kurir_model->tampil_data($data);
		$data['date'] = date('y-m-d');
		$this->load->view('harga/export',$data);
		}
	   
	
	public function generate_code()
	{
		$prefix = "HRG";
		$code = "01";
		
		$last = $this->harga_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_harga,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
