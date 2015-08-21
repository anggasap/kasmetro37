<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class TksBprM extends CI_Model {


    public function getTksUnsur()
    {
        $sql="SELECT * from webtksunsur where flagaktif='1'";
        $query=$this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getFormulaUnsur($id)
    {
        $sql="SELECT formula from webtksunsur where id = '$id'";
        $query=$this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getNamaUnsur($idUnsur)
    {
        $sql="SELECT namaunsur from webtksunsur where id = '$idUnsur'";
        $query=$this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getNamaPerk($kodePerk)
    {
        $sql="SELECT nama_perk from perkiraan where kode_perk = '$kodePerk'";
        $query=$this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getAllPerkiraan()
    {
        $sql="SELECT kode_perk,nama_perk,type from perkiraan order by kode_perk asc";
        $query=$this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    function getDataUser($userid){
        $this->db->select ( '*' );
        $this->db->from ( 'SCUser' );
        $this->db->where ( 'UserID', $userid);
        $query = $this->db->get ();
        return $query->result ();

    }
    public function submitFormulaPerkiraan($idUnsur,$data){
        $model1 = $this->db->where('id', $idUnsur);
        $model2 = $this->db->update('webtksunsur', $data);
        if ($model1 && $model2){
            return true;
        }else{
            return false;
        }
    }
    public function insert_temp_perk($tgl_trans){
        $sql = "select tanggal from web_temp_perkiraan where tanggal = '".$tgl_trans."'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if($jml==0){

            /*$query_ak="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk,
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit) AS jumlah_ak
							   FROM trans_master,trans_detail,perkiraan
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=1 GROUP BY kode_perk ASC
							   UNION
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_ak FROM PERKIRAAN
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=1 AND TYPE='D')
							   AS opo";
            $query_psv="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk,
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet) AS jumlah_psv
							   FROM trans_master,trans_detail,perkiraan
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=2 GROUP BY kode_perk ASC
							   UNION
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_psv FROM PERKIRAAN
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=2 AND TYPE='D')
							   AS opo";
            $query_mdl="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk,
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet) AS jumlah_mdl
							   FROM trans_master,trans_detail,perkiraan
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=3 GROUP BY kode_perk ASC
							   UNION
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_mdl FROM PERKIRAAN
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=3 AND TYPE='D')
							   AS opo";
            $query_pend="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk,
							   SUM(trans_detail.kredit)- SUM(trans_detail.debet) AS jumlah_pend
							   FROM trans_master,trans_detail,perkiraan
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=4 GROUP BY kode_perk ASC
							   UNION
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_pend FROM PERKIRAAN
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=4 AND TYPE='D')
							   AS opo";
            $query_by="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.level,perkiraan.kode_induk,trans_master.tgl_trans,trans_detail.kode_perk,
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit) AS jumlah_by
							   FROM trans_master,trans_detail,perkiraan
							   WHERE trans_master.trans_id=trans_detail.master_id AND trans_detail.kode_perk=perkiraan.kode_perk
							   AND tgl_trans <='".$tgl_trans."' AND LEFT(perkiraan.kode_perk,1)=5 GROUP BY kode_perk ASC
							   UNION
							   SELECT nama_perk,TYPE,level,kode_induk,0 AS tgl_trans,kode_perk,saldo_awal AS jumlah_by FROM PERKIRAAN
							   WHERE saldo_debet=0 AND saldo_kredit=0 AND saldo_awal>0 AND LEFT(perkiraan.kode_perk,1)=5 AND TYPE='D')
							   AS opo";
            $query_pjk="SELECT * FROM(
							   SELECT perkiraan.nama_perk,perkiraan.type,perkiraan.kode_induk,perkiraan.level,trans_master.tgl_trans,trans_detail.kode_perk,
							   SUM(trans_detail.debet)- SUM(trans_detail.kredit) AS jumlah_pp
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
            }*/
        }//end if jml = 0
    }
    function getFormula(){
        $this->db->select ( 'id,formula,persen' );
        $this->db->from ( 'webtksunsur' );
        //$this->db->where ( 'flagaktif', 1);
        $query = $this->db->get ();
        return $query->result ();

    }
    function getSaldoPerk($kodePerk,$tgl_trans){
        $this->db->select ( 'saldo_akhir' );
        $this->db->from ( 'web_temp_perkiraan' );
        $this->db->where ( 'kode_perk', $kodePerk);
        $this->db->where ( 'tanggal', $tgl_trans);
        $query = $this->db->get ();
        return $query->result ();
    }
    public function kreditKol($tgl_trans){
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
            if (!isset($L)){
                $L  = 0;
            }
            if (!isset($KL)){
                $KL  = 0;
            }
            if (!isset($D)){
                $D  = 0;
            }
            if (!isset($M)){
                $M  = 0;
            }

            $query_insert = "insert into web_kol_kredit values('".$tgl_trans."','".$L."','".$KL."','".$D."','".$M."')";
            $query = $this->db->query($query_insert);
            //return $hasil_kol;
            $sql = "select * from web_kol_kredit where tgl_trans = '".$tgl_trans."' ";
            $query = $this->db->query($sql);
            $query = $query->result();
            //$KL = $query[0]->KL;
            return $query;

            //return $hasil_kol;
        }else{
            $sql = "select * from web_kol_kredit where tgl_trans = '".$tgl_trans."' ";
            $query = $this->db->query($sql);
            $query = $query->result();
            //$KL = $query[0]->KL;
            return $query;
        }
    }
    public function insertTempPerkiraanBoPo($tgl_trans,$user_id){
        $sql_truncate = "truncate table webtempperkiraanbopo";
        $this->db->query($sql_truncate);
        $sql  = "INSERT INTO webtempperkiraanbopo (user_id,tanggal,kode_perk,nama_perk,type,level,kode_induk,saldo_akhir) ";
        $sql .= "SELECT '".$user_id."' as user_id,'".$tgl_trans."' as tanggal,kode_perk,nama_perk,type,level,kode_induk,saldo_awal ";
        $sql .= "FROM perkiraan WHERE ";
        $sql .= "LEFT(kode_perk,1) BETWEEN 1 AND 6";
        $query = $this->db->query($sql);
    }
    public function getSaldoAktivaBoPo($tgl_trans,$user_id){
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
    public function getSaldoPasivaBoPo($tgl_trans,$user_id){
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
    }
    public function updateSaldoTempPerkiraanBoPo($kode_perk,$saldo,$user_id){
        $sql ="UPDATE webtempperkiraanbopo SET saldo_akhir = saldo_akhir +'".$saldo."' WHERE kode_perk='".$kode_perk."' and user_id='".$user_id."'";
        $query = $this->db->query($sql);
    }
    public function getKodeInduk($tgl_trans,$user_id){
        $sql = "select * from webtempperkiraanbopo where type='G' AND user_id='".$user_id."' AND tanggal <='".$tgl_trans."' order by level desc";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getSaldoInduk($kode_perk,$user_id){
        $sql = "SELECT saldo_akhir from webtempperkiraanbopo where kode_induk='".$kode_perk."' AND user_id='".$user_id."'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function updateSaldoInduk($kode_perk,$saldo,$user_id){
        $sql = "UPDATE webtempperkiraanbopo SET saldo_akhir ='".$saldo."' WHERE kode_perk='".$kode_perk."' AND user_id='".$user_id."'";
        $query = $this->db->query($sql);
    }
    function getSaldoPerkBoPo($kodePerk,$tgl_trans){
        $this->db->select ( 'saldo_akhir' );
        $this->db->from ( 'webtempperkiraanbopo' );
        $this->db->where ( 'kode_perk', $kodePerk);
        $this->db->where ( 'tanggal', $tgl_trans);
        $query = $this->db->get ();
        return $query->result ();
    }

    function insertSaldoPend($tgl_master,$tanggal,$saldoAset,$lbrgBjln,$saldoPend,$saldoBiaya){
        $query_insert = "insert into webtksbprbopo values('".$tgl_master."','".$tanggal."','".$saldoAset."','".$lbrgBjln."','".$saldoPend."','".$saldoBiaya."','0','0','0','0')";
        $query = $this->db->query($query_insert);
    }
    public function getSaldoPend($tanggal){
        $sql = "SELECT asset,lbrg,po,bo from webtksbprbopo where tgl_trans='".$tanggal."'";
        $query = $this->db->query($sql);
        return $query;
    }
    function updateSaldoAset($tanggal,$saldoAset){
        $sql = "UPDATE webtksbprbopo SET calcasset ='".$saldoAset."' WHERE tgl_trans='".$tanggal."' ";
        $query = $this->db->query($sql);
    }
    function updateSaldoLbrg($tanggal,$saldoLbrg){
        $sql = "UPDATE webtksbprbopo SET calclbrg ='".$saldoLbrg."' WHERE tgl_trans='".$tanggal."' ";
        $query = $this->db->query($sql);
    }
    function updateSaldoPend($tanggal,$saldoPo){
        $sql = "UPDATE webtksbprbopo SET popo ='".$saldoPo."' WHERE tgl_trans='".$tanggal."' ";
        $query = $this->db->query($sql);
    }
    function updateSaldoBiaya($tanggal,$saldoBo){
        $sql = "UPDATE webtksbprbopo SET bobo ='".$saldoBo."' WHERE tgl_trans='".$tanggal."' ";
        $query = $this->db->query($sql);
    }
    function cekRowTksBprBopo($tgl_master){
        $sql = $this->db->query("select tgl_master from webtksbprbopo where tgl_master='".$tgl_master."'");
        return $sql->num_rows();
    }
    function getAverageBoPo($tgl_trans){
        $sql = "SELECT sum(asset) as asset,sum(lbrg) as lbrg,sum(popo) as popo,sum(bobo) as bobo from webtksbprbopo where tgl_master='".$tgl_trans."'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getLabarugiBerjalan($tgl_master){
        $sql = "SELECT ((SELECT saldo_akhir FROM webtempperkiraanbopo WHERE kode_perk=4 and tanggal='".$tgl_master."')-";
        $sql.= "(SELECT saldo_akhir FROM webtempperkiraanbopo WHERE kode_perk=5 and tanggal='".$tgl_master."')";
        $sql.= ") as lbrg_berjalan";
        $query = $this->db->query($sql);
        return $query;
    }
}

/* End of file Konfigurasi_menu_status_user_m.php */
/* Location: ./application/models/master_nasabahmodel.php */