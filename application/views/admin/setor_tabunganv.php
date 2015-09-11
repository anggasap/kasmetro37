<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
foreach ($pasif->result() as $row_pasif) {
    $rp = $row_pasif->Value;
}
foreach ($norek->result() as $row_norek) {
    $rn = $row_norek->Value;
}
foreach ($counter->result() as $row) {
    $count = $row->CounterNo;
//SETTING KUITANSI
    $pecah = explode(";", $row->StructuredNo);
    $f = ($count + 1) . "-" . $this->session->userdata('user_id');
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

<?php
if ($judul == 'Setoran Tabungan') {
    $attributes = array('id' => 'formtabung_s', 'role' => 'form');
    echo form_open('setor_tarik_tabungan/setor', $attributes);
    foreach ($setoran->result() as $row) {
        $kd_setor = $row->kode_trans;
        $dk_setor = $row->TYPE_TRANS;
        $tob_def = $row->TOB;
    }
} elseif ($judul == 'Penarikan Tabungan') {
    $attributes = array('id' => 'formtabung_t', 'role' => 'form');
    echo form_open('setor_tarik_tabungan/tarik', $attributes);
    foreach ($tarikan->result() as $row) {
        $kd_tarik = $row->kode_trans;
        $dk_tarik = $row->TYPE_TRANS;
        $tob_def = $row->TOB;
    }
}
?>
<!-- START DIV CLASS ROW FOR SIZE 6 -->
<div class="row">
<div class="col-md-6">
    <div class="form-body">
        <div class="row">
            <div class="col-md-6" style="display: none;">
                <div class="form-group">
                    <label>Tanggal</label>

                    <div class="input-group">
                                            <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </span>
                        <?php echo form_input(array('name' => 'txtTGlTrans', 'id' => 'txtTGlTrans', 'class' => 'form-control input-small', 'value' => $this->session->userdata('tglD'), 'readonly' => 'true')); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                if ($rp == 'DITAMPILKAN') {
                    ?>
                    <label for="txtRekTab" id="lblStatus" style="font-weight: bolder;color: #ff0000;">
                    </label>
                <?php
                }
                ?>
                <input id="txtBulan" name="txtBulan" class=" input-mini bersih" type="hidden"
                       value="<?php foreach ($bln->result() as $row_bln) {
                           if ($row_bln->Value == '> 3 BULAN') {
                               echo "3";
                           } elseif ($row_bln->Value == '> 6 BULAN') {
                               echo "6";
                           } elseif ($row_bln->Value == '> 1 TAHUN') {
                               echo "12";
                           }
                       } ?>
									  "> <!-- end dari input id=txtBulan -->
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>No rekening tabungan :</label>

                    <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-tag"></i>
                                    </span>
                        <input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rek Tabungan"
                               class="form-control bersih input-medium" required="">
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
            <label>Nama nasabah :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                    </span>
                <?php echo form_input(array('name' => 'txtNama', 'id' => 'txtNama', 'class' => 'bersih form-control input-large', 'required' => 'required', 'placeholder' => 'Nama nasabah', 'readonly' => 'true')); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Alamat</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-home"></i>
                                    </span>
                <?php
                $data = array(
                    'name' => 'txtAlamat',
                    'id' => 'txtAlamat',
                    'placeholder' => 'Alamat nasabah',
                    'rows' => '2',
                    'class' => 'form-control bersih input-large',
                    'readonly' => 'readonly'
                );
                echo form_textarea($data);
                ?>
            </div>
        </div>
        <div class="form-group">
            <label>Jenis simpanan :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-suitcase"></i>
                                    </span>
                <input id="txtJenisSimp" name="txtJenisSimp" type="text" placeholder="Jenis Simpanan"
                       class="form-control bersih input-large" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <label>Saldo saat ini :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                <?php echo form_input(array('name' => 'txtSaldoBTrans', 'id' => 'txtSaldoBTrans', 'class' => 'form-control nomor input-large', 'readonly' => 'true', 'style' => 'text-align:right')); ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-body">
        <?php
        if ($judul == 'Setoran Tabungan') {
            ?>
            <div class="form-group">
                <label>Setoran minimum :</label>

                <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                    <?php echo form_input(array('name' => 'txtSaldoATrans', 'id' => 'txtSaldoATrans', 'class' => 'form-control nomor input-medium', 'readonly' => 'true', 'style' => 'text-align:right')); ?>
                </div>
            </div>
        <?php
        } elseif ($judul == 'Penarikan Tabungan') {
            ?>
            <div class="form-group">
                <label>Saldo minimum :</label>

                <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                    <?php echo form_input(array('name' => 'txtSaldoMin', 'id' => 'txtSaldoMin', 'class' => 'form-control nomor input-medium', 'readonly' => 'true', 'style' => 'text-align:right')); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Saldo dapat ditarik :</label>

                <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                    <?php echo form_input(array('name' => 'txtSaldoDptTarik', 'id' => 'txtSaldoDptTarik', 'class' => 'form-control nomor input-medium', 'readonly' => 'true', 'style' => 'text-align:right')); ?>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="form-group">
            <label>Saldo setelah :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                <?php echo form_input(array('name' => 'txtSaldoStlh', 'id' => 'txtSaldoStlh', 'class' => 'form-control nomor input-medium', 'readonly' => 'true', 'style' => 'text-align:right')); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Kuintansi :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                    </span>
                <input id="txtKuitansi" name="txtKuitansi" type="text" placeholder="No kuitansi"
                       class="form-control bersih input-medium" required="" onkeyup="ToUpper(this);"
                       readonly="readonly">
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
                        if ($judul == 'Setoran Tabungan') {
                            $def_kode = $kd_setor;
                            $type_dk_trans = $dk_setor;
                            foreach ($kodetrans_setor as $row) :
                                $data[$row['KODE_TRANS']] = $row['DESKRIPSI_TRANS'];
                            endforeach;
                        } else {
                            $def_kode = $kd_tarik;
                            $type_dk_trans = $dk_tarik;
                            foreach ($kodetrans_tarik as $row) :
                                $data[$row['KODE_TRANS']] = $row['DESKRIPSI_TRANS'];
                            endforeach;
                        }

                        ?>
                        <?php
                        echo form_dropdown('DL_kodetrans', $data, $def_kode, 'id="DL_kodetrans" class="form-control input-medium"');
                        //echo form_input(array('name'=>'txtDekripTrans','style'=>'width:175px;','id'=>'txtDekripTrans','readonly'=>'true'));
                        echo form_input(array('name' => 'txtTypeTrans', 'id' => 'txtTypeTrans', 'class' => 'input-small hidden', 'readonly' => 'true', 'value' => $type_dk_trans));
                        ?>
                    </div>
                </div>

                <div class="col-md-1">
                    <label>&nbsp;</label>

                    <div class="input-group">
                        <input id="txtJenisTrans" name="txtJenisTrans" type="text" style="width:96px;" required=""
                               readonly="readonly" class="form-control" value="<?php echo $tob_def; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Jumlah :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                    </span>
                <input id="txtJml" name="txtJml" type="text" class="form-control nomor input-medium" required=""
                       onkeyup="" style="text-align:right;">
            </div>
        </div>
        <div class="form-group">
            <label id="terbilang" style="color: red"></label>
            <span id="errmsg" style="color: red;font-weight: bold;"></span>
        </div>
        <div class="form-group">
            <input id="txtKdPerk" name="txtKdPerk" type="hidden" class="input-small">
            <input type="hidden" id="txtsaldosetor" name="txtsaldosetor"/>
            <input type="hidden" id="txtsaldotarik" name="txtsaldotarik"/>
            <label>Keterangan :</label>

            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-list"></i>
                                    </span>
                <?php
                $data = array(
                    'name' => 'txtKet',
                    'id' => 'txtKet',
                    'placeholder' => 'Keterangan',
                    'rows' => '2',
                    'class' => 'form-control bersih input-large'
                );
                echo form_textarea($data);
                ?>
                <?php echo form_input(array('name' => 'txtcounter', 'class' => 'hidden', 'id' => 'txtcounter', 'value' => '')); ?>
                <input id="txtNasabahID" name="txtNasabahID" type="hidden" class="input-mini bersih ">
            </div>
        </div>

    </div>
    <!-- END FORM BODY-->
</div>
</div>
<!-- END DIV CLASS ROW FOR SIZE 6 -->
<div class="form-actions">
    <button type="submit" name="btnSimpan" class="btn blue" id="btnSimpan"><span
            class="glyphicon glyphicon-floppy-disk"></span> Simpan
    </button>
    <a class="btn green" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi">
        <span class="glyphicon glyphicon-print"></span> Validasi
    </a>
    <a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
        <span class="glyphicon glyphicon-repeat"></span> Reset
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
                <h4 class="modal-title">Data Rekening Tabungan</h4>
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelRekTab">
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
$("#menu_root_3").addClass('start active open');
// END MENU OPEN

var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#idTabelRekTab');

        // begin first table
        table.dataTable({
            "ajax": "<?php  echo base_url("/setor_tarik_tabungan/getRekTab"); ?>",
            "columns": [
                { "data": "norektab" },
                { "data": "namanasabah" },
                { "data": "alamat" },
                { "data": "saldoakhir" }

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
            $('#txtRekTab').val(noRekTab);
            $('#id_button_close_modal').trigger('click');
            $('#txtRekTab').focus();

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
function CleanNumber(value) {
    newValue = value.replace(/\,/g, '');
    return newValue;
}
function saldo_setelah() {
    var jml_trans = parseFloat(CleanNumber($("#txtJml").val()));
    if (isNaN(jml_trans)) jml_trans = 0;
    var kode_trans = $("#txtTypeTrans").val();
    if (kode_trans == 'K') {
        var saldo_saat_ini = parseFloat(CleanNumber($("#txtSaldoBTrans").val()));
        if (isNaN(saldo_saat_ini)) saldo_saat_ini = 0;
        var saldo_setelah = jml_trans + saldo_saat_ini;
    } else {
        var saldo_saat_ini = parseFloat(CleanNumber($("#txtSaldoDptTarik").val()));
        if (isNaN(saldo_saat_ini)) saldo_saat_ini = 0;
        var saldo_setelah = saldo_saat_ini - jml_trans;
    }
    $("#txtSaldoStlh").val(number_format(saldo_setelah, 2));
}

$("#txtJml").focusout(function () {
    if ($(this).val() == '') {
        $(this).val('0.00');
    } else {
        var angka = $('#txtJml').val();
        var result = number_format(angka, 2);
        $('#txtJml').val(result);
        //var words = toWords(angka);
        //$('#terbilang').text(words);
    }
});
$('#txtJml').focusout(function () {
    if (this.value == 0) {
        $('#txtJml').val(0);
        $('#terbilang').text("nol");

    } else {
        var angka = $('#txtJml').val();
        var words = toWords(angka);
        $('#terbilang').text(words);
    }
    saldo_setelah();
});

function pad2(number) {
    return (number < 10 ? '0' : '') + number
}
//fungsi cetak
function cetak_validasi() {

    var newWindow = window.open('Validasi', '_blank');
    var d = new Date();
    var jam = pad2(d.getHours()); // => 9
    var mnt = pad2(d.getMinutes()); // =>  30
    var dtk = pad2(d.getSeconds()); // => 51


    var kode_trans = $('#DL_kodetrans').val();//kode trans
    var desk_trans = $('#DL_kodetrans option:selected').text();
    var kuitansi = $("#txtKuitansi").val();
    var kode_gl = $("#txtKodeGL").val();
    var jml_trans = $("#txtJml").val();
    var tgl_trans = $('#txtTGlTrans').val();
    var no_rek = $('#txtRekTab').val();
    var nama = $('#txtNama').val();
    var saldo_stlh = $('#txtSaldoStlh').val();
    var html1 = '<span style="font-size: 11px;">' + tgl_trans + " " + jam + ":" + mnt + ":" + dtk + " " + kode_trans + "-" + desk_trans + '</span><br>';
    var html2 = '<span style="font-size: 11px;">' + no_rek + " " + nama + "</span><br>";
    var html3 = '<span style="font-size: 11px;">' + kuitansi + " CR " + jml_trans + "/ Saldo : " + saldo_stlh + '</span>';
    newWindow.document.open();
    newWindow.document.write(html1);
    newWindow.document.write(html2);
    newWindow.document.write(html3);
    newWindow.print();
    newWindow.document.close();
}
function capitalizeEachWord(str) {
    var words = str.split(" ");
    var arr = Array();
    for (i in words) {
        temp = words[i].toLowerCase();
        temp = temp.charAt(0).toUpperCase() + temp.substring(1);
        arr.push(temp);
    }
    return arr.join(" ");
}
function cetak_kuitansi() {
    var newWindow = window.open('Kuitansi', '_blank');
    var desk_trans = $('#DL_kodetrans option:selected').text();
    var kuitansi = $("#txtKuitansi").val();
    var jml_trans = $("#txtJml").val();
    var tgl_trans = $('#txtTGlTrans').val();
    var no_rek = $('#txtRekTab').val();
    var nama = $('#txtNama').val();
    var terbilang = $('#terbilang').text();
    terbilang = terbilang.replace(" koma nol nol", "");
    var ket = $('#txtKet').val();
    var lokasi = $('#id_session_lokasi').val();
    var user = $('#id_session_user').val();
    var nama_lkm = $('#id_session_nama_lkm').val();

    var htm1 = '<table style="width:700px; font-size: 11px;">';
    var htm2 = '<tr>';
    var htm3 = '';
    var htm4 = '<td colspan="3">TANDA TERIMA TRANSAKSI TABUNGAN</br>' + nama_lkm + '</td>';
    var htm5 = '';
    var htm6 = '<td colspan="4">';

    var htm7 = '<table style="border:1px solid black; border-collapse:collapse; font-size: 11px; width:300px;"><tr><td style="border:1px solid black;">Adm</td><td style="border:1px solid black;">Akunting</td><td style="border:1px solid black;">SPI</td></tr><tr height="20"><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td></tr></table>';//
    //  var htm7 =desk_trans; <font face="Courier New, Courier, monospace">
    var htm8 = '</td>';
    var htm9 = '</tr>';
    var htm10 = ' <tr><td align="right"></td><td></td><td colspan="4" align="right">' + desk_trans + '</td></tr>';
    var htm11 = ' <tr><td align="right">No. Bukti </font></td><td>:</td><td>' + kuitansi + '</td><td colspan="4"></td></tr>';
    var htm12 = ' <tr><td align="right">Nama Nasabah</td><td>:</td><td>' + nama + '</td><td colspan="4"></td></tr>';
    var htm13 = ' <tr><td align="right">No Rekening</td><td>:</td><td>' + no_rek + '</td><td colspan="4"></td></tr>';
    var htm14 = ' <tr><td align="right">Keterangan</td><td>:</td><td>' + ket + '</td><td colspan="2"></td></tr>';
    var htm15 = ' <tr><td align="right">Nominal</td><td>:</td><td>Rp ' + jml_trans + '</td><td colspan="2"></td></tr>';
    var htm16 = ' <tr><td align="right">Terbilang</td><td>:</td><td>' + capitalizeEachWord(terbilang) + ' Rupiah</td><td colspan="5"></td></tr>';
    var htm19 = '<tr><td></td><td></td><td></td><td></td><td colspan="3" align="right">' + lokasi + ', ' + tgl_trans + '</tr>';
    var htm18 = '<tr><td></td><td></td><td></td><td></td><td style="border-bottom: 1px solid black; width:100px; height:100px;"></td><td>&nbsp;</td><td style="border-bottom: 1px solid black; width:100px; height:100px;"></td></tr>';
    var htm20 = '<tr><td></td><td></td><td></td><td></td><td>' + user + '</td><td>&nbsp;</td><td style=""></td></tr>';
    var htm17 = ' </table>';


    // var html4 =tbsa+trsa+tdsa+"TANDA TERIMA "+tdso+trso+tbso;
    newWindow.document.open();
    newWindow.document.write(htm1);
    newWindow.document.write(htm2);
    newWindow.document.write(htm3);
    newWindow.document.write(htm4);
    newWindow.document.write(htm5);
    newWindow.document.write(htm6);
    newWindow.document.write(htm7);
    newWindow.document.write(htm8);
    newWindow.document.write(htm9);
    newWindow.document.write(htm10);
    newWindow.document.write(htm11);
    newWindow.document.write(htm12);
    newWindow.document.write(htm13);
    newWindow.document.write(htm14);
    newWindow.document.write(htm15);
    newWindow.document.write(htm16);
    newWindow.document.write(htm19);
    newWindow.document.write(htm18);
    newWindow.document.write(htm20);
    newWindow.document.write(htm17);
    newWindow.print();
    newWindow.document.close();
}
//end fungsi cetak
function DateDiff(date1, date2) {
    return (date2 - date1) / (1000 * 30 * 60 * 60 * 24);
    //mengembalikan jumlah hari
}
function proses() {
    var item = $("#txtNasabahID").val();

    $.post("<?php echo site_url('/setor_tarik_tabungan/process'); ?>", {'item': item},
        function (data) {
            //alert(data.norek.length);
            $('#body').empty();
            var tr;
            for (var i = 0; i < data.norek.length; i++) {

                a = data.norek[i].NO_REKENING;
                b = data.norek[i].DESKRIPSI_JENIS_KREDIT;
                c = data.norek[i].SALDO_AKHIR;

                tr = $('<tr/>');
                tr.append("<td>" + a + "</td>");
                tr.append("<td>" + b + "</td>");
                tr.append("<td>" + number_format(c, 2) + "</td>");
                $('#body').append(tr);
            }
        }, "json");
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
function ajax_submit_setor() {
    ajaxModal();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>setor_tarik_tabungan/setor_tabungan",
        data: dataString,

        success: function (data) {
            //$('#btnSimpan').hide();
            alert('Transaksi setoran telah tersimpan!');
            $( "#id_Reload" ).trigger( "click" );
            $("#btnSimpan").attr("disabled", "disabled");
        }

    });
    event.preventDefault();
}
function ajax_submit_tarik() {
    ajaxModal();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>setor_tarik_tabungan/tarik_tabungan",
        data: dataString,

        success: function (data) {
            alert('Transaksi penarikan tersimpan!');
            $( "#id_Reload" ).trigger( "click" );
            //$('#btnSimpan').hide();
            $("#btnSimpan").attr("disabled", "disabled");
        }

    });
    event.preventDefault();
}
$(function () {
    $('#formtabung_s').submit(function (event) {
        dataString = $("#formtabung_s").serialize();
        var jml_bayar = parseFloat(CleanNumber($("#txtJml").val()));
        var set_min = parseFloat(CleanNumber($("#txtSaldoATrans").val()));

        if (jml_bayar == 0) {
            alert('Jumlah setoran tidak boleh 0 !');
            return false;
        } else if (jml_bayar < set_min) {
            alert('Jumlah setoran harus lebih besar dari setoran minimum!');
            return false;
        } else {
            var kode_trans = $("#txtTypeTrans").val();
            if (kode_trans == 'K') {
                var r = confirm('Anda yakin menyimpan data ini?');
                if (r == true) {
                    ajax_submit_setor();
                } else {//if(r)
                    return false;
                }
            } else {
                alert('Kode transaksi salah!');
            }

        }
    }); //end  $contact form

    $('#formtabung_t').submit(function (event) {
        dataString = $("#formtabung_t").serialize();
        var jml_tarik = parseFloat(CleanNumber($("#txtJml").val()));
        var saldo_dpt_tarik = parseFloat(CleanNumber($("#txtSaldoDptTarik").val()));
        if (jml_tarik == 0) {
            alert('Jumlah tarikan tidak boleh 0 !');
            return false;
        } else if (jml_tarik > saldo_dpt_tarik) {
            alert('Jumlah penarikan tidak boleh lebih besar dari saldo yang dapat ditarik!');
            return false;
        } else {
            var kode_trans = $("#txtTypeTrans").val();
            if (kode_trans == 'D') {
                var r = confirm('Anda yakin menyimpan data ini?');
                if (r == true) {
                    ajax_submit_tarik();
                } else {//if(r)
                    return false;
                }
            } else {
                alert('Kode transaksi salah!');
            }//else{
        }//else{
    }); //end  $contact form


});/// end $func
function ajaxModal(){
    $(document).ajaxStart(function() {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function() {
        $('.modal_json').fadeOut('fast');
    });
}
$(document).ready(function () {
    $('#txtRekTab').focus();
    $('#lblStatus').text('');
    $('#lblStatus').hide();
    $('.nomor').val('0.00');
    var trans = "<?php echo $judul; ?>";


    var tgl_trans = $('#txtTGlTrans').val();
    var substring = tgl_trans.substring(0, tgl_trans.length);
    var coordinates = substring.split("-");
    var tgl = coordinates[0];
    var bln = coordinates[1];
    var thn = coordinates[2];
    var tgl_akhir = thn + "-" + bln + "-" + tgl;

    var bln = $('#txtBulan').val();

    $('#txtJml').keyup(function () {
        var angka = $('#txtJml').val();
        var words = toWords(angka);
        $('#terbilang').text(words);

    });

    $('#txtJml').keyup(function () {
        var val = $(this).val();
        //val=val.toFixed(2);
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
    });
    $('#DL_kodetrans').change(function () {
        var kd = $('#DL_kodetrans').val();
        $.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_trans'); ?>",
            {
                'kodetrans': kd
            },
            function (data) {

                //$('#txtDekripTrans').val(data.deskripsitrans);
                $('#txtKdPerk').val(data.gl_trans);
                var t = (data.tob);
                $('#txtJenisTrans').val(t);
                /*
                 if(t=='T'){
                 $('#txtJenisTrans').val('Tunai');
                 }
                 else if(t=='O'){
                 $('#txtJenisTrans').val('Overbooking');
                 }
                 */
            }, "json");
    });

    $("#txtJml").focus(function () {
        $('#txtJml').val('');
        //$('#txtJml').focus();
    });
    $("#txtRekTab").focusout(function () {
        this.value = this.value.toUpperCase();
        var kd = $('#txtRekTab').val();
        kd = kd.trim();
        getDeskripsiRekTab(kd);
    });


}); //end ready document

function getDeskripsiRekTab(noRekTab){
    ajaxModal();
    var kd = noRekTab;
    if (kd != '') {
        //  alert(kd);
        $.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",
            {
                'norek': kd
            },
            function (data) {
                if (data.baris == 1) {
                    var saldo = number_format(data.SALDO_AKHIR, 2);
                    var setor_min = number_format(data.SETORAN_MINIMUM, 2);
                    var saldo_blk = number_format(data.SALDO_BLOKIR, 2);
                    var saldo_min = number_format(data.MINIMUM_DEFAULT, 2);
                    var saldo_dpt_tarik = (data.SALDO_AKHIR) - (data.SETORAN_MINIMUM);
                    var saldo_dpt_tarik = number_format(saldo_dpt_tarik, 2);
                    //txtSaldoDptTarik
                    $('#txtNama').val(data.NAMA_NASABAH);
                    $('#txtNasabahID').val(data.NASABAH_ID);
                    $('#txtAlamat').val(data.ALAMAT);
                    $('#txtSaldoBTrans').val(saldo);
                    $('#txtSaldoATrans').val(setor_min);
                    $('#txtSaldoMin').val(saldo_min);
                    $('#txtSetorNormal').val(saldo_blk);
                    $('#txtJenisSimp').val(data.DESKRIPSI_JENIS_TABUNGAN);

                    $('#txtSaldoDptTarik').val(saldo_dpt_tarik);
                    var kode_trans = $("#txtTypeTrans").val();
                    if (kode_trans == 'K') {
                        $('#txtSaldoStlh').val(saldo);
                    } else {
                        $('#txtSaldoStlh').val(saldo_dpt_tarik);
                    }
                    var tanggal = (data.TGL_TRANS_TERAKHIR);
                    //var t = moment(tanggal).format('YYYY-MM-DD');

                    /*var dt = DateDiff(new Date(t), new Date(tgl_akhir));
                    if (dt > bln) {
                        $("#lblStatus").show();
                        $("#lblStatus").text("PASIF");
                    } else {
                        $("#lblStatus").show();
                        $("#lblStatus").text("AKTIF");
                    }*/
                    var k = "<?php echo $f; ?>";
                    var c = "<?php echo $count+1; ?>";
                    $("#txtcounter").val(c);
                    $("#txtKuitansi").val(k);
                    //$('#cari_rek').modal('hide');
                    $('#txtJml').val('');
                    $('#txtJml').focus();
                    //proses();
                } else {
                    alert('Data tidak ditemukan!');
                    $('.bersih').val('');
                    $('.nomor').val('0.00');
                    $('#txtJml').val(number_format(0, 2));
                    $('#txtcounter').val('');
                    $('#txtRekTab').focus();
                }
            }, "json");
    }//if kd<>''

}
// jQuery expression for case-insensitive filter
/*$.extend($.expr[":"],
    {
        "contains-ci": function (elem, i, match, array) {
            return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
                .toLowerCase()) >= 0;
        }
    });*/
</script>