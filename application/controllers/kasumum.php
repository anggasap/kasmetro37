<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kasumum extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('homemodel');
		$this->load->model('kasmodel');
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

	 function kodejurnal()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('kasmodel');
		$kode = $this->input->post ( 'kodetrans', TRUE );
		$rows = $this->kasmodel->get_deskripsi_trans ( $kode );
		foreach( $rows as $row )			
		$array = array (
			'deskripsitrans'=> $row->deskripsi_trans,
			'typetrans'     => $row->type_trans,
			'gl_trans'      => $row->gl_trans,
			'namaperk'      => $row->nama_perk
		);

		$this->output->set_output(json_encode($array));
	} 
	public function getPerkAll(){
		$this->CI =& get_instance();//and a.kcab_id<>'1100'
		$rows = $this->kasmodel->getPerkAll();
		$data['data'] = array();
		foreach( $rows as $row ) {
	
			$array = array(
					'kodePerk' => trim($row->kode_perk),
					'namaPerk' =>  trim($row->nama_perk),
					'typePerk'    => trim($row->type)
	
			);
	
			array_push($data['data'],$array);
		}
		//echo json_encode($data['data']);
		$this->output->set_output(json_encode($data));
	}	

	public function kas_umum()
	{

		$this->auth->restrict ();
		$this->auth->cek_menu ( 4 );

		if(isset($_POST["btnSimpan"]))
		{
			$this->insert_teller();
		}
		else
		{
			$data['counter']=$this->kasmodel->get_counter();
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['perkiraan'] = $this->kasmodel->get_perkiraan ();
			$data ['kodetrans'] = $this->kasmodel->get_kodetrans ();
			$this->template->set ( 'title', 'Kas Umum' );
			$this->template->load ( 'tempDataTable', 'admin/kas_umumv', $data );
		}
		if(isset($_POST["btnKuitansi"]))
		{
			$this->testpdf();
		}
	}
	
	function insert_teller(){
		 $this->load->library('form_validation');
   
		 $this->form_validation->set_rules('txtTGlTrans', 'Tgl trans', 'trim|required');
		 $this->form_validation->set_rules('txtNamaJurnal', 'Nama Jurnal', 'trim|required');
		 $this->form_validation->set_rules('txtKuitansi', 'Kuitansi', 'trim|required');
		 //$this->form_validation->set_rules('txtJml', 'Jumlah', 'trim|required|is_money_multi');
		// $this->form_validation->set_rules('txtNamaGl', 'Nama GL', 'trim|required');
	   
		 $this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');
	   
		 if ($this->form_validation->run() == FALSE){	
		 	$data['counter']=$this->kasmodel->get_counter();
		 	$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['perkiraan'] = $this->kasmodel->get_perkiraan ();
			$data ['kodetrans'] = $this->kasmodel->get_kodetrans ();
			$this->template->set ( 'title', 'Kas Umum' );
			$this->template->load ( 'masterpage', 'admin/kas_umum_view', $data );
		 }else{
		 	$tgl = $this->input->post('txtTGlTrans');
		 	$timestamp = strtotime($tgl);
			$tgl_trans = date('Y-m-d', $timestamp);
			
			$jml_koma = $this->input->post('txtJml');
		 	$jml = str_replace(',', '', $jml_koma); 
			
			if (isset($_POST['chkKasAwal'])) {
				$posted=1;
			} else {
				$posted=0;
			}
			
			 $data_kas = array(
			 	'trans_id'      =>0,
			 	'modul'         => 'PC',
			 	'tgl_trans'     => $tgl_trans,
			 	'kode_jurnal'   =>$this->input->post('DL_kodetrans'),
			 	'no_bukti'      =>$this->input->post('txtKuitansi'),
			 	'uraian'        =>$this->input->post('txtUraian'),
			 	'my_kode_trans' =>$this->input->post('txtTypetrans'),
			 	'saldo_trans'   =>$jml,
			 	'tob'           => 'T',
			 	'tob_RAK'       =>'',
			 	'modul_trans_id'=>0,
			 	'userid'        =>$this->session->userdata('user_id'),
			 	'VALIDATED'     =>0,
			 	'POSTED'        =>$posted,
			 	'GL_TRANS'      =>$this->input->post('txtKodeGL'),
			 	'USERAPP'       =>$this->session->userdata('user_id'),
			 	'CAB'           =>'001'

			 );
 
			$data=array(
				'CounterNo' =>$this->input->post('txtcounter')
			);
			
			if($jml<=0){
				$this->session->set_flashdata('error', 'Jumlah transaksi harus lebih dari nol');
				redirect('kasumum/kas_umum');
			}
			else{
				$this->kasmodel->insert_teller($data_kas);
				$this->kasmodel->add_counter($data);		
				// kembalikan ke kas_umum_view
				$this->session->set_flashdata('success', 'Data berhasil diisimpan');
				redirect('kasumum/kas_umum');
			}
			
			
		 }
	}
	function approvalLimitKas(){
		$approvalUserName = $this->input->post('approvalUserName');
		$approvalPassword = $this->input->post('approvalPassword');
		$approvalLimitKas = $this->auth->approvalLimit ( $approvalUserName,$approvalPassword );
		if($approvalLimitKas['bool']==true){
			$dataReturn=array(
					'bool'	=>true,
					'limitKas' =>$approvalLimitKas['limitKas']
			);
			$this->output->set_output(json_encode($dataReturn));
		}else{
			$dataReturn=array(
					'bool' =>false
			);
			$this->output->set_output(json_encode($dataReturn));
		}
	}
	function testpdf()
	{
		$this->load->library('fpdf');
		$this->fpdf->FPDF('P','cm','A4');
		$this->fpdf->AddPage();
		$this->fpdf->Ln();
		$this->fpdf->setFont('Arial','B',9);
		$this->fpdf->Text(6,1,'Hello World ...');
		$this->fpdf->Output();  
	}

}

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
