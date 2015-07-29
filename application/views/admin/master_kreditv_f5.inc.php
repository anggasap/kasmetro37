<div class="row ">
    <div class="col-md-6">
    	<div class="form-group">
        	<center>Laporan Bulanan</center>
            <div class="row">
                <div class="col-md-6">
                    <label>Sifat :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array(
							  );
							  foreach($kode_sifat_kre as $row) : 
									  $data[$row['KODESIFAT_2013']] = $row['DESKRIPSI_SIFAT_2013'];
							  endforeach; 
							  echo form_dropdown('DL_sifat_kre' ,$data,'','id="DL_sifat_kre" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Jenis penggunaan :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php
						$data = array(
							);
							foreach($kode_jenpeng_kre as $row) : 
									$data[$row['KODE_JENIS_PENGGUNAAN_2013']] = $row['DESKRIPSI_JENIS_PENGGUNAAN_2013'];
							endforeach; 
							echo form_dropdown('DL_jenpeng_kre', $data,'','id="DL_jenpeng_kre" class="form-control"');
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Golongan debitur :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						$data = array(
							);
							foreach($kode_gol_deb as $row) : 
									$data[$row['KODE_GOL_DEBITUR_2013']] = $row['DESKRIPSI_GOL_DEBITUR_2013'];
							endforeach; 
							echo form_dropdown('DL_gol_deb_kre', $data,'','id="DL_gol_deb_kre" class="form-control"');
						?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Sektor ekonomi :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php
						$data = array(
							);
							foreach($kode_jenpeng_kre as $row) : 
									$data[$row['KODE_JENIS_PENGGUNAAN_2013']] = $row['DESKRIPSI_JENIS_PENGGUNAAN_2013'];
							endforeach; 
							echo form_dropdown('DL_jenpeng_kre', $data,'','id="DL_jenpeng_kre" class="form-control"');
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Golongan penjamin :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						$data = array(
							);
							foreach($kode_penjamin as $row) : 
									$data[$row['KODE_GOL_PENJAMIN']] = $row['DESKRIPSI_GOL_PENJAMIN'];
							endforeach; 
							echo form_dropdown('DL_penjamin_kre', $data,'','id="DL_penjamin_kre" class="form-control"');
						?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Jenis asuransi :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php
						$data = array(
							);
							foreach($kode_asuransi as $row) : 
									$data[$row['KODE_ASURANSI']] = $row['DESKRIPSI_ASURANSI'];
							endforeach; 
							echo form_dropdown('DL_asuransi_kre', $data,'','id="DL_asuransi_kre" class="form-control"');
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Jumlah asuransi :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php echo  form_input(array('name'=>'txtJmlAsuransi','class'=>'nomor form-control','id'=>'txtJmlAsuransi'));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Dijaminkan :</label>
                    <div class="input-group">
                    	<?php echo  form_input(array('name'=>'txtJmlAsuransiPersen','class'=>'nomor form-control','id'=>'txtJmlAsuransiPersen'));?>
                        <span class="input-group-addon">
                        <i class="">%</i>
                        </span>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Kode metoda :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array();
							  foreach($kode_metoda as $row) : 
									  $data[$row['KODE_METODA']] = $row['DESKRIPSI_METODA'];
							  endforeach; 
							  echo form_dropdown('DL_kodemetoda', $data,'','id="DL_kodemetoda" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Sumber pelunasan :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-tag"></i>
                        </span>
                        <?php
						$data = array(
							);
							foreach($kode_sumber_pelunasan as $row) : 
									$data[$row['KODE_SUMBER_PELUNASAN']] = $row['DESKRIPSI_SUMBER_PELUNASAN'];
							endforeach; 
							echo form_dropdown('DL_sumber_pelunasan', $data,'','id="DL_sumber_pelunasan" class="form-control"');
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Hubungan :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array();
							  foreach($kode_hub_deb as $row) : 
									  $data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
							  endforeach; 
							  echo form_dropdown('DL_kodehub_deb', $data,'','id="DL_kodehub_deb" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Jenis usaha :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-tag"></i>
                        </span>
                        <?php
						$data = array(
							);
							foreach($kode_jenis_usaha as $row) : 
									$data[$row['KODE_JENIS_USAHA']] = $row['DESKRIPSI_JENIS_USAHA'];
							endforeach; 
							echo form_dropdown('DL_jenis_usaha', $data,'','id="DL_jenis_usaha" class="form-control"');
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Periode pembayaran :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						$data = array();
							foreach($kode_periode_bayar as $row) : 
									$data[$row['kode_periode_pembayaran']] = $row['deskripsi_periode_pembayaran'];
							endforeach; 
							echo form_dropdown('DL_kodeperiode_byr', $data,'','id="DL_kodeperiode_byr" class="form-control"');
						?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Lokasi usaha :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-tag"></i>
                        </span>
                         <?php
						$data = array(
						);
						
						foreach($jenis_kota as $row) : 
								$data[$row['Kota_id']] = $row['Deskripsi_Kota'];
						endforeach; 
						echo form_dropdown('DL_jenis_kota', $data,'','id="DL_jenis_kota" class="form-control"');
						
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
    	
    	
        
    </div>
    <!--END <div class="col-md-6"> -->
    
    <div class="col-md-6">
    	<div class="form-group">
        	<center>Sistem Informasi Debitur</center>
            <div class="row">
                <div class="col-md-6">
                    <label>Sifat :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array(
							  );
							  foreach($kode_sid_sifat as $row) : 
									  $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
							  endforeach; 
							  echo form_dropdown('DL_sid_sifat', $data,'','id="DL_sid_sifat" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Jenis penggunaan :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	<?php
						$data = array(
							);
							foreach($kode_sid_jenpeng as $row) : 
									$data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
							endforeach; 
							echo form_dropdown('DL_sid_jenpeng', $data,'','id="DL_sid_jenpeng" class="form-control"');
						?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	 <div class="row">
                <div class="col-md-6">
                    <label>Sektor ekonomi :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array(
							  );
							  foreach($kode_sid_bid_usaha as $row) : 
									  $data[$row['KODE_BIDANG_USAHA']] = $row['DESKRIPSI_BIDANG_USAHA'];
							  endforeach; 
							  echo form_dropdown('DL_sid_bid_usaha', $data,'','id="DL_sid_bid_usaha" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Golongan penjamin :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	 <?php
						  $data = array(
							  );
							  foreach($kode_sid_gol_penj as $row) : 
									  $data[$row['KODE_GOL_PENJAMIN']] = $row['DESKRIPSI_GOL_PENJAMIN'];
							  endforeach; 
							  echo form_dropdown('DL_sid_gol_penj', $data,'','id="DL_sid_gol_penj" class="form-control"');
						  ?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	 <div class="row">
                <div class="col-md-6">
                    <label>Jenis asuransi :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array(
							  );
							  foreach($kode_sid_jenis_asuransi as $row) : 
									  $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
							  endforeach; 
							  echo form_dropdown('DL_sid_jenis_asuransi', $data,'','id="DL_sid_jenis_asuransi" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Golongan kredit :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	 <?php
						  $data = array(
							  );
							  foreach($kode_sid_gol_kre  as $row) : 
									 $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
							  endforeach; 
							  echo form_dropdown('DL_sid_gol_kre', $data,'','id="DL_sid_gol_kre" class="form-control"');
						  ?>
                    </div>                                   
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	 <div class="row">
                <div class="col-md-6">
                    <label>Jenis fasilitas :</label>
                    <div class="input-group">
                    	<span class="input-group-addon">
                         <i class="fa fa-tag"></i>
                         </span>
                         <?php
						  $data = array(
							  );
							  foreach($kode_sid_jenis_fas as $row) : 
									 $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
							  endforeach; 
							  echo form_dropdown('DL_sid_jenis_fas', $data,'','id="DL_sid_jenis_fas" class="form-control"');
						  ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Tujuan penggunaan :</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                    	 <?php echo  form_input(array('name'=>'txtSidTujuanPenggunaan','class'=>'bersih form-control','id'=>'txtSidTujuanPenggunaan'));?>
                    </div>                                   
                </div>
                
            </div>
        </div>
    	
    	
        
    
    	
        
        
    </div>
    <!--END <div class="col-md-6"> -->
</div>