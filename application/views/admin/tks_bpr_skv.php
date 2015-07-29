	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> <?php echo $judul; ?>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form id="form_tks_bprs" role="form" method="post"   action="<?php echo base_url('tks_bpr_c/tampil_skor'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                            <div class="form-body">
                            	<div class="form-group">
                                    <label>Tanggal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input name="txtTanggal" id="txtTanggal" class="form-control form-control-inline input-medium date-picker " data-date-format="dd-mm-yyyy" type="text" placeholder="dd-mm-yyyy" required="required"/>
                                    </div>
                                </div>
                            	
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-4">
                            <div class="form-body">
                            	<div class="form-group">
                                    <label>Pajak :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-dollar"></i>
                                        </span>
                                        <input name="txtPajak" id="txtPajak" class="nomor form-control"  type="text" placeholder="" required="required" style="text-align:right;"/>
                                    </div>
                                </div>
                            	  
                                
                            </div>
                            <!-- END FORM BODY-->
                        </div>    
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" id="btnTampil" name="btnTampil"><span class="glyphicon glyphicon-play"></span> Tampilkan</button>               
       					<a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
       						<span class="glyphicon glyphicon-repeat"></span>  Reset
       					</a>
       					
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
			$('#txtTanggal').focus();
			$('.nomor').val('0.00');
			$(".nomor").focus(function(){
				$(this).val('');
			});
			$(".nomor").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   
				}else{
					var angka = $('.nomor').val(); 
					var result = number_format(angka,2);
					$('.nomor').val(result);
				}
			});	
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		$('.nomor').keyup(function(){
			var val = $(this).val();
			//val=val.toFixed(2);
			if(isNaN(val)){
				 val = val.replace(/[^0-9\.]/g,'');
				 if(val.split('.').length>2) 
					 val =val.replace(/\.+$/,"");
			}
			$(this).val(val); 
		});	// END $('.nomor').keyup(function(){
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>
</div>	