<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_deposito_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('master_depositomodel');
		$this->load->model('master_tabunganmodel');
		$this->load->helper('form','url');
		//$this->load->driver('cache');
		//$this->cache->useMemcache('127.0.0.1', '11211');
    }
	
	function desk_prod_deposito(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kd_dep', TRUE );
		$rows = $this->master_depositomodel->desk_prod_deposito ( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'SUKU_BUNGA_DEFAULT' => $row->SUKU_BUNGA_DEFAULT,
				'PPH_DEFAULT' => $row->PPH_DEFAULT,
				'JKW_DEFAULT' => $row->JKW_DEFAULT
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
			$this->template->set ( 'title', 'Master Deposito' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	
	
	public function buat_baru(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 29 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_deposito();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Master Deposito';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data['jenis_dep'] = $this->master_depositomodel->get_jenis_dep();
		$data['kode_group1'] = $this->master_depositomodel->get_kodegroup1_dep();
		$data['kode_group2'] = $this->master_depositomodel->get_kodegroup2_dep();
		$data['kode_group3'] = $this->master_depositomodel->get_kodegroup3_dep();
		$data['kode_pemilik'] = $this->master_tabunganmodel->get_kode_gol_deb_tab();
		$data['kode_metoda'] = $this->master_tabunganmodel->get_kode_metoda();
		$data['kode_hub_dep'] = $this->master_tabunganmodel->get_kode_hub_tab();
		
		$this->template->set ( 'title', 'Master Deposito' );
		$this->template->load ( 'tempDataTable', 'admin/master_depositov', $data );
		}
	}
	public function getRekDepAll(){
		$this->CI =& get_instance();//and a.kcab_id<>'1100'
		$rows = $this->master_depositomodel->getRekDepAll();
		$data['data'] = array();
		foreach( $rows as $row ) {
			$saldoAkhir	= number_format($row->saldo_akhir,2);
			$array = array(
					'noRek' => trim($row->no_rekening),
					'nasabahId' => trim($row->nasabah_id),
					'namaNasabah' => trim($row->nama_nasabah),
					'alamat' =>  trim($row->alamat),
					'saldoAkhir'    => $saldoAkhir
	
			);
	
			array_push($data['data'],$array);
		}
		//echo json_encode($data['data']);
		$this->output->set_output(json_encode($data));
	}
	function getDeskripsiRekDep(){
		$this->CI =& get_instance();
		$noRekDep	= $this->input->post ( 'noRekDep', TRUE );
		$rows 		= $this->master_depositomodel->getDeskripsiRekDep( $noRekDep );
		if($rows){
			$tglReg = date('d-m-Y', strtotime($rows[0]->tgl_registrasi));
			$tglJT = date('d-m-Y', strtotime($rows[0]->tgl_jt));
			$tglMulai = date('d-m-Y', strtotime($rows[0]->tgl_mulai));
			$tglValuta = date('d-m-Y', strtotime($rows[0]->tgl_valuta));
			$array = array (
					'baris'=>1,
					'jenisDep' => $rows[0]->jenis_deposito,
					'abp' => $rows[0]->abp,
					'statusAktif' => $rows[0]->status_aktif,
					'noAlternatif' => $rows[0]->no_alternatif,
					'jmlDeposito' => $rows[0]->jml_deposito,
					'sukuBunga' => $rows[0]->suku_bunga,
					'persenPph' => $rows[0]->persen_pph,
					'tglReg' => $tglReg,
					'jkw' => $rows[0]->jkw,
					'tglJT' => $tglJT,
					'tglMulai' => $tglMulai,
					'tglValuta' => $tglValuta,
					'typeSB' => $rows[0]->type_suku_bunga,
					'masukTitipan' => $rows[0]->masuk_titipan,
					'bungaKePokok' => $rows[0]->bunga_berbunga,
					'noRekTab' => $rows[0]->no_rek_tabungan,
					'aro' => $rows[0]->aro,
					'kodeGroup1' => $rows[0]->kode_group1,
					'kodeGroup2' => $rows[0]->kode_group2,
					'kodeGroup3' => $rows[0]->kode_group3,
					'kodeBiPemilik' => $rows[0]->kode_bi_pemilik,
					'kodeBiMetoda' => $rows[0]->kode_bi_metoda,
					'kodeBiHub' => $rows[0]->kode_bi_hubungan,
					'nasabahId'	=>$rows[0]->nasabah_id,
					'namaNasabah'=>$rows[0]->nama_nasabah,
					'alamat'=>$rows[0]->alamat
			);
		}else{
			$array=array('baris'=>0);
		}
	
		$this->output->set_output(json_encode($array));
	}
	public function simpan_deposito(){
		
		$tgl_reg = trim($this->input->post('txtTglReg'));
	 	$timestamp = strtotime($tgl_reg);
		$tgl_reg = date('Y-m-d', $timestamp);
		
		$tgl_jt = trim($this->input->post('txtTglJT'));
	 	$timestamp = strtotime($tgl_jt);
		$tgl_jt = date('Y-m-d', $timestamp);
		
		$tgl_penempatan = trim($this->input->post('txtTglPenempatan'));
	 	$timestamp = strtotime($tgl_penempatan);
		$tgl_penempatan = date('Y-m-d', $timestamp);
		
		
		$chkAro=trim($this->input->post('chkAro'));
		if($chkAro==""){
			$chkAro=0;
		}else{
			$chkAro=1;
		}
		$chkBungaTitipan=trim($this->input->post('chkBungaTitipan'));
		if($chkBungaTitipan==""){
			$chkBungaTitipan=0;
		}else{
			$chkBungaTitipan=1;
		}
		$chkBungaPokok=trim($this->input->post('chkBungaPokok'));
		if($chkBungaPokok==""){
			$chkBungaPokok=0;
		}else{
			$chkBungaPokok=1;
		}
		
		$data = array(
		 'NO_REKENING' => trim($this->input->post('txtNoRekDep')),
		 'NO_ALTERNATIF' => trim($this->input->post('txtNoBilyet')),
		 'NASABAH_ID' => trim($this->input->post('txtNasabahId')),
		 'KODE_BI_PEMILIK' => trim($this->input->post('DL_kodepemilik')),
		 'KODE_BI_HUBUNGAN' => trim($this->input->post('DL_kodehub_dep')),
		 'KODE_BI_METODA' => trim($this->input->post('DL_kodemetoda')),
		 'JENIS_DEPOSITO' => trim($this->input->post('DL_jenis_dep')),
		 'JML_DEPOSITO' => str_replace(',', '', trim($this->input->post('txtJmlDep'))),
		 'SUKU_BUNGA' => str_replace(',', '', trim($this->input->post('txtBunga'))),
		 'PERSEN_PPH' => str_replace(',', '', trim($this->input->post('txtPph'))) ,
		 'TGL_REGISTRASI' => $tgl_reg,
		 'JKW' => trim($this->input->post('txtJkWaktu')),
		 'TGL_JT' => $tgl_jt,
		 'STATUS_AKTIF' => 1,
		 'SALDO_AWAL' => 0.00,
		 'SALDO_SETORAN' => str_replace(',', '', trim($this->input->post('txtJmlDep'))),
		 'SALDO_PENARIKAN' => 0.00,
		 'SALDO_AKHIR' => str_replace(',', '', trim($this->input->post('txtJmlDep'))),
		 'BUNGA_BLN_INI' => 0.00,
		 'PAJAK_BLN_INI' => 0.00,
		 'KODE_GROUP1' => trim($this->input->post('DL_kodegroup1_dep')),
		 'KODE_GROUP2' => trim($this->input->post('DL_kodegroup2_dep')),
		 'KODE_GROUP3' => trim($this->input->post('DL_kodegroup3_dep')),
		 'STATUS_BUNGA' => '',
		 'TGL_TRANS_TERAKHIR' => '0000-00-00',
		 'ARO' => $chkAro,
		 'NO_REK_TABUNGAN' => trim($this->input->post('txtRekTab')),
		 'USERID' =>  $this->session->userdata('user_id'),
		 'TITIPAN_AWAL' => 0.00,
		 'TITIPAN_TAMBAH' => 0.00,
		 'TITIPAN_AMBIL' => 0.00,
		 'TITIPAN_AKHIR' => 0.00,
		 'BUNGA_BERBUNGA' => $chkBungaPokok,
		 'MASUK_TITIPAN' => $chkBungaTitipan,
		 'SALDO_NOMINATIF' => 0.00,
		 'BUNGA_YMH' => 0.00,
		 'KODE_CAB' => '',
		 'NAMA_KUASA' => '',
		 'ALMT_KUASA' => '',
		 'ABP' =>  trim($this->input->post('DL_tipe_dep')),
		 'TGL_MULAI' => $tgl_penempatan,
		 'BLOKIR' => 0,
		 'TGL_VALUTA' => trim($this->input->post('txtTglValuta')),
		 'TYPE_SUKU_BUNGA' => trim($this->input->post('DL_tipe_bunga')),
		 'PROVISI' => 0.00,
		 'ADM' => 0.00,
		 'KODE_BI_LOKASI' => '',
		 'NILAI_DEPOSITO' => 0.00,
		 'gol_nasabah' => '876',
		 'USER_BLOKIR' => 0,
		 'USER_UNBLOKIR' => 0,
		 'TGL_BLOKIR' => '0000-00-00',
		 'TGL_UNBLOKIR' => '0000-00-00',
		 'CAB' => '001',
		 'NISBAH' => 0,
		 'AKAD' => 2,
		 'SALDO_EFEKTIF_BLN_INI' => 0.00,
		 'STATUS_APPROVAL' => 0,
		 'USER_APPROVAL' => 0,
		 'QQ' => ''

		);
		
		$query_deposito=$this->master_depositomodel->insert_deposito($data);
		//show_nasabah_id($nasabah_id_max);
		//$this->session->set_flashdata('success', 'Data deposito berhasil masuk');
			//redirect('master_deposito_c/buat_baru');	
	}
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */