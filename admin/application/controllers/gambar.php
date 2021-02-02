<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gambar extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('gambar_model');
		// $this->load->database();
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA GAMBAR";
		$data['layout'] = "gambar/index";
		$data['datas'] 	=	$this->gambar_model->get('slider1');
		
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

	public function tambah(){
		$data = array();
		$data['title'] = "FORM GAMBAR";
		$data['layout'] = "gambar/manage";

		
		
		
		if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
			// lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
			$upload = $this->GambarModel->upload();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->GambarModel->save($upload);
				
				redirect('gambar'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->load->view('template', $data);
	}

	public function edit($id="")
	{
		$data['title'] = "FORM KATEGORI";
		$data['layout'] = "gambar/edit";

		$this->load->view('template',$data);

			// //jika ada gambar yg diupload
			// if ($_FILES['foto_slider']['name']) 
			// {
			//  $config = [
			// 	'allowed_types' => 'jpg|png|gif',
			// 	'max_size' 		=> 2048,
			// 	'upload_path' 	=> './assets/image/', ];

			// 		$this->load->library('upload',$config);
			// 	//jk upload berhasil
			// 	if ($this->upload->do_upload('foto_slider'))
			// 	{
			// 	$gambar_fix = $this->upload->data('file_name');

			// 	$data = $this->gambar_model->get_where('slider1',['id_slider' => $id]);

			// 	//jika photo lama default1.png
			// 	if ($data['foto_slider'] != 'default1.png' ) {
			// 		//menghapus file di assets/img/
			// 	unlink('./assets/image/'.$data['foto_slider']);
			// 	}
				
			// 	//jk gagal upload
			// 	} else 
			// 	{
			// 	$this->session->set_flashdata('pesan','Upload gambar gagal silahkan coba lagi !!!');
			// 			redirect('gambar');
			// 	}
				
			// }else 
			// {
			//  	$data['datas']   = $this->gambar_model->get_where('slider1',['id_slider' => $id]) ;
			//  	$gambar_fix = $data['datas']['foto_slider'];
			// }
			  
			

			// $data=
			// 	[	'nama_slider' 			=> ucwords($this->input->post('nama_slider')),
			// 		// 'ukuran' 		=> $this->input->post('ukuran'),
			// 		// 'isi_perpack' 	=> $this->input->post('isi_perpack'),
			// 		'foto_slider'		=> $gambar_fix,
			// 		// 'harga_satuan' 	=> str_replace(".", "",$this->input->post('harga_satuan') ),
			// 		// 'harga_perpack' => str_replace(".", "", $this->input->post('harga_perpack') ),
			// 		'keterangan' 	=> $this->input->post('keterangan'),
			// 	];
			// 		$this->gambar_model->update('slider1',$data,['id_slider' => $id]);
			// 		$this->session->set_flashdata('pesan','Edit Data slider1 Berhasil !!!');
			// 		redirect('gambar');
		
		
		

	}

	
	
	// public function save()
	// {
	// 	$data = array();
	// 	$post = $this->input->post();
	

	// 	if($post)
	// 	{
	// 		$error = array();
	// 		$id = $post['id'];
			
	// 		if(!empty($post['id_slider']))
	// 			$data['id_slider'] = $post['id_slider'];
	// 		else
	// 			$error[] = "id tidak boleh kosong"; 
				
	// 		if(!empty($post['nama_slider']))
	// 			$data['nama_slider'] = $post['nama_slider'];
	// 		else
	// 			$error[] = "nama Slider tidak boleh kosong"; 
			
	// 		if(!empty($post['keterangan']))
	// 			$data['keterangan'] = $post['keterangan'];
	// 		else
	// 			$error[] = "keterangan tidak boleh kosong"; 
			
	// 		if(!empty($post['foto_slider']))
	// 			$data['foto_slider'] = $post['foto_slider'];
	// 			else
	// 			$error[] = "gambar tidak boleh kosong"; 
				
	// 		if(empty($error))
	// 		{
	// 			if(empty($id))
	// 			{
	// 				$cekslider = $this->slider_model->get_by("id_slider",$post['id_slider']);
	// 				if(!empty($cekslider))
	// 					$error[] = "id sudah terdaftar"; 
					
	// 				$cek = $this->slider_model->get_by("nama_slider",$post['nama_slider']);
	// 				if(!empty($cek))
	// 					$error[] = "nama Slider sudah terdaftar"; 
	// 			}
	// 			else
	// 			{
	// 				$cek = $this->slider_model->cekName($id,$post['nama_slider']);
	// 				if(!empty($cek))
	// 					$error[] = "nama sudah terdaftar";
	// 			}	
	// 		}
			
	// 		if(empty($error))
	// 		{
	// 			$save = $this->slider_model->save($id,$data,false);
	// 			$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
	// 			if($post['action'] == "save")
	// 				redirect("gambar/manage/".$id);
	// 			else
	// 				redirect("gambar");
	// 		}
	// 		else
	// 		{
	// 			$err_string = "<ul>";
	// 			foreach($error as $err)
	// 				$err_string .= "<li>".$err."</li>";
	// 			$err_string .= "</ul>";
				
	// 			$this->session->set_flashdata('admin_save_error', $err_string);
	// 			redirect("gambar/manage/".$id);
	// 		}
	// 	}
	// 	else
	// 	  redirect("gambar");
	// }
	
	public function save()
	{
				//jika user up;oad gambar
			if ($_FILES['foto_slider']['name']) 
			{
				$config = [
							'allowed_types' => 'jpg|png|gif',
							'max_size'		=> 2048,
							'upload_path'	=> './uploads/',
							];

							$this->load->library('upload',$config);
							if ($this->upload->do_upload('foto_slider')) 
							{
								$foto_slider_fix = $this->upload->data('file_name');
							} else 
							{
								$this->session->set_flashdata('pesan','Upload gambar gagal silahkan coba lagi !!!');
							redirect('gambar');
							}
								
			} 

			else 
			{
				$foto_slider_fix = 'default1.png';	
			}
			
					$data =
					[ 	'nama_slider' 	=> ucwords($this->input->post('nama_slider')),
						// 'ukuran' 		=> $this->input->post('ukuran'),
						// 'isi_perpack' 	=> $this->input->post('isi_perpack'),
						'keterangan' 	=> $this->input->post('keterangan'),
						'foto_slider' 	=> $this->input->post('foto_slider'),
						// 'foto_slider' 	=> $foto_slider_fix,
						// 'foto_slider' => $this->upload->data("file_name"),
						// 'harga_perpack' => str_replace(".", "", $this->input->post('harga_perpack') ),
						
					];
					echo '<pre>';
					print_r($data);
					echo '</pre>';
		
					$this->gambar_model->insert('slider1',$data);
					$this->session->set_flashdata('pesan','Data slider1 Berhasil ditambahkan !!!');
					redirect('gambar');
			
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
	
	// public function generate_code()
	// {
	// 	$prefix = "SLD";
	// 	$code = "01";
		
	// 	$last = $this->gambar_model->get_last();
	// 	if(!empty($last))
	// 	{
	// 		$number = substr($last->id_slider,3,2) +1;
	// 		$code = str_pad($number, 2, "0", STR_PAD_LEFT);
	// 	}
	// 	return $prefix.$code;
	// }
	
}
