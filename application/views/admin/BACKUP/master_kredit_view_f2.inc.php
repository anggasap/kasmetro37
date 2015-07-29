<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span8"><!-- span 6 1-->
      <h4>Data Angsuran</h4>
      	<div class="row-fluid" >
            <div class="span3">
            <label>Tanggal Realisasi</label>
                <?php echo  form_input(array('name'=>'txtTglReal','class'=>'bersih span10','id'=>'txtTglReal','placeholder'=>'dd-mm-yyyy','value'=>$this->session->userdata('tglD')));?>
                
            </div>
            <div class="span6">
            <label>Jumlah Pinjaman</label>
                <?php echo  form_input(array('name'=>'txtJmlKre','class'=>'nomor','id'=>'txtJmlKre'));?>
                
            </div>
            <div class="span3">
            <label>Bunga</label>
                <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor span10','id'=>'txtBunga','readonly'=>'readonly'));?>
                
            </div>         
        </div>
        <div class="row-fluid" >
            <div class="span3">
            <label>Jml Angsuran</label>
                <?php echo  form_input(array('name'=>'txtJmlAngs','class'=>'nomor1 span10','id'=>'txtJmlAngs'));?>
                
            </div>
            <div class="span2">
            <label>&nbsp;</label>
            <?php
              $data = array(
                  );
                  foreach($kode_satuan_waktu_angs as $row) : 
                          $data[$row['KODE_SATUAN_WAKTU']] = $row['DESKRIPSI_SATUAN_WAKTU'];
                  endforeach; 
                  echo form_dropdown('DL_satwaktu_angs_kre', $data,'id="DL_satwaktu_angs_kre"', 'style="width:80px;"');
              ?>                
            </div>
            <div class="span4">
            <label>Jangka Waktu</label>
                <?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'teks-kanan span8','id'=>'txtJangkaWaktu','readonly'=>'readonly'));?>
                &nbsp;Bln
            </div>
            <div class="span3">
            <label>Jatuh Tempo</label>
                <?php echo  form_input(array('name'=>'txtJatuhTempo','class'=>'bersih span10','id'=>'txtJatuhTempo','placeholder'=>'dd-mm-yyyy','readonly'=>'readonly'));?>
            </div>         
        </div>
        <div class="row-fluid" >
            <div class="span6 alert alert-info">
            <center><label>Bunga Flat</label></center>
                <?php echo  form_input(array('name'=>'txtBungaFlatTahun','class'=>'nomor span3','id'=>'txtBungaFlatTahun','maxlength'=>5));?>
                &nbsp; %/Thn
                <?php echo  form_input(array('name'=>'txtBungaFlatBulan','class'=>'teks-kanan span3','id'=>'txtBungaFlatBulan','readonly'=>'readonly'));?>
                &nbsp; %/Bln
            </div>
            <div class="span6 alert alert-info">
            <center><label  >Termin</label></center>
            	Pokok &nbsp;
                <?php echo  form_input(array('name'=>'txtTerminPokok','class'=>'teks-kanan span3','id'=>'txtTerminPokok','value'=>1));?>
                &nbsp; Bunga &nbsp;
                <?php echo  form_input(array('name'=>'txtTerminBunga','class'=>'teks-kanan span3','id'=>'txtTerminBunga','value'=>1));?>
            </div>
          <!--  
            <div class="span3 alert alert-info">
            <label >Admin</label>
                -->
				<?php echo  form_input(array('name'=>'txtAdmin','class'=>'nomor span8','id'=>'txtAdmin','type'=>'hidden'));?>
           <!--     
                &nbsp;%/Bln  
            </div>
            <div class="span3 alert alert-info">
            <label >Bonus</label>
            -->
                <?php echo  form_input(array('name'=>'txtBonus','class'=>'nomor span8','id'=>'txtBonus','type'=>'hidden'));?>
           <!--    
                &nbsp;%/Bln
            </div>   
            -->      
        </div>
        <div class="row-fluid" >
        <!--
            <div class="span2 alert alert-info">
            <center><label  >Anuitas</label></center>
        -->    
                <?php echo  form_input(array('name'=>'txtFaktorAnnuitas','class'=>'nomor span10','id'=>'txtFaktorAnnuitas','type'=>'hidden'));?>
         <!--
            </div>
            
            <!--Termin harusnya disini -->
            <!--
            <div class="span5 alert alert-info">
            <center><label>Grace Periode</label></center>
            	Pokok &nbsp;
            -->    
                <?php echo  form_input(array('name'=>'txtGracePokok','class'=>'nomor span3','id'=>'txtGracePokok','type'=>'hidden'));?>
              <!--  &nbsp; Bunga &nbsp; -->
                <?php echo  form_input(array('name'=>'txtGraceBunga','class'=>'nomor span3','id'=>'txtGraceBunga','type'=>'hidden'));?>
            <!--
            </div>
            -->         
        </div>
        <!--
        <div class="row-fluid" >
            <div class="span6 alert alert-info">
            <center><label>Bunga Ekivalen</label></center>
            -->
                <?php  echo  form_input(array('name'=>'txtBungaEkiv','class'=>'nomor span3','id'=>'txtBungaEkiv','type'=>'hidden'));?>
          <!--      &nbsp; %/Thn -->
                <?php  echo  form_input(array('name'=>'txtAngsEkiv','class'=>'nomor span3','id'=>'txtAngsEkiv','type'=>'hidden'));?>
		<!--
                &nbsp; %/Angs
            </div>
            
            <div class="span6 alert alert-info">
            <center><label>Fee (%)</label></center>
            	1 &nbsp;
             -->   
                <?php  echo  form_input(array('name'=>'txtFee1','class'=>'nomor span3','id'=>'txtFee1','type'=>'hidden'));?>
                <!--&nbsp; 2 &nbsp; -->
                <?php  echo  form_input(array('name'=>'txtFee2','class'=>'nomor span3','id'=>'txtFee2','type'=>'hidden'));?>
                <!--&nbsp; 3 &nbsp; -->
                <?php  echo  form_input(array('name'=>'txtFee3','class'=>'nomor span3','id'=>'txtFee3','type'=>'hidden'));?>
            <!--
            </div>
        </div>
        -->
        <div class="row-fluid" >
            <div class="span3 alert alert-info">
            <center><label>Denda</label></center>
                <?php echo  form_input(array('name'=>'txtDenda','class'=>'nomor span6','id'=>'txtDenda'));?>
                &nbsp; % / Hari
            </div>
            
            <div class="span4 alert alert-info"><!--span3 -> span 6 -->
            <center><label>Denda Jatuh Tempo</label></center>
            	<?php echo  form_input(array('name'=>'txtDendaJT','class'=>'nomor span4','id'=>'txtDendaJT'));?>
                &nbsp; % / Hari
            </div>
            <div class="span3 alert alert-info">
            <label>Grace Periode</label>
            	<?php echo  form_input(array('name'=>'txtGraceHari','class'=>'nomor1 span6','id'=>'txtGraceHari'));?>
                &nbsp; Hari
            </div>
            <!--
            <div class="span3 alert alert-info">
            <label>Adm</label>
            -->
            	<?php  echo  form_input(array('name'=>'txtAdminG','class'=>'nomor span6 ','id'=>'txtAdminG','type'=>'hidden'));?>
           <!--    
                &nbsp; %
            </div>
            -->
        </div>
        	       
      </div><!-- end span 6 1-->
      <div class="span4"><!-- span 6 2-->
      	        
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->