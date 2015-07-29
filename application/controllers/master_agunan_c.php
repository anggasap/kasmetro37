<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_agunan_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('master_tabunganmodel');
		$this->load->model('master_nasabahmodel');
		$this->load->model('master_kreditmodel');
		$this->load->helper('form','url');
		//$this->load->library('memcached_library');
    }
	
	function persen_likuidasi(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kd_ikhukum', TRUE );
		$rows = $this->master_kreditmodel->get_persenlikuidasi_kre( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'BOBOT_IKATAN_HUKUM' => $row->BOBOT_IKATAN_HUKUM
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
	function deskripsi_kre(){
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'norek', TRUE );
		$rows = $this->master_kreditmodel->get_deskripsi_kre( $kode );
		if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris'=>1,
				'NAMA_NASABAH' => $row->NAMA_NASABAH
			);
		}else{
			$array=array('baris'=>0);
		}
		
		$this->output->set_output(json_encode($array));
	}
    public function index(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'Agunan Kredit' );
			$this->template->load ( 'masterpage', 'admin/index',$data );
   		}
	}
	public function buat_baru(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 27 );
		
		$data ['kode_agunan_jenis']=$this->master_kreditmodel->get_kode_agunan_jenis();
		$data ['kode_agunan_ikhukum']=$this->master_kreditmodel->get_kode_agunan_ikhukum();
		$data ['kode_sid_agunan_jenis']=$this->master_kreditmodel->get_kode_sid_agunan_jenis();
		$data ['kode_sid_jenikat']=$this->master_kreditmodel->get_kode_sid_jenikat();
		$data ['kode_agunan_intern']=$this->master_kreditmodel->get_kode_agunan_jenis();
		
		
		
		if(isset($_POST["btnSimpan"])) {
    		$this->simpan_agunan();
			/*$this->setor_tabungan();*/
  		}
		else{
		$data['judul']='Agunan Kredit';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		
		$this->template->set ( 'title', 'Agunan Kredit' );
		$this->template->load ( 'masterpage', 'admin/master_agunan_view', $data );
		}
	}
	public function simpan_agunan(){
		//trim($this->input->post(''))
		//str_replace(',', '', trim($this->input->post('')))
		$tgl_JT = trim($this->input->post('txtJTAgunan'));
	 	$timestamp = strtotime($tgl_JT);
		$tgl_JT = date('Y-m-d', $timestamp);
		$data=array(
		 
		 'NO_REKENING' => trim($this->input->post('txtNoRekKre')),
		  'KODE_AGUNAN' => trim($this->input->post('txtNoRekKre')),
		  'AGUNAN_JENIS' => trim($this->input->post('DL_agunan_jenis')),
		  'AGUNAN_IKATAN_HUKUM' => trim($this->input->post('DL_agunan_ikhukum')),
		  'KODE_AGUNAN_INTERN' => trim($this->input->post('DL_agunan_intern')),
		  'AGUNAN' => trim($this->input->post('txtNamaAgunan')),
		  'AGUNAN_RINCIAN' => trim($this->input->post('txtRincianAgunan')),
		  'PEMILIK_AGUNAN' => trim($this->input->post('txtPemilikAgunan')),
		  'alamat_agunan' => trim($this->input->post('txtAlamatAgunan')),
		  'CAB' => '',
		  'BUKTI_AGUNAN' => trim($this->input->post('txtBuktiAgunan')),
		  'NO_AGUNAN' => trim($this->input->post('txtNoAgunan')),
		  'ID_PENJAMIN' => '',
		  'AGUNAN_NILAI' => str_replace(',', '', trim($this->input->post('txtNilaiAgunan'))),
		  'BI_AGUNAN_NILAI' => str_replace(',', '', trim($this->input->post('txtNilaiAgunanBI'))),
		  'PERSEN_LIKUIDASI' => str_replace(',', '', trim($this->input->post('txtLikuidasiPersen'))),
		  'nilai_likuidasi' => str_replace(',', '', trim($this->input->post('txtLikuidasi'))),
		  'SID_AGUNAN_IKATAN_HUKUM' => trim($this->input->post('DL_sid_jenikat')),
		  'SID_KODE_AGUNAN' => trim($this->input->post('DL_sid_agunan_jenis')),
		  'tgl_jt_agunan' => $tgl_JT,
		  'PATH_AGUNAN' => '',
		  'photo_agunan' =>NULL
		 );
		$query_agunan=$this->master_kreditmodel->insert_agunan($data);
		$query_update_agunan=$this->master_kreditmodel->update_agunan(str_replace(',', '', trim($this->input->post('txtLikuidasi'))),str_replace(',', '', trim($this->input->post('txtNilaiAgunanBI'))),trim($this->input->post('txtNoRekKre')));
		
		$this->session->set_flashdata('success', 'Data agunan berhasil masuk');
		redirect('master_agunan_c/buat_baru');
	}
	
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */