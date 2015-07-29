<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_multileveldata extends CI_Model
{
	 public function get_data($induk=0)
	{
		$data = array();
		$this->db->from('menu');
		$this->db->where('parent',$induk);
		//$this->db->like('menu_allowed','+'.$user_level.'+');
		$result = $this->db->get();
	
		foreach($result->result() as $row)
		{
			$data[] = array(
					'id'	=>$row->menu_id,
					'nama'	=>$row->menu_nama,
					'link'	=>$row->menu_uri,
					// recursive
					'child'	=>$this->get_data($row->menu_id)
				);
		}
		return $data;
	}
	public function get_child($id)
	{
		$data = array();
		$this->db->from('menu');
		$this->db->where('parent',$id);
		$result = $this->db->get();
		foreach($result->result() as $row)
		{
			$data[$row->menu_id] = $row->menu_nama;
		}
		return $data;
	}
}