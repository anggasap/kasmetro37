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
		
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_nasabah();
			/*$this->setor_tabungan();*/
  		}
		else{
		$this->auth->restrict ();
		$this->auth->cek_menu ( 22 );
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
    public function getNasabahAll(){
        $this->CI =& get_instance();//and a.kcab_id<>'1100'
        $rows = $this->master_nasabahmodel->getNasabahAll();
        $data['data'] = array();
        foreach( $rows as $row ) {

            $array = array(
                'nasabah_id' => trim($row->nasabah_id),
                'nama_nasabah' => trim($row->nama_nasabah),
                'alamat' =>  trim($row->alamat),
                'no_id'    => trim($row->no_id)

            );

            array_push($data['data'],$array);
        }
        //echo json_encode($data['data']);
        $this->output->set_output(json_encode($data));
    }
    function deskripsiNasabah(){
    	$this->CI =& get_instance();
    	$kode = $this->input->post ( 'nId', TRUE );
    	$rows = $this->master_nasabahmodel->getDeskripsiNasabah( $kode );
    	if($rows){
    		foreach ( $rows as $row )
    			
    			$tgllahir = date('d-m-Y', strtotime($row->tgllahir));
    			$tglid = date('d-m-Y', strtotime($row->tglid));
    			
    			$array = array (
    					'baris'=>1,
    					'nasabah_id' => $row->nasabah_id,
    					'nama_nasabah' => $row->nama_nasabah,
    					'nama_alias' => $row->nama_alias,
    					'alamatDom' => $row->alamat_domisili,
    					'tempatlahir' => $row->tempatlahir,
    					'tgllahir'=>$tgllahir,
    					'jenis_kelamin'=>$row->jenis_kelamin,
    					'nasabah_group1'=>$row->nasabah_group1,
    					'gelar_id'=>$row->gelar_id,
    					'KET_GELAR'=>$row->KET_GELAR,
    					'jenis_id'=>$row->jenis_id,
    					'no_id'=>$row->no_id,
    					'tglid'=>$tglid,
    					'KODE_AREA'=>$row->KODE_AREA,
    					'telpon'=>$row->telpon,
    					'NO_HP'=>$row->NO_HP,
    					'alamat'=>$row->alamat,
    					'kode_pos'=>$row->kode_pos,
    					'kelurahan'=>$row->kelurahan,
    					'kecamatan'=>$row->kecamatan,
    					'kota_id'=>$row->kota_id,
    					'KODE_NEGARA'=>$row->KODE_NEGARA,
    					'pekerjaan_id'=>$row->pekerjaan_id,
    					'pekerjaan'=>$row->pekerjaan,
    					'Tempat_Kerja'=>$row->Tempat_Kerja,
    					'NO_NIP'=>$row->NO_NIP,
    					'NPWP'=>$row->NPWP,
    					'Kode_Bidang_Usaha'=>$row->Kode_Bidang_Usaha,
    					'kode_golongan_debitur'=>$row->kode_golongan_debitur,
    					'Kode_Hubungan_Debitur'=>$row->Kode_Hubungan_Debitur,
    					'NASABAH_GROUP4'=>$row->NASABAH_GROUP4,
    					'TUJUAN_PEMBUKAAN_KYC'=>$row->TUJUAN_PEMBUKAAN_KYC,
    					'SUMBER_DANA_KYC'=>$row->SUMBER_DANA_KYC,
    					'PENGGUNAAN_DANA_KYC'=>$row->PENGGUNAAN_DANA_KYC,
    					'nama_kuasa'=>$row->nama_kuasa
    			);
    	}else{
    		$array=array('baris'=>0);
    	}
    
    	$this->output->set_output(json_encode($array));
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
			'alamat'		=> trim($this->input->post('txtAlamatKtp')),
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
			'NAMA_KUASA' =>trim($this->input->post('txtNamaWaris')), 
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
		$query=$this->master_nasabahmodel->insert_nasabah($data);
		if($query){
			$array = array(
					'act'	=>1,
					'notif' =>'Data berhasil disimpan'
			);
		}else{
			$array = array(
					'act'	=>0,
					'notif' =>'Data gagal disimpan'
			);
		}
		$this->output->set_output(json_encode($array));
		//show_nasabah_id($nasabah_id_max);
		//$this->session->set_flashdata('success', 'Data nasabah berhasil masuk');
			//redirect('master_nasabah_c/buat_baru');	
	}
	public function ubahDataNasabah(){
		
		$nasabahId	= trim($this->input->post('txtNasabahId'));
		$jekel	= trim($this->input->post('DL_jenis_kelamin'));
		if($jekel=='1'){
			$jekel='P';
		}else{
			$jekel='L';
		}
		$tgllahir = date('Y-m-d', strtotime(trim($this->input->post('txtTanggalLahir'))));
		$tglid = date('Y-m-d', strtotime(trim($this->input->post('txtIdMasaBerlaku'))));
		
		$data = array (
				'nama_nasabah' => trim($this->input->post('txtNamaNasabah')),
				'nama_alias' => trim($this->input->post('txtNamaAlias')),
				'alamat_domisili' => trim($this->input->post('txtAlamatDom')),
				'tempatlahir' => trim($this->input->post('txtTempatLahir')),
				'tgllahir'=>$tgllahir,
				'jenis_kelamin'=>$jekel,
				'nasabah_group1'=>trim($this->input->post('DL_kode_group1')),
				'gelar_id'=>trim($this->input->post('DL_jenis_gelar')),
				'KET_GELAR'=>trim($this->input->post('txtDesGelar')),
				'jenis_id'=>trim($this->input->post('DL_jenis_Id')),
				'no_id'=>trim($this->input->post('txtNoId')),
				'tglid'=>$tglid,//
				'KODE_AREA'=>trim($this->input->post('txtKodeArea')),
				'telpon'=>trim($this->input->post('txtNoTelp')),
				'NO_HP'=>trim($this->input->post('txtNoHp')),
				'alamat'=>trim($this->input->post('txtAlamatKtp')),
				'kode_pos'=>trim($this->input->post('txtKodePos')),
				'kelurahan'=>trim($this->input->post('txtKelurahan')),
				'kecamatan'=>trim($this->input->post('txtKecamatan')),
				'kota_id'=>trim($this->input->post('DL_jenis_kota')),
				'KODE_NEGARA'=>trim($this->input->post('DL_jenis_negara')),
				'pekerjaan_id'=>trim($this->input->post('DL_jenis_kerja')),
				'pekerjaan'=>trim($this->input->post('txtKetKerja')),
				'Tempat_Kerja'=>trim($this->input->post('txtNamaPerush')),
				'NO_NIP'=>trim($this->input->post('txtNip')),
				'NPWP'=>trim($this->input->post('txtNpwp')),
				'Kode_Bidang_Usaha'=>trim($this->input->post('DL_sid_bidang_usaha')),
				'kode_golongan_debitur'=>trim($this->input->post('DL_sid_gol_debitur')),
				'Kode_Hubungan_Debitur'=>trim($this->input->post('DL_sid_hubungan')),
				'NASABAH_GROUP4'=>trim($this->input->post('DL_kode_group4')),
				'TUJUAN_PEMBUKAAN_KYC'=>trim($this->input->post('txtTujuanPembRek')),
				'SUMBER_DANA_KYC'=>trim($this->input->post('txtSumberDana')),
				'PENGGUNAAN_DANA_KYC'=>trim($this->input->post('txtPenggunaanDana')),
				'nama_kuasa'=>trim($this->input->post('txtNamaWaris'))
		);
		$query = $this->master_nasabahmodel->updateNasabah($data,$nasabahId);
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
	/*
	function show_nasabah_id($nasabah_id_max){
		$array = array (
			'masuk'=>$nasabah_id_max,
		);
		$this->output->set_output(json_encode($array));
	}// end func show nasabah id max
	*/
	function ajaxHapusNasabah(){
		$this->CI =& get_instance();
		$nasabahId = $this->input->post ( 'nasabahId', TRUE );
		$query = $this->master_nasabahmodel->ajaxHapusNasabah( $nasabahId);
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