<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-pin"></i>
                    <span class="caption-subject bold uppercase">Pencatatan Transaksi</span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="forminputjurnal" class="confTrans" role="form" method="post" action="<?php echo base_url('akuntansi/simpanJurnal'); ?>">
                    <!-- START DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-body">
                        <div>
                            <?php echo form_input(array('name' => 'txtTGlTrans', 'id' => 'idTxtTGlTrans', 'class' => 'form-control sembunyi', 'value' => $this->session->userdata('tglD'), 'readonly' => 'true')); ?>
                	        <span id="event_result">
                    <?php
                    if ($this->session->flashdata('success') != '') {
                        echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('success') . '
						  </div>';
                    }
                    if ($this->session->flashdata('error') != '') {
                        echo '<div class="span12 alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('error') . '
						</div>';
                    }
                    ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>No Referensi :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                        <?php echo  form_input(array('name'=>'txtNoRef','class'=>'form-control','id'=>'idTxtNoRef'));?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Kode Jurnal :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                        <?php
                                        $data = array();
                                        foreach($kodeJurnal as $row) :
                                            $data[$row['kode_jurnal']] = $row['nama_jurnal'];
                                        endforeach;
                                        echo form_dropdown('dLKodeJurnal', $data,'','id="idDLKodeJurnal"  class="form-control"');
                                        ?>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label>Judul jurnal :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                        <?php echo  form_input(array('name'=>'txtJudulJurnal','class'=>'form-control','id'=>'idtxtJudulJurnal'));?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Kode Perkiraan :</label>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </span>
                                        <input id="idTxtKodePerk" name="txtKodePerk" type="text" placeholder=""
                                               class="form-control bersih input-small" required="" readonly>
                                        <span class="input-group-btn">
                                            <a href="#" class="btn green" data-target="#GL"
                                                     data-toggle="modal">
                                                      <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                        </span>

                                    </div>
                                    <span class="help-block" id="idNamaPerk"></span>

                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2">
                                    <label>Debet :</label>
                                        <?php echo form_input(array('name' => 'txtSaldoDebet', 'id' => 'idTxtSaldoDebet', 'class' => 'form-control nomor', 'style' => 'text-align:right')); ?>
                                </div>
                                <div class="col-md-2">
                                    <label>Kredit :</label>

                                        <?php echo form_input(array('name' => 'txtSaldoKredit', 'id' => 'idTxtSaldoKredit', 'class' => 'form-control nomor', 'style' => 'text-align:right')); ?>
                                    </div>
                                <div class="col-md-4">
                                    <label>Uraian :</label>


                                        <?php
                                        $data = array(
                                            'name' => 'txtUraian',
                                            'id' => 'idTxtUraian',
                                            'onkeyup' => 'ToUpper(this)',
                                            'rows' => '2',
                                            'class' => 'form-control',
                                        );
                                        echo form_textarea($data);
                                        ?>

                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <a id="idBtnAddPerk" href="javascript:;" class="form-control btn btn-icon-only green">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control">

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th width="10%">
                                    Kode Perk
                                </th>
                                <th width="20%">
                                    Nama Perk
                                </th>
                                <th width="15%">
                                    Debet
                                </th>
                                <th width="15%">
                                    Kredit
                                </th>
                                <th width="30%">
                                    Uraian
                                </th>
                                <th width="10%">
                                    Act
                                </th>
                            </tr>
                            </thead>
                            <tbody id="id_body_data">

                            </tbody>
                        </table>
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total debet :</label>
                                        <input type="text" name="totalDebet" class="form-control nomor kanan" id="idTotalDebet" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Total kredit :</label>
                                        <input type="text" name="totalKredit" class="form-control nomor kanan" id="idTotalKredit" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" id="btnSimpan"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
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

    </div>
</div>

