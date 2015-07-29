	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<legend >&nbsp;<?php echo $judul; 
	//echo $ada_memcached; 
	?></legend>
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
		$attributes = array('id' => 'formagunan');
		echo form_open('master_agunan_c/buat_baru', $attributes);
	?>
    <div style="padding:10px;">
    <?php include "master_kredit_view_f5.inc.php"; ?>		
    </div>
	<?php echo form_close(); ?>

	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script type="text/javascript">

		// end angga print
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
			if (r==true){
				/*
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$("#btnSimpan").removeAttr("disabled");
				$('#btnSimpan').show();
				*/
				//check_load();
				location.reload();
			}
			});
		}
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
		  $( "#txtJTAgunan" ).focusout(function() {
			  var tgl = $(this).val();
			  var vbl= "#txtJTAgunan";
			  validatedate(tgl,vbl);
		  });
		function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
		}
		$( "#txtNilaiAgunanBI" ).focusout(function() {
			var agunBI = $(this).val();
			agunBI = CleanNumber(agunBI);
			var persenlikuidasi = parseFloat($('#txtLikuidasiPersen').val());
			var nilailikuidasi = agunBI * persenlikuidasi/100; 
			$( "#txtLikuidasi" ).val(number_format(nilailikuidasi,2));
		});
		$( "#DL_agunan_ikhukum" ).change(function() {
			var kd=$(this).val();
			kd=kd.trim();
			if (kd!=''){
				 //  alert(kd);
				$.post("<?php echo site_url('/master_agunan_c/persen_likuidasi'); ?>",
						{
							'kd_ikhukum' : kd
						},
						function(data){
							if(data.baris==1){
								$('#txtLikuidasiPersen').val(data.BOBOT_IKATAN_HUKUM);
								var agunBI = $('#txtNilaiAgunanBI').val();
								agunBI = CleanNumber(agunBI);
								
								if(agunBI>0){
									var persenlikuidasi = parseFloat($('#txtLikuidasiPersen').val());
									var nilailikuidasi = agunBI * persenlikuidasi/100; 
									$( "#txtLikuidasi" ).val(number_format(nilailikuidasi,2));
								}
							}else{
								 $.messager.alert('Perhatian','Data tidak ditemukan!');
							}
						},"json");
			   }//if kd<>''
	
		});// END $( "#DL_agunan_ikhukum" ).focusout(function() {
		$( "#txtNoRekKre" ).focusout(function() {
			this.value = this.value.toUpperCase();
			var kd=$(this).val();
			kd=kd.trim();
			if (kd!=''){
				 //  alert(kd);
				$.post("<?php echo site_url('/master_agunan_c/deskripsi_kre'); ?>",
						{
							'norek' : kd
						},
						function(data){
							if(data.baris==1){
								$('#txtNamaKre').val(data.NAMA_NASABAH);
							}else{
								 $.messager.alert('Perhatian','Data tidak ditemukan!');
							}
						},"json");
			   }//if kd<>''
	
		});// END $( "#txtNoRekKre" ).focusout(function() {
		$('#DL_agunan_jenis').change(function(){
			var jns_agunan=$('#DL_agunan_jenis option:selected').val();
			if(jns_agunan==2){
				var htm =" NO.TABUNGAN/DEPOSITO : \n NOMINAL : \n ATAS NAMA :";
				$('#txtRincianAgunan').val(htm);
			}else if(jns_agunan==5){
				var htm =" RODA : \n MERK : \n JENIS : \n No. RANGKA : \n No. MESIN :\n WARNA : \n No. POLISI : \n ATAS NAMA : \n No. BPKB :";
				$('#txtRincianAgunan').val(htm);
			}else if(jns_agunan==6){
				var htm =" NO. SERTIFIKAT : \n TGL UKUR : \n NO. SURAT : \n LUAS : \n DESA :\n KECAMATAN : \n KABUPATEN : \n PROPINSI : \n ATAS NAMA :";
				$('#txtRincianAgunan').val(htm);
			}
			//alert(jns_agunan);	
		});
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		$(document).ready(function(){
			$("#txtLikuidasi").val('0.00');
			$('#txtNoRekKre').focus();
			$('#txtLikuidasiPersen').val(100);
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekKre').focusout(function(){
				this.value = this.value.toUpperCase();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			$('.nomor1').val('0');
			$(".nomor").focus(function(){
				$(this).val('');
			});
			$(".nomor1").focus(function(){
				$(this).val('');
			});
			$(".nomor").focusout(function(){
				if ($(this).val() == '') { 
					$(this).val('0.00');
				}else{
					var angka =$(this).val();
					$(this).val(number_format(angka,2));
				}
			});
			$(".nomor1").focusout(function(){
				if ($(this).val() == '') { 
					$(this).val('0');
				}else{
					var angka =$(this).val();
					$(this).val(angka);
				}
			});	
		});//end ready document
		function ajax_submit_agunan(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_agunan_c/simpan_agunan",
				data:dataString,
		
				success:function (data) {					
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Data agunan telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){
			$('#formagunan').submit(function (event) {
				  dataString = $("#formagunan").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_agunan();
				  }else{//if(r)
					return false;
				  }
			}); //end  $contact form	
		});
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