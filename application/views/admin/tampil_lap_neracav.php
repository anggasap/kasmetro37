<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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
                <!-- START DIV CLASS ROW FOR SIZE 6 -->
                    <div class="row">
                        <div class="col-md-6">
                            <h4></h4>
                            <div class="form-body">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:300px;" align="center">AKTIVA</th>
                                        <th style="width:200px;" align="center">RUPIAH</th>
                                    </tr>
                                </thead>
                                <?php
									foreach($multilevel_neraca_aktiva as $data){
										
										if($data['type']=='G'){
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
										}
									
									echo '<tr><td>'.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>' ;
									echo print_recursive_neraca_aktiva($data['child']);
									
									}
								?>
                                </table>
                              
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <h4></h4>
                            <div class="form-body">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:300px;" align="center">PASIVA</th>
                                        <th style="width:200px;" align="center">RUPIAH</th>
                                    </tr>
                                </thead>
                                <?php
									foreach($multilevel_neraca_pasiva as $data){
										if($data['type']=='G'){
											$nama_perk="<strong>".$data['nama']."</strong>";
											if($data['saldo']<0){
												$saldo_perk="<strong>(".number_format(abs($data['saldo']),2).")</strong>";
											}else{
												$saldo_perk="<strong>".number_format($data['saldo'],2)."</strong>";
											}
										}else{
											$nama_perk=$data['nama'];
											if($data['saldo']<0){
												$saldo_perk="(".number_format(abs($data['saldo']),2).")";
											}else{
												$saldo_perk=number_format($data['saldo'],2);
											}
										}
									
									echo '<tr><td>'.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>' ;
									echo print_recursive_neraca_pasiva($data['child']);
									
									}
								?>
                                </table>
                              
                            </div>    
                        </div><!-- <div class="col-md-6"> -->   
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <!-- START DIV CLASS ROW FOR SIZE 6 -->
                    <div class="row">
                        <div class="col-md-6">
                            <h4></h4>
                            <div class="form-body">
                            	<table class="table">
                                	<tr>
                                        <td style="width:300px;">&nbsp;</td>
                                        <td style="width:200px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="width:300px;"><strong>TOTAL AKTIVA</strong></td>
                                        <td style="width:200px; text-align:right">
                                        
										<?php 
										$total_aktiva = $total_aktiva[0]->total_aktiva; 
										if($total_aktiva<0){
											$total_aktiva="(".number_format(abs($total_aktiva),2).")";
											echo $total_aktiva;
										}else{
											$total_aktiva=number_format($total_aktiva,2);
											echo "<strong>".$total_aktiva."</strong>";
										}
										?>
                                        
                                        </td>
                                    </tr>
                                	
                                </table>
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <h4></h4>
                            <div class="form-body">
                            	<?php 
									$tot_psv = $total_pasiva[0]->total_pasiva;
									$tot_mdl = $total_modal[0]->total_modal;
									$lbrg_bjln = $laba_rugi_berjalan[0]->lbrg_berjalan;
								?>
                                <table class="table">
                                    <tr>
                                        <td style="width:300px;"><strong>LABA TAHUN BERJALAN</strong></td>
                                        <td style="width:200px; text-align:right">
                                        
										<?php 
										$lbrg_bjln = $laba_rugi_berjalan[0]->lbrg_berjalan; 
										if($lbrg_bjln<0){
											$lbrg_bjln="(".number_format(abs($lbrg_bjln),2).")";
											echo $lbrg_bjln;
										}else{
											$lbrg_bjln=number_format($lbrg_bjln,2);
											echo "<strong>".$lbrg_bjln."</strong>";
										}
										?>
                                        
                                        </td>
                                    </tr>
                                	<tr>
                                    	<td><strong>TOTAL PASIVA</strong></td>
                                        <td style="text-align:right">
                                        <?php
										$total_pasiva= $total_pasiva[0]->total_pasiva + $total_modal[0]->total_modal + $laba_rugi_berjalan[0]->lbrg_berjalan;
										if($total_pasiva<0){
											$total_pasiva="(".number_format(abs($total_pasiva),2).")";
											echo $total_pasiva;
										}else{
											//echo $tot_psv." ".$tot_mdl." ".$lbrg_bjln." ";
											$total_pasiva=number_format($total_pasiva,2);
											echo "<strong>".$total_pasiva."</strong>";
										}
										?>
                                        </td>
                                    </tr>
                                </table>
                            </div>    
                        </div><!-- <div class="col-md-6"> -->   
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                    </div>
                 
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
$(".menu_root").removeClass('start active open');
	$("#menu_root_7").addClass('start active open');
//alert("y");
</script>