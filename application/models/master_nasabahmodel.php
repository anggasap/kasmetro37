<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_nasabahmodel extends CI_Model {
	
	public function get_gelar() {
		$rows = array(); //will hold all results
		$sql="select * from jenis_gelar order by Gelar_ID asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_jenis_id(){
		$rows = array(); //will hold all results
		$sql="select * from jenis_id order by jenis_id asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_jenis_kota(){
		$rows = array(); //will hold all results
		$sql="select Kota_id,Deskripsi_Kota from jenis_kota order by Kota_id asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_jenis_negara(){
		$rows = array(); //will hold all results
		$sql="select * from kodenegara order by KODE_NEGARA asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_jenis_kerja(){
		$rows = array(); //will hold all results
		$sql="select * from jenis_pekerjaan order by Pekerjaan_id asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_group1(){
		$rows = array(); //will hold all results
		$sql="select * from kodegroup1_nasabah order by NASABAH_GROUP1 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_sid_bidang_usaha(){
		$rows = array(); //will hold all results
		$sql="select * from sidkodebidangusaha order by KODE_BIDANG_USAHA asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_sid_gol_debitur(){
		$rows = array(); //will hold all results
		$sql="select * from sidkodegoldebitur order by KODE_GOL_DEBITUR asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_sid_hub_bank(){
		$rows = array(); //will hold all results
		$sql="select * from sidkodehubungandebitur order by KODE_HUBUNGAN asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_kode_group4(){
		$rows = array(); //will hold all results
		$sql="select * from kodegroup4_nasabah order by NASABAH_GROUP4 asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	function insert_nasabah($data){
	   $query=$this->db->insert('nasabah',$data);
	}
	function get_counter_nasabah_id_length(){
		$this->db->select('Value');
		$this->db->from('mysysid');
		$this->db->where('KeyName','NASABAH_ID_COUNTER_LENGTH');
		return $this->db->get ();
	}
	function get_nasabah_id_max(){
		$sql="select max(nasabah_id) as nasabah_id_max from nasabah";
		$query=$this->db->query($sql);
		return $query->result ();
	}
	public function get_nasabah_id_masuk( $nama,$tgl_lahir,$no_id) {// 
		/*
		$this->db->select ( 'nasabah_id' );
		$this->db->from('nasabah');
		$this->db->where ( 'nama_nasabah', $nama );
		$this->db->where ( 'tgllahir', $tgl_lahir );
		$this->db->where ( 'no_id', $no_id );

		$query = $this->db->get ();
		*/
		$sql="select nasabah_id from nasabah where nama_nasabah='$nama' and tgllahir='$tgl_lahir' and no_id='$no_id'";
		//$sql="select nasabah_id from nasabah where nama_nasabah='$nama'";
		$query=$this->db->query($sql);
		return $query->result ();
	}
	
}

/* End of file master_nasabahmodel.php */
/* Location: ./application/models/master_nasabahmodel.php */