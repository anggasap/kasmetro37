<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angsur_kredit_harian extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tellertabmodel');
		$this->load->model('homemodel');
		$this->load->model('kreditmodelharian');
		$this->load->model('kasmodel');
		$this->load->helper('url');
    }

    public function index(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'masterpage', 'admin/index',$data );
   		}
	}
	
	function deskripsi_trans_kredit() {
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kodetrans', TRUE );
		$rows = $this->kreditmodelharian->get_deskripsi_trans_kre ( $kode );
		foreach ( $rows as $row )
			$array = array (
				'deskripsitrans' => $row->deskripsi_trans,
				'gl_trans' => $row->gl_trans,
				'tob' => $row->tob
			);
		
		$this->output->set_output(json_encode($array));
	}
	
	function deskripsi_norek_kre(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->kreditmodelharian->get_deskripsi_rek_kre( $kode );
		foreach ( $rows as $row )
			$array = array (
				'NAMA_NASABAH' => $row->NAMA_NASABAH,
				'NASABAH_ID' => $row->nasabah_id,
				'JML_PINJAMAN' => $row->JML_PINJAMAN,
				'POKOK_SALDO_AKHIR' => $row->POKOK_SALDO_AKHIR,
				'BUNGA_SALDO_AKHIR' => $row->BUNGA_SALDO_AKHIR,
				'POKOK_SALDO_SETORAN' => $row->POKOK_SALDO_SETORAN,
				'BUNGA_SALDO_SETORAN' => $row->BUNGA_SALDO_SETORAN,
				'TYPE_ABP' => $row->TYPE_ABP
			);
		
		$this->output->set_output(json_encode($array));
	}
//==========================ANGSURAN YANG MINUS===========================	
	function nilai_tagihan(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$bln = $this->input->post ( 'bln', TRUE );
		$thn = $this->input->post ( 'thn', TRUE );
		$tglsys = $this->input->post ( 'tglsys', TRUE );
		$rows = $this->kreditmodelharian->get_nilai_tagihan_pokok( $kode,$bln,$thn,$tglsys );
		foreach ( $rows as $row )
			$array1 = array (
				'Jpokok' => $row->JPokok,
				'Jbunga' => $row->JBunga,
				'Jdenda' => $row->JDenda,
				'Jadmin' => $row->JAdmin,
				'Ladmin' => $row->LAdmin
			);
		$rows2 = $this->kreditmodelharian->get_nilai_sudah_bayar( $kode,$bln,$thn );
		foreach ( $rows2 as $row2 )
			$array2 = array (
				'Bpokok' => $row2->BPokok,
				'Bbunga' => $row2->BBunga,
				'Bdenda' => $row2->BDenda,
				'Badmin' => $row2->BAdmin,
				'Padmin' => $row2->PAdmin
			);
		$tanggal_max = $this->kreditmodelharian->get_tanggal_max($kode);
		foreach ( $tanggal_max as $row3 )
		$array3 = array (
			'tanggal_max' => $row3->tgl_max
		);
		$bunga_per_tahun = $this->kreditmodelharian->get_bunga_per_tahun($kode);
		foreach ( $bunga_per_tahun as $row4 )
		$array4 = array (
			'bunga_per_tahun' => $row4->SUKU_BUNGA_PER_TAHUN
		);
		$sisa_pokok=$this->kreditmodelharian->get_sisa_pokok($kode);
		foreach ( $sisa_pokok as $row5 )
		$array5 = array (
			'sisa_pokok' => $row5->POKOK_SALDO_AKHIR
		);
		
		$selisih_hari=$tglsys-$array3['tanggal_max'];
		$tanggal_sistem=strtotime($tglsys);
		$tgl_max=strtotime($array3['tanggal_max']);
		$selisih_hari = $tanggal_sistem - $tgl_max; // Number of seconds between the two dates
		$selisih_hari = floor($selisih_hari / (24 * 60 * 60 )); // convert to days
		
		$bunga_per_hari=$array5['sisa_pokok']*($array4['bunga_per_tahun']/100/360)*$selisih_hari;
		
		$pokok_angsur=$array1['Jpokok']-$array2['Bpokok'];
		$bunga_angsur=$array1['Jbunga']-$array2['Bbunga'];
		$denda_angsur=$array1['Jdenda']-$array2['Bdenda'];
		$badmin_angsur=$array1['Jadmin']-$array2['Badmin'];
		$padmin_angsur=$array1['Ladmin']-$array2['Padmin'];
		foreach ( $rows2 as $row2 )
		$array = array (
			'pokok_angsur' => $pokok_angsur,
			'bunga_angsur' => $bunga_angsur,
			'denda_angsur' => $denda_angsur,
			'badmin_angsur' => $badmin_angsur,
			'padmin_angsur' => $padmin_angsur,
			'bunga_harian' =>$bunga_per_hari
		);
			
			
		$this->output->set_output(json_encode($array));
	}
