<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Usermodel extends CI_Model
{
   public function get_menu_for_level($user_level)
   {
      $this->db->from('menu');
      $this->db->like('menu_allowed','+'.$user_level.'+');
      $result = $this->db->get();
      return $result;
   }
   
   //memanggil menu dari database
	function get_password($username){
		$data = array();
		$this->db->select('PASSWORD');
		$this->db->from('passwd');
		$this->db->where('USERNAME',$username);
		$query = $this->db->get();
		return $query->result ();
		
	}
	function get_array_menu($id)
	{
		$this->db->select('menu_allowed');
		$this->db->from('menu');
		$this->db->where('menu_id',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0){
			$row   = $data->row();
			$level = $row->menu_allowed;
			$arr   = explode('+',$level);
			return $arr;
		}
		else
		{
			die();
		}
	}
   
   public function get_data($induk=0,$user_level)
	{
		$data = array();
		$this->db->from('menu');
		$this->db->where('parent',$induk);
		$this->db->like('menu_allowed','+'.$user_level.'+');
		$this->db->order_by ( "menu_id", "asc" );
		$result = $this->db->get();
		
		foreach($result->result() as $row)
		{
			$data[] = array(
					'id'	=>$row->menu_id,
					'nama'	=>$row->menu_nama,
					'link'	=>$row->menu_uri,
					// recursive
					'child'	=>$this->get_data($row->menu_id,$user_level)
				);
		}
		return $data;
	}
	/*public function get_child($id)
	{
		$data = array();
		$this->db->from('menu');
		$this->db->where('parent',$id);
		//$this->db->like('menu_allowed','+'.$user_level.'+');
		$result = $this->db->get();
		foreach($result->result() as $row)
		{
			$data[$row->menu_id] = $row->menu_nama;
		}
		return $data;
	}*/
   
   //operasi user
   function get_all_user()
	{
	   $this->db->from('passwd');
	   $this->db->join('level','level_id=STATUS_USER','left');
	   return $this->db->get();
	}
	
	public function get_menu_all($induk=0)
	{
		$data = array();
		$this->db->from('menu');
		$this->db->where('parent',$induk);
		$this->db->order_by ( "menu_id", "asc" );
		$result = $this->db->get();
		
		foreach($result->result() as $row)
		{
			$data[] = array(
					'id'	=>$row->menu_id,
					'nama'	=>$row->menu_nama,
					'child'	=>$this->get_menu_all($row->menu_id)
				);
		}
		return $data;
	}
	
	

}