	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<legend >&nbsp;Master Nasabah</legend>
	<?php
		if($this->session->flashdata('success') != ''){
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-success">
			<button type="button" class="close" data-dismiss="alert">x</button>'.$this->session->flashdata('success').'
			</div>
			</div>';
		} 
		if($this->session->flashdata('error') != ''){
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">x</button>'.$this->session->flashdata('error').'
			</div>
			</div>';
		} 
	?>
    
    <?php
	
	foreach($counter_nasabah_id_length->result() as $row){
			     $counter_nasabah_id_length= $row->Value;
				 } 
		
		
		$attributes = array('id' => 'formnasabah');
		echo form_open('master_nasabah_c/buat_baru', $attributes);
		?>
    <div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <!--Fluid 12 -->
        <div class="row-fluid"><!-- row fluid kecil -->
          <div class="span6" style="padding:10px;"><!-- span 6 1-->
          <div class="row-fluid" id="divNasabahId">	
          <div class="span6 input-prepend">
                        <span class="add-on"><i class="icon icon-bookmark"></i></span>
							<?php 
							echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih span6','id'=>'txtNasabahId','readonly'=>'readonly'));
							?>
						</div>  
						<div class="span2">
							
						</div>
			</div>
            
          	<div class="row-fluid" >	
						<div class="span6 input-prepend">
                        <span class="add-on"><i class="icon icon-user"></i></span>
							<?php 
							echo  form_input(array('name'=>'txtNamaNasabah','class'=>'bersih span11','id'=>'txtNamaNasabah','required'=>'required','placeholder'=>'Nama nasabah'));
							echo  form_input(array('type'=>'hidden','name'=>'txtCounterNasabahIdLength','class'=>'','id'=>'txtCounterNasabahIdLength','required'=>'required','value'=>$counter_nasabah_id_length));
							?>
						</div>
                        <div class="span6 input-prepend">
                        <span class="add-on"><i class="icon icon-user"></i></span>
							<?php echo  form_input(array('name'=>'txtNamaAlias','class'=>'bersih span11','id'=>'txtNamaAlias','required'=>'required','placeholder'=>'Nama Alias'));?>
						</div>
			</div>
            <div class="row-fluid" >
						<!--<div class="span2 teks-kanan" >Nama Alias</div>-->
						<div class="span8 input-prepend">
                        <span class="add-on"><i class="icon-home"></i></span>
							 <?php
							$data = array(
								'name'        => 'txtAlamatDom',
								'id'          => 'txtAlamatDom',
								'onkeyup'     => 'ToUpper(this)',
								'rows'        => '2',
								//'style'       => 'width:430px',
								'class'		  =>'span12',
								'maxlength'	  =>'100',
								'placeholder' => 'Alamat Domisili'
							  );
							echo form_textarea($data);
							?>
						</div>
			</div>
            
            <div class="row-fluid" >
						<div class="span5 input-prepend">
                        <span class="add-on"><i class="icon icon-home"></i></span>
							<?php echo  form_input(array('name'=>'txtTempatLahir','class'=>'bersih span11','id'=>'txtTempatLahir','required'=>'required','placeholder'=>'Tempat Lahir'));?>
						</div>
                        <div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
							<?php echo  form_input(array('name'=>'txtTanggalLahir','class'=>'bersih span11','id'=>'txtTanggalLahir','required'=>'required','placeholder'=>'Tanggal Lahir (dd-mm-yyyy)'));?>
						</div>
			</div>
            <div class="row-fluid" >
            			<!--<div class="span2 teks-kanan" >Jenis Kelamin</div>-->
						<div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-user-md"></i></span>
                        <?php
						$data = array(
							$data['']='Jenis Kelamin',
							$data['L']='L',
							$data['P']='P',
							);
							
							echo form_dropdown('DL_jenis_kelamin', $data,'id="DL_jenis_kelamin"','style="width:205px"');
						?>
						</div>
                        <div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-certificate"></i></span>
                        <?php
						$data = array(
							$data['']='Agama'
							);
							foreach($kode_group1 as $row) : 
									$data[$row['NASABAH_GROUP1']] = $row['DESKRIPSI_GROUP1'];
							endforeach; 
							echo form_dropdown('DL_kode_group1', $data,'id="DL_kode_group1"','style="width:205px"');
						?>
						</div>
			</div>
            <div class="row-fluid">
						<!--<div class="span2 teks-kanan">Status / Gelar</div>-->
						<div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-star"></i></span>
							<?php
							$data = array(
							$data['']='Status / Gelar'
							);
							foreach($jenis_gelar as $row) : 
									$data[$row['Gelar_ID']] = $row['Deskripsi_Gelar'];
							endforeach; 
							echo form_dropdown('DL_jenis_gelar', $data,'id="DL_jenis_gelar"','style="width:205px"');
							
							?>
                           
						</div>
                        <div class="span5">
							<?php echo  form_input(array('name'=>'txtDesGelar','class'=>'bersih','id'=>'txtDesGelar','placeholder'=>'Keterangan Gelar'));?>
						</div>
           </div>
           
            <div class="row-fluid">
						<div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-credit-card"></i></span>
							<?php
							$data = array(
							$data['']='Jenis ID'
							);
							
							foreach($jenis_id as $row) : 
									$data[$row['jenis_id']] = $row['nama_identitas'];
							endforeach; 
							echo form_dropdown('DL_jenis_Id', $data,'id="DL_jenis_Id"','style="width:205px"');
							?>
						</div>
                        <div class="span5">
							<?php echo  form_input(array('name'=>'txtNoId','class'=>'bersih','id'=>'txtNoId','required'=>'required','placeholder'=>'Nomor Identitas'));?>
						</div>
           </div>
           <div class="row-fluid" >
           		<div class="span5 input-prepend">
                <span class="add-on"><i class="icon-calendar"></i></span>
					<?php echo  form_input(array('name'=>'txtIdMasaBerlaku','class'=>'bersih','id'=>'txtIdMasaBerlaku','required'=>'required','placeholder'=>'Masa berlaku ID (dd-mm-yyyy)'));?>
				</div>	
			</div>
            
            <div class="row-fluid" >	
						<div class="span6 input-prepend">
                        <span class="add-on"><i class="icon-phone"></i></span>
							<?php echo  form_input(array('name'=>'txtKodeArea','class'=>'nomor bersih span4','id'=>'txtKodeArea','placeholder'=>'Kode Area'));?>
                            <?php echo  form_input(array('name'=>'txtNoTelp','class'=>'nomor bersih span7','id'=>'txtNoTelp','placeholder'=>'No. Telp'));?>
						</div>
                        <div class="span6 input-prepend">
                        <span class="add-on"><i class="icon-mobile-phone"></i></span>
							<?php echo  form_input(array('name'=>'txtNoHp','class'=>'nomor bersih span11','id'=>'txtNoHp','placeholder'=>'No. Handphone'));?>
						</div>
			</div>
			<div class="row-fluid" >
           		<div class="span9 input-prepend">
                        <span class="add-on"><i class="icon-home"></i></span>
					 <?php 
					// echo  form_input(array('name'=>'txtAlamatKtp','class'=>'bersih span11','id'=>'txtAlamatKtp','required'=>'required','placeholder'=>'Alamat KTP'));
					 $data = array(
								'name'        => 'txtAlamatKtp',
								'id'          => 'txtAlamatKtp',
								'onkeyup'     => 'ToUpper(this)',
								'rows'        => '2',
								//'style'       => 'width:430px',
								'class'		  =>'span11',
								'maxlength'	  =>'100',
								'placeholder' => 'Alamat KTP'
							  );
							echo form_textarea($data);
					 ?>
				</div>
                <div class="span3">
                    <?php echo  form_input(array('name'=>'txtKodePos','class'=>'nomor bersih span7','id'=>'txtKodePos','required'=>'required','placeholder'=>'Kode Pos','maxlength'=>'5'));?>
                </div>
			</div>
			<div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php echo  form_input(array('name'=>'txtKelurahan','class'=>'bersih span11','id'=>'txtNamaAlias','required'=>'required','placeholder'=>'Kelurahan'));?>
				</div>	
                <div class="span6 input-prepend">
                	<span class="add-on"><i class="icon-building"></i></span>
                    <?php echo  form_input(array('name'=>'txtKecamatan','class'=>'bersih span11','id'=>'txtKecamatan','required'=>'required','placeholder'=>'Kecamatan'));?>
                </div>
			</div>
            
          </div><!-- end span 6 1-->
