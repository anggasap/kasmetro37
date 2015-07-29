<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Tutup_tabmodel extends CI_Model {
	
	
	function get_kode_adm_tab_def(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','adm');
		return $this->db->get();
	}
	function get_kode_tutup_tab_def(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','t_tarik');
		return $this->db->get();
	}
	function update_tutup_tabung($data,$norek){
		$sql="update tabung set SALDO_PENARIKAN=SALDO_PENARIKAN+'$data', SALDO_AKHIR=SALDO_AKHIR-'$data', STATUS_AKTIF='3' where NO_REKENING='$norek' ";
		$this->db->query($sql);
	}
	
		
}

/* End of file kreditmodel.php */
/* Location: ./application/models/kreditmodel.php */