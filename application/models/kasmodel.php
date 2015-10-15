<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Kasmodel extends CI_Model {
	
	function get_kodetrans() {
		$this->db->select ( 'kode_trans' );
		$this->db->from ( 'teller_kodetrans' );
		$this->db->order_by ( "kode_trans", "desc" );
		return $this->db->get ();
	}
	
	public function get_deskripsi_trans($kode) {
		$this->db->select ( 't.deskripsi_trans,t.type_trans,t.gl_trans,p.nama_perk' );
		$this->db->from('teller_kodetrans t');
		$this->db->join('perkiraan p', 't.gl_trans=p.kode_perk', 'left');
		$this->db->where ( 't.kode_trans', $kode );
		// sama dengan SELECT t.deskripsi_trans,t.type_trans,t.gl_trans,p.nama_perk FROM teller_kodetrans t left join perkiraan p
		// WHERE t.kode_trans=$kode
		$query = $this->db->get ();
		return $query->result ();
	}
	
	function get_perkiraan(){
	  $this->db->order_by('kode_perk','asc');
	   return $this->db->get('perkiraan');
	}
	
	function insert_teller($data){
	   $this->db->insert('tellertrans',$data);
	}
	
	function get_counter(){
		$this->db->select('CounterNo,StructuredNo');
		$this->db->from('controlno');
		$this->db->like('modul','PC');
		return $this->db->get();
	}
	
	function add_counter($data){
		$this->db->where('modul', 'PC');
		$this->db->update('controlno', $data);
	}
	public function getPerkAll()
	{
		$sql="SELECT kode_perk, kode_alt, nama_perk, type from perkiraan";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
}

/* End of file kasmodel.php */
/* Location: ./application/models/kasmodel.php */