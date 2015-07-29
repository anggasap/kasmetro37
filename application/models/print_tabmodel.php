<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Print_tabmodel extends CI_Model {
	
	public function get_saldo_sebelum($no_rek,$tgl_mulai) {
		//$sql="select count(NO_REKENING) as jumlah from kretrans where NO_REKENING='".$kode."' and (MY_KODE_TRANS='300' or MY_KODE_TRANS='100') and TGL_TRANS='".$tglsys."'";
		$sql = "SELECT (SELECT saldo_awal FROM tabung WHERE no_rekening = '".$no_rek."')+(SELECT SUM(saldo_trans) FROM tabtrans WHERE no_rekening = '".$no_rek."' AND tgl_trans < '".$tgl_mulai."' AND FLOOR(my_kode_trans/100)=1)-
(SELECT SUM(saldo_trans) FROM tabtrans WHERE no_rekening = '".$no_rek."' AND tgl_trans < '".$tgl_mulai."' AND FLOOR(my_kode_trans/100)=2) AS saldo_sebelum";
		$query = $this->db->query($sql);
		return $query;
	}
	public function get_tab_trans($no_rek,$tgl_mulai,$tgl_akhir) {
		$this->db->select ( 'FLOOR(my_kode_trans/100) as my_kode,TGL_TRANS,KODE_TRANS,SALDO_TRANS,USERID' );
		$this->db->from ( 'tabtrans' );
		$this->db->where ( 'no_rekening', $no_rek);
//		$this->db->where_between('tgl_trans', $tgl_mulai, $tgl_akhir); 
		$this->db->where("tgl_trans BETWEEN '$tgl_mulai' AND '$tgl_akhir'");
		return $this->db->get ();
	}
	

}

/* End of file master_nasabahmodel.php */
/* Location: ./application/models/master_nasabahmodel.php */