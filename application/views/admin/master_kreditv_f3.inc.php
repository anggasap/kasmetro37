<div class="row ">
    <div class="col-md-6">
    
    	<div class="form-group">
        	<center>Provisi</center>
            <div class="row">
                <div class="col-md-4">
                    <label></label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtByProvisiPersen','class'=>'nomor form-control','id'=>'txtByProvisiPersen'));?>
                         <span class="input-group-addon">
                         <i class="">%</i>
                         </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label></label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtByProvisi','class'=>' teks-kanan form-control','id'=>'txtByProvisi','readonly'=>'readonly'));?>
                    </div>                                   
                </div>
                <div class="col-md-4">
                	<div class="checkbox-list">
                    	<label>&nbsp;</label>
                    		<label class="checkbox-inline">
                        		<input type="checkbox" name="chkAmortProv" value="1"> Amortisasi
                      		</label>
                    </div>        
                </div>
            </div>
        </div>
        <div class="form-group">
        	<center>Adm</center>
            <div class="row">
                <div class="col-md-4">
                    <label></label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtByAdminPersen','class'=>'nomor form-control','id'=>'txtByAdminPersen'));?>
                         <span class="input-group-addon">
                         <i class="">%</i>
                         </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label></label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	 <?php echo  form_input(array('name'=>'txtByAdmin','class'=>'teks-kanan form-control','id'=>'txtByAdmin','readonly'=>'readonly'));?>
                    </div>                                   
                </div>
                <div class="col-md-4">
                	     
                </div>
            </div>
        </div>
        <div class="form-group">
        	<center>Biaya transaksi</center>
            <div class="row">
                <div class="col-md-3">
                    <label></label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtByTransPersen','class'=>'nomor form-control','id'=>'txtByTransPersen'));?>
                         <span class="input-group-addon">
                         <i class="">%</i>
                         </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label></label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtByTrans','class'=>'teks-kanan form-control','id'=>'txtByTrans','readonly'=>'readonly'));?>
                    </div>                                   
                </div>
                <div class="col-md-3">
                	<div class="checkbox-list">
                    	<label>&nbsp;</label>
                    		<label class="checkbox-inline">
                        		<input type="checkbox" name="chkAmortByTrans" value="1"> Amortisasi
                      		</label>
                    </div>        
                </div>
                <div class="col-md-3">
                	<div class="checkbox-list">
                    	<label>&nbsp;</label>
                    		<label class="checkbox-inline">
                        		<input type="checkbox" name="chkAmortByTransDD" value="1"> Ditanggung Debitur
                      		</label>
                    </div>        
                </div>
            </div>
        </div>
        <div class="form-group">
        	<div class="row">
                <div class="col-md-3">
                    <label>Premi :</label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtByPremi','class'=>'nomor form-control','id'=>'txtByPremi'));?>
                         <span class="input-group-addon">
                         <i class="">%</i>
                         </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Notariel :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtByNotariel','class'=>'nomor form-control','id'=>'txtByNotariel'));?>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>Materai :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtByMaterai','class'=>'nomor form-control','id'=>'txtByMaterai'));?>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>Pokok materai :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtByMateraiHpp','class'=>'nomor form-control','id'=>'txtByMateraiHpp'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<center>Angsuran Premi</center>
        	<div class="row">
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtAngsPremi1','class'=>'nomor1 form-control','id'=>'txtAngsPremi1'));?>
                        <span class="input-group-addon">
                        x
                        </span>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtAngsPremi2','class'=>'nomor form-control','id'=>'txtAngsPremi2'));?>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        :
                        </span>
                    	<?php echo  form_input(array('name'=>'txtAngsPremi3','class'=>'nomor form-control','id'=>'txtAngsPremi3'));?>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>Lain-lain :</label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtByLain','class'=>'nomor form-control','id'=>'txtByLain'));?>
                         <span class="input-group-addon">
                         <i class="fa fa-dollar"></i>
                         </span>
                    </div>
                </div>
                
            </div>
        </div>
    	
        
    </div>
    <!--END <div class="col-md-6"> -->
    
    <div class="col-md-6">
    	
        
    
    	
        
        
    </div>
    <!--END <div class="col-md-6"> -->
</div>