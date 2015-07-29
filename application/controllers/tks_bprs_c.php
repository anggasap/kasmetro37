<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tks_bprs_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tks_bprsmodel');
		$this->load->model('kasmodel');
		$this->load->helper('url');
    }

    public function index(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'tempDataTable', 'admin/index',$data );
   		}
	}
	
	
	public function tampil_faktor(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 35 );
		
		$data['judul']='Tingkat Kesehatan BPRS';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['tampil_faktor']=$this->tks_bprsmodel->tampil_faktor();
		$data ['perkiraan'] = $this->kasmodel->get_perkiraan ();
		
		$this->template->set ( 'title', 'Tingkat Kesehatan BPRS' );
		$this->template->load ( 'tempDataTable', 'admin/tks_bprsv', $data );
		
	}
	public function tampil_skor(){
		$this->auth->restrict();
		$this->auth->cek_menu ( 36 );
		
		if(isset($_POST["btnTampil"])) {
			
    		$this->tampil_tks();
            /*echo 'a';
            $this->template->set ( 'title', 'Tingkat Kesehatan BPRS' );
            $this->template->load ( 'tempDataTable', 'admin/tksy_bprs_skv' );*/
  		}else{
			$data['judul'] = 'Tingkat Kesehatan BPRS';
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			
			$this->template->set ( 'title', 'Tingkat Kesehatan BPRS' );
			$this->template->load ( 'tempDataTable', 'admin/tks_bprs_skv', $data );
		}
	}
	function tampil_tks(){
		
		
		$tgl = $this->input->post('txtTanggal');
		$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$pajak_koma = trim($this->input->post('txtPajak'));
		$pajak = str_replace(',', '', $pajak_koma); // pajak
		
		$run_query = $this->tks_bprsmodel->insert_temp_perk($tgl_trans);
		
		// KPMM MODAL INTI
		$kpmm_modal_inti = $this->tks_bprsmodel->kpmm_modal_inti($tgl_trans);
		foreach ( $kpmm_modal_inti as $row )
		$data['kpmm_modal_inti'] = $row->saldo;
		
		// KPMM MODAL PELENGKAP
		$kpmm_modal_pelengkap = $this->tks_bprsmodel->kpmm_modal_pelengkap($tgl_trans);
		foreach ( $kpmm_modal_pelengkap as $row )
		$data['kpmm_modal_pelengkap'] = $row->saldo;
		
		// KPMM ATMR NERACA
		$kpmm_atmr_nrc = $this->tks_bprsmodel->kpmm_atmr_nrc($tgl_trans);
		foreach ( $kpmm_atmr_nrc as $row )
		$data['kpmm_atmr_nrc'] = $row->saldo;
		
		// KPMM ATMR ADM
		$kpmm_atmr_adm = $this->tks_bprsmodel->kpmm_atmr_adm($tgl_trans);
		foreach ( $kpmm_atmr_adm as $row )
		$data['kpmm_atmr_adm'] = $row->saldo;
		
		$data['kpmm_atmr']=$data['kpmm_atmr_nrc'] - $data['kpmm_atmr_adm'];
		
		if($data['kpmm_modal_pelengkap']<$data['kpmm_modal_inti']){
			$data['kpmm_modal_pelengkap']=$data['kpmm_modal_pelengkap'];
		}else{
			$data['kpmm_modal_pelengkap']=$data['kpmm_modal_inti'];
		}
		$data['kpmm_modal']=$data['kpmm_modal_inti']+$data['kpmm_modal_pelengkap'];
		$kpmm = ($data['kpmm_modal'] / $data['kpmm_atmr'])*100;
		$data['kpmm'] = $kpmm; 
		
		//APYD
		$kap_apyd = $this->tks_bprsmodel->kap_apyd($tgl_trans);
		$data['kap_apyd'] = 100000000;//$kap_apyd['KL']; // ATAU $data['kap_apyd'] = $kap_apyd['0'];
		$kap_prod = $this->tks_bprsmodel->kap_prod($tgl_trans);
		foreach ( $kap_prod as $row )
		$data['kap_prod'] = $row->saldo;
		
		$data['kap_eaq'] = (1-($data['kap_apyd']/$data['kap_prod']))*100;
		
		//REN BO
		$ren_bo = $this->tks_bprsmodel->ren_bo($tgl_trans);
		foreach ( $ren_bo as $row )
		$data['ren_bo'] = $row->saldo;
		//REN PO
		$ren_po = $this->tks_bprsmodel->ren_po($tgl_trans);
		foreach ( $ren_po as $row )
		$data['ren_po'] = $row->saldo;
		
		$ren1 = ($data['ren_bo'] / $data['ren_po'])*100;
		$data['ren1'] = $ren1; 
		
		//ROA PEND
		$roa_pend = $this->tks_bprsmodel->roa_pend($tgl_trans);
		foreach ( $roa_pend as $row )
		$data['roa_pend'] = $row->saldo;
		//ROA BIAYA
		$roa_biaya = $this->tks_bprsmodel->roa_biaya($tgl_trans);
		foreach ( $roa_biaya as $row )
		$data['roa_biaya'] = $row->saldo;
		//ROALR
		$roa_lr = $data['roa_pend'] - $data['roa_biaya'];
		
		//ROA ASET
		$roa_aset = $this->tks_bprsmodel->roa_aset($tgl_trans);
		foreach ( $roa_aset as $row )
		$data['roa_aset'] = $row->saldo;
		
		$data['roa'] = $roa_lr/$data['roa_aset']*100;
		
		//LABARUGI SETELAH PAJAK
		$lb_pjk = $roa_lr - $pajak;
		
		//ROE MODAL
		$roe_modal = $this->tks_bprsmodel->roe_modal($tgl_trans);
		foreach ( $roe_modal as $row )
		$data['roe_modal'] = $row->saldo;
		
		$data['roe'] = $lb_pjk/$data['roe_modal']*100;
		
		//LIQ AKTIVA
		$liq_ak = $this->tks_bprsmodel->liq_ak($tgl_trans);
		foreach ( $liq_ak as $row )
		$data['liq_ak'] = $row->saldo;
		
		//LIQ PASIVA
		$liq_psv = $this->tks_bprsmodel->liq_psv($tgl_trans);
		foreach ( $liq_psv as $row )
		$data['liq_psv'] = $row->saldo;
		
		$data['cr'] = $data['liq_ak']/$data['liq_psv']*100;
		
		
		
		
		$data['judul'] = 'Tingkat Kesehatan BPRS';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$this->template->set ( 'title', 'Tingkat Kesehatan BPRS' );
		$this->template->load ( 'tempDataTable', 'admin/tks_bprs_tsv',$data );
		
		
		//	redirect('tks_bprs_c/tampil_skor');
		
	}
	function proses_cari_komponen_perk(){
			$this->CI =& get_instance();
			$nama = $this->input->post('item',TRUE);
			$rows = $this->tks_bprsmodel->tampil_komponen($nama);
			$data['norek'] = array();
			foreach ( $rows as $row ){
				$data['norek'][] = array (
					'id_komp_perk' => $row->id_komponen_perk,
					'kode_perk' => $row->kode_perk,
					'nama_perk' => $row->nama_perk,
					'op' => $row->op,
					'bot_res' => $row->bobot_resiko
				);
			}
			$this->output->set_output(json_encode($data));
		}
	function insert_komponen_perk(){
		$this->CI =& get_instance();
		$kd_perk = $this->input->post('kd_perk',TRUE);
		$id_faktor = $this->input->post('id_f',TRUE);
		$id_rasio = $this->input->post('id_r',TRUE);
		$id_komp_master = $this->input->post('id_k',TRUE);
		$pos_neg = $this->input->post('pos_neg',TRUE);
		$bot_res = $this->input->post('bot_res',TRUE);
		
		$rows = $this->tks_bprsmodel->insert_komponen($id_rasio,$id_faktor,$id_komp_master,$kd_perk,$pos_neg,$bot_res);
	}
	function hapus_komponen_perk(){
		$this->CI =& get_instance();
		$id_komp_perk = $this->input->post('id_komp_perk',TRUE);
		$rows = $this->tks_bprsmodel->hapus_komponen_perk($id_komp_perk);
	}
	
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */