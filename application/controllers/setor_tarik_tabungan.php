<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setor_tarik_tabungan extends CI_Controller {

    function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tellertabmodel');
		$this->load->model('homemodel');
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
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	
	public function setor() {
		//ini_set('memory_limit', '-1');
		$this->auth->restrict ();
		$this->auth->cek_menu ( 7 );
		
		if(isset($_POST["btnSimpan"])) {
    			$this->setor_tabungan();
  			}
		else{
		$data['judul']='Setoran Tabungan';
		$data['counter']=$this->tellertabmodel->get_counter();
		//$data['transid']=$this->tellertabmodel->get_transid();
		$data ['pasif'] = $this->tellertabmodel->seting_nasabah_tampil();
		$data ['norek'] = $this->tellertabmodel->seting_norek_kredit();
		$data ['bln'] = $this->tellertabmodel->get_seting_tab_pasif();
		$data ['setoran'] = $this->tellertabmodel->get_kode_setor();
		//$data ['tarikan'] = $this->tellertabmodel->get_kode_tarik();
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['kodetrans_setor'] = $this->tellertabmodel->get_all_kodetrans_setor ();
		
		//$data ['rekening'] = $this->tellertabmodel->get_rekening ();
		
		$this->template->set ( 'title', 'Setor Tabungan' );
		$this->template->load ( 'tempDataTable', 'admin/setor_tabunganv', $data );
		}	
	}
	
	public function tarik() {
		ini_set('memory_limit', '-1');
		$this->auth->restrict ();
		$this->auth->cek_menu ( 10 );
		
		if(isset($_POST["btnSimpan"])) {
    			$this->tarik_tabungan();
  			}
		else{
		$data['judul']='Penarikan Tabungan';
		$data['counter']=$this->tellertabmodel->get_counter();
		//$data['transid']=$this->tellertabmodel->get_transid();
		$data ['pasif'] = $this->tellertabmodel->seting_nasabah_tampil();
		$data ['norek'] = $this->tellertabmodel->seting_norek_kredit();
		$data ['bln'] = $this->tellertabmodel->get_seting_tab_pasif();
		//$data ['setoran'] = $this->tellertabmodel->get_kode_setor();
		$data ['tarikan'] = $this->tellertabmodel->get_kode_tarik();
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['kodetrans_tarik'] = $this->tellertabmodel->get_all_kodetrans_tarik ();
		//$data ['rekening'] = $this->tellertabmodel->get_rekening ();
		
		$this->template->set ( 'title', 'Penarikan Tabungan' );
		$this->template->load ( 'tempDataTable', 'admin/setor_tabunganv', $data );
		}	
	}
	
	function deskripsi_trans() {
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kodetrans', TRUE );
		$rows = $this->tellertabmodel->get_deskripsi_trans ( $kode );
		foreach ( $rows as $row )
			$array = array (
				'deskripsitrans' => $row->deskripsi_trans,
				'typetrans' => $row->type_trans,
				'gl_trans' => $row->gl_trans,
				'tob' => $row->tob
			);
		
		$this->output->set_output(json_encode($array));
	}
	
	function deskripsi_norek(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->tellertabmodel->get_deskripsi_rek ( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'NAMA_NASABAH' => $row->NAMA_NASABAH,
				'NASABAH_ID' => $row->nasabah_id,
				'SALDO_AKHIR' => $row->SALDO_AKHIR,
				'ALAMAT' => $row->ALAMAT,
				'SALDO_SETORAN' => $row->SALDO_SETORAN,
				'SALDO_PENARIKAN' => $row->SALDO_PENARIKAN,
				'SALDO_BLOKIR' => $row->SALDO_BLOKIR,
				'SETORAN_MINIMUM' => $row->SETORAN_MINIMUM,
				'MINIMUM_DEFAULT' => $row->MINIMUM_DEFAULT,
				'TGL_TRANS_TERAKHIR' => $row->TGL_TRANS_TERAKHIR,
				'DESKRIPSI_JENIS_TABUNGAN' => $row->DESKRIPSI_JENIS_TABUNGAN,
				'ADM_BLN_INI' => $row->ADM_BLN_INI
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
	
	function process(){
		$this->CI =& get_instance();
		$nas_id = $this->input->post('item',TRUE);
		$rows = $this->tellertabmodel->get_kredit_aktif ($nas_id);
		$data['norek'] = array();
		foreach ( $rows as $row ){
			$data['norek'][] = array (
				'NO_REKENING' => $row->NO_REKENING,
				'DESKRIPSI_JENIS_KREDIT' => $row->DESKRIPSI_JENIS_KREDIT,
				'SALDO_AKHIR' => $row->JML_PINJAMAN
			);
		}
			 
		
		$this->output->set_output(json_encode($data));
	}
	
	function setor_tabungan(){  
	 	$tgl = trim($this->input->post('txtTGlTrans'));
	 	$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$jml_koma = trim($this->input->post('txtJml'));
	 	$jml_trans = str_replace(',', '', $jml_koma); // jumlah transaksi
		$s_min = trim($this->input->post('txtSaldoATrans'));
		$setor_min = str_replace(',', '', $s_min); 
		
		$jns_trans=trim($this->input->post('txtJenisTrans'));
		
		$text_setor = trim($this->input->post('txtsaldosetor'));
		$text_tarik = trim($this->input->post('txtsaldotarik'));
		
		$setor = $text_setor+$jml_trans;
		$saldo_final = $setor-$text_tarik;
		 $data = array(
		 	'TABTRANS_ID'      	=>0,//trim($this->input->post('txtTransID'))
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTab')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans')),
		 	'SALDO_TRANS'      	=>$jml_trans,
		 	'MY_KODE_TRANS'   	=>100,
		 	'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
		 	'NO_TELLER' 		=>0,
		 	'USERID'   			=>$this->session->userdata('user_id'),
		 	'TOB'           	=>$jns_trans,
		 	'tob_RAK'       	=>'T',
		 	'POSTED'			=>0,
		 	'VALIDATED'        	=>1,
		 	'keterangan'     	=>trim($this->input->post('txtKet')),
		 	'NO_REK_OB'   		=>'',
		 	'SALDO_AWAL_HARI'   =>0,
		 	'FLAG_CETAK'        =>'N',
			'TGL_INPUT'			=>$tgl_trans,
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>'',
			'KODE_PERK_GL'		=>trim($this->input->post('txtKdPerk')),
			'CAB'				=>'',
			'LINK_MODUL'		=>'',
			'LINK_ID'			=>0,
			'LINK_REKENING'		=>'',
			'CAB_ONLINE'		=>'',
			'BONUS_TRANS'		=>0,
			'GL_DEBET'			=>'',
			'GL_PENDAPATAN'		=>'',
			'GL_BIAYA'			=>'',
			'BIAYA_TRANS'		=>0,
			'PENDAPATAN_TRANS'	=>0,
			'TGL_AUTODEBET_KREDIT'=>NULL,
			'TGL_AUTODEBET_TABUNGAN'=>NULL,
			'TGL_AUTOKREDIT_TABUNGAN'=>NULL,
			'P_FEE'				=>0,
			'JML_ANGSURAN'		=>0,
			'USERAPP'			=>$this->session->userdata('user_id')
		 );
		$data1=array(
			'SALDO_SETORAN' 	=> $setor,
			'SALDO_AKHIR'		=> $saldo_final
		);
		$data_counter=array(
				'CounterNo' =>trim($this->input->post('txtcounter'))
		);	
		$uraian="Setoran tabungan : ".trim($this->input->post('txtRekTab'))."-".trim($this->input->post('txtNama'));
		
	/*	
		if($jml_trans < $setor_min){
			$this->session->set_flashdata('error','Setoran kurang dari setoran minimal yaitu Rp'.$s_min);
			redirect('setor_tarik_tabungan/setor');
		}
		elseif($jml_trans<=0){
			$this->session->set_flashdata('error','Setoran tidak boleh kurang dari Rp 0');
			redirect('setor_tarik_tabungan/setor');
		}
		else{
			*/
			$query_tabtrans=$this->tellertabmodel->insert_tabtrans($data);
			
			//$this->tellertabmodel->update_tabung($data1,trim($this->input->post('txtRekTab')));
			$this->tellertabmodel->update_setor_tabung($jml_trans,trim($this->input->post('txtRekTab')));
			
			$no_rek=trim($this->input->post('txtRekTab'));
			$kuitansi=trim($this->input->post('txtKuitansi'));
		
			$row_get_tabtrans_id=$this->tellertabmodel->get_tabtrans_id($tgl_trans,$no_rek,$jml_trans,$kuitansi);
			foreach ( $row_get_tabtrans_id as $row ){
				$array = array (
					'TABTRANS_ID' => $row->TABTRANS_ID,
				);
			}
			$tabtrans_id_max=$array['TABTRANS_ID'];
			
			$data_kas = array(
			 	'trans_id'      =>0,
			 	'modul'         =>'TAB',
			 	'tgl_trans'     =>$tgl_trans,
			 	'kode_jurnal'   =>'',
			 	'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			 	'uraian'        =>$uraian,
			 	'my_kode_trans' =>200,
			 	'saldo_trans'   =>$jml_trans,
			 	'tob'           =>$jns_trans,
			 	'tob_RAK'       =>'T',
			 	'modul_trans_id'=>$tabtrans_id_max,
			 	'userid'        =>$this->session->userdata('user_id'),
			 	'VALIDATED'     =>0,
			 	'POSTED'        =>0,
			 	'GL_TRANS'      =>trim($this->input->post('txtKdPerk')),
			 	'USERAPP'       =>$this->session->userdata('user_id'),
			 	'CAB'           =>''

			 );
			 
			$this->kasmodel->insert_teller($data_kas);
			$this->tellertabmodel->add_counter($data_counter);	
			//$this->session->set_flashdata('success', 'Setoran tabungan berhasil');
			//redirect('setor_tarik_tabungan/setor');	
		//}
	}
	
	function tarik_tabungan(){  
	 	$tgl = trim($this->input->post('txtTGlTrans'));
	 	$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$jml_koma = trim($this->input->post('txtJml'));
	 	$jml_trans = str_replace(',', '', $jml_koma); 
		
		$jns_trans=trim($this->input->post('txtJenisTrans'));
		
		$text_setor=trim($this->input->post('txtsaldosetor'));
		$text_tarik=trim($this->input->post('txtsaldotarik'));
		$tarik=$text_tarik+$jml_trans;
		$saldo_final=$text_setor-$tarik;
		
		$s=trim($this->input->post('txtSaldoBTrans'));
		$saldo_tab=str_replace(',', '', $s); 
		$s_min=trim($this->input->post('txtSaldoMin'));
		$saldo_min=str_replace(',', '', $s_min); 
		$saldo_max_diambil=$saldo_tab-$saldo_min;
		 $data = array(
		 	'TABTRANS_ID'      	=>0,
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTab')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans')),
		 	'SALDO_TRANS'      	=>$jml_trans,
		 	'MY_KODE_TRANS'   	=>200,
		 	'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
		 	'NO_TELLER' 		=>0,
		 	'USERID'   			=>$this->session->userdata('user_id'),
		 	'TOB'           	=>$jns_trans,
		 	'tob_RAK'       	=>'T',
		 	'POSTED'			=>0,
		 	'VALIDATED'        	=>1,
		 	'keterangan'     	=>trim($this->input->post('txtKet')),
		 	'NO_REK_OB'   		=>'',
		 	'SALDO_AWAL_HARI'   =>0,
		 	'FLAG_CETAK'        =>'N',
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>'',
			'KODE_PERK_GL'		=>trim($this->input->post('txtKdPerk')),
			'CAB'				=>'',
			'LINK_MODUL'		=>'',
			'LINK_ID'			=>0,
			'LINK_REKENING'		=>'',
			'CAB_ONLINE'		=>'',
			'BONUS_TRANS'		=>0,
			'GL_DEBET'			=>'',
			'GL_PENDAPATAN'		=>'',
			'GL_BIAYA'			=>'',
			'BIAYA_TRANS'		=>0,
			'PENDAPATAN_TRANS'	=>0,
			'TGL_AUTODEBET_KREDIT'=>NULL,
			'TGL_AUTODEBET_TABUNGAN'=>NULL,
			'TGL_AUTOKREDIT_TABUNGAN'=>NULL,
			'P_FEE'				=>0,
			'JML_ANGSURAN'		=>0,
			'USERAPP'			=>$this->session->userdata('user_id'),
			'TGL_INPUT'			=>$tgl_trans
		 );
