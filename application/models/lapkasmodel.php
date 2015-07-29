<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Lapkasmodel extends CI_Model {
	
/*====================LAPORAN KAS USER====================*/	
	public function get_data_kas_user_grid($tgl,$user_id) {
		$this->db->select ( 'modul,NO_BUKTI,uraian,my_kode_trans,saldo_trans,tob' );
		$this->db->from ( 'tellertrans' );
		$this->db->order_by ( "TRANS_ID", "asc" );
		$this->db->where ( "tgl_trans", $tgl );
		$this->db->where ( "userid", $user_id );
		return $this->db->get ();
	}
	public function get_data_kas_user_pdf($tgl,$user_id) {
		$sql="select modul,NO_BUKTI,uraian,my_kode_trans,saldo_trans,tob from tellertrans where tgl_trans='$tgl' and userid='$user_id' order by TRANS_ID asc";
		$query = $this->db->query($sql);
		return $query->result ();
	}
/*====================END LAPORAN KAS USER====================*/
	public function get_data_kas_kantor_grid($tgl,$outlet) {
		$this->db->select ( 't.modul,t.NO_BUKTI,t.uraian,t.my_kode_trans,t.saldo_trans,t.tob' );
		$this->db->from ( 'passwd p' );
		$this->db->join('tellertrans t', 'p.USERID=t.userid', 'left');
		$this->db->order_by ( "t.TRANS_ID", "asc" );
		$this->db->where ( "t.tgl_trans", $tgl );
		$this->db->where ( "p.OUTLET", $outlet );
		return $this->db->get ();
	}
	public function get_data_kas_kantor_pdf($tgl,$outlet) {
		$sql="select t.modul,t.NO_BUKTI,t.uraian,t.my_kode_trans,t.saldo_trans,t.tob from passwd p left join tellertrans t on p.USERID=t.userid where t.tgl_trans='$tgl' and p.OUTLET='$outlet' order by TRANS_ID asc";
		$query = $this->db->query($sql);
		return $query->result ();
	}
}

/* End of file kasmodel.php */
/* Location: ./application/models/kasmodel.php */