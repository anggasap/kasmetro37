<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

	<legend >&nbsp;<?php echo $judul; ?></legend>
    <?php // echo $kpmm_modal; ?>
    <?php // echo $kpmm_atmr; ?>
    <table class='table table-hover'>
      <thead class="">
          <tr>
              <th width='30%' align='left'>NAMA RASIO</th>
              <th width='40%' align='center'>
                  JENIS RASIO
              </th>
              <th width='60%' align='center'>
                  NILAI RASIO
              </th>
          </tr>
      </thead>
      <tbody>
      <tr><td>KPMM</td><td>Utama</td><td><?php echo number_format($kpmm,2); ?></td></tr>
      <tr><td>Rasio EARNING ASSET QUALITY</td><td>Utama</td><td><?php echo number_format($kap_eaq,2); ?></td></tr>
      <tr><td>Rasio Efisiensi Operasi</td><td>Utama</td><td><?php echo number_format($ren1,2); ?></td></tr>
      <tr><td>Rasio ROA</td><td>Observasi</td><td><?php echo number_format($roa,2); ?></td></tr>
      <tr><td>Rasio ROE</td><td>Observasi</td><td><?php echo number_format($roe,2); ?></td></tr>
      <tr><td>Rasio Cash</td><td>Utama</td><td><?php echo number_format($cr,2); ?></td></tr>
      </tbody>				
  </table>

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
	$("#menu_root_8").addClass('start active open');
	// END MENU OPEN
	
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>
