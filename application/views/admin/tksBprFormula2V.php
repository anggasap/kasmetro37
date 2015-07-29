	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="form-body">
            <div class="table-toolbar">
                <table class="table table-striped table-bordered table-hover text_kanan" id="id_TabelUnsurTKS">
                    <thead>
                    <tr>
                        <th>
                            ID Unsur TKS
                        </th>
                        <th>
                            Unsur TKS
                        </th>
                        <th>
                            Formula
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
        <!-- END SAMPLE TABLE PORTLET-->

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
    <!-- BEGIN DATATABLE PLUGINS -->
    <script src="<?php  echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php  echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"  type="text/javascript"></script>
    <!-- END DATATABLE PLUGINS -->
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script> 
<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
<script>

jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Demo.init(); // init demo features
    TableManaged.init();

});
var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#id_TabelUnsurTKS');

        // begin first table
        table.dataTable({
            "ajax": "<?php  echo base_url("/tksBpr/getTksUnsur"); ?>",
            "columns": [
                { "data": "id" },
                { "data": "namaunsur" },
                { "defaultContent": "<button class='btn btn-success btn-sm'> <span class='glyphicon glyphicon-cog'></span>&nbsp;Setting</button>" }

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
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
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

$("#id_TabelUnsurTKS tbody").delegate("tr", "click", function(){
    var data = $(this).find("td").eq(0).html();
    window.location.replace("<?php echo base_url('tksBpr/setFormula/'); ?>"+"/"+data);
});
</script>
    
	<script type="text/javascript">
        // MENU OPEN
        $(".menu_root").removeClass('start active open');
        $("#menu_root_9").addClass('start active open');
        // END MENU OPEN
        $('#txtTanggal').focus();
        $('.nomor').val('0.00');
        $(".nomor").focus(function () {
            $(this).val('');
        });
        $(".nomor").focusout(function () {
            if ($(this).val() == '') {
                $(this).val('0.00');

            } else {
                var angka = $('.nomor').val();
                var result = number_format(angka, 2);
                $('.nomor').val(result);
            }
        });

        $(document).ajaxStart(function () {
            $('.modal_json').fadeIn('fast');
        }).ajaxStop(function () {
            $('.modal_json').fadeOut('fast');
        });
        $('.nomor').keyup(function () {
            var val = $(this).val();
            //val=val.toFixed(2);
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });	// END $('.nomor').keyup(function(){
        // jQuery expression for case-insensitive filter

	</script>
</div>	