<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"><!-- row fluid kecil -->
      <div class="span6"><!-- span 6 1-->
      <h4>Laporan Bulanan</h4>
      	<div class="row-fluid">
        	<div class="span6">
            <label>Sifat</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sifat_kre as $row) : 
                          $data[$row['KODESIFAT_2013']] = $row['DESKRIPSI_SIFAT_2013'];
                  endforeach; 
                  echo form_dropdown('DL_sifat_kre', $data,'id="DL_sifat_kre"');
              ?>                
            </div>
            <div class="span6">
            <label>Jenis Penggunaan</label>
            <?php
              $data = array(
                  );
                  foreach($kode_jenpeng_kre as $row) : 
                          $data[$row['KODE_JENIS_PENGGUNAAN_2013']] = $row['DESKRIPSI_JENIS_PENGGUNAAN_2013'];
                  endforeach; 
                  echo form_dropdown('DL_jenpeng_kre', $data,'id="DL_jenpeng_kre"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Golongan Debitur</label>
            <?php
              $data = array(
                  );
                  foreach($kode_gol_deb as $row) : 
                          $data[$row['KODE_GOL_DEBITUR_2013']] = $row['DESKRIPSI_GOL_DEBITUR_2013'];
                  endforeach; 
                  echo form_dropdown('DL_gol_deb_kre', $data,'id="DL_gol_deb_kre"');
              ?>                
            </div>
            <div class="span6">
            <label>Sektor Ekonomi</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sekom_kre as $row) : 
                          $data[$row['KODE_SEKTOR_EKONOMI']] = $row['DESKRIPSI_SEKTOR_EKONOMI'];
                  endforeach; 
                  echo form_dropdown('DL_sekom_kre', $data,'id="DL_sekom_kre"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Golongan Penjamin</label>
            <?php
              $data = array(
                  );
                  foreach($kode_penjamin as $row) : 
                          $data[$row['KODE_GOL_PENJAMIN']] = $row['DESKRIPSI_GOL_PENJAMIN'];
                  endforeach; 
                  echo form_dropdown('DL_penjamin_kre', $data,'id="DL_penjamin_kre"');
              ?>                
            </div>
            <div class="span6">
            <label>Jenis Asuransi</label>
            <?php
              $data = array(
                  );
                  foreach($kode_asuransi as $row) : 
                          $data[$row['KODE_ASURANSI']] = $row['DESKRIPSI_ASURANSI'];
                  endforeach; 
                  echo form_dropdown('DL_asuransi_kre', $data,'id="DL_asuransi_kre"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span4"><label>Jumlah Asuransi</label></div>
        	<div class="span8">
            <?php echo  form_input(array('name'=>'txtJmlAsuransi','class'=>'nomor span4','id'=>'txtJmlAsuransi'));?>                
            &nbsp;Dijaminkan&nbsp;
            <?php echo  form_input(array('name'=>'txtJmlAsuransiPersen','class'=>'nomor span4','id'=>'txtJmlAsuransiPersen'));?>
            &nbsp; % &nbsp;
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Kode Metoda</label>
			<?php
            $data = array();
                foreach($kode_metoda as $row) : 
                        $data[$row['KODE_METODA']] = $row['DESKRIPSI_METODA'];
                endforeach; 
                echo form_dropdown('DL_kodemetoda', $data,'id="DL_kodemetoda"');
            ?>                
            </div>
            <div class="span6">
            <label>Sumber Pelunasan</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sumber_pelunasan as $row) : 
                          $data[$row['KODE_SUMBER_PELUNASAN']] = $row['DESKRIPSI_SUMBER_PELUNASAN'];
                  endforeach; 
                  echo form_dropdown('DL_sumber_pelunasan', $data,'id="DL_sumber_pelunasan"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Hubungan</label>
			<?php
            $data = array();
                foreach($kode_hub_deb as $row) : 
                        $data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
                endforeach; 
                echo form_dropdown('DL_kodehub_deb', $data,'id="DL_kodehub_deb"');
            ?>                
            </div>
            <div class="span6">
            <label>Jenis Usaha</label>
            <?php
              $data = array(
                  );
                  foreach($kode_jenis_usaha as $row) : 
                          $data[$row['KODE_JENIS_USAHA']] = $row['DESKRIPSI_JENIS_USAHA'];
                  endforeach; 
                  echo form_dropdown('DL_jenis_usaha', $data,'id="DL_jenis_usaha"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Periode Pembayaran</label>
			<?php
            $data = array();
                foreach($kode_periode_bayar as $row) : 
                        $data[$row['kode_periode_pembayaran']] = $row['deskripsi_periode_pembayaran'];
                endforeach; 
                echo form_dropdown('DL_kodeperiode_byr', $data,'id="DL_kodeperiode_byr"');
            ?>                
            </div>
            <div class="span6">
            <label>Lokasi Usaha</label>
            <?php
				$data = array(
				);
				
				foreach($jenis_kota as $row) : 
						$data[$row['Kota_id']] = $row['Deskripsi_Kota'];
				endforeach; 
				echo form_dropdown('DL_jenis_kota', $data,'id="DL_jenis_kota"');
				
				?>
            </div>
        </div>       
      </div><!-- end span 6 1-->
      <div class="span6"><!-- span 6 2-->
      <h4>Sistem Informasi Debitur</h4>
      	<div class="row-fluid">
        	<div class="span6">
            <label>Sifat</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_sifat as $row) : 
                          $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_sifat', $data,'id="DL_sid_sifat"');
              ?>                
            </div>
            <div class="span6">
            <label>Jenis Penggunaan</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_jenpeng as $row) : 
                          $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_jenpeng', $data,'id="DL_sid_jenpeng"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Sektor Ekonomi</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_bid_usaha as $row) : 
                          $data[$row['KODE_BIDANG_USAHA']] = $row['DESKRIPSI_BIDANG_USAHA'];
                  endforeach; 
                  echo form_dropdown('DL_sid_bid_usaha', $data,'id="DL_sid_bid_usaha"');
              ?>                
            </div>
            <div class="span6">
            <label>Golongan Penjamin</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_gol_penj as $row) : 
                          $data[$row['KODE_GOL_PENJAMIN']] = $row['DESKRIPSI_GOL_PENJAMIN'];
                  endforeach; 
                  echo form_dropdown('DL_sid_gol_penj', $data,'id="DL_sid_gol_penj"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Jenis Asuransi</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_jenis_asuransi as $row) : 
                          $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_jenis_asuransi', $data,'id="DL_sid_jenis_asuransi"');
              ?>                
            </div>
            <div class="span6">
            <label>Golongan Kredit</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_gol_kre  as $row) : 
                         $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_gol_kre', $data,'id="DL_sid_gol_kre"');
              ?>                
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span6">
            <label>Jenis Fasilitas</label>
            <?php
              $data = array(
                  );
                  foreach($kode_sid_jenis_fas as $row) : 
                         $data[$row['KODE_DESC']] = $row['DESKRIPSI_DESC'];
                  endforeach; 
                  echo form_dropdown('DL_sid_jenis_fas', $data,'id="DL_sid_jenis_fas"');
              ?>                
            </div>
        	<div class="span6">
            <label>Tujuan Penggunaan</label>
            <?php echo  form_input(array('name'=>'txtSidTujuanPenggunaan','class'=>'bersih','id'=>'txtSidTujuanPenggunaan'));?>                
            </div>
            <div class="span6">
                        
            </div>
        </div>
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->