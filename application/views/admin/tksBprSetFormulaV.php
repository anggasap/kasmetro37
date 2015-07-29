<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-8">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-blue">
                    <i class="fa fa-edit"></i>Perkiraan Unsur TKS (<?php echo $namaUnsur ?>)
                </div>
                <div class="tools">
                    <div class="btn-group">
                        <a href="#" id="add_perk" class="btn green" data-target="#GL" data-toggle="modal">
                            <span class="glyphicon glyphicon-plus"> </span>
                        </a>
                    </div>
                    <div class="btn-group">
                        <form method="post" id="id_FormHapusPerk">
                            <input type="hidden" class="form-control" id="id_idUnsurHapus" name="idHapusUnsur" value="<?php echo $idUnsur; ?>">
                            <input type="hidden" class="form-control" id="id_idUnsurCache" name="idUnsurCache">
                            <button id="del_perk" class="btn red">
                                <span class="glyphicon glyphicon-minus"> </span>
                            </button>
                        </form>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo base_url("tksBpr/formula/"); ?>" class="btn yellow" >
                            <span class="glyphicon glyphicon-chevron-left"> </span>
                        </a>
                    </div>
                    <button id="id_Reload" style="display: none;">Reload</button>
                </div>
            </div>
            <div class="portlet-body">
                <!--<div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="#" id="add_perk" class="btn green" data-target="#GL" data-toggle="modal">
                                    <span class="glyphicon glyphicon-plus"> </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">

                            </div>
                        </div>
                    </div>
                </div>-->
                <!--START TABLE -->
                <form method="post" id="id_FormCachePerk" style="display:
                none;">
                    <div id="id_eventResult" class="alert display-hide"><!-- display-hide -->
                        <button class="close" data-close="alert"></button>
                        <span id="id_spanResult"> </span>
                    </div>
                    <input type="text" class="form-control" id="id_idUnsur" name="idUnsur" value="<?php echo $idUnsur; ?>">
                    <input type="text" class="form-control" id="id_idPerkiraanCache" name="idPerkiraanCache">
                    <button type="submit" name="btnSubmitPerk" id="id_btnSubmitPerk">Submit</button>
                </form>
                <table class="table table-striped table-bordered table-hover text_kanan" id="id_TabelUnsurTKS">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#id_TabelUnsurTKS .checkboxes"/>
                        </th>
                        <th>
                            ID Unsur TKS
                        </th>
                        <th>
                            Perkiraan
                        </th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                    <tfoot>


                    </tfoot>
                </table>

                <!--END TABLE -->
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <!--<div class="col-md-4">
        <a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i>Kembali</a>
    </div>-->
</div>
<!-- END PAGE CONTENT -->
</div>
</div>
<!-- END CONTENT -->
<div class="clearfix">
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
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#id_TabelUnsurTKS .checkboxes"/>
                                        </th>
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
                <button type="button" data-dismiss="modal" class="btn blue" id="id_button_save_modal">Simpan</button>
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
    var TableManaged = function () {

        var initTable1 = function () {
//        var table = $('#id_TabelUnsurTKS');
            // begin first table
            var table = $('#id_TabelUnsurTKS').dataTable({
                "ajax": "<?php  echo base_url("/tksBpr/getFormulaUnsur/")."/".$idUnsur; ?>",
                "columns": [
                    {
                        "defaultContent": "<input type='checkbox'  class='checkboxes' value='1'/>",
                        className: "dt-body-center", "orderable": false
                    },
                    {"data": "id"},
                    {"data": "namaPerk"},
                    /*{ "defaultContent": "<button class='btn btn-success btn-sm'> <span class='glyphicon glyphicon-cog'></span>&nbsp;Setting</button>" }*/

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
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                "columnDefs": [{  // set default column settings
                    'orderable': false,
                    'targets': [1]
                }, {
                    "searchable": false,
                    "targets": [1]
                }],
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            });

            var tableWrapper = jQuery('#id_TabelUnsurTKS_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");

                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        var y = $(this).parents('tr').addClass("active");
                        if (y) {
                            //var x = $('#id_TabelUnsurTKS tbody tr .active').find("td").eq(1).html();
                            //table.find("td").eq(1).html();
                            //alert(x);
                        } else {
                        }
                        //alert( table.rows('.active').data().length +' row(s) selected' );
                        //alert(x);
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
                var idUnsurCache = $('#id_idUnsurCache').val();
                var idUnsur = $(this).parents('tr').find("td").eq(1).html();

                var checked = jQuery(this).is(":checked");
                if (checked) {
                    idUnsur = idUnsur + ';;';
                    idUnsurCache = idUnsurCache + idUnsur;
                    $('#id_idUnsurCache').val(idUnsurCache);
                } else {
                    idUnsur = idUnsur + ';;';
                    idUnsurCache = idUnsurCache.replace(idUnsur, ""); //idUnsurCache + idUnsur;
                    $('#id_idUnsurCache').val(idUnsurCache);
                }
            });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
                $('#id_TabelPerk tbody tr .checkboxes').attr('checked', false); // Checks it
                $('#id_TabelPerk tbody tr').removeClass("active");
            });
            /*$('#id_Reload').click(function () {
                //alert( table.rows('.active').data().length +' row(s) selected' );
                //table.ajax.reload();
                table.api().ajax.reload();
                table.parents('tr').removeClass("active");
            });*/
            /*table.on('click', 'tbody tr', function () {
             $(this).parents('tr').toggleClass("active");
             var data = table.row( $(this).parents('tr') ).data();
             alert( data[0] +"'s salary is: "+ data[ 5 ] );
             });*/
            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }
        var initTable2 = function () {
            //var table = $('#id_TabelPerk');
            // begin first table
            var table = $('#id_TabelPerk').dataTable({
                "ajax": "<?php  echo base_url("/tksBpr/getAllPerkiraan"); ?>",
                "columns": [
                    {
                        "defaultContent": "<input type='checkbox'  class='checkboxes' value='1'/>",
                        className: "dt-body-center", "orderable": false
                    },
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
                    'targets': [1]
                }, {
                    "searchable": true,
                    "targets": [1]
                }],
                "order": [
                    [1, "asc"]
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
            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
                var idPerkiraanCache = $('#id_idPerkiraanCache').val();//id_idPerkiraanCache
                var idPerkiraan = $(this).parents('tr').find("td").eq(1).html();

                var checked = jQuery(this).is(":checked");
                if (checked) {
                    idPerkiraan = idPerkiraan + ';;';
                    idPerkiraanCache = idPerkiraanCache + idPerkiraan;
                    $('#id_idPerkiraanCache').val(idPerkiraanCache);
                } else {
                    idPerkiraan = idPerkiraan + ';;';
                    idPerkiraanCache = idPerkiraanCache.replace(idPerkiraan, ""); //idPerkiraanCache + idPerkiraan;
                    $('#id_idPerkiraanCache').val(idPerkiraanCache);
                }
            });
            $('#id_button_save_modal').click(function () {
                $( "#id_btnSubmitPerk" ).trigger( "click" );
            });
            /*$('#id_Reload').click(function () {
                *//*table.parents('tr').removeClass("active");*//*
                $('#id_TabelPerk tbody tr .checkboxes').attr('checked', false); // Checks it
                $('#id_TabelPerk tbody tr').removeClass("active");
                //$(this).parents('tr').removeClass("active");
            });*/
            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }

        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
                initTable2();
            }
        };
    }();

    $('#id_FormCachePerk').submit(function (event) {
        dataString = $("#id_FormCachePerk").serialize();
        var r = confirm('Anda yakin menyimpan data ini?');
        if (r== true){
            dataString = $("#id_FormCachePerk").serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>tksBpr/submitFormulaPerkiraan",
                dataType: 'json',
                data: dataString,
                success: function (data) {
                    if (data.pesan1 == 'Sukses') {
                        $("#id_eventResult").removeAttr('style');
                        $("#id_eventResult").removeClass();
                        $("#id_eventResult").addClass("alert alert-info");
                        jQuery("#id_spanResult").html("Komponen perkiraan berhasil ditambahkan.");
                        $( "#id_Reload" ).trigger( "click" );

                    } else {
                        $("#id_eventResult").removeAttr('style');
                        $("#id_eventResult").removeClass();
                        $("#id_eventResult").addClass("alert alert-danger");
                        jQuery("#id_spanResult").html("Komponen perkiraan gagal ditambahkan.");
                    }
                    $('#id_idPerkiraanCache').val('');
                }
            });
            event.preventDefault();
        }else{//if(r)
            return false;
        }
    }); //end  $contact form
    $('#id_FormHapusPerk').submit(function (event) {
        dataString = $("#id_FormHapusPerk").serialize();
        var r = confirm('Anda yakin menghapus data ini?');
        if (r== true){
            dataString = $("#id_FormHapusPerk").serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>tksBpr/deleteFormulaPerkiraan",
                dataType: 'json',
                data: dataString,
                success: function (data) {
                    if (data.pesan1 == 'Sukses') {
                        $("#id_eventResult").removeAttr('style');
                        $("#id_eventResult").removeClass();
                        $("#id_eventResult").addClass("alert alert-info");
                        jQuery("#id_spanResult").html("Komponen perkiraan berhasil dihapus.");
                        $( "#id_Reload" ).trigger( "click" );

                    } else {
                        $("#id_eventResult").removeAttr('style');
                        $("#id_eventResult").removeClass();
                        $("#id_eventResult").addClass("alert alert-danger");
                        jQuery("#id_spanResult").html("Komponen perkiraan gagal dihapus.");
                    }
                    $('#id_idPerkiraanCache').val('');
                }
            });
            event.preventDefault();
        }else{//if(r)
            return false;
        }
    }); //end  $contact form

    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_9").addClass('start active open');
    // END MENU OPEN
</script>

