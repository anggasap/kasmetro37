<div class="row ">
    <div class="col-md-6">
     
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Jenis pinjaman:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-suitcase"></i>
                        </span>
                        <?php
						  $data = array(
						  
							  );
							  foreach($jenis_kre as $row) : 
									  $data[$row['KODE_JENIS_KREDIT']] = $row['DESKRIPSI_JENIS_KREDIT'];
							  endforeach; 
							  echo form_dropdown('DL_jenis_kre', $data,10,'id="DL_jenis_kre" class="form-control"');
							  // 
						  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Tipe pinjaman :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                        <select name="DL_tipe_kre" id="DL_tipe_kre" class="form-control">
                        <option value="1" selected="selected">KREDIT</option>
                        <option value="2">AB-AKTIVA</option>
                        <option value="3">AB-PASIVA</option>
                        </select>
                    </div>                                 
                </div>
                <div class="col-md-4">
                    <label>Status :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                        <select name="DL_status_tab" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"  class="form-control">
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
                <div class="col-md-4">
                    <label>No rekening:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-suitcase"></i>
                        </span>
                        <?php echo  form_input(array('name'=>'txtNoRekKre','class'=>'bersih form-control','id'=>'txtNoRekKre','required'=>'required'));?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>No PK lama :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                        <?php echo  form_input(array('name'=>'txtPkLama','class'=>'bersih form-control','id'=>'txtPkLama'));?>
                    </div>                                 
                </div>
                <div class="col-md-4">
                    <label>Tanggal PK lama :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                        <?php echo  form_input(array('name'=>'txtTglPkLama','class'=>'bersih form-control','id'=>'txtTglPkLama','placeholder'=>'dd-mm-yyyy','value'=>$this->session->userdata('tglD')));?>
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
            <label>PK baru :</label>
            <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-user"></i>
                </span>
                <?php echo  form_input(array('name'=>'txtPkBaru','class'=>'bersih form-control','id'=>'txtPkBaru'));?>
            </div>
        </div>
        
        
    </div>
    <!--END <div class="col-md-6"> -->
    
    <div class="col-md-6">
    
    	<div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Kode group 1 :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                         <?php
						  $data = array(
							  );
							  foreach($kode_group1 as $row) : 
									  $data[$row['KODE_GROUP1']] = $row['DESKRIPSI_GROUP1'];
							  endforeach; 
							  echo form_dropdown('DL_kodegroup1_kre', $data,'','id = "DL_kodegroup1_kre" class="form-control"');
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
						  echo form_dropdown('DL_kodegroup2_kre', $data,'','id="DL_kodegroup2_kre" class="form-control"');
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
						  $data = array(
							  );
							  foreach($kode_group3 as $row) : 
									  $data[$row['KODE_GROUP3']] = $row['DESKRIPSI_GROUP3'];
							  endforeach; 
							  echo form_dropdown('DL_kodegroup3_kre', $data,'','id ="DL_kodegroup3_kre" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Kode Group 4</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                    	<?php
						$data = array(
							);
							foreach($kode_group4 as $row) : 
									$data[$row['KODE_GROUP4']] = $row['DESKRIPSI_GROUP4'];
							endforeach; 
							echo form_dropdown('DL_kodegroup4_kre', $data,'','id="DL_kodegroup4_kre" class="form-control"');
						?>
                    </div>                                   
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Type :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                         <?php
						  $data = array(
							  );
							  foreach($type_kre as $row) : 
									  $data[$row['KODE_TYPE_KREDIT']] = $row['DESKRIPSI_TYPE_KREDIT'];
							  endforeach; 
							  echo form_dropdown('DL_type_kre', $data,'','id = "DL_type_kre" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Toleransi</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                    	<select name="DL_toleransi_kre" id="DL_toleransi_kre" class="form-control">
                            <option value="1" selected="selected">Sesuai Jadwal</option>
                            <option value="2">Akhir Bulan</option>
                        </select>
                    </div>                                   
                </div>
                <div class="col-md-4">
                    <label>Toleransi</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtHariTol','class'=>'nomor1 form-control','id'=>'txtHariTol'));?>
                        <span class="input-group-addon">
                        <i class="">Hari</i>
                        </span> 
                    </div>                                   
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Angsuran pokok/ disanggupi :</label>
            <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-user"></i>
                </span>
                <?php echo  form_input(array('name'=>'txtAngsDisanggupi','class'=>'nomor form-control','id'=>'txtAngsDisanggupi'));?>
            </div>
        </div>
        
        
    </div>
    <!--END <div class="col-md-6"> -->
</div>