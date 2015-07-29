<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_tabungan_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('master_tabunganmodel');
		$this->load->helper('form','url');
		//$this->load->driver('cache');
		//$this->cache->useMemcache('127.0.0.1', '11211');
		//$this->load->library('memcached_library');
    }
	function desk_prod_tabungan(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kd_tab', TRUE );
		$rows = $this->master_tabunganmodel->desk_prod_tabungan ( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'SUKU_BUNGA_DEFAULT' => $row->SUKU_BUNGA_DEFAULT,
				'PPH_DEFAULT' => $row->PPH_DEFAULT,
				'ADM_PER_BLN_DEFAULT' => $row->ADM_PER_BLN_DEFAULT,
				'PERIODE_ADM_DEFAULT' => $row->PERIODE_ADM_DEFAULT,
				'SETORAN_MINIMUM_DEFAULT' => $row->SETORAN_MINIMUM_DEFAULT,
				'MINIMUM_DEFAULT' => $row->MINIMUM_DEFAULT
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
		//$data['data_nasabah'] = $this->master_tabunganmodel->get_data_nasabah();
		//$this->nasabah3();
		/*
		$cache = $this->cache->get('cache_data_nasabah');
		if($cache){
		  $data['data_nasabah'] = $this->cache->get('cache_data_nasabah');
		  //$data['ada_memcached']="ada memcached!!!";
		}
		else{
		   //$data = $this->sample_model->get_data();
		   $dat=array();
		   $dat = $this->master_tabunganmodel->get_data_nasabah();
		   $this->cache->save('cache_data_nasabah', $dat, 3600);
		   $data['data_nasabah']=$dat;
		   //$data['ada_memcached']="ada memcached!!!";
		}
		
		
		//$data['data_nasabah'] = $this->master_tabunganmodel->get_data_nasabah();
		/*
		$this->load->library('memcached_library');
		// Lets try to get the key
		$results = $this->memcached_library->get('test');
		
		// If the key does not exist it could mean the key was never set or expired
		if (!$results) 
		{
			// Modify this Query to your liking!
			$query = $this->master_tabunganmodel->get_data_nasabah();
			
			// Lets store the results
			$this->memcached_library->add('test', $query,36000);
			
			// Output a basic msg
			echo "Alright! Stored some results from the Query... Refresh Your Browser";
		}
		else 
		{
			$data['data_nasabah']=$result;
			// Output
			//var_dump($results);
			
			// Now let us delete the key for demonstration sake!
			//$this->memcached_library->delete('test');
		}
		*/
		
		
		
		/*
		$cachetime = 10; // number of seconds to cache for
		//$data = array();
		$data['cachereset'] = 0;
				
		// cache calls
		$startTime = microtime(true);
		$this->load->driver('cache');
		$cache = $this->cache->memcached->get('alluserscount');
		if (!$cache){
		  $data['cachereset'] = 1;
		  //$this->load->model('Users','',TRUE);
		  $cache = $this->master_tabunganmodel->get_data_nasabah();
		  $this->cache->memcached->save('alluserscount',$cache, $cachetime);
		}  
		//$data['cache_result'] = $cache;
		$data['data_nasabah'] = $cache;
		$data['cache_time'] = microtime(true)-$startTime;
		*/
		//$data['ada_memcached']="ada memcached!!!";
		/*
		$memcache = new Memcache;
		$memcache->connect('localhost', 11211) or die ("Could not connect");
		$key = md5('kunci'); // Nama unique key yang akan disimpan (cache) di cluster memory
		$cache_result = array();
		$cache_result = $memcache->get($key); // nama object Memcached
		
		if($cache_result){
			// Jika request kedua (sudah di cache di awal)
			//$result=$cache_result;
			$data['data_nasabah']=$cache_result;
			$data['ada_memcached']="ada memcached!!!";
		}else{
			// Jika request pertama ambil data dari database lalu distribusikan di memory server
			//include('connection.php'); // koneksi database
			//$q=mysql_query("select nasabah_id, nama_nasabah, alamat from nasabah order by nasabah_id asc");
			$q = $this->master_tabunganmodel->get_data_nasabah();
			
			//while($r=mysql_fetch_array($q))
			//$result[]=$r; // penyimpanan hasil query didalam array
			
			$memcache->set($key, $q, MEMCACHE_COMPRESSED, 3600000); // disimpan 3600000 detik atau 1 jam dengan nama key $key
			$data['data_nasabah']= $q;
		}
		*/
		$this->template->set ( 'title', 'Master Tabungan' );
		$this->template->load ( 'tempDataTable', 'admin/master_tabunganv', $data );
		}
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
		'KODE_GROUP4' => '', 
		'KODE_GROUP5' => '', 
		'KODE_HARI' => '', 
		'NOMOR_SAE' => 0, 
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
		'jenis_bank' => '' , 
		'sandi_bank' =>''
		);
		$query_tabung=$this->master_tabunganmodel->insert_tabungan($data);
		//show_nasabah_id($nasabah_id_max);
		$this->session->set_flashdata('success', 'Data master tabungan berhasil disimpan !');
			redirect('master_tabungan_c/buat_baru');	
	}
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */