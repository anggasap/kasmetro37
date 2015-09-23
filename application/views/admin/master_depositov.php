<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <?php echo $judul; ?>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form id="formdeposito" role="form" method="post" action="<?php echo base_url('master_deposito_c/buat_baru'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                            <div class="form-body">
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Jenis :</label>
                                                <?php
												$data = array(
												$data['']=''
													);
													foreach($jenis_dep as $row) : 
															$data[$row['KODE_JENIS_DEPOSITO']] = $row['DESKRIPSI_JENIS_DEPOSITO'];
													endforeach; 
													echo form_dropdown('DL_jenis_dep', $data,'','id="DL_jenis_dep" required="required" class="form-control"');
												?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tipe deposito :</label>
                                                <select name="DL_tipe_dep" id="DL_tipe_dep" class="form-control">
                                                <option value="1" selected="selected">DEPOSITO</option>
                                                <option value="2">AB-PASIVA</option>
                                                <option value="3">AB-AKTIVA</option>
                                                </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Status :</label>    
                                                <select readonly="true" name="DL_status_dep" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"   class="form-control">
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
                                            <label>No rekening :</label>
                                            <div class="input-group">
                                            	<input type="text" id="idTmpAksiBtn" class="hidden">
                                                <?php echo  form_input(array('name'=>'txtNoRekDep','class'=>'bersih form-control','id'=>'txtNoRekDep','required'=>'required'));?>
                                        		<span class="input-group-btn">
                                                  <a href="#" class="btn green" data-target="#idDivTabelRekDep" data-toggle="modal">
                                                      <span class="glyphicon glyphicon-search"></span>
                                                  </a>
                                                  </span>
                                        	</div>	
                                        </div>
                                        <div class="col-md-6">
                                            <label>No bilyet :</label>
                                                <?php echo  form_input(array('name'=>'txtNoBilyet','class'=>'bersih form-control','id'=>'txtNoBilyet'));?>
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
                                        <div class="col-md-6">
                                            <label>Jumlah deposito :</label>
                                                <?php echo  form_input(array('name'=>'txtJmlDep','class'=>'nomor form-control kanan','id'=>'txtJmlDep'));?>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Bunga /tahun :</label>
                                            <div class="input-group">
                                                <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor form-control kanan','id'=>'txtBunga'));?>
                                            	<span class="input-group-addon">
                                                <i class="">%</i>
                                                </span>
                                            </div>                                 
                                        </div>
                                        <div class="col-md-3">
                                            <label>PPH /bulan :</label>
                                            <div class="input-group">
                                                <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor form-control kanan','id'=>'txtPph'));?>	
                                            	<span class="input-group-addon">
                                                <i class="">%</i>
                                                </span>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tanggal Registrasi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglReg','class'=>'form-control','id'=>'txtTglReg','value'=>$this->session->userdata('tglD')));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jkw /bulan :</label>
                                                <?php echo  form_input(array('name'=>'txtJkWaktu','class'=>'kanan form-control nomor1','id'=>'txtJkWaktu','readonly'=>'readonly'));?>
	                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal JT :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
												<?php echo  form_input(array('name'=>'txtTglJT','class'=>'form-control','id'=>'txtTglJT','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>	
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tanggal penempatan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglPenempatan','class'=>'bersih form-control','id'=>'txtTglPenempatan','value'=>$this->session->userdata('tglD')));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal valuta :</label>
                                                <?php echo  form_input(array('name'=>'txtTglValuta','class'=>'teks-kanan form-control','id'=>'txtTglValuta','readonly'=>'readonly'));?>        
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tipe bunga :</label>
												<select name="DL_tipe_bunga" id="DL_tipe_bunga" class="form-control">
                                                <option value="1" selected="selected">Reguler</option>
                                                <option value="2">SBI</option>
                                                </select>	
                                        </div>
                                    </div>
                                </div>
                    
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <div class="form-body">
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                        	<div class="checkbox-list">
                                             <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="chkBungaTitipan" id="chkBungaTitipan"> Masuk ke titipan
                                              </label>
                                             </div> 
                                             <div class="checkbox-list">
                                             <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="chkBungaPokok" id="chkBungaPokok"> Bunga ke pokok
                                              </label>
                                              </div>
                                              <div class="checkbox-list">
                                              <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="chkBungaTabungan" id="chkBungaTabungan"> Bunga ke tabungan
                                              </label>
                                              </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label>No rekening :</label>
                                            <div class="input-group">
                                            	<span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                <input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rek Tabungan" class="form-control">
                                            </div>
                                            <div class="input-group">
                                            	<span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                <?php echo form_input(array('name'=>'txtNamaRekTab','id'=>'txtNamaRekTab','class'=>'bersih form-control','placeholder'=>'Nama Nasabah','readonly'=>'true'));?>
                                            </div>                                 
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                     <div class="checkbox-list">
                                     <label class="checkbox-inline">
                                        <input type="checkbox" value="1" name="chkAro"> ARO (Update tanggal registrasi & SBI) 
                                      </label>
                                     </div>
                                </div>
                                <div class="form-group">
                                    <label>Catatan :</label>
                                        <?php echo  form_input(array('name'=>'txtCatatan','class'=>'bersih form-control','id'=>'txtCatatan'));?>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode group 1 :</label>
                                                 <?php
												  $data = array();
												  $data['']='';
													  foreach($kode_group1 as $row) : 
															  $data[$row['KODE_GROUP1']] = $row['DESKRIPSI_GROUP1'];
													  endforeach; 
													  echo form_dropdown('DL_kodegroup1_dep', $data,'','id="DL_kodegroup1_dep" class="form-control"');
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
												echo form_dropdown('DL_kodegroup2_dep', $data,'','id="DL_kodegroup2_dep"  class="form-control"');
											?>                                  
                                        </div>
                                    </div>
                                </div>
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
													  echo form_dropdown('DL_kodegroup3_dep', $data,'','id="DL_kodegroup3_dep" class="form-control"');
												  ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode Pemilik</label>
											<?php
											$data = array();
											$data['']='';
												foreach($kode_pemilik as $row) : 
														$data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
												endforeach; 
												echo form_dropdown('DL_kodepemilik', $data,'','id="DL_kodepemilik" class="form-control"');
											?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode Metoda :</label>
                                                 <?php
												  $data = array();
												  $data['']='';
													  foreach($kode_metoda as $row) : 
															  $data[$row['kode_metoda']] = $row['deskripsi_metoda'];
													  endforeach; 
													  echo form_dropdown('DL_kodemetoda', $data,'','id="DL_kodemetoda" class="form-control"');
												  ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Hubungan :</label>
											<?php
											$data = array();
											$data['']='';
												foreach($kode_hub_dep as $row) : 
														$data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
												endforeach; 
												echo form_dropdown('DL_kodehub_dep', $data,'','id="DL_kodehub_dep" class="form-control"');
											?>
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
<div id="idDivTabelRekDep" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="idBtnCloseModalRekDep" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Rekening</h4>
            </div>

            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadRekDep" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelRekDep">
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
	$("#menu_root_5").addClass('start active open');
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

        var table = $('#idTabelRekDep');

        // begin first table
        table.dataTable({
            "ajax": "<?php  echo base_url("/master_deposito_c/getRekDepAll"); ?>",
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
        	var noRekDep 		= $(this).find("td").eq(0).html();           
            $('#txtNoRekDep').val(noRekDep);
            var nasabahId 		= $(this).find("td").eq(1).html();           
            $('#txtNasabahId').val(nasabahId.trim());
            var namaNasabah		= $(this).find("td").eq(2).html();
            $('#txtNama').val(namaNasabah);
            var alamatNasabah	= $(this).find("td").eq(3).html();
            $('#txtAlamat').val(alamatNasabah);
            $('#idBtnCloseModalRekDep').trigger('click');
            $('#txtNoRekDep').focus();

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
				$("#btnSimpan").removeAttr("disabled");
				//$('#btnSimpan').show();
			}
		}
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}	
			$( "#DL_jenis_dep" ).change(function() {
			 var kd=$(this).val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/master_deposito_c/desk_prod_deposito'); ?>",
					  {
						  'kd_dep' : kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtJkWaktu').val(data.JKW_DEFAULT);
							  $('#txtBunga').val(data.SUKU_BUNGA_DEFAULT);
							  $('#txtPph').val(data.PPH_DEFAULT);
							  
						  }else{
							   alert('Data tidak ditemukan!');
							  /*
							   $('#txtNasabahId').val('');
							   $('#txtNama').val('');
							   $('#txtAlamat').val('');
								$('#idCmdBrowse').focus();
								*/
						  }
					  },"json");
			 }//if kd<>''
  
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
								$('#idCmdBrowse').focus();
						  }
					  },"json");
			 }//if kd<>''
  
		  });
		  $( "#txtRekTab" ).focusout(function() {
			 var kd=$('#txtRekTab').val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek_dep'); ?>",
					  {
						  'norek' : kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtNamaRekTab').val(data.NAMA_NASABAH);
						  }else{
							   alert('Data tidak ditemukan!');
							   $('#txtNamaRekTab').val('');
						  }
					  },"json");
			 }//if kd<>''
  
		  });
		$(document).ready(function(){
			$("#txtRekTab").attr("disabled", "disabled");
			$('#chkBungaTabungan').change(function() {
			  if ($(this).is(':checked')) {
			  	$("#txtRekTab").removeAttr("disabled");
				$('#chkBungaTitipan').prop('checked', false);
				$('#chkBungaPokok').prop('checked', false);
			  }else{
			  	$("#txtRekTab").attr("disabled", "disabled");
			  }
			});
			$('#chkBungaPokok').change(function() {
			  if ($(this).is(':checked')) {
			  	//$("#chkBungaTitipan").attr("checked", "checked");
				//$("#chkBungaTitipan").trigger("click");
				$('#chkBungaTitipan').prop('checked', true);
				
			  }
			});
			
			$("#txtJkWaktu").val(0); 
			var tanggal_reg = $("#txtTglReg").val();
			var tgl_reg=tanggal_reg.slice(0,2);
			$("#txtTglValuta").val(tgl_reg);
			
			$("#txtTglReg").focusout(function(){
				var tanggal_reg = $(this).val();
				var tgl_reg=tanggal_reg.slice(0,2);
				$("#txtTglValuta").val(tgl_reg);
				
				var jw = $("#txtJkWaktu").val();
				jw = parseInt(jw);
				//alert(jw);
				
				var tgl=tanggal_reg.slice(0,2);
				var bln=tanggal_reg.slice(3,5);
				var thn=tanggal_reg.slice(6,11);
				var tanggal =bln+'-'+tgl+'-'+thn;// bulan tanggal tahun
				
				var tanggal_sblm = new Date(tanggal);
				var bulan = tanggal_sblm.getFullYear();
				
				tanggal_sblm.setMonth(tanggal_sblm.getMonth() + jw);
				
				tgl_stlh = tanggal_sblm.getDate();
				bln_stlh = tanggal_sblm.getMonth();
				thn_stlh = tanggal_sblm.getFullYear();
				
				bln_stlh = bln_stlh+1;
				
				tgljt =pad2(tgl_stlh)+'-'+pad2(bln_stlh)+'-'+pad2(thn_stlh);
				$("#txtTglJT").val(tgljt);
				
			});
			
			$(".nomor").focus(function(){
				$(this).val('');
			});
			$(".nomor1").focus(function(){
				$(this).val('');
			});
			$(".nomor").focusout(function(){
				if ($(this).val() == '') { 
					$(this).val('0.00');
				}else{
					var angka =$(this).val();
					$(this).val(number_format(angka,2));
				}
			});
			$(".nomor1").focusout(function(){
				if ($(this).val() == '') { 
					$(this).val('0');
				}else{
					var angka =$(this).val();
					$(this).val(angka);
				}
			});
			$('#txtNoRekTab').focus();
			//$('#input_cari_nasabah').window('close');
			//$('#cari_nasabah').window('close');
			
			
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekTab').focusout(function(){
				this.value = this.value.toUpperCase();
				//proses();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');	
		});//end ready document
		function getDeskripsiRekDep(noRekDep){
			$.post("<?php echo site_url('/master_deposito_c/getDeskripsiRekDep'); ?>",
					{
						'noRekDep' : noRekDep
					},
					function(data){
						if(data.baris==1){
							$('#DL_jenis_dep').val(data.jenisDep);
							$('#DL_tipe_dep').val(data.abp);
							$('#DL_status_dep').val(data.statusAktif);
							$('#txtNoBilyet').val(data.noAlternatif);
							$('#txtJmlDep').val(number_format(data.jmlDeposito,2));
							$('#txtBunga').val(number_format(data.sukuBunga,2));
							$('#txtPph').val(number_format(data.persenPph,2));
							$('#txtTglReg').val(data.tglReg);
							$('#txtJkWaktu').val(data.jkw);
							$('#txtTglJT').val(data.tglJT);
							$('#txtTglPenempatan').val(data.tglMulai);
							$('#txtTglValuta').val(data.tglValuta);
							$('#DL_tipe_bunga').val(data.typeSB);
							if(data.masukTitipan == '1'){
								$("#chkBungaTitipan").attr("checked", "checked");
							}else{
								$("#chkBungaTitipan").removeAttr("checked");
							}
							if(data.bungaKePokok == '1'){
								$("#chkBungaPokok").attr("checked", "checked");
							}else{
								$("#chkBungaPokok").removeAttr("checked");
							}
							if(data.noRekTab != ''){
								$("#chkBungaTabungan").attr("checked", "checked");
								$("#txtRekTab").removeAttr("readonly");
								$("#txtRekTab").val(data.noRekTab);
							}else{
								$("#chkBungaTabungan").removeAttr("checked");
								$("#txtRekTab").attr("readonly",true);
								$("#txtRekTab").val('');
							}
							if(data.aro == '1'){
								$("#chkAro").attr("checked", "checked");
							}else{
								$("#chkAro").removeAttr("checked");
							}
							//$('#chkAro').val(data.aro);
							$('#DL_kodegroup1_dep').val(data.kodeGroup1);
							$('#DL_kodegroup2_dep').val(data.kodeGroup2);
							$('#DL_kodegroup3_dep').val(data.kodeGroup3);
							$('#DL_kodepemilik').val(data.kodeBiPemilik);
							$('#DL_kodemetoda').val(data.kodeBiMetoda);
							$('#DL_kodehub_dep').val(data.kodeBiHub);
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
		$( "#txtNoRekDep" ).focusout(function() {
			var noRekDep	= $(this).val();
			getDeskripsiRekDep(noRekDep);
		});
		function ajax_submit_deposito(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_deposito_c/simpan_deposito",
				data:dataString,
		
				success:function (data) {					
					//$('#btnSimpan').hide();
					alert('Data Deposito telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){		
			$('#formdeposito').submit(function (event) {
				  dataString = $("#formdeposito").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_deposito();
				  }else{//if(r)
					return false;
				  }
			}); //end  $contact form
		});
		
	</script>