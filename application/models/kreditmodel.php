<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Kreditmodel extends CI_Model {
	
	public function get_kodetrans_kre() {
		$data = array();
		$this->db->select('deskripsi_trans');
		$this->db->from('kodetranskredit');
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data['deskripsi_trans'] = $row['deskripsi_trans'];
			}
		}
		return $data;		
	}
	public function get_all_kodetrans_kre_setor() {
		$rows = array(); //will hold all results
		$sql="select * from kodetranskredit where (DESKRIPSI_TRANS like '%setor%' or DESKRIPSI_TRANS like '%ABA%') order by KODE_TRANS asc ";
		$query=$this->db->query($sql);
		foreach($query->result_array() as $row){    
			$rows[] = $row; //add the fetched result to the result array;
		}
	   return $rows; // returning rows, not row
	}
	public function get_deskripsi_trans_kre($kode) {
		$this->db->select ( 't.deskripsi_trans,t.gl_trans,t.tob' );
		$this->db->from('kodetranskredit t');
		$this->db->where ( 't.kode_trans', $kode );
		$query = $this->db->get ();
		return $query->result ();
	}
	
	public function get_rekening_kredit()
	{
	    $this->db->select ( 't.NO_REKENING,n.nama_nasabah' );
		$this->db->from ( 'kredit t' );
		$this->db->join('nasabah n', 't.nasabah_id=n.nasabah_id', 'left');
		$this->db->where ( 't.status_aktif', '2');
		return $this->db->get ();
	}
	
	public function get_deskripsi_rek_kre($kode) {
		$this->db->select ( 'T.JENIS_PINJAMAN,T.JML_PINJAMAN,N.NAMA_NASABAH,T.POKOK_SALDO_AKHIR,T.BUNGA_SALDO_AKHIR,N.nasabah_id,T.TYPE_ABP,T.POKOK_SALDO_SETORAN,T.BUNGA_SALDO_SETORAN' );
		$this->db->from('KREDIT T');
		$this->db->join('NASABAH N', 'T.NASABAH_ID=N.NASABAH_ID', 'LEFT');
		$this->db->where ( 'T.NO_REKENING', $kode );
		$query = $this->db->get ();
		return $query->result ();
	}
    public function getRekKreAll() {
        $this->db->select ( 'T.JENIS_PINJAMAN,T.NO_REKENING,T.JML_PINJAMAN,N.NAMA_NASABAH,N.alamat,T.POKOK_SALDO_AKHIR,T.BUNGA_SALDO_AKHIR,N.nasabah_id,T.TYPE_ABP,T.POKOK_SALDO_SETORAN,T.BUNGA_SALDO_SETORAN' );
        $this->db->from('KREDIT T');
        $this->db->join('NASABAH N', 'T.NASABAH_ID=N.NASABAH_ID', 'LEFT');
        $this->db->where ( 'T.STATUS_AKTIF', 2 );
        $query = $this->db->get ();
        return $query->result ();
    }
