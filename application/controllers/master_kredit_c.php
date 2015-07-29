<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_kredit_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('master_tabunganmodel');
		$this->load->model('master_nasabahmodel');
		$this->load->model('master_kreditmodel');
		$this->load->helper('form','url');
		//$this->load->driver('cache');
		//$this->cache->useMemcache('127.0.0.1', '11211');
    }

    public function index(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'Master Kredit' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	function deskripsi_tab(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->master_kreditmodel->get_deskripsi_tab ( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'NAMA_NASABAH' => $row->NAMA_NASABAH,
				'KODE_PERK' => $row->KODE_PERK,
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
	public function buat_baru(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 26 );
		$data['jenis_kre'] = $this->master_kreditmodel->get_jenis_kre();
		$data['kode_group1'] = $this->master_kreditmodel->get_kodegroup1_kre();
		$data['kode_group2'] = $this->master_kreditmodel->get_kodegroup2_kre();
		$data['kode_group3'] = $this->master_kreditmodel->get_kodegroup3_kre();
		$data['kode_group4'] = $this->master_kreditmodel->get_kodegroup4_kre();
		$data['type_kre'] = $this->master_kreditmodel->get_type_kre();
		$data['kode_satuan_waktu_angs'] = $this->master_kreditmodel->get_sat_waktu_angs();
		$data['kode_sifat_kre'] = $this->master_kreditmodel->get_sifat_kre();
		$data['kode_jenpeng_kre'] = $this->master_kreditmodel->get_jenpeng_kre();
		$data['kode_gol_deb'] = $this->master_kreditmodel->get_gol_deb();
		$data['kode_sekom_kre'] = $this->master_kreditmodel->get_sekom();
		$data['kode_penjamin'] = $this->master_kreditmodel->get_kode_penjamin();
		$data['kode_asuransi'] = $this->master_kreditmodel->get_kode_asuransi();
		$data['kode_metoda'] = $this->master_tabunganmodel->get_kode_metoda();
		$data['kode_sumber_pelunasan'] = $this->master_kreditmodel->get_kode_sumber_pelunasan();
		$data['kode_hub_deb'] = $this->master_tabunganmodel->get_kode_hub_tab();
		$data['kode_jenis_usaha'] = $this->master_kreditmodel->get_kode_jenis_usaha();
		$data['kode_periode_bayar'] = $this->master_kreditmodel->get_kode_periode_bayar();
		$data ['jenis_kota']=$this->master_nasabahmodel->get_jenis_kota();
		$data ['kode_sid_sifat']=$this->master_kreditmodel->get_kode_sid_sifat();
		$data ['kode_sid_jenpeng']=$this->master_kreditmodel->get_kode_sid_jenpeng();
		$data ['kode_sid_bid_usaha']=$this->master_kreditmodel->get_kode_sid_bid_usaha();
		$data ['kode_sid_gol_penj']=$this->master_kreditmodel->get_kode_sid_gol_penj();
		$data ['kode_sid_jenis_asuransi']=$this->master_kreditmodel->get_kode_sid_jenis_asuransi();
		$data ['kode_sid_gol_kre']=$this->master_kreditmodel->get_kode_sid_gol_kre();
		$data ['kode_sid_jenis_fas']=$this->master_kreditmodel->get_kode_sid_jenis_fas();
		$data ['kode_agunan_jenis']=$this->master_kreditmodel->get_kode_agunan_jenis();
		$data ['kode_agunan_ikhukum']=$this->master_kreditmodel->get_kode_agunan_ikhukum();
		$data ['kode_sid_agunan_jenis']=$this->master_kreditmodel->get_kode_sid_agunan_jenis();
		$data ['kode_sid_jenikat']=$this->master_kreditmodel->get_kode_sid_jenikat();
		
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_kredit();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Master Kredit';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		
		/*
		$cache = $this->cache->get('cache_data_nasabah');
		if($cache){
		  $data['data_nasabah'] = $this->cache->get('cache_data_nasabah');
		  //$data['ada_memcached']="ada memcached!!!";
		}else{
		   //$data = $this->sample_model->get_data();
		   $dat=array();
		   $dat = $this->master_tabunganmodel->get_data_nasabah();
		   $this->cache->save('cache_data_nasabah', $dat, 3600);
		   $data['data_nasabah']=$dat;
		}
		*/
		$this->template->set ( 'title', 'Master Kredit' );
		$this->template->load ( 'tempDataTable', 'admin/master_kreditv', $data );
		}
	}
	public function simpan_kredit(){
		$bunga_pinj_tahun=trim($this->input->post('txtBungaFlatTahun'))/100;
		$bunga_pinj_bulan=$bunga_pinj_tahun/12;
		$bunga_pinj=round($bunga_pinj_bulan * str_replace(',', '', trim($this->input->post('txtJmlKre'))),2)*trim($this->input->post('txtJmlAngs'));
		
		$chkAmortProv=trim($this->input->post('chkAmortProv'));
		if($chkAmortProv==""){
			$chkAmortProv=0;
		}else{
			$chkAmortProv=1;
		}
		
		$chkAmortByTrans=trim($this->input->post('chkAmortByTrans'));
		if($chkAmortByTrans==""){
			$chkAmortByTrans=0;
		}else{
			$chkAmortByTrans=1;
		}
		
		
		
		$suku_bunga_angs_kotor = str_replace(',', '', trim($this->input->post('txtAngsEkiv'))) + str_replace(',', '', trim($this->input->post('txtFee1'))) + 
		str_replace(',', '', trim($this->input->post('txtFee2')))+str_replace(',', '', trim($this->input->post('txtFee3')));  
		
		$chkAmortByTransDD=trim($this->input->post('chkAmortByTrans'));
		if($chkAmortByTransDD==""){
			$chkAmortByTransDD=0;
		}else{
			$chkAmortByTransDD=1;
		}
		
		$tgl_real = trim($this->input->post('txtTglReal'));
	 	$timestamp = strtotime($tgl_real);
		$tgl_realisasi = date('Y-m-d', $timestamp);
		
		$tgl_jt = trim($this->input->post('txtJatuhTempo'));
	 	$timestamp = strtotime($tgl_jt);
		$tgl_jatuhtempo = date('Y-m-d', $timestamp);
		
		$tgl_pklama = trim($this->input->post('txtTglPkLama'));
	 	$timestamp = strtotime($tgl_pklama);
		$tgl_pklama = date('Y-m-d', $timestamp);
		
		$tgl_analisa = trim($this->input->post('txtTglAnalisa'));
	 	$timestamp = strtotime($tgl_analisa);
		$tgl_analisa = date('Y-m-d', $timestamp);
		
		//trim($this->input->post(''))
		//str_replace(',', '', trim($this->input->post('')))
		
		$data=array(
			'NO_REKENING' => trim($this->input->post('txtNoRekKre')),
			'NO_ALTERNATIF' => trim($this->input->post('txtPKPensiun')),
			'NASABAH_ID' => trim($this->input->post('txtNasabahId')),
			'PENJAMIN' => trim($this->input->post('txtNamaPenjamin')),
			'PEKERJAAN_PENJAMIN' => trim($this->input->post('txtKerjaPenjamin')),
			'ALAMAT_PENJAMIN' => trim($this->input->post('txtAlamatPenjamin')),
			'BI_GOL_PENJAMIN' => trim($this->input->post('DL_penjamin_kre')),
			'BI_SIFAT' => trim($this->input->post('DL_sifat_kre')),
			'BI_JENIS_PENGGUNAAN' => trim($this->input->post('DL_jenpeng_kre')),
			'BI_GOL_DEBITUR' => trim($this->input->post('DL_gol_deb_kre')),
			'BI_SEKTOR_EKONOMI' => trim($this->input->post('DL_sekom_kre')),
			'JML_PINJAMAN' => str_replace(',', '', trim($this->input->post('txtJmlKre'))),
			'JML_BUNGA_PINJAMAN' => $bunga_pinj,
			'SATUAN_WAKTU_ANGSURAN' => trim($this->input->post('DL_satwaktu_angs_kre')),
			'PERIODE_ANGSURAN' => trim($this->input->post('txtTerminBunga')),// tanya termin bunga
			'JML_ANGSURAN' => str_replace(',', '', trim($this->input->post('txtJmlAngs'))),
			'SUKU_BUNGA_PER_ANGSURAN' => round((trim($this->input->post('txtBungaFlatTahun'))/12),4),
			'BI_JANGKA_WAKTU' => str_replace(',', '', trim($this->input->post('txtJangkaWaktu'))),
			'BI_SUKU_BUNGA' => round((trim($this->input->post('txtBungaFlatTahun'))/12),2),
			'JENIS_PINJAMAN' => trim($this->input->post('DL_jenis_kre')),
			'TYPE_PINJAMAN' => trim($this->input->post('DL_type_kre')),
			'TGL_REALISASI' => $tgl_realisasi,
			'TGL_JATUH_TEMPO' => $tgl_jatuhtempo,
			'AGUNAN_JENIS' => NULL,
			'AGUNAN_IKATAN_HUKUM' => '',
			'AGUNAN' => '',
			'AGUNAN_RINCIAN' => '',
			'AGUNAN_NILAI' => 0.00,
			'BI_AGUNAN_YG_DIJAMINKAN' => 0.00,
			'KODE_ASURANSI' => trim($this->input->post('DL_asuransi_kre')),
			'KODE_METODA' => trim($this->input->post('DL_kodemetoda')),
			'NILAI_ASURANSI' => trim($this->input->post('txtJmlAsuransi')),
			'PROVISI' => str_replace(',', '', trim($this->input->post('txtByProvisi'))),
			'ADM' => str_replace(',', '', trim($this->input->post('txtByAdmin'))),
			'TABUNGAN' => 0.00,// SEMENTAR 0 DULU TANYA
			'MATERAI' => str_replace(',', '', trim($this->input->post('txtByMaterai'))),
			'PREMI' => str_replace(',', '', trim($this->input->post('txtByPremi'))),
			'NOTARIEL' => str_replace(',', '', trim($this->input->post('txtByNotariel'))),
			'LAIN_LAIN' => str_replace(',', '', trim($this->input->post('txtByLain'))),
			'KOLEKTIBILITAS' => 'L',
			'KODE_GROUP1' => trim($this->input->post('DL_kodegroup1_kre')),
			'KODE_GROUP2' => trim($this->input->post('DL_kodegroup2_kre')),
			'KODE_GROUP3' => trim($this->input->post('DL_kodegroup3_kre')),
			'KETERANGAN' => '',
			'STATUS_AKTIF' => 1,
			'TGL_SALDO_AWAL' => '0000-00-00',
			'POKOK_SALDO_AWAL' => 0.00,
			'POKOK_TUNGGAKAN_AWAL' => 0.00,
			'POKOK_SALDO_REALISASI' => 0.00,
			'POKOK_SALDO_TAGIHAN' => 0.00,
			'POKOK_SALDO_SETORAN' => 0.00,
			'POKOK_TUNGGAKAN_AKHIR' => 0.00,
			'POKOK_SALDO_AKHIR' => 0.00,
			'BUNGA_SALDO_AWAL' => 0.00,
			'BUNGA_TUNGGAKAN_AWAL' => 0.00,
			'BUNGA_SALDO_REALISASI' => 0.00,
			'BUNGA_SALDO_TAGIHAN' => 0.00,
			'BUNGA_SALDO_SETORAN' => 0.00,
			'BUNGA_TUNGGAKAN_AKHIR' => 0.00,
			'BUNGA_SALDO_AKHIR' => 0.00,
			'DENDA_TUNGGAKAN_AWAL' => 0.00,
			'DENDA_SALDO_TAGIHAN' => 0.00,
			'DENDA_SALDO_SETORAN' => 0.00,
			'DENDA_TUNGGAKAN_AKHIR' => 0.00,
			'SALDO_NOMINATIF' => 0.00,
			'TGL_TRANS_TERAKHIR' => '0000-00-00',
			'KOLEK' => 'L',
			'USERID' => $this->session->userdata('user_id'),
			'NAMA_PASANGAN' => trim($this->input->post('txtNamaSuamiIsteri')),
			'PEKERJAAN_PASANGAN' => trim($this->input->post('txtKerjaSuamiIsteri')),
			'ALAMAT_PASANGAN' => trim($this->input->post('txtAlamatSuamiIsteri')),
			'STATUS_PASANGAN' => trim($this->input->post('DL_suami_isteri')),
			'GRACE_PERIODE' => 0,
			'TGL_PENGAJUAN' => $this->session->userdata('tglY'),
			'PROVISI_SALDO_AWAL' => 0.00,
			'AMORTISASI' => 0.00,
			'PROVISI_SALDO_AKHIR' => 0.00,
			'TGL_LUNAS' => '0000-00-00',
			'ADM_PER_BLN' => trim($this->input->post('txtAdmin')),
			'SUKU_BUNGA_PER_TAHUN' => trim($this->input->post('txtBungaFlatTahun')),
			'PERIODE_ANGSURAN_POKOK' => trim($this->input->post('txtTerminPokok')),//termin pokok
			'DENDA_PER_ANGSURAN' => str_replace(',', '', trim($this->input->post('txtDenda'))),
			'SALDO_AKHIR_ACCRUAL' => 0,
			'TGL_BAYAR' => substr($tgl_realisasi,-2),// belum
			'ANGSURAN_POKOK' => 0.00,
			'ANGSURAN_BUNGA' => 0.00,
			'TOTAL_BUNGA_PINJAMAN' => 0.00,
			'ANGSURAN_TOTAL' => 0.00,
			'TOTAL_BIAYA' => 0.00,
			'PERIODE_ANGSURAN_BUNGA' => 0,
			'NILAI_LIKUIDASI' => 0.00,
			'SID_GOL_PENJAMIN' => trim($this->input->post('DL_sid_gol_penj')),
			'SID_SIFAT' => trim($this->input->post('DL_sid_sifat')),
			'SID_JENIS_PENGGUNAAN' => trim($this->input->post('DL_sid_jenpeng')),
			'SID_SEKTOR_EKONOMI' =>trim($this->input->post('DL_sid_bid_usaha')) ,
			'SID_GOLKREDIT' => trim($this->input->post('DL_sid_gol_kre')),
			'SID_KODE_AGUNAN' => '',
			'SID_AGUNAN_IKATAN_HUKUM' => '',
			'TGL_PK_LAMA' => $tgl_pklama,
			'NO_PK_LAMA' => trim($this->input->post('txtPkLama')),
			'STATUS_KREDIT' => trim($this->input->post('')),
			'SID_JENISFASILITAS' => trim($this->input->post('DL_sid_jenis_fas')),
			'SID_JENISASURANSI' => trim($this->input->post('DL_sid_jenis_asuransi')),
			'PEMILIK_AGUNAN' => '',
			'alamat_agunan' => '',
			'BUKTI_AGUNAN' => '',
			'ID_PENJAMIN' => trim($this->input->post('txtIdPenjamin')),
			'STATUS_IDULFITRI' => 0,
			'GRACE_PERIOD' => trim($this->input->post('txtGraceHari')),
			'KODE_GROUP4' => trim($this->input->post('DL_kodegroup4_kre')),
			'TGL_TG_POKOK' => '0000-00-00',
			'TGL_TG_BUNGA' => '0000-00-00',
			'KODE_HARI' => '',
			'Realisasi_Bln_ini' => 0.00,
			'bunga_Bln_ini' => 0.00,
			'STATUS_KOLEK' => 0,
			'PERSEN_PROVISI' => str_replace(',', '', trim($this->input->post('txtByProvisiPersen'))),
			'PERSEN_ADM' => str_replace(',', '', trim($this->input->post('txtByAdminPersen'))),
			'BI_AGUNAN_NILAI' => 0.00,//update dr multi agunan
			'NO_REK_DEBET' => trim($this->input->post('txtNoRekTabWajib')),
			'NO_REK_NOTARIEL' => trim($this->input->post('txtNoRekNotariel')),
			'GL_NOTARIEL' => trim($this->input->post('txtGLNotariel')),//gl notariel
			'NILAI_PENJAMINAN' => str_replace(',', '', trim($this->input->post('txtJmlAsuransiPersen'))),
			'SUKU_BUNGA_EKIVALEN' => str_replace(',', '', trim($this->input->post('txtBungaEkiv'))),
			'TYPE_CHANNELING' => 0,
			'ACC_BLN_INI' => 0.00,
			'POT_POKOK' => 0.00,
			'POT_BUNGA' => 0.00,
			'SHU_THN_INI' => 0.00,
			'BUNGA_EFEKTIF_THN_INI' => 0.00,
			'TGL_ANGSURAN' => $tgl_realisasi,// gak tau dari mana nih=========================cek lagi ya
			'FEE_BUNGA_1_PER_TAHUN' => str_replace(',', '', trim($this->input->post('txtFee1'))),
			'FEE_BUNGA_2_PER_TAHUN' => str_replace(',', '', trim($this->input->post('txtFee2'))),
			'FEE_BUNGA_3_PER_TAHUN' => str_replace(',', '', trim($this->input->post('txtFee3'))),
			'NO_LAMA' => '',
			'SALDO_AKHIR' => 0.00,
			'selisih' => 'N',
			'JML_ANGSURAN_PER_BULAN' => 0,
			'TAGIHAN_JT' => 0,
			'FLAG_JADWAL' => 'TERKUNCI',
			'KRE_FLAG_SI' => 0,
			'KOLEKT' => '',
			'pDenda' => 0.00,
			'KUANTUM' => 1,
			'JML_HARI_ACC' => 0,
			'METODE_JURNAL' => '',
			'TOTAL_ACC' => 0.00,
			'NILAI_TAKSASI' => 1.00,
			'AKAD' => 0,
			'KODE_SUMBER_DANA' => '00',// KODE SUMBER DANA TIDAK DITAMPILKAN DI INTERFACE
			'baris_buku' => 0,
			'POKOK_MATERAI' => str_replace(',', '', trim($this->input->post('txtByMateraiHpp'))),
			'GL_HOLD' => trim($this->input->post('txtGLTabWajib')),//gl HOLD
			'PROSEN_BONUS_BUNGA' => str_replace(',', '', trim($this->input->post('txtBonus'))),
			'POKOK_SALDO_DISC' => 0.00,
			'BUNGA_SALDO_DISC' => 0.00,
			'JENIS_CHANNELING' => '000',
			'RoF' => 0,
			'tgl_Rof' => '0000-00-00',
			'POKOK_SALDO_ROF' => 0.00,
			'RsC' => 0,
			'tgl_RsC' => '0000-00-00',
			'NO_PK_BARU' => trim($this->input->post('txtPkBaru')),
			'AMORTISASI_PROVISI' => $chkAmortProv,
			'amortisasi_biaya_transaksi' => $chkAmortByTrans,
			'SALDO_POKOK_DEBIUS' => 0.00,
			'OVERDRAFT' => 0.00,
			'FT_TG_POKOK' => 0,
			'FT_TG_BUNGA' => 0,
			'FLAG_TOLERANSI' => 'SESUAI JADWAL',
			'TGL_TOLERANSI' => trim($this->input->post('txtHariTol')),
			'NO_PENSIUN' => trim($this->input->post('txtNoPensiun')),
			'NO_KARIP' => trim($this->input->post('txtNoPensiun')),
			'JENIS_PENSIUN' => trim($this->input->post('txtJenisPensiun')),
			'ARO' => 0,
			'Jadwal_Jatuh_Tempo' => 0,
			'ft_pokok' => 0,
			'ft_bunga' => 0,
			'BUNGA_DISC_AWAL' => 0.00,
			'DENDA_DISC_AWAL' => 0.00,
			'ADMIN_TUNGGAKAN_AWAL' => 0.00,
			'ADMIN_DISC_AWAL' => 0.00,
			'SUKU_BUNGA_PER_ANGSURAN_KOTOR' => round((trim($this->input->post('txtBungaFlatTahun'))/12),4) ,//$suku_bunga_angs_kotor
			'NO_REK_DEBET_TAB' => '',
			'METODE_AUTO_DEBET' => '',
			'PREMI_KENDARAAN' => 0.00,
			'TGL_PK_AKHIR' => NULL,
			'NO_AGUNAN' => '',
			'Rekening_RsC' => 0,
			'KOLEKTIBILITAS_RSC' => 'L',
			'STATUS_APPROVAL' => 0,
			'USER_APPROVAL' => 0,
			'ft_real' => 0,
			'tunggakan_bunga' => 0.00000,
			'tunggakan_pokok' => 0.00000,
			'TYPE_ABP' => trim($this->input->post('DL_tipe_kre')),
			'NISBAH' => 0,
			'FLAG_SUMBER_DANA' => 1,
			'SANGGUP_BAYAR_POKOK' => str_replace(',', '', trim($this->input->post('txtAngsDisanggupi'))),
			'GRACE_PERIOD_POKOK' => str_replace(',', '', trim($this->input->post('txtGracePokok'))),
			'GRACE_PERIOD_BUNGA' => str_replace(',', '', trim($this->input->post('txtGraceBunga'))),
			'FAKTOR_ANUITAS' => str_replace(',', '', trim($this->input->post('txtFaktorAnnuitas'))),
			'KONVERSI_ANUITAS' => 0,
			'KODE_AGUNAN' => '',
			'USER_AMBIL_JAMINAN' => 0,
			'KET_AMBIL_JAMINAN' => '',
			'TGL_AMBIL_JAMINAN' => '0000-00-00',
			'NASABAH_AMBIL_JAMINAN' => '',
			'PATH_AGUNAN' => '',
			'CAB' => '001',
			'photo_agunan' => NULL,
			'TGK_ANGS_KE' => 0,
			'ANGSURAN_ADMIN' => 0.00,// TANYA GAK TAU DARI MANA
			'ANGSURAN_PREMI' => str_replace(',', '', trim($this->input->post('txtAngsPremi2'))),
			'TOTAL_PREMI' => str_replace(',', '', trim($this->input->post('txtAngsPremi3'))),
			'TGL_JT_AGUNAN' => NULL,
			'TGL_ANALISA' => $tgl_analisa ,// RUBAH TANGGAL
			'JKW_PREMI' => str_replace(',', '', trim($this->input->post('txtAngsPremi1'))),
			'denda_after_jt' => str_replace(',', '', trim($this->input->post('txtDendaJT'))),
			'NO_REK_PREMI' => trim($this->input->post('txtNoRekPremi')),
			'GL_PREMI' => trim($this->input->post('txtGLPremi')),//gAK TAHU gl NYA
			'REVIEW_BUNGA' => 0,
			'TUJUAN_PENGGUNAAN' => trim($this->input->post('txtSidTujuanPenggunaan')),
			'JENIS_AKAD' => '',
			'PERIODE_SEWA' => '',
			'PERSEN_ADM_PER_BLN' => str_replace(',', '', trim($this->input->post('txtAdmin'))),
			'PERSEN_ADM_PER_ANGSURAN' => str_replace(',', '', trim($this->input->post('txtAdminG'))),
			'DROPING_BERTAHAP' => 0,
			'bayar_angsuran_awal' => 0,
			'mtd_bg_hsl_sd' => '2',
			'gol_penjamin' =>  trim($this->input->post('DL_penjamin_kre')),
			'gol_nasabah' => '876',// cek lagi kayanya ambil dari tabel nasabah
			'lok_usaha_nasabah' => trim($this->input->post('DL_jenis_kota')),
			'gol_piutang' => trim($this->input->post('DL_sifat_kre')),
			'pendapatan_diterima' => 0.00,
			'saldo_pokok_ppap' => 0.00,
			'QQ' => '',
			'NO_SCORING' => '',
			'biaya_transaksi' => str_replace(',', '', trim($this->input->post('txtByTrans'))),
			'PERSEN_BIAYA_TRANSAKSI' => str_replace(',', '', trim($this->input->post('txtByTransPersen'))),
			'KODE_BI_HUBUNGAN' => trim($this->input->post('DL_kodehub_deb')),
			'SUMBER_DANA_PELUNASAN' => trim($this->input->post('DL_sumber_pelunasan')),
			'JENIS_USAHA' => trim($this->input->post('DL_jenis_usaha')),
			'biaya_ditanggung_debitur' => $chkAmortByTransDD,
			'OUTLET' => '',
			'biaya_saldo_awal' => 0.00,
			'periode_pembayaran' => trim($this->input->post('DL_kodeperiode_byr')),
			'kode_metoda_debitur' => '',
			'norekening2' => trim($this->input->post('txtNoRekKre')),
			'kode_group5' => '',
			'kode_group6' => ''
		);
		$query_kredit=$this->master_kreditmodel->insert_kredit($data);
		$this->session->set_flashdata('success', 'Data nasabah berhasil masuk');
		redirect('master_kredit_c/buat_baru');
		
	}
	
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */