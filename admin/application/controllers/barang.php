<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang extends Admin_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model("barang_model");
		$this->cekLoginStatus("admin",true);
		$this->load->library('pdf');
    }
	public function index()
	{
		$data['title'] = "DATA BARANG";
		$data['layout'] = "barang/index";

		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));

		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');

		$limit = 15;
		if(!$page)
			$page = 1;

		$offset = ($page-1) * $limit;

		list($data['data'],$total) = $this->barang_model->getAll($filter,$limit,$offset,$orderBy,$orderType);

		$this->load->library('pagination');
		$config['base_url'] = site_url("barang?");
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
		$data['title'] = "FORM BARANG";
		$data['layout'] = "barang/manage";

		$data['data'] = new StdClass();
		$data['data']->id_barang = "";
		$data['data']->nama = "";
		$data['data']->id_kategori = "";
		$data['data']->satuan = "";
		$data['data']->del_no = "";
		$data['data']->nama_kategori = "";
		$data['data']->tgl_barang = "";
		$data['data']->autocode = $this->generate_code();

		if($id)
		{
			$row =  $this->barang_model->get_by("id_barang",$id,true);
			if(!empty($row))
				$data['data'] = $row;
		}
		$this->load->model("kategori_model");
		list($data['kategori'],$total) = $this->kategori_model->getAll(null,null,null,null,null);

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

			if(!empty($post['id_barang']))
				$data['id_barang'] = $post['id_barang'];
			else
				$error[] = "id tidak boleh kosong";

			if(!empty($post['nama']))
				$data['nama'] = $post['nama'];
			else
				$error[] = "nama tidak boleh kosong";

				if(!empty($post['tgl_barang']))
				$data['tgl_barang'] = $post['tgl_barang'];
			// else
			// 	$error[] = "Tanggal tidak boleh kosong";


			if(!empty($post['id_kategori']))
				$data['id_kategori'] = $post['id_kategori'];
			else
				$error[] = "kategori tidak boleh kosong";

			if(!empty($post['satuan']))
				$data['satuan'] = $post['satuan'];
			else
				$error[] = "satuan tidak boleh kosong";

			if(!empty($post['del_no']))
				$data['del_no'] = $post['del_no'];
			else
				$error[] = "del no tidak boleh kosong";

			
			if(!empty($post['nama_kategori']))
				$data['nama_kategori'] = $post['nama_kategori'];
			// else
			// 	$error[] = "del no tidak boleh kosong";

			// if(empty($error))
			// {
			// 	if(empty($id))
			// 	{
			// 		$cekbarang = $this->barang_model->get_by("id_barang",$post['id_barang']);
			// 		if(!empty($cekbarang))
			// 			$error[] = "id sudah terdaftar";

			// 		$cek = $this->barang_model->get_by("b.nama",$post['nama']);
			// 		if(!empty($cek))
			// 			$error[] = "nama sudah terdaftar";
			// 	}
			// 	else
			// 	{
			// 		$cek = $this->barang_model->cekName($id,$post['nama']);
			// 		if(!empty($cek))
			// 			$error[] = "nama sudah terdaftar";
			// 	}
			// }

			if(empty($error))
			{
				$save = $this->barang_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");

				if($post['action'] == "save")
					redirect("barang/manage/".$id);
				else
					redirect("barang");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";

				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("barang/manage/".$id);
			}
		}
		else
		  redirect("barang");
	}

	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->barang_model->get_by("id_barang",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("barang");
			}
			else
			{
				$cek = $this->barang_model->cekAvalaible($id);
				if(!empty($cek))
				{
					$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
					redirect("barang");
				}
				else
				{
					$this->barang_model->remove($id);

					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("barang");
				}
			}
		}
		else
			redirect("barang");
	}

	public function generate_code()
	{
		$prefix = "BRG";
		$code = "0001";

		$last = $this->barang_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_barang,3,4) +1;
			$code = str_pad($number, 4, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}

	public  function cetak($id)
	{
		$this->cekLoginStatus("staff gudang",true);

		$data['title'] = "CETAK PENGIRIMAN";
		$data['layout'] = "barang/cetak";

		$this->load->library("qrcodeci");
		if($id)
		{
			$row =  $this->barang_model->get_by("b.id_barang",$id,true);
			if($row)
			{
				$this->qrcodeci->generate($row->id_barang);
				$data['data'] = $row;
				$this->load->view('blank',$data);
			}
			else
			{
				redirect("barang");
			}

		}
		else
		{
			redirect("barang");
		}
	}

	// Halaman Laporan Stok Barang
	public function rekap()
	{
    $data = $this->input->get(null, true);
		$this->cekLoginStatus("finance",true);

		$data['title'] = "Laporan Stok Barang";
		$data['layout'] = "barang/rekap";

		$action = $this->input->get('action');

		$from = $this->input->get('from');
		$to = $this->input->get('to');

		$id_barang = $this->input->get('id_barang');

		if(!$from) {
			$from = date('y-m-d',strtotime("-30 days"));
    }

		if(!$to) {
			$to = date("y-m-d");
    }

		if(!$id_barang) {
			$id_barang = "all";
    }

		$filter = new StdClass();
		$filter->from = date('y-m-d',strtotime($from));
		$filter->to = date('y-m-d',strtotime($to));
		$filter->id_barang = $id_barang;

    list($data['data'],$total) = $this->barang_model->getAll($filter,0,0,"b.id_barang","desc");
    $data['barang'] = $this->barang_model->getItemId();
    $data['data'] = $this->barang_model->getData($data);

	if($action === 'excel') {
		$this->export($action, $data['data'], $filter);
		$data['title'] = "Rekap Stok Barang";
		$data['date'] = date('y-m-d');
		$this->load->view('barang/export',$data);
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
		$pdf->Cell(25, 6, 'ID Barang', 1, 0,'C');
		$pdf->Cell(40, 6, 'Nama Barang', 1, 0,'C');
		$pdf->Cell(30, 6, 'Satuan', 1, 0,'C');
		$pdf->Cell(20, 6, 'Del No', 1, 0,'C');
		$pdf->Cell(30, 6, 'ID Kategori', 1, 0,'C');
		// $pdf->Cell(30, 6, 'Nama Kategori', 1, 0);
		$pdf->Cell(30, 6, 'Tanggal', 1, 1,'C');
		$pdf->SetFont('','',10);
		$no = 1;
		
        foreach ($data as $row){
			$pdf->Cell(10,6,$no++,1,0);
            $pdf->Cell(25,6,$row->id_barang,1,0);
            $pdf->Cell(40,6,$row->nama,1,0);
            $pdf->Cell(30,6,$row->satuan,1,0);
			$pdf->Cell(20,6,$row->del_no,1,0);
			$pdf->Cell(30,6,$row->id_kategori,1,0);
			// $pdf->Cell(30,6,$row->nama_kategori,1,0);
            $pdf->Cell(30,6,$row->tgl_barang,1,1);
        }
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$tanggal= date('y-m-d');
        $pdf->Output('Data_Kurir_'.$tanggal.'.pdf', 'I');
    }

  public function formRekap()
  {
    $this->cekLoginStatus("finance",true);

	$data['title'] = "Laporan Stok Barang";
    $data['layout'] = "barang/rekap";
    $data['id_barang'] = 'all';
    $data['from'] = date('y-m-d');
    $data['to'] = date('y-m-d');
    $data['data'] = $this->barang_model->getData($data);
    $this->load->view('template', $data);
  }


	public function export($action,$data,$filter)
	{
		$this->cekLoginStatus("finance",true);

		$title = "Laporan Data Barang ";
		$file_name = $title."_".date("Y-m-d");
		$headerTitle = $title;

		if(empty($data))
		{
			$this->session->set_flashdata('admin_save_error', "data tidak tersedia");
			redirect("barang/rekap?from=".$filter->from."&to=".$filter->to."&id_barang=".$filter->id_barang."");
		}
  }

	public function generate_format($data)
	{

		$newdata = array();
		$grantotal = 0;
		foreach ($data as $row) { ?>
			<tr>
			  <td><?php echo $row->id_barang; ?></td>
			  <td><?php echo $row->tgl_barang; ?></td>
			  <td><?php echo $row->nama; ?></td>
			  <td><?php echo $row->satuan; ?></td>
			  <td><?php echo $row->del_no; ?></td>
			  <td><?php echo $row->id_kategori; ?></td>
			  <td><?php echo $row->nama_kategori; ?></td>
			</tr>
		  <?php }
			$newdata[] = $dat;

	}
}
