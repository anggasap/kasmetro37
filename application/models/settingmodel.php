<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Settingmodel extends CI_Model {
	
	function tampil_norek_kredit() {
		$this->db->select ( 'Value' );
		$this->db->from ( 'mysysid' );
		$this->db->where ( "KeyName", "TEL_MENAMPILKAN_NOREK_KREDIT" );
		return $this->db->get ();
	}
	
	function tampil_nasabah_pasif() {
		$this->db->select ( 'Value' );
		$this->db->from ( 'mysysid' );
		$this->db->where ( "KeyName", "TEL_MENAMPILKAN_NASABAH_PASIF" );
		return $this->db->get ();
	}
	
	function update_tampil_norek($data)
	{
		$this->db->where('KeyName', 'TEL_MENAMPILKAN_NOREK_KREDIT');
		$this->db->update('mysysid', $data);
	}
	
	function update_tampil_pasif($data)
	{
		$this->db->where('KeyName', 'TEL_MENAMPILKAN_NASABAH_PASIF');
		$this->db->update('mysysid', $data);
	}
}

/* End of file settingmodel.php */
/* Location: ./application/models/settingmodel.php */