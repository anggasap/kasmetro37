	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
foreach($counter->result() as $row){
			$count= $row->CounterNo;
			$f=($count+1)."-".$this->session->userdata('user_id');
		}
?>

<div id="main-content">
	<legend >&nbsp;<?php echo $judul; ?></legend>
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
		$attributes = array('id' => 'formreal_kredit');
		echo form_open('real_kredit_c/realisasi', $attributes);
		?>
<div class="row-fluid"><!-- row fluid 12 besar -->
  <div class="span12"><!-- span 12 -->
    <div class="row-fluid"  style="padding:20px;"><!-- row fluid kecil -->
      <div class="span6"><!-- span 6 1-->       
      	<div class="row-fluid" >
              <div class="span4">
              <label>No Rekening</label>
              <?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','class'=>'hidden bersih','id'=>'txtcounter','required'=>'required'));?>
              <?php echo  form_input(array('name'=>'txtNoRekKre','class'=>'bersih span11','id'=>'txtNoRekKre','required'=>'required'));?>
              <?php echo  form_input(array('name'=>'txtStatusAktif','type'=>'hidden','class'=>'bersih','id'=>'txtStatusAktif','required'=>'required'));?>
              <?php echo  form_input(array('name'=>'txtTypeABP','type'=>'hidden','class'=>'bersih','id'=>'txtTypeABP','required'=>'required'));?>
                    
              </div>
              <div class="span8">
              <label>Nama Nasabah</label>&nbsp;
                    <?php echo  form_input(array('name'=>'txtNamaKre','class'=>'bersih span10','id'=>'txtNamaKre','placeholder'=>'Nama nasabah','readonly'=>'true','required'=>'required'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Jumlah Kredit</label>
                    <?php echo  form_input(array('name'=>'txtJmlKre','class'=>'nomor','id'=>'txtJmlKre','required'=>'required','readonly'=>'true'));?>
              </div>
              <div class="span6">
              <label>Jumlah Bunga</label>
                    <?php echo  form_input(array('name'=>'txtJmlBunga','class'=>'nomor','id'=>'txtJmlBunga','required'=>'required','readonly'=>'true'));?>
              </div>
        </div>
        <div class="row-fluid" >
        	<div class="span3">
              <label>Tanggal Realisasi</label>
                    <?php echo  form_input(array('name'=>'txtTglReal','class'=>'span9','id'=>'txtTglReal','required'=>'required','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
              </div>
              <div class="span3">
              <label>Bunga</label>
                    <?php echo  form_input(array('name'=>'txtBungaPersen','class'=>'nomor span6','id'=>'txtBungaPersen','required'=>'required','readonly'=>'readonly'));?>&nbsp; %
              </div>
              <div class="span3">
              <label>Jangka Waktu</label>
                    <?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'nomor span4','id'=>'txtJangkaWaktu','required'=>'required','readonly'=>'readonly'));?>&nbsp; Bulan
              </div>
              <div class="span3">
              <label>Jatuh Tempo</label>
                    <?php echo  form_input(array('name'=>'txtJT','class'=>'span9','id'=>'txtJT','required'=>'required','readonly'=>'readonly','placeholder'=>'dd-mm-yyyy'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Jenis</label>
                    <?php echo  form_input(array('name'=>'txtJenisKre','class'=>'bersih','id'=>'txtJenisKre','readonly'=>'readonly'));?>
              </div>
              <div class="span6">
              <label>Type</label>
                    <?php echo  form_input(array('name'=>'txtTypeKre','class'=>'bersih','id'=>'txtTypeKre','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span4">
              <label>Tgl Trans</label>
                    <?php echo  form_input(array('name'=>'txtTglTrans','class'=>'span8','id'=>'txtTglTrans','required'=>'required','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
              </div>
              <div class="span4">
              <label>Kode Trans</label>
			  <?php
              foreach($kodetrans_kre_def->result() as $row){
                   $kd_kre_def= $row->kode_trans;
                   $des_kre_def= $row->DESKRIPSI_TRANS;
                   $gl_kre_def= $row->GL_TRANS;
                   $tob_kre_def=$row->TOB;
              }
                $data = array();
                //foreach($kodetrans_kre_def as $row) : 
                    $data[$kd_kre_def] = $des_kre_def;
               // endforeach;
                echo form_dropdown('DL_kodetrans_kre',$data,$kd_kre_def,'id="DL_kodetrans_kre" style="width:150px;"');
                ?>
              </div>
              <div class="span4">
              <label>Kuitansi</label>
                    <?php echo  form_input(array('name'=>'txtKuitansi','class'=>'bersih span8','id'=>'txtKuitansi','required'=>'required','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid">
        	
        </div>
        
      </div><!-- end span 6 1-->
      <div class="span6"><!-- span 6 2-->
      	<div class="row-fluid" >
              <div class="span6">
              <label>Provisi</label>
                    <?php echo  form_input(array('name'=>'txtProvisi','class'=>'nomor','id'=>'txtProvisi','readonly'=>'readonly'));?>
              </div>
              <div class="span6">
              <label>Notariel</label>
                    <?php echo  form_input(array('name'=>'txtNotariel','class'=>'nomor','id'=>'txtNotariel','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Premi</label>
                    <?php echo  form_input(array('name'=>'txtPremi','class'=>'nomor','id'=>'txtPremi','readonly'=>'readonly'));?>
              </div>
              <div class="span6">
              <label>Administrasi</label>
                    <?php echo  form_input(array('name'=>'txtAdm','class'=>'nomor','id'=>'txtAdm','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Materai</label>
                    <?php echo  form_input(array('name'=>'txtMaterai','class'=>'nomor','id'=>'txtMaterai','readonly'=>'readonly'));?>
              </div>
              <div class="span6">
              <label>Lain-lain</label>
                    <?php echo  form_input(array('name'=>'txtLain','class'=>'nomor','id'=>'txtLain','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid" >
              <div class="span6">
              <label>Pokok Materai</label>
                    <?php echo  form_input(array('name'=>'txtPkkMaterai','class'=>'nomor','id'=>'txtPkkMaterai','readonly'=>'readonly'));?>
              </div>
              <div class="span6">
              <label>Biaya Transaksi</label>
                    <?php echo  form_input(array('name'=>'txtByTrans','class'=>'nomor','id'=>'txtByTrans','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid" >
        &nbsp;
        </div>
        <div class="row-fluid" >
              <div class="span3 teks-kanan">
              <label>Total Diterima</label>
              </div>
              <div class="span6">
                    <?php echo  form_input(array('name'=>'txtTotalDiterima','class'=>'nomor','id'=>'txtTotalDiterima','readonly'=>'readonly'));?>
              </div>
        </div>
        <div class="row-fluid" >
          <div class="span12">
                  <label id="terbilang" style="color: red"></label>
          </div>
        </div>
        	
        <div class="row-fluid" style=" float:right;">
                <button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
                <i class="icon-save"></i><span class="ladda-label"> Realisasi</span></button>
                <a class="btn btn-primary" onclick="cetak_validasi();" id="btnCetak" name="btnCetak"><i class="icon-print"></i><span class="ladda-label"> Validasi</span></a>
                <a class="btn btn-warning" onclick="cetak_kuitansi();" id="btnCetak_kuitansi" name="btnCetak_kuitansi"><i class="icon-print"></i>Kuitansi</a>
                <a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>		
		</div>
      </div><!-- end span 6 2-->
    </div><!-- end row fluid kecil -->
  </div><!-- end span 12 -->
</div><!-- end row fluid 12 besar -->
		
		<?php echo form_close(); ?>
	</div>
	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
    <script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
	<script type="text/javascript">
		function pad2(number) {
     		return (number < 10 ? '0' : '') + number
		}
		function cetak_validasi(){

		  var newWindow = window.open('Validasi', '_blank');
		  var d = new Date();
		  var jam =pad2(d.getHours()); // => 9
		  var mnt =pad2(d.getMinutes()); // =>  30
		  var dtk =pad2(d.getSeconds()); // => 51
		 var no_rek = $('#txtNoRekKre').val();
		 var tgl_trans = $('#txtTglTrans').val();
		 var user = $('#id_session_user').val();
		 var kuitansi= $("#txtKuitansi").val();
		 var des_trans = $("#DL_kodetrans_kre").text();
		 var jml_kredit = $('#txtJmlKre').val();
		 var provisi = $('#txtProvisi').val();
		 var notariel =	$('#txtNotariel').val();
		 var premi = $('#txtPremi').val();
		 var adm = $('#txtAdm').val();
		 var materai = $('#txtMaterai').val();
		 var lain =	$('#txtLain').val();
		 var pkkmaterai =$('#txtPkkMaterai').val();
		 var bytrans = $('#txtByTrans').val();
		 var nama=$('#txtNamaKre').val();
		 var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+user+"-"+kuitansi+"<br>";
		 var html2=no_rek+" "+nama+"<br>";
		 var html3=des_trans +" "+jml_kredit+"<br>"+provisi+" "+notariel+" "+premi+" "+adm+" "+materai+" "+bytrans;
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .document.write(html3);
		  newWindow .print();
		 // newWindow .document.close();
		}
		function capitalizeEachWord(str){
		   var words = str.split(" ");
		   var arr = Array();
		   for (i in words){
			  temp = words[i].toLowerCase();
			  temp = temp.charAt(0).toUpperCase() + temp.substring(1);
			  arr.push(temp);
		   }
		   return arr.join(" ");
		}

	function cetak_kuitansi(){
		if(this.value==0){
				$('#terbilang').text("nol");
				
			}else{
				var angka = $('#txtTotalDiterima').val();
				var words = toWords(angka);
				$('#terbilang').text(words);
			}
		   var newWindow = window.open('Kuitansi', '_blank');
		   var desk_trans = $('#DL_kodetrans1 option:selected').text();
		   var kuitansi= $("#txtKuitansi").val();
		   var jml_kre=$("#txtJmlKre").val();
		   var tgl_trans = $('#id_session_tgl_D').val();
		   var no_rek=$('#txtNoRekKre').val();
		   var nama=$('#txtNamaKre').val();
		   var terbilang =$('#terbilang').text();
		   terbilang = terbilang.replace(" koma nol nol","");
		   var ket = $('#txtKet').val();
		   var lokasi=$('#id_session_lokasi').val();
		   var user=$('#id_session_user').val();
		   
	  	   var provisi = $('#txtProvisi').val();
		   var notariel = $('#txtNotariel').val();
		   var premi = $('#txtPremi').val();
		   var materai = $('#txtMaterai').val();
		   var adm = $('#txtAdm').val();
		   var lain = $('#txtLain').val();
		   var nama_lkm = $('#id_session_nama_lkm').val();
		   var jml_diterima = $('#txtTotalDiterima').val();
		   var htm1='<table style="font-size: 10px;">';
		   var htm2 ='<tr>';
		   var htm3 ='';
		   var htm4 = '<td>TANDA TERIMA REALISASI PINJAMAN</br>'+nama_lkm+'</td><td></td>';
		   var htm5 = '<td>';
		   var htm6 = '<table style="border:1px solid black; border-collapse:collapse; width:200px; font-size: 10px;"><tr><td style="border:1px solid black;">Adm</td><td style="border:1px solid black;">Akunting</td><td style="border:1px solid black;">SPI</td></tr><tr height="20"><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td></tr></table>';
			
		   var htm7 ='</td>';//
		  //  var htm7 =desk_trans;
		   var htm8 = '</tr>';
		   var htm9 = '<tr><td valign="top">';
		   var htm10 = '<table style="font-size: 10px;"><tr><td style="font-family:Courier New, Courier, monospace; width:200px;">No. Kuitansi</td><td>:</td><td>'+kuitansi+'</td></tr>';
		   var htm10_1='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Nama</td><td>:</td><td>'+nama+'</td></tr>';
		   var htm10_2='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">No. Rek</td><td>:</td><td>'+no_rek+'</td></tr>';
		   var htm10_3='<tr><td style="font-family:Courier New, Courier, monospace; width:100px;">Jml Pinjaman</td><td>:</td><td>'+jml_kre+'</td></tr>';
		   var htm10e='</table></td>';
		   var htm11 = '<td></td><td>';
		   var htm11_1='<table style="font-size: 10px;"><tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Provisi</td><td>:</td><td>'+provisi+'</td></tr>';
		   var htm11_2='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Notariel</td><td>:</td><td>'+notariel+'</td></tr>';
		   var htm11_3='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Premi</td><td>:</td><td>'+premi+'</td></tr>';
		   var htm11_4='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Materai</td><td>:</td><td>'+materai+'</td></tr>';
		   var htm11_5='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Administrasi</td><td>:</td><td>'+adm+'</td></tr>';
		   var htm11_6='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Lain-lain</td><td>:</td><td>'+lain+'</td></tr>';
		   var htm11_7='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;"><hr></td><td>:</td><td></td></tr>';
		   var htm11_8='<tr><td style="font-family:Courier New, Courier, monospace; width:200px;">Jml diterima</td><td>:</td><td>'+jml_diterima+'</td></tr>';
		   var htm11e='</table></td></tr>';
		   
		   var htm12= '<tr><td colspan="3">Terbilang :'+ capitalizeEachWord(terbilang)+'</td></tr>';	
		   var htm13= '<tr><td colspan="3">';
		   var htm13_1 ='<table><tr><td></td><td></td><td></td><td></td><td>'+lokasi+', '+tgl_trans+'</td></tr>';
		   var htm13_2 ='<tr style="text-align:center;"><td style="width:100px;">Debitur,</td><td style="width:100px;"></td><td style="width:100px;">Teller</td><td style="width:100px;"></td><td style="width:100px;">Mengetahui</td></tr>';
		   var htm13_3 ='<tr><td style="width:100px; height:50px;" valign="bottom"><hr></td><td style="width:100px;"></td><td style="width:100px; height:50px;" valign="bottom"><hr></td><td style="width:100px;"></td><td style="width:100px; height:50px;" valign="bottom"><hr></td></tr>';

		   var htm15='</table></td></tr>';	   
		   var htm17 = ' </table>';
			newWindow .document.open();
			newWindow .document.write(htm1);
			newWindow .document.write(htm2);
			newWindow .document.write(htm3);
			newWindow .document.write(htm4);
			newWindow .document.write(htm5);
			newWindow .document.write(htm6);
		    newWindow .document.write(htm7);
			newWindow .document.write(htm8);
			newWindow .document.write(htm9);
			newWindow .document.write(htm10);
			newWindow .document.write(htm10_1);
			newWindow .document.write(htm10_2);
			newWindow .document.write(htm10_3);		
			newWindow .document.write(htm10e);
			newWindow .document.write(htm11);
			newWindow .document.write(htm11_1);
			newWindow .document.write(htm11_2);
			newWindow .document.write(htm11_3);
			newWindow .document.write(htm11_4);
			newWindow .document.write(htm11_5);
			newWindow .document.write(htm11_6);
			newWindow .document.write(htm11_7);
			newWindow .document.write(htm11_8);
			newWindow .document.write(htm11e);
			newWindow .document.write(htm12);
			newWindow .document.write(htm13);
			newWindow .document.write(htm13_1);
			newWindow .document.write(htm13_2);
			newWindow .document.write(htm13_3);
			newWindow .document.write(htm15);
			newWindow .document.write(htm17);
			newWindow .print();
			newWindow .document.close();
		}
		
		function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
		}
		function deskrip_norek(){
		var kd=$('#txtNoRekKre').val();
		$.post("<?php echo site_url('/real_kredit_c/deskripsi_norek_kre'); ?>",
			{
				'norek' : kd
			},
			function(data){
				if(data.baris==1){
					var jml_kredit=number_format(data.JML_PINJAMAN,2);
					var jml_bunga=number_format(data.JML_BUNGA_PINJAMAN,2);
					
					var tgl_real = data.TGL_REALISASI;
					var thn=tgl_real.slice(0,4);
					var bln=tgl_real.slice(5,7);
					var tgl=tgl_real.slice(8,10);
					var tglsys=tgl+'-'+bln+'-'+thn;
					
					var tgl_JT = data.TGL_JATUH_TEMPO;
					var thnjt=tgl_JT.slice(0,4);
					var blnjt=tgl_JT.slice(5,7);
					var tgljt=tgl_JT.slice(8,10);
					var tgljt=tgljt+'-'+blnjt+'-'+thnjt;
					
					$('#txtNamaKre').val(data.NAMA_NASABAH);
					$('#txtJmlKre').val(jml_kredit);
					$('#txtJmlBunga').val(jml_bunga);
					$('#txtTglReal').val(tglsys);
					$('#txtBungaPersen').val(data.SUKU_BUNGA_PER_ANGSURAN);
					$('#txtJangkaWaktu').val(data.BI_JANGKA_WAKTU);
					$('#txtJT').val(tgljt);
					$('#txtJenisKre').val(data.DESKRIPSI_JENIS_KREDIT);
					$('#txtTypeKre').val(data.DESKRIPSI_TYPE_KREDIT);
					$('#txtProvisi').val(number_format(data.PROVISI,2));
					$('#txtNotariel').val(number_format(data.NOTARIEL,2));
					$('#txtPremi').val(number_format(data.PREMI,2));
					$('#txtAdm').val(number_format(data.ADM,2));
					$('#txtMaterai').val(number_format(data.MATERAI,2));
					$('#txtLain').val(number_format(data.LAIN_LAIN,2));
					$('#txtPkkMaterai').val(number_format(data.POKOK_MATERAI,2));
					$('#txtByTrans').val(number_format(data.biaya_transaksi,2));
					$('#txtStatusAktif').val(data.STATUS_AKTIF);
					$('#txtTypeABP').val(data.TYPE_ABP);
					
					var biaya =data.NOTARIEL-data.PREMI-data.ADM-data.MATERAI-data.LAIN_LAIN-data.biaya_transaksi;
					
					var total_diterima =data.JML_PINJAMAN-data.PROVISI-data.NOTARIEL-data.PREMI-data.ADM-data.MATERAI-data.LAIN_LAIN-data.biaya_transaksi;
					$("#txtTotalDiterima").val(number_format(total_diterima,2));
					var k= "<?php echo $f; ?>";
					var c="<?php echo $count+1; ?>";
					$("#txtcounter").val(c);
					$("#txtKuitansi").val(k);
					
				}else{
					$.messager.alert('Perhatian','Data debitur kredit tidak ditemukan!');
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtNoRekKre').focus();
					$("#btnSimpan").removeAttr("disabled");
				}
			},"json");
		}

		// end angga print
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('.nomor1').val('0');
				$('#txtNoRekKre').focus();
				$("#btnSimpan").removeAttr("disabled");
				$('#btnSimpan').show();
				
				//location.reload();
			}
			});
		}
		$('.nomor').keyup(function(){
			  var val = $(this).val();
			  //val=val.toFixed(2);
			  if(isNaN(val)){
				   val = val.replace(/[^0-9\.]/g,'');
				   if(val.split('.').length>2) 
					   val =val.replace(/\.+$/,"");
			  }
			  $(this).val(val); 
	  });
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		$(document).ready(function(){
			$('#txtNoRekKre').focus();
			$('.nomor').val('0.00');
			$('.nomor1').val('0');
			$("#btnUbah").attr("disabled", "disabled");
			$( "#txtNoRekKre" ).focusout(function() {
				var kd=$("#txtNoRekKre").val();
				kd=kd.trim();
				if(kd!=''){
				  deskrip_norek();
				}
				
			});
			
		
		});//end ready document
		function ajax_simpan_realisasi(){
			  $.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>real_kredit_c/simpan_realisasi",
				data:dataString,
				success:function (data) {
					$.messager.alert('Perhatian','Realisasi kredit tersimpan.');
					 $("#btnSimpan").attr("disabled", "disabled");
					 $('#btnSimpan').hide();
				}
			});
			event.preventDefault();
		  }//function ajax_simpan_realisasi(){
		$('#formreal_kredit').submit(function (event) {
			var status_aktif = $('#txtStatusAktif').val();
			dataString = $("#formreal_kredit").serialize();
			if(status_aktif != '1'){
				$.messager.alert('Perhatian','Debitur ini sudah aktif atau sudah lunas!.');
				return false;
			}else{
			 var r = confirm('Anda yakin menyimpan data ini?');
			  if (r== true){
				ajax_simpan_realisasi();
			  }else{//if(r)
				return false;
			  }
			}
							
		}); //end  $contact form	  
		
		
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