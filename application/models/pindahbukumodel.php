<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Pindahbukumodel extends CI_Model {
/*	
	function get_kode_debet_rek(){
		$this->db->select('kode_trans,GL_TRANS');
		$this->db->from('kodetranstabungan');
		$this->db->WHERE('TYPE_TRANS','D');
		$this->db->WHERE('TOB','O');
		return $this->db->get();
	}
	
	function get_kode_tab_tujuan(){
		$this->db->select('kode_trans,GL_TRANS');
		$this->db->from('kodetranstabungan');
		$this->db->WHERE('TYPE_TRANS','K');
		$this->db->WHERE('TOB','O');
		return $this->db->get();
	}
*/
	/*Fungsi get kode transaksi default untuk transaksi SETOR TABUNGAN*/	
	function get_kode_debet_source(){
		$rows = array();
		$sql="select w.kode_trans,k.TYPE_TRANS,k.GL_TRANS,k.DESKRIPSI_TRANS,k.TOB from kodetranstabungan k left join web_kode_trans_default w on k.KODE_TRANS=w.kode_trans  where w.modul='TAB' and w.type_trans='ob_setor' ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	    return $rows; // returning rows, not row
		
	}
	function get_kode_kredit_tujuan(){
		$rows = array();
		$sql="select w.kode_trans,k.TYPE_TRANS,k.GL_TRANS,k.DESKRIPSI_TRANS,k.TOB from kodetranstabungan k left join web_kode_trans_default w on k.KODE_TRANS=w.kode_trans  where w.modul='TAB' and w.type_trans='ob_tarik' ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	    return $rows; // returning rows, not row
		
	}
/* End Fungsi get kode transaksi default untuk transaksi SETOR TABUNGAN*/	
	function get_kode_kre_tujuan_def(){
		$this->db->select('w.kode_trans,k.TYPE_TRANS,k.GL_TRANS ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','ob_tarik');
		return $this->db->get();
	}
	function get_kode_debet_source_def(){
		
		$this->db->select('w.kode_trans,k.TYPE_TRANS,k.GL_TRANS ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','ob_setor');
		return $this->db->get();
		
	}
		
}

/* End of file pindahbukumodel.php */
/* Location: ./application/models/pindahbukumodel.php */