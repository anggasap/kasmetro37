<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_kreditmodel extends CI_Model {
	public function get_jenis_kre() {
		$rows = array(); //will hold all results
		$sql="select KODE_JENIS_KREDIT,DESKRIPSI_JENIS_KREDIT from kodejeniskredit order by KODE_JENIS_KREDIT asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup1_kre() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup1kredit order by KODE_GROUP1 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup2_kre() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup2kredit order by KODE_GROUP2 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup3_kre() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup3kredit order by KODE_GROUP3 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup4_kre() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup4kredit order by KODE_GROUP4 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_type_kre() {
		$rows = array(); //will hold all results
		$sql="select * from kodetypekredit order by KODE_TYPE_KREDIT asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_sat_waktu_angs() {
		$rows = array(); //will hold all results
		$sql="select * from kodesatuanwaktukredit order by KODE_SATUAN_WAKTU asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_sifat_kre() {
		$rows = array(); //will hold all results
		$sql="select KODESIFAT_2013,DESKRIPSI_SIFAT_2013 from kodesifatkredit order by KODESIFAT_2013 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_jenpeng_kre() {
		$rows = array(); //will hold all results
		$sql="select KODE_JENIS_PENGGUNAAN_2013,DESKRIPSI_JENIS_PENGGUNAAN_2013 from kodejenispenggunaankredit order by KODE_JENIS_PENGGUNAAN_2013 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_gol_deb() {
		$rows = array(); //will hold all results
		$sql="select KODE_GOL_DEBITUR_2013,DESKRIPSI_GOL_DEBITUR_2013 from kodegoldebitur order by KODE_GOL_DEBITUR_2013 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_sekom() {
		$rows = array(); //will hold all results
		$sql="select KODE_SEKTOR_EKONOMI,DESKRIPSI_SEKTOR_EKONOMI from kodesektorekonomikredit order by KODE_SEKTOR_EKONOMI asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_penjamin() {
		$rows = array(); //will hold all results
		$sql="select KODE_GOL_PENJAMIN,DESKRIPSI_GOL_PENJAMIN from kodegolpenjaminkredit order by KODE_GOL_PENJAMIN asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_asuransi() {
		$rows = array(); //will hold all results
		$sql="select KODE_ASURANSI,DESKRIPSI_ASURANSI from kodeasuransikredit order by KODE_ASURANSI asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sumber_pelunasan() {
		$rows = array(); //will hold all results
		$sql="select KODE_SUMBER_PELUNASAN,DESKRIPSI_SUMBER_PELUNASAN from kodesumberpelunasan order by KODE_SUMBER_PELUNASAN asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_jenis_usaha() {
		$rows = array(); //will hold all results
		$sql="select KODE_JENIS_USAHA,DESKRIPSI_JENIS_USAHA from kodejenisusaha order by KODE_JENIS_USAHA asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_periode_bayar() {
		$rows = array(); //will hold all results
		$sql="select kode_periode_pembayaran,deskripsi_periode_pembayaran from kodeperiodepembayaran order by kode_periode_pembayaran asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_sifat() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodesifat_kredit order by KODE_DESC asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_jenpeng() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodejenis_penggunaan order by KODE_DESC asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_bid_usaha() {
		$rows = array(); //will hold all results
		$sql="select KODE_BIDANG_USAHA,DESKRIPSI_BIDANG_USAHA from sidkodebidangusaha order by KODE_BIDANG_USAHA asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_gol_penj() {
		$rows = array(); //will hold all results
		$sql="select KODE_GOL_PENJAMIN,DESKRIPSI_GOL_PENJAMIN from sidkodegolongan_penjamin order by KODE_GOL_PENJAMIN asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_jenis_asuransi() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodejenis_asuransi order by KODE_DESC asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_gol_kre() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodegol_kredit order by KODE_DESC asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_jenis_fas() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodejenis_fasilitas order by KODE_DESC asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_agunan_jenis() {
		$rows = array(); //will hold all results
		$sql="select KODE_AGUNAN,DESKRIPSI_AGUNAN from jenis_agunan order by KODE_AGUNAN asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_agunan_ikhukum() {
		$rows = array(); //will hold all results
		$sql="select KODE_IKATAN_HUKUM,DESKRIPSI_IKATAN_HUKUM from kodeikatanhukumkredit order by KODE_IKATAN_HUKUM asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_agunan_jenis() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodejenis_agunan order by KODE_DESC asc  ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_sid_jenikat() {
		$rows = array(); //will hold all results
		$sql="select KODE_DESC,DESKRIPSI_DESC from sidkodejenis_pengikatan order by KODE_DESC asc  ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_deskripsi_tab($kode) {
		$this->db->select ( 'K.KODE_PERK,N.NAMA_NASABAH' );
		$this->db->from('tabung T');
		$this->db->join('kodejenistabungan K', 'T.JENIS_TABUNGAN=K.KODE_JENIS_TABUNGAN', 'LEFT');
		$this->db->join('nasabah N', 'T.nasabah_id=N.nasabah_id', 'LEFT');
		$this->db->where ( 'T.NO_REKENING', $kode );
		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function get_deskripsi_kre($kode) {
		$this->db->select ( 'N.NAMA_NASABAH' );
		$this->db->from('kredit T');
		$this->db->join('nasabah N', 'T.nasabah_id=N.nasabah_id', 'LEFT');
		$this->db->where ( 'T.NO_REKENING', $kode );
		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function get_persenlikuidasi_kre($kode) {
		$this->db->select ( 'BOBOT_IKATAN_HUKUM' );
		$this->db->from('kodeikatanhukumkredit');
		$this->db->where ( 'KODE_IKATAN_HUKUM', $kode );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	function insert_kredit($data){
	   $query=$this->db->insert('kredit',$data);
	}
	function insert_agunan($data){
	   $query=$this->db->insert('kredit_agunan',$data);
	}
	function update_agunan($data_likuidasi,$data_agunan,$norek){
		$sql="update kredit set NILAI_LIKUIDASI = NILAI_LIKUIDASI + '$data_likuidasi', BI_AGUNAN_NILAI =BI_AGUNAN_NILAI+'$data_agunan' where NO_REKENING='$norek' ";
		$this->db->query($sql);
	}
}

/* End of file master_kreditmodel.php */
/* Location: ./application/models/master_kreditmodel.php */