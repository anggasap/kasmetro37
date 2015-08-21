<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TksBpr extends CI_Controller {
	
	function __construct(){
        parent::__construct();

		session_start ();
		$this->load->model('tksBprM');
		$this->load->model('kasmodel');
        $this->load->model('lapneracamodel');
		$this->load->helper('url');
    }

    public function index(){
		if ($this->auth->is_logged_in () == false) {
			//$this->login();
            redirect('main/login');
		} else {
			$data['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
			$data ['nama'] = $this->homemodel->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'template', 'admin/index',$data );
   		}
	}

    public function formula(){
        $this->auth->restrict();
        $this->auth->cek_menu ( 35 );

        if(isset($_POST["btnTampil"])) {

            $this->tampil_tks();
        }else{
            $data['judul'] = 'Tingkat Kesehatan BPR';
            $data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));

            $this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
            $this->template->load ( 'tempDataTable', 'admin/tksBprFormula2V', $data );
        }
    }
    public function getTksUnsur(){
        $this->CI =& get_instance();//and a.kcab_id<>'1100'
        $rows = $this->tksBprM->getTksUnsur();
        $data['data'] = array();
        foreach( $rows as $row ) {

            $array = array(
                'id' => $row->id,
                'namaunsur' => $row->namaunsur,
                'persen' => $row->persen

            );

            array_push($data['data'],$array);
        }
        //echo json_encode($data['data']);
        $this->output->set_output(json_encode($data));
    }
    public function setFormula($idUnsur){
        $this->auth->restrict();
        $this->auth->cek_menu ( 35 );

        $data['judul'] = 'Tingkat Kesehatan BPR';
        $data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));

        $this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
        $data['idUnsur']    = $idUnsur;
        $namaUnsur  = $this->tksBprM->getNamaUnsur($idUnsur);
        $data['namaUnsur']=	trim($namaUnsur[0]->namaunsur);
        $this->template->load ( 'tempDataTable', 'admin/tksBprSetFormulaV',$data );

    }
    public function getFormulaUnsur($id){
        $this->CI =& get_instance();//and a.kcab_id<>'1100'
        $sql = $this->tksBprM->getFormulaUnsur($id);
        $formula=	$sql[0]->formula;

        $formula = explode(';;', trim($formula));
        $data['data'] = array();
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getNamaPerk($kodePerk);
                $namaPerk=	$sqlx[0]->nama_perk;
                $array = array(
                    'id'        => $kodePerk,
                    'namaPerk'  => $namaPerk
                );
                array_push($data['data'],$array);
            }
        }
        $this->output->set_output(json_encode($data));
    }
    public function getAllPerkiraan(){
        $this->CI =& get_instance();//and a.kcab_id<>'1100'
        $rows = $this->tksBprM->getAllPerkiraan();
        $data['data'] = array();
        foreach( $rows as $row ) {
            $array = array(
                'kode_perk' => $row->kode_perk,
                'nama_perk' => $row->nama_perk,
                'type' => $row->type
            );
            array_push($data['data'],$array);
        }
        //echo json_encode($data['data']);
        $this->output->set_output(json_encode($data));
    }
    //submitFormulaPerkiraan
    public function submitFormulaPerkiraan()
    {
        $idUnsur            = trim($this->input->post('idUnsur'));
        $idPerkiraanCache   = trim($this->input->post('idPerkiraanCache'));

        $sql = $this->tksBprM->getFormulaUnsur($idUnsur);
        $formula=	trim($sql[0]->formula);

        $formula = $formula.$idPerkiraanCache;

        $data = array(
            'formula'		        =>$formula
        );
        $model = $this->tksBprM->submitFormulaPerkiraan($idUnsur,$data);
        if($model){
            $pesan = array(
                'pesan1'    => 'Sukses'
            );
            $this->output->set_output(json_encode($pesan));
        }else{
            $pesan = array(
                'pesan1'    => 'Gagal'
            );
            $this->output->set_output(json_encode($pesan));
        }

    }
    public function deleteFormulaPerkiraan()
    {
        $idUnsur            = trim($this->input->post('idHapusUnsur'));
        $idPerkiraanCache   = trim($this->input->post('idUnsurCache'));

        $sql = $this->tksBprM->getFormulaUnsur($idUnsur);
        $formula=	trim($sql[0]->formula);
        $idPerkiraan = explode(';;', $idPerkiraanCache);

        foreach($idPerkiraan as $y=>$kodePerk){
            if($kodePerk<>''){
                $kodePerk=$kodePerk.';;';
                $formula = str_replace($kodePerk,"",$formula);
                $kodePerk='';
            }
        }

        $data = array(
            'formula'		        =>$formula
        );
        $model = $this->tksBprM->submitFormulaPerkiraan($idUnsur,$data);
        if($model){
            $pesan = array(
                'pesan1'    => 'Sukses'
            );
            $this->output->set_output(json_encode($pesan));
        }else{
            $pesan = array(
                'pesan1'    => 'Gagal'
            );
            $this->output->set_output(json_encode($pesan));
        }

    }
    public function score(){
        $this->auth->restrict();
        $this->auth->cek_menu ( 36 );

        if(isset($_POST["btnTampil"])) {

            $this->tampil_tks();
        }else{
            $data['judul'] = 'Tingkat Kesehatan BPR';
            $data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));

            $this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
            $this->template->load ( 'tempDataTable', 'admin/tksBprScore2V', $data );
        }
    }
    function get_month_name($month)
    {
        $months = array(
            1   =>  'Januari',
            2   =>  'Februari',
            3   =>  'Maret',
            4   =>  'April',
            5   =>  'Mei',
            6   =>  'Juni',
            7   =>  'Juli',
            8   =>  'Agustus',
            9   =>  'September',
            10  =>  'Oktober',
            11  =>  'November',
            12  =>  'Desember'
        );
    return $months[$month];
    }
    function tampil_tks(){
        $tgl = $this->input->post('txtTanggal');
        $timestamp = strtotime($tgl);
        $tgl_trans = date('Y-m-d', $timestamp);
        $month = date("m",strtotime($tgl_trans));
        $month = intval($month);
        $data['tgl'] = $this->get_month_name($month);

        //$tempPerkiraan = $this->tksBprM->insert_temp_perk($tgl_trans);
        /*neraca*/
        $temp_perkiraan     = $this->lapneracamodel->insert_temp_perkiraan( $tgl_trans,$this->session->userdata('user_id'));
        $saldo_aktiva       = $this->lapneracamodel->get_saldo_aktiva( $tgl_trans,$this->session->userdata('user_id'));
        foreach($saldo_aktiva->result() as $row){
            $this->lapneracamodel->update_saldo_temp_perkiraan($row->kode_perk,$row->jumlah_ak,$this->session->userdata('user_id'));
        }
        $saldo_pasiva       = $this->lapneracamodel->get_saldo_pasiva( $tgl_trans,$this->session->userdata('user_id'));
        foreach($saldo_pasiva->result() as $row){
            $this->lapneracamodel->update_saldo_temp_perkiraan($row->kode_perk,$row->jumlah_psv,$this->session->userdata('user_id'));
        }
        $get_kode_induk     = $this->lapneracamodel->get_kode_induk( $tgl_trans,$this->session->userdata('user_id'));
        foreach($get_kode_induk->result() as $row1){
            $jsu = 0;
            $get_saldo_induk = $this->lapneracamodel->get_saldo_induk($row1->kode_perk,$this->session->userdata('user_id'));
            foreach($get_saldo_induk->result() as $row2){
                $jsu=$jsu + $row2->saldo_akhir;
                $this->lapneracamodel->update_saldo_induk($row1->kode_perk,$jsu,$this->session->userdata('user_id'));
            }
        }
        /*end neraca*/
        $formula    = $this->tksBprM->getFormula();
        $array[]    = array();
        foreach($formula as $a => $b){
            array_push($array,$b);

        }
        //print_r($array);
        /* 1 == KAS */
        $saldoKas   =   0;
        $formulaKas =   $array[1]->formula;
        $formula = explode(';;', trim($formulaKas));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoKas =	$sqlx[0]->saldo_akhir + $saldoKas;

            }
        }
        $atmrSaldoKas   = $saldoKas * $array[1]->persen/100;


        /*2 == Giro ABA ======= Giro (Antar Bank Aktiva)*/
        $saldoGiroABA   =   0;
        $formulaGiroABA =   $array[2]->formula;
        $formula = explode(';;', trim($formulaGiroABA));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoGiroABA =	$sqlx[0]->saldo_akhir + $saldoGiroABA;

            }
        }
        $atmrSaldoGiroABA   = $saldoGiroABA * $array[2]->persen/100;

        /*3 == TabABA ====== Tabungan (Antar Bank Aktiva)*/
        $saldoTabABA   =   0;
        $formulaTabABA =   $array[3]->formula;
        $formula = explode(';;', trim($formulaTabABA));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoTabABA =	$sqlx[0]->saldo_akhir + $saldoTabABA;

            }
        }
        $atmrSaldoTabABA   = $saldoTabABA * $array[3]->persen/100;

        /*4 == TabABP ====== Tabungan (Antar Bank Pasiva)*/
        $saldoTabABP   =   0;
        $formulaTabABP =   $array[4]->formula;
        $formula = explode(';;', trim($formulaTabABP));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoTabABP =	$sqlx[0]->saldo_akhir + $saldoTabABP;

            }
        }

        /** 5 ALAT LIKUID */
        $alatLikuid = $saldoKas + $saldoGiroABA  + $saldoTabABA + $saldoTabABP;

        /*6 == Deposito ====== Deposito*/
        $saldoDeposito   =   0;
        $formulaDeposito =   $array[6]->formula;
        $formula = explode(';;', trim($formulaDeposito));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoDeposito =	$sqlx[0]->saldo_akhir + $saldoDeposito;

            }
        }

        $atmrSaldoDeposito   = $saldoDeposito * $array[6]->persen/100;
        ;

        /** 7 HARTA LANCAR */
        $hartaLancar = $alatLikuid + $saldoDeposito;

        /*8 == Kredit yang diberikan ===== KYD */
        $saldoKYD   =   0;
        $formulaKYD =   $array[8]->formula;
        $formula = explode(';;', trim($formulaKYD));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoKYD =	$sqlx[0]->saldo_akhir + $saldoKYD;

            }
        }
        /*Kredit yang diberikan berdasarkan Kolektibilitas */
        /** */
        $kreditKol  = $this->tksBprM->kreditKol($tgl_trans);
        $kolL       = $kreditKol[0]->L;     //9
        $kolKL      = $kreditKol[0]->KL;    //10
        $kolD       = $kreditKol[0]->D;     //11
        $kolM       = $kreditKol[0]->M;     //12

        $kapKolKL   = 50/100*$kolKL;
        $kapKolD   = 75/100*$kolD;
        $kapKolM   = 100/100*$kolKL;

        $nilaiAgunanKolKL   = 0;
        $nilaiAgunanKolD    = 0;
        $nilaiAgunanKolM    = 0;

        $PPAPWDTabABA       = 0.5/100 * $saldoTabABA;
        $PPAPWDDeposito     = 0.5/100 * $saldoDeposito;
        $PPAPWDKolL         = 0.5/100 * $kolL;
        $PPAPWDKolKL        = 10/100  * $kolKL;
        $PPAPWDKolD         = 50/100  * $kolD;
        $PPAPWDKolM         = 100/100 * $kolM;

        $totalPPAPWDGood    = $PPAPWDTabABA + $PPAPWDDeposito + $PPAPWDKolL;
        $totalPPAPWD        = $PPAPWDTabABA + $PPAPWDDeposito + $PPAPWDKolL + $PPAPWDKolKL + $PPAPWDKolD + $PPAPWDKolM;

        $totalKAP   = $kapKolKL + $kapKolD + $kapKolM;
        $totalAP    = $saldoTabABA + $saldoDeposito + $saldoKYD + $nilaiAgunanKolKL + $nilaiAgunanKolD + $nilaiAgunanKolM;

        /**13 NPL */
        $NPL        = $kolKL + $kolD + $kolM;

        $atmrSaldoKYD   = $saldoKYD * $array[8]->persen/100;//nilainya masih salah - tidak ada nilai agunan


        /*14 == Aktiva tetap + Inventaris (nilai buku) ===== ATI */
        $saldoATI   =   0;
        $formulaATI =   $array[14]->formula;
        $formula = explode(';;', trim($formulaATI));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoATI =	$sqlx[0]->saldo_akhir + $saldoATI;

            }
        }

        $atmrSaldoATI   = $saldoATI * $array[14]->persen/100;


        /*15 == Aktiva Lain-lain ===== AktLain */
        $saldoAktLain   =   0;
        $formulaAktLain =   $array[15]->formula;
        $formula = explode(';;', trim($formulaAktLain));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoAktLain =	$sqlx[0]->saldo_akhir + $saldoAktLain;

            }
        }

        $atmrSaldoAktLain   = $saldoAktLain * $array[15]->persen/100;


        $totalATMR      = $atmrSaldoAktLain + $atmrSaldoATI + $atmrSaldoKYD + $atmrSaldoDeposito + $atmrSaldoTabABA + $atmrSaldoGiroABA + $atmrSaldoKas ;

        /*16 == PPAP */
        $saldoPPAP   =   0;
        $formulaPPAP =   $array[16]->formula;
        $formula = explode(';;', trim($formulaPPAP));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoPPAP =	$sqlx[0]->saldo_akhir + $saldoPPAP;

            }
        }
        /**17 */
        $jmlAsset    = $saldoKas + $saldoGiroABA +$saldoTabABA +$saldoDeposito + $saldoKYD + $saldoPPAP;
        /**18 */
        $rataAsset   = $jmlAsset ;

        /**19 Dana Pihak Ketiga*/
        $saldoDanaPihak3   =   0;
        $formulaDanaPihak3 =   $array['19']->formula;
        $formula = explode(';;', trim($formulaDanaPihak3));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoDanaPihak3 =	$sqlx[0]->saldo_akhir + $saldoDanaPihak3;

            }
        }
        /*20 == KSD */
        $saldoKSD   =   0;
        $formulaKSD =   $array['20']->formula;
        $formula = explode(';;', trim($formulaKSD));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoKSD =	$sqlx[0]->saldo_akhir + $saldoKSD;

            }
        }
        /**21 Hutang Lancar*/
        $hutangLancar   = $saldoDanaPihak3 + $saldoKSD ;

        /*22 == Modal disetor ===== ModalDis */
        $saldoModalDis   =   0;
        $formulaModalDis =   $array[22]->formula;
        $formula = explode(';;', trim($formulaModalDis));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoModalDis =	$sqlx[0]->saldo_akhir + $saldoModalDis;

            }
        }
        /*23 == Laba tahun lalu ===== LRTL */
        $saldoLRTL   =   0;
        $formulaLRTL =   $array[23]->formula;
        $formula = explode(';;', trim($formulaLRTL));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoLRTL =	$sqlx[0]->saldo_akhir + $saldoLRTL;

            }
        }

        /*26 == Penyisihan Penghapusan Aktiva Produktif ===== PPAP2 */
        $saldoPPAP2   =   0;
        if($totalPPAPWDGood <= ($totalATMR * 1.25/100)){
            $saldoPPAP2 = $totalPPAPWDGood;
        }else{
            $saldoPPAP2 = $totalATMR * 1.25/100;
        }
        /*28 == Pendapatan Operasional ===== PO */
        $saldoPO   =   0;
        $formulaPO =   $array[28]->formula;
        $formula = explode(';;', trim($formulaPO));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoPO =	$sqlx[0]->saldo_akhir + $saldoPO;

            }
        }

        /*29 == Biaya Operasional ===== BO */
        $saldoBO   =   0;
        $formulaBO =   $array[29]->formula;
        $formula = explode(';;', trim($formulaBO));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoBO =	$sqlx[0]->saldo_akhir + $saldoBO;

            }
        }
        /*30 LabaRugiOperasional*/
        $LRO = $saldoPO - $saldoBO;

        /*31 == Pendapatan Non Operasional =====PNO */
        $saldoPNO   =   0;
        $formulaPNO =   $array[31]->formula;
        $formula = explode(';;', trim($formulaPNO));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoPNO =	$sqlx[0]->saldo_akhir + $saldoPNO;

            }
        }
        /*32 == Biaya Non Operasional ===== BNO */
        $saldoBNO   =   0;
        $formulaBNO =   $array[32]->formula;
        $formula = explode(';;', trim($formulaBNO));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoBNO =	$sqlx[0]->saldo_akhir + $saldoBNO;

            }
        }

        /*33 LabaRugiNonOperasional*/
        $LRNO = $saldoPNO - $saldoBNO;

        /*34 TotalLabaRugi*/
        $TLR = $LRO + $LRNO;

        /*35 == Taskiran Pajak ===== TP */
        $saldoTP   =   0;
        $formulaTP =   $array[35]->formula;
        $formula = explode(';;', trim($formulaTP));
        foreach($formula as $y=>$kodePerk){
            if($kodePerk<>''){
                $sqlx = $this->tksBprM->getSaldoPerk($kodePerk,$tgl_trans);
                $saldoTP =	$sqlx[0]->saldo_akhir + $saldoTP;

            }
        }

        /*36 LabaRugi setelah Pajak === LRSP*/
        $LRSP = $TLR - $saldoTP;

        /**24 50% Laba berjalan /100% Rugi berjalan*/
        if($LRSP<0){
            $LRBJL = $LRSP;
        }else{
            $LRBJL = $LRSP/2;
        }
        /**25 Modal Inti ==== */
        $modalInti = $saldoModalDis + $saldoLRTL + $LRBJL;
        /**27 Jumlah Modal */
        $jmlModal = $modalInti + $saldoPPAP2;

        /*BOPO dalam setahun*/
        $year = date("Y",strtotime($tgl_trans));
        $month = date("m",strtotime($tgl_trans));
        $tgl = date("d",strtotime($tgl_trans));

        $tgl_master = date("Y-m-t", strtotime($tgl_trans));

        $cekRow = $this->tksBprM->cekRowTksBprBopo($tgl_master);
        if($cekRow==0){
            for($i=1;$i<=13;$i++){
                if($month<1){
                    $month = 12;
                    $year = $year - 1;
                    $tanggal = $year.'-'.$month.'-'.$tgl;
                    $tanggal = date("Y-m-t", strtotime($tanggal));
                    $month = $month-1;
                }else{
                    $tanggal = $year.'-'.$month.'-'.$tgl;
                    $tanggal = date("Y-m-t", strtotime($tanggal));
                    $month = $month-1;
                }
                $temp_perkiraan = $this->tksBprM->insertTempPerkiraanBoPo( $tanggal,$this->session->userdata('user_id'));
                $saldo_aktiva   = $this->tksBprM->getSaldoAktivaBoPo( $tanggal,$this->session->userdata('user_id'));
                foreach($saldo_aktiva->result() as $row){
                    $this->tksBprM->updateSaldoTempPerkiraanBoPo($row->kode_perk,$row->jumlah_ak,$this->session->userdata('user_id'));
                }
                $saldo_pasiva   = $this->tksBprM->getSaldoPasivaBoPo( $tanggal,$this->session->userdata('user_id'));
                foreach($saldo_pasiva->result() as $row){
                    $this->tksBprM->updateSaldoTempPerkiraanBoPo($row->kode_perk,$row->jumlah_psv,$this->session->userdata('user_id'));
                }
                $get_kode_induk = $this->tksBprM->getKodeInduk( $tanggal,$this->session->userdata('user_id'));
                foreach($get_kode_induk->result() as $row1){
                    $jsu = 0;
                    $get_saldo_induk = $this->tksBprM->getSaldoInduk($row1->kode_perk,$this->session->userdata('user_id'));
                    foreach($get_saldo_induk->result() as $row2){
                        $jsu=$jsu + $row2->saldo_akhir;
                        $this->tksBprM->updateSaldoInduk($row1->kode_perk,$jsu,$this->session->userdata('user_id'));
                    }
                }

                //17 == Jumlah Aset ===== Asset
                $saldoAset   =   0;
                $formulaAset =   $array[17]->formula;
                $formula = explode(';;', trim($formulaAset));
                foreach($formula as $y=>$kodePerk){
                    if($kodePerk<>''){
                        $sqlx = $this->tksBprM->getSaldoPerkBoPo($kodePerk,$tanggal);
                        $saldoAset =	$sqlx[0]->saldo_akhir + $saldoAset;
                    }
                }

                //28 == Pendapatan Operasional ===== PO
                $saldoPend   =   0;
                $formulaPend =   $array[28]->formula;
                $formula = explode(';;', trim($formulaPend));
                foreach($formula as $y=>$kodePerk){
                    if($kodePerk<>''){
                        $sqlx = $this->tksBprM->getSaldoPerkBoPo($kodePerk,$tanggal);
                        $saldoPend =	$sqlx[0]->saldo_akhir + $saldoPend;
                    }
                }

                //29 == Biaya Operasional ===== BO
                $saldoBiaya   =   0;
                $formulaBiaya =   $array[29]->formula;
                $formula = explode(';;', trim($formulaBiaya));
                foreach($formula as $y=>$kodePerk){
                    if($kodePerk<>''){
                        $sqlx = $this->tksBprM->getSaldoPerkBoPo($kodePerk,$tanggal);
                        $saldoBiaya =	$sqlx[0]->saldo_akhir + $saldoBiaya;

                    }
                }
                $lbrgBjln   = $this->tksBprM->getLabarugiBerjalan($tanggal);
                foreach($lbrgBjln->result() as $row){
                    $lbrgBjln = $row->lbrg_berjalan;
                }
                $this->tksBprM->insertSaldoPend( $tgl_master,$tanggal,$saldoAset,$lbrgBjln,$saldoPend,$saldoBiaya);
            }
            $year   = date("Y",strtotime($tgl_trans));
            $month  = date("m",strtotime($tgl_trans));
            $tgl    = date("d",strtotime($tgl_trans));
            $a      = 0 ;   $d  =0; $g  =0; $k = 0;
            $b      = 0;    $e  =0; $h  =0; $l = 0;
            $ftgl = $year . '-' . $month . '-' . $tgl;
            $tggl = date("Y-m-t", strtotime($ftgl));
            $tanggalbefore = $tggl;
            for($i=1;$i<=13;$i++) {
                if ($month < 1) {
                    $month = 12;
                    $year = $year - 1;
                    $tanggal = $year . '-' . $month . '-' . $tgl;
                    $tanggal = date("Y-m-t", strtotime($tanggal));
                    $month = $month - 1;
                    $x = $this->tksBprM->getSaldoPend( $tanggal);
                    foreach($x->result() as $row){
                        $b  = $row->po;
                        $e  = $row->bo;
                        $h  = $row->asset;
                        $k  = $row->lbrg;
                    }
                } else {
                    $tanggal = $year . '-' . $month . '-' . $tgl;
                    $tanggal = date("Y-m-t", strtotime($tanggal));
                    $month = $month - 1;
                    $x = $this->tksBprM->getSaldoPend( $tanggal);
                    foreach($x->result() as $row){
                        $b = $row->po;
                        $e  = $row->bo;
                        $h  = $row->asset;
                        $k  = $row->lbrg;
                    }
                }

                $c = $a - $b;
                $a = $b;

                $f = $d - $e;
                $d = $e;

                $j = $g - $h;
                $g = $h;

                $m = $k - $l;
                $k = $l;
                //$b = $c;
                if($i>1){
                    if($c>0){
                        $this->tksBprM->updateSaldoPend( $tanggalbefore,$c);
                    }else{
                        $this->tksBprM->updateSaldoPend( $tanggalbefore,$b);
                    }
                    if($f>0){
                        $this->tksBprM->updateSaldoBiaya( $tanggalbefore,$f);
                    }else{
                        $this->tksBprM->updateSaldoBiaya( $tanggalbefore,$e);
                    }
                    if($j>0){
                        $this->tksBprM->updateSaldoAset( $tanggalbefore,$j);
                    }else{
                        $this->tksBprM->updateSaldoAset( $tanggalbefore,$h);
                    }
                    if($m>0){
                        $this->tksBprM->updateSaldoLbrg( $tanggalbefore,$m);
                    }else{
                        $this->tksBprM->updateSaldoLbrg( $tanggalbefore,$l);
                    }
                }
                $tanggalbefore = $tanggal;
                $averageBopo    = $this->tksBprM->getAverageBoPo($tgl_master);
                foreach($averageBopo->result() as $row){
                    $aset = $row->asset;
                    $lbrg = $row->lbrg;
                    $popo = $row->popo;
                    $bobo = $row->bobo;
                }
            }

        }else{
            $averageBopo    = $this->tksBprM->getAverageBoPo($tgl_master);
            foreach($averageBopo->result() as $row){
                $aset = $row->asset;
                $lbrg = $row->lbrg;
                $popo = $row->popo;
                $bobo = $row->bobo;
            }
        }

        /* End BOPO dalam setahun*/
        /*Asset dalam setahun*/

        /* END Asset dalam setahun*/

        /*I CAR*/
        $data['jmlModal']    = $PPAPWDKolM;//$jmlModal;
        $data['totalATMR']    = $totalATMR;
        $data['CAR']    = $jmlModal / $totalATMR * 100;
        if($data['CAR'] >= 8){
            $data['predikatCAR']    = '<span class="label label-primary"> SEHAT </span>';
        }elseif($data['CAR'] < 8 && $data['CAR'] >= 6.5){
            $data['predikatCAR']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }else{
            $data['predikatCAR']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }
        /*II LIKUIDITAS */
        $data['alatLikuid']    = $alatLikuid;
        $data['hutangLancar']    = $hutangLancar;
        $data['LIKUIDITAS'] = $alatLikuid / $hutangLancar *100;
        if($data['LIKUIDITAS'] >= 4.05){
            $data['predikatLIKUIDITAS']    = '<span class="label label-primary"> SEHAT </span>';
        }elseif($data['LIKUIDITAS'] < 4.05 && $data['LIKUIDITAS'] >= 3.3){
            $data['predikatLIKUIDITAS']    = '<span class="label label-info"> CUKUP SEHAT </span>';
        }elseif($data['LIKUIDITAS'] < 3.3 && $data['LIKUIDITAS'] >= 2.55){
            $data['predikatLIKUIDITAS']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }else{
            $data['predikatLIKUIDITAS']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }
        /*III LDR */
        $data['saldoKYD']    = $saldoKYD;
        $data['DanaPihak3modalInti']    = $saldoDanaPihak3 + $modalInti;
        $data['LDR'] = $saldoKYD / ($saldoDanaPihak3 + $modalInti) *100;
        if($data['LDR'] < 94.75){
            $data['predikatLDR']    = '<span class="label label-primary"> SEHAT </span>';
        }elseif($data['LDR'] >= 94.75 && $data['LDR'] < 98.5){
            $data['predikatLDR']    = '<span class="label label-info"> CUKUP SEHAT </span>';
        }elseif($data['LDR'] >= 98.5 && $data['LDR'] < 100){
            $data['predikatLDR']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }else{
            $data['predikatLDR']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }
        /*IV KAP */
        $data['totalKAP']    = $totalKAP;
        $data['totalAP']    = $totalAP;
        $data['KAP'] = $totalKAP / $totalAP *100;
        if($data['KAP'] <= 10.35){
            $data['predikatKAP']    = '<span class="label label-primary"> SEHAT </span>';
        }else{
            $data['predikatKAP']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }
        /*V PPAP */
        $data['saldoPPAP']    = $saldoPPAP;
        $data['totalPPAPWD']    = $totalPPAPWD;
        $data['PPAP'] = (-1*$saldoPPAP) / $totalPPAPWD * 100;
        if($data['PPAP'] <= 51){
            $data['predikatPPAP']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }elseif($data['PPAP'] >= 66 && $data['PPAP'] > 51){
            $data['predikatPPAP']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }elseif($data['PPAP'] >= 81 && $data['PPAP'] > 66){
            $data['predikatPPAP']    = '<span class="label label-info"> CUKUP SEHAT </span>';
        }else{
            $data['predikatPPAP']    = '<span class="label label-primary"> SEHAT </span>';
        }
        /*VI ROA */
        $data['saldoLRTL']    = $lbrg;//$saldoLRTL;
        $data['rataAsset']    = $aset;//$rataAsset;
        $data['ROA'] = ($data['saldoLRTL'] / $data['rataAsset']) * 100 ;// ASAL NIH SOALNYA RATA2 PERBULAN
        if($data['ROA'] >= 1.215){
            $data['predikatROA']    = '<span class="label label-primary"> SEHAT </span>';
        }elseif($data['ROA'] < 1.215 && $data['ROA'] >= 0.999){
            $data['predikatROA']    = '<span class="label label-info"> CUKUP SEHAT </span>';
        }elseif($data['ROA'] < 0.999 && $data['ROA'] >= 0.765){
            $data['predikatROA']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }else{
            $data['predikatROA']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }
        /*VII BOPO */
        $data['saldoBO']    = $bobo;
        $data['saldoPO']    = $popo;
        $data['BOPO'] = ($data['saldoBO'] / $data['saldoPO']) * 100 ;
        if($data['BOPO'] <= 93.52){
            $data['predikatBOPO']    = '<span class="label label-primary"> SEHAT </span>';
        }elseif($data['BOPO'] <= 94.72 && $data['BOPO'] > 93.52){
            $data['predikatBOPO']    = '<span class="label label-info"> CUKUP SEHAT </span>';
        }elseif($data['BOPO'] <= 95.92 && $data['BOPO'] > 94.72){
            $data['predikatBOPO']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }else{
            $data['predikatBOPO']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }
        /*VIII NPL */
        $data['saldoNPL']    = $NPL;
        $data['NPL'] = ($NPL / $saldoKYD) * 100 ;
        if($data['NPL'] <= 5){
            $data['predikatNPL']    = '<span class="label label-primary"> SEHAT </span>';
        }elseif($data['NPL'] <= 10 && $data['NPL'] > 5){
            $data['predikatNPL']    = '<span class="label label-info"> CUKUP SEHAT </span>';
        }elseif($data['NPL'] <= 15 && $data['NPL'] > 10){
            $data['predikatNPL']    = '<span class="label label-warning"> KURANG SEHAT </span>';
        }else{
            $data['predikatNPL']    = '<span class="label label-danger"> TIDAK SEHAT </span>';
        }

        //$data['tgl'] = $tgl;
        $data['judul'] = 'Tingkat Kesehatan BPR';
        $data ['multilevel'] = $this->usermodel->get_data(0,$this->session->userdata('level'));
        $this->template->set ( 'title', 'Tingkat Kesehatan BPR' );
        $this->template->load ( 'tempDataTable', 'admin/tksBprScore2ResultV',$data );

        //	redirect('tks_bpr_c/tampil_skor');

    }
}

/* End of file angsur_kredit.php */
/* Location: ./application/controllers/angsur_kredit.php */