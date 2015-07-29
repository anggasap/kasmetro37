<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

	<legend >&nbsp;<?php echo $judul; ?></legend>
    <?php // echo $kpmm_modal; ?>
    <?php // echo $kpmm_atmr; ?>
    <table class='table table-hover'>
      <thead class="">
          <tr>
              <th width='20%' align='left'>FAKTOR</th>
              <th width='40%' align='center'>
                  KOMPONEN
              </th>
              <th width='30%' align='center'>
                  NILAI RASIO
              </th>
              <th width='30%' align='center'>
                  POSISI
              </th>
          </tr>
      </thead>
      <tbody>
      <tr>
      	<td>Permodalan</td>
        <td>Modal</td>
        <td><?php echo number_format($car_tot_modal,2); ?></td>
        <td colspan="2" align="right" valign="middle"><?php echo number_format($car,2); ?></td>
      </tr>
      <tr>
      	<td></td>
      	<td>ATMR</td>
      	<td><?php echo number_format($car_atmr,2); ?></td>
      </tr>
      <tr>
      	<td>KAP</td>
      	<td>PPAP</td>
        <td><?php echo number_format($kap_ppap,2); ?></td>
      	<td colspan="2" align="right" valign="middle"><?php echo number_format($kap,2); ?></td>
      </tr>
      <tr>
      	<td></td>
        <td>PPAPWD</td>
        <td><?php echo number_format($kap_ppapwd,2); ?></td>
      </tr>
      <tr>
      	<td>Rentabilitas (ROA)</td>
        <td>LR sblm Pajak</td>
        <td><?php echo number_format($roa_lr,2); ?></td>
        <td colspan="2" align="right" valign="middle"><?php echo number_format($roa,2); ?></td>
      </tr>
      <tr>
      	<td></td>
        <td>Rata-rata aset</td>
        <td><?php echo number_format($roa_aset,2); ?></td>
      </tr>
      <tr>
      	<td>Rentabilitas (BOPO)</td>
        <td>BO</td>
        <td><?php echo number_format($ren_bo,2); ?></td>
      	<td colspan="2" align="right" valign="middle"><?php echo number_format($ren1,2); ?></td>
      </tr>
      <tr>
      	<td></td>
        <td>PO</td>
        <td><?php echo number_format($ren_po,2); ?></td>
      </tr>
      <tr>
      	<td>Likuiditas </td>
        <td>Alat Likuid</td>
        <td><?php echo number_format($lik_alat_likuid,2); ?></td>
        <td colspan="2" align="right" valign="middle"><?php echo number_format($likuiditas,2); ?></td>
      </tr>
      <tr>
      	<td></td>
        <td>Hutang Lancar</td>
        <td><?php echo number_format($lik_hutang_lancar,2); ?></td>
      </tr>
      <tr>
      	<td>Likuiditas (LDR)</td>
        <td>KYD</td>
        <td><?php echo number_format($ldr_kyd,2); ?></td>
        <td colspan="2" align="right" valign="middle"><?php echo number_format($ldr,2); ?></td>
      </tr>
      <tr><td></td><td>Modal Inti</td><td><?php echo number_format($ldr_modal_inti,2); ?></td></tr>
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
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo base_url('metronic/global/plugins/flot/jquery.flot.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/flot/jquery.flot.resize.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/flot/jquery.flot.categories.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.pulsate.min.js'); ?>" type="text/javascript"></script>

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php //echo base_url('metronic/global/plugins/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<script src="<?php // echo base_url('metronic/global/plugins/gritter/js/jquery.gritter.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/quick-sidebar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/pages/scripts/index.js'); ?>" type="text/javascript"></script>
<script src="<?php // echo base_url('metronic/admin/pages/scripts/tasks.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"  type="text/javascript"></script>

    <!-- BEGIN DATATABLE PLUGINS -->
    <script src="<?php // echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php // echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php  //echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
    <!-- END DATATABLE PLUGINS -->
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/quick-sidebar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('metronic/admin/pages/scripts/components-pickers.js'); ?>"></script>
<script src="<?php // echo base_url('bootstrap/js/pagination.js') ?>"></script> 
<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script> 
<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
<script src="<?php //echo base_url('bootstrap/js/paging.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
<script>

jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
  // Index.initDashboardDaterange();
//   Index.initJQVMAP(); // init index page's custom scripts
  // Index.initCalendar(); // init index page's custom scripts
  // Index.initCharts(); // init index page's custom scripts
  // Index.initChat();
  // Index.initMiniCharts();
   Index.initIntro();
   ComponentsPickers.init();

//   TableManaged.init();
 //  Tasks.initDashboardWidget();

});
//alert("y");
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
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>
