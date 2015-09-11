<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akuntansi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('homemodel');
		$this->load->model('akuntansiM');
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
			$this->template->set ( 'title', 'Home' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
		}
	}

	public function home()
	{
		$this->auth->restrict ();
		$this->auth->cek_menu ( 47 );
		if(isset($_POST["btnSimpan"])){
			$this->insert_teller();
		}else{
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
            $data['kodeJurnal'] = $this->akuntansiM->getKodeJurnal();
			$this->template->set ( 'title', 'Akuntansi' );
			$this->template->load ( 'tempDataTable', 'admin/akuntansiV', $data );
		}
	}
    public function simpanJurnal(){

        $tglTrans    = trim($this->input->post('txtTGlTrans'));
        $timestamp  = strtotime($tglTrans);
        $tglTrans    = date('Y-m-d', $timestamp);

        $debet      = trim($this->input->post('txtSaldoDebet'));
        $debet      = str_replace(',', '', $debet);
        $kredit     = trim($this->input->post('txtSaldoKredit'));
        $kredit     = str_replace(',', '', $kredit);

        $totalTrans = trim($this->input->post('totalDebet'));
        $totalTrans = str_replace(',', '', $totalTrans);
        /*if($debet > 0){
            $nominal    = $debet;
        }else{
            $nominal    = $kredit;
        }*/
        //$nominal = trim($this->input->post('DL_kodehub_dep'));
        $data = array(
            'trans_id'      => 0,
            'tgl_trans'     => $tglTrans,
            'kode_jurnal'   => trim($this->input->post('dLKodeJurnal')),
            'no_bukti'      => trim($this->input->post('txtNoRef')),
            'src'           => 'GL',
            'nominal'       => $totalTrans,
            'keterangan'    => trim($this->input->post('txtJudulJurnal')),
            'sync'          => 0,
            'CAB'           => '',
            'cTrans_Id'     => 0,
            'KonsCab'       =>''
        );

        $query_deposito=$this->akuntansiM->insertTransMaster($data);

        $transIdMax=$this->akuntansiM->getTransIdMax($tglTrans,trim($this->input->post('dLKodeJurnal')),trim($this->input->post('txtNoRef')),$totalTrans,trim($this->input->post('txtJudulJurnal')));
        $transIdMax = $transIdMax[0]->trans_id;
        /*foreach ( $nasabah_id_max as $row ){
            $array = array (
                'nasabah_id_max' => $row->nasabah_id_max,
            );
        }
        $nasabah_id_max=$array['nasabah_id_max'];*/
        //show_nasabah_id($nasabah_id_max);
        $data = array(
            'trans_id'      => 0,
            'master_id'     => $transIdMax,
            'uraian'     => trim($this->input->post('txtUraian')),
            'kode_perk'   => trim($this->input->post('dLKodeJurnal')),
            'debet'      => trim($this->input->post('txtNoRef')),
            'kredit'           => 'GL',
            'saldo_akhir'       => $totalTrans,
            'modul'    => trim($this->input->post('txtJudulJurnal')),
            'no_rek'          => 0,
            'sync'           => '',
            'konscab'     => 0,
            'cMaster_id'       =>'',
            'cTrans_id'       =>'',
            'kons_perk'       =>'',
            'CAB'       =>'',
            'OUTLET'       =>''
        );

        $this->session->set_flashdata('success', 'Data jurnal berhasil disimpan.');
        redirect('akuntansi/home');
    }

	


}

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
