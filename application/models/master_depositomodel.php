<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_depositomodel extends CI_Model {
	
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