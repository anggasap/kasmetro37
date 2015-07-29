<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Real_kredit_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('kasmodel');
		$this->load->model('kreditmodel');
		$this->load->model('realkreditmodel');
		$this->load->helper('form','url');
    }

    public function index()
    {
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'Realisasi Kredit' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	public function realisasi(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 28 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_realisasi();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Realisasi Kredit';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['counter']=$this->kreditmodel->get_counter();
		$data ['kodetrans_kre_def']=$this->realkreditmodel->get_kode_setor_kredit_real();
		

		$this->template->set ( 'title', 'Realisasi Kredit' );
		$this->template->load ( 'tempDataTable', 'admin/realisasi_kreditv', $data );
		}
	}
	
	function deskripsi_norek_kre(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->realkreditmodel->get_deskripsi_rek_kre( $kode );
		if($rows){
		  foreach ( $rows as $row )
			  $array = array (
			  	  'baris'=>1,
				  'JML_PINJAMAN' => $row->JML_PINJAMAN,
				  'JML_BUNGA_PINJAMAN' => $row->JML_BUNGA_PINJAMAN,
				  'JML_ANGSURAN' => $row->JML_ANGSURAN,
				  'BI_JANGKA_WAKTU' => $row->BI_JANGKA_WAKTU,
				  'JENIS_PINJAMAN' => $row->JENIS_PINJAMAN,
				  'TYPE_PINJAMAN' => $row->TYPE_PINJAMAN,
				  'TGL_REALISASI' => $row->TGL_REALISASI,
				  'TGL_JATUH_TEMPO' => $row->TGL_JATUH_TEMPO,
				  'PROVISI' => $row->PROVISI,
				  'ADM' => $row->ADM,
				  'MATERAI' => $row->MATERAI,
				  'POKOK_MATERAI' => $row->POKOK_MATERAI,
				  'PREMI' => $row->PREMI,
				  'NOTARIEL' => $row->NOTARIEL,
				  'LAIN_LAIN' => $row->LAIN_LAIN,
				  'biaya_transaksi' => $row->biaya_transaksi,
				  'STATUS_AKTIF' => $row->STATUS_AKTIF,
				  'NAMA_NASABAH' => $row->NAMA_NASABAH,
				  'DESKRIPSI_JENIS_KREDIT' => $row->DESKRIPSI_JENIS_KREDIT,
				  'DESKRIPSI_TYPE_KREDIT' => $row->DESKRIPSI_TYPE_KREDIT,
				  'NASABAH_ID' => $row->nasabah_id,
				  'SUKU_BUNGA_PER_ANGSURAN' => $row->SUKU_BUNGA_PER_ANGSURAN,
				  'TYPE_ABP' => $row->TYPE_ABP
			  );
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
	public function simpan_realisasi(){
		$tgl_trans = trim($this->input->post('txtTglTrans'));
	 	$timestamp = strtotime($tgl_trans);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		//trim($this->input->post(''))
		//str_replace(',', '', trim($this->input->post('')))
		$data_counter=array(
				'CounterNo' =>trim($this->input->post('txtcounter'))
		);
		$this->kreditmodel->add_counter($data_counter);
		
		$data_kretrans=array(
		'KRETRANS_ID' => 0 ,
		 'TGL_TRANS' => $tgl_trans,
		 'NO_REKENING' => trim($this->input->post('txtNoRekKre')),
		 'MY_KODE_TRANS' => 100,
		 'KUITANSI' => trim($this->input->post('txtKuitansi')),
		 'ANGSURAN_KE' => 0,
		 'POKOK_TRANS' => str_replace(',', '', trim($this->input->post('txtJmlKre'))),
		 'BUNGA_TRANS' => str_replace(',', '', trim($this->input->post('txtJmlBunga'))),
		 'ADMIN_TRANS' => 0.00,
		 'DENDA_TRANS' => 0.00,
		 'DISC_POKOK' => 0.00,
		 'DISC_BUNGA' => 0.00,
		 'DISC_DENDA' => 0.00,
		 'ZAKAT_TRANS' => 0,
		 'FEE_1_TRANS' => 0,
		 'FEE_2_TRANS' => 0,
		 'FEE_3_TRANS' => 0,
		 'KODE_TRANS' => '001',
		 'PELUNASAN' => 0,
		 'keterangan' => '',
		 'NO_TELLER' => 0,
		 'USERID' => $this->session->userdata('user_id'),
		 'TOB' => 'T',
		 'tob_RAK' => '',
		 'POSTED' => 0,
		 'NO_REK_TABUNGAN' => '',
		 'VALIDATED' => 1,
		 'CICILAN_KE' => 0,
		 'SALDO_AWAL_POKOK' => 0.00,
		 'SALDO_AWAL_BUNGA' => 0.00,
		 'FLAG_SI' => 'N',
		 'TGL_INPUT' => '0000-00-00',
		 'TGL_TRANSAKSI' => '0000-00-00',
		 'KODE_PERK_TABUNGAN' => '',
		 'KODE_PERK_GL' => '',
		 'FLAG_CETAK' => 'N',
		 'POKOKMATERAI_TRANS' => str_replace(',', '', trim($this->input->post('txtPkkMaterai'))),
		 'PROVISI_TRANS' => str_replace(',', '', trim($this->input->post('txtProvisi'))),
		 'NOTARIEL_TRANS' => str_replace(',', '', trim($this->input->post('txtNotariel'))),
		 'PREMI_TRANS' => str_replace(',', '', trim($this->input->post('txtPremi'))),
		 'ADM_TRANS' => str_replace(',', '', trim($this->input->post('txtAdm'))),
		 'MATERAI_TRANS' => str_replace(',', '', trim($this->input->post('txtMaterai'))),
		 'LAINLAIN_TRANS' => str_replace(',', '', trim($this->input->post('txtLain'))),
		 'CAB' => '',
		 'BONUS_BUNGA' => 0.00,
		 'DENDA_BONUS' => 0.00,
		 'CHN' => 0,
		 'Rof_Pokok' => 0.00,
		 'Rof_bunga' => 0.00,
		 'tabungan_trans' => 0.00,
		 'JML_ANGSURAN' => 1,
		 'DISC_ADMIN' => 0.00,
		 'JML_HARI_TUNGGAKAN' => 0,
		 'premikendaraan_trans' => 0.00,
		 'CAB_ONLINE' => '',
		 'ABP' => trim($this->input->post('txtTypeABP')),
		 'ADMINLAIN_TRANS' => 0.00,
		 'POKOK_FLAT' => 0.00,
		 'BUNGA_FLAT' => 0.00,
		 'USERAPP' => $this->session->userdata('user_id'),
		 'TGL_FLOATING_RATE' => NULL,
		 'FLOATING_RATE_PER_TAHUN' => 0,
		 'FLOATING_RATE_PER_ANGSURAN' => 0,
		 'PERSEN_BAYAR' => 0,
		 'BAYAR_TRANS' => 0.00,
		 'LINK_MODUL' => '',
		 'LINK_ID' => 0,
		 'LINK_REKENING' => '',
		 'ACR_TRANS' => 0.00,
		 'biaya_trans' => str_replace(',', '', trim($this->input->post('txtByTrans'))),
		 'norekening2'=> trim($this->input->post('txtNoRekKre'))
		);
		
		$this->kreditmodel->insert_kretrans($data_kretrans);
		$data_kredit=array(
		'STATUS_AKTIF' => 2
		 );
		$this->kreditmodel->update_kredit($data_kredit,trim($this->input->post('txtNoRekKre')));
		
		
		$row_get_kretrans_id=$this->realkreditmodel->get_kretrans_id($tgl_trans,trim($this->input->post('txtNoRekKre')),str_replace(',', '', trim($this->input->post('txtJmlKre'))),trim($this->input->post('txtKuitansi')));
		foreach ( $row_get_kretrans_id as $row ){
			$array = array (
				'KRETRANS_ID' => $row->KRETRANS_ID
			);
		}
		$kretrans_id_max=$array['KRETRANS_ID'];
/*====================== DATA KAS REALISASI ======================*/		
		$uraian_kas_real="Realisasi Kredit Tunai : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_real = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_real,
		'my_kode_trans' =>300,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtJmlKre'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_real);	
/*====================== DATA KAS PROVISI ======================*/
	if(str_replace(',', '', trim($this->input->post('txtProvisi')))>0){	
		$uraian_kas_provisi="Provisi Realisasi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_provisi = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_provisi,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtProvisi'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_provisi);
	}
/*====================== DATA KAS ADMINISTRASI ======================*/	
	if(str_replace(',', '', trim($this->input->post('txtAdm')))>0){
		$uraian_kas_administrasi="Administrasi Realisasi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_administrasi = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_administrasi,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtAdm'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_administrasi);
	}
/*====================== DATA KAS MATERAI ======================*/	
	if(str_replace(',', '', trim($this->input->post('txtMaterai')))>0){
		$uraian_kas_materai="Materai Realisasi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_materai = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_materai,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtMaterai'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_materai);
	}
/*====================== DATA KAS PREMI ======================*/
	if(str_replace(',', '', trim($this->input->post('txtPremi')))>0){	
		$uraian_kas_premi="Premi Realisasi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_premi = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_premi,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtPremi'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_premi);
	}
/*====================== DATA KAS NOTARIEL ======================*/	
	if(str_replace(',', '', trim($this->input->post('txtNotariel')))>0){
		$uraian_kas_notariel="Biaya Notariel Realisasi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_notariel = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_notariel,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtNotariel'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_notariel);
	}
/*====================== DATA KAS LAIN-LAIN ======================*/	
	if(str_replace(',', '', trim($this->input->post('txtLain')))>0){
		$uraian_kas_lain="Biaya lain-lain Realisasi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_lain = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_lain,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtLain'))),
		'tob'           =>'T',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_lain);
	}
/*====================== DATA KAS BY TRANS KRE ======================*/	
	if(str_replace(',', '', trim($this->input->post('txtByTrans')))>0){
		$uraian_kas_trans="Biaya transaksi Kredit : #".trim($this->input->post('txtNoRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas_trans = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas_trans,
		'my_kode_trans' =>200,
		'saldo_trans'   =>str_replace(',', '', trim($this->input->post('txtByTrans'))),
		'tob'           =>'O',
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>'',
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>'',
		//'TGL_INPUT'		=>'0000-00-00'
	 	);
		$this->kasmodel->insert_teller($data_kas_trans);
	}
	$this->session->set_flashdata('success', 'Realisasi pinjaman berhasil');
		  redirect('real_kredit_c/realisasi');
	}// end function simpan_realisasi
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */