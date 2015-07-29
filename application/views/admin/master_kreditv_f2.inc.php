<div class="row ">
    <div class="col-md-6">
    
    
    	<div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal realisasi :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                         <?php echo  form_input(array('name'=>'txtTglReal','class'=>'bersih form-control','id'=>'txtTglReal','placeholder'=>'dd-mm-yyyy','value'=>$this->session->userdata('tglD')));?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Jumlah pinjaman :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtJmlKre','class'=>'nomor form-control','id'=>'txtJmlKre'));?>
                    </div>                                   
                </div>
                <div class="col-md-4">
                    <label>Bunga :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor form-control','id'=>'txtBunga','readonly'=>'readonly'));?>
                    </div>                                   
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Jml angsuran :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                         <?php echo  form_input(array('name'=>'txtJmlAngs','class'=>'nomor1 form-control','id'=>'txtJmlAngs'));?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                    	<?php
						$data = array();
							foreach($kode_satuan_waktu_angs as $row) : 
									$data[$row['KODE_SATUAN_WAKTU']] = $row['DESKRIPSI_SATUAN_WAKTU'];
							endforeach; 
							echo form_dropdown('DL_satwaktu_angs_kre', $data,'','id="DL_satwaktu_angs_kre" class="form-control"');
						?>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>Jangka waktu :</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'teks-kanan form-control','id'=>'txtJangkaWaktu','readonly'=>'readonly'));?>
                    	<span class="input-group-addon">
                        <i class="">Bulan</i>
                        </span>
                    </div>                                   
                </div>
                <div class="col-md-3">
                    <label>Jatuh tempo :</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtJatuhTempo','class'=>'bersih form-control','id'=>'txtJatuhTempo','placeholder'=>'dd-mm-yyyy','readonly'=>'readonly'));?>
                    	<span class="input-group-addon">
                        <i class="">Bulan</i>
                        </span>
                    </div>                                   
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Bunga flat (%) :</label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtBungaFlatTahun','class'=>'nomor form-control','id'=>'txtBungaFlatTahun','maxlength'=>5));?>
                         <span class="input-group-addon">
                        <i class="">Tahun</i>
                        </span>
                    </div>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtBungaFlatBulan','class'=>'teks-kanan  form-control','id'=>'txtBungaFlatBulan','readonly'=>'readonly'));?>
                		<span class="input-group-addon">
                        <i class="">Bulan</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Termin (%) :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                        <i class="">Pokok</i>
                        </span>
                         <?php echo  form_input(array('name'=>'txtTerminPokok','class'=>'teks-kanan form-control','id'=>'txtTerminPokok','value'=>1));?>
                         <span class="input-group-addon">
                        <i class="">Tahun</i>
                        </span>
                    </div>
                    <div class="input-group">
                    	<span class="input-group-addon">
                        <i class="">Bunga</i>
                        </span>
                    	<?php echo  form_input(array('name'=>'txtTerminBunga','class'=>'teks-kanan form-control','id'=>'txtTerminBunga','value'=>1));?>
                		<span class="input-group-addon">
                        <i class="">Bulan</i>
                        </span>
                    </div>
                </div>
                
            </div>
        </div>
        <?php echo  form_input(array('name'=>'txtAdmin','class'=>'nomor span8','id'=>'txtAdmin','type'=>'hidden'));?>
        <?php echo  form_input(array('name'=>'txtBonus','class'=>'nomor span8','id'=>'txtBonus','type'=>'hidden'));?>
        <?php echo  form_input(array('name'=>'txtFaktorAnnuitas','class'=>'nomor span10','id'=>'txtFaktorAnnuitas','type'=>'hidden'));?>
        <?php echo  form_input(array('name'=>'txtGracePokok','class'=>'nomor span3','id'=>'txtGracePokok','type'=>'hidden'));?>
        <?php echo  form_input(array('name'=>'txtGraceBunga','class'=>'nomor span3','id'=>'txtGraceBunga','type'=>'hidden'));?>
        <?php  echo  form_input(array('name'=>'txtBungaEkiv','class'=>'nomor span3','id'=>'txtBungaEkiv','type'=>'hidden'));?>
        <?php  echo  form_input(array('name'=>'txtAngsEkiv','class'=>'nomor span3','id'=>'txtAngsEkiv','type'=>'hidden'));?>
        <?php  echo  form_input(array('name'=>'txtFee1','class'=>'nomor span3','id'=>'txtFee1','type'=>'hidden'));?>
        <?php  echo  form_input(array('name'=>'txtFee2','class'=>'nomor span3','id'=>'txtFee2','type'=>'hidden'));?>
        <?php  echo  form_input(array('name'=>'txtFee3','class'=>'nomor span3','id'=>'txtFee3','type'=>'hidden'));?>
        
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Denda :</label>
                    <div class="input-group">
                         <?php echo  form_input(array('name'=>'txtDenda','class'=>'nomor form-control','id'=>'txtDenda'));?>
                         <span class="input-group-addon">
                        <i class="">% Hari</i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Denda jatuh tempo :</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtDendaJT','class'=>'nomor form-control','id'=>'txtDendaJT'));?>
                    	<span class="input-group-addon">
                        <i class="">% Hari</i>
                        </span>
                    </div>                                   
                </div>
                <div class="col-md-4">
                    <label>Grace period :</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtGraceHari','class'=>'nomor1 form-control','id'=>'txtGraceHari'));?>
                    	<span class="input-group-addon">
                        <i class="">Hari</i>
                        </span>
                    </div>                                   
                </div>
            </div>
        </div>    
        <?php  echo  form_input(array('name'=>'txtAdminG','class'=>'nomor span6 ','id'=>'txtAdminG','type'=>'hidden'));?>    
        
    </div>
    <!--END <div class="col-md-6"> -->
    
    <div class="col-md-6">
    	
        	
    
    	
        
        
    </div>
    <!--END <div class="col-md-6"> -->
</div>