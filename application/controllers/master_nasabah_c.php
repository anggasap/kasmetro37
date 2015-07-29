<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_nasabah_c extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('master_nasabahmodel');
		$this->load->helper('url');
    }

    public function index()
    {
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	
	
	public function buat_baru(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 22 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_nasabah();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Master Nasabah';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['jenis_gelar']=$this->master_nasabahmodel->get_gelar();
		$data ['jenis_id']=$this->master_nasabahmodel->get_jenis_id();
		$data ['jenis_kota']=$this->master_nasabahmodel->get_jenis_kota();
		$data ['jenis_negara']=$this->master_nasabahmodel->get_jenis_negara();
		$data ['jenis_kerja']=$this->master_nasabahmodel->get_jenis_kerja();
		$data ['kode_group1']=$this->master_nasabahmodel->get_kode_group1();
		$data ['sid_bidang_usaha']=$this->master_nasabahmodel->get_sid_bidang_usaha();
		$data ['sid_gol_debitur']=$this->master_nasabahmodel->get_sid_gol_debitur();
		$data ['sid_hub_bank']=$this->master_nasabahmodel->get_sid_hub_bank();
		$data ['kode_group4']=$this->master_nasabahmodel->get_kode_group4();
		$data ['counter_nasabah_id_length']=$this->master_nasabahmodel->get_counter_nasabah_id_length();
		
		$this->template->set ( 'title', 'Master Nasabah' );
		$this->template->load ( 'tempDataTable', 'admin/master_nasabahv', $data );
		}
	}
	
	public function simpan_nasabah(){
		$input_tgl_lahir=trim($this->input->post('txtTanggalLahir'));
		$timestamp_tgl_lahir = strtotime($input_tgl_lahir);
		$tgl_lahir = date('Y-m-d', $timestamp_tgl_lahir);
		
		$input_tgl_id=trim($this->input->post('txtIdMasaBerlaku'));
		$timestamp_tgl_id = strtotime($input_tgl_id);
		$tgl_id = date('Y-m-d', $timestamp_tgl_id);
		
		$txtCounterNasabahIdLength=trim($this->input->post('txtCounterNasabahIdLength'));
		$jekel=trim($this->input->post('DL_jenis_kelamin'));
		if($jekel=='1'){
			$jekel='P';
		}else{
			$jekel='L';
		}
		$nasabah_id_max=$this->master_nasabahmodel->get_nasabah_id_max();
			foreach ( $nasabah_id_max as $row ){
				$array = array (
					'nasabah_id_max' => $row->nasabah_id_max,
				);
			}
			$nasabah_id_max=$array['nasabah_id_max'];
			
		$format_nasabah_id="%0".$txtCounterNasabahIdLength."u";
		$nasabah_id=sprintf($format_nasabah_id,$nasabah_id_max+1);
		
		$data = array(
		
			'nasabah_id'	=> $nasabah_id,
			'nama_nasabah'	=> trim($this->input->post('txtNamaNasabah')),
			'alamat'		=> trim($this->input->post('txtAlamatDom')),
			'telpon'		=> trim($this->input->post('txtNoTelp')),
			'jenis_kelamin'	=> $jekel, 
			'pekerjaan'		=>trim($this->input->post('txtKetKerja')),
			'tempatlahir'	=>trim($this->input->post('txtTempatLahir')), 
			'tgllahir'		=>$tgl_lahir ,
			'gelar_id'		=>trim($this->input->post('DL_jenis_gelar')), 
			'jenis_id'		=>trim($this->input->post('DL_jenis_Id')), 
			'no_id'			=>trim($this->input->post('txtNoId')), 
			'KETERANGAN' 	=>'', 
			'NASABAH_GROUP1' =>trim($this->input->post('DL_kode_group1')), 
			'NASABAH_GROUP2' 	=>'', 
			'NASABAH_GROUP3' 	=>'',
			'NASABAH_GROUP4' 	=>trim($this->input->post('DL_kode_group4')), 
			'KOTA' =>trim($this->input->post('txtKota')), 
			'NAMA_KUASA' =>'', 
			'alamat_kuasa' =>'', 
			'PEKERJAAN_KUASA' =>'', 
			'TGLLAHIR_KUASA' =>'0000-00-00', 
			'KODE_AREA' =>trim($this->input->post('txtKodeArea')), 
			'pekerjaan_id' =>trim($this->input->post('DL_jenis_kerja')), 
			'JENIS_NASABAH' =>'1', 
			'NO_PASPOR' =>'', 
			'NO_AKTE_AKHIR' =>'', 
			'TGL_AKTE_AKHIR' =>'0000-00-00', 
			'KODE_NEGARA' =>trim($this->input->post('DL_jenis_negara')), 
			'NO_DIN' =>'', 
			'NAMA_ALIAS' =>trim($this->input->post('txtNamaAlias')), 
			'NPWP' =>trim($this->input->post('txtNpwp')), 
			'NAMA1_NASABAH'=>'', 
			'NAMA2_NASABAH' =>'', 
			'NAMA3_NASABAH' =>'', 
			'NAMA4_NASABAH' =>'', 
			'kecamatan' =>trim($this->input->post('txtKecamatan')), 
			'kode_pos' =>trim($this->input->post('txtKodePos')), 
			'kota_id' =>trim($this->input->post('DL_jenis_kota')), 
			'kelurahan' =>trim($this->input->post('txtKelurahan')), 
			'AKUM_JASA_PINJ' =>0.00, 
			'INDEX_SHU_PINJ' =>0.00, 
			'SHU_PINJ' =>0.00, 
			'AKUM_SIMP' =>0.00, 
			'INDEX_SHU_SIMP' =>0.00, 
			'SHU_SIMP' =>0.00, 
			'IBU_KANDUNG' =>'', 
			'KET_GELAR' =>trim($this->input->post('txtDesGelar')), 
			'kode_golongan_debitur' =>trim($this->input->post('DL_sid_gol_debitur')), 
			'Tempat_Kerja' =>trim($this->input->post('txtNamaPerush')), 
			'Kode_Bidang_Usaha' =>trim($this->input->post('DL_sid_bidang_usaha')), 
			'Kode_Hubungan_Debitur' =>trim($this->input->post('DL_sid_hubungan')), 
			'PATH_FOTO' =>'', 
			'PATH_TTANGAN' =>'', 
			'NO_REK_SHU' =>'', 
			'ANGGOTA' =>1, 
			'NO_NIP' =>trim($this->input->post('txtNip')), 
			'TGLID' =>$tgl_id, 
			'TGL_BUKA' =>$this->session->userdata('tglY'), 
			'Black_List' =>0, 
			'TUJUAN_PEMBUKAAN_KYC' =>trim($this->input->post('txTujuanPembRek')), 
			'SUMBER_DANA_KYC' =>trim($this->input->post('txtSumberDana')), 
			'PENGGUNAAN_DANA_KYC' =>trim($this->input->post('txtPenggunaanDana')), 
			'PENDAPATAN_KYC' =>1, 
			'KET_PEKERJAAN' =>trim($this->input->post('txtKetKerja')), //
			'ALAMAT_DOMISILI' =>trim($this->input->post('txtAlamatDom')), 
			'NO_HP' =>trim($this->input->post('txtNoHp')), 
			'TANGGAL_ULANGTAHUN' =>0, 
			'BULAN_ULANGTAHUN' =>0, 
			'STATUS_PROSES' =>0, 
			'STATUS_APPROVAL' =>0, 
			'USER_APPROVAL' =>0, 
			'kota_idSID' =>'', 
			'NO_PASSPORT' =>'', 
			'Status_Marital' =>'', 
			'TGL_MULAI_PASSPORT' =>'0000-00-00', 
			'TGL_AKHIR_PASSPORT' =>'0000-00-00', 
			'bentuk_perusahaan' =>1, 
			'alamat_email' =>'', 
			'mata_uang' =>'', 
			'akte_perusahaan' =>'', 
			'nama_pengurus1' =>'', 
			'jabatan_pengurus1' =>'', 
			'alamat_pengurus1' =>'', 
			'jnskelamin_pengurus1' =>'L', 
			'tmp_lahir_pengurus1' =>'', 
			'tgl_lahir_pengurus1' =>$this->session->userdata('tglY'), 
			'status_pengurus1' =>'LAJANG', 
			'KODE_PJTKI' =>'', 
			'pendidikan_pengurus1' =>'SARJANA', 
			'CAB' =>'001', 
			'OUTLET' =>'', 
			'id_template' =>0,// SET LAGI 
			'ID_DEBITUR' =>'', 
			'ID_DEBITUR_FASILITAS' =>'', 
			'ID_AGUNAN' =>'', 
			'ID_PENJAMIN'=>''
		);
		$query_tabtrans=$this->master_nasabahmodel->insert_nasabah($data);
		//show_nasabah_id($nasabah_id_max);
		$this->session->set_flashdata('success', 'Data nasabah berhasil masuk');
			redirect('master_nasabah_c/buat_baru');	
	}
	/*
	function show_nasabah_id($nasabah_id_max){
		$array = array (
			'masuk'=>$nasabah_id_max,
		);
		$this->output->set_output(json_encode($array));
	}// end func show nasabah id max
	*/
	function nasabah_id_masuk(){
		$this->CI =& get_instance();
		$nama = $this->input->post ( 'nama', TRUE );
		$tgl_lahir = $this->input->post ( 'tgl_lahir', TRUE );
		$no_id = $this->input->post ( 'no_id', TRUE );
		
		$timestamp_tgl_lahir = strtotime($tgl_lahir);
		$tgl_lahir = date('Y-m-d', $timestamp_tgl_lahir);
		
		$rows = $this->master_nasabahmodel->get_nasabah_id_masuk( $nama,$tgl_lahir,$no_id);// 
		if($rows){
		  foreach ( $rows as $row ){
			  $array = array (
			  	  'baris'=>1,
				  'nasabah_id' => $row->nasabah_id
				  
			  );
		  }//foreach
		}else{
			$array=array('baris'=>0);
		}
		$this->output->set_output(json_encode($array));
	}
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */