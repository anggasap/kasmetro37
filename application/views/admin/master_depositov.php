<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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
                <form id="formdeposito" role="form" method="post"   action="<?php echo base_url('master_deposito_c/buat_baru'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                            <div class="form-body">
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Jenis :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
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
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tipe deposito :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <select name="DL_tipe_dep" id="DL_tipe_dep" class="form-control">
                                                <option value="1" selected="selected">DEPOSITO</option>
                                                <option value="2">AB-PASIVA</option>
                                                <option value="3">AB-AKTIVA</option>
                                                </select>
                                            </div>                                 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Status :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <select name="DL_status_dep" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"   class="form-control">
                                                    <option value="1" selected="selected">Baru</option>
                                                    <option value="2">Aktif</option>
                                                    <option value="3">Tutup</option>
                                                </select>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>No rekening :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtNoRekDep','class'=>'bersih form-control','id'=>'txtNoRekDep','required'=>'required'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>No bilyet :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtNoBilyet','class'=>'bersih form-control','id'=>'txtNoBilyet'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nasabah id :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih form-control','id'=>'txtNasabahId','placeholder'=>'Nasabah/Anggota ID'));?>
                                                 <span class="input-group-btn">
                                                  <a href="#" class="btn green" data-target="#input_cari_nasabah" data-toggle="modal">
                                                      <span class="glyphicon glyphicon-search"></span>
                                                  </a>
                                                  </span> 
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 
                                                 <?php echo  form_input(array('name'=>'txtNama','class'=>'bersih form-control','id'=>'txtNama','placeholder'=>'Nama Nasabah/Anggota','readonly'=>'readonly'));?>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <label>Alamat :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
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
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jumlah deposito :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJmlDep','class'=>'nomor form-control','id'=>'txtJmlDep'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Bunga /tahun :</label>
                                            <div class="input-group">
                                                <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor form-control','id'=>'txtBunga'));?>
                                            	<span class="input-group-addon">
                                                <i class="">%</i>
                                                </span>
                                            </div>                                 
                                        </div>
                                        <div class="col-md-3">
                                            <label>PPH /bulan :</label>
                                            <div class="input-group">
                                                <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor form-control','id'=>'txtPph'));?>	
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
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglReg','class'=>'form-control','id'=>'txtTglReg','value'=>$this->session->userdata('tglD')));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jkw /bulan :</label>
                                            <div class="input-group">
                                            	<span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJkWaktu','class'=>'teks-kanan form-control','id'=>'txtJkWaktu','readonly'=>'readonly'));?>
                                            </div>                                 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal JT :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
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
                                            <div class="input-group">
                                            	<span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglValuta','class'=>'teks-kanan form-control','id'=>'txtTglValuta','readonly'=>'readonly'));?>
                                            </div>                                 
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tipe bunga :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
												<select name="DL_tipe_bunga" id="DL_tipe_bunga" class="form-control">
                                                <option value="1" selected="selected">Reguler</option>
                                                <option value="2">SBI</option>
                                                </select>	
                                            </div>
                                                                               
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
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php echo  form_input(array('name'=>'txtCatatan','class'=>'bersih form-control','id'=>'txtCatatan'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode group 1 :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array();
													  foreach($kode_group1 as $row) : 
															  $data[$row['KODE_GROUP1']] = $row['DESKRIPSI_GROUP1'];
													  endforeach; 
													  echo form_dropdown('DL_kodegroup1_dep', $data,'','id="DL_kodegroup1_dep" class="form-control"');
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode Group 2</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
											<?php
											$data = array();
												foreach($kode_group2 as $row) : 
														$data[$row['KODE_GROUP2']] = $row['DESKRIPSI_GROUP2'];
												endforeach; 
												echo form_dropdown('DL_kodegroup2_dep', $data,'','id="DL_kodegroup2_dep"  class="form-control"');
											?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode group 3 :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array();
													  foreach($kode_group3 as $row) : 
															  $data[$row['KODE_GROUP3']] = $row['DESKRIPSI_GROUP3'];
													  endforeach; 
													  echo form_dropdown('DL_kodegroup3_dep', $data,'','id="DL_kodegroup3_dep" class="form-control"');
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode Pemilik</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
											<?php
											$data = array();
												foreach($kode_pemilik as $row) : 
														$data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
												endforeach; 
												echo form_dropdown('DL_kodepemilik', $data,'','id="DL_kodepemilik" class="form-control"');
											?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode Metoda :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array();
													  foreach($kode_metoda as $row) : 
															  $data[$row['KODE_METODA']] = $row['DESKRIPSI_METODA'];
													  endforeach; 
													  echo form_dropdown('DL_kodemetoda', $data,'','id="DL_kodemetoda" class="form-control"');
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Hubungan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
											<?php
											$data = array();
												foreach($kode_hub_dep as $row) : 
														$data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
												endforeach; 
												echo form_dropdown('DL_kodehub_dep', $data,'','id="DL_kodehub_dep" class="form-control"');
											?>
                                            </div>                                   
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

<div id="input_cari_nasabah"  class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tabel Perkiraan</h4>
            </div>
           <!-- START MODAL BODY-->
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                                <div class="input-group">
                                      <input type="text" class="form-control"  id="txtCariNasabah" placeholder="Cari...">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary"  id="CmdCariNasabah"><i class="fa fa-search"></i>&nbsp;</button> 
                                      </span>  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                      <input type="text" class="form-control" id="kwd_search" placeholder="Cari...">  
                                </div>
                            </div>
                            
                            <table class='table table-hover' style="" id="tabel_rek">
                              <thead>
                                  <tr>
                                      <th width='15%' align='center'>
                                          Nasabah Id
                                      </th>
                                      <th width='35%' align='center'>
                                          Nama
                                      </th>
                                      <th width='40%' align='center'>
                                          Alamat
                                      </th>
                                      <th width='10%' align='center'>
                                          Btn
                                      </th>
                                  </tr>
                              </thead>
                              <tbody id="body"></tbody>				
                          </table>
                            
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn red" id="id_button_close_modal">Close</button>
               
            </div>
            
        </div>
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
    });
