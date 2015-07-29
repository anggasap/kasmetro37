<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akses_user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('homemodel');
		$this->load->model('kasmodel');
		$this->load->model('aksesusermodel');
		$this->load->helper('tree_helper');
		session_start ();
	}

	public function index()
	{
		if($this->auth->is_logged_in () == false)
		{
			$this->login();
		}
		else
		{
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'masterpage', 'admin/index',$data );
		}
		
		if(isset($_GET['grid']))
			echo $this->crud_model->getJson();
		else
      		$this->load->view('admin/crud');
	}
	
	function aksesuser()
	{
		$this->auth->restrict ();
		$this->auth->cek_menu ( 12 );
		
		if(isset($_POST["btnSimpanAkses"])) {
    		$this->setor_tabungan();
  		}
		elseif(isset($_POST["btnSimpanUser"])){
			$this->simpan_user();
		}
		else{
		$data['tree'] = $this->usermodel->get_menu_all();
		$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['groupname'] = $this->aksesusermodel->get_usergroup();
		$data ['passwd'] = $this->aksesusermodel->get_passwd();
		$data ['level'] = $this->aksesusermodel->get_level_user();
		$this->template->set ( 'title', 'home' );
		$this->template->load ( 'masterpage', 'admin/akses_user_view',$data );
		}

	}
	
	function simpan_user()
	{  
	 	
		$ltarik = trim($this->input->post('txtLimitTarik'));
	 	$limit_tarik = str_replace(',', '', $ltarik); 
		
		$lsetor = trim($this->input->post('txtLimitSetor'));
	 	$limit_setor = str_replace(',', '', $lsetor); 
		
		$lkas = trim($this->input->post('txtLimitKas'));
	 	$limit_kas = str_replace(',', '', $lkas); 
		
		 $data = array(
		 	'USERID'      		=>'0',
		 	'USERNAME'        	=>trim($this->input->post('txtUsernameInput')),
		 	'PASSWORD'     		=>md5(trim($this->input->post('txtRePassword'))),
		 	'USERGROUP'   		=>trim($this->input->post('DL_groupname')),
		 	'LIMIT_TARIK'      	=>$limit_tarik,
		 	'LIMIT_KASUMUM'   	=>$limit_kas,
		 	'LIMIT_SETOR'       =>$limit_setor,
		 	'STATUS_USER' 		=>trim($this->input->post('txtLevelId')),
		 	'NAMA_KOMPUTER'   	=>'PC',
		 	'TGL_PASSWORD'      =>'0000-00-00',
		 	'OUTLET'       		=>'001'
		 	
		 );
		
			$this->aksesusermodel->insert_passwd($data);
			
			$this->session->set_flashdata('success', 'Simpan user berhasil');
			redirect('akses_user/aksesuser');	
		
			/*$this->session->set_flashdata('error','User tidak dapat disimpan');
			redirect('akses_user/aksesuser');*/
		
	
	}
	
	function level_id() {
		$this->CI =& get_instance();
		$kode = $this->input->post ( 'kode', TRUE );
		$rows = $this->aksesusermodel->get_level_id ( $kode );
		foreach ( $rows as $row )
			$array = array (
				'level_id' => $row->level_id
			);
		
		$this->output->set_output(json_encode($array));
	}

}

/* End of file akses_user.php */
/* Location: ./application/controllers/akses_user.php */