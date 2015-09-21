<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_inventorymodel extends CI_Model{
	
	function insert_inventory($data){
	   $query=$this->db->insert('susut',$data);
	}
	function insert_inventory_susut($data){
	   $query=$this->db->insert('susutrans',$data);
	}
	function get_cabang(){
		$query = $this->db->get('kodecabang');
		return $query->result();
	}
	function get_group1(){
		$query = $this->db->get('kodegroup1inventaris');
		return $query->result();
	}
	function get_group2(){
		$query = $this->db->get('kodegroup2inventaris');
		return $query->result();
	}
	function get_perkiraan(){
		$this->db->select('kode_perk,nama_perk');
		$query = $this->db->get('perkiraan');
		return $query->result();
	}
	function get_inventaris(){
		$sql="SELECT a.*,b.kode_cab, b.nama_cab FROM `susut` a inner join kodecabang b where a.cab = b.kode_cab";
        $query=$this->db->query($sql);
        return $query->result();	
	}
	function get_desc_inventaris($id){
		$sql="SELECT * FROM susut where NO_REF='".$id."'";
        $query=$this->db->query($sql);
        return $query->result();	
	}
	function get_trans_inventaris($id){
		$sql="SELECT * FROM susutrans where NO_REF='".$id."'";
        $query=$this->db->query($sql);
        return $query->result();	
	}
	function insert_susut($data){
	   $query=$this->db->insert('susut',$data);
	   return true;
	}
	function insert_susutrans($data){
	   $query=$this->db->insert('susutrans',$data);
	}
	function hapus_susutrans($data){
	   $query=$this->db->delete('susutrans', array('NO_REF' => $data));
	}
	function hapus_susut($data){
	   $query=$this->db->delete('susut', array('NO_REF' => $data));
	}
	function get_trans_inventaris_by_id($data){
		$this->db->select ( 'NO_REF' );
		$this->db->from('susut');
		$this->db->where ( 'NO_REF', $data );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return true;
		}else{
			return false;
		}
	}
	function get_inventaris_realisasi(){
		$sql="SELECT a.*,b.kode_cab, b.nama_cab,c.TRANS_ID,c.KODE_TRANS FROM `susut` a 
				inner join kodecabang b on a.cab = b.kode_cab
				inner join susutrans c on a.NO_REF = c.NO_REF
				where c.KODE_TRANS = '' GROUP BY a.NO_REF";
        $query=$this->db->query($sql);
        return $query->result();	
	}
	
	function get_susutrans_by_id($id,$data,$kwitansi){
		$this->db->select ( 'NO_REF' );
		$this->db->from('susutrans');
		$this->db->where ( 'NO_REF', $id );
		$this->db->where ( 'KODE_TRANS', $data);
		$this->db->where ( 'KUITANSI', $kwitansi);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return true;
		}else{
			return false;
		}
	}
	function get_all_susutrans(){
		$sql="SELECT a.*,b.kode_cab, b.nama_cab FROM `susutrans` a inner join kodecabang b where a.CAB = b.kode_cab and a.MY_KODE_TRANS = 200";
        $query=$this->db->query($sql);
        return $query->result();	
	}
	function get_desc_susut($id){
		$sql="SELECT a.*,b.NO_REF,b.DESKRIPSI_REF,c.kode_cab,c.nama_cab FROM susutrans a inner join susut b on a.NO_REF = b.NO_REF inner join kodecabang c on a.CAB = c.kode_cab where a.TRANS_ID='".$id."'";
        $query=$this->db->query($sql);
        return $query->result();
	}
	function get_susutrans_by_transid($id){
		$sql="SELECT * FROM susutrans WHERE TRANS_ID='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function cek_susutrans_by_id($id){
		$this->db->select ( 'NO_REF' );
		$this->db->from('susutrans');
		$this->db->where ( 'NO_REF', $id );
		$this->db->where ( 'MY_KODE_TRANS', 300);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file master_nasabahmodel.php */
/* Location: ./application/models/master_nasabahmodel.php */