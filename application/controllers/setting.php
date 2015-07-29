<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct()
    {
        parent::__construct();

		$this->load->model('settingmodel');
		session_start ();
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
	
	public function konfig_teller() {
		$this->auth->restrict ();
		$this->auth->cek_menu ( 9 );
		
		if(isset($_POST["btnSimpan"])) {
    			$this->update_setting1();
  			}
		else{
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['konfig_norek'] = $this->settingmodel->tampil_norek_kredit ();
		$data ['konfig_pasif'] = $this->settingmodel->tampil_nasabah_pasif ();
		$this->template->set ( 'title', 'Konfigurasi Teller' );
		$this->template->load ( 'masterpage', 'admin/konfig_teller', $data );
		}	
	}
	
	function update_setting1()
	{
		$val_norek=$this->input->post('DL_tampil_kredit');
		$val_pasif=$this->input->post('DL_tab_pasif');
		if($val_norek=='0'){
			$val='TIDAK MENAMPILKAN NOREK KREDIT';
		}
		else{
			$val='MENAMPILKAN NOREK KREDIT';
		}
		if($val_pasif=='0'){
			$val2='TIDAK DITAMPILKAN';
		}
		else{
			$val2='DITAMPILKAN';
		}
		
		$data = array('Value' => $val);
		$data2= array('Value' => $val2);	 
		
		$this->settingmodel->update_tampil_norek($data);
		$this->settingmodel->update_tampil_pasif($data2);
		
		$this->session->set_flashdata('success', 'Setting berhasil diisimpan');
		redirect('setting/konfig_teller');
	}


}

/* End of file setting.php */
/* Location: ./application/controllers/setting.php */
