<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tabel extends CI_Controller {

    function __construct()
    {
        parent::__construct();

		$this->load->model('homemodel');
		$this->load->model('kasmodel');
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
	
    public function perk()
    {
		$this->auth->restrict ();
		$this->auth->cek_menu ( 5 );
		
		$crud = new grocery_CRUD();
		
		// untuk membuat modal popup
		/*$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);*/

		//set tema dan tabel dan kolom yang ditampilkan		
		$crud->set_theme('datatables');
        $crud->set_table('perkiraan');
		$crud->columns('kode_perk','kode_alt','nama_perk','kode_induk');
		//$crud->callback_column('lastName', array($this, '_callback_name'));
        $output = $crud->render();

		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['output'] = $output;
		
		$this->template->set ( 'title', 'Perkiraan' );
		$this->template->load ( 'masterpage', 'admin/tabel_perk', $data );

    }
	
	public function master_user()
	{
		$this->auth->restrict ();
		$this->auth->cek_menu ( 6 );
		
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
        $crud->set_table('passwd');
		$crud->columns('user_nama','user_username','user_password');
		$output = $crud->render();
		
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['output'] = $output;
		
		$this->template->set ( 'title', 'Manajemen User' );
		$this->template->load ( 'masterpage', 'admin/tabel_user', $data );
	}
	

}

/* End of file main.php */
/* Location: ./application/controllers/tabel.php */
