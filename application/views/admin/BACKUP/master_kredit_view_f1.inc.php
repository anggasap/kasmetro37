<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span6"><!-- span 6 1-->  
      	<div class="row-fluid" >
              <div class="span5">
              <label>Jenis Pinjaman</label>
              <?php
			  $data = array(
			  
                  );
                  foreach($jenis_kre as $row) : 
                          $data[$row['KODE_JENIS_KREDIT']] = $row['DESKRIPSI_JENIS_KREDIT'];
                  endforeach; 
                  echo form_dropdown('DL_jenis_kre', $data,10,'id="DL_jenis_kre"');
				  // 
              ?>
              </div>
              <div class="span4">
                  <label>Tipe Kredit</label>
                  <select name="DL_tipe_kre" id="DL_tipe_kre" style="width:120px;">
                  <option value="1" selected="selected">KREDIT</option>
                  <option value="2">AB-AKTIVA</option>
                  <option value="3">AB-PASIVA</option>
                  </select>	
              </div>
              <div class="span3">
              <label>Status</label>
              <select name="DL_status_tab" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"  style="width:80px;">
                  <option value="1" selected="selected">Baru</option>
                  <option value="2">Aktif</option>
                  <option value="3">Tutup</option>
              </select>	
              </div>
          </div>
          <div class="row-fluid" >
              <div class="span4">
              <label>No Rekening</label>
                    <?php echo  form_input(array('name'=>'txtNoRekKre','class'=>'bersih span11','id'=>'txtNoRekKre','required'=>'required'));?>
              </div>
              <div class="span4">
              <label>No PK Lama</label>
                    <?php echo  form_input(array('name'=>'txtPkLama','class'=>'bersih span11','id'=>'txtPkLama'));?>
              </div>
              <div class="span4">
              <label>Tanggal PK Lama</label>
                    <?php echo  form_input(array('name'=>'txtTglPkLama','class'=>'bersih span11','id'=>'txtTglPkLama','placeholder'=>'dd-mm-yyyy','value'=>$this->session->userdata('tglD')));?>
              </div>
        </div>
        <div class="row-fluid span6"><!-- start <div class="row-fluid span6"> -->
            <div class="row-fluid">
                  <div class="span7">
                    <div class="input-append">
                    <?php echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih span11 appendedInputButtons','id'=>'txtNasabahId','placeholder'=>'Nasabah/Anggota ID','readonly'=>'readonly'));?>	
                          
                     <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#input_cari_nasabah').window('open')" id="idCmdBrowse"><i class="icon-search icon-white"></i>&nbsp;</a>      
                    </div>	
                  </div>
                  
            </div>
            <div class="row-fluid">
                  <div class="span10">
                  <?php echo  form_input(array('name'=>'txtNama','class'=>'bersih span12','id'=>'txtNama','placeholder'=>'Nama Nasabah/Anggota','readonly'=>'readonly'));?>	
                  </div>
            </div>
        </div>    <!-- end <div class="row-fluid span6"> -->
        <div class="row-fluid" >
                <div class="span6">
                <?php
                    $data = array(
                        'name'        => 'txtAlamat',
                        'id'          => 'txtAlamat',
                        'onkeyup'     => 'ToUpper(this)',
                        'rows'        => '3',
                        'style'       => 'width:253px',
                        'class'		  =>'span12 bersih',
                        'maxlength'	  =>'100',
                        'placeholder' => 'Alamat',
                        'readonly'    =>'readonly'
                      );
                    echo form_textarea($data);
                    ?>	
                </div>
        </div>
        <div class="row-fluid" >
              <div class="span5">
              <label>No PK Baru</label>
              <?php echo  form_input(array('name'=>'txtPkBaru','class'=>'bersih span12','id'=>'txtPkBaru'));?>
              </div>
        </div>      	     
      </div><!-- end span 6 1-->
      <div class="span6"><!-- span 6 2-->
      	<div class="row-fluid" >
              <div class="span6">
              <label>Kode Group 1</label>
              <?php
              $data = array(
                  );
                  foreach($kode_group1 as $row) : 
                          $data[$row['KODE_GROUP1']] = $row['DESKRIPSI_GROUP1'];
                  endforeach; 
                  echo form_dropdown('DL_kodegroup1_kre', $data,'DL_kodegroup1_kre"');
              ?>
              </div>
              <div class="span6">
              <label>Kode Group 2</label>
              <?php
              $data = array(
                  );
                  foreach($kode_group2 as $row) : 
                          $data[$row['KODE_GROUP2']] = $row['DESKRIPSI_GROUP2'];
                  endforeach; 
                  echo form_dropdown('DL_kodegroup2_kre', $data,'id="DL_kodegroup2_kre"');
              ?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Kode Group 3</label>
              <?php
              $data = array(
                  );
                  foreach($kode_group3 as $row) : 
                          $data[$row['KODE_GROUP3']] = $row['DESKRIPSI_GROUP3'];
                  endforeach; 
                  echo form_dropdown('DL_kodegroup3_kre', $data,'DL_kodegroup3_kre"');
              ?>
              </div>
              <div class="span6">
              <label>Kode Group 4</label>
              <?php
              $data = array(
                  );
                  foreach($kode_group4 as $row) : 
                          $data[$row['KODE_GROUP4']] = $row['DESKRIPSI_GROUP4'];
                  endforeach; 
                  echo form_dropdown('DL_kodegroup4_kre', $data,'id="DL_kodegroup4_kre"');
              ?>
              </div>
        </div> 
        <div class="row-fluid" >
              <div class="span6">
              <label>Type</label>
              <?php
              $data = array(
                  );
                  foreach($type_kre as $row) : 
                          $data[$row['KODE_TYPE_KREDIT']] = $row['DESKRIPSI_TYPE_KREDIT'];
                  endforeach; 
                  echo form_dropdown('DL_type_kre', $data,'DL_type_kre"');
              ?>
              </div>
              <div class="span3">
              <label>Toleransi</label>
                  <select name="DL_toleransi_kre" id="DL_toleransi_kre" style="width:130px;">
                      <option value="1" selected="selected">Sesuai Jadwal</option>
                      <option value="2">Akhir Bulan</option>
                  </select>
              </div>
              <div class="span2">
              <label>&nbsp;</label>
              <?php echo  form_input(array('name'=>'txtHariTol','class'=>'nomor1 span6','id'=>'txtHariTol'));?>
              &nbsp; Hari    
              </div>
        </div>
        <div class="row-fluid" >
            <div class="span6">
            <label>Angsuran/Pokok Disanggupi</label>
                <?php echo  form_input(array('name'=>'txtAngsDisanggupi','class'=>'nomor','id'=>'txtAngsDisanggupi'));?>
                
            </div>         
        </div>       
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->