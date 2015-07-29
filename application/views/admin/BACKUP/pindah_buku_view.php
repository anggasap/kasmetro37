<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<?php
		foreach($counter->result() as $row){
			$count= $row->CounterNo;
			
			$pecah=explode(";",$row->StructuredNo);
			/*
			$f1= $pecah[0];
			$f2=$pecah[1];
			$f=$f1.$f2.($count+1);
			*/
			$f=($count+1)."-".$this->session->userdata('user_id');
		}
		foreach($kode_debet_def->result() as $row){
			$kd1= $row->kode_trans;
			$gl1=$row->GL_TRANS;
		}
		foreach($kode_kredit_def->result() as $row){
			$kd2= $row->kode_trans;
			$gl2=$row->GL_TRANS;
		}
		/*
		foreach($transid->result() as $row){
		    $t= $row->tabtrans_id;
			$trans_id=$t+1;
		}
		*/
	?>
	<legend >&nbsp;Pemindah Bukuan Tabungan</legend>
	<?php
		if($this->session->flashdata('success') != ''){
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>'.$this->session->flashdata('success').'
			</div>
			</div>';
		} 
		if($this->session->flashdata('error') != ''){
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>'.$this->session->flashdata('error').'
			</div>
			</div>';
		} 
	?>
	<div class="span12 form-inline" style="height: 450px; max-height: 500px;">
		<?php 
		 $attributes = array('id' => 'id_form_pindahbuku');
		 echo form_open('pindah_buku/pindah',$attributes);
		 ?>
		
		<div class="row-fluid">
			<div style="float:left; width:49%;position: relative;">
			<h4>Debet Rekening</h4>
				<table cellpadding="3">
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtTglTrans">
								Tgl Input
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<?php echo form_input(array('name' =>'txtTGlTrans','id' =>'txtTGlTrans','class'=>'input-small','value' =>$this->session->userdata('tglD'),'readonly'=>'true'));?>
							<?php echo  form_input(array('name'=>'txtcounter','class'=>'span1 bersih hidden','type'=>'hidden','id'=>'txtcounter'));?>
						</td>
					</tr>

					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtRekTab">
								No Rek
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3" valign="top">
							<input id="txtRekTab" name="txtRekTab" type="text" placeholder="No rek tabungan" class="input-large bersih" required="">
                            <!--
							<span class="btn btn-primary" id="btnRek" >
								<i class="icon-search">
								</i>
							</span>
							-->
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtNama">
								Nama
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<?php echo form_input(array('name'=>'txtNama','id'=>'txtNama','class'=>'bersih','required'=>'required','style'=>'width:301px','placeholder'=>'nama nasabah','readonly'=>'true'));?>
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtAlamat">
								Alamat
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<input id="txtAlamat" name="txtAlamat" type="text" placeholder="alamat nasabah" style="width:301px;" required="" disabled="" class="bersih">
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoSaatIni">
								Saldo Saat Ini
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td>
							<?php echo form_input(array('name'=>'txtSaldoSaatIni','id'=>'txtSaldoSaatIni','class'=>'input-small nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoMin">
								Saldo Minimum
							</label>
						</td>
						<td>
							<?php echo form_input(array('name'=>'txtSaldoMin','id'=>'txtSaldoMin','class'=>'input-small nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtKuitansi">
								Kuitansi
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<input id="txtKuitansi" name="txtKuitansi" type="text" placeholder="no kuitansi" readonly="readonly" style="width:301px;" class="bersih" required="" onkeyup="ToUpper(this);">
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="DL_kode_trans1">
								Kode Transaksi
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<?php
							$data = array();
							foreach($kode_debet as $row){
								$data[$row['kode_trans']] = $row['DESKRIPSI_TRANS'];
							}
							
							echo form_dropdown('DL_kodetrans1', $data,$kd1,'id="DL_kodetrans1" class=""');
							echo "&nbsp;";
							
							//echo form_input(array('name'=>'txtDeskripTrans1','style' =>'width:207px;','id'=>'txtDeskripTrans1','readonly'=>'true'));
							?>
                            <input id="txtJenisTrans" name="txtJenisTrans" type="text" class="input-small" readonly="readonly" style="width:20px;">
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtJml">
								Jumlah
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="2" >
							<?php echo form_input(array('name'=>'txtJml','style' =>'text-align:right;width:182px;','id'=>'txtJml','onkeyup'=>'','required'=>'required','class'=>'nomor'));
							?>
							
						</td>
						<td >
						
							<span id="errmsg" style="color: red;font-weight: bold;">
							</span>
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtAlamat">
								
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
                        	<label id="terbilang" style="color: red"></label>
							
						</td>
					</tr>
				</table>
			</div> <!-- end div kolom kiri -->
			
			<div style="float:right; width:49%;position: relative;">
				<h4>Tabungan Tujuan</h4>
				<table cellpadding="3">
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtRekTab">
								No Rek
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3" valign="top">
							<input id="txtRekTujuan" name="txtRekTujuan" type="text" placeholder="No rek tabungan" class="input-large bersih" required="">
                            <!--
							<span class="btn btn-primary" id="btnRek2" >
								<i class="icon-search">
								</i>
							</span>
                            -->
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtNamaTujuan">
								Nama
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<input id="txtNamaTujuan" name="txtNamaTujuan" type="text" placeholder="nama nasabah" style="width:301px;" required="" disabled="" class="bersih">
							
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoTab">
								Saldo Tabungan
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td>
							<input id="txtSaldoTabTujuan" name="txtSaldoTabTujuan" type="text" class="input-small nomor" required="" style="text-align:right;" disabled="">
						</td>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoMin">
								Saldo Minimum
							</label>
						</td>
						<td>
							<input id="txtSaldoMinTujuan" name="txtSaldoMinTujuan" type="text" class="input-small nomor" required="" style="text-align:right;" disabled="">
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="DL_kode_trans">
								Kode Transaksi
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<?php
							$data = array();
							foreach($kode_kredit as $row)
							{
								$data[$row['kode_trans']] = $row['DESKRIPSI_TRANS'];
							}
							echo form_dropdown('DL_kodetrans2', $data,$kd2,'id="DL_kodetrans2" class=""');
							echo "&nbsp;";
							//echo form_input(array('name'=>'txtDeskripTrans2','style'=>'width:165px;','id'=>'txtDeskripTrans2','readonly'=>'true'));
							echo form_input(array('name'=>'txtJenisTrans2','style'=>'width:20px;','id'=>'txtJenisTrans2','readonly'=>'true'));
							?>
						</td>
					</tr>
                    
                    <tr>
						<td class="pull-right">
							<label class="control-label" for="txtKet">
								Keterangan
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<textarea id="txtKet" name="txtKet" style="width:301px;" class="bersih"></textarea>
							
						</td>
					</tr>
				</table>
				<br/>
				<!-- Button -->
				<div class="control-group pull-right" style="margin-right: 18%;">
					<div class="controls">
						<button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
							<i class="icon-save"></i><span class="ladda-label"> Simpan</span>
						</button>
                        <a class="btn btn-primary ladda-button" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi"><i class="icon-print"></i>Validasi</a>
                        <a class="btn btn-warning" onclick="cetak_kuitansi();" id="btnCetak_kuitansi" name="btnCetak_kuitansi"><i class="icon-print"></i>Kuitansi</a>
						<a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>
                        
                        
						<!--<a class="btn btn-warning" onclick="return confirm('Anda yakin?');" 
						href="<?php //echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>-->
					</div><br />
					<!-- hidden input untuk bantu -->
					<div class="hidden">
					<input id="txtModal" name="txtModal" type="text" class="input-mini bersih " >
					<input id="txtKdPerk" name="txtKdPerk" type="text" class="input-mini bersih">
					<input id="txtKdPerk2" name="txtKdPerk2" type="text" class="input-mini bersih">
					<input id="txtNasabahID" name="txtNasabahID" type="text" class=" input-mini bersih " >
					<input id="txtNasabahID2" name="txtNasabahID2" type="text" class=" input-mini bersih " >
					<input type="text" id="txtsaldosetor" name="txtsaldosetor" class="input-mini bersih " />
					<input type="text" id="txtsaldotarik" name="txtsaldotarik" class="input-mini bersih " />
					<input type="text" id="txtsaldosetor2" name="txtsaldosetor2" class="input-mini bersih " />
					<input type="text" id="txtsaldotarik2" name="txtsaldotarik2" class="input-mini bersih " />
					<?php echo form_input(array('name'=>'txtTransID','id'=>'txtTransID','class'=>'input-mini','value'=>$trans_id));?>
					</div>
				</div> <!-- end Button -->
				
			</div> <!-- end div kolom kanan -->
		</div>  <!-- end div row fluid -->
		<?php echo form_close(); ?>
	</div>
	
	<!-- modal rekening -->
	<div id="cari_rek" class="modal hide " style="" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>  
			<div class="form-search input-append">
			  <input type="text" class="input-medium search-query" id="kwd_search">
			  <span class="btn">
			     <i class="icon-search"></i>
			  </span>
			</div>
		</div>
		<div class="modal-body" style="height:90%;">
			<table class='table table-bordered table-hover table-striped' id="tabel_rek">
			 	<thead>
			      <tr>
			         <th width='30%' align='left'>NO REK</th>
			         <th width='70%' align='left'>NAMA</th>
			      </tr>
				</thead>
				<tbody>
				  <?php
				  /*
				   foreach($rekening->result() as $row)
				   {
				      ?>
				      <tr>
				         <td><?php echo $row->NO_REKENING;?></td>
				         <td><?php echo $row->nama_nasabah;?></td>
				      </tr>
				      <?php
				   }
				   */
				  ?>
			   </tbody>
		 </table>
		</div>
		<div id="pageNavPosition"></div>
	</div>

	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/moment.js') ?>"></script>
	
	<script type="text/javascript">
	/*
	var pager = new Pager('tabel_rek', 20); 
    pager.init(); 
    pager.showPageNav('pager', 'pageNavPosition'); 
    pager.showPage(1);
	*/
	function pad2(number) {
     			return (number < 10 ? '0' : '') + number
	}
	//fungsi cetak
	function cetak_validasi(){

	  var newWindow = window.open('Cetak', '_blank');
	  var d = new Date();
	  var jam =pad2(d.getHours()); // => 9
	  var mnt =pad2(d.getMinutes()); // =>  30
	  var dtk =pad2(d.getSeconds()); // => 51
	 
	 var no_rek = $('#txtRekTab').val();
	 var nama1 = $('#txtNama').val();
	 var jml_trans=$("#txtJml").val();
	 var des_trans = $('#DL_kodetrans1 option:selected').text();//kode trans
	 var kuitansi= $("#txtKuitansi").val();
	 var user=$("#id_session_user").val();
	 var tgl_trans = $('#txtTGlTrans').val();
	 
	 var no_rek2 = $('#txtRekTujuan').val();
	 var nama2 = $('#txtNamaTujuan').val();
	 
	 var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+"<br>";
	 var html2=no_rek+" "+nama1+" "+jml_trans+"<br>";
	 var html3=kuitansi+" "+des_trans+" "+user+"<br>";
	 var html4=no_rek2+" "+nama2;
	  newWindow .document.open();
	  newWindow .document.write(html1);
	  newWindow .document.write(html2);
	  newWindow .document.write(html3);
	  newWindow .document.write(html4);
	  newWindow .print();
	  newWindow .document.close();
	}
	//end fungsi cetak
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
		   var newWindow = window.open('Kuitansi', '_blank');
		   var desk_trans = $('#DL_kodetrans1 option:selected').text();
		   var kuitansi= $("#txtKuitansi").val();
		   var jml_trans=$("#txtJml").val();
		   var tgl_trans = $('#txtTGlTrans').val();
		   var no_rek=$('#txtRekTab').val();
		   var no_rek2=$('#txtRekTujuan').val();
		   var nama=$('#txtNama').val();
		   var nama2=$('#txtNamaTujuan').val();
		   var terbilang =$('#terbilang').text();
		   terbilang = terbilang.replace(" koma nol nol","");
		   var ket = $('#txtKet').val();
		   var lokasi=$('#id_session_lokasi').val();
		   var user=$('#id_session_user').val();
		   var nama_lkm = $('#id_session_nama_lkm').val();
	  
		   var htm1='<table>';
		   var htm2 ='<tr>';
		   var htm3 ='';
		   var htm4 = '<td colspan="3">TANDA TERIMA PINDAH BUKU TABUNGAN</br>'+nama_lkm+'</td>';
		   var htm5 = '';
		   var htm6 = '<td colspan="4">';
			
		   var htm7 ='<table style="border:1px solid black; border-collapse:collapse; width:200px;"><tr><td style="border:1px solid black;">Adm</td><td style="border:1px solid black;">Akunting</td><td style="border:1px solid black;">SPI</td></tr><tr height="20"><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td></tr></table>';//
		  //  var htm7 =desk_trans;
		   var htm8 = '</td>';
		   var htm9 = '</tr>';
		   var htm10 = ' <tr><td align="right"></td><td></td><td></td><td></td><td></td><td></td></tr>';
		   var htm10_1 = ' <tr><td style="border-bottom: 1px solid black;">Rekening Asal</td><td></td><td></td><td colspan="4"></td></tr>';
		   var htm11 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">No. Bukti </font></td><td>:</td><td>'+kuitansi+'</td><td colspan="4"></td></tr>';
		   var htm12 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">Nama Nasabah</font> </td><td>:</td><td>'+nama+'</td><td colspan="4"></td></tr>';
		   var htm13 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">No Rekening</font> </td><td>:</td><td>'+no_rek+'</td><td colspan="4"></td></tr>';
		   var htm14 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">Keterangan</font></td><td>:</td><td>'+ket+'</td><td colspan="2"></td></tr>';
		   var htm15 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">Nominal</font></td><td>:</td><td>Rp '+jml_trans+'</td><td colspan="2"></td></tr>';
		   var htm16 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">Terbilang</font></td><td>:</td><td>'+capitalizeEachWord(terbilang)+' Rupiah</td><td colspan="5"></td></tr>';
		   var htm16_1 = ' <tr><td style="border-bottom: 1px solid black;">Rekening Tujuan</td><td></td><td></td><td colspan="4"></td></tr>';
		   var htm16_2 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">Nama Nasabah</font> </td><td>:</td><td>'+nama2+'</td><td colspan="4"></td></tr>';
		   var htm16_3 = ' <tr><td align="right"><font face="Courier New, Courier, monospace">No Rekening</font> </td><td>:</td><td>'+no_rek2+'</td><td colspan="4"></td></tr>';
		   var htm19 ='<tr><td></td><td></td><td></td><td></td><td colspan="3" align="right">'+lokasi+', '+tgl_trans+'</tr>';
		   var htm18 ='<tr><td></td><td></td><td></td><td></td><td style="border-bottom: 1px solid black; width:100px; height:100px;"></td><td>&nbsp;</td><td style="border-bottom: 1px solid black; width:100px; height:100px;"></td></tr>';
		   var htm20 ='<tr><td></td><td></td><td></td><td></td><td>'+user+'</td><td>&nbsp;</td><td style=""></td></tr>';
		   var htm17 = ' </table>';
  
		   
		  // var html4 =tbsa+trsa+tdsa+"TANDA TERIMA "+tdso+trso+tbso;
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
			newWindow .document.write(htm10_1);
			newWindow .document.write(htm10);
			newWindow .document.write(htm11);
			newWindow .document.write(htm12);
			newWindow .document.write(htm13);
			newWindow .document.write(htm14);
			newWindow .document.write(htm15);
			newWindow .document.write(htm16);
			newWindow .document.write(htm16_1);
			newWindow .document.write(htm16_2);
			newWindow .document.write(htm16_3);
			newWindow .document.write(htm19);
			newWindow .document.write(htm18);
			newWindow .document.write(htm20);
			newWindow .document.write(htm17);
			newWindow .print();
			newWindow .document.close();
		}
	function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
	}
	function ajax_submit_pindahbuku(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>pindah_buku/simpan_pindah_buku",
				data:dataString,
		
				success:function (data) {
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Transaksi setoran telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
	$(function() {
		$('#id_form_pindahbuku').submit(function (event) {
			  dataString = $("#id_form_pindahbuku").serialize();
			  var jml_bayar = parseFloat(CleanNumber($("#txtJml").val()));
			  var saldo_saat_ini = parseFloat(CleanNumber($("#txtSaldoSaatIni").val()));
			 
			  if (jml_bayar==0){
				  $.messager.alert('Perhatian','Jumlah setoran tidak boleh 0 !');
				  return false;
			  }else if(jml_bayar>saldo_saat_ini){
				  $.messager.alert('Perhatian','Jumlah penarikan lebih besar dari saldo!');
				  return false;
			  }else{
					  var r = confirm('Anda yakin menyimpan data ini?');
					  if (r== true){
						ajax_submit_pindahbuku();
					  }else{//if(r)
						return false;
					  }
			  }
		  }); //end  $contact form
	});
	$('#txtJml').keyup(function(){		
		var angka = $('#txtJml').val(); 
		var words = toWords(angka);
		$('#terbilang').text(words);
			
	});
	function kode2(){
		var kd=$('#DL_kodetrans2').val();
		$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_trans'); ?>",
			{
				'kodetrans' : kd
			},
			function(data)
			{
				//$('#txtDeskripTrans2').val(data.deskripsitrans);
				$('#txtKdPerk2').val(data.gl_trans);
				$('#txtJenisTrans2').val(data.tob)
			},"json");
	}
	
	function kode1(){
		var kd=$('#DL_kodetrans1').val();
		$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_trans'); ?>",
			{
				'kodetrans' : kd
			},
			function(data)
			{
				$('#txtDeskripTrans1').val(data.deskripsitrans);
				$('#txtKdPerk').val(data.gl_trans);
				var t=(data.tob);
				$('#txtJenisTrans').val(t);
			},"json");
	}
	function focus_txtJml(){
		$('#txtJml').val('');
		$('#txtJml').focus();
	}
	function deskrip_norek(){
		var kd=$('#txtRekTab').val();
	//	kd=kd.trim();
	//	if(kd!=''){
		$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",
			{
				'norek' : kd
			},
			function(data){
				if(data.baris==1){
					var saldo=number_format(data.SALDO_AKHIR,2);
					var saldo_blk=number_format(data.SALDO_BLOKIR,2);
					var	saldo_min=number_format(data.MINIMUM_DEFAULT,2);
					
					$('#txtNama').val(data.NAMA_NASABAH);
					$('#txtNasabahID').val(data.NASABAH_ID);
					$('#txtAlamat').val(data.ALAMAT);
					$('#txtSaldoSaatIni').val(saldo);
					$('#txtSaldoMin').val(saldo_min);
					$('#txtsaldosetor').val(data.SALDO_SETORAN);
					$('#txtsaldotarik').val(data.SALDO_PENARIKAN);
					var k= "<?php echo $f; ?>";
					var c="<?php echo $count+1; ?>";
					$("#txtcounter").val(c);
					$("#txtKuitansi").val(k);
					$('#txtJml').focus();
				}else{
					$.messager.alert('Perhatian','Data tidak ditemukan!');
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtRekTab').focus();
				}
			},"json");
	}
	
	function deskrip_norek2(){
		var kd=$('#txtRekTujuan').val();
		$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",
			{
				'norek' : kd
			},
			function(data){
				if(data.baris==1){
					var saldo=number_format(data.SALDO_AKHIR,2);
					var saldo_blk=number_format(data.SALDO_BLOKIR,2);
					var	saldo_min=number_format(data.MINIMUM_DEFAULT,2);
					
					$('#txtNamaTujuan').val(data.NAMA_NASABAH);
					$('#txtNasabahID2').val(data.NASABAH_ID);
					$('#txtSaldoTabTujuan').val(saldo);
					$('#txtSaldoMinTujuan').val(saldo_min);
					$('#txtsaldosetor2').val(data.SALDO_SETORAN);
					$('#txtsaldotarik2').val(data.SALDO_PENARIKAN);
					$('#btnSimpan').focus();
				}else{
					$.messager.alert('Perhatian','Data tidak ditemukan!');
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtRekTab').focus();
				}
			},"json");
	}
	$("#txtJml").focus(function(){
		$('#txtJml').val('');
		$('#txtJml').focus();
	});
	
	function confirm_reset(){
		$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
				if (r){
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtRekTab').focus();
				}
		});
		}
	$(document).ajaxStart(function() {
		$('.modal_json').fadeIn('fast');
	  }).ajaxStop(function() {
		$('.modal_json').fadeOut('fast');
	});
	$(document).ready(function(){
		$('#txtRekTab').focus();
		$('.nomor').val('0.00');
		$("#txtDeskripTrans1").val("Pemindabukuan Debet");
		$("#txtDeskripTrans2").val("Pemindabukuan Kredit");
		$("#txtJenisTrans").val("O");
		$("#txtJenisTrans2").val("O");
		
		var gl1="<?php echo $gl1; ?>";
		var gl2="<?php echo $gl2; ?>";
		$("#txtKdPerk").val(gl1);
		$("#txtKdPerk2").val(gl2);
		/*
		$("#txtJml").keypress(function (e){
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
			{
				$("#errmsg").html("Digits Only").show().fadeOut("slow");
				return false;
			}
		});
		*/
		$("#txtJml").focusout(function(){
			if ($(this).val() == '') { 
			   $(this).val(0.00);
			 }else{
				var angka = $('#txtJml').val(); 
				var result = number_format(angka,2);
				$('#txtJml').val(result);
				//var words = toWords(angka);
				//$('#terbilang').text(words);
			 }
		});
		$('#txtJml').focusout(function(){
			if(this.value==0){
				$('#txtJml').val(0.00);
				$('#terbilang').text("nol");
			}else{
				var angka = $('#txtJml').val();
				var words = toWords(angka);
				$('#terbilang').text(words);
			}
				saldo_setelah();
		});
		$('#txtJml').keyup(function(){
			var val = $(this).val();
			if(isNaN(val)){
				 val = val.replace(/[^0-9\.]/g,'');
				 if(val.split('.').length>2) 
					 val =val.replace(/\.+$/,"");
			}
			$(this).val(val); 
		});
		$('#DL_kodetrans1').change(function(){
			kode1();
		});
		$('#DL_kodetrans2').change(function(){
			kode2();
		});

		$("#btnRek").click(function(event){
			$("#txtModal").val('1');
		  	$("#cari_rek").modal('show');
		});
		$("#btnRek2").click(function(event){
			$("#txtModal").val('2');
		  	$("#cari_rek").modal('show');
		});

		$("#txtRekTab").focusout(function(){
			var kd=$("#txtRekTab").val();
			kd=kd.trim();
			if(kd!=''){
				deskrip_norek();
			}
		});
		
		$("#txtRekTujuan").focusout(function(){
			var kdtj=$("#txtRekTujuan").val();
			kdtj=kdtj.trim();
			if(kdtj!=''){
				deskrip_norek2();	
			}
		});
				
	});//end ready document
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