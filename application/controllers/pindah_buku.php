<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pindah_buku extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tellertabmodel');
		$this->load->model('homemodel');
		$this->load->model('pindahbukumodel');
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
	
	public function pindah()
	{
		$this->auth->restrict ();
		$this->auth->cek_menu ( 11 );
		
		if(isset($_POST["btnSimpan"])) {
    		$this->tarik_tabungan();
			$this->setor_tabungan();
  		}
		else{
		$data ['counter']=$this->tellertabmodel->get_counter();
		$data ['norek'] = $this->tellertabmodel->seting_norek_kredit();
		$data ['judul']="Transaksi Pemindahan Buku";
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		//$data ['kodetrans'] = $this->tellertabmodel->get_kodetrans ();
		//$data ['rekening'] = $this->tellertabmodel->get_rekening ();
		$data ['kode_debet']=$this->pindahbukumodel-> get_kode_debet_source();
		$data ['kode_kredit']=$this->pindahbukumodel-> get_kode_kredit_tujuan();
		$data ['kode_debet_def']=$this->pindahbukumodel-> get_kode_debet_source_def();
		$data ['kode_kredit_def']=$this->pindahbukumodel->get_kode_kre_tujuan_def();
		
		$this->template->set ( 'title', 'Pindah Buku' );
		$this->template->load ( 'tempDataTable', 'admin/pindah_bukuv', $data );
		}
	}
	function simpan_pindah_buku(){
		$this->tarik_tabungan();
		$this->setor_tabungan();
	}
	function approvalLimit(){
		$approvalUserName = $this->input->post('approvalUserName');
		$approvalPassword = $this->input->post('approvalPassword');
		$approvalLimit = $this->auth->approvalLimit ( $approvalUserName,$approvalPassword );
		if($approvalLimit['bool']==true){
			$dataReturn=array(
					'bool'	=>true,
					'limitTarik' =>$approvalLimit['limitTarik']
			);
			$this->output->set_output(json_encode($dataReturn));
		}else{
			$dataReturn=array(
					'bool' =>false
			);
			$this->output->set_output(json_encode($dataReturn));
		}
	}
	function setor_tabungan(){  
	 	$tgl = trim($this->input->post('txtTGlTrans'));
	 	$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$jml_koma = trim($this->input->post('txtJml'));
	 	$jml_trans = str_replace(',', '', $jml_koma); 
		
		$tob=trim($this->input->post('txtJenisTrans2'));
		
		$text_setor = trim($this->input->post('txtsaldosetor2'));
		$text_tarik = trim($this->input->post('txtsaldotarik2'));
		
		$setor = $text_setor+$jml_trans;
		$saldo_final = $setor-$text_tarik;
		$t=trim($this->input->post('txtTransID'));
		$tabtrans=$t+1;
		$no_rek=trim($this->input->post('txtRekTujuan'));
		$kuitansi=trim($this->input->post('txtKuitansi'));
		 $data = array(
		 	'TABTRANS_ID'      	=>0,
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTujuan')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans2')),
		 	'SALDO_TRANS'      	=>$jml_trans,
		 	'MY_KODE_TRANS'   	=>103,
		 	'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
		 	'NO_TELLER' 		=>0,
		 	'USERID'   			=>$this->session->userdata('user_id'),
		 	'TOB'           	=>$tob,
		 	'tob_RAK'       	=>'T',
		 	'POSTED'			=>1,
		 	'VALIDATED'        	=>1,
		 	'keterangan'     	=>trim($this->input->post('txtKet')),
		 	'NO_REK_OB'   		=>'',
		 	'SALDO_AWAL_HARI'   =>0,
		 	'FLAG_CETAK'        =>'',
			'TGL_INPUT'			=>$tgl_trans,
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>trim($this->input->post('txtRekTab')),
			'KODE_PERK_GL'		=>trim($this->input->post('txtKdPerk2')),
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
		$uraian="Setoran tabungan : ".trim($this->input->post('txtRekTujuan'))."-".trim($this->input->post('txtNama'));

/*		
		if($jml_trans<=0){
			$this->session->set_flashdata('error','Setoran tidak boleh kurang dari Rp 0');
			redirect('pindah_buku/pindah');
		}
		else{
*/			
			$this->tellertabmodel->insert_tabtrans($data);
			$this->tellertabmodel->update_setor_tabung($jml_trans,trim($this->input->post('txtRekTujuan')));
/*tabtrans id*/			
			$row_get_tabtrans_id=$this->tellertabmodel->get_tabtrans_id($tgl_trans,$no_rek,$jml_trans,$kuitansi);
			foreach ( $row_get_tabtrans_id as $row ){
				$array = array (
					'TABTRANS_ID' => $row->TABTRANS_ID,
				);
			}
			$tabtrans_id_max=$array['TABTRANS_ID'];
/*end tabtrans id*/
			$data_kas = array(
			 	'trans_id'      =>0,
			 	'modul'         =>'TAB',
			 	'tgl_trans'     =>$tgl_trans,
			 	'kode_jurnal'   =>'',
			 	'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			 	'uraian'        =>$uraian,
			 	'my_kode_trans' =>200,
			 	'saldo_trans'   =>$jml_trans,
			 	'tob'           =>'O',
			 	'tob_RAK'       =>'T',
			 	'modul_trans_id'=>$tabtrans_id_max,
			 	'userid'        =>$this->session->userdata('user_id'),
			 	'VALIDATED'     =>0,
			 	'POSTED'        =>0,
			 	'GL_TRANS'      =>trim($this->input->post('txtKdPerk2')),
			 	'USERAPP'       =>$this->session->userdata('user_id'),
			 	'CAB'           =>''

			 );			
		//	$this->tellertabmodel->update_tabung($data1,trim($this->input->post('txtRekTujuan')));
			$this->kasmodel->insert_teller($data_kas);
			$this->tellertabmodel->add_counter($data_counter);	
			$this->session->set_flashdata('success', 'Setoran tabungan berhasil');
			redirect('pindah_buku/pindah');	
	//	}
		
	}
	
	function tarik_tabungan()
	{  
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
		
		$s=trim($this->input->post('txtSaldoSaatIni'));
		$saldo_tab=str_replace(',', '', $s); 
		$s_min=trim($this->input->post('txtSaldoMin'));
		$saldo_min=str_replace(',', '', $s_min); 
		$saldo_max_diambil=$saldo_tab-$saldo_min;
		
		 $data = array(
		 	'TABTRANS_ID'      	=>0,
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTab')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans1')),
		 	'SALDO_TRANS'      	=>$jml_trans,
		 	'MY_KODE_TRANS'   	=>203,
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
		 	'FLAG_CETAK'        =>'',
			'TGL_INPUT'			=>$tgl_trans,
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>trim($this->input->post('txtRekTujuan')),
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
			'SALDO_PENARIKAN' 	=> $tarik,
			'SALDO_AKHIR'		=> $saldo_final
		);
		
		$uraian="Penarikan tabungan : ".trim($this->input->post('txtRekTab'))."-".trim($this->input->post('txtNama'));
			 	
		if($jml_trans>$saldo_max_diambil){
			$this->session->set_flashdata('error', 'Penarikan melebihi saldo tabungan yang bisa diambil yaitu Rp'.number_format($saldo_max_diambil,2));
			redirect('pindah_buku/pindah');
		}
		elseif($jml_trans<=0){
			$this->session->set_flashdata('error','Penarikan tidak boleh kurang dari Rp 0');
			redirect('pindah_buku/pindah');
		}
		else{
			$this->tellertabmodel->insert_tabtrans($data);
			$this->tellertabmodel->update_tarik_tabung(str_replace(',', '', trim($this->input->post('txtJml'))),trim($this->input->post('txtRekTab')));
			
			$tgl = trim($this->input->post('txtTGlTrans'));
			$timestamp = strtotime($tgl);
			$tgl_trans = date('Y-m-d', $timestamp);
			
			$no_rek=trim($this->input->post('txtRekTab'));
			$kuitansi=trim($this->input->post('txtKuitansi'));
			$jml_koma = trim($this->input->post('txtJml'));
	 		$jml_trans = str_replace(',', '', $jml_koma); 
/*tabtrans id*/			
			$row_get_tabtrans_id=$this->tellertabmodel->get_tabtrans_id($tgl_trans,$no_rek,$jml_trans,$kuitansi);
			foreach ( $row_get_tabtrans_id as $row ){
				$array = array (
					'TABTRANS_ID' => $row->TABTRANS_ID,
				);
			}
			$tabtrans_id_max=$array['TABTRANS_ID'];
/*end tabtrans id*/
			//$this->tellertabmodel->update_tabung($data1,trim($this->input->post('txtRekTab')));
			$data_kas = array(
			 	'trans_id'      =>0,
			 	'modul'         =>'TAB',
			 	'tgl_trans'     =>$tgl_trans,
			 	'kode_jurnal'   =>'',
			 	'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			 	'uraian'        =>$uraian,
			 	'my_kode_trans' =>300,
			 	'saldo_trans'   =>$jml_trans,
			 	'tob'           =>'O',
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
		}
		
	}
	
}