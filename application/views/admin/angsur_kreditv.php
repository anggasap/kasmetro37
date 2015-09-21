<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	foreach($counter->result() as $row){
		$count= $row->CounterNo;
		$f=($count+1)."-".$this->session->userdata('user_id');
	}
	foreach($kode_kredit->result() as $row){
		$kd_kre= $row->kode_trans;
		$gl_kre=$row->GL_TRANS;
		$des_kre=$row->DESKRIPSI_TRANS;
		$tob_kre=$row->TOB;
	}
?>
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
                <form id="formangsur" role="form" method="post">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-5">
                        	<h4>Info Rekening</h4>
                            <div class="form-body">
                            	<!--<div class="form-group">
                                    <label>No rekening :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                        </span>
                                        <?php /*// echo  form_input(array('name'=>'txtRekKre','class'=>'form-control bersih','id'=>'txtRekKre','required'=>'required','placeholder'=>'No rekening'));*/?>
                                        <?php /*// echo  form_input(array('name'=>'txtNasIDKre','type'=>'hidden','class'=>'hidden bersih','id'=>'txtNasIDKre','required'=>'required','style'=>'width:10px'));*/?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>No rekening :</label>

                                            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-tag"></i>
                                    </span>
                                                <input id="txtRekKre" name="txtRekKre" type="text" placeholder="No rekening "
                                                       class="form-control bersih input-medium" required="">
                                                <?php echo  form_input(array('name'=>'txtNasIDKre','type'=>'hidden','class'=>'hidden bersih','id'=>'txtNasIDKre','required'=>'required'));?>
                                    <span class="input-group-btn">
                                                  <a href="#" class="btn green" data-target="#idDivTabelRekKre"
                                                     data-toggle="modal">
                                                      <span class="glyphicon glyphicon-search"></span>
                                                  </a>
                                                  </span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Nama nasabah :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php echo  form_input(array('name'=>'txtNamaKre','class'=>'form-control bersih','id'=>'txtNamaKre','placeholder'=>'Nama nasabah','readonly'=>'true','required'=>'required'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Tipe pinjaman :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTipeKredit','class'=>'form-control bersih','id'=>'txtTipeKredit','required'=>'required','placeholder'=>'Tipe kredit','readonly'=>'true'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Jumlah pinjaman :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJmlKredit','class'=>'form-control nomor','id'=>'txtJmlKredit','required'=>'required','placeholder'=>'Jml kredit','readonly'=>'true','style'=>'text-align:right'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Baki debet pokok :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtBDpokok','class'=>'form-control nomor','id'=>'txtBDpokok','required'=>'required','readonly'=>'true','style'=>'text-align:right;'));?>
                            <?php echo  form_input(array('type'=>'hidden','name'=>'txtBDpokok_oper','class'=>'nomor','id'=>'txtBDpokok_oper'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Baki debet bunga :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtBDbunga','class'=>'form-control nomor','id'=>'txtBDbunga','required'=>'required','readonly'=>'true','style'=>'text-align:right;'));?>
                            <?php echo  form_input(array('type'=>'hidden','name'=>'txtBDbunga_oper','class'=>'nomor','id'=>'txtBDbunga_oper'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Kode transaksi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-gears"></i>
                                                </span>
                                                <?php
												$data = array();
												foreach($kodetrans_kre as $row) : 
														$data[$row['KODE_TRANS']] = $row['DESKRIPSI_TRANS'];
												endforeach; 
												echo form_dropdown('DL_kodetrans_kre', $data,$kd_kre,'id="DL_kodetrans_kre" class="form-control"');
												?>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-3">
                                            <label>&nbsp;</label>
                                            <div class="input-group">
                                                <?php // echo form_input(array('name'=>'txtDeskripTransKre','type'=>'hidden','id'=>'txtDeskripTransKre','readonly'=>'true','class'=>'input-medium')); ?>
												<?php echo form_input(array('name'=>'txtJenisTransKre','id'=>'txtJenisTransKre','readonly'=>'true','class'=>'form-control')); ?>
												<?php echo form_input(array('name'=>'txtGlKre','type'=>'hidden','id'=>'txtGlKre','readonly'=>'true','class'=>'bersih hidden')); ?>
												<?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','class'=>'hidden bersih','id'=>'txtcounter'));?> 
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Cicilan ke :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                                </span>
                                                <?php echo form_input(array('name'=>'txtCicilan','class'=>'form-control','id'=>'txtCicilan','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        	<?php echo form_input(array('name'=>'txtTglTrans','id'=>'txtTglTrans','readonly'=>'true','class'=>'hidden','value'=>$this->session->userdata('tglD'))); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal tagihan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                                <?php echo form_input(array('name'=>'txtTglTagihan','class'=>'form-control bersih','id'=>'txtTglTagihan','readonly'=>'true')); ?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kuitansi :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-list"></i>
                                        </span>
                                        <?php echo form_input(array('name'=>'txtKuitansi','id'=>'txtKuitansi','readonly'=>'readonly','class'=>'form-control bersih','placeholder'=>'No kuitansi'));?>
                                    </div>
                                </div>
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-7">
                            <h4>Jumlah Setoran</h4>
                            <div class="form-body">
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Pokok :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtAngsPokok','class'=>'form-control nomor byr','id'=>'txtAngsPokok','required'=>'required','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        	<label>Bunga :</label>
                                        	<div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtAngsBunga','class'=>'form-control nomor byr','id'=>'txtAngsBunga','required'=>'required','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Denda :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtAngsDenda','class'=>'form-control nomor byr','id'=>'txtAngsDenda','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                        <label>Disc bunga:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtDiscBunga','class'=>'form-control nomor','id'=>'txtDiscBunga','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Disc denda :</label>
                                        	<div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtDiscDenda','class'=>'form-control nomor','id'=>'txtDiscDenda','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                        <label>Adm :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtAdm','class'=>'form-control nomor byr','id'=>'txtAdm','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Pend lain :</label>
                                        	<div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtPendLain','class'=>'form-control nomor byr','id'=>'txtPendLain','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_input(array('name'=>'txtJmlTabWajib','id'=>'txtJmlTabWajib','class'=>'nomor byr','style'=>'text-align:right','type'=>'hidden','readonly'=>'readonly'));?>
                                <?php  echo  form_input(array('name'=>'txtRekTab','type'=>'hidden','class'=>'bersih','id'=>'txtRekTab'));?>
                                <?php  echo  form_input(array('name'=>'txtNamaTab','type'=>'hidden','class'=>'bersih','id'=>'txtNamaTab','readonly'=>'readonly'));?>
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Jumlah angsuran :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo form_input(array('name'=>'txtTotalTrans','id'=>'txtTotalTrans','class'=>'form-control nomor','readonly'=>'true','style'=>'text-align:right'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        	<label>Jumlah uang :</label>
                                        	<div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJmlByr','class'=>'form-control nomor','id'=>'txtJmlByr','style'=>'text-align:right','onkeyup'=>''));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Uang kembali :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJmlKembali','class'=>'form-control nomor','id'=>'txtJmlKembali','style'=>'text-align:right','readonly'=>'true'));?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label id="terbilang" style="color: red"></label>
                                </div>
                                <div class="form-group">
                                    <span id="errmsg" style="color: red;" class="label label-error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-list"></i>
                                        </span>
                                        <?php
                                        $data = array(
                                            'name'        => 'txtKet',
                                            'id'          => 'txtKet',
                                            'placeholder'     => 'Keterangan',
                                            'rows'        => '2',
                                            'class'       => 'form-control bersih'
                                          );
                                        echo form_textarea($data);
                                        ?>
                                    </div>
                                </div> 
                                
                            </div>
                            <!-- END FORM BODY-->
                        </div>    
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" id="btnSimpan" name="btnSimpan"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>               
       					<a class="btn green" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi">
                        	<span class="glyphicon glyphicon-print"></span> Validasi
                        </a>
       					<a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
       						<span class="glyphicon glyphicon-repeat"></span>  Reset
       					</a>
       					<a class="btn yellow" onclick="cetak_kuitansi();" id="btnCetak_kuitansi" name="btnCetak_kuitansi">
                        	<span class="glyphicon glyphicon-print"></span> Kuitansi
                        </a>
                    </div>
            	</form>    
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<!-- /.modal -->
<div id="idDivTabelRekKre" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Rekening </h4>
            </div>

            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_Reload" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelRekKre">
                                    <thead>
                                    <tr>
                                        <th>
                                            No Rekening
                                        </th>
                                        <th>
                                            Nama Nasabah
                                        </th>
                                        <th>
                                            Alamat
                                        </th>
                                        <th>
                                            Saldo Akhir
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
<script src="<?php echo base_url('bootstrap/js/moment.js') ?>"></script>
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
	$("#menu_root_4").addClass('start active open');
    var TableManaged = function () {

        var initTable1 = function () {

            var table = $('#idTabelRekKre');

            // begin first table
            table.dataTable({
                "ajax": "<?php  echo base_url("/angsur_kredit/getRekKreAll"); ?>",
                "columns": [
                    { "data": "norekkre" },
                    { "data": "namanasabah" },
                    { "data": "alamat" },
                    { "data": "jmlPinj" }

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
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
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
                var noRekTab = $(this).find("td").eq(0).html();
                $('#txtRekKre').val(noRekTab);
                $('#id_button_close_modal').trigger('click');
                $('#txtRekKre').focus();

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
	// END MENU OPEN
		function pad2(number) {
     		return (number < 10 ? '0' : '') + number
		}
		//angga print
		function cetak_validasi(){
		 // var newWindow = window.open("","Cetak","width=300,height=300,scrollbars=0,resizable=1")
		  var newWindow = window.open('Validasi','_blank');
		  var d = new Date();
		  var jam =pad2(d.getHours()); // => 9
		  var mnt =pad2(d.getMinutes()); // =>  30
		  var dtk =pad2(d.getSeconds()); // => 51
		 
		 var total_trans = $('#txtTotalTrans').val();
		 var tgl_trans = $('#txtTglTrans').val();
		 var user =$('#id_session_user').val();
		 var kuitansi =$('#txtKuitansi').val();
		 var no_rek =$('#txtRekKre').val();
		 var nama = $('#txtNamaKre').val();
		 var pokok = $('#txtAngsPokok').val();
		 var bunga = $('#txtAngsBunga').val();
		 var denda = $('#txtAngsDenda').val();
		 var destranskre=$('#DL_kodetrans_kre option:selected').text();
		 var saldo = $('#txtBDpokok').val();//baki debet
	  	 var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+user+" "+kuitansi+"<br>";
		 var html2=destranskre+" "+no_rek+" "+nama+" "+"<br>";

	  	 var html3="Pokok: "+pokok+" Bng/Mrg: "+bunga+" Denda: "+denda+"<br>";
		 var html4="Total: "+total_trans+" Saldo: "+saldo;	
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .document.write(html3);
		  newWindow .document.write(html4);
		  newWindow .print();
		  newWindow .document.close();
		}
		function capitalizeEachWord(str){
		   var words = str.split(" ");
		   var arr = Array();
		   for (i in words){
			  temp = words[i].toLowerCase();
			  temp = temp.charAt(0).toUpperCase() + temp.substring(1);
			  arr.push(temp);
		   }
		   return arr.join(" ");
		}

		function cetak_kuitansi(){
		   var newWindow = window.open('Kuitansi', '_blank');
		   var desk_trans = $('#DL_kodetrans_kre option:selected').text();
		   var kuitansi= $("#txtKuitansi").val();
		   var jml_kre=$("#txtJmlKre").val();
		   var tgl_trans = $('#id_session_tgl_D').val();
		   var no_rek=$('#txtRekKre').val();
		   var nama=$('#txtNamaKre').val();
		   var terbilang =$('#terbilang').text();
		   terbilang = terbilang.replace(" koma nol nol","");
		   var ket = $('#txtKet').val();
		   var lokasi=$('#id_session_lokasi').val();
		   var user=$('#id_session_user').val();
		   var pokok_awal = $('#txtBDpokok_oper').val();
	  	   var pokok_akhir = $('#txtBDpokok').val();
		   var cicilan = $('#txtCicilan').val();
		   var angs_pkk = $('#txtAngsPokok').val();
		   var angs_bgn = $('#txtAngsBunga').val();
		   var angs_denda = $('#txtAngsDenda').val();
		   var angs_adm = $('#txtAdm').val();
		   var tot_trans = $('#txtTotalTrans').val();
		   var nama_lkm = $('#id_session_nama_lkm').val();
		   
		   var htm1='<table style="font-size: 10px;">';
		   var htm2 ='<tr>';
		   var htm3 ='';
		   var htm4 = '<td>TANDA TERIMA SETORAN ANGSURAN</br>'+nama_lkm+'</td><td></td>';
		   var htm5 = '<td>';
		   var htm6 = '<table style="border:1px solid black; border-collapse:collapse; width:200px; font-size: 10px;"><tr><td style="border:1px solid black;">Adm</td><td style="border:1px solid black;">Akunting</td><td style="border:1px solid black;">SPI</td></tr><tr height="20"><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td></tr></table>';
			
		   var htm7 ='</td>';//
		  //  var htm7 =desk_trans;
		   var htm8 = '</tr>';
		   var htm9 = '<tr><td valign="top">';
		   var htm10 = '<table style="font-size: 10px;"><tr><td style="font-family:Courier New, Courier, monospace; width:200px;">No. Kuitansi</td><td>:</td><td>'+kuitansi+'</td></tr>';
		   var htm10_1='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Nama</td><td>:</td><td>'+nama+'</td></tr>';
		   var htm10_2='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">No. Rek</td><td>:</td><td>'+no_rek+'</td></tr>';
		   var htm10_3='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Sisa Pokok Awal</td><td>:</td><td>'+pokok_awal+'</td></tr>';
		   var htm10_4='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Sisa Pinjaman</td><td>:</td><td>'+pokok_akhir+'</td></tr>';
		   var htm10_5='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Angsuran ke</td><td>:</td><td>'+cicilan+'</td></tr>';
		   var htm10_6='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Transaksi</td><td>:</td><td>'+desk_trans+'</td></tr>';
		   var htm10e='</table></td>';
		   var htm11 = '<td></td><td>';
		   var htm11_1='<table style="font-size: 10px;"><tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Angsuran Pokok</td><td>:</td><td>'+angs_pkk+'</td></tr>';
		   var htm11_2='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Angsuran Bunga</td><td>:</td><td>'+angs_bgn+'</td></tr>';
		   var htm11_3='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Denda</td><td>:</td><td>'+angs_denda+'</td></tr>';
		   var htm11_4='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Administrasi</td><td>:</td><td>'+angs_adm+'</td></tr>';
		   var htm11_5='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;"><hr></td><td>:</td><td><hr></td></tr>';
		   var htm11_6='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Jml pembayaran</td><td>:</td><td>'+tot_trans+'</td></tr>';
		   var htm11e='</table></td></tr>';
		   
		   var htm12= '<tr><td colspan="3">Terbilang :'+ capitalizeEachWord(terbilang)+'</td></tr>';	
		   var htm13= '<tr><td colspan="3">';
		   var htm13_1 ='<table style="font-size: 11px; font-family:Courier New, Courier, monospace;"><tr><td></td><td></td><td></td><td></td><td>'+lokasi+', '+tgl_trans+'</td></tr>';
		   var htm13_2 ='<tr style="text-align:center;"><td style="width:100px;">Debitur,</td><td style="width:100px;"></td><td style="width:100px;">Teller</td><td style="width:100px;"></td><td style="width:100px;">Mengetahui</td></tr>';
		   var htm13_3 ='<tr><td style="width:100px; height:50px;" valign="bottom"><hr></td><td style="width:100px;"></td><td style="width:100px; height:50px;" valign="bottom"><hr></td><td style="width:100px;"></td><td style="width:100px; height:50px;" valign="bottom"><hr></td></tr>';

		   var htm15='</table></td></tr>';	   
		   var htm17 = ' </table>';
			newWindow .document.open();
			newWindow .document.write(htm1);
			newWindow .document.write(htm2);
			newWindow .document.write(htm3);
			newWindow .document.write(htm4);
			newWindow .document.write(htm5);
			newWindow .document.write(htm6);
		    newWindow .document.write(htm7);
			newWindow .document.write(htm8);
			newWindow .document.write(htm9);
			newWindow .document.write(htm10);
			newWindow .document.write(htm10_1);
			newWindow .document.write(htm10_2);
			newWindow .document.write(htm10_3);
			newWindow .document.write(htm10_4);
			newWindow .document.write(htm10_5);
			newWindow .document.write(htm10_6);		
			newWindow .document.write(htm10e);
			newWindow .document.write(htm11);
			newWindow .document.write(htm11_1);
			newWindow .document.write(htm11_2);
			newWindow .document.write(htm11_3);
			newWindow .document.write(htm11_4);
			newWindow .document.write(htm11_5);
			newWindow .document.write(htm11_6);
			newWindow .document.write(htm11e);
			newWindow .document.write(htm12);
			newWindow .document.write(htm13);
			newWindow .document.write(htm13_1);
			newWindow .document.write(htm13_2);
			newWindow .document.write(htm13_3);
			newWindow .document.write(htm15);
			newWindow .document.write(htm17);
			newWindow .print();
			newWindow .document.close();
		}	
		// end angga print
		function confirm_reset(){
			var r = confirm('Reset formulir ??');
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('#txtRekKre').focus();
				//$('input[name=chkPelunasan]').attr('checked', false);
				$('#txtCicilan').val('0');
				$('#terbilang').text("nol");
				$("#btnSimpan").removeAttr("disabled");
				$('#btnSimpan').show();
				//check_load();
				
				//location.reload();
			}
		}
		
		function kode_kre(){
		var kd=$('#DL_kodetrans_kre').val();
		$.post("<?php echo site_url('/angsur_kredit/deskripsi_trans_kredit'); ?>",
			{
				'kodetrans' : kd
			},
			function(data)
			{
				$('#txtDeskripTransKre').val(data.deskripsitrans);
				$('#txtGlKre').val(data.gl_trans);
				$('#txtJenisTransKre').val(data.tob);
			},"json");
		}
//==========================ANGSURAN YANG MINUS===========================
		function tagihan(){
		var kd=$('#txtRekKre').val();
		var tgltrans=$("#txtTglTrans").val();
		var tgl=tgltrans.slice(0,2);
		var bln=tgltrans.slice(3,5);
		var thn=tgltrans.slice(6,11);
		var tglsys=thn+'-'+bln+'-'+tgl;

		$.post("<?php echo site_url('/angsur_kredit/nilai_tagihan'); ?>",
			{
				'norek' : kd,
				'bln'	: bln,
				'thn'	: thn,
				'tglsys'	: tglsys
			},
			function(data){
				//var tagihan_pokok=number_format(data.pokok_angsur,0);
				var tagihan_pokok =data.pokok_angsur;
				if (tagihan_pokok<0){tagihan_pokok='0.00';}else{tagihan_pokok=number_format(tagihan_pokok,2);}
				//var tagihan_bunga=number_format(data.bunga_angsur,0);
				var tagihan_bunga =data.bunga_angsur;
				if (tagihan_bunga<0){tagihan_bunga='0.00';}else{tagihan_bunga=number_format(tagihan_bunga,2);}
				
				//var	tagihan_denda=number_format(data.denda_angsur,0);
				var	tagihan_denda=data.denda_angsur;
				if (tagihan_denda<0){tagihan_denda='0.00';}else{tagihan_denda=number_format(tagihan_denda,2);}
				
				//var	tagihan_badmin=number_format(data.badmin_angsur,0);
				var	tagihan_badmin=data.badmin_angsur;
				if (tagihan_badmin<0){tagihan_badmin='0.00';}else{tagihan_badmin=number_format(tagihan_badmin,2);}
				
				//var	tagihan_padmin=number_format(data.padmin_angsur,0);
				var	tagihan_padmin=data.padmin_angsur;
				if (tagihan_padmin<0){tagihan_padmin='0.00';}else{tagihan_padmin=number_format(tagihan_padmin,2);}
				//alert(tagihan_pokok);
				$('#txtAngsPokok').val(tagihan_pokok);
				//$('#txtAngsPokok').val('');
				$('#txtKet').focus();
				$('#txtAngsBunga').val(tagihan_bunga);
				$('#txtAngsDenda').val(tagihan_denda);
				$('#txtAdm').val(tagihan_badmin);
				$('#txtPendLain').val(tagihan_padmin);
				calculateSum();
			},"json");
		}
//==========================END ANGSURAN YANG MINUS===========================			

		function cicilan(){
			
		var kd=$('#txtRekKre').val();
		var tgltrans=$("#txtTglTrans").val();
		var bln=tgltrans.slice(3,5);
		var thn=tgltrans.slice(6,11);

		$.post("<?php echo site_url('/angsur_kredit/cicilan_ke'); ?>",
			{
				'norek' : kd,
				'bln'	: bln,
				'thn'	: thn,
			},

			function(data){	
			var x=data.ANGSURAN_KE;
			var tgl_cicilan=data.TGL_TRANS;
			var thn=tgl_cicilan.slice(0,4);
			var bln=tgl_cicilan.slice(5,7);
			var tgl=tgl_cicilan.slice(8,10);
			var tglcicilan=tgl+'-'+bln+'-'+thn;
			
				$('#txtCicilan').val(x);
				$('#txtTglTagihan').val(tglcicilan);
				//txtTglTagihan
			},"json");
		}
		
		
		function deskrip_norek(){
		var kd=$('#txtRekKre').val();
		$.post("<?php echo site_url('/angsur_kredit/deskripsi_norek_kre'); ?>",
			{
				'norek' : kd
			},
			function(data){
				if(data.baris==1){
					var jml_kredit=number_format(data.JML_PINJAMAN,2);
					var out_pokok=number_format(data.POKOK_SALDO_AKHIR,2);
					var	out_bunga=number_format(data.BUNGA_SALDO_AKHIR,2);
					var setor_pokok=number_format(data.POKOK_SALDO_SETORAN,2);
					var	setor_bunga=number_format(data.BUNGA_SALDO_SETORAN,2);
                    var jenisPinj   = data.JENIS_PINJ;
					$('#txtNamaKre').val(data.NAMA_NASABAH);
					$('#txtNasIDKre').val(data.NASABAH_ID);
					$('#txtJmlKredit').val(jml_kredit);
					$('#txtBDpokok').val(out_pokok);
					$('#txtBDbunga').val(out_bunga);
					/*penampung operan baki debet pokok dan bunga*/
					$('#txtBDpokok_oper').val(out_pokok);
					$('#txtBDbunga_oper').val(out_bunga);
					/*end penampung operan baki debet pokok dan bunga*/
					var abp = (data.TYPE_ABP);
                    var typeKre = "Pembiayaan-"+jenisPinj;
					if(abp==1){
						$('#txtTipeKredit').val(typeKre);
					}
					else if(abp==2){
						$('#txtTipeKredit').val('ABP');
					}
					var k= "<?php echo $f; ?>";
					var c="<?php echo $count+1; ?>";
					$("#txtcounter").val(c);
					$("#txtKuitansi").val(k);
					
					$('#txtPokokSetoran').val(setor_pokok);
					//$('#txtAngsPokok').val('');
					//$('#txtAngsPokok').focus();
					$('#txtBungaSetoran').val(setor_bunga);
				}else{
					alert('Data debitur kredit tidak ditemukan!');
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtRekKre').focus();
					$('#txtCicilan').val('0.00');
					$('#terbilang').text("nol");
					$("#btnSimpan").removeAttr("disabled");
				}
			},"json");
		}
		
		//fungsi untuk kalkulasi pembayaran textbox
		function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
		}
/*
		function CommaFormatted(amount) {
		    var delimiter = ",";
		    var i = parseFloat(amount);

		    if (isNaN(i)) { return ''; }
		    i = Math.abs(i);
		    var minus = '';
		    if (i < 0) { minus = '-'; }

		    var n = new String(i);
		    var a = [];
		    while (n.length > 3) {
		        var nn = n.substr(n.length - 3);
		        a.unshift(nn);
		        n = n.substr(0, n.length - 3);
		    }
		    if (n.length > 0) { a.unshift(n); }
		    n = a.join(delimiter);
		    amount = minus + n;
		    return amount;
		}
*/
		function calculateSum() {
			var AngsPokok = parseFloat(CleanNumber($("#txtAngsPokok").val()));
		    if (isNaN(AngsPokok)) AngsPokok = 0;
		    var AngsBunga = parseFloat(CleanNumber($("#txtAngsBunga").val()));
		    if (isNaN(AngsBunga)) AngsBunga = 0;
	      	var AngsDenda = parseFloat(CleanNumber($("#txtAngsDenda").val()));
		    if (isNaN(AngsDenda)) AngsDenda = 0;
		    var Adm = parseFloat(CleanNumber($("#txtAdm").val()));
		    if (isNaN(Adm)) Adm = 0;
		    var PendLain =  parseFloat(CleanNumber($("#txtPendLain").val()));
		    if (isNaN(PendLain)) PendLain = 0;
			var TabWajib = parseFloat(CleanNumber($("#txtJmlTabWajib").val()));
			if (isNaN(TabWajib)) TabWajib = 0;
			
		    var total = AngsPokok + AngsBunga + AngsDenda + Adm + PendLain + TabWajib;
		    //var sum  = CommaFormatted(total); 
			sum=number_format(total,2);
	        $("#txtTotalTrans").val(sum);
			if(total==0){
					$('#terbilang').text("nol");
				}
				else{
					var total = toWords(total);
			  		$('#terbilang').text(total);
				}
	    }
		
		function kembalian() {
	          var grand_total = parseFloat(CleanNumber($("#txtTotalTrans").val()));
	          //if (isNaN(grand_total)) grand_total = 0;
	          var bayar = parseFloat(CleanNumber($("#txtJmlByr").val()));
	         // if (isNaN(bayar)) bayar = 0;

	          var kembalian = bayar-grand_total ;
	          if (parseFloat(bayar) < parseFloat(grand_total)) {
	               $("#txtJmlKembali").val('0.00');
	          }
	          else{
				 $("#txtJmlKembali").val(number_format(kembalian,2));
				}

	      }
		  function cek_transaksi_hari_ini(){
			  var kd=$('#txtRekKre').val();
			  
			  var tgltrans=$("#txtTglTrans").val();
			  var tgl=tgltrans.slice(0,2);
			  var bln=tgltrans.slice(3,5);
			  var thn=tgltrans.slice(6,11);
			  var tglsys=thn+'-'+bln+'-'+tgl;
			  $.post("<?php echo site_url('/angsur_kredit/cek_transaksi_hari_ini'); ?>",{
						  'norek' : kd,
							'tglsys'	: tglsys
			  },function(data){
					var jumlah=data.jumlah;	 
					if (jumlah>0){
						alert('Hari ini sudah melakukan transaksi !');
					}
			  },"json");
		  }
		  function ajax_submit_angsur(){
			  $.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>angsur_kredit/simpan_angsur",
				data:dataString,
		
				success:function (data) {
					
					alert('Transaksi setoran angsuran tersimpan.');
					 $("#btnSimpan").attr("disabled", "disabled");
					// $('#btnSimpan').hide();
				}
		
			});
			event.preventDefault();
		  }
		$(function() {
			
				$('#formangsur').submit(function (event) {
					  dataString = $("#formangsur").serialize();
					  var jml_bayar = parseFloat(CleanNumber($("#txtTotalTrans").val()));
					  var jmltabwajib = parseFloat(CleanNumber($("#txtJmlTabWajib").val()));//parseFloat(CleanNumber($(this).val())) 
					  if (jml_bayar==0){
						  alert('Jumlah setoran tidak boleh 0 !');
						  return false;
					  }else if((jmltabwajib>0) && ($('#txtRekTab').val()=='')){
						  alert('Isi no rek tabungan.');
						  return false;
					  }else{
						  var r = confirm('Anda yakin menyimpan data ini?');
						  if (r== true){
							ajax_submit_angsur();
						  }else{//if(r)
							return false;
						  }
						  
					  }
				  }); //end  $contact form
			
		});/// end $func
		/*$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});*/
		$(document).ready(function(){
			
			$( "#DL_kodetrans_kre" ).focusout(function() {
				var kdtrans=$( "#DL_kodetrans_kre" ).val();
				if( kdtrans=='003'){
					//alert("Tidak bisa melakukan");
					alert('Tidak bisa melakukan angsuran debet tabungan di modul ini.');
					$( "#DL_kodetrans_kre" ).val('002');
				}
			});
			
			$('#txtRekKre').focus();
			$('#txtRekTab').attr('disabled','disabled');
			$('#txtDeskripTransKre').val("<?php echo $des_kre; ?>");
			$('#txtJenisTransKre').val("<?php echo $tob_kre; ?>");
			$('.nomor').val('0.00');
			$('#txtCicilan').val('0');
			$('#terbilang').text("nol");
			//check_load();	
			
			$(".byr").each(function() {
	            $(this).keyup(function(){
	                calculateSum();
	            });
	        });
			
			$("#txtJmlByr").keyup(function(){
	            kembalian();
	        });
				
			//focus in textbox
			$("#txtAngsPokok").focus(function(){
				$('#txtAngsPokok').val('');
			});
			$("#txtAngsBunga").focus(function(){
				$('#txtAngsBunga').val('');
			});
			$("#txtAngsDenda").focus(function(){
				$('#txtAngsDenda').val('');
			});
			$("#txtDiscBunga").focus(function(){
				$('#txtDiscBunga').val('');
			});
			$("#txtDiscDenda").focus(function(){
				$('#txtDiscDenda').val('');
			});
			$("#txtAdm").focus(function(){
				$('#txtAdm').val('');
			});
			$("#txtPendLain").focus(function(){
				$('#txtPendLain').val('');
			});
			$("#txtJmlByr").focus(function(){
				$('#txtJmlByr').val('');
			});
			$("#txtJmlTabWajib").focus(function(){
				$('#txtJmlTabWajib').val('');
			});
			$("#txtRekTab").focusout(function(){
				if ($(this).val() == '') { 
				 $('#txtNamaTab').val('');
				 }
			});
			//deskipsi rek tabungan
			$( "#txtRekTab" ).focusout(function() {
			   var kd=$('#txtRekTab').val();
			   kd=kd.trim();
				 if(kd!=''){
					$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",{
							'norek' : kd
						},
						function(data){
							if(data.baris==1){
								$('#txtNamaTab').val(data.NAMA_NASABAH);
							}else{
								alert('Rekening tabungan tidak ditemukan.');
								$('#txtRekTab').val('');
								$('#txtNamaTab').val('');
							}//else
						},"json");	
				 }
				 /*
				 if((jmltabwajib>0) && (kd=='')){
					 $.messager.show({
						title:'Perhatian!',
						msg:'Data debitur tabungan harus diisi!',
						timeout:5000,
						showType:'slide'
					});
					 $('#txtRekTab').val('');
					 $('#txtRekTab').focus();
				 }
				 */
			});
			// end deskipsi rek tabungan
			//focus out textbox
			$("#txtJmlTabWajib").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   $('#txtRekTab').attr('disabled','disabled');
				   $('#txtRekTab').val('');
				   calculateSum();
				}else if (parseFloat(CleanNumber($(this).val())) <= 0) { 
				   $('#txtRekTab').attr('disabled','disabled');
				   $('#txtRekTab').val('');
				   $('#txtNamaTab').val('');
				   calculateSum();
				}else if (parseFloat(CleanNumber($(this).val())) > 0) { 
				   $('#txtRekTab').removeAttr('disabled');
				   $('#txtRekTab').focus();
				   calculateSum();
				}
			});
			
			$("#txtTotalTrans").focusout(function(){
				var angka = $('#txtTotalTrans').val(); 
				var result = number_format(angka,2);
				$('#txtTotalTrans').val(result);
			});
			$("#txtAngsPokok").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   
				}else{
					var angka = $('#txtAngsPokok').val(); 
					var result = number_format(angka,2);
					$('#txtAngsPokok').val(result);
				}
				calculateSum();
				var AngsPokok = parseFloat(CleanNumber($("#txtAngsPokok").val()));
		    	if (isNaN(AngsPokok)) AngsPokok = 0;
				var BDpokok_oper = parseFloat(CleanNumber($("#txtBDpokok_oper").val()));
		    	if (isNaN(BDpokok_oper)) BDpokok_oper = 0;
				
				var saldo_BDpokok= number_format((BDpokok_oper-AngsPokok),2);
					saldo_BDpokok=number_format(saldo_BDpokok,2);
				$('#txtBDpokok').val(saldo_BDpokok);
			});
			$("#txtAngsBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}else{
					var angka = $('#txtAngsBunga').val(); 
					var result = number_format(angka,2);
					$('#txtAngsBunga').val(result);
				}
				calculateSum();
				//var BDbunga = $('#txtBDbunga').val();
				var AngsBunga = parseFloat(CleanNumber($("#txtAngsBunga").val()));
		    	if (isNaN(AngsBunga)) AngsBunga = 0;
				var BDbunga_oper = parseFloat(CleanNumber($("#txtBDbunga_oper").val()));
		    	if (isNaN(BDbunga_oper)) BDbunga_oper = 0;
				
				var saldo_BDbunga= number_format((BDbunga_oper-AngsBunga),2);
					saldo_BDbunga = number_format(saldo_BDbunga,2);
				$('#txtBDbunga').val(saldo_BDbunga);
			});
			$("#txtAngsDenda").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}else{
					var angka = $('#txtAngsDenda').val(); 
					var result = number_format(angka,2);
					$('#txtAngsDenda').val(result);
				}
				calculateSum();
			});
			$("#txtDiscBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}else{
					var angka = $('#txtDiscBunga').val(); 
					var result = number_format(angka,2);
					$('#txtDiscBunga').val(result);
				}
			});
			$("#txtDiscDenda").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}else{
					var angka = $('#txtDiscDenda').val(); 
					var result = number_format(angka,2);
					$('#txtDiscDenda').val(result);
				}
			});
			$("#txtAdm").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}else{
					var angka = $('#txtAdm').val(); 
					var result = number_format(angka,2);
					$('#txtAdm').val(result);
				}
				calculateSum();
			});
			$("#txtPendLain").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}else{
					var angka = $('#txtPendLain').val(); 
					var result = number_format(angka,2);
					$('#txtPendLain').val(result);
				}
				calculateSum();
			});
			$("#txtJmlByr").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   kembalian();
				}else{
					var angka = $('#txtJmlByr').val(); 
					var result = number_format(angka,2);
					$('#txtJmlByr').val(result);
					kembalian();
				}
			});
			/*
			$(".nomor").keypress(function (e){
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
					$("#errmsg").html("Digits Only").show().fadeOut("slow");
					return false;
				}
			});
			*/
			$('.nomor').keyup(function(){
					var val = $(this).val();
					//val=val.toFixed(2);
					if(isNaN(val)){
						 val = val.replace(/[^0-9\.]/g,'');
						 if(val.split('.').length>2) 
							 val =val.replace(/\.+$/,"");
					}
					$(this).val(val); 
			});
			
			$('#DL_kodetrans_kre').change(function(){
				kode_kre();
			});

//edit di sini			
			$( "#txtRekKre" ).focusout(function() {
				var kd=$("#txtRekKre").val();
				kd=kd.trim();
				if(kd!=''){
				  deskrip_norek();
				  tagihan();
				  cicilan();
				  cek_transaksi_hari_ini();
				}
			});

			
		});//end ready document
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],
			{
				"contains-ci": function(elem, i, match, array)
				{
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>