</script>
<script>
// MENU OPEN
	$(".menu_root").removeClass('start active open');
	$("#menu_root_6").addClass('start active open');
	// END MENU OPEN

</script>
<script type="text/javascript">
		function confirm_reset(){
			var r = confirm('Reset formulir ??');
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$("#btnSimpan").removeAttr("disabled");
				//$('#btnSimpan').show();
				
				//check_load();
				//location.reload();
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
			
			$("#CmdCariNasabah").click(function(){
					cari_nasabah();	
			});
			$("#idCmdBrowse").click(function(){
					$('#txtCariNasabah').val('');
					$('#txtCariNasabah').focus();
			});
			
			function cari_nasabah(){
				var item = $("#txtCariNasabah").val();
				item=item.trim();
			  if (item!=''){
				$.post("<?php echo site_url('/master_tabungan_c/process_cari_nasabah'); ?>",{'item':item},
				function(data){
					//$('#input_cari_nasabah').window('close');
					//$('#cari_nasabah').window('open');
					$('#kwd_search').val('');
					$('#kwd_search').focus();
					$('#body').empty();
					var tr="";
					for (var i = 0; i < data.norek.length; i++) {
					
						 a=(data.norek[i].nasabah_id).trim();
						 b=(data.norek[i].nama_nasabah).trim();
						 c=(data.norek[i].alamat).trim();
						tr = '<tr>';
						tr+='<td>'+a+'</td>'+'<td>'+b+'</td>'+'<td>'+c+'</td>'+'<td><button class"btn btn-success" id="'+a+'"><i class="icon-ok"></i></button></td>';
						tr+= '</tr>';
						$('#body').append(tr);
						
						$('#'+a).click(function(){
								$('#txtCariNasabah').val('');
								$('#txtNasabahId').val($(this).attr('id'));
								//$('#cari_nasabah').window('close');
								$( "#txtNasabahId" ).trigger( "focusout" );
								$('#txtJmlDep').focus();
						});
					}
				},"json");
			  }//if kd<>''
			}//function cari_nasabah(){
			
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekTab').focusout(function(){
				this.value = this.value.toUpperCase();
				//proses();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			
		
			$("#kwd_search").keyup(function(){
				var c = $("#kwd_search").val();
					if(c==""){
						//pager.showPage(1);
						$("#tabel_rek tbody>tr").show();
					}
			  		if( c != ""){//if( (c != "") && ((c.length == 4) || (c.length == 7) || (c.length > 10)) ){
			  			// Show only matching TR, hide rest of them
			  			$("#tabel_rek tbody>tr").hide();
			  			$("#tabel_rek td:contains-ci('" + $(this).val() + "')").parent("tr").show();
			  		}
			});// end $("#kwd_search").keyup(function(){
			
		});//end ready document
		
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
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
	</script>