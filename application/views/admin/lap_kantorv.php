<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i><?php echo $judul; ?>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                        <!--
                            <div class="btn-group">
                                <button id="sample_editable_1_new" class="btn green">
                                Add New <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        -->    
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                            <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="<?php echo base_url('laporan_kas/cetakpdf/kantor'); ?>" target="_blank">
                                    Print PDF </a>
                                </li>
                                <!--
                                <li>
                                    <a href="#">
                                    Save as PDF </a>
                                </li>
                                
                                <li>
                                    <a href="#">
                                    Export to Excel </a>
                                </li>
                                -->
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr>
                    <th class="table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
                    <th>
                         No
                    </th>
                    <th>
                         Modul
                    </th>
                    <th>
                         No. bukti
                    </th>
                    <th>
                         Uraian
                    </th>
                    <th>
                         TOB
                    </th>
                    <th>
                    	OB Debet
                    </th>
            		<th>
                    	OB Kredit
                    </th>
            		<th>
                    	T Debet
                    </th>
            		<th>
                    	T Kredit
                    </th>
                </tr>
                </thead>
              	<tbody>
<?php
$i=1;
$st200=0;
$st300=0;
$so200=0;
$so300=0;
			
				   foreach($data_kas->result() as $row)
				   {
				      ?>
				      <tr>
                      <td>
									<input type="checkbox" class="checkboxes" value="1"/>
								</td>
                      	 <td><?php echo $i; $i++; ?></td>
				         <td><?php echo $row->modul;?></td>
				         <td><?php echo $row->NO_BUKTI;?></td>
				         <td><?php echo $row->uraian;?></td>
                         <td><?php echo $row->tob;?></td>
                         
                         <?php			 
						 if(($row->my_kode_trans==200) && ($row->tob=='O')){
						 ?>
                         <td align="right"><?php echo number_format($row->saldo_trans,2); $so200=$so200+$row->saldo_trans; ?></td>
				         <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                         <?php
						 }else if(($row->my_kode_trans==300) && ($row->tob=='O')){
						 ?>
                         <td>&nbsp;</td>
				         <td align="right"><?php echo number_format($row->saldo_trans,2); $so300=$so300+$row->saldo_trans;?></td>
                         <td>&nbsp;</td><td>&nbsp;</td>
                         <?php
						 }else if(($row->my_kode_trans==200) && ($row->tob=='T')){
						 ?>
                         <td>&nbsp;</td><td>&nbsp;</td>
				         <td align="right"><?php echo number_format($row->saldo_trans,2); $st200=$st200+$row->saldo_trans;?></td>
                         <td>&nbsp;</td>
                         <?php
						 }else if(($row->my_kode_trans==300) && ($row->tob=='T')){
						 ?>
                         <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				         <td align="right"><?php echo number_format($row->saldo_trans,2); $st300=$st300+$row->saldo_trans;?></td>
                         
                         <?php
						 }
						 ?>
				      </tr>
				      <?php
				   }
				   
				  ?>            
            	</tbody>
            <tfoot>
            <tr>
            <td colspan="6">Total</td>
            <td align="right"><?php echo number_format($so200,2); ?></td>
            <td align="right"><?php echo number_format($so300,2); ?></td>
            <td align="right"><?php echo number_format($st200,2); ?></td>
            <td align="right"><?php echo number_format($st300,2); ?></td>
            </tr>
            
            </tfoot>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
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
        TableManaged.init();
    });
</script>
<script>
// MENU OPEN
	$(".menu_root").removeClass('start active open');
	$("#menu_root_7").addClass('start active open');
	// END MENU OPEN

var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#sample_1');

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
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }, {
                "orderable": false
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

        var tableWrapper = jQuery('#sample_1_wrapper');

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


    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
            //initTable2();
            //initTable3();
        }

    };

}();
</script>