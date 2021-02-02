<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("slider_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA KATEGORI";
		$data['layout'] = "slider/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->slider_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("slider?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		$this->load->view('template',$data);
	}
	
	public function add()
    {
        $slider = $this->slider_model;
        $validation = $this->form_validation;
        $validation->set_rules($slider->rules());

        if ($validation->run()) {
            $slider->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("template");
    }


	public function manage($id = "")
	{
		$data['title'] = "FORM KATEGORI";
		$data['layout'] = "slider/manage";

		$data['data'] = new StdClass();
		$data['data']->id_slider = "";
		$data['data']->nama_slider = "";
		$data['data']->keterangan = "";
		$data['data']->foto_slider = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->slider_model->get_by("id_slider",$id,true);
			if(!empty($dt))
				$data['data'] = $dt;
		}
		
		$this->load->view('template',$data);
	}
	
	public function save()
	{
		$data = array();
		$post = $this->input->post();
		$this->foto_slider = $this->do_upload();

		if($post)
		{
			$error = array();
			$id = $post['id'];
			
			if(!empty($post['id_slider']))
				$data['id_slider'] = $post['id_slider'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_slider']))
				$data['nama_slider'] = $post['nama_slider'];
			else
				$error[] = "nama Slider tidak boleh kosong"; 
			
			if(!empty($post['keterangan']))
				$data['keterangan'] = $post['keterangan'];
			else
				$error[] = "keterangan tidak boleh kosong"; 
			
			// if(!empty($post['foto_slider']))
			// 	$data['foto_slider'] = $post['foto_slider'];
			// 	else
			// 	$error[] = "gambar tidak boleh kosong"; 
				
			if(empty($error))
			{
				if(empty($id))
				{
					$cekslider = $this->slider_model->get_by("id_slider",$post['id_slider']);
					if(!empty($cekslider))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->slider_model->get_by("nama_slider",$post['nama_slider']);
					if(!empty($cek))
						$error[] = "nama Slider sudah terdaftar"; 
				}
				else
				{
					$cek = $this->slider_model->cekName($id,$post['nama_slider']);
					if(!empty($cek))
						$error[] = "nama sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->slider_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("slider/manage/".$id);
				else
					redirect("slider");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("slider/manage/".$id);
			}
		}
		else
		  redirect("slider");
	}
	
	private function do_upload()
		{
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			// $config['foto_slider']            = $this->id_slider;
			$config['overwrite']			= true;
			$config['max_size']             = 1024; // 1MB
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto_slider')) {
				
				$gbr = $this->upload->data();
				$foto_slider=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
				// $judul=strip_tags($this->input->post('judul'));
				// $this->slider_model->simpan_upload($judul,$gambar);
				echo "Upload Berhasil";
			
			}
		}
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->slider_model->get_by("id_slider",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("slider");
			}
			else
			{
				$cek = $this->slider_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("slider");
				// }
				// else
				{
					$this->slider_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("slider");
				}
			}
		}
		else
			redirect("slider");
	}
	
	public function generate_code()
	{
		$prefix = "SLD";
		$code = "01";
		
		$last = $this->slider_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_slider,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
