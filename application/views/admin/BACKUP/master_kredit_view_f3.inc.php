<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span6"><!-- span 6 1-->
      <h4>Data Penjamin</h4>
      	<div class="row-fluid" >
            <div class="span4">
            <label>Penjamin</label>
                <?php echo  form_input(array('name'=>'txtNamaPenjamin','class'=>'bersih span10','id'=>'txtNamaPenjamin','placeholder'=>''));?>
                
            </div>
            <div class="span4">
            <label>No. ID Penjamin</label>
                <?php echo  form_input(array('name'=>'txtIdPenjamin','class'=>'bersih span10','id'=>'txtIdPenjamin'));?>
                
            </div>
            <div class="span4">
            <label>Tgl Analisa</label>
                <?php echo  form_input(array('name'=>'txtTglAnalisa','class'=>'bersih span10','id'=>'txtTglAnalisa','value'=>$this->session->userdata('tglD')));?>
            </div>         
        </div>
        <div class="row-fluid" >
        	<div class="span4">
            <label>Pekerjaan Penjamin</label>
                <?php echo  form_input(array('name'=>'txtKerjaPenjamin','class'=>'bersih span10','id'=>'txtKerjaPenjamin'));?>
            </div>
            <div class="span4">
            <label>Alamat Suami/Isteri</label>
             <?php
                    $data = array(
                        'name'        => 'txtAlamatPenjamin',
                        'id'          => 'txtAlamatPenjamin',
                        'onkeyup'     => 'ToUpper(this)',
                        'rows'        => '2',
                        'style'       => 'width:253px',
                        'class'		  =>'span12 bersih',
                        'maxlength'	  =>'100',
                        'placeholder' => 'Alamat'
                      );
                    echo form_textarea($data);
                    ?>
            </div>
        </div>       
      </div><!-- end span 6 1-->
      <div class="span6"><!-- span 6 2-->
      <h4>Data Suami/Isteri</h4>
      	<div class="row-fluid" >
            <div class="span6">
            <label>Data</label>
                <select name="DL_suami_isteri" id="DL_suami_isteri">
                <option value="ISTERI" selected="selected">ISTERI</option>
                <option value="SUAMI">SUAMI</option>
                </select>
            </div>
            <div class="span4">
            <label>Nama</label>
                <?php echo  form_input(array('name'=>'txtNamaSuamiIsteri','class'=>'bersih','id'=>'txtNamaSuamiIsteri'));?>
            </div>
        </div>
        <div class="row-fluid" >
            <div class="span6">
            <label>Alamat Penjamin</label>
             <?php
                    $data = array(
                        'name'        => 'txtAlamatSuamiIsteri',
                        'id'          => 'txtalamatSuamiIsteri',
                        'onkeyup'     => 'ToUpper(this)',
                        'rows'        => '2',
                        'style'       => 'width:253px',
                        'class'		  =>'span12 bersih',
                        'maxlength'	  =>'100'
                      );
                    echo form_textarea($data);
                    ?>
            </div>
            <div class="span6">
            <label>Pekerjaan</label>
                <?php echo  form_input(array('name'=>'txtKerjaSuamiIsteri','class'=>'bersih','id'=>'txtKerjaSuamiIsteri'));?>
            </div>
        </div>
         <h4>Kartu Pensiun</h4>
      	<div class="row-fluid" >
            <div class="span6">
            <label>No. Pensiun</label>
                <?php echo  form_input(array('name'=>'txtNoPensiun','class'=>'bersih','id'=>'txtNoPensiun','placeholder'=>''));?>
                
            </div>
            <div class="span6">
            <label>No. Kartu Pensiun</label>
                <?php echo  form_input(array('name'=>'txtNoKartuPensiun','class'=>'bersih','id'=>'txtNoKartuPensiun'));?>
                
            </div>
        </div>
        <div class="row-fluid" >
            <div class="span6">
            <label>Jenis Pensiun</label>
                <?php echo  form_input(array('name'=>'txtJenisPensiun','class'=>'bersih','id'=>'txtJenisPensiun','placeholder'=>''));?>
                
            </div>
            <div class="span6">
            <label>PK Pinjaman</label>
                <?php echo  form_input(array('name'=>'txtPKPensiun','class'=>'bersih','id'=>'txtJenisPensiun'));?>
            </div>
        </div>
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->