//==========================ANGSURAN YANG MINUS===========================		
	public function get_nilai_tagihan_pokok($kode,$bln,$thn,$tglsys) {
		$sql="SELECT kredit.type_pinjaman,kredit.denda_per_angsuran,kredit.tgl_realisasi,kredit.satuan_waktu_angsuran,  
		         kredit.pokok_tunggakan_awal +   
	             sum(if(floor(my_kode_trans/100)=2,pokok_trans,0)) as JPokok,   
		         kredit.bunga_tunggakan_awal - kredit.bunga_disc_awal +   
		         sum(if(floor(my_kode_trans/100)=2,bunga_trans,0)) as JBunga, 
		         kredit.denda_tunggakan_awal - kredit.denda_disc_awal +   
		         sum(if(floor(my_kode_trans/100)=2,denda_trans,0)) as JDenda,   
		         kredit.admin_tunggakan_awal - kredit.admin_disc_awal +   
		         sum(if(floor(my_kode_trans/100)=2,admin_trans,0)) as JAdmin,   
		         sum(if(floor(my_kode_trans/100)=8,adminlain_trans,0)) as LAdmin   
		         from kredit left join kretrans on kredit.no_rekening=kretrans.no_rekening   
		         AND kretrans.tgl_trans<='".$tglsys."'   
		         WHERE kredit.no_rekening='".$kode."' group by kretrans.no_rekening";
		$query = $this->db->query($sql);
		return $query->result ();	
	}
	public function cek_transaksi_hari_ini($kode,$tglsys) {
		$sql="select count(NO_REKENING) as jumlah from kretrans where NO_REKENING='".$kode."' and (MY_KODE_TRANS='300' or MY_KODE_TRANS='100') and TGL_TRANS='".$tglsys."'";
		$query = $this->db->query($sql);
		return $query->result ();
	}
	public function get_nilai_sudah_bayar($kode,$bln,$thn) {
		$sql="SELECT kredit.type_pinjaman,kredit.denda_per_angsuran,kredit.tgl_realisasi,kredit.satuan_waktu_angsuran, sum(if(floor(my_kode_trans/100)=3 and my_kode_trans <> 395,pokok_trans,0)) + sum(if(floor(my_kode_trans/100)=3 and my_kode_trans <> 395,Disc_Pokok,0)) as BPokok, sum(if(floor(my_kode_trans/100)=3 and my_kode_trans <> 395,bunga_trans,0))+ sum(if(floor(my_kode_trans/100)=3,Disc_Bunga,0)) as BBunga, sum(if(floor(my_kode_trans/100)=3,denda_trans,0))+ sum(if(floor(my_kode_trans/100)=3,disc_denda,0)) as BDenda, sum(if(floor(my_kode_trans/100)=3,admin_trans,0))+sum(if(floor(my_kode_trans/100)=3,disc_admin,0)) as BAdmin,sum(if(floor(my_kode_trans/100)=3,adminlain_trans,0)) as PAdmin from kredit left join kretrans on kredit.no_rekening=kretrans.no_rekening WHERE kredit.no_rekening='".$kode."' group by kretrans.no_rekening ";
		$query = $this->db->query($sql);
		return $query->result ();	
	}
//========================== END ANGSURAN YANG MINUS===========================		
	public function get_pelunasan($kode) {
		$sql="SELECT SUM(jdwl.pokok_jadwal - jdwl.pokok_angsur) AS pokok_angsur,SUM(jdwl.bunga_jadwal - jdwl.bunga_angsur) AS bunga_angsur FROM
(
SELECT SUM(pokok_trans) AS pokok_angsur,SUM(BUNGA_TRANS) AS bunga_angsur,0 AS pokok_jadwal,0 AS bunga_jadwal FROM kretrans 
WHERE no_rekening='".$kode."' AND my_kode_trans=300 
AND tgl_trans<=(SELECT tgl_trans FROM kretrans WHERE no_rekening='".$kode."' AND CICILAN_KE=(SELECT MAX(CICILAN_KE) FROM kretrans WHERE no_rekening='".$kode."'))
UNION
SELECT 0 AS pokok_angsur,0 AS bunga_angsur,SUM(pokok_trans) AS pokok_jadwal,SUM(BUNGA_TRANS) AS bunga_jadwal FROM kretrans 
WHERE no_rekening='".$kode."' AND my_kode_trans=200
)AS jdwl";
		$query = $this->db->query($sql);
		return $query->result ();
	}
	
	function get_counter(){
		$this->db->select('CounterNo,StructuredNo');
		$this->db->from('controlno');
		$this->db->like('modul','KRE');
		return $this->db->get();
	}
	
	function insert_kretrans($data){
	   $this->db->insert('kretrans',$data);
	}
	
	function update_kredit($data,$norek){
		$this->db->where('NO_REKENING', $norek);
		$this->db->update('kredit', $data);
	}
	
	function add_counter($data){
		$this->db->where('modul', 'KRE');
		$this->db->update('controlno', $data);
	}
