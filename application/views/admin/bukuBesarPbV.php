<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-pin"></i>
                    <span class="caption-subject bold uppercase">Buku Besar Pembantu</span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="forminputjurnal" class="confTrans" role="form" method="post" action="<?php echo base_url('bukubesarpb/home'); ?>">
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
                                                     data-toggle="modal" id="idBtnGL">
                                                      <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                        </span>

                                    </div>
                                    <span class="help-block" id="idNamaPerk"></span>

                                </div>
                                <div class="col-md-1">
                                    <input id="idTxtNamaPerk" name="txtNamaPerk" type="text" placeholder=""
                                           class="form-control bersih sembunyi" required="" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label>Dari tanggal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input name="txtTGlTrans1" id="idTxtTGlTrans1" class="form-control form-control-inline input-medium date-picker " data-date-format="dd-mm-yyyy" type="text" placeholder="dd-mm-yyyy" required="required"/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label>Sampai tanggal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input name="txtTGlTrans2" id="idTxtTGlTrans2" class="form-control form-control-inline input-medium date-picker " data-date-format="dd-mm-yyyy" type="text" placeholder="dd-mm-yyyy" required="required"/>
                                    </div>

                            </div>
                        </div>
                    </div>


                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" name="btnPreview" id="idBtnPreview"><span class="glyphicon glyphicon-floppy-disk"></span> Tampilkan</button>

                        <a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
                            <span class="glyphicon glyphicon-repeat"></span>  Reset
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('metronic/admin/pages/scripts/components-pickers.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/pages/scripts/ui-general.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
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
        ComponentsPickers.init();
        TableManaged.init();
    });
</script>

<script type="text/javascript">
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_11").addClass('start active open');
    $("#idTxtKodePerk").focus();
    $(document).keyup(function(e) {
        if(e.which == 36) {
            $('#idBtnGL').trigger('click');
        }else if(e.which == 34) {
            $('#idBtnAddPerk').trigger('click');
        }
    });

    function kosongkan(){
        $('#idTxtKodePerk').val('');
        $('#idNamaPerk').text('');
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
                $('#idTxtNamaPerk').val(namaPerkiraan);

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

    $(".confTrans").submit(function(e){
        var tgl1        = parseFloat(CleanNumber($('#idTxtTGlTrans1').val()));
        var tgl2       = parseFloat(CleanNumber($('#idTxtTGlTrans2').val()));
        if(tgl2 >= tgl1){
            if (!confirm("Anda yakin melakukan proses ini ?")){
                e.preventDefault();
                return;
            }
        }else{
            alert("Tanggal sampai tidak boleh lebih kecil.");
            return false;
        }
    });
    /*$(document).ajaxStart(function() {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function() {
        $('.modal_json').fadeOut('fast');
    });*/

</script>
