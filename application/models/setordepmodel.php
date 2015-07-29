<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Setordepmodel extends CI_Model {
	function get_counter(){
		$this->db->select('CounterNo,StructuredNo');
		$this->db->from('controlno');
		$this->db->like('modul','DEP');
		return $this->db->get();
	}
	function get_kode_dep_def(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetransdeposito k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','DEP');
		$this->db->WHERE('w.type_trans','t_setor');
		return $this->db->get();
	}
	public function get_deskripsi_rek($kode) {
		$this->db->select ( 'D.NO_ALTERNATIF,D.TGL_REGISTRASI,D.JKW,D.TGL_JT,D.SUKU_BUNGA,D.PERSEN_PPH,D.JML_DEPOSITO,N.NAMA_NASABAH,N.ALAMAT' );
		$this->db->from('deposito D');
		$this->db->join('nasabah N', 'D.NASABAH_ID=N.NASABAH_ID', 'LEFT');
		$this->db->where ( 'D.NO_REKENING', $kode );
		$this->db->where ( 'D.STATUS_AKTIF', 1 );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function get_deptrans_id($tgl_trans,$no_rek,$jml_trans,$kuitansi){
		$sql="select DEPTRANS_ID from deptrans where TGL_TRANS='$tgl_trans' and NO_REKENING='$no_rek' and SALDO_TRANS='$jml_trans' and kuitansi='$kuitansi'";
		$query=$this->db->query($sql);
		return $query->result ();
	}
	function insert_deptrans($data){
	   $query=$this->db->insert('deptrans',$data);
	}
	function update_setor_dep($norek){
		$sql="update deposito set STATUS_AKTIF='2' where NO_REKENING='$norek' ";
		$this->db->query($sql);
	}
	
	function add_counter($data){
		$this->db->where('modul', 'DEP');
		$this->db->update('controlno', $data);
	}
		
}

/* End of file pindahbukumodel.php */
/* Location: ./application/models/pindahbukumodel.php */