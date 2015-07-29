<div class="row ">
    <div class="col-md-6">
    	<div class="form-group">
        	<center>Data Penjamin</center>
            <div class="row">
                <div class="col-md-6">
                    <label>Tgl Analisa</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php echo  form_input(array('name'=>'txtTglAnalisa','class'=>'bersih form-control','id'=>'txtTglAnalisa','value'=>$this->session->userdata('tglD')));?>
                    </div>
                </div>
                <div class="col-md-6">
                                                    
                </div>
                
            </div>
        </div>
    	<div class="form-group">
        	<center>Data Penjamin</center>
            <div class="row">
                <div class="col-md-6">
                    <label>Nama penjamin :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php echo  form_input(array('name'=>'txtNamaPenjamin','class'=>'bersih form-control','id'=>'txtNamaPenjamin','placeholder'=>''));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>No. ID penjamin</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtIdPenjamin','class'=>'bersih form-control','id'=>'txtIdPenjamin'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Pekerjaan penjamin :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php echo  form_input(array('name'=>'txtKerjaPenjamin','class'=>'bersih form-control','id'=>'txtKerjaPenjamin'));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Alamat penjamin :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-home"></i>
                        </span>
                    	<?php
                    $data = array(
                        'name'        => 'txtAlamatPenjamin',
                        'id'          => 'txtAlamatPenjamin',
                        'onkeyup'     => 'ToUpper(this)',
                        'rows'        => '2',
                        'style'       => 'width:253px',
                        'class'		  =>'form-control bersih',
                        'maxlength'	  =>'100',
                        'placeholder' => 'Alamat'
                      );
                    echo form_textarea($data);
                    ?>
                    </div>                                   
                </div>
                
            </div>
        </div>
    	
    	
        
    </div>
    <!--END <div class="col-md-6"> -->
    
    <div class="col-md-6">
    	<div class="form-group">
        	<center>Data Suami Isteri</center>
            <div class="row">
                <div class="col-md-6">
                    <label>Data :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <select name="DL_suami_isteri" id="DL_suami_isteri" class="form-control">
                         <option value="ISTERI" selected="selected">ISTERI</option>
                         <option value="SUAMI">SUAMI</option>
                         </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Nama suami/isteri :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtNamaSuamiIsteri','class'=>'bersih form-control','id'=>'txtNamaSuamiIsteri'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Alamat suami/isteri :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array(
							  'name'        => 'txtAlamatSuamiIsteri',
							  'id'          => 'txtalamatSuamiIsteri',
							  'onkeyup'     => 'ToUpper(this)',
							  'rows'        => '2',
							  'style'       => 'width:253px',
							  'class'		  =>'form-control bersih',
							  'maxlength'	  =>'100'
							);
						  echo form_textarea($data);
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Pekerjaan :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtKerjaSuamiIsteri','class'=>'bersih form-control','id'=>'txtKerjaSuamiIsteri'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<center>Kartu pensiun :</center>
            <div class="row">
                <div class="col-md-6">
                    <label>No pensiun :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php echo  form_input(array('name'=>'txtNoPensiun','class'=>'bersih form-control','id'=>'txtNoPensiun','placeholder'=>''));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>No. kartu pensiun :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtNoKartuPensiun','class'=>'bersih form-control','id'=>'txtNoKartuPensiun'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<center>Kartu pensiun :</center>
            <div class="row">
                <div class="col-md-6">
                    <label>Jenis pensiun :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php echo  form_input(array('name'=>'txtJenisPensiun','class'=>'bersih form-control','id'=>'txtJenisPensiun','placeholder'=>''));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>PK pinjaman :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtPKPensiun','class'=>'bersih form-control','id'=>'txtJenisPensiun'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
    	
        
    
    	
        
        
    </div>
    <!--END <div class="col-md-6"> -->
</div>