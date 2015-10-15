<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_depositomodel extends CI_Model {
	public function getRekDepAll()
	{
		$sql="SELECT n.nasabah_id,t.no_rekening,n.nama_nasabah,n.alamat,t.saldo_akhir
				from deposito t left join nasabah n on t.nasabah_id = n.nasabah_id
				order by no_rekening asc";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getDeskripsiRekDep($noRekDep){
		$sql ="select t.jenis_deposito,t.abp, t.status_aktif, t.no_alternatif, 
		t.jml_deposito, t.suku_bunga,t.persen_pph, t.tgl_registrasi,
		t.jkw,t.tgl_jt, t.tgl_mulai,t.tgl_valuta,
		t.type_suku_bunga, t.masuk_titipan, t.bunga_berbunga, t.no_rek_tabungan,
		t.aro, t.kode_group1, t.kode_group2, t.kode_group3,
		t.kode_bi_pemilik, t.kode_bi_metoda, t.kode_bi_hubungan,
		n.nasabah_id,n.nama_nasabah, n.alamat
		from deposito t left join nasabah n on t.nasabah_id = n.nasabah_id
		where no_rekening = '$noRekDep'";
		$query	= $this->db->query($sql);
		return $query->result();
	}
	public function getNamaRekTab($noRekTab) {
		$sql= "select n.nama_nasabah from nasabah n, tabung t where
				t.nasabah_id = n.nasabah_id and t.no_rekening='$noRekTab'";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function get_jenis_dep() {
		$rows = array(); //will hold all results
		$sql="select * from kodejenisdeposito order by KODE_JENIS_DEPOSITO asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup1_dep() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup1deposito order by KODE_GROUP1 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup2_dep() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup2deposito order by KODE_GROUP2 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kodegroup3_dep() {
		$rows = array(); //will hold all results
		$sql="select * from kodegroup3deposito order by KODE_GROUP3 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function desk_prod_deposito($kode) {
		$this->db->select ( 'SUKU_BUNGA_DEFAULT,PPH_DEFAULT,JKW_DEFAULT' );
		$this->db->from('kodejenisdeposito');
		$this->db->where ( 'KODE_JENIS_DEPOSITO', $kode );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	function insert_deposito($data){
	   $query=$this->db->insert('deposito',$data);
	}
}

/* End of file master_nasabahmodel.php */
/* Location: ./application/models/master_nasabahmodel.php */