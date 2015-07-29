<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_tab_c extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();

		session_start ();
		//$this->load->model('homemodel');
		$this->load->model('print_tabmodel');
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
			$this->template->load ( 'masterpage', 'admin/index',$data );
   		}
	}
	
	
	public function cetak_tab(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 33 );
		
		if(isset($_POST["btnCetak"])) {
    		$this->simpan_nasabah();
  		}
		else{
		$data['judul']='Cetak Buku Tabungan';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		//$data ['jenis_gelar']=$this->master_nasabahmodel->get_gelar();
		
		$this->template->set ( 'title', 'Cetak Buku Tabungan' );
		$this->template->load ( 'masterpage', 'admin/print_tab_view', $data );
		}
	}
	public function tampil_trans_tab($norek,$tgl_start,$tgl_end,$baris){
		$timestamp = strtotime($tgl_start);
		$tgl_mulai = date('Y-m-d', $timestamp);
		
		$timestamp = strtotime($tgl_end);
		$tgl_akhir = date('Y-m-d', $timestamp);
		
		$data['rekening']=$this->print_tabmodel->get_tab_trans($norek,$tgl_mulai,$tgl_akhir);
		$saldo=$this->print_tabmodel->get_saldo_sebelum($norek,$tgl_mulai);
		$data['baris']=$baris;
		if($saldo){
			foreach ($saldo->result() as $row){
				if($row->saldo_sebelum>0){
			   		$data['saldo_sblm']= $row->saldo_sebelum;
				}else{
					$data['saldo_sblm']= 0;
				}
			}
		}
//		$this->template->set ( 'title', 'Cetak Buku Tabungan' );
		$this->load->view ('admin/print_tab_ready_view', $data );
	}
	
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */