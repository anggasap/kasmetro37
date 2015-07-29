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
                <form id="formtabungan" role="form" method="post"   action="<?php echo base_url('tutup_deposito_c/tutup_dep'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis tabungan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
                                                  $data = array(
                                                   $data['']=''
                                                      );
                                                      foreach($jenis_tab as $row) : 
                                                              $data[$row['KODE_JENIS_TABUNGAN']] = $row['DESKRIPSI_JENIS_TABUNGAN'];
                                                      endforeach; 
                                                      echo form_dropdown('DL_jenis_tab', $data,'','id="DL_jenis_tab" class="form-control"');
                                                  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Status :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <select name="DL_status_tab" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;" class="form-control">
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
                                            <label>Nomor rekening :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNoRekTab','class'=>'bersih form-control','id'=>'txtNoRekTab','required'=>'required'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Series :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNoSeries','class'=>'bersih form-control','id'=>'txtNoSeries'));?>
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
                                        <div class="col-md-4">
                                            <label>Bunga per tahun (%) :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor form-control','id'=>'txtBunga'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>PPH per bulan (%) :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor form-control','id'=>'txtPph'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tgl terhitung bunga :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtTerhitungBunga','class'=>' form-control','id'=>'txtTerhitungBunga','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                                            </div>
                                                                               
                                        </div>
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
													echo form_dropdown('DL_kodegroup1_tab', $data,'','id="DL_kodegroup1_tab" class="form-control"');
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
                                                echo form_dropdown('DL_kodegroup2_tab', $data,'','id="DL_kodegroup2_tab" class="form-control"');
                                            ?>
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
													  echo form_dropdown('DL_kodegroup3_tab', $data,'','id="DL_kodegroup3_tab" class="form-control"');
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
												foreach($kode_gol_deb_tab as $row) : 
														$data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
												endforeach; 
												echo form_dropdown('DL_kodegoldeb_tab', $data,'','id="DL_kodegoldeb_tab" class="form-control"');
											?>
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode metoda :</label>
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
                                            <label>Hubungan</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
											<?php
											$data = array();
												foreach($kode_hub_tab as $row) : 
														$data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
												endforeach; 
												echo form_dropdown('DL_kodehub_tab', $data,'','id="DL_kodehub_tab" class="form-control"');
											?>
                                            </div>                                 
                                        </div>
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Restricted :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <select name="DL_restrict" id="DL_restrict"  onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;" class="form-control">
                                                  <option value="UNRESTRICTED" selected="selected">UNRESTRICTED</option>
                                                  <option value="RESTRICTED">RESTRICTED</option>
                                                  </select>
                                            </div>
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
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtSaldoMin','class'=>'nomor form-control','id'=>'txtSaldoMin'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Biaya adm :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
											<?php echo  form_input(array('name'=>'txtBiayaAdm','class'=>'nomor form-control','id'=>'txtBiayaAdm'));?>	
                                            </div>                                    
                                        </div>
                                        <div class="col-md-4">
                                            <label>Biaya adm :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
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
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Setoran minimal :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtSetoranMin','class'=>'nomor form-control','id'=>'txtSetoranMin'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Estimasi bunga</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
												<?php echo  form_input(array('name'=>'txtEstimasiBunga','class'=>'nomor form-control','id'=>'txtEstimasiBunga','readonly'=>'readonly'));?>
                                            </div>                                 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>Setoran wajib :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtSetoranWajib','class'=>'nomor form-control','id'=>'txtSetoranWajib'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Jkw :</label>
                                            
												<?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'nomor1 form-control','id'=>'txtJangkaWaktu'));?>
                                            </div>
                                        <div class="col-md-5">
                                            <label>Transaksi normal :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
												<?php echo  form_input(array('name'=>'txtTransaksiNormal','class'=>'nomor form-control','id'=>'txtTransaksiNormal'));?>
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
       					<a class="btn green" onclick="cetak_validasi();" id="btnUbah" name="btnUbah">
                        	<span class="glyphicon glyphicon-edit"></span> Ubah
                        </a>
       					<a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
       						<span class="glyphicon glyphicon-repeat"></span>  Reset
       					</a>
       					<a class="btn yellow" id="btnHapus" name="btnHapus">
                        	<span class="glyphicon glyphicon-trash"></span> Hapus
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
			}
		}
		$( "#DL_jenis_tab" ).change(function() {
			 var kd=$(this).val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/master_tabungan_c/desk_prod_tabungan'); ?>",
					  {
						  'kd_tab' : kd
					  },
					  function(data){
						  if(data.baris==1){
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
		$(document).ready(function(){
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
								$('#txtBunga').focus();
						});
					}
				},"json");
			  }//if kd<>''
			}//function cari_nasabah(){
			/*
			function proses(){
				var item = '';
				
				$.post("<?php // echo site_url('/master_tabungan_c/nasabah2'); ?>",{'item':item},
				function(data){
					alert(data.norek.length);
					
				},"json");
			}
			*/
		
			
			
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekTab').focusout(function(){
				this.value = this.value.toUpperCase();
				//proses();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			$('.nomor1').val(0);
		
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
			/*
			$("#txtBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtBunga").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtPph").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtPph").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtSaldoMin").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtSaldoMin").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtBiayaAdm").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtBiayaAdm").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtSetoranMin").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtSetoranMin").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtEstimasiBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtEstimasiBunga").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtSetoranWajib").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtSetoranWajib").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtTransaksiNormal").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtTransaksiNormal").focus(function(){
					$(this).val('');
					$(this).focus();
			});			
			*/
		});//end ready document
		
		function ajax_submit_tabungan(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_tabungan_c/simpan_tabungan",
				data:dataString,
		
				success:function (data) {					
					$('#btnSimpan').hide();
					alert('Master tabungan telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){
			
			$('#formtabungan').submit(function (event) {
				  dataString = $("#formtabungan").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_tabungan();
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