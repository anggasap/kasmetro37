<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Tellertabmodel extends CI_Model {
	/*
	public function get_kodetrans() {
		$this->db->select ( 'kode_trans' );
		$this->db->from ( 'kodetranstabungan' );
		$this->db->like('DESKRIPSI_TRANS','setor');
		return $this->db->get ();
	}
	*/
    public function getRekTab()
    {
        $sql="SELECT t.NO_REKENING,n.nama_nasabah,n.alamat,t.SALDO_AKHIR from tabung t left join nasabah n on  t.nasabah_id=n.nasabah_id where status_aktif='2'";
        $query=$this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

	public function get_all_kodetrans_setor() {
		$rows = array(); //will hold all results
		$sql="select * from kodetranstabungan where TYPE_TRANS= 'K' and (DESKRIPSI_TRANS like '%etor%' or DESKRIPSI_TRANS like '%ABA%') order by KODE_TRANS asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_all_kodetrans_tarik() {
		$rows = array(); //will hold all results
		$sql="select * from kodetranstabungan where TYPE_TRANS= 'D' and DESKRIPSI_TRANS like '%arik%' order by KODE_TRANS asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_all_kodetrans_tab_tarik_ob() {
		$rows = array(); //will hold all results
		$sql="select * from kodetranstabungan where TYPE_TRANS= 'D' and TOB='O' and DESKRIPSI_TRANS like '%buku%' order by KODE_TRANS asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	/*Fungsi get kode transaksi default untuk transaksi SETOR TABUNGAN*/	
	function get_kode_setor(){
		$this->db->select('w.kode_trans,k.TYPE_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','t_setor');
		return $this->db->get();
	}
/* End Fungsi get kode transaksi default untuk transaksi SETOR TABUNGAN*/	
	function get_kode_tarik(){
		$this->db->select('w.kode_trans,k.TYPE_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','t_tarik');
		return $this->db->get();
	}
	function get_kode_tarik_ob(){
		$this->db->select('w.kode_trans,k.TYPE_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranstabungan k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','TAB');
		$this->db->WHERE('w.type_trans','ob_tarik');
		return $this->db->get();
	}
	public function get_deskripsi_trans($kode) {
		$this->db->select ( 't.deskripsi_trans,t.type_trans,t.gl_trans,t.tob' );
		$this->db->from('kodetranstabungan t');
		$this->db->where ( 't.kode_trans', $kode );
		$query = $this->db->get ();
		return $query->result ();
	}
/*
Load nama nasabah, no rekening tabungan untuk modal	*/
	/*public function get_rekening(){
	    $this->db->select ( 't.NO_REKENING,n.nama_nasabah,t.SALDO_AKHIR,n.nasabah_id' );
		$this->db->from ( 'tabung t' );
		$this->db->join('nasabah n', 't.nasabah_id=n.nasabah_id', 'left');
		$this->db->where ( 't.status_aktif', '2');
		return $this->db->get ();
	}*/

	public function get_deskripsi_rek($kode) {
		$this->db->select ( 'T.SALDO_AKHIR,K.DESKRIPSI_JENIS_TABUNGAN,N.NAMA_NASABAH,N.ALAMAT,T.SALDO_BLOKIR,K.MINIMUM_DEFAULT,N.nasabah_id,T.TGL_TRANS_TERAKHIR,T.SALDO_SETORAN,T.SALDO_PENARIKAN,T.SETORAN_MINIMUM,T.ADM_BLN_INI' );
		$this->db->from('TABUNG T');
		$this->db->join('KODEJENISTABUNGAN K', 'T.JENIS_TABUNGAN=K.KODE_JENIS_TABUNGAN', 'LEFT');
		$this->db->join('NASABAH N', 'T.NASABAH_ID=N.NASABAH_ID', 'LEFT');
		$this->db->where ( 'T.NO_REKENING', $kode );
		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	
	public function seting_nasabah_tampil(){
		$this->db->select('Value');
		$this->db->from('mysysid');
		$this->db->where('KeyName','TEL_MENAMPILKAN_NASABAH_PASIF');
		return $this->db->get ();
	}
	
	public function seting_norek_kredit(){
		$this->db->select('Value');
		$this->db->from('mysysid');
		$this->db->where('KeyName','TEL_MENAMPILKAN_NOREK_KREDIT');
		return $this->db->get ();
	}
	
	public function get_kredit_aktif($nas_id){
		$this->db->select('K.NO_REKENING,KJ.DESKRIPSI_JENIS_KREDIT,K.JML_PINJAMAN');
		$this->db->from('KREDIT K');
		$this->db->join('KODEJENISKREDIT KJ', 'KJ.KODE_JENIS_KREDIT=K.JENIS_PINJAMAN', 'LEFT');
		$this->db->where ( 'K.NASABAH_ID', $nas_id );
		$this->db->where('K.STATUS_AKTIF','2');
		$query = $this->db->get ();
		return $query->result ();
	}
	
	public function get_tabtrans_id($tgl_trans,$no_rek,$jml_trans,$kuitansi){
		$sql="select TABTRANS_ID from tabtrans where TGL_TRANS='$tgl_trans' and NO_REKENING='$no_rek' and SALDO_TRANS='$jml_trans' and kuitansi='$kuitansi'";
		$query=$this->db->query($sql);
		return $query->result ();
	}
	
	public function get_seting_tab_pasif(){
		$this->db->select('Value');
		$this->db->from('mysysid');
		$this->db->where('KeyName','TAB_PASIF');
		return $this->db->get ();
	}
	
	function get_counter(){
		$this->db->select('CounterNo,StructuredNo');
		$this->db->from('controlno');
		$this->db->like('modul','TAB');
		return $this->db->get();
	}
	
	function insert_tabtrans($data){
	   $query=$this->db->insert('tabtrans',$data);
	}
	
	function update_setor_tabung($data,$norek){
		/*
		$this->db->where('NO_REKENING', $norek);
		$this->db->update('tabung', $data);
		*/
		$sql="update tabung set SALDO_SETORAN=SALDO_SETORAN+'$data', SALDO_AKHIR=SALDO_AKHIR+'$data' where NO_REKENING='$norek' ";
		$this->db->query($sql);
	}
	function update_tarik_tabung($data,$norek){
		$sql="update tabung set SALDO_PENARIKAN=SALDO_PENARIKAN+'$data', SALDO_AKHIR=SALDO_AKHIR-'$data' where NO_REKENING='$norek' ";
		$this->db->query($sql);
	}
	
	function add_counter($data){
		$this->db->where('modul', 'TAB');
		$this->db->update('controlno', $data);
	}
	
	function get_transid(){
		$this->db->select_max('tabtrans_id');
		$this->db->from('tabtrans');
		return $this->db->get();
	}


		
}

/* End of file tellertabmodel.php */
/* Location: ./application/models/tellertabmodel.php */