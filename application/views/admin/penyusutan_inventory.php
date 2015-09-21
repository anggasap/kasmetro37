<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

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
<form id="FormInventaris" role="form" class="" method="post" action="">
<div class="col-md-6">
	<div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>No. Referensi :</label>
                    <div class="input-group">
						<span class="input-group-addon">
						<i class="fa fa-user"></i>
						</span>
						
						<input id="noref" name="noref" type="text" placeholder="Nomor Referensi"
                               class="form-control bersih input-medium" required="true" readonly="true">
                        <span class="input-group-btn">
						  <a href="#" class="btn green" data-target="#idDivTabelRekTab"
							 data-toggle="modal">
							  <span class="glyphicon glyphicon-search"></span>
						  </a>
						</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label>Deskripsi referensi :</label>
                    <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-tag"></i>
                                    </span>
                        <input id="desref" name="desref" type="text" placeholder="Deskripsi Referensi"
                               class="form-control bersih" required="true" readonly="true">
							   <input id="trans_id" name="trans_id" type="hidden" required="true">
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label>Cabang :</label>
            <div class="input-group">
				<span class="input-group-addon">
				<i class="fa fa-user"></i>
				</span>
				<input id="cabang" name="cabang" type="text" placeholder="Cabang"
                               class="form-control bersih input-medium" required="true" readonly="true">	
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-body">
		<div class="form-group">
            <label>Tanggal Transaksi :</label>
            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </span>
                <input id="tanggal" name="tanggal" type="tanggal" placeholder="Tanggal Transaksi"
                       class="form-control bersih input-medium" readonly="true" >
            </div>
        </div>
		<div class="form-group">
            <label>Nilai Penyusutan:</label>
            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                <input id="nilai" name="nilai" type="nilai" placeholder="Nilai Penyusutan"
                       class="form-control nomor input-medium" readonly="true">
            </div>
        </div>
		<div class="form-group">
            <label>Penyusutan ke :</label>
            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-briefcase"></i>
                                    </span>
                <input id="penyusutan" name="penyusutan" placeholder="Penyusutan Ke"
                       class="form-control nomor2 input-small" readonly="true">
            </div>
        </div>
		
	<!-- END FORM BODY-->
	
	</div>
</div>
<!-- END DIV CLASS ROW FOR SIZE 6 -->
<div class="col-md-12">
	<div class="form-body">
		<div class="form-actions">
			<button type="submit" name="btnSimpan" class="btn blue" id="btnSimpan"><span
					class="glyphicon glyphicon-floppy-disk"></span> Susutkan
			</button>
			<a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
				<span class="glyphicon glyphicon-repeat"></span> Reset
			</a>
		</div>
	</div>
</div>
</div>
</form>
</div>
<!-- END SAMPLE FORM PORTLET-->
</div>
</div>
<style>
    .text_kanan td:nth-child(4) {
        text-align:right !important;
    }
</style>

<!-- /.modal -->
<div id="idDivTabelRekTab" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Jadwal Penyusutan</h4>
            </div>
                <div class="modal-body">
                    <div class="scroller" style="height:400px; ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelInv">
                                        <thead>
                                        <tr>
                                            <th>
                                                ID Transaksi
                                            </th>
                                            <th>
                                                No. Referensi
                                            </th>
                                            <th>
                                                Nilai
                                            </th>
                                            <th>
                                                Cabang
                                            </th>
											<th>
                                                Tanggal
                                            </th>
											<th>
                                                Penyusutan Ke -
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
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
                    <button type="button" data-dismiss="modal" class="btn default">Batal</button>
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
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"
        type="text/javascript"></script>		
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>"
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
<!--
<script src="<?php echo base_url('metronic/global/scripts/pembantu.js') ?>"></script>
<script src="<?php echo base_url('metronic/global/scripts/terbilang.js') ?>"></script>
<script src="<?php echo base_url('metronic/global/scripts/moment.js') ?>"></script> -->
<script src="<?php echo base_url('metronic/global/scripts/php_number_format.js') ?>"></script>
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
$("#menu_root_12").addClass('start active open');
// END MENU OPEN
	$('#tanggal').datepicker({
		format: 'yyyy-mm-dd'
	})
	$(".nomor").focusout(function(){
					var angka =$(this).val();
					if (angka==""){
						$('#nilai').val('');
					}else{
						$(this).val(number_format(angka,2));
					}					
	});
	
	$("#nilai").focus(function(){
					$(this).val('');	
	});
	
	$(".nomor").keypress(function (e){
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
				//$("#errmsg").html("Digits Only").show().fadeOut("slow");
			return false;
		}
	});
	
	$(".nomor2").keypress(function (e){
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
				//$("#errmsg").html("Digits Only").show().fadeOut("slow");
			return false;
		}
	});	