//========================== END ANGSURAN YANG MINUS===========================	
	function cek_transaksi_hari_ini(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$tglsys = $this->input->post ( 'tglsys', TRUE );
		$rows = $this->kreditmodelharian->cek_transaksi_hari_ini($kode,$tglsys);
		foreach ( $rows as $row )
			$array = array (
				'jumlah' => $row->jumlah,
			);
		
	//	$array['jumlah']=1;
		$this->output->set_output(json_encode($array));
	}
	
	
	function cicilan_ke(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$bln = $this->input->post ( 'bln', TRUE );
		$thn = $this->input->post ( 'thn', TRUE );
		$rows = $this->kreditmodelharian->get_cicilan( $kode,$bln,$thn);
		foreach ( $rows as $row )
			$array = array (
				'ANGSURAN_KE' => $row->ANGSURAN_KE,
				'TGL_TRANS' => $row->TGL_TRANS
			);
		//if($array[])
		$this->output->set_output(json_encode($array));
	}
	
	public function setor_pinjaman()
	{
		$this->auth->restrict ();
		$this->auth->cek_menu ( 15 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_angsur();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Angsuran Bunga Harian';
		$data ['counter']=$this->kreditmodelharian->get_counter();
		$data ['transid']=$this->kreditmodelharian->get_transid();
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['kodetrans_kre'] = $this->kreditmodelharian->get_kodetrans_kre ();
		$data ['kodetrans_tab'] = $this->tellertabmodel->get_kodetrans ();
		$data ['rekening_tabung'] = $this->tellertabmodel->get_rekening();
		$data ['rekening_kredit'] = $this->kreditmodelharian->get_rekening_kredit();
		$data ['kode_kredit']=$this->kreditmodelharian->get_kode_setor_kredit();
		$data ['kode_tab']=$this->tellertabmodel->get_kode_tarik();
		
		$this->template->set ( 'title', 'Angsuran Bunga Harian' );
		$this->template->load ( 'masterpage', 'admin/angsur_kredit_harian_view', $data );
		}
	}

	function simpan_angsur()
	{  
	 	$tgl = trim($this->input->post('txtTglTrans'));
	 	$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$pokok_koma = trim($this->input->post('txtAngsPokok'));
	 	$pokok_trans = str_replace(',', '', $pokok_koma); // angsuran pokok 
		$bunga_koma = trim($this->input->post('txtAngsBunga'));
	 	$bunga_trans = str_replace(',', '', $bunga_koma);  // angsuran bunga
		$denda_koma = trim($this->input->post('txtAngsDenda'));
	 	$denda_trans = str_replace(',', '', $denda_koma); //denda angsuran
		$discbunga_koma = trim($this->input->post('txtDiscBunga'));
	 	$discbunga_trans = str_replace(',', '', $discbunga_koma); //diskon bunga
		$discdenda_koma = trim($this->input->post('txtDiscDenda'));
	 	$discdenda_trans = str_replace(',', '', $discdenda_koma); // diskon denda 
		$adm_koma = trim($this->input->post('txtAdm'));
	 	$adm_trans = str_replace(',', '', $adm_koma);  // administrasi
		$pend_koma = trim($this->input->post('txtPendLain'));
	 	$pend_trans = str_replace(',', '', $pend_koma); // pendapatan lain-lain
		$total_koma = trim($this->input->post('txtTotalTrans'));
	 	$total_trans = str_replace(',', '', $total_koma); // total trans
		
		$jns_trans_kre=trim($this->input->post('txtJenisTransKre'));
		$jns_trans_tab=trim($this->input->post('txtJenisTransTab'));
		
		$saldotab_koma = trim($this->input->post('txtSaldoTab'));
	 	$saldotab = str_replace(',', '', $saldotab_koma); // saldo tabungan
		
		//untuk update Kredit
		$pokoksetor_koma = trim($this->input->post('txtPokokSetoran'));
	 	$pokok_setor = str_replace(',', '', $pokoksetor_koma); // pokok disetor
		$bungasetor_koma = trim($this->input->post('txtBungaSetoran'));
	 	$bunga_setor = str_replace(',', '', $bungasetor_koma); // bunga disetor
		$pokokakhir_koma = trim($this->input->post('txtBDpokok'));
	 	$pokok_akhir = str_replace(',', '', $pokokakhir_koma); // pokok disetor
		$bungaakhir_koma = trim($this->input->post('txtBDbunga'));
	 	$bunga_akhir = str_replace(',', '', $bungaakhir_koma); // bunga disetor
		/*$trans_koma = trim($this->input->post('txtTrans'));
	 	$transId = str_replace(',', '', $trans_koma); // bunga disetor*/
		$lunas=0;
		$rektab='';		
		if (trim($this->input->post('txtTipeKredit'))=='KREDIT'){
			$abp='1';
		}
		elseif(trim($this->input->post('txtTipeKredit'))=='ABP'){
			$abp='2';
		}
		$data_kretrans = array(
		 	'KRETRANS_ID'      				=>0,
		 	'TGL_TRANS'        				=>$tgl_trans,
		 	'NO_REKENING'     				=>trim($this->input->post('txtRekKre')),
		 	'MY_KODE_TRANS'   				=>300,
		 	'KUITANSI'      				=>trim($this->input->post('txtKuitansi')),
		 	'ANGSURAN_KE'   				=>0,
		 	'POKOK_TRANS'        			=>$pokok_trans,
		 	'BUNGA_TRANS' 					=>$bunga_trans,
		 	'ADMIN_TRANS'   				=>$adm_trans,
		 	'DENDA_TRANS'           		=>$denda_trans,
		 	'DISC_POKOK'       				=>0,
		 	'DISC_BUNGA'					=>0,//$discbunga_trans
		 	'DISC_DENDA'        			=>0,//$discdenda_trans
		 	'ZAKAT_TRANS'     				=>0,
		 	'FEE_1_TRANS'   				=>0,
		 	'FEE_2_TRANS'  					=>0,
		 	'FEE_3_TRANS'     			 	=>0,
			'KODE_TRANS'					=>trim($this->input->post('DL_kodetrans_kre')),
		 	'PELUNASAN'						=>$lunas,
			'keterangan'					=>trim($this->input->post('txtKet')),
			'NO_TELLER'						=>0,
			'USERID'						=>$this->session->userdata('user_id'),
			'TOB'							=>trim($this->input->post('txtJenisTransKre')),
			'tob_RAK'						=>'',
			'POSTED'						=>'0',
			'NO_REK_TABUNGAN'				=>$rektab,
			'VALIDATED'						=>1,
			'CICILAN_KE'					=>trim($this->input->post('txtCicilan')),
			'JML_ANGSURAN'					=>0,
			'SALDO_AWAL_POKOK'				=>0,
			'SALDO_AWAL_BUNGA'				=>0,
			'FLAG_SI'						=>'N',
			'TGL_INPUT'						=>NULL,
			'TGL_TRANSAKSI'					=>$tgl_trans,
			'KODE_PERK_TABUNGAN'			=>'',
			'KODE_PERK_GL'					=>'',
			'FLAG_CETAK'					=>'N',
			'POKOKMATERAI_TRANS'			=>0,
			'PROVISI_TRANS'     		 	=>0,
		 	'NOTARIEL_TRANS'    		    =>0,
		 	'PREMI_TRANS'     				=>0,
		 	'ADM_TRANS'   					=>0,
		 	'MATERAI_TRANS'      			=>0,
		 	'LAINLAIN_TRANS'   				=>0,
		 	'CAB'        					=>'',
		 	'BONUS_BUNGA' 					=>0,
		 	'DENDA_BONUS'   				=>0,
		 	'CHN'           				=>0,
		 	'Rof_Pokok'       				=>0,
		 	'Rof_Bunga'						=>0,
		 	'tabungan_trans'        		=>0,
		 	'DISC_ADMIN'     				=>0,
		 	'JML_HARI_TUNGGAKAN'   			=>0,
		 	'ABP'   						=>$abp,
		 	'ADMINLAIN_TRANS'       		=>0,
			'CAB_ONLINE'					=>'',
		 	'POKOK_FLAT'					=>0,
			'BUNGA_FLAT'					=>0,
			'USERAPP'						=>$this->session->userdata('user_id'),
			'TGL_FLOATING_RATE'				=>NULL,
			'FLOATING_RATE_PER_TAHUN'		=>0,
			'FLOATING_RATE_PER_ANGSURAN'	=>0,
			'PERSEN_BAYAR'					=>0,
			'BAYAR_TRANS'					=>0,
			'LINK_MODUL'					=>'',
			'LINK_ID'						=>0,
			'LINK_REKENING'					=>'',
			'premikendaraan_trans'			=>0,
			'ACR_TRANS'						=>$pokok_trans,
			'biaya_trans'					=>0,
			'norekening2'					=>''
		 );
		
		$data_kredit=array(
			'POKOK_SALDO_SETORAN' 	=> $pokok_setor + $pokok_trans,
			'POKOK_SALDO_AKHIR'		=> $pokok_akhir - $pokok_trans,
			'BUNGA_SALDO_SETORAN' 	=> $bunga_setor + $bunga_trans,
			'BUNGA_SALDO_AKHIR'		=> $bunga_akhir - $bunga_trans,
		);
		
		$data_counter=array(
				'CounterNo' =>trim($this->input->post('txtcounter'))
		);
		
		$uraian="Angsur kredit : ".trim($this->input->post('txtRekKre'))."-".trim($this->input->post('txtNamaKre'));
		$data_kas = array(
			 	'trans_id'      =>0,
			 	'modul'         =>'KRE',
			 	'tgl_trans'     =>$tgl_trans,
			 	'kode_jurnal'   =>'',
			 	'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			 	'uraian'        =>$uraian,
			 	'my_kode_trans' =>200,
			 	'saldo_trans'   =>$total_trans,
			 	'tob'           =>trim($this->input->post('txtJenisTransKre')),
			 	'tob_RAK'       =>'',
			 	'modul_trans_id'=>0,
			 	'userid'        =>$this->session->userdata('user_id'),
			 	'VALIDATED'     =>0,
			 	'POSTED'        =>0,
			 	'GL_TRANS'      =>trim($this->input->post('txtGlKre')),
			 	'USERAPP'       =>$this->session->userdata('user_id'),
			 	'CAB'           =>''

			 );
		
	
		
				$this->kreditmodelharian->insert_kretrans($data_kretrans);
				$this->kreditmodelharian->update_kredit($data_kredit,trim($this->input->post('txtRekKre')));
				$this->kasmodel->insert_teller($data_kas);
				$this->kreditmodelharian->add_counter($data_counter);	
				$this->session->set_flashdata('success', 'Setoran pinjaman berhasil');
				redirect('angsur_kredit_harian/setor_pinjaman');	
			
			 	
		
		
	}// end function simpan_setor
	
}

/* End of file angsur_kredit_harian.php */
/* Location: ./application/controllers/angsur_kredit_harian.php */