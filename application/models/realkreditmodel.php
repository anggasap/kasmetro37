<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Realkreditmodel extends CI_Model {
	
	function get_kode_setor_kredit_real(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranskredit k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','KRE');
		$this->db->WHERE('w.type_trans','t_real');
		return $this->db->get();
	}
	public function get_deskripsi_rek_kre($kode) {
		$this->db->select ( 'T.JML_PINJAMAN,T.JML_BUNGA_PINJAMAN,T.JML_ANGSURAN,T.BI_JANGKA_WAKTU,T.JENIS_PINJAMAN,T.TYPE_PINJAMAN,
		T.TGL_REALISASI,T.TGL_JATUH_TEMPO,T.PROVISI,T.ADM,T.MATERAI,T.POKOK_MATERAI,T.PREMI,T.NOTARIEL,T.LAIN_LAIN,T.biaya_transaksi,T.STATUS_AKTIF,T.SUKU_BUNGA_PER_ANGSURAN,
		K.DESKRIPSI_JENIS_KREDIT,Y.DESKRIPSI_TYPE_KREDIT,
		T.POKOK_SALDO_AKHIR,T.BUNGA_SALDO_AKHIR,N.nasabah_id,T.TYPE_ABP,
		N.NAMA_NASABAH' );
		$this->db->from('KREDIT T');
		$this->db->join('NASABAH N', 'T.NASABAH_ID=N.NASABAH_ID', 'LEFT');
		$this->db->join('kodejeniskredit K', 'T.JENIS_PINJAMAN=K.KODE_JENIS_KREDIT', 'LEFT');
		$this->db->join('kodetypekredit Y', 'T.TYPE_PINJAMAN=Y.KODE_TYPE_KREDIT', 'LEFT');
		$this->db->where ( 'T.NO_REKENING', $kode );
		$query = $this->db->get ();
		return $query->result ();
	}
	public function get_kretrans_id($tgl_trans,$no_rek,$pokok_trans,$kuitansi){
		$sql="select KRETRANS_ID from kretrans where TGL_TRANS='$tgl_trans' and NO_REKENING='$no_rek' and POKOK_TRANS='$pokok_trans' and kuitansi='$kuitansi'";
		$query=$this->db->query($sql);
		return $query->result ();
	}
	
		
}

/* End of file kreditmodel.php */
/* Location: ./application/models/kreditmodel.php */