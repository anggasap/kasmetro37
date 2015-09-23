<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-th"></i> <?php echo $judul; ?>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form id="formtabungan" role="form" method="post" action="">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis tabungan :</label>
                                            
                                                 <?php
                                                  $data = array(
                                                   $data['']=''
                                                      );
                                                      foreach($jenis_tab as $row) : 
                                                              $data[$row['KODE_JENIS_TABUNGAN']] = $row['DESKRIPSI_JENIS_TABUNGAN'];
                                                      endforeach; 
                                                      echo form_dropdown('DL_jenis_tab', $data,'','id="DL_jenis_tab" class="form-control bersih"');
                                                  ?>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label>Status :</label>
                                                 <select name="DL_status_tab" id="DL_status_tab" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;" class="form-control" readonly>
                                                    <option value="1" selected="selected">Baru</option>
                                                    <option value="2">Aktif</option>
                                                    <option value="3">Tutup</option>
                                                </select>                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nomor rekening :</label>
                                            <div class="input-group">
                                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                                 <?php echo  form_input(array('name'=>'txtNoRekTab','class'=>'bersih form-control','id'=>'txtNoRekTab','required'=>'required'));?>
                                            	<span class="input-group-btn">
                                                  <a href="#" class="btn green" data-target="#idDivTabelRekTab" data-toggle="modal">
                                                      <span class="glyphicon glyphicon-search"></span>
                                                  </a>
                                                  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Series :</label>
                                                 <?php echo  form_input(array('name'=>'txtNoSeries','class'=>'bersih form-control','id'=>'txtNoSeries'));?>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nasabah id :</label>
                                            <div class="input-group">
                                                 <?php echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih form-control','id'=>'txtNasabahId','placeholder'=>'Nasabah/Anggota ID'));?>
                                                 <span class="input-group-btn">
                                                  <a href="#" class="btn green" data-target="#idDivTabelNasabah" data-toggle="modal">
                                                      <span class="glyphicon glyphicon-search"></span>
                                                  </a>
                                                  </span> 
                                            </div>
                                            <div class="input-group">
                                                 <?php echo  form_input(array('name'=>'txtNama','class'=>'bersih form-control','id'=>'txtNama','placeholder'=>'Nama Nasabah/Anggota','readonly'=>'readonly'));?>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <label>Alamat :</label>
                                                 <?php
												  $data = array(
													  'name'        => 'txtAlamat',
													  'id'          => 'txtAlamat',
													  'onkeyup'     => 'ToUpper(this)',
													  'rows'        => '3',
													  'class'		  =>'form-control bersih',
													  'maxlength'	  =>'100',
													  'placeholder' => 'Alamat',
													  'readonly'    =>'readonly'
													);
												  echo form_textarea($data);
												  ?>                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Bunga per tahun (%) :</label>
                                            
                                                 <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor kanan form-control','id'=>'txtBunga'));?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>PPH per bulan (%) :</label>
                                            <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor kanan form-control','id'=>'txtPph'));?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tgl terhitung bunga :</label>
                                            <?php echo  form_input(array('name'=>'txtTerhitungBunga','class'=>' form-control','id'=>'txtTerhitungBunga','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode group 1 :</label>
                                                 <?php
												$data = array();
													foreach($kode_group1 as $row) : 
															$data[$row['KODE_GROUP1']] = $row['DESKRIPSI_GROUP1'];
													endforeach; 
													echo form_dropdown('DL_kodegroup1_tab', $data,'','id="DL_kodegroup1_tab" class="form-control bersih"');
												?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode Group 2</label>
											<?php
                                            $data = array();
                                            $data['']='';
                                                foreach($kode_group2 as $row) : 
                                                        $data[$row['KODE_GROUP2']] = $row['DESKRIPSI_GROUP2'];
                                                endforeach; 
                                                echo form_dropdown('DL_kodegroup2_tab', $data,'','id="DL_kodegroup2_tab" class="form-control bersih"');
                                            ?>              
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <div class="form-body">
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode group 3 :</label>
                                                 <?php
												  $data = array();
												  $data['']='';
													  foreach($kode_group3 as $row) : 
															  $data[$row['KODE_GROUP3']] = $row['DESKRIPSI_GROUP3'];
													  endforeach; 
													  echo form_dropdown('DL_kodegroup3_tab', $data,'','id="DL_kodegroup3_tab" class="form-control bersih"');
												  ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode Pemilik</label>
											<?php
											$data = array();
											$data['']='';
												foreach($kode_gol_deb_tab as $row) : 
														$data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
												endforeach; 
												echo form_dropdown('DL_kodegoldeb_tab', $data,'','id="DL_kodegoldeb_tab" class="form-control bersih"');
											?>                                   
                                        </div>
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode metoda :</label>
                                                 <?php
												  $data = array();
												  $data['']='';
													  foreach($kode_metoda as $row) : 
															  $data[$row['kode_metoda']] = $row['deskripsi_metoda'];
													  endforeach; 
													  echo form_dropdown('DL_kodemetoda', $data,'','id="DL_kodemetoda" class="form-control bersih"');
												  ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Hubungan</label>
											<?php
											$data = array();
											$data['']='';
												foreach($kode_hub_tab as $row) : 
														$data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
												endforeach; 
												echo form_dropdown('DL_kodehub_tab', $data,'','id="DL_kodehub_tab" class="form-control bersih"');
											?>                              
                                        </div>
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Restricted :</label>
                                                 <select name="DL_restrict" id="DL_restrict"  onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;" class="form-control">
                                                  <option value="UNRESTRICTED" selected="selected">UNRESTRICTED</option>
                                                  <option value="RESTRICTED">RESTRICTED</option>
                                                  </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tipe tabungan :</label>
											<select name="DL_tipe_tab" id="DL_tipe_tab" class="form-control">
                                            <option value="1" selected="selected">TABUNGAN</option>
                                            <option value="2">AB-PASIVA</option>
                                            <option value="3">AB-AKTIVA</option>
                                            <option value="4">MODAL</option>
                                            <option value="5">KEWAJIBAN</option>
                                            </select>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Saldo minimal :</label>
                                                 <?php echo  form_input(array('name'=>'txtSaldoMin','class'=>'nomor kanan form-control','id'=>'txtSaldoMin'));?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Biaya adm :</label>
											<?php echo  form_input(array('name'=>'txtBiayaAdm','class'=>'nomor kanan form-control','id'=>'txtBiayaAdm'));?>	
                                        </div>
                                        <div class="col-md-4">
                                            <label>Biaya adm :</label>
												<select name="DL_frek_adm" id="DL_frek_adm" class="form-control">
                                                <option value="1"  selected="selected">Per Bulan</option>
                                                <option value="2">Per 2 Bulan</option>
                                                <option value="3">Per 3 Bulan</option>
                                                <option value="4">Per 4 Bulan</option>
                                                <option value="5">Per 5 Bulan</option>
                                                <option value="6">Per 6 Bulan</option>
                                                <option value="7">Per 7 Bulan</option>
                                                <option value="8">Per 8 Bulan</option>
                                                <option value="9">Per 9 Bulan</option>
                                                <option value="10">Per 10 Bulan</option>
                                                <option value="11">Per 11 Bulan</option>
                                                <option value="12">Per 12 Bulan</option>
                                                </select>	
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Setoran minimal :</label>
                                                 <?php echo  form_input(array('name'=>'txtSetoranMin','class'=>'nomor kanan form-control','id'=>'txtSetoranMin'));?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Estimasi bunga</label>
												<?php echo  form_input(array('name'=>'txtEstimasiBunga','class'=>'nomor kanan form-control','id'=>'txtEstimasiBunga','readonly'=>'readonly'));?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>Setoran wajib :</label>
                                                 <?php echo  form_input(array('name'=>'txtSetoranWajib','class'=>'nomor kanan form-control','id'=>'txtSetoranWajib'));?>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Jkw :</label>
                                            
												<?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'nomor1 kanan form-control','id'=>'txtJangkaWaktu'));?>
                                            </div>
                                        <div class="col-md-5">
                                            <label>Transaksi normal :</label>
												<?php echo  form_input(array('name'=>'txtTransaksiNormal','class'=>'nomor kanan form-control','id'=>'txtTransaksiNormal'));?>
                                        </div>
                                    </div>
                                </div>
                            	  
                                
                            </div>
                            <!-- END FORM BODY-->
                        </div>    
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" id="btnSimpan"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>               
       					<button class="btn green"  id="btnUbah" name="btnUbah">
                        	<span class="glyphicon glyphicon-edit"></span> Ubah
                        </button>
       					<a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
       						<span class="glyphicon glyphicon-repeat"></span>  Reset
       					</a>
       					<button class="btn yellow" id="btnHapus" name="btnHapus">
                        	<span class="glyphicon glyphicon-trash"></span> Hapus
                        </button>
                    </div>
            	</form>    
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

