<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutup_deposito_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('setordepmodel');
		$this->load->model('tutupdepmodel');
		$this->load->model('kasmodel');
		$this->load->helper('form','url');
    }
	function deskripsi_norek_dep(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->tutupdepmodel->get_deskripsi_rek ( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'NAMA_NASABAH' => $row->NAMA_NASABAH,
				'ALAMAT' => $row->ALAMAT,
				'NO_ALTERNATIF' => $row->NO_ALTERNATIF,
				'TGL_REGISTRASI' => $row->TGL_REGISTRASI,
				'JKW' => $row->JKW,
				'TGL_JT' => $row->TGL_JT,
				'SUKU_BUNGA' => $row->SUKU_BUNGA,
				'PERSEN_PPH' => $row->PERSEN_PPH,
				'JML_DEPOSITO' => $row->JML_DEPOSITO
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
    public function index(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			
			$this->template->set ( 'title', 'Penutupan Deposito' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	
	
	public function tutup_dep(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 31 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_tutup_deposito();
  		}
		else{
		$data['judul']='Penutupan Deposito';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data['kodetrans_dep_def'] = $this->tutupdepmodel->get_kode_dep_def();
		$data['counter']=$this->setordepmodel->get_counter();
		
		$this->template->set ( 'title', 'Penutupan Deposito' );
		$this->template->load ( 'tempDataTable', 'admin/tutup_depositov', $data );
		}
	}
	
	public function simpan_tutup_deposito(){

//============ DATA POKOK ====================		
		$data_deptrans= array(
		'DEPTRANS_ID' => 0,
		'TGL_TRANS' => $this->session->userdata('tglY'),
		'NO_REKENING' => trim($this->input->post('txtNoRekDep')),
		'KODE_TRANS' => trim($this->input->post('DL_kodetrans_dep')),
		'SALDO_SEBELUM' => 0.00,
		'SALDO_TRANS' => str_replace(',', '', trim($this->input->post('txtJmlDep'))),
		'SALDO_SETELAH' => 0.00,
		'MY_KODE_TRANS' => 300,
		'kuitansi' => trim($this->input->post('txtKuitansi')),
		'NO_TELLER' => 0,
		'USERID' => $this->session->userdata('user_id'),
		'TOB' => trim($this->input->post('txtJnsTransDep')),
		'POSTED' => 0,
		'VALIDATED' => 1,
		'TGL_INPUT' => '0000-00-00',
		'NO_REK_OB' => '',
		'KODE_PERK_TABUNGAN' => '',
		'KODE_PERK_GL' => '',
		'CAB' => '',
		'FLAG_PAJAK' => 0,
		'USERAPP' => 0,
		'ACR_TRANS'=>0.00
		);
		
		$this->setordepmodel->insert_deptrans($data_deptrans);
		
		$row_get_deptrans_id=$this->setordepmodel->get_deptrans_id($this->session->userdata('tglY'),trim($this->input->post('txtNoRekDep')),str_replace(',', '', trim($this->input->post('txtJmlDep'))),trim($this->input->post('txtKuitansi')));
		foreach ( $row_get_deptrans_id as $row ){
			$array = array (
				'DEPTRANS_ID' => $row->DEPTRANS_ID,
			);
		}
		$deptrans_id_max_pokok=$array['DEPTRANS_ID'];
		
		$uraian_pokok="Pengambilan pokok deposito: ".trim($this->input->post('txtNoRekDep'))."-".trim($this->input->post('txtNama'));
		$data_kas_pokok = array(
			'trans_id'      =>0,
			'modul'         =>'DEP',
			'tgl_trans'     =>$this->session->userdata('tglY'),
			'kode_jurnal'   =>'',
			'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			'uraian'        =>$uraian_pokok,
			'my_kode_trans' =>300,
			'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtJmlDep'))),
			'tob'           =>trim($this->input->post('txtJnsTransDep')),
			'tob_RAK'       =>'',
			'modul_trans_id'=>$deptrans_id_max_pokok,
			'userid'        =>$this->session->userdata('user_id'),
			'VALIDATED'     =>0,
			'POSTED'        =>0,
			'GL_TRANS'      =>'',
			'USERAPP'       =>$this->session->userdata('user_id'),
			'CAB'           =>''

		 );
		 $this->kasmodel->insert_teller($data_kas_pokok);

//====== END DATA POKOK		 
//============ DATA KAS PINALTI ====================		
		
		if(str_replace(',', '', trim($this->input->post('txtPinaltiDep')))>0){
			$data_deptrans= array(
			'DEPTRANS_ID' => 0,
			'TGL_TRANS' => $this->session->userdata('tglY'),
			'NO_REKENING' => trim($this->input->post('txtNoRekDep')),
			'KODE_TRANS' => trim($this->input->post('DL_kodetrans_dep')),
			'SALDO_SEBELUM' => 0.00,
			'SALDO_TRANS' => str_replace(',', '', trim($this->input->post('txtPinaltiDep'))),
			'SALDO_SETELAH' => 0.00,
			'MY_KODE_TRANS' => 500,
			'kuitansi' => trim($this->input->post('txtKuitansi')),
			'NO_TELLER' => 0,
			'USERID' => $this->session->userdata('user_id'),
			'TOB' => 'O',
			'POSTED' => 0,
			'VALIDATED' => 1,
			'TGL_INPUT' => '0000-00-00',
			'NO_REK_OB' => '',
			'KODE_PERK_TABUNGAN' => '',
			'KODE_PERK_GL' => '',
			'CAB' => '',
			'FLAG_PAJAK' => 0,
			'USERAPP' => 0,
			'ACR_TRANS'=>0.00
			);
			
			$this->setordepmodel->insert_deptrans($data_deptrans);
			
			$row_get_deptrans_id=$this->setordepmodel->get_deptrans_id($this->session->userdata('tglY'),trim($this->input->post('txtNoRekDep')),str_replace(',', '', trim($this->input->post('txtPinaltiDep'))),trim($this->input->post('txtKuitansi')));
		foreach ( $row_get_deptrans_id as $row ){
			$array = array (
				'DEPTRANS_ID' => $row->DEPTRANS_ID,
			);
		}
		$deptrans_id_max_pinalti=$array['DEPTRANS_ID'];
		
		$uraian_pinalti="Penalti penutupan deposito: ".trim($this->input->post('txtNoRekDep'))."-".trim($this->input->post('txtNama'));
		$data_kas_pinalti = array(
			'trans_id'      =>0,
			'modul'         =>'DEP',
			'tgl_trans'     =>$this->session->userdata('tglY'),
			'kode_jurnal'   =>'',
			'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			'uraian'        =>$uraian_pinalti,
			'my_kode_trans' =>200,
			'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtPinaltiDep'))),
			'tob'           =>trim($this->input->post('txtJnsTransDep')),
			'tob_RAK'       =>'',
			'modul_trans_id'=>$deptrans_id_max_pinalti,
			'userid'        =>$this->session->userdata('user_id'),
			'VALIDATED'     =>0,
			'POSTED'        =>0,
			'GL_TRANS'      =>'',
			'USERAPP'       =>$this->session->userdata('user_id'),
			'CAB'           =>''

		 );
		 $this->kasmodel->insert_teller($data_kas_pinalti);
		}// END if(str_replace(',', '', trim($this->input->post('txtPinaltiDep')))>0){
			