<!------------------- KOLOM KANAN ------------------->          
          <div class="span6" style="padding:10px;"><!-- --><!-- span 6 2-->
          <!-- kolom kanan -->
          	<div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php
							$data = array(
							$data['0']='Kota'
							);
							
							foreach($jenis_kota as $row) : 
									$data[$row['Kota_id']] = $row['Deskripsi_Kota'];
							endforeach; 
							echo form_dropdown('DL_jenis_kota', $data,$data['0'],'id="DL_jenis_kota"');
							
							?>
                <?php echo  form_input(array('type'=>'hidden','name'=>'txtKota','class'=>'bersih span11','id'=>'txtKota','required'=>'required','placeholder'=>'kota'));?>            
				</div>	
                
                <div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
                    	<?php
							$data = array(
							$data['']='Domisili Negara'
							);
							
							foreach($jenis_negara as $row) : 
									$data[$row['KODE_NEGARA']] = $row['DESKRIPSI_NEGARA'];
							endforeach; 
							echo form_dropdown('DL_jenis_negara', $data,'id="DL_jenis_negara"');
							?>
                </div>
			</div>
			
			<div class="row-fluid">
						<!--<div class="span2 teks-kanan">Status / Gelar</div>-->
						<div class="span6 input-prepend">
                        <span class="add-on"><i class="icon-male"></i></span>
							<?php
							$data = array(
							$data['']='Pekerjaan'
							);
							foreach($jenis_kerja as $row) : 
									$data[$row['Pekerjaan_id']] = $row['Desktripsi_Pekerjaan'];
							endforeach; 
							echo form_dropdown('DL_jenis_kerja', $data,'id="DL_jenis_kerja"');
							
							?>
                           
						</div>
                        <div class="span6">
							<?php echo  form_input(array('name'=>'txtKetKerja','class'=>'bersih','id'=>'txtKetKerja','required'=>'required','placeholder'=>'Keterangan Pekerjaan'));?>
						</div>
           </div>
           <div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php echo  form_input(array('name'=>'txtNamaPerush','class'=>'bersih span11','id'=>'txtNamaPerush','required'=>'required','placeholder'=>'Nama Perusahaan'));?>
				</div>	
               
			</div>
           <div class="row-fluid" >
                <div class="span6 input-prepend">
                <span class="add-on"><i class="icon-credit-card"></i></span>
					<?php echo  form_input(array('name'=>'txtNip','class'=>'bersih span11','id'=>'txtNip','required'=>'required','placeholder'=>'NIP'));?>
				</div>	
                <div class="span6 input-prepend">
                <span class="add-on"><i class="icon-credit-card"></i></span>
                    <?php echo  form_input(array('name'=>'txtNpwp','class'=>'bersih span11','id'=>'txtNpwp','required'=>'required','placeholder'=>'NPWP'));?>
                </div>
			</div>
           
            <div class="row-fluid">
						<!--<div class="span2 teks-kanan">Status / Gelar</div>-->
						<div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-table"></i></span>
							<?php
							$data = array(
							$data['']='Bidang Usaha SID'
							);
							foreach($sid_bidang_usaha as $row) : 
									$data[$row['KODE_BIDANG_USAHA']] = $row['DESKRIPSI_BIDANG_USAHA'];
							endforeach; 
							echo form_dropdown('DL_sid_bidang_usaha', $data,'id="DL_sid_bidang_usaha"','style="width:205px"');
							
							?>
                           
						</div>
                        <div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-table"></i></span>
							<?php
							$data = array(
							$data['']='Golongan Debitur SID'
							);
							foreach($sid_gol_debitur as $row) : 
									$data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
							endforeach; 
							echo form_dropdown('DL_sid_gol_debitur', $data,'id="DL_sid_gol_debitur"','style="width:205px"');
							
							?>
                           
						</div>
           </div>
           
           <div class="row-fluid">
						<div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-table"></i></span>
							<?php
							$data = array(
							$data['']='Hub dengan Bank SID'
							);
							foreach($sid_hub_bank as $row) : 
									$data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
							endforeach; 
							echo form_dropdown('DL_sid_hubungan', $data,'id="DL_sid_hubungan"','style="width:205px"');
							
							?>
                           
						</div>
                        <div class="span5 input-prepend">
                        <span class="add-on"><i class="icon-list-alt"></i></span>
							<?php
							$data = array(
							$data['']='AO'
							);
							foreach($kode_group4 as $row) : 
									$data[$row['NASABAH_GROUP4']] = $row['DESKRIPSI_GROUP4'];
							endforeach; 
							echo form_dropdown('DL_kode_group4', $data,'id="DL_kode_group4"','style="width:205px"');
							
							?>
                           
						</div>
           </div>
           <div class="row-fluid">
						
           </div>
           <div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php echo  form_input(array('name'=>'txtTujuanPembRek','class'=>'bersih span11','id'=>'txtTujuanPembRek','placeholder'=>'Tujuan Pembukaan Rekening'));?>
				</div>	
               
			</div>
            <div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php echo  form_input(array('name'=>'txtSumberDana','class'=>'bersih span11','id'=>'txtSumberDana','placeholder'=>'Sumber Dana'));?>
				</div>	
               
			</div>
            <div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php echo  form_input(array('name'=>'txtPenggunaanDana','class'=>'bersih span11','id'=>'txtPenggunaanDana','placeholder'=>'Penggunaan Dana'));?>
				</div>	
               
			</div>
            <div class="row-fluid" >
           		<div class="span6 input-prepend">
                 <span class="add-on"><i class="icon-building"></i></span>
					<?php echo  form_input(array('name'=>'txtNamaWaris','class'=>'bersih span11','id'=>'txtNamaWaris','placeholder'=>'Nama Ahli Waris'));?>
				</div>	
               
			</div>
            <!-- Button -->
            <div class="row-fluid" >
					<div class="controls">
						<button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan">
							<i class="icon-save"></i><span class="ladda-label"> Simpan</span>
						</button>
                        <a class="btn btn-primary"  id="btnUbah" name="btnUbah"><i class="icon-print"></i><span class="ladda-label"> Ubah</span></a>
						<a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>
						<a class="btn btn-warning" onclick="return confirm('Anda yakin?');" 
						href="<?php echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>
					</div>
           </div>     <!-- end Button -->