var TableManaged = function () {
    var initTable1 = function () {
        var table = $('#idTabelInv');
        // begin first table
        table.dataTable({
            "ajax": "<?php echo base_url("/master_inventory/get_jadwal"); ?>",
            "columns": [
                { "data": "transid" },
                { "data": "noref" },
                { "data": "jmlpenyusutan" },
                { "data": "cab" },
				{ "data": "tanggal" },
				{ "data": "susutke" }
            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


            "lengthMenu": [
                [5, 10,15, 20, -1],
                [5, 10,15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "Cari: ",
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "aaSorting": [[0,'asc']/*, [5,'desc']*/],
            "columnDefs": [{  // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#example_wrapper');

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
        table.on('click', 'tbody tr', function () {
            var transid = $(this).find("td").eq(0).html();
            $('#id_button_close_modal').trigger('click');
			
			//alert(transid);
            getDeskripsiInv(transid);
			//$('#txtRekTab').focus();
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
        }
    };
}();

function getDeskripsiInv(transid){
    var kd = transid;
    if (kd != '') {
        //  alert(kd);
        $.post("<?php echo site_url('/master_inventory/get_deskripsi_susut'); ?>",
            {
                'transid': kd
            },
            function (data) {
				if (data.baris == 1) {
                    var nilai = number_format(data.JML_PENYUSUTAN, 2);
                    console.log(data);
					$('#trans_id').val(data.TRANS_ID);
					$('#noref').val(data.NO_REF);
                    $('#desref').val(data.DESC_REF);
                    $('#cabang').val(data.CAB);
					$('#tanggal').val(data.TGL_TRANS);
					$('#nilai').val(nilai);
					$('#penyusutan').val(data.PENYUSUTAN_KE);
					$('#kwitansi').val(data.KUITANSI);
					$('#kode_trans').val(data.KODE_TRANS);
				} else {
                    alert('Data tidak ditemukan!');
                    $('.bersih').val('');
                    $('.nomor2').val('0.00');
                    $('.nomor').val(number_format(0, 2));
                    $('#noref').focus();
                }
            }, "json");
    }//if kd<>''
}

function CleanNumber(value) {
    newValue = value.replace(/\,/g, '');
    return newValue;
}

function confirm_reset() {
    var r = confirm('Reset formulir ?');
    if (r) {

        $('.bersih').val('');
        $('.nomor').val('0.00');
        $('#txtJml').val(number_format(0, 2));
        $('#txtcounter').val('');
        $('#txtRekTab').focus();
        $("#btnSimpan").removeAttr("disabled");
        //$('#btnSimpan').show();
        //	location.reload();
    }
}

		function ajax_submit(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_inventory/simpan_penyusutan",
				data:dataString,
				success:function (data) {					
					//$('#btnSimpan').hide();
					console.log(data);
					var pushedData = jQuery.parseJSON(data);
					if(pushedData.isi == 1){
						alert(pushedData.pesan);
					}else{
						alert(pushedData.pesan);
						$("#btnSimpan").attr("disabled", "disabled");	
					}
				}
			});
			event.preventDefault();
		}
		$(function(){	
			$('#FormInventaris').submit(function (event) {
				  dataString = $("#FormInventaris").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit();
				  }else{//if(r)
					return false;
				  }
			}); //end  $contact form
		});

$(document).ajaxStart(function () {
    $('.modal_json').fadeIn('fast');
}).ajaxStop(function () {
    $('.modal_json').fadeOut('fast');
});
// jQuery expression for case-insensitive filter
$.extend($.expr[":"],
    {
        "contains-ci": function (elem, i, match, array) {
            return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
                .toLowerCase()) >= 0;
        }
    });
</script>