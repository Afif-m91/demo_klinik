<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pasien extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("pasien_model");
		$this->cekLoginStatus("admin",true);
		$this->load->library('pdf');
    }
	
	public function index()
	{
		$data['title'] = "DATA PASIEN";
		$data['layout'] = "pasien/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->pasien_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("pasien?");
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
		$data['title'] = "FORM PASIEN";
		$data['layout'] = "pasien/manage";

		$data['data'] = new StdClass();
		$data['data']->id_pasien = "";
		$data['data']->nama_pasien = "";
		$data['data']->no_hp = "";
		$data['data']->jenis_kelamin = "";
		$data['data']->alamat = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->pasien_model->get_by("id_pasien",$id,true);
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
			
			if(!empty($post['id_pasien']))
				$data['id_pasien'] = $post['id_pasien'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['nama_pasien']))
				$data['nama_pasien'] = $post['nama_pasien'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
			if(!empty($post['no_hp']))
				$data['no_hp'] = $post['no_hp'];
			else
				$error[] = "telepon tidak boleh kosong"; 
			
			if(!empty($post['jenis_kelamin']))
				$data['jenis_kelamin'] = $post['jenis_kelamin'];
			else
				$error[] = "jenis kelamin tidak boleh kosong"; 
			
			if(!empty($post['alamat']))
				$data['alamat'] = $post['alamat'];
			else
				$error[] = "alamat tidak boleh kosong"; 
			
			// if(empty($id))
			// {
			// 	if(!empty($post['password']))
			// 		$data['password'] = md5($post['password']);
			// 	else
			// 		$error[] = "password tidak boleh kosong";
			// }
			// else
			// {
			// 	if(!empty($post['password']))
			// 		$data['password'] = md5($post['password']);
			// }
			
			if(empty($error))
			{
				if(empty($id))
				{
					$cekpasien = $this->pasien_model->get_by("id_pasien",$post['id_pasien']);
					if(!empty($cekpasien))
						$error[] = "id sudah terdaftar"; 
				}
			}
			
			if(empty($error))
			{
				$save = $this->pasien_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("pasien/manage/".$id);
				else
					redirect("pasien");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("pasien/manage/".$id);
			}
		}
		else
		  redirect("pasien");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->pasien_model->get_by("id_pasien",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("pasien");
			}
			else
			{
				$cek = $this->pasien_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("pasien");
				// }
				// else
				{
					$this->pasien_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("pasien");
				}
			}
		}
		else
			redirect("pasien");
	}
	
	public function export_excel(){
		// $this->export($action, $data['data']);
		$data = array( 'title' => 'Laporan Data pasien',
		'pasien' => $this->pasien_model->listing());
		$data['title'] = "Rekap Stok Barang";
		$data['data'] = $this->pasien_model->getData($data);
		// $data['data'] = $this->pasien_model->tampil_data($data);
		$data['date'] = date('y-m-d');
		$this->load->view('pasien/export',$data);
		}
	   
	public function laporan_pdf()
    {
		$tanggal = date('d-m-Y');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
		$pdf->Cell(190,7,'DATA pasien_'.$tanggal,0,1,'C');
		$pdf->SetFont('');
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(10,6,'No',1,0);
		$pdf->Cell(25,6,'ID pasien',1,0);
		$pdf->Cell(35,6,'Nama pasien',1,0);
		$pdf->Cell(40,6,'Jenis Kelamin',1,0);
		$pdf->Cell(70,6,'Alamat',1,1);
		$pdf->SetFont('','',10);
		$mahasiswa = $this->db->get('pasien')->result();
		$no = 1;
        foreach ($mahasiswa as $row){
			$pdf->Cell(10,6,$no++,1,0);
            $pdf->Cell(25,6,$row->id_pasien,1,0);
            $pdf->Cell(35,6,$row->nama,1,0);
            $pdf->Cell(40,6,$row->jenis_kelamin,1,0);
            $pdf->Cell(70,6,$row->alamat,1,1); 
        }
    
		$tanggal= date('y-m-d');
        $pdf->Output('Data_pasien_'.$tanggal.'.pdf', 'I');
    }
 

	public function generate_code()
	{
		$prefix = "PAS";
		$code = "001";
		
		$last = $this->pasien_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_pasien,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
