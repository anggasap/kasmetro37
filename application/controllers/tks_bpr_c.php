<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tks_bpr_c extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tks_bprmodel');
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
			$this->template->load ( 'template', 'admin/index',$data );
   		}
	}
	
	
	public function tampil_faktor(){
		$this->auth->restrict ();
		$this->auth->cek_menu ( 40 );
		
		$data['judul']='Tingkat Kesehatan BPR';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$data ['tampil_faktor']=$this->tks_bprmodel->tampil_faktor();
		$data ['tampil_konstanta']=$this->tks_bprmodel->tampil_konstanta();
		$data ['perkiraan'] = $this->kasmodel->get_perkiraan ();
		
		$this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
		$this->template->load ( 'template', 'admin/tks_bprv', $data );
		
	}
	public function tampil_skor(){
		$this->auth->restrict();
		$this->auth->cek_menu ( 41 );
		
		if(isset($_POST["btnTampil"])) {
			
    		$this->tampil_tks();
  		}else{
			$data['judul'] = 'Tingkat Kesehatan BPR';
			$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			
			$this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
			$this->template->load ( 'template', 'admin/tks_bpr_skv', $data );
		}
	}
	function tampil_tks(){

		$tgl = $this->input->post('txtTanggal');
		$timestamp = strtotime($tgl);
		$tgl_trans = date('Y-m-d', $timestamp);
		
		$pajak_koma = trim($this->input->post('txtPajak'));
		$pajak = str_replace(',', '', $pajak_koma); // pajak
		
		$run_query = $this->tks_bprmodel->insert_temp_perk($tgl_trans);
		
		// CAR MODAL
		$car_modal = $this->tks_bprmodel->get_modal($tgl_trans);
		foreach ( $car_modal as $row )
		$data['car_modal'] = $row->saldo;
		
		// CAR LABA RUGI BERJALAN
		$car_labarugi_berjalan = $this->tks_bprmodel->get_labarugi_berjalan($tgl_trans);
		foreach ( $car_labarugi_berjalan as $row )
		$data['car_labarugi_berjalan'] = $row->lbrg_berjalan;
		
		
		// CAR LABA RUGI TAHUN LALU
		$car_labarugi_tahunlalu = $this->tks_bprmodel->get_labarugi_tahunlalu($tgl_trans);
		foreach ( $car_labarugi_tahunlalu as $row )
		$data['car_labarugi_tahunlalu'] = $row->saldo;
		
		// CAR PPAP
		$car_ppap = $this->tks_bprmodel->get_ppap($tgl_trans);
		foreach ( $car_ppap as $row )
		$data['car_ppap'] = $row->saldo;
		
		$data['car_tot_modal'] = $data['car_modal'] + ($data['car_labarugi_berjalan']/2) + $data['car_labarugi_tahunlalu']+$data['car_ppap'];
		
		// CAR ATMR 
		$car_atmr = $this->tks_bprmodel->get_atmr($tgl_trans);
		foreach ( $car_atmr as $row )
		$data['car_atmr'] = $row->saldo;
		
		$data['car'] = $data['car_tot_modal'] / $data['car_atmr']*100;
		//==========================================================
		
		
		
		// LIKUIDITAS ALAT LIKUID
		$lik_alat_likuid = $this->tks_bprmodel->get_lik_alat_likuid($tgl_trans);
		foreach ( $lik_alat_likuid as $row )
		$data['lik_alat_likuid'] = $row->saldo;
		
		// LIKUIDITAS HUTANG LANCAR
		$lik_hutang_lancar = $this->tks_bprmodel->get_lik_hutang_lancar($tgl_trans);
		foreach ( $lik_hutang_lancar as $row )
		$data['lik_hutang_lancar'] = $row->saldo; 
		
		$data['likuiditas'] = $data['lik_alat_likuid']/$data['lik_hutang_lancar']*100;
		
		// LDR KYD
		$ldr_kyd = $this->tks_bprmodel->get_ldr_kyd($tgl_trans);
		foreach ( $ldr_kyd as $row )
		$data['ldr_kyd'] = $row->saldo;
		
		// LDR MODAL INTI
		$ldr_modal_inti = $this->tks_bprmodel->get_ldr_modal_inti($tgl_trans);
		foreach ( $ldr_modal_inti as $row )
		$data['ldr_modal_inti'] = $row->saldo; 
		
		$data['ldr'] = $data['ldr_kyd']/$data['ldr_modal_inti']*100;
		
		// KAP PPAP
		$kap_ppap = $this->tks_bprmodel->get_kap_ppap($tgl_trans);
		foreach ( $kap_ppap as $row )
		$data['kap_ppap'] = abs($row->saldo);
		
		// KAP PPAPWD
		$kap_ppapwd = $this->tks_bprmodel->get_kap_ppapwd($tgl_trans);
		foreach ( $kap_ppapwd as $row )
		$data['kap_ppapwd'] = $row->saldo;
		
		$data['kap'] = $data['kap_ppap']/$data['kap_ppapwd']*100;
		/*
		//APYD
		$kap_apyd = $this->tks_bprmodel->kap_apyd($tgl_trans);
		$data['kap_apyd'] = $kap_apyd['KL']; // ATAU $data['kap_apyd'] = $kap_apyd['0']; 
		$kap_prod = $this->tks_bprmodel->kap_prod($tgl_trans);
		foreach ( $kap_prod as $row )
		$data['kap_prod'] = $row->saldo;
		
		$data['kap_eaq'] = (1-($data['kap_apyd']/$data['kap_prod']))*100;
		*/
		
		//REN BO
		$ren_bo = $this->tks_bprmodel->ren_bo($tgl_trans);
		foreach ( $ren_bo as $row )
		$data['ren_bo'] = $row->saldo;
		//REN PO
		$ren_po = $this->tks_bprmodel->ren_po($tgl_trans);
		foreach ( $ren_po as $row )
		$data['ren_po'] = $row->saldo;
		
		$ren1 = ($data['ren_bo'] / $data['ren_po'])*100;
		$data['ren1'] = $ren1; 
		
		//ROA PEND
		$roa_pend = $this->tks_bprmodel->roa_pend($tgl_trans);
		foreach ( $roa_pend as $row )
		$data['roa_pend'] = $row->saldo;
		//ROA BIAYA
		$roa_biaya = $this->tks_bprmodel->roa_biaya($tgl_trans);
		foreach ( $roa_biaya as $row )
		$data['roa_biaya'] = $row->saldo;
		//ROALR
		$roa_lr = $data['roa_pend'] - $data['roa_biaya'];
		$data['roa_lr']=$roa_lr;
		//ROA ASET
		$roa_aset = $this->tks_bprmodel->roa_aset($tgl_trans);
		foreach ( $roa_aset as $row )
		$data['roa_aset'] = $row->saldo;
		
		$data['roa'] = $roa_lr/$data['roa_aset']*100;
		
		//LABARUGI SETELAH PAJAK
		$lb_pjk = $roa_lr - $pajak;
		
		/*
		//ROE MODAL
		$roe_modal = $this->tks_bprmodel->roe_modal($tgl_trans);
		foreach ( $roe_modal as $row )
		$data['roe_modal'] = $row->saldo;
		
		$data['roe'] = $lb_pjk/$data['roe_modal']*100;
		
		//LIQ AKTIVA
		$liq_ak = $this->tks_bprmodel->liq_ak($tgl_trans);
		foreach ( $liq_ak as $row )
		$data['liq_ak'] = $row->saldo;
		
		//LIQ PASIVA
		$liq_psv = $this->tks_bprmodel->liq_psv($tgl_trans);
		foreach ( $liq_psv as $row )
		$data['liq_psv'] = $row->saldo;
		
		$data['cr'] = $data['liq_ak']/$data['liq_psv']*100;
		
		
		*/
		
		$data['judul'] = 'Tingkat Kesehatan BPR';
		$data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
		$this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
		$this->template->load ( 'template', 'admin/tks_bpr_tsv',$data );
		
		
		//	redirect('tks_bpr_c/tampil_skor');
		
	}
	function proses_cari_komponen_perk(){
		$this->CI =& get_instance();
		$nama = $this->input->post('item',TRUE);
		$rows = $this->tks_bprmodel->tampil_komponen($nama);
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
	/*
	function daftar_perk(){
		$this->CI =& get_instance();
		$nama = $this->input->post('item',TRUE);
		$rows = $this->tks_bprmodel->daftar_perk();
		$data['norek'] = array();
		foreach ( $rows as $row ){
			$data['norek'][] = array (
				'kode_perk' => $row->kode_perk,
				'nama_perk' => $row->nama_perk,
				'type' => $row->type
			);
		}
		$this->output->set_output(json_encode($data));
	}
	*/
	function insert_komponen_perk(){
		$this->CI =& get_instance();
		$kd_perk = $this->input->post('kd_perk',TRUE);
		$id_faktor = $this->input->post('id_f',TRUE);
		$id_rasio = $this->input->post('id_r',TRUE);
		$id_komp_master = $this->input->post('id_k',TRUE);
		$pos_neg = $this->input->post('pos_neg',TRUE);
		$bot_res = $this->input->post('bot_res',TRUE);
		
		$rows = $this->tks_bprmodel->insert_komponen($id_rasio,$id_faktor,$id_komp_master,$kd_perk,$pos_neg,$bot_res);
	}
	function insert_konstanta_perk(){
		$this->CI =& get_instance();
		$kd_perk = $this->input->post('kd_perk',TRUE);
		$id_konsperk = $this->input->post('id_konsperk',TRUE);
		$nm_konsperk = $this->input->post('nm_konsperk',TRUE);
		$rows = $this->tks_bprmodel->update_konstanta_perk($kd_perk,$id_konsperk,$id_nmperk);
	}
	function hapus_komponen_perk(){
		$this->CI =& get_instance();
		$id_komp_perk = $this->input->post('id_komp_perk',TRUE);
		$rows = $this->tks_bprmodel->hapus_komponen_perk($id_komp_perk);
	}
    public function formula(){
        $this->auth->restrict();
        $this->auth->cek_menu ( 42 );

        if(isset($_POST["btnTampil"])) {

            $this->tampil_tks();
        }else{
            $data['judul'] = 'Tingkat Kesehatan BPR';
            $data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));

            $this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
            $this->template->load ( 'tempDataTable', 'admin/tksBprFormula2V', $data );
        }
    }
	
	
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */