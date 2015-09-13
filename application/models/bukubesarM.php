<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class BukubesarM extends CI_Model {
    public function getSaldoPerk15($kodePerk,$tglTrans1,$tglTrans2){
        $sql = "select m.tgl_trans as tgl_trans,sum(d.debet) as debet, sum(d.kredit) as kredit, (sum(d.debet)-sum(d.kredit)) as saldo_akhir ";
        $sql.= "from trans_master m, trans_detail d ";
        $sql.= "where (m.tgl_trans between '".$tglTrans1."' and '".$tglTrans2."') and m.trans_id =d.master_id and d.kode_perk='".$kodePerk."' ";
        $sql.= "group by m.tgl_trans ";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getSaldoPerk234($kodePerk,$tglTrans1,$tglTrans2){
        $sql = "select m.tgl_trans as tgl_trans,sum(d.debet) as debet, sum(d.kredit) as kredit, (sum(d.kredit)-sum(d.debet)) as saldo_akhir ";
        $sql.= "from trans_master m, trans_detail d ";
        $sql.= "where (m.tgl_trans between '".$tglTrans1."' and '".$tglTrans2."') and m.trans_id =d.master_id and d.kode_perk='".$kodePerk."' ";
        $sql.= "group by m.tgl_trans ";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getSaldoAwalBB15($kodePerk,$tglTrans1){
        $sql = "select  ((select saldo_awal from perkiraan where kode_perk='$kodePerk') + sum(d.debet)-sum(d.kredit)) as saldo_awal ";
        $sql.= "from trans_master m, trans_detail d ";
        $sql.= "where m.tgl_trans < '$tglTrans1' and m.trans_id =d.master_id and d.kode_perk='$kodePerk'  ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function getSaldoAwalBB234($kodePerk,$tglTrans1){
        $sql = "select  ((select saldo_awal from perkiraan where kode_perk='$kodePerk') - sum(d.debet)+ sum(d.kredit)) as saldo_awal ";
        $sql.= "from trans_master m, trans_detail d ";
        $sql.= "where m.tgl_trans < '$tglTrans1' and m.trans_id =d.master_id and d.kode_perk='$kodePerk'  ";
        $query = $this->db->query($sql);
        return $query->result();
    }

}

/* End of file akuntansiM.php */
/* Location: ./application/models/akuntansiM.php */