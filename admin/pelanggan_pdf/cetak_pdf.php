<?php

error_reporting(0);

require_once("fpdf/fpdf.php");

class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'A4',
  		'orientation'=>'P'
  	);
  	
  	function __construct($data = array(), $options = array()) {
    	parent::__construct();
    	$this->data = $data;
    	$this->options = $options;
	}
	
	public function rptDetailData () {
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
		# untuk menuliskan nama bulan dengan format Indonesia
		$bln = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		  );
		//header
		$this->Image('img/261218spl-logo.png',40,25,80,45);
		$this->SetFont("", "B", 15);
		$this->SetX($left); $this->Cell(0, 20, 'PT. SINARMAS PELANGI', 0, 1,'C');
		$this->SetFont("", "", 9);
		$this->SetX($left); $this->Cell(0, 20, 'Alamat: Jl. Tanah Tinggi Timur No. 1 A', 0, 1,'C');
		$this->SetX($left); $this->Cell(0, 10, 'Harapan Mulia Kemayoran, Jakarta Pusat, Indonesia 10640', 0, 1,'C');
		$this->SetFont("", "", 15);
		$this->SetX($left); $this->Cell(0, 1, '________________________________________________________________', 0, 1,'C');
		$this->SetX($left); $this->Cell(0, 2, '________________________________________________________________', 0, 1,'C');
		$this->Ln(10);
		$this->Ln(10);
		$this->SetFont("", "B", 12);
		$this->SetX($left); $this->Cell(0, 15, 'LAPORAN DATA PELANGGAN_ '.date('d').' '.$bln[date('m')].' '.date('Y').'', 0, 1,'C');
		// $this->SetX($left); $this->Cell(0, 20, 'LAPORAN DATA PELANGGAN_', 0, 1,'C');
		$this->Ln(10);
		
		$h = 18;
		$left = 40;
		$top = 80;	
		#tableheader
		$this->SetFillColor(200,200,200);	
		$left = $this->GetX();
		$this->SetFont("", "B", 10);
		$this->Cell(23,$h,'NO',1,0,'L',true);
		$this->SetX($left += 23); $this->Cell(90, $h, 'ID PELANGGAN', 1, 0, 'L',true);
		$this->SetX($left += 85); $this->Cell(120, $h, 'NAMA PELANGGAN', 1, 0, 'C',true);
		$this->SetX($left += 120); $this->Cell(100, $h, 'TELEPON', 1, 0, 'C',true);
		$this->SetX($left += 100); $this->Cell(200, $h, 'ALAMAT', 1, 1, 'C',true);
		
		//$this->Ln(20);
		
		$this->SetFont('Arial','',9);
		$this->SetWidths(array(23,85,120,100,200));
		$this->SetAligns(array('C','L','L','L','L','L'));
		$no = 1; $this->SetFillColor(255);

		#data dari database
		mysql_connect("localhost","root","");
		mysql_select_db("pengiriman");

	    $sql = mysql_query("select * from pelanggan");
	    while($data = mysql_fetch_array($sql))
	    {
	      $this->Row(
	        array($no++,
	        $data['id_pelanggan'], 
	        $data['nama'], 
	        $data['telepon'], 
	        $data['alamat'], 
	       
	      ));
	    }

		# untuk menuliskan nama bulan dengan format Indonesia
		$bln = array(
		  '01' => 'Januari',
		  '02' => 'Februari',
		  '03' => 'Maret',
		  '04' => 'April',
		  '05' => 'Mei',
		  '06' => 'Juni',
		  '07' => 'Juli',
		  '08' => 'Agustus',
		  '09' => 'September',
		  '10' => 'Oktober',
		  '11' => 'November',
		  '12' => 'Desember'
		);

		#tabel footer
		// $this->Ln(20);
		// $this->SetFont("", "", 9);
		// $this->SetX(400); $this->Cell(0, 15, 'Payakumbuh Barat, '.date('d').' '.$bln[date('m')].' '.date('Y').'', 0, 1,'C');
		// $this->SetX(400); $this->Cell(0, 15, 'DIREKTUR', 0, 1,'C');
		// $this->Ln(40);
		// $this->SetX(400); $this->Cell(0, 20, 'ARIE, S.Kom, M.Kom', 0, 1,'C');
	}

	public function printPDF () {
		$data['date'] = date('y-m-d');
		if ($this->options['paper_size'] == "A4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
		
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();
	
		$this->rptDetailData();
		$tanggal = date('y-m-d');
		$this->Output('Data_Pelanggan_'.$tanggal.'.pdf', 'I');
	    // $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
  	
  	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=15*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,15,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class

//pilihan
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
