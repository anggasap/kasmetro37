<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span6"><!-- span 6 1-->
      	<h4>Laporan Bulanan</h4>
        <div class="row-fluid" >
              <div class="span6">
              <label>No Rekening</label>
                    <?php echo  form_input(array('name'=>'txtNoRekKre','class'=>'bersih span11','id'=>'txtNoRekKre','required'=>'required'));?>
              </div>
              <div class="span6">
              <label>Nama</label>
                    <?php echo  form_input(array('name'=>'txtNamaKre','class'=>'bersih span11','id'=>'txtNamaKre','required'=>'required','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Jenis Agunan</label>
            <?php
              $data = array(
                  );
                  foreach($kode_agunan_jenis as $row) : 
                          $data[$row['KODE_AGUNAN']] = $row['DESKRIPSI_AGUNAN'];
                  endforeach; 
                  echo form_dropdown('DL_agunan_jenis', $data,1,'id="DL_agunan_jenis"');
              ?>                
            </div>
            <div class="span6">
            <label>Ikatan Hukum</label>
            <?php
              $data = array(
                  );
                  foreach($kode_agunan_ikhukum as $row) : 
                          $data[$row['KODE_IKATAN_HUKUM']] = $row['DESKRIPSI_IKATAN_HUKUM'];
                  endforeach; 
                  echo form_dropdown('DL_agunan_ikhukum', $data,1,'id="DL_agunan_ikhukum"');
              ?>                
            </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Nilai Agunan</label>
                    <?php echo  form_input(array('name'=>'txtNilaiAgunan','class'=>'nomor span12','id'=>'txtNilaiAgunan'));?>
              </div>
              <div class="span6">
              <label>Nilai Agunan BI</label>
                    <?php echo  form_input(array('name'=>'txtNilaiAgunanBI','class'=>'nomor span12','id'=>'txtNilaiAgunanBI'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>% Likuidasi</label>
                    <?php echo  form_input(array('name'=>'txtLikuidasiPersen','class'=>'teks-kanan','id'=>'txtLikuidasiPersen','readonly'=>'readonly'));?>
              </div>
              <div class="span6">
              <label>Nilai Likuidasi</label>
                    <?php echo  form_input(array('name'=>'txtLikuidasi','class'=>'teks-kanan span12','id'=>'txtLikuidasi','readonly'=>'readonly'));?>
              </div>
        </div>       
      </div><!-- end span 6 1-->
      <div class="span6"><!-- span 6 2-->
      <h4>Sistem Informasi Debitur</h4>
      	<div class="row-fluid">
        	<div class="span6">
            <label>Jenis Agunan</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_agunan_jenis as $row) : 
                          $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_agunan_jenis', $data,'id="DL_sid_agunan_jenis"');
              ?>                
            </div>
            <div class="span6">
            <label>Jenis Pengikatan</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_jenikat as $row) : 
                          $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_jenikat', $data,'id="DL_sid_jenikat"');
              ?>                
            </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Pemilik Agunan</label>
                    <?php echo  form_input(array('name'=>'txtPemilikAgunan','class'=>'bersih','id'=>'txtPemilikAgunan'));?>
              </div>
              <div class="span4">
              <label>Alamat Agunan</label>
                    <?php echo  form_input(array('name'=>'txtAlamatAgunan','class'=>'bersih','id'=>'txtAlamatAgunan'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span4">
              <label>Bukti Agunan</label>
                    <?php echo  form_input(array('name'=>'txtBuktiAgunan','class'=>'bersih span11','id'=>'txtBuktiAgunan'));?>
              </div>
              <div class="span4">
              <label>Jatuh Tempo</label>
                    <?php echo  form_input(array('name'=>'txtJTAgunan','class'=>'bersih span11','id'=>'txtJTAgunan','placeholder'=>'dd-mm-yyyy','value'=>$this->session->userdata('tglD')));?>
              </div>
              <div class="span4">
              <label>No. Agunan</label>
                    <?php echo  form_input(array('name'=>'txtNoAgunan','class'=>'bersih span11','id'=>'txtNoAgunan'));?>
              </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Kode Agunan Intern</label>
            <?php
              $data = array(
                  );
                  foreach($kode_agunan_intern as $row) : 
                          $data[$row['KODE_AGUNAN']] = $row['DESKRIPSI_AGUNAN'];
                  endforeach; 
                  echo form_dropdown('DL_agunan_intern', $data,'id="DL_agunan_intern"');
              ?>                
            </div>
        </div>
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->

<div class="row-fluid"><!-- row fluid 12 besar -->
<h4>Rncian Agunan</h4>
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span4"><!-- span 6 1-->       
      	<div class="row-fluid">
        	<div class="span12">
              <label>Agunan</label>
                    <?php echo  form_input(array('name'=>'txtNamaAgunan','class'=>'bersih span11','id'=>'txtNamaAgunan','maxlength'=>100));?>
              </div>
        </div>	
      </div><!-- end span 6 1-->
      <div class="span8"><!-- span 6 2-->
      
      <div class="row-fluid" >
              <div class="span10">
              	<label>Rincian</label>
                <?php
                    $data = array(
                        'name'        => 'txtRincianAgunan',
                        'id'          => 'txtRincianAgunan',
                        'onkeyup'     => 'ToUpper(this)',
                        'rows'        => '4',
                        'style'       => '',
                        'class'		  =>'span12 bersih',
                        'placeholder' => ''
                      );
                    echo form_textarea($data);
                    ?>	
              </div>
        </div>
      	<div class="row-fluid" >
        	<div class="span10">
              <button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
              <i class="icon-save"></i><span class="ladda-label"> Simpan</span></button>
              <a class="btn btn-primary" id="btnUbah" name="btnUbah"><i class="icon-print"></i><span class="ladda-label"> Ubah</span></a>
              <a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>		
              <a class="btn btn-warning" onclick="return confirm('Anda yakin?');" href="<?php echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>
        	</div>
        </div>
      
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->