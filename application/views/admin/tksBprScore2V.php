<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
<div class="col-md-6">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption">
        <i class="icon-pin"></i>
        <span class="caption-subject bold uppercase"> TKS Score</span>
    </div>
    <div class="tools">
        <a href="" class="collapse">
        </a>
    </div>
</div>
<div class="portlet-body form">
    <form role="form" action="<?php echo base_url('tksBpr/score/'); ?>" method="post">
        <div class="form-body">
            <div class="form-group">
                <label>Tanggal</label>
                <div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</span>
                    <input name="txtTanggal" class="form-control form-control-inline input-medium date-picker" size="16" type="text"  data-date-format="dd-mm-yyyy"  value=""/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" name="btnTampil" class="btn blue">Submit</button>
            <button type="button" class="btn default">Cancel</button>
        </div>
    </form>
</div>
</div>
<!-- END SAMPLE FORM PORTLET-->

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
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN DATATABLE PLUGINS -->
<script src="<?php  echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php  echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php  echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"  type="text/javascript"></script>
<!-- END DATATABLE PLUGINS -->
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/pages/scripts/components-pickers.js'); ?>"></script>

<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
<script>

    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        ComponentsPickers.init();
    });

</script>

<script type="text/javascript">
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_9").addClass('start active open');
    // END MENU OPEN
    $('#txtTanggal').focus();
    $('.nomor').val('0.00');
    $(".nomor").focus(function () {
        $(this).val('');
    });
    $(".nomor").focusout(function () {
        if ($(this).val() == '') {
            $(this).val('0.00');

        } else {
            var angka = $('.nomor').val();
            var result = number_format(angka, 2);
            $('.nomor').val(result);
        }
    });

    $(document).ajaxStart(function () {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function () {
        $('.modal_json').fadeOut('fast');
    });
    $('.nomor').keyup(function () {
        var val = $(this).val();
        //val=val.toFixed(2);
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
    });	// END $('.nomor').keyup(function(){
    // jQuery expression for case-insensitive filter

</script>
</div>	