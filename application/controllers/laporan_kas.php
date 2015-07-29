<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_kas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('homemodel');
		$this->load->model('lapkasmodel');
		session_start ();
	}

	public function index()
	{
		if($this->auth->is_logged_in () == false)
		{
			$this->login();
		}
		else
		{
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
		}
	}

	

	 function lap_kas_user(){

		$this->auth->restrict ();
		$this->auth->cek_menu ( 20 );

		if(isset($_POST["btnLihat"])){
			$this->show_lap_kas();
		}else{
			$timestamp = strtotime($this->session->userdata('tglD'));
			$tgl_trans = date('Y-m-d', $timestamp);
			
			$data['judul']='Laporan Kas User';
			
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['data_kas'] = $this->lapkasmodel->get_data_kas_user_grid ($tgl_trans,$this->session->userdata('user_id'));
			$this->template->set ( 'title', 'Laporan Kas User' );
			$this->template->load ( 'tempDataTable', 'admin/lap_userv', $data );
		}
	}
/*
	public function show_lap_kas(){
		$tgl = trim($this->input->post('txtTGlTrans'));
	 	$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$data ['data_kas'] = $this->lapkasmodel->get_data_kas_user_pdf ($tgl_trans,$this->session->userdata('user_id'));
	}
*/	
	
	function cetakpdf($lap){
		//$basepath = getcwd;
		$tgl=$this->session->userdata('tglD');
		$timestamp = strtotime($this->session->userdata('tglD'));
		$tgl_trans = date('Y-m-d', $timestamp);
							
		$i=1;
		$st200=0;
		$st300=0;
		$so200=0;
		$so300=0;
		$this->load->library('fpdf');
		$this->fpdf->FPDF('P','mm','A4');
		$this->fpdf->AddPage();
		$this->fpdf->Ln();
		
		if($lap=='user'){
			$rows = $this->lapkasmodel->get_data_kas_user_pdf($tgl_trans,$this->session->userdata('user_id'));
			$filename =  "LapKasUser";
			$judul='Laporan Posisi Kas User';
			$jenis_lap=$this->session->userdata('nama');
		}else if($lap=='kantor'){
			$filename =  "LapKasKantor";
			$rows = $this->lapkasmodel->get_data_kas_kantor_pdf($tgl_trans,$this->session->userdata('kodekantor'));
			$judul='Laporan Posisi Kas Kantor';
			$id_kantor=$this->session->userdata('kodekantor');
			if($id_kantor=='001'){
				$jenis_lap='Kantor Pusat';
			}elseif($id_kantor=='002'){
				$jenis_lap='Kantor Kas Dalung';
			}elseif($id_kantor=='003'){
				$jenis_lap='Kantor Kas Kuta';
			}
		}
		
		
		$this->fpdf->SetFont('Courier','','6');
		$this->fpdf->Cell(1,10, '', '0', 0, 'C',false);
		$this->fpdf->Cell(19,5, $tgl, '0', 0, 'L',false);
		$this->fpdf->Ln();
		$this->fpdf->Cell(19,5, $jenis_lap, '0', 0, 'L',false);
		//$this->session->userdata('nama');
		$this->fpdf->SetFont('Courier','','10');
		$this->fpdf->Cell(170,10, $judul, '0', 0, 'C',false);
		$this->fpdf->Ln();
		$this->fpdf->setFont('Courier','',5);

		//HEADER 10 + 5 + 5 total = 190
		$this->fpdf->Cell(10,5, 'No', 1, '0', 'C',false);
		$this->fpdf->Cell(10,5, 'Modul', 1, '0', 'C',false);
		$this->fpdf->Cell(15,5, 'No. Bukti', 1, '0', 'C',false);
		$this->fpdf->Cell(70,5, 'Uraian', 1, '0', 'L',false);
		$this->fpdf->Cell(5,5, 'TOB', 1, '0', 'C',false);
		$this->fpdf->Cell(20,5, 'OB Debet', 1, '0', 'C',false);
		$this->fpdf->Cell(20,5,'OB Kredit' , 1, '0', 'C',false);
		$this->fpdf->Cell(20,5,'T Debet' , 1, '0', 'C',false);
		$this->fpdf->Cell(20,5,'T Kredit' , 1, '0', 'C',false);
		$this->fpdf->Ln();
		//HEADER
		foreach ( $rows as $row ){
			/*
			$array1 = array (
				'modul' => $row->modul
			);
			*/
			$this->fpdf->Cell(10,5, $i, 1, '0', 'C',false);
			$this->fpdf->Cell(10,5, $row->modul, 1, '0', 'C',false);
			$this->fpdf->Cell(15,5, $row->NO_BUKTI, 1, '0', 'C',false);
			$this->fpdf->Cell(70,5, $row->uraian, 1, '0', 'T',false);
			$this->fpdf->Cell(5,5, $row->tob, 1, '0', 'C',false);
			
			if(($row->my_kode_trans==200) && ($row->tob=='O')){
				$this->fpdf->Cell(20,5, number_format($row->saldo_trans,2), 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$so200=$so200+$row->saldo_trans;
			}else if(($row->my_kode_trans==300) && ($row->tob=='O')){
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, number_format($row->saldo_trans,2), 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$so300=$so300+$row->saldo_trans;
			}else if(($row->my_kode_trans==200) && ($row->tob=='T')){
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, number_format($row->saldo_trans,2), 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$st200=$st200+$row->saldo_trans;
			}else if(($row->my_kode_trans==300) && ($row->tob=='T')){
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, '', 1, '0', 'R',false);
				$this->fpdf->Cell(20,5, number_format($row->saldo_trans,2), 1, '0', 'R',false);
				$st300=$st300+$row->saldo_trans;
			}
			/*	
			
			*/
			$this->fpdf->Ln();
			$i++;
		}
		$this->fpdf->Cell(110,5, 'Total', 1, '0', 'C',false);
		$this->fpdf->Cell(20,5, number_format($so200,2), 1, '0', 'R',false);
		$this->fpdf->Cell(20,5, number_format($so300,2), 1, '0', 'R',false);
		$this->fpdf->Cell(20,5, number_format($st200,2), 1, '0', 'R',false);
		$this->fpdf->Cell(20,5, number_format($st300,2), 1, '0', 'R',false);

		$this->fpdf->Output();
		//$this->fpdf->Output($basepath.'/pdf/'.$filename.'.pdf');
		//$this->fpdf->Output($filename.$tgl.'.pdf', 'D');   
	}
/*====================END LAPORAN KAS USER===========================================================*/
	function lap_kas_kantor(){

		$this->auth->restrict ();
		$this->auth->cek_menu ( 21 );

		if(isset($_POST["btnLihat"])){
			$this->show_lap_kas();
		}else{
			$timestamp = strtotime($this->session->userdata('tglD'));
			$tgl_trans = date('Y-m-d', $timestamp);
			
			$data['judul']='Laporan Kas Kantor';
			
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['data_kas'] = $this->lapkasmodel->get_data_kas_kantor_grid ($tgl_trans,$this->session->userdata('kodekantor'));
			$this->template->set ( 'title', 'Laporan Kas Kantor' );
			$this->template->load ( 'tempDataTable', 'admin/lap_kantorv', $data );
		}
		
	}
}

 

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