<!-- /.modal -->
<div id="GL" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal_2" type="button" class="close" data-dismiss="modal"
                        aria-hidden="true"></button>
                <h4 class="modal-title">Tabel Perkiraan</h4>
            </div>
            <!-- START MODAL BODY-->
            <div class="modal-body">
                <div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class='table table-striped table-bordered table-hover' id="id_TabelPerk">
                                    <thead>
                                    <tr>
                                        <th width='10%' align='left'>Kd Perk</th>
                                        <th width='60%' align='left'>Nama Perk</th>
                                        <th width='20%' align='center'>Type</th>
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
                <!--<button type="button" data-dismiss="modal" class="btn blue" id="id_button_save_modal">Simpan</button>-->
                <button type="button" data-dismiss="modal" class="btn red" id="id_button_close_modal">Tutup</button>
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
    $("#menu_root_9").addClass('start active open');
    $("#idTxtNoRef").focus();
    function CleanNumber(value) {
        newValue = value.replace(/\,/g, '');
        return newValue;
    }
    $(".nomor").focus(function(){
        if($(this).val() == 0 || $(this).val() == 0.00){
            $(this).val('');
        }
    });
    $('.nomor').val('0.00');
    $(".nomor").focusout(function(){
        if ($(this).val() == '') {
            $(this).val('0.00');
        }else if($(this).val() == 0){
            $(this).val('0.00');
        }else{
            var angka = $(this).val();
            var result = number_format(angka,2);
            $(this).val(result);
        }
    });
    $('.nomor').keyup(function(){
        var val = $(this).val();
        if(isNaN(val)){
            val = val.replace(/[^0-9\.]/g,'');
            if(val.split('.').length>2)
                val =val.replace(/\.+$/,"");
        }
        $(this).val(val);
    });	// END $('.nomor').keyup(function(){
    function kosongkan(){
        $('#idTxtKodePerk').val('');
        $('#idNamaPerk').text('');
        $('#idTxtSaldoDebet').val('0.00');
        $('#idTxtSaldoKredit').val('');
        $('#idTxtUraian').val('');
    }
    // END MENU OPEN
    var TableManaged = function () {

        var initTable1 = function () {
            //var table = $('#id_TabelPerk');
            // begin first table
            var table = $('#id_TabelPerk').dataTable({
                "ajax": "<?php  echo base_url("/tksBpr/getAllPerkiraan"); ?>",
                "columns": [
                    { "data": "kode_perk" },
                    { "data": "nama_perk" },
                    { "data": "type" }
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
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
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
                // "aaSorting": [[4,'desc'], [5,'desc']],
                "columnDefs": [{  // set default column settings
                    'orderable': true,
                    'type'      :'string',
                    'targets': [0]
                }, {
                    "searchable": true,
                    "targets": [0]
                }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });

            var tableWrapper = jQuery('#id_TabelPerk_wrapper');

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
            table.on('click', 'tbody tr', function () {
                var idPerkiraan = $(this).find("td").eq(0).html();
                $('#idTxtKodePerk').val(idPerkiraan);
                var namaPerkiraan = $(this).find("td").eq(1).html();
                $('#idNamaPerk').text(namaPerkiraan);

                $( "#id_button_close_modal" ).trigger( "click" );
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
    var i =0;
    $('#idTxtTempLoop').val(i);
    $('#idBtnAddPerk').click(function(){
        if($('#idTxtKodePerk').val() =='' && $('#idNamaPerk').text() == ''){
            alert("Akun GL tidak boleh kosong.");
        }else{
            i=i+1;
            var kodePerk        = $('#idTxtKodePerk').val();
            var namaPerk        = $('#idNamaPerk').text();
            var saldoDebet      = $('#idTxtSaldoDebet').val();
            var saldoKredit     = $('#idTxtSaldoKredit').val();
            var uraian          = $('#idTxtUraian').val();


            tr = '<tr class="listdata">';
            tr+='<td><input type="text" class="form-control" name="kodePerk'+i+'" readonly="true" value="'+kodePerk+'"></td>';
            tr+='<td><input type="text" class="form-control" name="namaPerk'+i+'" readonly="true" value="'+namaPerk+'" ></td>';
            tr+='<td><input type="text" class="form-control kanan" id="saldoDebet'+i+'"  name="saldoDebet'+i+'" value="'+saldoDebet+'"></td>';
            tr+='<td><input type="text" class="form-control kanan" id="saldoKredit'+i+'" name="saldoKredit'+i+'" value="'+saldoKredit+'"></td>';
            tr+='<td><input type="text" class="form-control kanan" id="uraian'+i+'" name="uraian'+i+'" value="'+uraian+'"></td>';
            tr+='<td><a href="#" class="btn yellow"><i class="fa fa-edit"></i></a>';
            tr+='<a href="#" class="btn red"><i class="fa fa-trash-o"></i></a></td>';
            tr+= '</tr>';

            saldoDebet          = parseFloat(CleanNumber(saldoDebet));
            saldoKredit         = parseFloat(CleanNumber(saldoKredit));//saldoKredit.replace(",", "");

            var totDebet        = parseFloat(CleanNumber($('#idTotalDebet').val()));
            var totKredit       = parseFloat(CleanNumber($('#idTotalKredit').val()));

            var totalDebet      = totDebet+saldoDebet;
            var totalKredit     = totKredit+saldoKredit;

            $('#idTotalDebet').val(number_format(totalDebet,2));
            $('#idTotalKredit').val(number_format(totalKredit,2));

            $('#id_body_data').append(tr);
            $('#idTxtTempLoop').val(i);
            kosongkan();
        }
    });
    $(".confTrans").submit(function(e){
        var totDebet        = parseFloat(CleanNumber($('#idTotalDebet').val()));
        var totKredit       = parseFloat(CleanNumber($('#idTotalKredit').val()));
        if(totDebet == totKredit){
            if (!confirm("Anda yakin melakukan proses ini ?")){
                e.preventDefault();
                return;
            }
        }else{
            alert("Saldo debet dan kredit tidak sama.");
            return false;
        }
    });
    /*$(document).ajaxStart(function() {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function() {
        $('.modal_json').fadeOut('fast');
    });*/

</script>