//====== END DATA PINALTI		 
//============ DATA KAS MATERAI ====================			
		if(str_replace(',', '', trim($this->input->post('txtMateraiDep')))>0){
			$data_deptrans= array(
			'DEPTRANS_ID' => 0,
			'TGL_TRANS' => $this->session->userdata('tglY'),
			'NO_REKENING' => trim($this->input->post('txtNoRekDep')),
			'KODE_TRANS' => trim($this->input->post('DL_kodetrans_dep')),
			'SALDO_SEBELUM' => 0.00,
			'SALDO_TRANS' => str_replace(',', '', trim($this->input->post('txtMateraiDep'))),
			'SALDO_SETELAH' => 0.00,
			'MY_KODE_TRANS' => 600,
			'kuitansi' => trim($this->input->post('txtKuitansi')),
			'NO_TELLER' => 0,
			'USERID' => $this->session->userdata('user_id'),
			'TOB' => 'O',
			'POSTED' => 0,
			'VALIDATED' => 1,
			'TGL_INPUT' => '0000-00-00',
			'NO_REK_OB' => '',
			'KODE_PERK_TABUNGAN' => '',
			'KODE_PERK_GL' => '',
			'CAB' => '',
			'FLAG_PAJAK' => 0,
			'USERAPP' => 0,
			'ACR_TRANS'=>0.00
			);
			
			$this->setordepmodel->insert_deptrans($data_deptrans);
			
			$row_get_deptrans_id=$this->setordepmodel->get_deptrans_id($this->session->userdata('tglY'),trim($this->input->post('txtNoRekDep')),str_replace(',', '', trim($this->input->post('txtMateraiDep'))),trim($this->input->post('txtKuitansi')));
		foreach ( $row_get_deptrans_id as $row ){
			$array = array (
				'DEPTRANS_ID' => $row->DEPTRANS_ID,
			);
		}
		$deptrans_id_max_materai=$array['DEPTRANS_ID'];
		
		$uraian_materai="Materai penutupan deposito: ".trim($this->input->post('txtNoRekDep'))."-".trim($this->input->post('txtNama'));
		$data_kas_materai = array(
			'trans_id'      =>0,
			'modul'         =>'DEP',
			'tgl_trans'     =>$this->session->userdata('tglY'),
			'kode_jurnal'   =>'',
			'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			'uraian'        =>$uraian_materai,
			'my_kode_trans' =>200,
			'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtMateraiDep'))),
			'tob'           =>trim($this->input->post('txtJnsTransDep')),
			'tob_RAK'       =>'',
			'modul_trans_id'=>$deptrans_id_max_pinalti,
			'userid'        =>$this->session->userdata('user_id'),
			'VALIDATED'     =>0,
			'POSTED'        =>0,
			'GL_TRANS'      =>'',
			'USERAPP'       =>$this->session->userdata('user_id'),
			'CAB'           =>''

		 );
		 $this->kasmodel->insert_teller($data_kas_materai);
		} //if(str_replace(',', '', trim($this->input->post('txtMateraiDep')))>0){
	
		$data_counter=array(
				'CounterNo' =>trim($this->input->post('txtcounter'))
		);
		$this->setordepmodel->add_counter($data_counter);
		
		$this->tutupdepmodel->update_tutup_dep(trim($this->input->post('txtNoRekDep')),str_replace(',', '', trim($this->input->post('txtJmlDep'))));
		
		$this->session->set_flashdata('success', 'Data penutupan deposito berhasil masuk');
			redirect('tutup_deposito_c/tutup_dep');	
	}
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */