<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutup_tabungan_c extends CI_Controller {

    function __construct()
    {
        parent::__construct();

		session_start ();
		$this->load->model('tellertabmodel');
		$this->load->model('homemodel');
		$this->load->model('kasmodel');
		$this->load->model('tutup_tabmodel');
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
	
	public function tutup() {
		//ini_set('memory_limit', '-1');
		$this->auth->restrict ();
		$this->auth->cek_menu ( 25 );
		
		if(isset($_POST["btnSimpan"])) {
    			$this->simpan_tutup_adm_tabungan();
  			}
		else{
		$data['judul']='Penutupan Tabungan';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data['counter']=$this->tellertabmodel->get_counter();
		$data['kodetrans_adm_tab_def']=$this->tutup_tabmodel->get_kode_adm_tab_def();
		$data['kodetrans_tutup_tab_def']=$this->tutup_tabmodel->get_kode_tutup_tab_def();

		$this->template->set ( 'title', 'Penutupan Tabungan' );
		$this->template->load ( 'tempDataTable', 'admin/tutup_tabunganv', $data );
		}	
	}
	
	
	function simpan_tutup_adm_tabungan(){  // transaksi tutup dan adm
		$this->simpan_tutup_tabungan();
		
		$jml_ambil_koma = trim($this->input->post('txtJmlAmbil'));
	 	$jml_ambil = str_replace(',', '', $jml_ambil_koma); 
		
		$jml_adm_koma = trim($this->input->post('txtJmlAdm'));
	 	$jml_adm = str_replace(',', '', $jml_adm_koma);
		
		$jml_trans=$jml_ambil+$jml_adm;
		
		$this->tutup_tabmodel->update_tutup_tabung($jml_trans,trim($this->input->post('txtRekTab')));
		
		$this->simpan_adm_tabungan(); 
		 $data_counter=array(
				'CounterNo' =>trim($this->input->post('txtcounter'))
		 );
			
			$this->tellertabmodel->add_counter($data_counter);	
			$this->session->set_flashdata('success', 'Penutupan tabungan berhasil');
			redirect('tutup_tabungan_c/tutup');	
	}
	
	
	function simpan_tutup_tabungan(){
		$tgl_trans = $this->session->userdata('tglY');
		
		$jml_ambil_koma = trim($this->input->post('txtJmlAmbil'));
	 	$jml_ambil = str_replace(',', '', $jml_ambil_koma); 
		
		$jns_trans_ttp=trim($this->input->post('txtJnsTransTtp'));
		$jns_trans_adm=trim($this->input->post('txtJnsTransAdm'));
		
		$kd_perk_ttp=trim($this->input->post('txtKdPerkTtp'));
		$kd_perk_adm=trim($this->input->post('txtKdPerkAdm'));
		
		 $data = array(
		 	'TABTRANS_ID'      	=>0,
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTab')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans_tab')),
		 	'SALDO_TRANS'      	=>$jml_ambil,
		 	'MY_KODE_TRANS'   	=>200,
		 	'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
		 	'NO_TELLER' 		=>0,
		 	'USERID'   			=>$this->session->userdata('user_id'),
		 	'TOB'           	=>$jns_trans_ttp,
		 	'tob_RAK'       	=>'T',
		 	'POSTED'			=>0,
		 	'VALIDATED'        	=>1,
		 	'keterangan'     	=>trim($this->input->post('txtKet')),
		 	'NO_REK_OB'   		=>'',
		 	'SALDO_AWAL_HARI'   =>0,
		 	'FLAG_CETAK'        =>'',
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>'',
			'KODE_PERK_GL'		=>$kd_perk_ttp,
			'CAB'				=>'',
			'LINK_MODUL'		=>'',
			'LINK_ID'			=>0,
			'LINK_REKENING'		=>'',
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
			'USERAPP'			=>$this->session->userdata('user_id'),
			'TGL_INPUT'			=>$tgl_trans
		 );

		
		$uraian="Penutupan tabungan : ".trim($this->input->post('txtRekTab'))."-".trim($this->input->post('txtNama'));
		$this->tellertabmodel->insert_tabtrans($data);
			
		$no_rek=trim($this->input->post('txtRekTab'));
		$kuitansi=trim($this->input->post('txtKuitansi'));
		$jml_ambil_koma = trim($this->input->post('txtJmlAmbil'));
		$jml_ambil = str_replace(',', '', $jml_ambil_koma);
			 
		$row_get_tabtrans_id=$this->tellertabmodel->get_tabtrans_id($this->session->userdata('tglY'),$no_rek,$jml_ambil,$kuitansi);
		foreach ( $row_get_tabtrans_id as $row ){
			$array = array (
				'TABTRANS_ID' => $row->TABTRANS_ID,
			);
		}
		$tabtrans_id_max=$array['TABTRANS_ID'];
		$data_kas = array(
			'trans_id'      =>0,
			'modul'         =>'TAB',
			'tgl_trans'     =>$this->session->userdata('tglY'),
			'kode_jurnal'   =>'',
			'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			'uraian'        =>$uraian,
			'my_kode_trans' =>300,
			'saldo_trans'   =>$jml_ambil,
			'tob'           =>$jns_trans_ttp,
			'tob_RAK'       =>'T',
			'modul_trans_id'=>$tabtrans_id_max,
			'userid'        =>$this->session->userdata('user_id'),
			'VALIDATED'     =>0,
			'POSTED'        =>0,
			'GL_TRANS'      =>trim($this->input->post('txtKdPerkTtp')),
			'USERAPP'       =>$this->session->userdata('user_id'),
			'CAB'           =>''

		 );
		 $this->kasmodel->insert_teller($data_kas);
	}
	function simpan_adm_tabungan(){  
		$tgl_trans = $this->session->userdata('tglY');
		
		$jml_adm_koma = trim($this->input->post('txtJmlAdm'));
	 	$jml_adm = str_replace(',', '', $jml_adm_koma); 
		
		$jns_trans_ttp=trim($this->input->post('txtJnsTransTtp'));
		$jns_trans_adm=trim($this->input->post('txtJnsTransAdm'));
		
		$kd_perk_ttp=trim($this->input->post('txtKdPerkTtp'));
		$kd_perk_adm=trim($this->input->post('txtKdPerkAdm'));
		
		 $data = array(
		 	'TABTRANS_ID'      	=>0,
		 	'TGL_TRANS'        	=>$tgl_trans,
		 	'NO_REKENING'     	=>trim($this->input->post('txtRekTab')),
		 	'KODE_TRANS'   		=>trim($this->input->post('DL_kodetrans_adm')),
		 	'SALDO_TRANS'      	=>$jml_adm,
		 	'MY_KODE_TRANS'   	=>259,
		 	'kuitansi'        	=>trim($this->input->post('txtKuitansi')),
		 	'NO_TELLER' 		=>0,
		 	'USERID'   			=>$this->session->userdata('user_id'),
		 	'TOB'           	=>$jns_trans_adm,
		 	'tob_RAK'       	=>'T',
		 	'POSTED'			=>0,
		 	'VALIDATED'        	=>1,
		 	'keterangan'     	=>trim($this->input->post('txtKet')),
		 	'NO_REK_OB'   		=>'',
		 	'SALDO_AWAL_HARI'   =>0,
		 	'FLAG_CETAK'        =>'',
		 	'KODE_PERK_TABUNGAN'=>'',
			'NO_REK_TABUNGAN'	=>'',
			'KODE_PERK_GL'		=>$kd_perk_adm,
			'CAB'				=>'',
			'LINK_MODUL'		=>'',
			'LINK_ID'			=>0,
			'LINK_REKENING'		=>'',
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
			'USERAPP'			=>$this->session->userdata('user_id'),
			'TGL_INPUT'			=>$tgl_trans
		 );

		
		$uraian="Penutupan tabungan : ".trim($this->input->post('txtRekTab'))."-".trim($this->input->post('txtNama'));
		$this->tellertabmodel->insert_tabtrans($data);
		//$this->tellertabmodel->update_tarik_tabung(str_replace(',', '', trim($this->input->post('txtJmlAmbil'))),trim($this->input->post('txtRekTab')));
			
		$no_rek=trim($this->input->post('txtRekTab'));
		$kuitansi=trim($this->input->post('txtKuitansi'));
		$jml_adm_koma = trim($this->input->post('txtJmlAdm'));
		$jml_adm = str_replace(',', '', $jml_adm_koma);
			 
		$row_get_tabtrans_id=$this->tellertabmodel->get_tabtrans_id($this->session->userdata('tglY'),$no_rek,$jml_adm,$kuitansi);
		foreach ( $row_get_tabtrans_id as $row ){
			$array = array (
				'TABTRANS_ID' => $row->TABTRANS_ID,
			);
		}
		$tabtrans_id_max=$array['TABTRANS_ID'];
		$data_kas = array(
			'trans_id'      =>0,
			'modul'         =>'TAB',
			'tgl_trans'     =>$this->session->userdata('tglY'),
			'kode_jurnal'   =>'',
			'no_bukti'      =>trim($this->input->post('txtKuitansi')),
			'uraian'        =>$uraian,
			'my_kode_trans' =>300,
			'saldo_trans'   =>$jml_adm,
			'tob'           =>$jns_trans_ttp,
			'tob_RAK'       =>'T',
			'modul_trans_id'=>$tabtrans_id_max,
			'userid'        =>$this->session->userdata('user_id'),
			'VALIDATED'     =>0,
			'POSTED'        =>0,
			'GL_TRANS'      =>trim($this->input->post('txtKdPerkAdm')),
			'USERAPP'       =>$this->session->userdata('user_id'),
			'CAB'           =>''

		 );
		 $this->kasmodel->insert_teller($data_kas);
	}
	

}

/* End of file Setor_tarik_tabungan.php */
/* Location: ./application/controllers/setor_tarik_tabungan.php */