/*		
		$data1=array(
			'SALDO_PENARIKAN' 	=> $tarik,
			'SALDO_AKHIR'		=> $saldo_final
		);
*/
		$data_counter=array(
				'CounterNo' =>trim($this->input->post('txtcounter'))
		);
		$uraian="Penarikan tabungan : ".trim($this->input->post('txtRekTab'))."-".trim($this->input->post('txtNama'));
		
	/*		 	
		if($jml_trans>$saldo_max_diambil){
			$this->session->set_flashdata('error', 'Penarikan melebihi saldo tabungan yang bisa diambil yaitu Rp'.number_format($saldo_max_diambil,2));
			redirect('setor_tarik_tabungan/tarik');
		}
		elseif($jml_trans<=0 || $jml_trans=''){
			$this->session->set_flashdata('error','Penarikan tidak boleh kurang dari Rp 0');
			redirect('setor_tarik_tabungan/tarik');
		}
		else{
			*/
			$this->tellertabmodel->insert_tabtrans($data);
			//$this->tellertabmodel->update_tabung($data1,trim($this->input->post('txtRekTab')));
			$this->tellertabmodel->update_tarik_tabung(str_replace(',', '', trim($this->input->post('txtJml'))),trim($this->input->post('txtRekTab')));
			
			$tgl = trim($this->input->post('txtTGlTrans'));
			$timestamp = strtotime($tgl);
			$tgl_trans = date('Y-m-d', $timestamp);
			
			$no_rek=trim($this->input->post('txtRekTab'));
			$kuitansi=trim($this->input->post('txtKuitansi'));
			$jml_koma = trim($this->input->post('txtJml'));
	 		$jml_trans = str_replace(',', '', $jml_koma); 
		
			$row_get_tabtrans_id=$this->tellertabmodel->get_tabtrans_id($tgl_trans,$no_rek,$jml_trans,$kuitansi);
			foreach ( $row_get_tabtrans_id as $row ){
				$array = array (
					'TABTRANS_ID' => $row->TABTRANS_ID,
				);
			}
			$tabtrans_id_max=$array['TABTRANS_ID'];
			$data_kas = array(
			 	'trans_id'      =>0,
			 	'modul'         =>'TAB',
			 	'tgl_trans'     =>$tgl_trans,
			 	'kode_jurnal'   =>'',
			 	'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			 	'uraian'        =>$uraian,
			 	'my_kode_trans' =>300,
			 	'saldo_trans'   =>$jml_trans,
			 	'tob'           =>$jns_trans,
			 	'tob_RAK'       =>'',
			 	'modul_trans_id'=>$tabtrans_id_max,
			 	'userid'        =>$this->session->userdata('user_id'),
			 	'VALIDATED'     =>0,
			 	'POSTED'        =>0,
			 	'GL_TRANS'      =>trim($this->input->post('txtKdPerk')),
			 	'USERAPP'       =>$this->session->userdata('user_id'),
			 	'CAB'           =>''

			 );
			//$this->tellertabmodel->update_tarik_tabung($jml_trans,trim($this->input->post('txtRekTab')));
			$this->kasmodel->insert_teller($data_kas);
			$this->tellertabmodel->add_counter($data_counter);	
			$this->session->set_flashdata('success', 'Penarikan tabungan berhasil');
			redirect('setor_tarik_tabungan/tarik');	
	//	}
		
	}
	

}

/* End of file Setor_tarik_tabungan.php */
/* Location: ./application/controllers/setor_tarik_tabungan.php */
