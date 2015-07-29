<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angsur_kredit extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();

		session_start ();
		$this->load->model('tellertabmodel');
		$this->load->model('homemodel');
		$this->load->model('kreditmodel');
		$this->load->model('kasmodel');
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
	
	function deskripsi_trans_kredit() {
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kodetrans', TRUE );
		$rows = $this->kreditmodel->get_deskripsi_trans_kre ( $kode );
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
		$rows = $this->kreditmodel->get_deskripsi_rek_kre( $kode );
		if($rows){
		  foreach ( $rows as $row )
			  $array = array (
			  	  'baris'=>1,
				  'NAMA_NASABAH' => $row->NAMA_NASABAH,
				  'NASABAH_ID' => $row->nasabah_id,
				  'JML_PINJAMAN' => $row->JML_PINJAMAN,
				  'POKOK_SALDO_AKHIR' => $row->POKOK_SALDO_AKHIR,
				  'BUNGA_SALDO_AKHIR' => $row->BUNGA_SALDO_AKHIR,
				  'POKOK_SALDO_SETORAN' => $row->POKOK_SALDO_SETORAN,
				  'BUNGA_SALDO_SETORAN' => $row->BUNGA_SALDO_SETORAN,
				  'TYPE_ABP' => $row->TYPE_ABP
			  );
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
//==========================ANGSURAN YANG MINUS===========================	
	function nilai_tagihan(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$bln = $this->input->post ( 'bln', TRUE );
		$thn = $this->input->post ( 'thn', TRUE );
		$tglsys = $this->input->post ( 'tglsys', TRUE );
		$rows = $this->kreditmodel->get_nilai_tagihan_pokok( $kode,$bln,$thn,$tglsys );
		foreach ( $rows as $row )
			$array1 = array (
				'Jpokok' => $row->JPokok,
				'Jbunga' => $row->JBunga,
				'Jdenda' => $row->JDenda,
				'Jadmin' => $row->JAdmin,
				'Ladmin' => $row->LAdmin
			);
		$rows2 = $this->kreditmodel->get_nilai_sudah_bayar( $kode,$bln,$thn );
		foreach ( $rows2 as $row2 )
			$array2 = array (
				'Bpokok' => $row2->BPokok,
				'Bbunga' => $row2->BBunga,
				'Bdenda' => $row2->BDenda,
				'Badmin' => $row2->BAdmin,
				'Padmin' => $row2->PAdmin
			);
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
				'padmin_angsur' => $padmin_angsur
			);
		$this->output->set_output(json_encode($array));
	}
//========================== END ANGSURAN YANG MINUS===========================	
	function cek_transaksi_hari_ini(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$tglsys = $this->input->post ( 'tglsys', TRUE );
		$rows = $this->kreditmodel->cek_transaksi_hari_ini($kode,$tglsys);
		foreach ( $rows as $row )
			$array = array (
				'jumlah' => $row->jumlah,
			);
		
	//	$array['jumlah']=1;
		$this->output->set_output(json_encode($array));
	}
	function pelunasan(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->kreditmodel->get_pelunasan($kode);
		foreach ( $rows as $row )
			$array = array (
				'pokok_angsur' => $row->pokok_angsur,
				'bunga_angsur' => $row->bunga_angsur
			);
		
		$this->output->set_output(json_encode($array));
	}
	
	function cicilan_ke(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$bln = $this->input->post ( 'bln', TRUE );
		$thn = $this->input->post ( 'thn', TRUE );
		$rows = $this->kreditmodel->get_cicilan( $kode,$bln,$thn);
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
		$this->auth->cek_menu ( 14 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_angsur();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Angsuran Pinjaman';
		$data ['counter']=$this->kreditmodel->get_counter();
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['kodetrans_kre'] = $this->kreditmodel->get_all_kodetrans_kre_setor ();
		$data ['kode_kredit']=$this->kreditmodel->get_kode_setor_kredit();
		
		$this->template->set ( 'title', 'Angsuran Pinjaman' );
		$this->template->load ( 'tempDataTable', 'admin/angsur_kreditv', $data );
		}
	}
	public function setor_pinjaman_tab(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 23 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_angsur();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Angsuran Pinjaman OB Tabungan';
		$data ['counter']=$this->kreditmodel->get_counter();
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['kodetrans_kre'] = $this->kreditmodel->get_kode_setor_kredit_ob();//kd_kre_def
		$data ['kodetrans_kre_def_ob']=$this->kreditmodel->get_kode_setor_kredit_ob();
		$data ['kodetrans_tab_ob'] = $this->tellertabmodel->get_all_kodetrans_tab_tarik_ob ();
		$data ['kodetrans_tab_def_ob'] = $this->tellertabmodel->get_kode_tarik_ob();

		$this->template->set ( 'title', 'Angsuran Pinjaman OB Tabungan' );
		$this->template->load ( 'tempDataTable', 'admin/angsur_kredit_tabv', $data );
		}
	}

	function simpan_angsur(){  
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
		$jml_tab_wajib_koma=trim($this->input->post('txtJmlTabWajib'));// tabungan wajib
		$jml_tab_wajib = str_replace(',', '', $jml_tab_wajib_koma);
		$total_koma = trim($this->input->post('txtTotalTrans'));
	 	$total_trans = str_replace(',', '', $total_koma); // total trans
		$total_trans=$total_trans-$jml_tab_wajib;
		
		$jns_trans_kre=trim($this->input->post('txtJenisTransKre'));
		
		//untuk OB dr tabungan 
		$txtRekTabOb=trim($this->input->post('txtRekTabOb'));
		if (isset($txtRekTabOb)){
			$txtRekTabOb=$txtRekTabOb;
			$jns_trans_tab=trim($this->input->post('txtJenisTransTab'));
			$txtNamaTabOb=trim($this->input->post('txtNamaTabOb'));
			$saldotab_koma = trim($this->input->post('txtSaldoTab'));
	 		$saldotab = str_replace(',', '', $saldotab_koma); // saldo tabungan
		}else{
			$txtRekTabOb="";
		}
		// end OB dr tabungan
		
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
		 	'DISC_BUNGA'					=>$discbunga_trans,
		 	'DISC_DENDA'        			=>$discdenda_trans,
		 	'ZAKAT_TRANS'     				=>0,
		 	'FEE_1_TRANS'   				=>0,
		 	'FEE_2_TRANS'  					=>0,
		 	'FEE_3_TRANS'     			 	=>0,
			'KODE_TRANS'					=>trim($this->input->post('DL_kodetrans_kre')),
		 	'PELUNASAN'						=>0,
			'keterangan'					=>trim($this->input->post('txtKet')),
			'NO_TELLER'						=>0,
			'USERID'						=>$this->session->userdata('user_id'),
			'TOB'							=>trim($this->input->post('txtJenisTransKre')),
			'tob_RAK'						=>'',
			'POSTED'						=>'0',
			'NO_REK_TABUNGAN'				=>$txtRekTabOb,//$rektab OB
			'VALIDATED'						=>1,
			'CICILAN_KE'					=>trim($this->input->post('txtCicilan')),
			'JML_ANGSURAN'					=>1,
			'SALDO_AWAL_POKOK'				=>0,
			'SALDO_AWAL_BUNGA'				=>0,
			'FLAG_SI'						=>'N',
			'TGL_INPUT'						=>'0000-00-00',
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
		 	'tabungan_trans'        		=>$jml_tab_wajib,//51
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
			'ACR_TRANS'						=>0,//$pokok_trans
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
		
		$this->kreditmodel->insert_kretrans($data_kretrans);
		$this->kreditmodel->update_kredit($data_kredit,trim($this->input->post('txtRekKre')));
		
		$row_get_kretrans_id=$this->kreditmodel->get_kretrans_id($tgl_trans,trim($this->input->post('txtRekKre')),$pokok_trans,$bunga_trans,trim($this->input->post('txtKuitansi')));
		foreach ( $row_get_kretrans_id as $row ){
			$array = array (
				'KRETRANS_ID' => $row->KRETRANS_ID
			);
		}
		$kretrans_id_max=$array['KRETRANS_ID'];
		
		
		// JIKA OB DARI TABUNGAN URAIANNYA ADALAH
		if (trim($this->input->post('txtRekTabOb'))<>''){
			$uraian_kas="OB/PB Angsuran Kredit ".trim($this->input->post('txtRekKre'))."-".trim($this->input->post('txtNamaKre'))."dari Tab No Rek :".$txtRekTabOb."-".$txtNamaTabOb;
		}else{
			$uraian_kas="Angsur kredit : ".trim($this->input->post('txtRekKre'))."-".trim($this->input->post('txtNamaKre'));
		}
		$data_kas = array(
		'trans_id'      =>0,
		'modul'         =>'KRE',
		'tgl_trans'     =>$tgl_trans,
		'kode_jurnal'   =>'',
		'no_bukti'      =>trim($this->input->post('txtKuitansi')),
		'uraian'        =>$uraian_kas,
		'my_kode_trans' =>200,
		'saldo_trans'   =>$total_trans,
		'tob'           =>trim($this->input->post('txtJenisTransKre')),
		'tob_RAK'       =>'',
		'modul_trans_id'=>$kretrans_id_max,
		'userid'        =>$this->session->userdata('user_id'),
		'VALIDATED'     =>0,
		'POSTED'        =>0,
		'GL_TRANS'      =>trim($this->input->post('txtGlKre')),
		'USERAPP'       =>$this->session->userdata('user_id'),
		'CAB'           =>''

	 );
		
		
		$this->kasmodel->insert_teller($data_kas);
		$this->kreditmodel->add_counter($data_counter);	
		
		//UNTUK TABUNGAN WAJIB
		if((trim($this->input->post('txtRekTab'))<>'') && ($jml_tab_wajib>0)){
			$data_tabtrans = array(
			'TABTRANS_ID'      	=>0,//trim($this->input->post('txtTransID'))
			'TGL_TRANS'        	=>$tgl_trans,
			'NO_REKENING'     	=>trim($this->input->post('txtRekTab')),
			'KODE_TRANS'   		=>'01',
			'SALDO_TRANS'      	=>$jml_tab_wajib,
			'MY_KODE_TRANS'   	=>188,
			'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
			'NO_TELLER' 		=>0,
			'USERID'   			=>$this->session->userdata('user_id'),
			'TOB'           	=>'O',
			'tob_RAK'       	=>'',
			'POSTED'			=>1,
			'VALIDATED'        	=>1,
			'keterangan'     	=>'',
			'NO_REK_OB'   		=>'',
			'SALDO_AWAL_HARI'   =>0,
			'FLAG_CETAK'        =>'',
			'TGL_INPUT'			=>$tgl_trans,
			'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>'',
			'KODE_PERK_GL'		=>'',
			'CAB'				=>'',
			'LINK_MODUL'		=>'KRE',
			'LINK_ID'			=>$kretrans_id_max,
			'LINK_REKENING'		=>trim($this->input->post('txtRekTab')),
			'CAB_ONLINE'		=>'',
			'BONUS_TRANS'		=>0.00,
			'GL_DEBET'			=>'',
			'GL_PENDAPATAN'		=>'',
			'GL_BIAYA'			=>'',
			'BIAYA_TRANS'		=>0.00,
			'PENDAPATAN_TRANS'	=>0.00,
			'TGL_AUTODEBET_KREDIT'=>NULL,
			'TGL_AUTODEBET_TABUNGAN'=>NULL,
			'TGL_AUTOKREDIT_TABUNGAN'=>NULL,
			'P_FEE'				=>0,
			'JML_ANGSURAN'		=>0.00,
			'USERAPP'			=>$this->session->userdata('user_id')
			);
			$query_tabtrans=$this->tellertabmodel->insert_tabtrans($data_tabtrans);
			$this->tellertabmodel->update_setor_tabung($jml_tab_wajib,trim($this->input->post('txtRekTab')));
			
			
			$uraian_kas_tab_wajib="OB/PB Tabungan Wajib: ".trim($this->input->post('txtRekTab'))."-".trim($this->input->post('txtNamaTab'));
			$data_kas_tabwajib = array(
			  'trans_id'      =>0,
			  'modul'         =>'KRE',
			  'tgl_trans'     =>$tgl_trans,
			  'kode_jurnal'   =>'',
			  'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			  'uraian'        =>$uraian_kas_tab_wajib,
			  'my_kode_trans' =>200,
			  'saldo_trans'   =>$jml_tab_wajib,
			  'tob'           =>'T',
			  'tob_RAK'       =>'',
			  'modul_trans_id'=>$kretrans_id_max,
			  'userid'        =>$this->session->userdata('user_id'),
			  'VALIDATED'     =>0,
			  'POSTED'        =>0,
			  'GL_TRANS'      =>'',
			  'USERAPP'       =>$this->session->userdata('user_id'),
			  'CAB'           =>''

		   );
		   $this->kasmodel->insert_teller($data_kas_tabwajib);
		}// END JIKA ADA TAB WAJIB
		
		//Jika setor OB tabungan insert ke tabtrans dan update tabung
		if ((trim($this->input->post('txtRekTabOb')) <> '') && (trim($this->input->post('txtSaldoTab')) > 0) ){
			$data = array(
		 	'TABTRANS_ID'      	=>0,
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTabOb')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans_tab')),
		 	'SALDO_TRANS'      	=>$total_trans,
		 	'MY_KODE_TRANS'   	=>265,
		 	'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
		 	'NO_TELLER' 		=>0,
		 	'USERID'   			=>$this->session->userdata('user_id'),
		 	'TOB'           	=>$jns_trans_tab,
		 	'tob_RAK'       	=>'',
		 	'POSTED'			=>1,
		 	'VALIDATED'        	=>1,
		 	'keterangan'     	=>trim($this->input->post('txtKet')),
		 	'NO_REK_OB'   		=>'',
		 	'SALDO_AWAL_HARI'   =>0,
		 	'FLAG_CETAK'        =>'',
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>'',
			'KODE_PERK_GL'		=>'',
			'CAB'				=>'',
			'LINK_MODUL'		=>'KRE',
			'LINK_ID'			=>$kretrans_id_max,
			'LINK_REKENING'		=>trim($this->input->post('txtRekKre')),
			'CAB_ONLINE'		=>'',
			'BONUS_TRANS'		=>0.00,
			'GL_DEBET'			=>'',
			'GL_PENDAPATAN'		=>'',
			'GL_BIAYA'			=>'',
			'BIAYA_TRANS'		=>0.00,
			'PENDAPATAN_TRANS'	=>0.00,
			'TGL_AUTODEBET_KREDIT'=>NULL,
			'TGL_AUTODEBET_TABUNGAN'=>NULL,
			'TGL_AUTOKREDIT_TABUNGAN'=>NULL,
			'P_FEE'				=>0,
			'JML_ANGSURAN'		=>0,
			'USERAPP'			=>$this->session->userdata('user_id'),
			'TGL_INPUT'			=>$tgl_trans,
		 );
		 $this->tellertabmodel->insert_tabtrans($data);
		 $this->tellertabmodel->update_tarik_tabung($total_trans,trim($this->input->post('txtRekTabOb')));
		}
								
		  $this->session->set_flashdata('success', 'Setoran pinjaman berhasil');
		  redirect('angsur_kredit/setor_pinjaman');	

	}// end function simpan_setor
		
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */