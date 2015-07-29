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
                <!--<form id="id_form_pindahbuku" role="form" method="post"   action="<?php // echo base_url('tutup_deposito_c/tutup_dep'); ?>">-->
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<h4>Formula</h4>
                            <div class="form-body">
                            	<input type="hidden" id="id_faktor_o" />
                                <input type="hidden" id="id_rasio_o" />
                                <input type="hidden" id="id_komponen_o" />
                                <input type="hidden" id="nm_komponen_o" />
                                <input type="hidden" id="id_komponen_perk_o" />
                                <input type="text" id="id_form_kons" />
                            	<div class="form-group">
                                    <table class='table table-striped table-bordered table-hover' id="tabel_rasio">
                                        <thead>
                                          <tr>
                                            <th style="display:none;"></th>
                                            <th style="display:none;"></th>
                                            <th style="display:none;"></th>
                                             <th width='30%' align='left'>Faktor</th>
                                             <th width='30%' align='left'>Rasio</th>
                                             
                                             <th width='20%' align='left'>Komponen</th>
                                             <th width='10%' align='left'>Aksi</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                           foreach($tampil_faktor->result() as $row){
                                              ?>
                                              <tr  class="listrasio">
                                                <td style="display:none;"><?php echo $row->id_faktor;?></td>
                                                <td style="display:none;"><?php echo $row->id_rasio;?></td>
                                                <td style="display:none;"><?php echo $row->id_komponen_master;?></td>
                                                 <td><?php echo $row->nama_faktor;?></td>
                                                 <td><?php echo $row->nama_rasio;?></td>
                                                 
                                                 <td><?php echo $row->nama_komponen;?></td>
                                                 <td><a href="#" class="btn green" data-target="#list_komponen" data-toggle="modal">
                                                      <span class="glyphicon glyphicon-edit"></span>
                                                  </a></td>
                                              </tr>
                                              <?php
                                           }
                                          ?>
                                       </tbody>
                                 </table>
                                </div>
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <div class="form-body">
                            	<h4>Konstanta</h4>
                                <table class='table table-striped table-bordered table-hover' id="tabel_konstanta">
                                        <thead>
                                          <tr>
                                             <th width='2%' align='left'>No</th>
                                             <th width='20%' align='left'>Nama konstanta</th>
                                             <th width='20%' align='left'>Kode Perk</th>
                                             <th width='30%' align='left'>Nama Perk</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                           foreach($tampil_konstanta->result() as $row){
                                          ?>
                                              <tr  class="list_konstanta">
                                                <td><?php echo $row->id_konsperk;?></td>
                                                 <td><?php echo $row->nama_kons;?></td>
                                                 <td>
												 	<div class="input-group">
                                                    	<input type="text" name="kode_perk" placeholder="Kode Perk" 
                                                        value="<?php echo $row->kode_perk;?>" class="form-control" />
                                                 			<span class="input-group-btn">
                                                  				<a href="#" id="add_perk_2" class="btn green" 
                                                                data-target="#GL_2" data-toggle="modal" >
                                                      				<span class="glyphicon glyphicon-search"></span>
                                                  				</a>
                                                  					</span> 
                                            		</div>
                                                 </td>
                                                 
                                                 <td><?php echo $row->nama_perk;?></td>
                                              </tr>
                                          <?php
                                           }
                                          ?>
                                       </tbody>
                                 </table>
                            	  
                                
                            </div>
                            <!-- END FORM BODY-->
                        </div>    
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                       
                    </div>
            	<!--</form>-->    
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

<!-- START LIST KOMPONEN PERKRAAN-->
<div id="list_komponen" class="modal fade"  tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal_1" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Komponen TKS</h4>
            </div>
           <!-- START MODAL BODY-->
            <div class="modal-body">
            	<div class="row">
                	<div class="col-md-6" id="head_komponen">
                    </div>
                    <div class="col-md-6" style="float:right;">
                    	<div style="float:right;">
                    	<a href="#" id="add_perk" class="btn green" data-target="#GL" data-toggle="modal" >
                                                      <span class="glyphicon glyphicon-edit"></span>
                                                  </a>
                                <button class="btn btn-danger" id="sub_perk">-</button>
                                <button class="btn btn-primary" id="btn_refresh"><i class="icon icon-refresh"></i></button>
                        </div>        
                    </div>
                </div>    
            	<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                        	<!--
                            <div class="form-group">
                                <div id="head_komponen"></div>
                            </div>
                            -->
                            <div class="form-group">
                            	<table class='table table-hover' style="" id="tabel_list">
                                  <thead>
                                      <tr>
                                          <th width='30%' align='left' style="display:none;">Id komp perk</th>
                                          <th width='30%' align='center'>
                                              Kode Perk
                                          </th>
                                          <th width='60%' align='center'>
                                              Nama Perk
                                          </th>
                                          <th width='10%' align='center'>
                                              Op
                                          </th>
                                          <th width='30%' align='center'>
                                              Bot Res
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody id="body"></tbody>				
                              </table>
                            </div>
                            <div class="form-group">
                            	
                            </div>
                            
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn red" id="id_button_close_modal">Close</button>
               
            </div>
            
        </div>
    </div>
    
</div>
<!-- END LIST KOMPONEN -->
<!-- /.modal -->
<div id="GL" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal_2" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tabel Perkiraan</h4>
            </div>
           <!-- START MODAL BODY-->
            <div class="modal-body">
                <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                        	<!--
                            <div class="form-group">
                            	<input type="text" class="form-control input-medium " id="kwd_search" placeholder="Cari...">
                            </div>
                            -->
                            <div class="form-group">
                            
                                <table class='table table-hover' id="tabel_perk">
                                  <thead >
                                    <tr>
                                       <th width='10%' align='left'>Kd Perk</th>
                                       <th width='10%' align='left'>Kd Alt</th>
                                       <th width='60%' align='left'>Nama Perk</th>
                                       <th width='20%' align='center'>Type</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                     foreach($perkiraan->result() as $row){
                                        ?>
                                        <tr>
                                           <td><?php echo $row->kode_perk;?></td>
                                           <td><?php echo $row->kode_alt;?></td>
                                           <td><?php echo $row->nama_perk;?></td>
                                           <td><?php echo $row->type;?></td>
                                        </tr>
                                        <?php
                                     }
                                    ?>
                                 </tbody>
                               </table>
                           </div>
                           
                           <div class="form-group" style="float:right;">
                           		
                                
                           </div>
                           
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                    <div class="row">
                        <div class="col-md-4">
                        	Bobot resiko :
                            	<input type="text" class="form-control span1 nomor" id="id_bobot_resiko" value="100.00" style=" width:80px; float:right; text-align:right;">
                        </div>
                        <div class="col-md-4">
                        	Operasi : 
                            	<input type="text" class="form-control span1" id="pos_neg" value="+" style="width:35px; float:right; ">
                        </div>
                    </div>    
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn red" id="id_button_close_modal">Close</button>
               
            </div>
            
        </div>
    </div>
</div>
<!--  END MODAL-->
<!-- /.modal -->
<div id="GL_2" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal_3" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tabel Perkiraan</h4>
            </div>
           <!-- START MODAL BODY-->
            <div class="modal-body">
                <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                            
                                <table class='table table-hover' id="tabel_perk_2">
                                  <thead >
                                    <tr>
                                       <th width='10%' align='left'>Kd Perk</th>
                                       
                                       <th width='60%' align='left'>Nama Perk</th>
                                       <th width='20%' align='center'>Type</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody_perkiraan_2">
                                 </tbody>
                               </table>
                           </div>
                           
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                       
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn red" id="id_button_close_modal_4">Close</button>
               
            </div>
            
        </div>
    </div>
</div>
<!--  END MODAL-->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php //echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php //echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery-1.11.0.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate-1.2.1.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js'); ?>" type="text/javascript"></script>
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
	<!-- BEGIN DATATABLE PLUGINS -->
    <script src="<?php // echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
	<!-- END DATATABLE PLUGINS -->
<!-- END PAGE LEVEL SCRIPTS -->
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
   Index.initIntro();
   TableManaged.init();
 });
//alert("y");
var TableManaged = function () {

    var initTable1 = function () {
        var table = $('#tabel_perk');
        // begin first table
        table.dataTable({
            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#tabel_perk_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }
	/*
	var initTable2 = function () {
        var table = $('#tabel_perk_2');
        // begin first table
        table.dataTable({
            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#tabel_perk_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }
	*/
    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
		//	initTable2();
        }

    };

}();
</script>
<script type="text/javascript">
		$(document).ready(function(){
			//$('#list_komponen').window('close');
			//$('#GL').window('close');
			// MENU OPEN
			$(".menu_root").removeClass('start active open');
			$("#menu_root_8").addClass('start active open');
			// END MENU OPEN
			//$('.nomor').val('0.00');
			$(".nomor").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$(".nomor").focus(function(){
				if (($(this).val() == '') || ($(this).val() == 0)) { 
				   $(this).val('');
				 }
					$(this).focus();
			});
			
			$("#tabel_rasio tbody tr").click(function(){
				$(".listrasio").removeClass('alert alert-info');
				$(this).addClass('alert alert-info');
				
				var id_faktor = $(this).find("td").eq(0).html();
				$('#id_faktor_o').val(id_faktor);
				var id_rasio= $(this).find("td").eq(1).html();
				$('#id_rasio_o').val(id_rasio);
				var id_komponen_master = $(this).find("td").eq(2).html();
				$('#id_komponen_o').val(id_komponen_master);
				var nama_komponen = $(this).find("td").eq(5).html();
				$('#nm_komponen_o').val(nama_komponen);
				
				cari_komponen(id_komponen_master);
				var head_komponen = "<h4>"+$('#nm_komponen_o').val()+"</h4>";
				$('#head_komponen').html(head_komponen);
				$('#id_form_kons').val(1);
			});
		});
		$("#sub_perk").click(function(){
			hapus_komp_perk();
			var id_komponen_master = $("#id_komponen_o").val();
			cari_komponen(id_komponen_master);
		});
		$("#btn_refresh").click(function(){
			var id_komponen_master = $("#id_komponen_o").val();
			cari_komponen(id_komponen_master);
		});
		function hapus_komp_perk(){
			var id_komponen_perk = $("#id_komponen_perk_o").val();
			//var id_komponen_master = $("#id_komponen_o").val();
			//alert(id_komponen_master); 
			$.post("<?php echo site_url('/tks_bprs_c/hapus_komponen_perk'); ?>",{
						  'id_komp_perk' : id_komponen_perk
			  },function(data){
				 // var id_komponen_master = $("#id_komponen_o").val();
				 //  alert("x");
				   //cari_komponen(id_komponen_master);
					
			  },"json");
		}
		
		function cari_komponen(id_komponen){
			var id_komponen;
			var item;
			item=id_komponen.trim();
			  if (item!=''){
				$.post("<?php echo site_url('/tks_bprs_c/proses_cari_komponen_perk'); ?>",{'item':item},
				function(data){
					$('#body').empty();
					var tr="";
					for (var i = 0; i < data.norek.length; i++) {
						 z=(data.norek[i].id_komp_perk).trim();
						 a=(data.norek[i].kode_perk).trim();
						 b=(data.norek[i].nama_perk).trim();
						 c=(data.norek[i].op).trim();
						 d=(data.norek[i].bot_res).trim();
						tr = '<tr class="listdata">';
						tr+='<td style="display:none;">'+z+'</td>'+'<td>'+a+'</td>'+'<td>'+b+'</td>'+'<td>'+c+'</td>'+'<td>'+d+'</td>';
						tr+= '</tr>';
						$('#body').append(tr);
					}
					
					$("#tabel_list tbody tr").click(function(){	
						$(".listdata").removeClass('alert alert-info');
						$(this).addClass('alert alert-info');
						
						var id_komp_perk = $(this).find("td").eq(0).html();
						var kdperk = $(this).find("td").eq(1).html();
						var tipe = $(this).find("td").eq(2).html();
						
						$('#id_komponen_perk_o').val(id_komp_perk);
					});
				},"json");
			  }//if kd<>''
			}//function cari_komponen(){
			
			
			$(document).keyup(function(e) {
				if(e.which == 120) {
					$('#add_perk').trigger('click');
					//$("#add_perk").click(function()
				}
			});
			$("#tabel_perk tbody tr").click(function(){	
				var kdperk = $(this).find("td").eq(0).html();
				var tipe = $(this).find("td").eq(3).html();
				
				//alert(tipe);
				if(tipe=='G'){
					alert("Kode induk tidak dapat dipilih.");
				}else{
					insert_komponen(kdperk);
					$('#id_button_close_modal_2').trigger('click');
					var id_komponen = $('#id_komponen_o').val();
					cari_komponen(id_komponen);
				}
				
			});
			function insert_komponen(kode_perk){
			  var id_faktor = $('#id_faktor_o').val();
			  var id_rasio = $('#id_rasio_o').val();
			  var id_komponen = $('#id_komponen_o').val();
			  var nm_komponen = $('#nm_komponen_o').val();
			  var pos_neg = $('#pos_neg').val();
			  var bobot_resiko = $('#id_bobot_resiko').val();
			 // alert(bobot_resiko);
			  var id_form_kons=$('#id_form_kons').val();  
			  if (id_form_kons==1){
				  var kode_perk;
				  kode_perk=kode_perk.trim();
				  if (kode_perk!=''){
					$.post("<?php echo site_url('/tks_bprs_c/insert_komponen_perk'); ?>",{
						'kd_perk':kode_perk,
						'id_f':id_faktor,
						'id_r':id_rasio,
						'id_k':id_komponen,
						'pos_neg' : pos_neg,
						'bot_res' : bobot_resiko
						},
					function(data){
						//alert("angga");
					},"json");
				  }//if kd<>''
			  }else{//if (id_form_kons==1){
			  }
			}//function insert komponen(){

		
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
		/*
		daftar_perk();	
			function daftar_perk(){
			item='';
			 
				$.post("<?php echo site_url('/tks_bpr_c/daftar_perk'); ?>",{'item':item},
				function(data){
					//alert("x");
					$('#tbody_perkiraan_2').empty();
					var tr="";
					for (var i = 0; i < data.norek.length; i++) {
						 a=(data.norek[i].kode_perk).trim();
						 b=(data.norek[i].nama_perk).trim();
						 c=(data.norek[i].type).trim();
						
						 tr = '<tr>';
						tr+='<td>'+a+'</td>'+'<td>'+b+'</td>'+'<td>'+c+'</td>';
						tr+= '</tr>';
						$('#tbody_perkiraan_2').append(tr);
					}
					
				},"json");
			 
			}//function daftar_perk(){	
			*/
	</script>