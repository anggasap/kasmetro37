<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
foreach($counter_nasabah_id_length->result() as $row){
	$counter_nasabah_id_length= $row->Value;
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
                <form id="formnasabah" role="form" method="post" action="<?php echo base_url('master_nasabah_c/buat_baru'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<div class="form-body">
                            	<div class="form-group">
                                    <label>Nasabah id :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih form-control','id'=>'txtNasabahId','readonly'=>'readonly')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama nasabah :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php 
							echo  form_input(array('name'=>'txtNamaNasabah','class'=>'bersih form-control','id'=>'txtNamaNasabah','required'=>'required','placeholder'=>'Nama nasabah'));
							echo  form_input(array('type'=>'hidden','name'=>'txtCounterNasabahIdLength','class'=>'form-control','id'=>'txtCounterNasabahIdLength','required'=>'required','value'=>$counter_nasabah_id_length));
							?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama alias :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtNamaAlias','class'=>'bersih form-control','id'=>'txtNamaAlias','required'=>'required','placeholder'=>'Nama Alias'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php
										  $data = array(
											  'name'        => 'txtAlamatDom',
											  'id'          => 'txtAlamatDom',
											  'onkeyup'     => 'ToUpper(this)',
											  'rows'        => '2',
											  //'style'       => 'width:430px',
											  'class'		  =>'form-control',
											  'maxlength'	  =>'100',
											  'placeholder' => 'Alamat Domisili'
											);
										  echo form_textarea($data);
										  ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Tempat lahir :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtTempatLahir','class'=>'bersih form-control','id'=>'txtTempatLahir','required'=>'required','placeholder'=>'Tempat Lahir'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal lahir :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtTanggalLahir','class'=>'bersih form-control','id'=>'txtTanggalLahir','required'=>'required','placeholder'=>'Tanggal Lahir (dd-mm-yyyy)'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis kelamin :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
                                                  $data = array(
                                                      $data['']='Jenis Kelamin',
                                                      $data['L']='L',
                                                      $data['P']='P',
                                                      );
                                                      
                                                      echo form_dropdown('DL_jenis_kelamin', $data,'id="DL_jenis_kelamin"','class="form-control"');
                                                  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Agama :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array(
													  $data['']='Agama'
													  );
													  foreach($kode_group1 as $row) : 
															  $data[$row['NASABAH_GROUP1']] = $row['DESKRIPSI_GROUP1'];
													  endforeach; 
													  echo form_dropdown('DL_kode_group1', $data,'id="DL_kode_group1"','class="form-control"');
												  ?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Status gelar :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['']='Status / Gelar'
												  );
												  foreach($jenis_gelar as $row) : 
														  $data[$row['Gelar_ID']] = $row['Deskripsi_Gelar'];
												  endforeach; 
												  echo form_dropdown('DL_jenis_gelar', $data,'id="DL_jenis_gelar"','class="form-control"');
												  
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Deskripsi gelar :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtDesGelar','class'=>'bersih form-control','id'=>'txtDesGelar','placeholder'=>'Keterangan Gelar'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis ID :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['']='Jenis ID'
												  );
												  
												  foreach($jenis_id as $row) : 
														  $data[$row['jenis_id']] = $row['nama_identitas'];
												  endforeach; 
												  echo form_dropdown('DL_jenis_Id', $data,'id="DL_jenis_Id"','class="form-control"');
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>No ID :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNoId','class'=>'bersih form-control','id'=>'txtNoId','required'=>'required','placeholder'=>'Nomor Identitas'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Masa berlaku :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtIdMasaBerlaku','class'=>'bersih form-control','id'=>'txtIdMasaBerlaku','required'=>'required','placeholder'=>'Masa berlaku ID (dd-mm-yyyy)'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>No telepon :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtKodeArea','class'=>'nomor bersih form-control','id'=>'txtKodeArea','placeholder'=>'Kd Area'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>&nbsp;</label>
                                                <?php echo  form_input(array('name'=>'txtNoTelp','class'=>'nomor bersih form-control','id'=>'txtNoTelp','placeholder'=>'No. Telp'));?>
                                        </div>
                                        <div class="col-md-6">
                                            <label>No HP :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNoHp','class'=>'nomor bersih form-control','id'=>'txtNoHp','placeholder'=>'No. Handphone'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Alamat :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                  <?php 
												  // echo  form_input(array('name'=>'txtAlamatKtp','class'=>'bersih span11','id'=>'txtAlamatKtp','required'=>'required','placeholder'=>'Alamat KTP'));
												   $data = array(
															  'name'        => 'txtAlamatKtp',
															  'id'          => 'txtAlamatKtp',
															  'onkeyup'     => 'ToUpper(this)',
															  'rows'        => '2',
															  //'style'       => 'width:430px',
															  'class'		  =>'form-control',
															  'maxlength'	  =>'100',
															  'placeholder' => 'Alamat KTP'
															);
														  echo form_textarea($data);
												   ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode pos :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtKodePos','class'=>'nomor bersih form-control','id'=>'txtKodePos','required'=>'required','placeholder'=>'Kode Pos','maxlength'=>'5'));?>
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
                                            <label>Kelurahan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtKelurahan','class'=>'bersih form-control','id'=>'txtNamaAlias','required'=>'required','placeholder'=>'Kelurahan'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kecamatan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtKecamatan','class'=>'bersih form-control','id'=>'txtKecamatan','required'=>'required','placeholder'=>'Kecamatan'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kota :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['0']='Kota'
												  );
												  
												  foreach($jenis_kota as $row) : 
														  $data[$row['Kota_id']] = $row['Deskripsi_Kota'];
												  endforeach; 
												  echo form_dropdown('DL_jenis_kota', $data,$data['0'],'id="DL_jenis_kota" class = "form-control"');
												  
												  ?>
									  <?php echo  form_input(array('type'=>'hidden','name'=>'txtKota','class'=>'bersih','id'=>'txtKota','required'=>'required','placeholder'=>'kota'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Domisili negara :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												$data = array(
												$data['0']='Domisili Negara'
												);
												
												foreach($jenis_negara as $row) : 
														$data[$row['KODE_NEGARA']] = $row['DESKRIPSI_NEGARA'];
												endforeach; 
												echo form_dropdown('DL_jenis_negara', $data,$data['0'],'id="DL_jenis_negara" class = "form-control"');
												?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Pekerjaan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												$data = array(
												$data['0']='Pekerjaan'
												);
												foreach($jenis_kerja as $row) : 
														$data[$row['Pekerjaan_id']] = $row['Desktripsi_Pekerjaan'];
												endforeach; 
												echo form_dropdown('DL_jenis_kerja', $data,$data['0'],'id="DL_jenis_kerja" class = "form-control"');
												
												?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Keterangan pekerjaan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtKetKerja','class'=>'bersih form-control','id'=>'txtKetKerja','required'=>'required','placeholder'=>'Keterangan Pekerjaan'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama perusahaan :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtNamaPerush','class'=>'bersih form-control','id'=>'txtNamaPerush','required'=>'required','placeholder'=>'Nama Perusahaan'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>NIP :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNip','class'=>'bersih form-control','id'=>'txtNip','required'=>'required','placeholder'=>'NIP'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>NPWP :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNpwp','class'=>'bersih form-control','id'=>'txtNpwp','required'=>'required','placeholder'=>'NPWP'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Bidang usaha SID :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												$data = array(
												$data['0']='Bidang Usaha SID'
												);
												foreach($sid_bidang_usaha as $row) : 
														$data[$row['KODE_BIDANG_USAHA']] = $row['DESKRIPSI_BIDANG_USAHA'];
												endforeach; 
												echo form_dropdown('DL_sid_bidang_usaha', $data,$data['0'],'id="DL_sid_bidang_usaha" class="form-control"');
												
												?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Gol debitur :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['0']='Golongan Debitur SID'
												  );
												  foreach($sid_gol_debitur as $row) : 
														  $data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
												  endforeach; 
												  echo form_dropdown('DL_sid_gol_debitur', $data,$data['0'],'id="DL_sid_gol_debitur" class="form-control"');
												  
												  ?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Hubungan dengan bank SID :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                <?php
												$data = array(
												$data['0']='Hub dengan Bank SID'
												);
												foreach($sid_hub_bank as $row) : 
														$data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
												endforeach; 
												echo form_dropdown('DL_sid_hubungan', $data,$data['0'],'id="DL_sid_hubungan" class="form-control"');
												
												?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>AO :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['0']='AO'
												  );
												  foreach($kode_group4 as $row) : 
														  $data[$row['NASABAH_GROUP4']] = $row['DESKRIPSI_GROUP4'];
												  endforeach; 
												  echo form_dropdown('DL_kode_group4', $data,$data['0'],'id="DL_kode_group4" class="form-control"');
												  
												  ?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tujuan pembukaan rekening :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtTujuanPembRek','class'=>'bersih form-control','id'=>'txtTujuanPembRek','placeholder'=>'Tujuan Pembukaan Rekening'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Sumber dana :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtSumberDana','class'=>'bersih form-control','id'=>'txtSumberDana','placeholder'=>'Sumber Dana'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Penggunaan dana :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtPenggunaanDana','class'=>'bersih form-control','id'=>'txtPenggunaanDana','placeholder'=>'Penggunaan Dana'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama ahli waris :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtNamaWaris','class'=>'bersih form-control','id'=>'txtNamaWaris','placeholder'=>'Nama Ahli Waris'));?>
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
		
		
		// end angga print
		function confirm_reset(){
			var r = confirm('Reset formulir ??')
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('#txtRekKre').focus();
				//$('input[name=chkPelunasan]').attr('checked', false);
				$('#txtCicilan').val('0');
				$('#terbilang').text("nol");
				$("#btnSimpan").removeAttr("disabled");
				//$('#btnSimpan').show();
				//check_load();
				
				//location.reload();
			}
		}
		
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		$(document).ready(function(){
			$("#btnUbah").attr("disabled", "disabled");
			
			function validatedate(inputText,vbl) {  
				var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;  
				// Match the date format through regular expression  
				if(inputText.match(dateformat)){  
				   // document.form1.text1.focus();  
					//Test which seperator is used '/' or '-'  
					var opera1 = inputText.split('/');  
					var opera2 = inputText.split('-');  
					lopera1 = opera1.length;  
					lopera2 = opera2.length;  
					// Extract the string into month, date and year  
					if (lopera1>1) {  
						//var pdate = inputText.split('/');  
						alert('Format tanggal salah!');  
						$( vbl ).focus();
						return false;
					}else if (lopera2>1){  
						var pdate = inputText.split('-');  
						var dd = parseInt(pdate[0]);  
						var mm  = parseInt(pdate[1]);  
						var yy = parseInt(pdate[2]);  
						// Create list of days of a month [assume there is no leap year by default]  
						var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
						if (mm==1 || mm>2){  
						  if (dd>ListofDays[mm-1]){  
							  alert('Format tanggal salah!');  
							  $( vbl ).focus();
							  return false;  
						  }  
						}  
						if (mm==2){  
							var lyear = false;  
							if ( (!(yy % 4) && yy % 100) || !(yy % 400)){  
								lyear = true;  
							}  
							if ((lyear==false) && (dd>=29)){  
								alert('Format tanggal salah!'); 
								$( vbl ).focus();
								return false;  
							}  
							if ((lyear==true) && (dd>29)){  
								alert('Format tanggal salah!');  
								$( vbl ).focus();
								return false;  
							}  
					   }//if (mm==2){  
					}  
					
				}else{  
					alert("Format tanggal salah!");  
					$( vbl ).focus();
					return false;  
				}  
		  }  //function validatedate(inputText)
			
			$('#divNasabahId').hide();
			$( "#txtTanggalLahir" ).focusout(function() {
				var tgl = $(this).val();
				var vbl= "#txtTanggalLahir";
				validatedate(tgl,vbl);
			});
			$( "#txtIdMasaBerlaku" ).focusout(function() {
				var tgl = $(this).val();
				var vbl= "#txtIdMasaBerlaku";
				validatedate(tgl,vbl);
			});
			$('#txtNamaNasabah').focus();
			$('#DL_jenis_kota').change(function(){
				var txtJenisKota=$("#DL_jenis_kota option:selected").text();
				
				//alert("c");
				$('#txtKota').val(txtJenisKota);
		
			});
			$( "#txtAlamatDom" ).focusout(function() {
				var alamat = $(this).val();
				$("#txtAlamatKtp").val(alamat);
			});
			$(".nomor").keypress(function (e){
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
					//$("#errmsg").html("Digits Only").show().fadeOut("slow");
					return false;
				}
			});
		});//end ready document
		function show_nasabah_id(){
			var nm=$('#txtNamaNasabah').val();
			nm=nm.trim();
			var tgl_lahir=$('#txtTanggalLahir').val();
			tgl_lahir=tgl_lahir.trim();
			var no_id=$('#txtNoId').val();
			no_id=no_id.trim();
			$.post("<?php echo site_url('/master_nasabah_c/nasabah_id_masuk'); ?>",
				{
					'nama' 		: nm,
					'tgl_lahir'	: tgl_lahir,
					'no_id'		: no_id
				},
				function(data){
					if(data.baris==1){
						$('#txtNasabahId').val(data.nasabah_id);
						$('#divNasabahId').show();
					}
					/*
					else{
						$.messager.alert('Perhatian','Data debitur kredit tidak ditemukan!');
					}
					*/
				},"json");
		}
		function ajax_submit_nasabah(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_nasabah_c/simpan_nasabah",
				data:dataString,
		
				success:function (data) {
					//$('#txtNasabahId').val(data.masuk);
					//$('#divNasabahId').show();
					
					//$('#btnSimpan').hide();
					alert('Data Nasabah telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
					show_nasabah_id();
					
				}
		
			});
			event.preventDefault();
		}
		
		$(function() {
				$('#formnasabah').submit(function (event) {
					  dataString = $("#formnasabah").serialize();
					  var r = confirm('Anda yakin menyimpan data ini?');
					  if (r== true){
						ajax_submit_nasabah();
					  }else{//if(r)
						return false;
					  }
				 }); //end  $contact form
		});/// end $func
		
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