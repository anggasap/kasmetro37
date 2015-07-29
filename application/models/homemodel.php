<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Homemodel extends CI_Model
{
   public function get_nama_kantor()
   {
      	$this->db->select ( 'KeyName,Value' );
		$this->db->from('mysysid');
		$this->db->where ( 'keyname', 'NAMA_LEMBAGA1' );
		$this->db->or_where('keyname', 'NAMA_LEMBAGA2'); 
		$query = $this->db->get ();
		return $query;
   }
   // angga
   public function get_tanggal_hari_ini()
   {
      	$this->db->select ( 'KeyName,Value' );
		$this->db->from('mysysid');
		$this->db->where ( 'keyname', 'TANGGALHARIINI' );
		$query = $this->db->get ();
		return $query;
   }
   public function get_daftar_kantor()
   {
      	$rows = array(); //will hold all results
		$sql="select * from web_cabang order by kode_cab asc ";
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
   // end angga
}

/* End of file homeModel.php */
/* Location: ./application/models/homemodel.php */