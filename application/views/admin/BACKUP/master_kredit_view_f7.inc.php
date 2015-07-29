<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span6"><!-- span 6 1-->  
      	<div class="row-fluid  alert alert-info" >
            <div class="span6">
            <center><label>Provisi</label></center>
                <?php echo  form_input(array('name'=>'txtByProvisiPersen','class'=>'nomor span3','id'=>'txtByProvisiPersen'));?>
                &nbsp; %
                <?php echo  form_input(array('name'=>'txtByProvisi','class'=>' teks-kanan span8','id'=>'txtByProvisi','readonly'=>'readonly'));?>
            </div>
            <div class="span3">
                <label>&nbsp;</label>
                <label class="checkbox">
                  <input type="checkbox" name="chkAmortProv" value="1"> Amortisasi
                </label>
            </div>
        </div>
        <div class="row-fluid  alert alert-info" >
            <div class="span6">
            <center><label>Adm</label></center>
                <?php echo  form_input(array('name'=>'txtByAdminPersen','class'=>'nomor span3','id'=>'txtByAdminPersen'));?>
                &nbsp; %
                <?php echo  form_input(array('name'=>'txtByAdmin','class'=>'teks-kanan span8','id'=>'txtByAdmin','readonly'=>'readonly'));?>
            </div>
        </div>
        <div class="row-fluid  alert alert-info" >
            <div class="span6">
            <center><label>Biaya Transaksi</label></center>
                <?php echo  form_input(array('name'=>'txtByTransPersen','class'=>'nomor span3','id'=>'txtByTransPersen'));?>
                &nbsp; %
                <?php echo  form_input(array('name'=>'txtByTrans','class'=>'teks-kanan span8','id'=>'txtByTrans','readonly'=>'readonly'));?>
            </div>
            <div class="span3">
                <label>&nbsp;</label>
                <label class="checkbox">
                  <input type="checkbox" name="chkAmortByTrans" value="1"> Amortisasi
                </label>
            </div>
            <div class="span3">
                <label>&nbsp;</label>
                <label class="checkbox">
                  <input type="checkbox" name="chkAmortByTransDD" value="1"> Ditanggung Debitur
                </label>
            </div>
        </div>
        <div class="row-fluid" >
            <div class="span3">
            <label>Premi</label>
                <?php echo  form_input(array('name'=>'txtByPremi','class'=>'nomor span12','id'=>'txtByPremi'));?>
            </div>
            <div class="span3">
            <label>Notariel</label>
            	<?php echo  form_input(array('name'=>'txtByNotariel','class'=>'nomor span12','id'=>'txtByNotariel'));?>
            </div>
            <div class="span3">
            <label>Materai</label>
            	<?php echo  form_input(array('name'=>'txtByMaterai','class'=>'nomor span12','id'=>'txtByMaterai'));?>
            </div>
            <div class="span3">
            <label>Pokok Materai</label>
            	<?php echo  form_input(array('name'=>'txtByMateraiHpp','class'=>'nomor span12','id'=>'txtByMateraiHpp'));?>
            </div>
        </div>
        <div class="row-fluid   alert alert-info" >
            <div class="span8">
            <center><label>Angsuran Premi</label></center>
            <?php echo  form_input(array('name'=>'txtAngsPremi1','class'=>'nomor1 span2','id'=>'txtAngsPremi1'));?>
           &nbsp; X &nbsp;
            <?php echo  form_input(array('name'=>'txtAngsPremi2','class'=>'nomor span4','id'=>'txtAngsPremi2'));?>
            &nbsp; : &nbsp;
            <?php echo  form_input(array('name'=>'txtAngsPremi3','class'=>'nomor span4','id'=>'txtAngsPremi3'));?>
            </div>
            <div class="span4">
            <label>Lain-lain</label>
            <?php echo  form_input(array('name'=>'txtByLain','class'=>'nomor span8','id'=>'txtByLain'));?>
            </div>
        </div>     
      </div><!-- end span 6 1-->
      <div class="span6"><!-- span 6 2-->
      	
      	
        
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->