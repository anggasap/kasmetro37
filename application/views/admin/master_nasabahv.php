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
                            	<!--<div class="form-group">
                                    <label>Nasabah id :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php /*echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih form-control','id'=>'txtNasabahId','readonly'=>'readonly')); */?>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nasabah id :</label>

                                            <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-tag"></i>
                                    </span>
                                    			<input type="text" id="idTmpAksiBtn" class="hidden">
                                                <input id="txtNasabahId" name="txtNasabahId" type="text" placeholder="Nasabah Id"
                                                       class="form-control bersih input-medium" readonly>
                                    <span class="input-group-btn">
                                                  <a href="#" class="btn green" data-target="#idDivTabelNasabah"
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
                                         <?php echo  form_input(array('name'=>'txtNamaAlias','class'=>'bersih form-control','id'=>'txtNamaAlias','placeholder'=>'Nama Alias'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-home"></i>
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
                                                <i class="fa fa-home"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtTempatLahir','class'=>'bersih form-control','id'=>'txtTempatLahir','required'=>'required','placeholder'=>'Tempat Lahir'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tanggal lahir :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
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
                                                <i class="fa fa-dot-circle-o"></i>
                                                </span>
                                                 <?php
                                                  $data = array(
                                                      $data['']='Jenis Kelamin',
                                                      $data['L']='L',
                                                      $data['P']='P',
                                                      );
                                                      
                                                      echo form_dropdown('DL_jenis_kelamin', $data,'','class="form-control" id="DL_jenis_kelamin"');
                                                  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Agama :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-bullseye"></i>
                                                </span>
                                                 <?php
												  $data = array(
													  $data['']='Agama'
													  );
													  foreach($kode_group1 as $row) : 
															  $data[$row['NASABAH_GROUP1']] = $row['DESKRIPSI_GROUP1'];
													  endforeach; 
													  echo form_dropdown('DL_kode_group1', $data,'','class="form-control" id="DL_kode_group1"');
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
                                                <i class="fa  fa-mortar-board"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['']='Status / Gelar'
												  );
												  foreach($jenis_gelar as $row) : 
														  $data[$row['Gelar_ID']] = $row['Deskripsi_Gelar'];
												  endforeach; 
												  echo form_dropdown('DL_jenis_gelar', $data,'','class="form-control" id="DL_jenis_gelar"');
												  
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Deskripsi gelar :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-tasks"></i>
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
                                                <i class="fa  fa-tags"></i>
                                                </span>
                                                 <?php
												  $data = array(
												  $data['']='Jenis ID'
												  );
												  
												  foreach($jenis_id as $row) : 
														  $data[$row['jenis_id']] = $row['nama_identitas'];
												  endforeach; 
												  echo form_dropdown('DL_jenis_Id', $data,'','class="form-control" id="DL_jenis_Id"');
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>No ID :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-navicon"></i>
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
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtIdMasaBerlaku','class'=>'bersih form-control input-medium','id'=>'txtIdMasaBerlaku','required'=>'required','placeholder'=>'Masa berlaku ID (dd-mm-yyyy)'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>No telepon :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
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
                                                <i class="fa fa-phone-square"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNoHp','class'=>'nomor bersih form-control','id'=>'txtNoHp','placeholder'=>'No. Handphone'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Alamat :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-home"></i>
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
                                        <div class="col-md-4">
                                            <label>Kode pos :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
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
                                                <i class="fa fa-home"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtKelurahan','class'=>'bersih form-control','id'=>'txtKelurahan','required'=>'required','placeholder'=>'Kelurahan'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kecamatan :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-home"></i>
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
                                                <i class="fa fa-home"></i>
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
                                                <i class="fa fa-building"></i>
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
                                                <i class="fa fa-tasks"></i>
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
                                                <i class="fa fa-list-alt"></i>
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
                                        <i class="fa fa-bank"></i>
                                        </span>
                                         <?php echo form_input(array('name'=>'txtNamaPerush','class'=>'bersih form-control','id'=>'txtNamaPerush','placeholder'=>'Nama Perusahaan'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>NIP :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNip','class'=>'bersih form-control','id'=>'txtNip','placeholder'=>'NIP'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>NPWP :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                                </span>
                                                 <?php echo  form_input(array('name'=>'txtNpwp','class'=>'bersih form-control','id'=>'txtNpwp','placeholder'=>'NPWP'));?>
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
                                                <i class="fa fa-list"></i>
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
                                                <i class="fa fa-list"></i>
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
                                                <i class="fa fa-list"></i>
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
                                                <i class="fa fa-list"></i>
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
                                        <i class="fa fa-list"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtTujuanPembRek','class'=>'bersih form-control','id'=>'txtTujuanPembRek','placeholder'=>'Tujuan Pembukaan Rekening'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Sumber dana :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-list"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtSumberDana','class'=>'bersih form-control','id'=>'txtSumberDana','placeholder'=>'Sumber Dana'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Penggunaan dana :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-list"></i>
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
                        <button type="submit" class="btn blue" id="btnSimpan" name="btnSimpan">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>               
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
            var nasabahId = $(this).find("td").eq(0).html();           
            $('#txtNasabahId').val(nasabahId);
            $('#id_button_close_modal').trigger('click');
            $('#txtNasabahId').focus();
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
        }
    };

}();
		
		
		// end angga print
		function confirm_reset(){
			var r = confirm('Reset formulir ??')
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('#txtNamaNasabah').focus();
				$("#btnSimpan").removeAttr("disabled");
				$("#btnUbah").attr("disabled", "disabled");
				$("#btnHapus").attr("disabled", "disabled");
				//location.reload();
			}
		}
		
		function ajaxModal(){
		    $(document).ajaxStart(function() {
		        $('.modal_json').fadeIn('fast');
		    }).ajaxStop(function() {
		        $('.modal_json').fadeOut('fast');
		    });
		}
		
		$(document).ready(function(){
			$("#btnUbah").attr("disabled", "disabled");
			$("#btnHapus").attr("disabled", "disabled");
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
		  $("#txtNasabahId").focusout(function () {
		        var kd = $(this).val();
		        kd = kd.trim();
		        getDeskripsiNasabah(kd);
		    });
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
					$('#id_Reload').trigger('click');
					$("#btnSimpan").attr("disabled", "disabled");
					show_nasabah_id();
					alert(data.notif);	
					
				}
		
			});
			event.preventDefault();
		}
		function ajaxUbahNasabah(){
			$.ajax({
				type:"POST",
				dataType: "json",
				url:"<?php echo base_url(); ?>master_nasabah_c/ubahDataNasabah",
				data:dataString,
		
				success:function (data) {
					$('#id_Reload').trigger('click');
					$('#btnUbah').attr("disabled","disabled");
					alert(data.notif);				
				}
		
			});
			event.preventDefault();
		}
		function ajaxHapusNasabah(){
			var nasabahId	= $('#txtNasabahId').val();
			nasabahId		= nasabahId.trim();
			$.post("<?php echo site_url('/master_nasabah_c/ajaxHapusNasabah'); ?>",
					{
						'nasabahId' 		: nasabahId,
					},
					function(data){
						alert(data.notif);
						
					},"json");
		}
		$('#btnSimpan').click(function(){
			$('#idTmpAksiBtn').val('1');
		});
		$('#btnUbah').click(function(){
			$('#idTmpAksiBtn').val('2');
		});
		$('#btnHapus').click(function(){
			$('#idTmpAksiBtn').val('3');
		});
		$('#formnasabah').submit(function (event) {
			ajaxModal();
			dataString = $("#formnasabah").serialize();
	        var aksiBtn       = $('#idTmpAksiBtn').val();
	        if(aksiBtn == '1'){
	        	var r = confirm('Anda yakin menyimpan data ini?');
				 if (r== true){
					ajax_submit_nasabah();
				 }else{//if(r)
					return false;
				}
	        }else if(aksiBtn == '2'){ 
	        	var r = confirm('Anda yakin merubah data ini?');
				 if (r== true){
					 ajaxUbahNasabah();
				 }else{//if(r)
					return false;
				}
	        }else if(aksiBtn == '3'){
	        	var r = confirm('Anda yakin menghapus data ini?');
				 if (r== true){
					 ajaxHapusNasabah();
				 }else{//if(r)
					return false;
				}
	        }
	    }); 
		
		  /* $(function() {
				$('#formnasabah').submit(function (event) {
					  dataString = $("#formnasabah").serialize();
					  var r = confirm('Anda yakin menyimpan data ini?');
					  if (r== true){
						ajax_submit_nasabah();
					  }else{//if(r)
						return false;
					  }
				 }); //end  $contact form
		});/// end $func   */
		
		function getDeskripsiNasabah(nasabahId){
		    //ajaxModal();
		    var kd = nasabahId;
		    if (kd != '') {
		        //  alert(kd);
		        $.post("<?php echo site_url('/master_nasabah_c/deskripsiNasabah'); ?>",
		            {
		                'nId': kd
		            },
		            function (data) {
		                if (data.baris == 1) {
		                	$('#txtNasabahId').val(data.nasabah_id);
		                    $('#txtNamaNasabah').val(data.nama_nasabah);
		                    $('#txtNamaAlias').val(data.nama_alias);
		                    $('#txtAlamatDom').val(data.alamatDom);
		                    $('#txtTempatLahir').val(data.tempatlahir);
		                    $('#txtTanggalLahir').val(data.tgllahir);
		                    $('#DL_jenis_kelamin').val(data.jenis_kelamin);
		                    $('#DL_kode_group1').val(data.nasabah_group1);
		                    $('#DL_jenis_gelar').val(data.gelar_id);
		                    $('#txtDesGelar').val(data.KET_GELAR);
		                    $('#DL_jenis_Id').val(data.jenis_id);
		                    $('#txtNoId').val(data.no_id);
		                    $('#txtIdMasaBerlaku').val(data.tglid);
		                    $('#txtKodeArea').val(data.KODE_AREA);
		                    $('#txtNoTelp').val(data.telpon);
		                    $('#txtNoHp').val(data.NO_HP);
		                    $('#txtAlamatKtp').val(data.alamat);
		                    $('#txtKodePos').val(data.kode_pos);
		                    $('#txtKelurahan').val(data.kelurahan);
		                    $('#txtKecamatan').val(data.kecamatan);
		                    $('#DL_jenis_kota').val(data.kota_id);
		                    //$('#txtKota').val(data.);
		                    $('#DL_jenis_negara').val(data.KODE_NEGARA);
		                    $('#DL_jenis_kerja').val(data.pekerjaan_id);
		                    $('#txtKetKerja').val(data.pekerjaan);
		                    $('#txtNamaPerush').val(data.Tempat_Kerja);
		                    $('#txtNip').val(data.NO_NIP);
		                    $('#txtNpwp').val(data.NPWP);
		                    $('#DL_sid_bidang_usaha').val(data.Kode_Bidang_Usaha);
		                    $('#DL_sid_gol_debitur').val(data.kode_golongan_debitur);
		                    $('#DL_sid_hubungan').val(data.Kode_Hubungan_Debitur);
		                    $('#DL_kode_group4').val(data.NASABAH_GROUP4);
		                    $('#txtTujuanPembRek').val(data.TUJUAN_PEMBUKAAN_KYC);
		                    $('#txtSumberDana').val(data.SUMBER_DANA_KYC);
		                    $('#txtPenggunaanDana').val(data.PENGGUNAAN_DANA_KYC);
		                    $('#txtNamaWaris').val(data.nama_kuasa);
		                } else {
		                    alert('Data tidak ditemukan!');
		                    $('.bersih').val('');
		                    $('#txtNasabahId').focus();
		                }
		            }, "json");
		    }//if kd<>''

		}
	</script>