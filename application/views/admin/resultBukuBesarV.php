<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-pin"></i>
                    <span class="caption-subject bold uppercase">Buku Besar </span>
                    <span class="caption-helper"><?php echo $namaPerk.' ('.$kodePerk.') Periode '.$tgl1." Sampai dengan ".$tgl2; ?></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="25%" align="center">Tanggal</th>
                        <th width="30%" align="center">Keterangan</th>
                        <th width="15%" align="center">Debet</th>
                        <th width="15%" align="center">Kredit</th>
                        <th width="15%" align="center">Saldo</th>
                    </tr>
                    </thead>
                    <?php
                    $totDebet   = 0;
                    $totKredit  = 0;
                    $totSaldoAkhir  = $saldoAwalBB;
                    echo '<tr>';
                    echo '<td colspan="4" align="center"><strong>Saldo Awal</strong></td>';
                    echo '<td  align="right"><strong>'.number_format($totSaldoAkhir,2).'</strong></td>';
                    echo '</tr>';
                    foreach($saldobukubesar->result() as $data){

                        /*if($data['type']=='G'){
                            $nama_perk="<strong>".$data['nama']."</strong>";
                            if($data['saldo']<0){
                                $saldo_perk="<strong>(".abs(number_format($data['saldo'],2)).")</strong>";
                            }else{
                                $saldo_perk="<strong>".number_format($data['saldo'],2)."</strong>";
                            }
                        }else{
                            $nama_perk=$data['nama'];
                            if($data['saldo']<0){
                                $saldo_perk="(".abs(number_format($data['saldo'],2)).")";
                            }else{
                                $saldo_perk=number_format($data['saldo'],2);
                            }
                        }*/
                        $timestamp      = strtotime($data->tgl_trans);
                        $tglTrans       = date('d-m-Y', $timestamp);
                        $totDebet       = $totDebet + $data->debet;
                        $totKredit      = $totKredit + $data->kredit;
                        $totSaldoAkhir  = $totSaldoAkhir + $data->saldo_akhir;

                        echo '<tr>';
                        echo '<td>'.$tglTrans.'</td>';
                        echo '<td >Total Mutasi</td>';
                        echo '<td  align="right">'.number_format($data->debet,2).'</td>';
                        echo '<td  align="right">'.number_format($data->kredit,2).'</td>';
                        echo '<td  align="right">'.number_format($totSaldoAkhir,2).'</td>';
                        echo '</tr>' ;

                    }

                    echo '<tr>';
                    echo '<td colspan="2"><strong>Total jumlah '.$namaPerk.'</strong></td>';
                    echo '<td  align="right"><strong>'.number_format($totDebet,2).'</strong></td>';
                    echo '<td  align="right"><strong>'.number_format($totKredit,2).'</strong></td>';
                    echo '<td  align="right"><strong>'.number_format($totSaldoAkhir,2).'</strong></td>';
                    echo '</tr>';
                    ?>
                </table>

            </div>
        </div>

    </div>
</div>

<!-- /.modal -->

<!--  END MODAL-->



<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php //echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php //echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>"
        type="text/javascript"></script>
<script
    src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>"
    type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN DATATABLE PLUGINS -->
<script src="<?php echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"
        type="text/javascript"></script>
<!-- END DATATABLE PLUGINS -->

<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
<script>

    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Demo.init(); // init demo features
        TableManaged.init();
    });
</script>

<script type="text/javascript">
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_11").addClass('start active open');

    $(document).keyup(function(e) {
        if(e.which == 36) {
            $('#idBtnGL').trigger('click');
        }else if(e.which == 34) {
            $('#idBtnAddPerk').trigger('click');
        }
    });
// END MENU OPEN

    /*$(document).ajaxStart(function() {
     $('.modal_json').fadeIn('fast');
     }).ajaxStop(function() {
     $('.modal_json').fadeOut('fast');
     });*/

</script>
