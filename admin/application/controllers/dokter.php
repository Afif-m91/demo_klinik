<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dokter extends Admin_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model("dokter_model");
		$this->cekLoginStatus("admin",true);
		$this->load->library('pdf');
    }
	public function index()
	{
		$data['title'] = "DATA DOKTER";
		$data['layout'] = "dokter/index";

		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));

		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');

		$limit = 15;
		if(!$page)
			$page = 1;

		$offset = ($page-1) * $limit;

		list($data['data'],$total) = $this->dokter_model->getAll($filter,$limit,$offset,$orderBy,$orderType);

		$this->load->library('pagination');
		$config['base_url'] = site_url("dokter?");
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
		$data['title'] = "FORM DOKTER";
		$data['layout'] = "dokter/manage";

		$data['data'] = new StdClass();
		$data['data']->id_dokter = "";
		$data['data']->nama_dokter = "";
		$data['data']->jenis_kelamin = "";
		$data['data']->id_spesialis = "";
		$data['data']->telepon = "";
		$data['data']->alamat = "";
		$data['data']->nama_spesialis = "";
		$data['data']->tgl_dokter = "";
		$data['data']->autocode = $this->generate_code();

		if($id)
		{
			$row =  $this->dokter_model->get_by("id_dokter",$id,true);
			if(!empty($row))
				$data['data'] = $row;
		}
		$this->load->model("spesialis_model");
		list($data['spesialis'],$total) = $this->spesialis_model->getAll(null,null,null,null,null);

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

			if(!empty($post['id_dokter']))
				$data['id_dokter'] = $post['id_dokter'];
			else
				$error[] = "id tidak boleh kosong";

			if(!empty($post['nama_dokter']))
				$data['nama_dokter'] = $post['nama_dokter'];
			else
				$error[] = "nama tidak boleh kosong";

				if(!empty($post['tgl_dokter']))
				$data['tgl_dokter'] = $post['tgl_dokter'];
			// else
			// 	$error[] = "Tanggal tidak boleh kosong";


			if(!empty($post['jenis_kelamin']))
				$data['jenis_kelamin'] = $post['jenis_kelamin'];
			// else
			// 	$error[] = "spesialis tidak boleh kosong";

			if(!empty($post['telepon']))
				$data['telepon'] = $post['telepon'];
			else
				$error[] = "telepon tidak boleh kosong";

			if(!empty($post['alamat']))
				$data['alamat'] = $post['alamat'];
			else
				$error[] = "alamat tidak boleh kosong";

			
			if(!empty($post['nama_spesialis']))
				$data['nama_spesialis'] = $post['nama_spesialis'];
			// else
			// 	$error[] = "del no tidak boleh kosong";

			// if(empty($error))
			// {
			// 	if(empty($id))
			// 	{
			// 		$cekdokter = $this->dokter_model->get_by("id_dokter",$post['id_dokter']);
			// 		if(!empty($cekdokter))
			// 			$error[] = "id sudah terdaftar";

			// 		$cek = $this->dokter_model->get_by("b.nama",$post['nama']);
			// 		if(!empty($cek))
			// 			$error[] = "nama sudah terdaftar";
			// 	}
			// 	else
			// 	{
			// 		$cek = $this->dokter_model->cekName($id,$post['nama']);
			// 		if(!empty($cek))
			// 			$error[] = "nama sudah terdaftar";
			// 	}
			// }

			if(empty($error))
			{
				$save = $this->dokter_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");

				if($post['action'] == "save")
					redirect("dokter/manage/".$id);
				else
					redirect("dokter");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";

				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("dokter/manage/".$id);
			}
		}
		else
		  redirect("dokter");
	}

	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->dokter_model->get_by("id_dokter",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("dokter");
			}
			else
			{
				$cek = $this->dokter_model->cekAvalaible($id);
				if(!empty($cek))
				// {
				// 	$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
				// 	redirect("dokter");
				// }
				// else
				{
					$this->dokter_model->remove($id);

					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("dokter");
				}
			}
		}
		else
			redirect("dokter");
	}

	public function generate_code()
	{
		$prefix = "DKR";
		$code = "0001";

		$last = $this->dokter_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_dokter,3,4) +1;
			$code = str_pad($number, 4, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}

	public  function cetak($id)
	{
		$this->cekLoginStatus("staff gudang",true);

		$data['title'] = "CETAK PENGIRIMAN";
		$data['layout'] = "dokter/cetak";

		$this->load->library("qrcodeci");
		if($id)
		{
			$row =  $this->dokter_model->get_by("b.id_dokter",$id,true);
			if($row)
			{
				$this->qrcodeci->generate($row->id_dokter);
				$data['data'] = $row;
				$this->load->view('blank',$data);
			}
			else
			{
				redirect("dokter");
			}

		}
		else
		{
			redirect("dokter");
		}
	}

	// Halaman Laporan Stok dokter
	public function rekap()
	{
    $data = $this->input->get(null, true);
		$this->cekLoginStatus("finance",true);

		$data['title'] = "Laporan Stok dokter";
		$data['layout'] = "dokter/rekap";

		$action = $this->input->get('action');

		$from = $this->input->get('from');
		$to = $this->input->get('to');

		$id_dokter = $this->input->get('id_dokter');

		if(!$from) {
			$from = date('y-m-d',strtotime("-30 days"));
    }

		if(!$to) {
			$to = date("y-m-d");
    }

		if(!$id_dokter) {
			$id_dokter = "all";
    }

		$filter = new StdClass();
		$filter->from = date('y-m-d',strtotime($from));
		$filter->to = date('y-m-d',strtotime($to));
		$filter->id_dokter = $id_dokter;

    list($data['data'],$total) = $this->dokter_model->getAll($filter,0,0,"b.id_dokter","desc");
    $data['dokter'] = $this->dokter_model->getItemId();
    $data['data'] = $this->dokter_model->getData($data);

	if($action === 'excel') {
		$this->export($action, $data['data'], $filter);
		$data['title'] = "Rekap Stok dokter";
		$data['date'] = date('y-m-d');
		$this->load->view('dokter/export',$data);
	} else if($action === 'pdf') {
		$this->_laporan_pdf($data['data']);
	} else {
      $this->load->view('template',$data);
    }
  }
  
  public function _laporan_pdf($data)
    {
		$tanggal = date('d-m-Y');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('P','A4');
        $pdf->Image('assets/images/261218spl-logo.png',15,10,30,17);
		// $pdf->Cell(190, 7,'DATA PENGIRIMAN_'.$tanggal, 0, 1, 'L');
		$pdf->SetFont("", "B", 15);
		$pdf->Cell(0, 10, 'PT. SINARMAS PELANGI', 0, 1,'C');
		$pdf->SetFont("", "", 9);
		$pdf->Cell(0, 6, 'Alamat: Jl. Tanah Tinggi Timur No. 1 A, ', 0, 1,'C');
		$pdf->Cell(0, 2, 'Harapan Mulia Kemayoran, Jakarta Pusat, Indonesia 10640', 0, 1,'C');
		$pdf->SetFont("","B",15);
		// $pdf->Cell(0, 1, '________________________________________________________________', 0, 1,'C');
		$pdf->Cell(0, 0, '________________________________________________________________', 0, 1,'C');
		$pdf->Ln(2);
		
		$pdf->SetFont("", "B", 13);
		$pdf->Cell(0, 15, 'LAPORAN DATA PENGIRIMAN_'.$tanggal, 0, 1,'C');
		// $pdf->Cell(0,2, '', 0, 1);
		$pdf->SetFont("", "B", 10);
				
		$pdf->SetFillColor(70,130,180);
		$pdf->SetDrawColor(25,25,12);
		// $pdf->SetTextColor(255,255,255);
		
		$pdf->Cell(10, 6, 'No', 1, 0,'C');
		$pdf->Cell(25, 6, 'ID dokter', 1, 0,'C');
		$pdf->Cell(40, 6, 'Nama dokter', 1, 0,'C');
		$pdf->Cell(30, 6, 'Satuan', 1, 0,'C');
		$pdf->Cell(20, 6, 'Del No', 1, 0,'C');
		$pdf->Cell(30, 6, 'ID spesialis', 1, 0,'C');
		// $pdf->Cell(30, 6, 'Nama spesialis', 1, 0);
		$pdf->Cell(30, 6, 'Tanggal', 1, 1,'C');
		$pdf->SetFont('','',10);
		$no = 1;
		
        foreach ($data as $row){
			$pdf->Cell(10,6,$no++,1,0);
            $pdf->Cell(25,6,$row->id_dokter,1,0);
            $pdf->Cell(40,6,$row->nama,1,0);
            $pdf->Cell(30,6,$row->satuan,1,0);
			$pdf->Cell(20,6,$row->del_no,1,0);
			$pdf->Cell(30,6,$row->id_spesialis,1,0);
			// $pdf->Cell(30,6,$row->nama_spesialis,1,0);
            $pdf->Cell(30,6,$row->tgl_dokter,1,1);
        }
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$tanggal= date('y-m-d');
        $pdf->Output('Data_Kurir_'.$tanggal.'.pdf', 'I');
    }

  public function formRekap()
  {
    $this->cekLoginStatus("finance",true);

	$data['title'] = "Laporan Stok dokter";
    $data['layout'] = "dokter/rekap";
    $data['id_dokter'] = 'all';
    $data['from'] = date('y-m-d');
    $data['to'] = date('y-m-d');
    $data['data'] = $this->dokter_model->getData($data);
    $this->load->view('template', $data);
  }


	public function export($action,$data,$filter)
	{
		$this->cekLoginStatus("finance",true);

		$title = "Laporan Data dokter ";
		$file_name = $title."_".date("Y-m-d");
		$headerTitle = $title;

		if(empty($data))
		{
			$this->session->set_flashdata('admin_save_error', "data tidak tersedia");
			redirect("dokter/rekap?from=".$filter->from."&to=".$filter->to."&id_dokter=".$filter->id_dokter."");
		}
  }

	public function generate_format($data)
	{

		$newdata = array();
		$grantotal = 0;
		foreach ($data as $row) { ?>
			<tr>
			  <td><?php echo $row->id_dokter; ?></td>
			  <td><?php echo $row->tgl_dokter; ?></td>
			  <td><?php echo $row->nama; ?></td>
			  <td><?php echo $row->satuan; ?></td>
			  <td><?php echo $row->del_no; ?></td>
			  <td><?php echo $row->id_spesialis; ?></td>
			  <td><?php echo $row->nama_spesialis; ?></td>
			</tr>
		  <?php }
			$newdata[] = $dat;

	}
}