<!------------------- END KOLOM KANAN ------------------->
          </div><!-- end span 6 2-->
        </div><!-- end row fluid kecil -->
      </div><!-- end span 12 -->
    </div><!-- end row fluid 12 besar -->

		
		<?php echo form_close(); ?>
	</div>
	
	<!-- modal rekening tabungan -->
	
	
		<!-- modal rekening kredit -->
	

	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	
	<script type="text/javascript">
		
		
		// end angga print
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
			if (r==true){
				/*
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('#txtRekKre').focus();
				//$('input[name=chkPelunasan]').attr('checked', false);
				$('#txtCicilan').val('0');
				$('#terbilang').text("nol");
				//$("#btnSimpan").removeAttr("disabled");
				$('#btnSimpan').show();
				//check_load();
				*/
				location.reload();
			}
			});
		}
		
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		$(document).ready(function(){
			$("#btnUbah").attr("disabled", "disabled");
			
			function validatedate(inputText,vbl) {  
				var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;  
				// Match the date format through regular expression  
				if(inputText.match(dateformat)){  
				   // document.form1.text1.focus();  
					//Test which seperator is used '/' or '-'  
					var opera1 = inputText.split('/');  
					var opera2 = inputText.split('-');  
					lopera1 = opera1.length;  
					lopera2 = opera2.length;  
					// Extract the string into month, date and year  
					if (lopera1>1) {  
						//var pdate = inputText.split('/');  
						alert('Format tanggal salah!');  
						$( vbl ).focus();
						return false;
					}else if (lopera2>1){  
						var pdate = inputText.split('-');  
						var dd = parseInt(pdate[0]);  
						var mm  = parseInt(pdate[1]);  
						var yy = parseInt(pdate[2]);  
						// Create list of days of a month [assume there is no leap year by default]  
						var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
						if (mm==1 || mm>2){  
						  if (dd>ListofDays[mm-1]){  
							  alert('Format tanggal salah!');  
							  $( vbl ).focus();
							  return false;  
						  }  
						}  
						if (mm==2){  
							var lyear = false;  
							if ( (!(yy % 4) && yy % 100) || !(yy % 400)){  
								lyear = true;  
							}  
							if ((lyear==false) && (dd>=29)){  
								alert('Format tanggal salah!'); 
								$( vbl ).focus();
								return false;  
							}  
							if ((lyear==true) && (dd>29)){  
								alert('Format tanggal salah!');  
								$( vbl ).focus();
								return false;  
							}  
					   }//if (mm==2){  
					}  
					
				}else{  
					alert("Format tanggal salah!");  
					$( vbl ).focus();
					return false;  
				}  
		  }  //function validatedate(inputText)
			
			$('#divNasabahId').hide();
			$( "#txtTanggalLahir" ).focusout(function() {
				var tgl = $(this).val();
				var vbl= "#txtTanggalLahir";
				validatedate(tgl,vbl);
			});
			$( "#txtIdMasaBerlaku" ).focusout(function() {
				var tgl = $(this).val();
				var vbl= "#txtIdMasaBerlaku";
				validatedate(tgl,vbl);
			});
			$('#txtNamaNasabah').focus();
			$('#DL_jenis_kota').change(function(){
				var txtJenisKota=$("#DL_jenis_kota option:selected").text();
				
				//alert("c");
				$('#txtKota').val(txtJenisKota);
		
			});
			$( "#txtAlamatDom" ).focusout(function() {
				var alamat = $(this).val();
				$("#txtAlamatKtp").val(alamat);
			});
			$(".nomor").keypress(function (e){
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
					//$("#errmsg").html("Digits Only").show().fadeOut("slow");
					return false;
				}
			});
		});//end ready document
		function show_nasabah_id(){
			var nm=$('#txtNamaNasabah').val();
			nm=nm.trim();
			var tgl_lahir=$('#txtTanggalLahir').val();
			tgl_lahir=tgl_lahir.trim();
			var no_id=$('#txtNoId').val();
			no_id=no_id.trim();
			$.post("<?php echo site_url('/master_nasabah_c/nasabah_id_masuk'); ?>",
				{
					'nama' 		: nm,
					'tgl_lahir'	: tgl_lahir,
					'no_id'		: no_id
				},
				function(data){
					if(data.baris==1){
						$('#txtNasabahId').val(data.nasabah_id);
						$('#divNasabahId').show();
					}
					/*
					else{
						$.messager.alert('Perhatian','Data debitur kredit tidak ditemukan!');
					}
					*/
				},"json");
		}
		function ajax_submit_nasabah(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_nasabah_c/simpan_nasabah",
				data:dataString,
		
				success:function (data) {
					//$('#txtNasabahId').val(data.masuk);
					//$('#divNasabahId').show();
					
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Data Nasabah telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
					show_nasabah_id();
					
				}
		
			});
			event.preventDefault();
		}
		
		$(function() {
				$('#formnasabah').submit(function (event) {
					  dataString = $("#formnasabah").serialize();
					  var r = confirm('Anda yakin menyimpan data ini?');
					  if (r== true){
						ajax_submit_nasabah();
					  }else{//if(r)
						return false;
					  }
				 }); //end  $contact form
		});/// end $func
		
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],
			{
				"contains-ci": function(elem, i, match, array)
				{
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>
</div>	