/*	
	function get_transid(){
		$this->db->select_max('kretrans_id');
		$this->db->from('kretrans');
		return $this->db->get();
	}
	*/
	public function get_kretrans_id($tgl_trans,$no_rek,$pokok_trans,$bunga_trans,$kuitansi){
		$sql="select KRETRANS_ID from kretrans where TGL_TRANS='$tgl_trans' and NO_REKENING='$no_rek' and POKOK_TRANS='$pokok_trans' and BUNGA_TRANS='$bunga_trans' and kuitansi='$kuitansi'";
		$query=$this->db->query($sql);
		return $query->result ();
	}
	/*
	function get_kode_setor_kredit(){
		$this->db->select('kode_trans,GL_TRANS');
		$this->db->from('kodetranskredit');
		$this->db->where('TOB','T');
		$this->db->like('deskripsi_trans','setoran tunai');
		$this->db->or_like('deskripsi_trans','setoran angsuran tunai');
		$this->db->or_like('deskripsi_trans','angsuran tunai');
		return $this->db->get();
	}
	*/
	function get_kode_setor_kredit(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranskredit k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','KRE');
		$this->db->WHERE('w.type_trans','k_angsur');
		return $this->db->get();
	}
	function get_kode_setor_kredit_ob(){
		$this->db->select('w.kode_trans,k.DESKRIPSI_TRANS,k.GL_TRANS,k.TOB ');
		$this->db->from('kodetranskredit k');
		$this->db->join('web_kode_trans_default w', 'k.KODE_TRANS=w.kode_trans', 'left');
		$this->db->WHERE('w.modul','KRE');
		$this->db->WHERE('w.type_trans','ob_angsur');
		return $this->db->get();
	}
	

/*	
	public function get_cicilan_ke($norek) {
		$this->db->select ( 'ANGSURAN_KE,TGL_TRANS' );
		$this->db->from('kretrans');
		$this->db->where ( 'NO_REKENING', $norek );
		$this->db->where ( 'TGL_TRANS', '2014-02-24' );
		$query = $this->db->get ();
		return $query->result ();
	}
*/	
	public function get_cicilan($kode,$bln,$thn) {
		$sql="select ANGSURAN_KE,TGL_TRANS from kretrans where NO_REKENING='".$kode."' and MY_KODE_TRANS=200 and month(TGL_TRANS)='".$bln."' and year(TGL_TRANS)='".$thn."'";
		$query = $this->db->query($sql);
		/* jika angsuran ke melewati batas tanggal angsuran atau sama dengan tanggal realisasi */
		if($query->num_rows()<0 or $query->num_rows() == null){
			/*jika angsuran ke- sama dengan tanggal realisasi*/
			$sql_1="select ANGSURAN_KE,TGL_TRANS from kretrans where NO_REKENING='".$kode."' and MY_KODE_TRANS=100 and month(TGL_TRANS)='".$bln."' and year(TGL_TRANS)='".$thn."' ";
			$query_1 = $this->db->query($sql_1);
			if($query_1->num_rows()==1 ){
				//$query_1['ANGSURAN_KE']=1;// angsuran = tanggal realisasi maka cicilan ke 0
				//return $query_1;
				return $query_1->result ();
			}else{
				/* jika angsuran ke melewati batas tanggal angsuran*/
				$sql="select ANGSURAN_KE,TGL_TRANS from kretrans where NO_REKENING='".$kode."' and MY_KODE_TRANS=200 and ANGSURAN_KE =
						(select max(ANGSURAN_KE) from kretrans where NO_REKENING='".$kode."' and MY_KODE_TRANS=200) ";
				$query = $this->db->query($sql);
				return $query->result ();
			}
		}else{
			/*jika angsuran lancar/ sesuai */
			return $query->result ();
		}
	}
	/*
	function coba($kode){
		$sql="insert into coba values ('".$kode."')";
		$query = $this->db->query($sql);
		
	}
	*/
	
		
}

/* End of file kreditmodel.php */
/* Location: ./application/models/kreditmodel.php */