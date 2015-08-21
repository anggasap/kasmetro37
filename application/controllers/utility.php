<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tksBprM');
		$this->load->helper('url');
    }

    public function index(){
		if ($this->auth->is_logged_in () == false) {
			//$this->login();
            redirect('main/login');
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'template', 'admin/index',$data );
   		}
	}

    public function indexBackup(){
        $this->auth->restrict();
        $this->auth->cek_menu ( 45 );

        if(isset($_POST["btnTampil"])) {

            $this->tampil_tks();
        }else{
            $data['judul'] = 'Utilitas Backup';
            $data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));

            $this->template->set ( 'title', 'Utilitas Backup' );
            $this->template->load ( 'tempDataTable', 'admin/utilityBackupV', $data );
        }
    }

    function backup()
    {
        $this->load->helper('download');
        $tanggal = date('Ymd - His');
        $namaFile = $tanggal . '.sql . zip';
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        force_download($namaFile, $backup);
        }

}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */