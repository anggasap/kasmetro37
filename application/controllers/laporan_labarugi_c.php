<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_labarugi_c extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('homemodel');
		$this->load->model('laplabarugimodel');
        $this->load->model('lapneracamodel');
		session_start ();
	}

	public function index(){
		if($this->auth->is_logged_in () == false){
			$this->login();
		}
		else{
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
		}
	}

	public function tampil_lap_labarugi(){
		$tgl = trim($this->input->post('txtTGlTrans'));
	 	$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$data['judul']='Laporan Laba Rugi';	
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		/*============= DEBET + ====================*/
		/*
        $temp_perkiraan = $this->laplabarugimodel->insert_temp_perkiraan( $tgl_trans,$this->session->userdata('user_id'));
		$saldo_aktiva = $this->laplabarugimodel->get_saldo_aktiva( $tgl_trans,$this->session->userdata('user_id'));
		foreach($saldo_aktiva->result() as $row){
			$this->laplabarugimodel->update_saldo_temp_perkiraan($row->kode_perk,$row->jumlah_ak,$this->session->userdata('user_id'));
		}
		$saldo_pasiva = $this->laplabarugimodel->get_saldo_pasiva( $tgl_trans,$this->session->userdata('user_id'));
		foreach($saldo_pasiva->result() as $row){
			$this->laplabarugimodel->update_saldo_temp_perkiraan($row->kode_perk,$row->jumlah_psv,$this->session->userdata('user_id'));
		}
		$get_kode_induk = $this->laplabarugimodel->get_kode_induk( $tgl_trans,$this->session->userdata('user_id'));
		foreach($get_kode_induk->result() as $row1){
			$jsu = 0;
			$get_saldo_induk = $this->laplabarugimodel->get_saldo_induk($row1->kode_perk,$this->session->userdata('user_id'));
			foreach($get_saldo_induk->result() as $row2){
				$jsu=$jsu + $row2->saldo_akhir;
				$this->laplabarugimodel->update_saldo_induk($row1->kode_perk,$jsu,$this->session->userdata('user_id'));
			}
		}
		*/
        $temp_perkiraan = $this->lapneracamodel->insert_temp_perkiraan( $tgl_trans,$this->session->userdata('user_id'));
        $saldo_aktiva = $this->lapneracamodel->get_saldo_aktiva( $tgl_trans,$this->session->userdata('user_id'));
        foreach($saldo_aktiva->result() as $row){
            $this->lapneracamodel->update_saldo_temp_perkiraan($row->kode_perk,$row->jumlah_ak,$this->session->userdata('user_id'));
        }
        $saldo_pasiva = $this->lapneracamodel->get_saldo_pasiva( $tgl_trans,$this->session->userdata('user_id'));
        foreach($saldo_pasiva->result() as $row){
            $this->lapneracamodel->update_saldo_temp_perkiraan($row->kode_perk,$row->jumlah_psv,$this->session->userdata('user_id'));
        }
        $get_kode_induk = $this->lapneracamodel->get_kode_induk( $tgl_trans,$this->session->userdata('user_id'));
        foreach($get_kode_induk->result() as $row1){
            $jsu = 0;
            $get_saldo_induk = $this->lapneracamodel->get_saldo_induk($row1->kode_perk,$this->session->userdata('user_id'));
            foreach($get_saldo_induk->result() as $row2){
                $jsu=$jsu + $row2->saldo_akhir;
                $this->lapneracamodel->update_saldo_induk($row1->kode_perk,$jsu,$this->session->userdata('user_id'));
            }
        }
		/*============= END DEBET + ====================*/
		$data ['total_aktiva'] = $this->laplabarugimodel->get_total_aktiva($tgl_trans);
		$data ['total_pasiva'] = $this->laplabarugimodel->get_total_pasiva($tgl_trans);
		$data ['pajak'] = $this->laplabarugimodel->get_pajak($tgl_trans);
		$data ['laba_rugi_berjalan'] = $this->laplabarugimodel->get_labarugi_berjalan();
		$data ['multilevel_labarugi_aktiva'] = $this->laplabarugimodel->get_data_labarugi_aktiva(0);
		$data ['multilevel_labarugi_pasiva'] = $this->laplabarugimodel->get_data_labarugi_pasiva(0);
		$this->template->set ( 'title', 'Laporan labarugi' );
		$this->template->load ( 'tempDataTable', 'admin/tampil_lap_labarugiv', $data );

	}


	 function tampil(){

		$this->auth->restrict ();
		$this->auth->cek_menu ( 38 );

		if(isset($_POST["btnLihat"])){
			$this->tampil_lap_labarugi();
		}else{
			$timestamp = strtotime($this->session->userdata('tglD'));
			$tgl_trans = date('Y-m-d', $timestamp);
			
			$data['judul']='Laporan Laba Rugi';
			
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			//$data ['data_kas'] = $this->lapkasmodel->get_data_kas_user_grid ($tgl_trans,$this->session->userdata('user_id'));
			$this->template->set ( 'title', 'Laporan Laba Rugi' );
			$this->template->load ( 'tempDataTable', 'admin/lap_labarugiv', $data );
		}
	}

}

 

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
