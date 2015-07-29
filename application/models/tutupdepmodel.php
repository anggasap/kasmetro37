<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Tutupdepmodel extends CI_Model {
	function get_kode_dep_def(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetransdeposito k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','DEP');
		$this->db->WHERE('w.type_trans','t_tutup');
		return $this->db->get();
	}
	public function get_deskripsi_rek($kode) {
		$this->db->select ( 'D.NO_ALTERNATIF,D.TGL_REGISTRASI,D.JKW,D.TGL_JT,D.SUKU_BUNGA,D.PERSEN_PPH,D.JML_DEPOSITO,N.NAMA_NASABAH,N.ALAMAT' );
		$this->db->from('deposito D');
		$this->db->join('nasabah N', 'D.NASABAH_ID=N.NASABAH_ID', 'LEFT');
		$this->db->where ( 'D.NO_REKENING', $kode );
		$this->db->where ( 'D.STATUS_AKTIF', 2 );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	
	function update_tutup_dep($norek,$data){
		$sql="update deposito set STATUS_AKTIF='3', SALDO_PENARIKAN ='$data',SALDO_AKHIR='0.00' where NO_REKENING='$norek' ";
		$this->db->query($sql);
	}
	
		
}

/* End of file pindahbukumodel.php */
/* Location: ./application/models/pindahbukumodel.php */