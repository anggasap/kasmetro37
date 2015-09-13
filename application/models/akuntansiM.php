<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class AkuntansiM extends CI_Model {
    public function getKodeJurnal() {
        $rows = array(); //will hold all results
        $sql="select * from kodejurnal order by kode_jurnal asc ";
        $query=$this->db->query($sql);
        foreach($query->result_array() as $row){
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    function insertTransMaster($data){
        $this->db->insert('trans_master',$data);
    }
    function getTransIdMax($tglTrans,$kodeJurnal,$noRef,$totalTrans,$judulJurnal){
        $sql="select trans_id as transidmax from trans_master where tgl_trans='$tglTrans' and kode_jurnal='$kodeJurnal' and no_bukti='$noRef' and nominal ='$totalTrans' and keterangan='$judulJurnal'";
        $query=$this->db->query($sql);
        return $query->result ();
    }
    function insertTransDetail($data){
        $this->db->insert('trans_detail',$data);
    }
    function updateSaldoPerkiraan15($tmpKodePerk,$tmpSaldoDebet,$tmpSaldoKredit){
        $sql="update perkiraan set saldo_debet = (saldo_debet + $tmpSaldoDebet), saldo_kredit = (saldo_kredit + $tmpSaldoKredit), saldo_akhir = (saldo_akhir + $tmpSaldoDebet - $tmpSaldoKredit) where kode_perk = '$tmpKodePerk'";
        $query=$this->db->query($sql);
    }
    function updateSaldoPerkiraan234($tmpKodePerk,$tmpSaldoDebet,$tmpSaldoKredit){
        $sql="update perkiraan set saldo_debet = (saldo_debet + $tmpSaldoDebet), saldo_kredit = (saldo_kredit + $tmpSaldoKredit), saldo_akhir = (saldo_akhir - $tmpSaldoDebet + $tmpSaldoKredit) where kode_perk = '$tmpKodePerk'";
        $query=$this->db->query($sql);
    }
}

/* End of file akuntansiM.php */
/* Location: ./application/models/akuntansiM.php */