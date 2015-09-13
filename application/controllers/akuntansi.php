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
        //$transIdMax = $transIdMax[0]->trans_id;
        foreach ( $transIdMax as $row ){
            $array = array (
                'transIdMax' => $row->transidmax,
            );
        }
        $transIdMax=$array['transIdMax'];

        $totJurnal  = trim($this->input->post('txtTempLoop'));
        for($i=1;$i<=$totJurnal;$i++){
            $tKodePerk          = 'tempKodePerk'.$i;
            $tSaldoDebet        = 'tempSaldoDebet'.$i;
            $tSaldoKredit       = 'tempSaldoKredit'.$i;
            $tUraian            = 'tempUraian'.$i;

            $tmpKodePerk        = trim($this->input->post($tKodePerk ));
            $tmpSaldoDebet      = str_replace(',', '', trim($this->input->post($tSaldoDebet )));
            $tmpSaldoKredit     = str_replace(',', '', trim($this->input->post($tSaldoKredit )));
            $tmpUraian          = trim($this->input->post($tUraian ));

            $data = array(
                'trans_id'      => 0,
                'master_id'     => $transIdMax,
                'uraian'        => $tmpUraian,
                'kode_perk'     => $tmpKodePerk,
                'debet'         => $tmpSaldoDebet,
                'kredit'        => $tmpSaldoKredit,
                'saldo_akhir'   => 0,
                'modul'         => '',
                'no_rek'        => '',
                'sync'          => 0,
                'cab'           => '',
                'cMaster_id'    => 0,
                'cTrans_id'     => 0,
                'kons_perk'     =>'',
                'konscab'       => '',
                'OUTLET'        =>''
            );
            $query_deposito=$this->akuntansiM->insertTransDetail($data);
            if(substr($tmpKodePerk,0,1)=='1' || substr($tmpKodePerk,0,1)=='5'){
                $this->akuntansiM->updateSaldoPerkiraan15($tmpKodePerk,$tmpSaldoDebet,$tmpSaldoKredit);
                //
            }else{
                $this->akuntansiM->updateSaldoPerkiraan234($tmpKodePerk,$tmpSaldoDebet,$tmpSaldoKredit);
            }


        }



        $this->session->set_flashdata('success', 'Data jurnal berhasil disimpan.');
        redirect('akuntansi/home');
    }

	


}

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
