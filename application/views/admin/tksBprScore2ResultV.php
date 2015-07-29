<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
    <div class="col-md-8">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-pin"></i>
                    <span class="caption-subject bold uppercase"> <?php echo $judul; ?> per <?php echo $tgl; ?></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <table class='table table-hover'>
                    <thead class="">
                    <tr>
                        <th width='40%' align='left'>FAKTOR</th>
                        <th width='20%' align='center'>
                            KOMPONEN
                        </th>
                        <th width='20%' align='center'>
                            NILAI RASIO
                        </th>
                        <th width='40%' align='center'>
                            POSISI
                        </th>
                        <th width='40%' align='center'>
                            PREDIKAT
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Permodalan</td>
                        <td>Modal</td>
                        <td align="right" ><?php echo number_format($jmlModal,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($CAR,2); ?></td>
                        <td valign="middle"><?php echo $predikatCAR; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>ATMR</td>
                        <td align="right" rowspan="" ><?php echo number_format($totalATMR,2); ?></td>
                    </tr>
                    <tr>
                        <td>Likuiditas </td>
                        <td>Alat Likuid</td>
                        <td align="right" ><?php echo number_format($alatLikuid,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($LIKUIDITAS,2); ?></td>
                        <td valign="middle"><?php echo $predikatLIKUIDITAS; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hutang Lancar</td>
                        <td align="right" ><?php echo number_format($hutangLancar,2); ?></td>
                    </tr>
                    <tr>
                        <td>LDR</td>
                        <td>KYD</td>
                        <td align="right" ><?php echo number_format($saldoKYD,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($LDR,2); ?></td>
                        <td valign="middle"><?php echo $predikatLDR; ?></td>
                    </tr>
                    <tr><td></td><td>Modal Inti</td><td align="right" ><?php echo number_format($DanaPihak3modalInti,2); ?></td></tr>
                    <tr>
                        <td>KAP</td>
                        <td>KAP</td>
                        <td align="right" ><?php echo number_format($totalKAP,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($KAP,2); ?></td>
                        <td valign="middle"><?php echo $predikatKAP; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Aktiva Produktif</td>
                        <td align="right" ><?php echo number_format($totalAP,2); ?></td>
                    </tr>
                    <tr>
                        <td>PPAP</td>
                        <td>PPAP</td>
                        <td align="right" ><?php echo number_format($saldoPPAP,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($PPAP,2); ?></td>
                        <td valign="middle"><?php echo $predikatPPAP; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>PPAPWD</td>
                        <td align="right" ><?php echo number_format($totalPPAPWD,2); ?></td>
                    </tr>
                    <tr>
                        <td>Rentabilitas (ROA)</td>
                        <td>LR sblm Pajak</td>
                        <td align="right" ><?php echo number_format($saldoLRTL,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($ROA,2); ?></td>
                        <td valign="middle"><?php echo $predikatROA; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Rata-rata aset</td>
                        <td align="right" ><?php echo number_format($rataAsset,2); ?></td>
                    </tr>
                    <tr>
                        <td>Rentabilitas (BOPO)</td>
                        <td>BO</td>
                        <td align="right" ><?php echo number_format($saldoBO,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($BOPO,2); ?></td>
                        <td valign="middle"><?php echo $predikatBOPO; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>PO</td>
                        <td align="right" ><?php echo number_format($saldoPO,2); ?></td>
                    </tr>
                    <tr>
                        <td>NPL</td>
                        <td>NPL</td>
                        <td align="right" ><?php echo number_format($saldoNPL,2); ?></td>
                        <td align="right" valign="middle"><?php echo number_format($NPL,2); ?></td>
                        <td valign="middle"><?php echo $predikatNPL; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>KYD</td>
                        <td align="right" ><?php echo number_format($saldoKYD,2); ?></td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>



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
    });
</script>

<script type="text/javascript">
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_9").addClass('start active open');
    // END MENU OPEN

    $(document).ajaxStart(function() {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function() {
        $('.modal_json').fadeOut('fast');
    });

</script>
