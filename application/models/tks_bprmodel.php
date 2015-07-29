<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Tks_bprmodel extends CI_Model {
	public function tampil_faktor() {
		$sql ="SELECT f.id_faktor,f.nama_faktor,r.id_rasio,r.jenis_rasio,r.nama_rasio,m.id_komponen_master,m.nama_komponen ";
		$sql.="FROM web_faktor_tks f LEFT JOIN web_rasio_tks r ON r.id_faktor = f.id_faktor ";
		$sql.="LEFT JOIN web_komponen_master m ON m.id_rasio = r.id_rasio ";
		$sql.="WHERE f.id_lembaga = 4";
		$query = $this->db->query($sql);
		return $query;
	}
	public function tampil_konstanta(){
		$this->db->select('id_konsperk,nama_kons,kode_perk');
		$this->db->from('web_konsperk_tks');
		$query = $this->db->get ();
		return $query;
	}
	public function tampil_komponen($id_komponen){
		$this->db->select('k.id_komponen_perk,k.kode_perk,p.nama_perk,k.op,k.bobot_resiko');
		$this->db->from('web_komponen_perk k');
		$this->db->join('perkiraan p', 'k.kode_perk=p.kode_perk', 'left');
		$this->db->where( 'k.id_komponen_master', $id_komponen );
		
		$query = $this->db->get ();
		return $query->result ();
	}
	/*
	public function daftar_perk(){
		$this->db->select('kode_perk,nama_perk,type');
		$this->db->from('perkiraan');
		$this->db->order_by ( "kode_perk", "asc" );
		$query = $this->db->get ();
		return $query->result ();
	}
	*/	
	public function insert_komponen($id_rasio,$id_faktor,$id_komp_master,$kd_perk,$pos_neg,$bot_res){
		$sql="insert into web_komponen_perk values (0,'".$id_rasio."','".$id_faktor."','".$id_komp_master."','".$kd_perk."','".$pos_neg."','".$bot_res."')";
		$query = $this->db->query($sql);
	}
	public function insert_konstanta($kd_perk,$id_konsperk,$nm_konsperk){
		$sql="update  web_konsperk_tks where id_konsperk = '".$id_komp_perk."'";
		$query = $this->db->query($sql);
	}
	public function hapus_komponen_perk($id_komp_perk){
		$sql="delete from web_komponen_perk where id_komponen_perk = '".$id_komp_perk."'";
		$query = $this->db->query($sql);
		//return $query->result ();
	}
	public function insert_temp_perk($tgl_trans){
	  $sql = "select tanggal from web_temp_perkiraan where tanggal = '".$tgl_trans."'";
	  $query = $this->db->query($sql);
	  $jml = $query->num_rows();
	  if($jml==0){
		$query_ak="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit)+perkiraan.saldo_awal AS jumlah_ak 
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=1 GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_ak FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=1 AND TYPE='D')
							   AS opo";
		$query_psv="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet)+perkiraan.saldo_awal AS jumlah_psv 
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=2 GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_psv FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=2 AND TYPE='D')
							   AS opo";
		$query_mdl="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet)+perkiraan.saldo_awal AS jumlah_mdl 
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=3 GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_mdl FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=3 AND TYPE='D')
							   AS opo";
		$query_pend="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet)+perkiraan.saldo_awal AS jumlah_pend 
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=4 GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_pend FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=4 AND TYPE='D')
							   AS opo";
		$query_by="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit)+perkiraan.saldo_awal AS jumlah_by 
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=5 GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_by FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=5 AND TYPE='D')
							   AS opo";
		$query_pjk="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.kode_induk,perkiraan.level,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit)+perkiraan.saldo_awal AS jumlah_pp 
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=6 GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_pp FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=6 AND TYPE='D')
							   AS opo";
		$insert_ak = $this->db->query($query_ak);
		foreach($insert_ak->result() as $row){
			$sql="insert into web_temp_perkiraan values (0,'".$tgl_trans."','".$row->kode_perk."','".$row->nama_perk."','".$row->type."','".$row->level."','".$row->kode_induk."','".$row->jumlah_ak."')";
			$this->db->query($sql);
		}	
		$insert_psv = $this->db->query($query_psv);
		foreach($insert_psv->result() as $row){
			$sql="insert into web_temp_perkiraan values (0,'".$tgl_trans."','".$row->kode_perk."','".$row->nama_perk."','".$row->type."','".$row->level."','".$row->kode_induk."','".$row->jumlah_psv."')";
			$this->db->query($sql);
		}
		$insert_mdl = $this->db->query($query_mdl);
		foreach($insert_mdl->result() as $row){
			$sql="insert into web_temp_perkiraan values (0,'".$tgl_trans."','".$row->kode_perk."','".$row->nama_perk."','".$row->type."','".$row->level."','".$row->kode_induk."','".$row->jumlah_mdl."')";
			$this->db->query($sql);
		}
		$insert_pend = $this->db->query($query_pend);
		foreach($insert_pend->result() as $row){
			$sql="insert into web_temp_perkiraan values (0,'".$tgl_trans."','".$row->kode_perk."','".$row->nama_perk."','".$row->type."','".$row->level."','".$row->kode_induk."','".$row->jumlah_pend."')";
			$this->db->query($sql);
		}
		$insert_by = $this->db->query($query_by);
		foreach($insert_by->result() as $row){
			$sql="insert into web_temp_perkiraan values (0,'".$tgl_trans."','".$row->kode_perk."','".$row->nama_perk."','".$row->type."','".$row->level."','".$row->kode_induk."','".$row->jumlah_by."')";
			$this->db->query($sql);
		}
		$insert_pjk = $this->db->query($query_pjk);
		foreach($insert_pjk->result() as $row){
			$sql="insert into web_temp_perkiraan values (0,'".$tgl_trans."','".$row->kode_perk."','".$row->nama_perk."','".$row->type."','".$row->level."','".$row->kode_induk."','".$row->jumlah_pp."')";
			$this->db->query($sql);
		}
	  }//end if jml = 0
	}
	/*CAR = MODAL / ATMR =>>>   MODAL*/
	public function get_modal($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '14' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_labarugi_berjalan($tgl_trans){
		$sql = "SELECT ((SELECT saldo_akhir FROM web_temp_perkiraan WHERE kode_perk=4 and tanggal = '".$tgl_trans."')-";
		$sql.= "(SELECT saldo_akhir FROM web_temp_perkiraan WHERE kode_perk=5 and tanggal = '".$tgl_trans."')-";
		$sql.= "(SELECT saldo_akhir FROM web_temp_perkiraan WHERE kode_perk=6 and tanggal = '".$tgl_trans."')) as lbrg_berjalan";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_labarugi_tahunlalu($tgl_trans){
		$sql = "SELECT saldo_akhir AS saldo FROM web_temp_perkiraan wp, web_konsperk_tks wk WHERE  wp.kode_perk= wk.kode_perk AND wk.id_konsperk = 2 AND wp.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_ppap($tgl_trans){
		$sql = "SELECT saldo_akhir AS saldo FROM web_temp_perkiraan wp, web_konsperk_tks wk ";
		$sql.= "WHERE  wp.kode_perk= wk.kode_perk AND wk.id_konsperk = 3 AND wp.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_atmr($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '15' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*====END CAR = MODAL / ATMR =>>>   MODAL====*/
	
	/*LIKUIDITAS = ALAT LIKUID / HUTANG LANCAR =>>>   ALAT LIKUID*/
	public function get_lik_alat_likuid($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '22' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_lik_hutang_lancar($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '23' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*====END LIKUIDITAS = ALAT LIKUID / HUTANG LANCAR */
	
	
	/*LDR = KYD / MODAL INTI =>>>   KYD*/
	public function get_ldr_kyd($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '24' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_ldr_modal_inti($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '25' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*====END LDR = KYD / MODAL INTI =>>>   ALAT LIKUID*/
	
	/*PPAP = PPAP / PPAPWD =>>>   PPAP*/
	public function get_kap_ppap($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '16' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_kap_ppapwd($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '17' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*====END PPAP = PPAP / PPAPWD*/
	
	/*
	public function kpmm_atmr_adm($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '13' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function kap_apyd($tgl_trans){
		$sql = "select tgl_trans from web_kol_kredit where tgl_trans = '".$tgl_trans."' ";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml==0){
		  
		  $sql = "SELECT SUM(cf.hasil) AS hasil ,kd.KOLEKTIBILITAS as kol FROM (
				  SELECT a.n1 AS norek,(a.j1-b.j3) AS hasil FROM (
		(SELECT kt.NO_REKENING AS n1,kt.POKOK_TRANS AS j1 FROM kretrans kt WHERE MY_KODE_TRANS = 100 AND kt.TGL_TRANS < '".$tgl_trans."' GROUP BY NO_REKENING) AS a,
		(SELECT kt.NO_REKENING AS n2 ,SUM(kt.POKOK_TRANS) AS j3 FROM kretrans kt WHERE MY_KODE_TRANS = 300  AND kt.TGL_TRANS < '".$tgl_trans."' GROUP BY NO_REKENING ORDER BY 
		no_rekening ASC) AS b ) 
		WHERE a.n1 = b.n2 
		) AS cf 
		LEFT JOIN kredit kd ON cf.norek = kd.NO_REKENING GROUP BY kd.KOLEKTIBILITAS";
		  $query = $this->db->query($sql);
		  $hasil_kol = $query->result();
		

		  foreach ( $hasil_kol as $row ){
			  if($row->kol == 'L'){
				$L = $row->hasil;
			  }
			  if($row->kol == 'KL'){
				$KL = $row->hasil;
			  }
			  if($row->kol == 'D'){
				$D = $row->hasil;
			  }
			  if($row->kol == 'M'){
				$M = $row->hasil;
			  }
		  }
		  	$query_insert = "insert into web_kol_kredit values('".$tgl_trans."','".$L."','".$KL."','".$D."','".$M."')"; 
			$query = $this->db->query($query_insert);
			return $KL;
			
			//return $hasil_kol;
		}else{
			$sql = "select KL from web_kol_kredit where tgl_trans = '".$tgl_trans."' ";
			$query = $this->db->query($sql);
			$query = $query->result();
			$KL = $query[0]->KL;
			return $KL;
		}
	}
	*/
	public function kap_prod($tgl_trans){
		$sql="SELECT SUM(wt.saldo_akhir * (wk.bobot_resiko/100)) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk WHERE 
		      wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '11' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function ren_bo($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '20' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function ren_po($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
			  WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '21' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//ROA LABARUGI
	//PENDAPATAN
	public function roa_pend($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan WHERE LEFT(kode_perk,1)='4' and tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function roa_biaya($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan WHERE LEFT(kode_perk,1)='5' and tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function roa_aset($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan WHERE LEFT(kode_perk,1)='1' and tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function roe_modal($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
		      WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '8' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function liq_ak($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
		      WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '9' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function liq_psv($tgl_trans){
		$sql="SELECT SUM(saldo_akhir) AS saldo FROM web_temp_perkiraan wt, web_komponen_perk wk 
		      WHERE wt.kode_perk = wk.kode_perk AND wk.id_komponen_master = '10' and wt.tanggal = '".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	/*
	SELECT * FROM (
	SELECT a.n1 AS norek,(a.j1-b.j3) AS hasil FROM (
		(SELECT kt.NO_REKENING AS n1,kt.POKOK_TRANS AS j1 FROM kretrans kt WHERE MY_KODE_TRANS = 100 GROUP BY NO_REKENING) AS a,
		(SELECT kt.NO_REKENING AS n2 ,SUM(kt.POKOK_TRANS) AS j3 FROM kretrans kt WHERE MY_KODE_TRANS = 300 GROUP BY NO_REKENING ORDER BY no_rekening ASC) AS b
	) WHERE a.n1 = b.n2 
) AS cf
LEFT JOIN kredit kd ON cf.norek = kd.NO_REKENING
	*/
	public function update_konstanta_perk($kd_perk,$id_konsperk,$id_nmperk){
		$sql="update web_konsperk_tks set kode_perk='".$kd_perk."' where id_konsperk = '".$id_konsperk."'";
		$query = $this->db->query($sql);
		//return $query->result ();
	}
}

/* End of file kreditmodel.php */
/* Location: ./application/models/kreditmodel.php */