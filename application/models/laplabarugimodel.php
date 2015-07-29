<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Laplabarugimodel extends CI_Model {
	public function insert_temp_perkiraan($tgl_trans,$user_id){
		$sql_truncate = "truncate table web_temp_perkiraan";
		$this->db->query($sql_truncate);
		
		$sql  = "INSERT INTO web_temp_perkiraan (user_id,tanggal,kode_perk,nama_perk,type,level,kode_induk,saldo_akhir) ";
		$sql .= "SELECT '".$user_id."' as user_id,'".$tgl_trans."' as tanggal,kode_perk,nama_perk,type,level,kode_induk,saldo_awal ";
		$sql .= "FROM perkiraan WHERE "; 			
		$sql .= "LEFT(kode_perk,1) BETWEEN 1 AND 6";
		$query = $this->db->query($sql);	
					   
	}
	/*public function get_saldo_aktiva($tgl_trans,$user_id){
		$query_ak="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit) AS jumlah_ak
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND (LEFT(perkiraan.kode_perk,1)=1 OR LEFT(perkiraan.kode_perk,1)=5
							    OR LEFT(perkiraan.kode_perk,1)=6)
							    GROUP BY kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_ak FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND TYPE='D')
							   AS opo";
		$query = $this->db->query($query_ak);		
		return $query;
	}
	public function get_saldo_pasiva($tgl_trans,$user_id){
		$query_ak="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,trans_master.tgl_trans,trans_detail.kode_perk, 
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet) AS jumlah_psv
							   FROM trans_master,trans_detail,perkiraan 
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk 
							   AND tgl_trans <='".$tgl_trans."' AND (LEFT(perkiraan.kode_perk,1)=2 OR LEFT(perkiraan.kode_perk,1)=3 
							   OR LEFT(perkiraan.kode_perk,1)=4) GROUP BY
							    kode_perk ASC 
							   UNION 
							   SELECT nama_perk,TYPE,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_pend FROM PERKIRAAN 
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND (LEFT(perkiraan.kode_perk,1)=2 OR 
							   LEFT(perkiraan.kode_perk,1)=3 
							   OR LEFT(perkiraan.kode_perk,1)=4) AND TYPE='D')
							   AS opo";
		$query = $this->db->query($query_ak);		
		return $query;
	}*/
	public function update_saldo_temp_perkiraan($kode_perk,$saldo,$user_id){
		$sql ="UPDATE web_temp_perkiraan SET saldo_akhir = '".$saldo."' WHERE kode_perk='".$kode_perk."' and user_id='".$user_id."'";
		$query = $this->db->query($sql);
	}
	
	public function get_kode_induk($tgl_trans,$user_id){
		$sql = "select * from web_temp_perkiraan where type='G' AND user_id='".$user_id."' AND tanggal <='".$tgl_trans."' order by level desc";
		$query = $this->db->query($sql);
		return $query;
	}
	public function get_saldo_induk($kode_perk,$user_id){
		
		$sql = "SELECT saldo_akhir from web_temp_perkiraan where kode_induk='".$kode_perk."' AND user_id='".$user_id."'";
		$query = $this->db->query($sql);
		return $query;
	}
	public function update_saldo_induk($kode_perk,$saldo,$user_id){
		
		$sql = "UPDATE web_temp_perkiraan SET saldo_akhir ='".$saldo."' WHERE kode_perk='".$kode_perk."' AND user_id='".$user_id."'";
		$query = $this->db->query($sql);
	}
	
	public function get_data_labarugi_aktiva($induk=0)
	{
		$data = array();
		$sql = "SELECT * from web_temp_perkiraan where kode_induk='".$induk."' AND left(kode_perk,1)='4' order by kode_perk asc";
		$result = $this->db->query($sql);
		foreach($result->result() as $row)
		{
			$data[] = array(
					'kode_perk'	=>$row->kode_perk,
					'nama'	=>$row->nama_perk,
					'saldo'	=>$row->saldo_akhir,
					'level'	=>$row->level,
					'type'	=>$row->type,
					// recursive
					'child'	=>$this->get_data_labarugi_aktiva($row->kode_perk)
				);
		}
		return $data;
	}
	public function get_data_labarugi_pasiva($induk=0){
		$data = array();
		$sql = "SELECT * from web_temp_perkiraan where kode_induk='".$induk."' AND left(kode_perk,1)='5' ";
		$sql.= "order by kode_perk asc";
		$result = $this->db->query($sql);
		foreach($result->result() as $row){
			$data[] = array(
					'kode_perk'	=>$row->kode_perk,
					'nama'	=>$row->nama_perk,
					'saldo'	=>$row->saldo_akhir,
					'level'	=>$row->level,
					'type'	=>$row->type,
					// recursive
					'child'	=>$this->get_data_labarugi_pasiva($row->kode_perk)
				);
		}
		return $data;
	}
	public function get_labarugi_berjalan(){
		$sql = "SELECT ((SELECT saldo_akhir FROM web_temp_perkiraan WHERE kode_perk=4)-";
		$sql.= "(SELECT saldo_akhir FROM web_temp_perkiraan WHERE kode_perk=5)";
		$sql.= ") as lbrg_berjalan";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_total_aktiva($tgl_trans){
		$sql = "SELECT saldo_akhir as total_aktiva FROM web_temp_perkiraan WHERE kode_perk=4 AND tanggal='".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_total_pasiva($tgl_trans){
		$sql = "SELECT saldo_akhir as total_pasiva FROM web_temp_perkiraan WHERE kode_perk=5 AND tanggal='".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_pajak($tgl_trans){
		$sql = "SELECT saldo_akhir as pajak FROM web_temp_perkiraan WHERE kode_perk=6 AND tanggal='".$tgl_trans."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
}

/* End of file kasmodel.php */
/* Location: ./application/models/kasmodel.php */