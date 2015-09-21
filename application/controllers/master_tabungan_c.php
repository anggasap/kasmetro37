<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_tabungan_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('master_tabunganmodel');
		$this->load->helper('form','url');
		
    }
	function desk_prod_tabungan(){
		$this->CI =& get_instance();
		$kode 			= $this->input->post ( 'kd_tab', TRUE );
		$queryDeskProdTab 			= $this->master_tabunganmodel->desk_prod_tabungan ( $kode );
		$queryLastNoRek = $this->master_tabunganmodel->lastNoRek ( $kode );
		if($queryDeskProdTab){
		/* foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'SUKU_BUNGA_DEFAULT' => $row->SUKU_BUNGA_DEFAULT,
				'PPH_DEFAULT' => $row->PPH_DEFAULT,
				'ADM_PER_BLN_DEFAULT' => $row->ADM_PER_BLN_DEFAULT,
				'PERIODE_ADM_DEFAULT' => $row->PERIODE_ADM_DEFAULT,
				'SETORAN_MINIMUM_DEFAULT' => $row->SETORAN_MINIMUM_DEFAULT,
				'MINIMUM_DEFAULT' => $row->MINIMUM_DEFAULT
			); */
			$array = array(
					'baris'=>1,
					'SUKU_BUNGA_DEFAULT' => $queryDeskProdTab[0]->SUKU_BUNGA_DEFAULT,
					'PPH_DEFAULT' => $queryDeskProdTab[0]->PPH_DEFAULT,
					'ADM_PER_BLN_DEFAULT' => $queryDeskProdTab[0]->ADM_PER_BLN_DEFAULT,
					'PERIODE_ADM_DEFAULT' => $queryDeskProdTab[0]->PERIODE_ADM_DEFAULT,
					'SETORAN_MINIMUM_DEFAULT' => $queryDeskProdTab[0]->SETORAN_MINIMUM_DEFAULT,
					'MINIMUM_DEFAULT' => $queryDeskProdTab[0]->MINIMUM_DEFAULT,
					'lastNoRek'	=> trim($queryLastNoRek[0]->no_rekening)
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
    public function index()
    {
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'Master Tabungan' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	function process_cari_nasabah(){
		$this->CI =& get_instance();
		$nas_id = $this->input->post('item',TRUE);
		$rows = $this->master_tabunganmodel->get_nasabah($nas_id);
		$data['norek'] = array();
		foreach ( $rows as $row ){
			$data['norek'][] = array (
				'nasabah_id' => $row->nasabah_id,
				'nama_nasabah' => $row->nama_nasabah,
				'alamat' => $row->alamat
			);
		}
			 
		
		$this->output->set_output(json_encode($data));
	}
	function process_cari_rek_tab(){
		$this->CI =& get_instance();
		$nas_id = $this->input->post('item',TRUE);
		$rows = $this->master_tabunganmodel->get_nasabah($nas_id);
		$data['norek'] = array();
		foreach ( $rows as $row ){
			$data['norek'][] = array (
				'nasabah_id' => $row->nasabah_id,
				'nama_nasabah' => $row->nama_nasabah,
				'alamat' => $row->alamat
			);
		}
			 
		
		$this->output->set_output(json_encode($data));
	}
	function process_cari_rektab_byname(){
		$this->CI =& get_instance();
		$nama = $this->input->post('item',TRUE);
		$rows = $this->master_tabunganmodel->get_rektab_byname($nama);
		$data['norek'] = array();
		foreach ( $rows as $row ){
			$data['norek'][] = array (
				'no_rekening' => str_replace(".","@",$row->no_rekening),
				'nama_nasabah' => $row->nama_nasabah,
				'alamat' => $row->alamat
			);
		}
			 
		
		$this->output->set_output(json_encode($data));
	}
	
	public function nasabah2($nas_id){
		$this->CI =& get_instance();
		$nas_id = $this->input->post('item',TRUE);
		$rows = $this->master_tabunganmodel->get_data_nasabah();
		$data['norek'] = array();
		foreach ( $rows as $row ){
			$data['norek'][] = array (
				'NASABAH_ID' => $row['nasabah_id'],
				'NAMA_NASABAH' => $row['nama_nasabah'],
				'ALAMAT' => $row['alamat']
			);
		}
		
		//		$data['menu_id'] = $row['menu_id'];
		//	array_push($data['norek'], $data);
		//	$JSON=json_encode($data['norek']);
		$cache = $this->cache->get('cache_data_nasabah2');
		if($cache){
			$dat = $this->cache->get('cache_data_nasabah2');
			$jsondat=json_encode($dat);	
			$this->cache->save('cache_data_nasabah3', $jsondat, 3600);
		}else{
			$this->cache->save('cache_data_nasabah2', $data['norek'], 3600);
			$dat = $this->cache->get('cache_data_nasabah2');
			$jsondat=json_encode($dat);	
			$this->cache->save('cache_data_nasabah3', $jsondat, 3600);
		}
		//$dat=json_encode($dat);
		$this->output->set_output(json_encode($dat));
		//echo json_encode($dat);
	}
	
	function nasabah3() {
/*
		//$this->load->model('ajax_model');
		$dat = $this->master_tabunganmodel->get_data_nasabah();
	
		if ($data['nasabah3'] !== false) {
			//echo json_encode($data['nasabah3'], JSON_FORCE_OBJECT);
			$this->output->set_output(json_encode($dat, JSON_FORCE_OBJECT));
		}
*/
		$cache = $this->cache->get('cache_data_nasabah');
		  $data['data_nasabah'] = $this->cache->get('cache_data_nasabah');
		  $this->output->set_output(json_encode($data['data_nasabah'], JSON_FORCE_OBJECT));
		
	}
	function deskripsi_nasabah(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->master_tabunganmodel->get_deskripsi_nasabah( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'NAMA_NASABAH' => $row->nama_nasabah,
				'NASABAH_ID' => $row->nasabah_id,
				'ALAMAT' => $row->alamat
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
	public function buat_baru(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 24 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_tabungan();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Master Tabungan';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data['jenis_tab'] = $this->master_tabunganmodel->get_jenis_tab();
		$data['kode_group1'] = $this->master_tabunganmodel->get_kodegroup1_tab();
		$data['kode_group2'] = $this->master_tabunganmodel->get_kodegroup2_tab();
		$data['kode_group3'] = $this->master_tabunganmodel->get_kodegroup3_tab();
		$data['kode_gol_deb_tab'] = $this->master_tabunganmodel->get_kode_gol_deb_tab();
		$data['kode_metoda'] = $this->master_tabunganmodel->get_kode_metoda();
		$data['kode_hub_tab'] = $this->master_tabunganmodel->get_kode_hub_tab();
		
		$this->template->set ( 'title', 'Master Tabungan' );
		$this->template->load ( 'tempDataTable', 'admin/master_tabunganv', $data );
		}
	}
	public function getRekTabAll(){
		$this->CI =& get_instance();//and a.kcab_id<>'1100'
		$rows = $this->master_tabunganmodel->getRekTabAll();
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
	function getDeskripsiRekTab(){
		$this->CI =& get_instance();
		$noRekTab	= $this->input->post ( 'noRekTab', TRUE );
		$rows 		= $this->master_tabunganmodel->getDeskripsiRekTab( $noRekTab );
		if($rows){
				
			$array = array (
					'baris'=>1,
					'jenisTab' => $rows[0]->jenis_tabungan,
					'statusAktif' => $rows[0]->status_aktif,
					'noAlternatif' => $rows[0]->no_alternatif,
					'sukuBunga' => $rows[0]->suku_bunga,
					'persenPph' => $rows[0]->persen_pph,
					'tglBunga' => $rows[0]->tgl_bunga,
					'kodeGroup1' => $rows[0]->kode_group1,
					'kodeGroup2' => $rows[0]->kode_group2,
					'kodeGroup3' => $rows[0]->kode_group3,
					'kodeBiPemilik' => $rows[0]->kode_bi_pemilik,
					'kodeBiMetoda' => $rows[0]->kode_bi_metoda,
					'kodeBiHub' => $rows[0]->kode_bi_hubungan,
					'flagRes' => $rows[0]->flag_restricted,
					'abp' => $rows[0]->abp,
					'saldoMin' => $rows[0]->minimum,
					'admPerBln' => $rows[0]->adm_per_bln,
					'periodeAdm' => $rows[0]->periode_adm,
					'setorMin' => $rows[0]->setoran_minimum,
					'setorWajib' => $rows[0]->setoran_per_bln,
					'jkw' => $rows[0]->jkw,
					'transNormal' => $rows[0]->transaksi_normal,
					'nasabahId'	=>$rows[0]->nasabah_id,
					'namaNasabah'=>$rows[0]->nama_nasabah,
					'alamat'=>$rows[0]->alamat
			);
		}else{
			$array=array('baris'=>0);
		}
	
		$this->output->set_output(json_encode($array));
	}
	public function simpan_tabungan(){
		$sk_bunga_koma = trim($this->input->post('txtBunga'));
	 	$sk_bunga = str_replace(',', '', $sk_bunga_koma);
		
		$pph_koma = trim($this->input->post('txtPph'));
	 	$pph = str_replace(',', '', $pph_koma);
		
		$tgl_terhitung_bunga = trim($this->input->post('txtTerhitungBunga'));
	 	$timestamp = strtotime($tgl_terhitung_bunga);
		$tgl_terhitung_bunga = date('Y-m-d', $timestamp);
		
		$saldo_min_koma=trim($this->input->post('txtSaldoMin'));
		$saldo_min = str_replace(',', '', $saldo_min_koma);
		
		$by_admin_koma=trim($this->input->post('txtBiayaAdm'));
		$by_admin = str_replace(',', '', $by_admin_koma);
		
		$setor_min_koma=trim($this->input->post('txtSetoranMin'));
		$setor_min = str_replace(',', '', $setor_min_koma);
		
		$setor_wajib_koma=trim($this->input->post('txtSetoranWajib'));
		$setor_wajib = str_replace(',', '', $setor_wajib_koma);
		
		$est_bunga_koma=trim($this->input->post('txtEstimasiBunga'));
		$est_bunga = str_replace(',', '', $est_bunga_koma);
		
		
		$trans_normal_koma = trim($this->input->post('txtTransaksiNormal'));
	 	$trans_normal = str_replace(',', '', $trans_normal_koma);		
		
		$data=array(
		'NO_REKENING' => trim($this->input->post('txtNoRekTab')),
		'NO_ALTERNATIF' =>trim($this->input->post('txtNoSeries')) ,
		'NASABAH_ID' => trim($this->input->post('txtNasabahId')),
		'JENIS_TABUNGAN' =>trim($this->input->post('DL_jenis_tab')) ,
		'KODE_BI_PEMILIK' =>trim($this->input->post('DL_kodegoldeb_tab')) ,
		'KODE_BI_HUBUNGAN' => trim($this->input->post('DL_kodehub_tab')),
		'KODE_BI_METODA' => trim($this->input->post('DL_kodemetoda')) ,
		'SUKU_BUNGA' => $sk_bunga,
		'PERSEN_PPH' => $pph,
		'TGL_REGISTRASI' => $this->session->userdata('tglY'),
		'SALDO_AWAL' => 0.00,
		'SALDO_SETORAN' => 0.00, 
		'SALDO_PENARIKAN' => 0.00, 
		'SALDO_AKHIR' => 0.00,
		'SALDO_EFEKTIF_BLN_INI' => 0.00,
		'BUNGA_BLN_INI' => 0.00,
		'PAJAK_BLN_INI' => 0.00,
		'ADM_BLN_INI' => 0.00, 
		'TGL_BUNGA' => $tgl_terhitung_bunga, 
		'KODE_GROUP1' => trim($this->input->post('DL_kodegroup1_tab')), 
		'KODE_GROUP2' => trim($this->input->post('DL_kodegroup2_tab')), 
		'KODE_GROUP3' => trim($this->input->post('DL_kodegroup3_tab')), 
		'keterangan' => '', 
		'STATUS_AKTIF' => 1, 
		'SALDO_NOMINATIF' => 0.00, 
		'MINIMUM' => $saldo_min, 
		'ADM_PER_BLN' => $by_admin, 
		'PERIODE_ADM' => trim($this->input->post('DL_frek_adm')), 
		'LAST_TGL_ADM' => '0000-00-00', 
		'SETORAN_MINIMUM' => $setor_min, 
		'TGL_JT' => '0000-00-00', 
		'NO_REK_KREDIT' => '', 
		'SETORAN_PER_BLN' => $setor_wajib, 
		'JKW' => trim($this->input->post('txtJangkaWaktu')), 
		'NAMA_KUASA' => '', 
		'ALMT_KUASA' => '', 
		'TGL_TRANS_TERAKHIR' => '0000-00-00',
		'KODE_CAB' => '', 
		'ABP' => trim($this->input->post('DL_tipe_tab')), 
		'SALDO_HITUNG_PAJAK' => 0.00, 
		'JUMLAH_UNDIAN' => 0, 
		'AWAL_UNDIAN' => 0, 
		'AKHIR_UNDIAN' => 0, 
		//'KODE_GROUP4' => '', 
		//'KODE_GROUP5' => '', 
		//'KODE_HARI' => '', 
		//'NOMOR_SAE' => 0, 
		'POT_SIMP' => 0.00, 
		'SHU_THN_INI' => 0.00, 
		'SALDO_EFEKTIF_THN_INI' => 0.00, 
		'SALDO_AWAL_HARI' => 0, 
		'FLAG_RESTRICTED' => trim($this->input->post('DL_restrict')), 
		'BARIS_BUKU' => 0, 
		'SALDO_BLN_01' => 0,'SALDO_BLN_02' => 0,'SALDO_BLN_03' => 0,'SALDO_BLN_04' => 0,'SALDO_BLN_05' => 0, 'SALDO_BLN_06' => 0, 'SALDO_BLN_07' => 0, 'SALDO_BLN_08' => 0,
		'SALDO_BLN_09' => 0, 'SALDO_BLN_10' => 0, 'SALDO_BLN_11' => 0, 'SALDO_BLN_12' => 0, 
		'gol_nasabah' => 876, 
		'ZAKAT_BLN_INI' => 0.00, 
		'KODE_BI_LOKASI' => '', 
		'AKAD' => 1, 
		'ZAKAT' => 0, 
		'BLOKIR' => 0, 
		'PROSEN_BONUS' =>0 , 
		'CAB' => '', 
		'USERID' => $this->session->userdata('user_id'), 
		'SUKU_BUNGA_ESTIMASI' => 0, 
		'SALDO_AKAN_DATANG' => 0.00, 
		'TYPE_TABUNGAN' => trim($this->input->post('DL_tipe_tab')), 
		'USER_BLOKIR' => 0, 
		'USER_UNBLOKIR' => 0, 
		'TGL_BLOKIR' => '0000-00-00', 
		'TGL_UNBLOKIR' => '0000-00-00', 
		'SALDO_BLOKIR' => 0.00, 
		'NISBAH' => 0, 
		'STATUS_APPROVAL' => 0, 
		'USER_APPROVAL' => 0, 
		'TGL_MULAI' => '0000-00-00', 
		'QQ' => '', 
		'OUTLET' => '', 
		'TRANSAKSI_NORMAL' => $trans_normal ,
		//'jenis_bank' => '' , 
		//'sandi_bank' =>''
		);
		$query_tabung=$this->master_tabunganmodel->insert_tabungan($data);
		if($query_tabung){
			$array = array(
					'notif'=> 'Data master tabungan berhasil disimpan.'
			);
		}else{
			$array = array(
					'notif'=> 'Data master tabungan gagal disimpan.'.$query_tabung->error
			);
		}
		$this->output->set_output(json_encode($array));
	}
	public function ajaxUbahRekTab(){	
		$noRekTab	= trim($this->input->post('txtNoRekTab'));
		$data = array (
				'jenis_tabungan' => trim($this->input->post('DL_jenis_tab')),
				'no_alternatif' => trim($this->input->post('txtNoSeries')),
				'suku_bunga' => str_replace(',', '', trim($this->input->post('txtBunga'))),
				'persen_pph' => str_replace(',', '', trim($this->input->post('txtPph'))),
				'tgl_bunga' => date('Y-m-d', strtotime(trim($this->input->post('txtTerhitungBunga')))),
				'kode_group1' => trim($this->input->post('DL_kodegroup1_tab')),
				'kode_group2' => trim($this->input->post('DL_kodegroup2_tab')),
				'kode_group3' => trim($this->input->post('DL_kodegroup3_tab')),
				'kode_bi_pemilik' => trim($this->input->post('DL_kodegoldeb_tab')),
				'kode_bi_metoda' => trim($this->input->post('DL_kodemetoda')),
				'kode_bi_hubungan' => trim($this->input->post('DL_kodehub_tab')),
				'flag_restricted' => trim($this->input->post('DL_restrict')),
				'abp' => trim($this->input->post('DL_tipe_tab')),
				'minimum' => str_replace(',', '', trim($this->input->post('txtSaldoMin'))),
				'adm_per_bln' => str_replace(',', '', trim($this->input->post('txtBiayaAdm'))),
				'periode_adm' => trim($this->input->post('DL_frek_adm')),
				'setoran_minimum' => str_replace(',', '', trim($this->input->post('txtSetoranMin'))),
				'setoran_per_bln' => str_replace(',', '', trim($this->input->post('txtSetoranWajib'))),
				'jkw' => trim($this->input->post('txtJangkaWaktu')),
				'transaksi_normal' => str_replace(',', '', trim($this->input->post('txtTransaksiNormal')))
		);
		$query = $this->master_tabunganmodel->ajaxUpdateRekTab($data,$noRekTab);
		if($query){
			$array = array(
					'act'	=>1,
					'notif' =>'Data berhasil diubah'
			);
		}else{
			$array = array(
					'act'	=>0,
					'notif' =>'Data gagal diubah'
			);
		}
		$this->output->set_output(json_encode($array));
	
	}
	function ajaxHapusRekTab(){
		$this->CI =& get_instance();
		$noRekTab = $this->input->post ( 'noRekTab', TRUE );
		$query = $this->master_tabunganmodel->ajaxHapusRekTab( $noRekTab);
		if($query){
			$array = array(
					'act'	=>1,
					'notif' =>'Data berhasil dihapus'
			);
		}else{
			$array = array(
					'act'	=>0,
					'notif' =>'Data gagal dihapus'
			);
		}
		$this->output->set_output(json_encode($array));
	}
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */