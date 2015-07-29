<?php
if(! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Aksesusermodel extends CI_Model
{
	function get_usergroup()
	{
		$this->db->select('GROUPNAME');
		$this->db->from('groupdef');
		return $this->db->get();
	}
	
	function get_passwd()
	{
		$this->db->select('USERID,USERNAME,USERGROUP,LIMIT_TARIK,LIMIT_KASUMUM,LIMIT_SETOR');
		$this->db->from('passwd');
		return $this->db->get();
	}
	
	function insert_passwd($data){
	   $this->db->insert('passwd',$data);
	}
	
	function get_level_user(){
		$this->db->select('level_id,level_nama');
		$this->db->from('level');
		return $this->db->get();
	}
	
	public function get_level_id($kode) {
		$this->db->select ( 'level_id' );
		$this->db->from('level');
		$this->db->where ( 'level_nama', $kode );
		$query = $this->db->get ();
		return $query->result ();
	}

}

/* End of file aksesusermodel.php */
/* Location: ./application/models/aksesusermodel.php */