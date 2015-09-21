<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_inventory extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('homemodel');
		$this->load->model('usermodel');
		$this->load->model('master_inventorymodel');
		$this->load->helper('form','url');
		//$this->load->driver('cache');
		//$this->cache->useMemcache('127.0.0.1', '11211');
    }
	
	public function inventory(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor();
			$data ['cabang'] = $this->master_inventorymodel->get_cabang();
			$data ['group1'] = $this->master_inventorymodel->get_group1();
			$data ['group2'] = $this->master_inventorymodel->get_group2();
			$data ['perkiraan'] = $this->master_inventorymodel->get_perkiraan();
			$data ['inventaris'] = $this->master_inventorymodel->get_perkiraan();
			$data['judul'] = 'Inventory';
			$this->template->set('title', 'Master Inventory');
			$this->template->load('tempDataTable','admin/inventory',$data);
   		}
	}
	function get_inventory(){
		$this->CI =& get_instance();
        $rows = $this->master_inventorymodel->get_inventaris();
        $data['data'] = array();
        foreach( $rows as $row ) {
            $array = array(
                'noref' => trim($row->NO_REF),
                'deskripsiref' => trim($row->DESKRIPSI_REF),
                'nilaipengadaan' =>  number_format($row->NILAI_PENGADAAN,2),
                'cab'    => trim($row->nama_cab),
				'tanggal' =>trim($row->TGL_PENGADAAN)
            );
            array_push($data['data'],$array);
        }
        $this->output->set_output(json_encode($data));
	}
	
	function get_deskripsi_inv(){
		$this->CI =& get_instance();
		$id = $this->input->post('noref', TRUE );
        $rows = $this->master_inventorymodel->get_desc_inventaris($id);
        if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris' => 1,
				'NO_REF' => $row->NO_REF,
				'DESKRIPSI_REF' => $row->DESKRIPSI_REF,
				'CAB' => $row->CAB,
				'TGL_PENGADAAN' => $row->TGL_PENGADAAN,
				'TGL_JT' => $row->TGL_JT,
				'NILAI_PENGADAAN' => $row->NILAI_PENGADAAN,
				'UMUR_EKONOMIS' => $row->UMUR_EKONOMIS,
				'KODE_GROUP1' => $row->KODE_GROUP1,
				'KODE_GROUP2' => $row->KODE_GROUP2,
				'KODE_PERK' => $row->KODE_PERK,
				'KODE_PERK_PENYUSUTAN' => $row->KODE_PERK_PENYUSUTAN,
				'KODE_PERK_BIAYA' => $row->KODE_PERK_BIAYA
			);
		}else{
			$array=array('baris' => 0);
		}
		$this->output->set_output(json_encode($array));
	}
	function get_list_susut(){
		$id = $_GET["id"];
		$rows = $this->master_inventorymodel->get_trans_inventaris($id);
        $data['data'] = array();
        foreach( $rows as $row ) {
            $array = array(
                'trans_id' => trim($row->TRANS_ID),
                'tanggal' => trim($row->TGL_TRANS),
                'jmlsusut' =>  number_format($row->JML_PENYUSUTAN,2),
                'susutke'    => trim($row->PENYUSUTAN_KE)
            );
            array_push($data['data'],$array);
        }
        $this->output->set_output(json_encode($data));
	}
	
	function simpan_inventory(){
		$noref      = $this->input->post('noref',true);
		$desref     = $this->input->post('desref',true);
		$cabang     = $this->input->post('cabang',true);
		$group1     = $this->input->post('group1',true);
		$group2     = $this->input->post('group2',true);
		$tanggal    = $this->input->post('tanggal',true);
		$nilaiAsli  = $this->input->post('nilai',true);
		$nilaiA 	= str_replace('.00','',$nilaiAsli);
		$nilai		= str_replace(',','',$nilaiA);
		$umur 	    = $this->input->post('umur',true);
		$tempo 	    = $this->input->post('tempo',true);
		$kode_perk  = $this->input->post('kode_perk',true);
		$kode_susut = $this->input->post('kode_susut',true);
		$kode_biaya = $this->input->post('kode_biaya',true);
		
		$cek = $this->master_inventorymodel->get_trans_inventaris_by_id($noref);
		
		$dataSusut = array(
		 	'NO_REF'      			=> $noref,
		 	'DESKRIPSI_REF'     	=> $desref,
		 	'TYPE_PENYUSUTAN'   	=> '',
		 	'CAB'   				=> $cabang,
			'STATUS_AKTIF' 			=> 1,
			'TGL_PENGADAAN'			=> $tanggal,
			'TGL_JT'				=> $tempo,
			'NILAI_PENGADAAN'		=> $nilai,
			'UMUR_EKONOMIS'			=> $umur,
			'KODE_GROUP1'			=> $group1,
			'KODE_GROUP2'			=> $group2,
			'SALDO_AWAL'			=> '',
			'SALDO_PEMBELIAN'		=> $nilai,
			'SALDO_PENYUSUTAN'		=> '',
			'NILAI_BUKU'			=> '',
			'KODE_PERK'				=> $kode_perk,
			'KODE_PERK_PENYUSUTAN'	=> $kode_susut,
			'KODE_PERK_BIAYA'		=> $kode_biaya
		);
		
		$data['data'] = array();
		$tgl= $tempo;
		list($awal,$tengah,$akhir)=explode('-',$tgl,3);
		if ($tengah < 10) {
		$bulan=str_replace('0','',$tengah);
		}else{
		$bulan=$tengah;
		}
		$tahun=$awal;
		$tanggal=$akhir;
		//$bulan=$tengah;
		$pokok = $nilai;
		$jangka = $umur;
		//rumus hitung pokok yang harus di bayar tiap bulan
		$pokok_b=($pokok / $jangka);
		
		//pembulatan pokok angsuran
		
		$sisa = $pokok_b % 100;
		if ($sisa > 0){
		$bulat= 100 - $sisa;
		$hasil=$pokok_b + $bulat;
		}
		else{
		$hasil=$pokok_b;
		}
		$angsur=$pokok;
		if ($cek){
			$query  = $this->master_inventorymodel->hapus_susut($noref);
			$query2 = $this->master_inventorymodel->hapus_susutrans($noref);
		}	
			$query3 = $this->master_inventorymodel->insert_susut($dataSusut);
			$i = 1;
			$y = $jangka - 1;
			for($i==1;$i<=$jangka;$i++){
				if ($i==$y){
					$x = $hasil * $y;
				}
				if($i==$jangka){
					$hasil = $pokok - $x;
				}else{
					$angsur=$angsur - $hasil;
				}
			$bulan=$bulan+1;
				if ($bulan > 12){
				$bulan=1;
				$tahun=$tahun+1;
				}else{
				$bulan=$bulan;
				}
				
				$dataSusutrans = array(
					'NO_REF'      		=> $noref,
					'TGL_TRANS'			=> $tahun.'-'.$bulan.'-'.$tanggal,
					'KODE_TRANS'		=> '',
					'KUITANSI'			=> '',
					'KODE_PERK_GL'		=> '',
					'TOB'				=> 'O',
					'PENYUSUTAN_KE'		=> $i,
					'MY_KODE_TRANS'		=> 200,
					'JML_PENYUSUTAN'	=> floor($hasil),
					'VALIDATED'			=> 1,
					'POSTED'			=> 1,
					'CAB'				=> $cabang,
					'USERID'			=> $this->session->userdata('user_id')
				);
				$query4 = $this->master_inventorymodel->insert_susutrans($dataSusutrans);
			}
			if($query3){
				$Message = 'Sukses';
				$val = '1';
				$a = array( 'pesan' => $Message, 'isi' => $val);
			}else{
				$Message = 'Gagal.Silahkan hubungi Administrator';
				$val = '0';
				$a = array( 'pesan' => $Message, 'isi' => $val);
			}
		$this->output->set_output(json_encode($a));
	}
	
	function realisasi(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor();
			$data ['cabang'] = $this->master_inventorymodel->get_cabang();
			$data['judul'] = 'Realisasi';
			$this->template->set('title', 'Realisasi');
			$this->template->load('tempDataTable','admin/realisasi',$data);
   		}
	}
	
	function get_inv_realisasi(){
		$this->CI =& get_instance();
        $rows = $this->master_inventorymodel->get_inventaris_realisasi();
        $data['data'] = array();
        foreach( $rows as $row ) {
            $array = array(
                'noref' 			=> trim($row->NO_REF),
                'deskripsiref'  	=> trim($row->DESKRIPSI_REF),
                'nilaipengadaan' 	=> number_format($row->NILAI_PENGADAAN,2),
                'cab'    			=> trim($row->nama_cab),
				'tanggal' 			=> trim($row->TGL_PENGADAAN)
            );
            array_push($data['data'],$array);
        }
        $this->output->set_output(json_encode($data));
	}
	
	function simpan_realisasi(){
		$noref      = $this->input->post('noref',true);
		$cabang     = $this->input->post('cabang',true);
		$tanggal    = $this->input->post('tanggal',true);
		$nilaiAsli  = $this->input->post('nilai',true);
		$nilaiA 	= str_replace('.00','',$nilaiAsli);
		$nilai		= str_replace(',','',$nilaiA);
		$umur 	    = $this->input->post('umur',true);
		$kwitansi 	= $this->input->post('kwitansi',true);
		$kode_trans = $this->input->post('kode_trans',true);
		
		$cek = $this->master_inventorymodel->get_susutrans_by_id($noref,$kode_trans,$kwitansi);
		$data['data'] = array();
		
		$pokok = $nilai;
		$jangka = $umur;
		//rumus hitung pokok yang harus di bayar tiap bulan
		$pokok_b=($pokok / $jangka);
		
		//pembulatan pokok angsuran
		
		$sisa = $pokok_b % 100;
		if ($sisa > 0){
		$bulat= 100 - $sisa;
		$hasil=$pokok_b + $bulat;
		}
		else{
		$hasil=$pokok_b;
		}
			$dataSusutrans = array(
				'NO_REF'      		=> $noref,
				'TGL_TRANS'			=> $tanggal,
				'KODE_TRANS'		=> $kode_trans,
				'KUITANSI'			=> $kwitansi,
				'KODE_PERK_GL'		=> '',
				'TOB'				=> 'T',
				'PENYUSUTAN_KE'		=> '',
				'MY_KODE_TRANS'		=> 100,
				'JML_PENYUSUTAN'	=> floor($hasil),
				'VALIDATED'			=> 1,
				'POSTED'			=> 1,
				'CAB'				=> $cabang,
				'USERID'			=> $this->session->userdata('user_id')
			);			
			if($cek){
				$Message = 'Kode transaksi ini sudah dipakai';
				$val = '1';
				$a = array( 'pesan' => $Message, 'isi' => $val);
			}else{
				$query4 = $this->master_inventorymodel->insert_susutrans($dataSusutrans);
				$Message = 'sukses';
				$val = '0';
				$a = array( 'pesan' => $Message, 'isi' => $val);
			}
		$this->output->set_output(json_encode($a));
	}
	
	function penyusutan(){
		if ($this->auth->is_logged_in () == false) {
			$this->login();
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor();
			$data ['cabang'] = $this->master_inventorymodel->get_cabang();
			$data ['judul'] = 'Penyusutan';
			$this->template->set('title', 'Penyusutan');
			$this->template->load('tempDataTable','admin/penyusutan_inventory',$data);
   		}
	}
	
	function get_jadwal(){
		$this->CI =& get_instance();
        $rows = $this->master_inventorymodel->get_all_susutrans();
        $data['data'] = array();
        foreach( $rows as $row ) {
            $array = array(
                'transid' 			=> trim($row->TRANS_ID),
                'noref'  			=> trim($row->NO_REF),
                'jmlpenyusutan' 	=> number_format($row->JML_PENYUSUTAN,2),
                'cab'    			=> trim($row->nama_cab),
				'tanggal' 			=> trim($row->TGL_TRANS),
				'susutke'			=> trim($row->PENYUSUTAN_KE)
            );
            array_push($data['data'],$array);
        }
        $this->output->set_output(json_encode($data));
	}
	function get_deskripsi_susut(){
		$this->CI =& get_instance();
		$id = $this->input->post('transid', TRUE );
        $rows = $this->master_inventorymodel->get_desc_susut($id);
        if($rows){
		foreach ( $rows as $row )
			$array = array (
				'baris' => 1,
				'TRANS_ID' => $row->TRANS_ID,
				'NO_REF' => $row->NO_REF,
				'DESC_REF' => $row->DESKRIPSI_REF,
				'CAB' => $row->CAB,
				'TGL_TRANS' => $row->TGL_TRANS,
				'KODE_TRANS' => $row->KODE_TRANS,
				'KUITANSI' => $row->KUITANSI,
				'PENYUSUTAN_KE' => $row->PENYUSUTAN_KE,
				'JML_PENYUSUTAN' => $row->JML_PENYUSUTAN
			);
			
		}else{
			$array=array('baris' => 0);
		}
		$this->output->set_output(json_encode($array));
	}
	
	function simpan_penyusutan(){
		$trans_id   = $this->input->post('trans_id',true);
		$noref      = $this->input->post('noref',true);
		
		$cek = $this->master_inventorymodel->cek_susutrans_by_id($noref);
		$rows = $this->master_inventorymodel->get_susutrans_by_transid($trans_id);
			foreach ($rows as $row ){
					$NO_REF      		= $row->NO_REF;
					$TGL_TRANS			= $row->TGL_TRANS;
					$KODE_TRANS			= $row->KODE_TRANS;
					$KUITANSI			= $row->KUITANSI;
					$PENYUSUTAN_KE		= $row->PENYUSUTAN_KE;
					$JML_PENYUSUTAN		= $row->JML_PENYUSUTAN;
					$CAB				= $row->CAB;
			}
				$dataSusutrans = array(
					'NO_REF'      		=> $NO_REF,
					'TGL_TRANS'			=> $TGL_TRANS,
					'KODE_TRANS'		=> $KODE_TRANS,
					'KUITANSI'			=> $KUITANSI,
					'KODE_PERK_GL'		=> '',
					'TOB'				=> 'O',
					'PENYUSUTAN_KE'		=> $PENYUSUTAN_KE,
					'MY_KODE_TRANS'		=> 300,
					'JML_PENYUSUTAN'	=> $JML_PENYUSUTAN,
					'VALIDATED'			=> 1,
					'POSTED'			=> 1,
					'CAB'				=> $CAB,
					'USERID'			=> $this->session->userdata('user_id')
				);
			if($cek){
				$Message = 'Kode transaksi ini sudah dipakai';
				$val = '1';
				$a = array( 'pesan' => $Message, 'isi' => $val);
			}else{
				$query4 = $this->master_inventorymodel->insert_susutrans($dataSusutrans);
				$Message = 'sukses';
				$val = '0';
				$a = array( 'pesan' => $Message, 'isi' => $val);
			}
		$this->output->set_output(json_encode($a));
	}
}