<!-- /.modal -->
<div id="idDivTabelNasabah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Nasabah</h4>
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
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelNasabah">
                                    <thead>
                                    <tr>
                                        <th>
                                            Id Nasabah
                                        </th>
                                        <th>
                                            Nama Nasabah
                                        </th>
                                        <th>
                                            Alamat
                                        </th>
                                        <th>
                                            No ID
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
<!-- /.modal -->
<div id="idDivTabelRekTab" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="idBtnCloseModalRekTab" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Rekening</h4>
            </div>

            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadRekTab" style="display: none;"></button>
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
                                            Nasabah Id
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

<script src="<?php // echo base_url('bootstrap/js/pembantu.js') ?>"></script>
<script src="<?php //echo base_url('bootstrap/js/terbilang.js') ?>"></script>
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
	$("#menu_root_6").addClass('start active open');
	// END MENU OPEN
</script>
<script type="text/javascript">
var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#idTabelNasabah');

        // begin first table
        table.dataTable({
            "ajax": "<?php  echo base_url("/master_nasabah_c/getNasabahAll"); ?>",
            "columns": [
                { "data": "nasabah_id" },
                { "data": "nama_nasabah" },
                { "data": "alamat" },
                { "data": "no_id" }

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
            var nasabahId 		= $(this).find("td").eq(0).html();           
            $('#txtNasabahId').val(nasabahId);
            var namaNasabah		= $(this).find("td").eq(1).html();
            $('#txtNama').val(namaNasabah);
            var alamatNasabah	= $(this).find("td").eq(2).html();
            $('#txtAlamat').val(alamatNasabah);
            $('#id_button_close_modal').trigger('click');
            $('#txtNasabahId').focus();

        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }
    
    var initTable2 = function () {

        var table = $('#idTabelRekTab');

        // begin first table
        table.dataTable({
            "ajax": "<?php  echo base_url("/master_tabungan_c/getRekTabAll"); ?>",
            "columns": [
				{ "data": "noRek" },
                { "data": "nasabahId" },
                { "data": "namaNasabah" },
                { "data": "alamat" },
                { "data": "saldoAkhir" }

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
        $('#id_ReloadRekTab').click(function () {
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
        	var noRekTab 		= $(this).find("td").eq(0).html();           
            $('#txtNoRekTab').val(noRekTab);
            var nasabahId 		= $(this).find("td").eq(1).html();           
            $('#txtNasabahId').val(nasabahId.trim());
            var namaNasabah		= $(this).find("td").eq(2).html();
            $('#txtNama').val(namaNasabah);
            var alamatNasabah	= $(this).find("td").eq(3).html();
            $('#txtAlamat').val(alamatNasabah);
            $('#idBtnCloseModalRekTab').trigger('click');
            $('#txtNoRekTab').focus();

            $("#btnSimpan").attr("disabled", "disabled");
            $("#btnUbah").removeAttr("disabled");
			$("#btnHapus").removeAttr("disabled");

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
            initTable2();
        }
    };

}();
		function confirm_reset(){
			var r = confirm('Reset formulir ??');
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('#DL_status_tab').val('1');
				$('#DL_jenis_tab').focus();
				$('#DL_restrict').val('UNRESTRICTED');
				$('#DL_tipe_tab').val('1');
				$("#btnSimpan").removeAttr("disabled");
				//$('#btnSimpan').show();
				//check_load();
			}
		}
		function ajaxModal(){
		    $(document).ajaxStart(function() {
		        $('.modal_json').fadeIn('fast');
		    }).ajaxStop(function() {
		        $('.modal_json').fadeOut('fast');
		    });
		}
		$( "#DL_jenis_tab" ).change(function() {
			 ajaxModal();
			 var kd=$(this).val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/master_tabungan_c/desk_prod_tabungan'); ?>",
					  {
						  'kd_tab' 		: kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtNoRekTab').val(data.lastNoRek);
							  $('#txtBunga').val(number_format(data.SUKU_BUNGA_DEFAULT,2));
							  $('#txtPph').val(number_format(data.PPH_DEFAULT,2));
							  $('#txtSaldoMin').val(number_format(data.MINIMUM_DEFAULT,2));
							  $('#txtBiayaAdm').val(number_format(data.ADM_PER_BLN_DEFAULT,2));
							  $('#txtSetoranMin').val(number_format(data.SETORAN_MINIMUM_DEFAULT,2));
							  $("#DL_frek_adm").find('option').each(function( i, opt ) {
								  if( opt.value === data.PERIODE_ADM_DEFAULT ) 
									  $(opt).attr('selected', 'selected');
							  });
						  }else{
							   alert('Data tidak ditemukan!');
						  }
					  },"json");
			 }//if kd<>''
  
		  });
		function getDeskripsiRekTab(noRekTab){
			$.post("<?php echo site_url('/master_tabungan_c/getDeskripsiRekTab'); ?>",
					{
						'noRekTab' : noRekTab
					},
					function(data){
						if(data.baris==1){
							$('#DL_jenis_tab').val(data.jenisTab);
							$('#DL_status_tab').val(data.statusAktif);
							$('#txtNoSeries').val(data.noAlternatif);
							$('#txtBunga').val(number_format(data.sukuBunga,2));
							$('#txtPph').val(number_format(data.persenPph,2));
							$('#txtTerhitungBunga').val(data.tglBunga);
							$('#DL_kodegroup1_tab').val(data.kodeGroup1);
							$('#DL_kodegroup2_tab').val(data.kodeGroup2);
							$('#DL_kodegroup3_tab').val(data.kodeGroup3);
							$('#DL_kodegoldeb_tab').val(data.kodeBiPemilik);
							$('#DL_kodemetoda').val(data.kodeBiMetoda);
							$('#DL_kodehub_tab').val(data.kodeBiHub);
							$('#DL_restrict').val(data.flagRes);
							$('#DL_tipe_tab').val(data.abp);
							$('#txtSaldoMin').val(number_format(data.saldoMin,2));
							$('#txtBiayaAdm').val(number_format(data.admPerBln,2));
							$('#DL_frek_adm').val(data.periodeAdm);
							$('#txtSetoranMin').val(number_format(data.setorMin,2));
							$('#txtSetoranWajib').val(number_format(data.setorWajib,2));
							$('#txtJangkaWaktu').val(data.jkw);
							$('#txtTransaksiNormal').val(number_format(data.transNormal,2));
							$('#txtNasabahId').val(data.nasabahId);
							$('#txtNama').val(data.namaNasabah);
							$('#txtAlamat').val(data.alamat);
						}else{
							 //alert('Data tidak ditemukan!');
							 /* $('#txtNasabahId').val('');
							 $('#txtNama').val('');
							 $('#txtAlamat').val(''); */
						}
					},"json");
		}	
		$( "#txtNoRekTab" ).focusout(function() {
			var noRekTab	= $(this).val();
			getDeskripsiRekTab(noRekTab);
		});
		$( "#txtNasabahId" ).focusout(function() {
			   var kd=$('#txtNasabahId').val();
			   kd=kd.trim();
			   if (kd!=''){
				 //  alert(kd);
				$.post("<?php echo site_url('/master_tabungan_c/deskripsi_nasabah'); ?>",
						{
							'norek' : kd
						},
						function(data){
							if(data.baris==1){
								$('#txtNama').val(data.NAMA_NASABAH);
								$('#txtAlamat').val(data.ALAMAT);
								
							}else{
								 alert('Data tidak ditemukan!');
								 $('#txtNasabahId').val('');
								 $('#txtNama').val('');
								 $('#txtAlamat').val('');
							}
						},"json");
			   }//if kd<>''
	
			});
		$(document).ready(function(){
			//$('#txtNoRekTab').focus();	
			$("#btnUbah").attr("disabled", "disabled");
			$("#btnHapus").attr("disabled", "disabled");
			/* $('#txtNoRekTab').focusout(function(){
				this.value = this.value.toUpperCase();
				//proses();
			}); */
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			$('.nomor1').val(0);
		
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
			
		});//end ready document
		$('#btnSimpan').click(function(){
			$('#idTmpAksiBtn').val('1');
		});
		$('#btnUbah').click(function(){
			$('#idTmpAksiBtn').val('2');
		});
		$('#btnHapus').click(function(){
			$('#idTmpAksiBtn').val('3');
		});
		function ajax_submit_tabungan(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_tabungan_c/simpan_tabungan",
				data:dataString,
				dataType:"json",
				success:function (data) {	
					$('#id_ReloadRekTab').trigger('click');				
					$('#btnSimpan').hide();
					alert(data.notif);
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		function ajaxUbahRekTab(){
			$.ajax({
				type:"POST",
				dataType: "json",
				url:"<?php echo base_url(); ?>master_tabungan_c/ajaxUbahRekTab",
				data:dataString,
		
				success:function (data) {
					$('#id_ReloadRekTab').trigger('click');
					$('#btnUbah').attr("disabled","disabled");
					alert(data.notif);				
				}
		
			});
			event.preventDefault();
		}
		
		function ajaxHapusRekTab(){
			var noRekTab	= $('#txtNoRekTab').val();
			noRekTab		= noRekTab.trim();
			$.ajax({
				type:"POST",
				dataType: "json",
				url:"<?php echo base_url(); ?>master_tabungan_c/ajaxHapusRekTab",
				data:{noRekTab :noRekTab},
				success:function (data) {
					$('#id_ReloadRekTab').trigger('click');
					$('#btnHapus').attr("disabled","disabled");
					alert(data.notif);				
				}
		
			});
			event.preventDefault();
		}
		$('#formtabungan').submit(function (event) {
			ajaxModal();
			dataString = $("#formtabungan").serialize(); 
	        var aksiBtn       = $('#idTmpAksiBtn').val();
	        if(aksiBtn == '1'){
	        	var r = confirm('Anda yakin menyimpan data ini?');
				 if (r== true){
					ajax_submit_tabungan();
				 }else{//if(r)
					return false;
				}
	        }else if(aksiBtn == '2'){ 
	        	var r = confirm('Anda yakin merubah data ini?');
				 if (r== true){
					 ajaxUbahRekTab();
				 }else{//if(r)
					return false;
				}
	        }else if(aksiBtn == '3'){
	        	var r = confirm('Anda yakin menghapus data ini?');
				 if (r== true){
					 ajaxHapusRekTab();
				 }else{//if(r)
					return false;
				}
	        }
	    });
		
		/* $(function(){
			
			$('#formtabungan').submit(function (event) {
				  dataString = $("#formtabungan").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_tabungan();
				  }else{//if(r)
					return false;
				  }		
			}); //end  $contact form
		}); */
		
		
	</script>