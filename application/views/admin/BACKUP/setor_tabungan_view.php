<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
		<?php
		
		if($judul == 'Setoran Tabungan'){
			$attributes = array('id' => 'formtabung_s');
			echo form_open('setor_tarik_tabungan/setor', $attributes);
			foreach($setoran->result() as $row){
			     $kd_setor= $row->kode_trans;
				 $dk_setor= $row->TYPE_TRANS;
				 $tob_def=$row->TOB;
				}
		}elseif($judul == 'Penarikan Tabungan'){
			$attributes = array('id' => 'formtabung_t');
			echo form_open('setor_tarik_tabungan/tarik', $attributes);
			foreach($tarikan->result() as $row){
			     $kd_tarik= $row->kode_trans;
				 $dk_tarik= $row->TYPE_TRANS;
				 $tob_def=$row->TOB;
				}
		}
		?>
		<legend >
			<?php echo "&nbsp;".$judul; echo('<br>'); ?>
			<?php
			   foreach($pasif->result() as $row_pasif){			      
			     $rp= $row_pasif->Value;
				}
				foreach($norek->result() as $row_norek){
			     $rn= $row_norek->Value;
				}
				foreach($counter->result() as $row){
				$count= $row->CounterNo;
				//SETTING KUITANSI
				$pecah=explode(";",$row->StructuredNo);
				/*
				$f1= $pecah[0];
				$f2=$pecah[1];
				$f=$f1.$f2.($count+1);
				*/
				$f=($count+1)."-".$this->session->userdata('user_id');
				}
				/*
				foreach($transid->result() as $row){
			     $t= $row->tabtrans_id;
				 $trans_id=$t+1;
				}
				*/
				
				
			?>
		</legend>
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
	<div class="form-inline span12" style="height: 450px; max-height: 500px;">
		<div class="row-fluid">
			<div class="span6">
				<table cellpadding="3">
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtTglTrans">
								Tgl Input
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td>
							<?php echo form_input(array('name'=>'txtTGlTrans','id'=>'txtTGlTrans','class'=>'input-small','value'=>$this->session->userdata('tglD'),'readonly'=>'true'));?>
						</td>
						<td  colspan="2">
							<?php // echo form_input(array('name'=>'txtTransID','id'=>'txtTransID','class'=>'input-mini hidden','value'=>$trans_id,'readonly'=>'true'));?>
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
                        <div class="input-prepend">
							<input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rek Tabungan" class="input-large bersih" required="">
                            <!--
							<a class="btn btn-primary" data-toggle="modal" href="#cari_rek" id="btnRek" >
								<i class="icon-search">
								</i>&nbsp;
							</a>
                            -->
                        </div>    
							<?php
							if($rp=='DITAMPILKAN'){
								?>
								<label for="txtRekTab" id="lblStatus" style="font-weight: bolder;color: #ff0000;">
								</label>
							<?php
							}
							?>
							<input id="txtBulan" name="txtBulan" class=" input-mini bersih" type="hidden"
							value="<?php foreach($bln->result() as $row_bln)
							   {
							   	if($row_bln->Value=='> 3 BULAN'){
									echo "3";
								}
								elseif($row_bln->Value=='> 6 BULAN'){
									echo "6";
								}
								elseif($row_bln->Value=='> 1 TAHUN'){
									echo "12";
								}
								} ?>
							"> <!-- end dari input id=txtBulan -->
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
							<?php echo form_input(array('name'=>'txtNama','id'=>'txtNama','class'=>'bersih','required'=>'required','style'=>'width:310px','placeholder'=>'Nama Nasabah','readonly'=>'true'));?>
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
							<input id="txtAlamat" name="txtAlamat" type="text" placeholder="Alamat Nasabah" style="width:310px;" required="" disabled="" class="bersih">
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtJenisSimp">
								Jenis Simpanan
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<input id="txtJenisSimp" name="txtJenisSimp" type="text" placeholder="Jenis Simpanan" class="input-large bersih" required="" disabled="">
						</td>
					</tr>
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoBTrans">
								Saldo Saat Ini
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td colspan="3">
							<?php echo form_input(array('name'=>'txtSaldoBTrans','id'=>'txtSaldoBTrans','class'=>'input-large nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
					</tr>
                    
                    <?php
					if($judul == 'Setoran Tabungan'){
					?>
                    <tr>
                    <td class="pull-right">
							<label class="control-label" for="txtSaldoATrans">
								Setoran Minimum
							</label>
						</td>
                        <td>&nbsp;
							
						</td>
						<td colspan="3">
							<?php echo form_input(array('name'=>'txtSaldoATrans','id'=>'txtSaldoATrans','class'=>'input-large nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
                    </tr>
                    <?php
					}elseif($judul == 'Penarikan Tabungan'){
					?>
                    <tr>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoMin">
								Saldo Minimum
							</label>
						</td>
						<td>&nbsp;
						</td>
						<td colspan="3">
							<?php echo form_input(array('name'=>'txtSaldoMin','id'=>'txtSaldoMin','class'=>'input-large nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
					</tr>
                    <tr>
						<td class="pull-right">
							<label class="control-label" for="txtSaldoDptTarik">
								Saldo Dapat ditarik
							</label>
						</td>
						<td>&nbsp;
						</td>
						<td colspan="3">
							<?php echo form_input(array('name'=>'txtSaldoDptTarik','id'=>'txtSaldoDptTarik','class'=>'input-large nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
					</tr>
                    <?php
					}// END
					?>
					
                    <!--
                    <tr>
                    <td class="pull-right">
							<label class="control-label" for="txtSetorNormal">
								Setoran Normal
							</label>
						</td>
                        <td>&nbsp;
						</td>
						<td colspan="3">
							<?php //echo form_input(array('name'=>'txtSetorNormal','id'=>'txtSetorNormal','class'=>'input-large nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
                    </tr>
                    -->
                    <tr>
                    <td class="pull-right">
							<label class="control-label" for="txtSaldoStlh">
								Saldo Setelah
							</label>
						</td>
						<td>&nbsp;
						</td>
						<td colspan="3">
							<?php echo form_input(array('name'=>'txtSaldoStlh','id'=>'txtSaldoStlh','class'=>'input-medium nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</td>
                    </tr>
				</table>
				<br>
				<?php
				if($rn=='MENAMPILKAN NOREK KREDIT'){
				?>
				<div style="height:200px;overflow: auto;overflow-y: auto;">
				<table class='table table-bordered table-striped' style="width:86%;">
					<thead>
						<tr>
							<th width='30%' align='left'>
								No Rekening
							</th>
							<th width='40%' align='left'>
								Produk
							</th>
							<th width='30%' align='left'>
								Saldo
							</th>
						</tr>
					</thead>
					<tbody id="body"></tbody>				
				</table>
				</div>
				
				<?php
				}
				?>
			</div>

			<div class="span6">
				<table cellpadding="3" class="pull-right">
					<tr>
						<td class="pull-right">
							<label class="control-label" for="txtKuitansi">
								Kuitansi
							</label>
						</td>
						<td>&nbsp;
							
						</td>
						<td>
							<input id="txtKuitansi" name="txtKuitansi" type="text" placeholder="No kuitansi" class="input-xlarge bersih" required="" onkeyup="ToUpper(this);" readonly="readonly">
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
						<td>
							<?php
							$data = array();
							if($judul == 'Setoran Tabungan'){
								$def_kode = $kd_setor;
								$type_dk_trans=$dk_setor;
								foreach($kodetrans_setor as $row) : 
									$data[$row['KODE_TRANS']] = $row['DESKRIPSI_TRANS'];
								endforeach; 
							}
							else{
								$def_kode = $kd_tarik;
								$type_dk_trans=$dk_tarik;
								foreach($kodetrans_tarik as $row) : 
									$data[$row['KODE_TRANS']] = $row['DESKRIPSI_TRANS'];
								endforeach; 
							}
							/*
							$data = array();
							foreach($kodetrans->result_array() as $row){
								$data[$row['kode_trans']] = $row['deskripsi_trans'];
							}
							echo form_dropdown('DL_kodetrans',$data,$def_kode,'id="DL_kodetrans" class="input-small"');
							echo "&nbsp;";
							echo form_input(array('name'=>'txtDekripTrans','style'=>'width:175px;','id'=>'txtDekripTrans','readonly'=>'true'));
							echo form_input(array('name'=>'txtTypeTrans','id'=>'txtTypeTrans','class'=>'input-small hidden','style'=>'width:5px','readonly'=>'true', 'value'=>$type_dk_trans));
							*/
							?>
                            <?php
							echo form_dropdown('DL_kodetrans',$data,$def_kode,'id="DL_kodetrans" class=""');
							//echo form_input(array('name'=>'txtDekripTrans','style'=>'width:175px;','id'=>'txtDekripTrans','readonly'=>'true'));
							echo form_input(array('name'=>'txtTypeTrans','id'=>'txtTypeTrans','class'=>'input-small hidden','readonly'=>'true', 'value'=>$type_dk_trans));
							 ?>
                 
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
						<td>
							<input id="txtJml" name="txtJml" type="text" class="input-medium nomor" required="" onkeyup="" style="text-align:right;">
                            <!--AddAndRemoveSeparator(this);-->
							<input id="txtJenisTrans" name="txtJenisTrans" type="text" style="width:96px;" required="" readonly="readonly">
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;
							
						</td>
						<td>&nbsp;
							
						</td>
						<td>
							<label id="terbilang" style="color: red"></label>
							<span id="errmsg" style="color: red;font-weight: bold;"></span>
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
						<td>
							<input type="text" id="txtKet" name="txtKet" class="input-xlarge bersih" maxlength="100">
							<!--</textarea>-->
							<input id="txtKdPerk" name="txtKdPerk" type="hidden" class="input-small">
							<input type="hidden" id="txtsaldosetor" name="txtsaldosetor"/>
							<input type="hidden" id="txtsaldotarik" name="txtsaldotarik"/>
						</td>
					</tr>
				</table>
				<!-- Button -->
				<div class="control-group pull-right">
					<br />
					<div class="controls">
						<button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
							<i class="icon-save"></i><span class="ladda-label"> Simpan</span>
						</button>
                        <a class="btn btn-primary" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi"><i class="icon-print"></i>Validasi</a>
                        <a class="btn btn-warning" onclick="cetak_kuitansi();" id="btnCetak_kuitansi" name="btnCetak_kuitansi"><i class="icon-print"></i>Kuitansi</a>   
                        <a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>
                        <!--
                        <a class="btn btn-warning" onclick="return confirm('Anda yakin?');" 
						href="<?php //echo  site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>-->
					</div>
					<?php echo  form_input(array('name'=>'txtcounter','class'=>'hidden','id'=>'txtcounter','value'=>''));?>
					<input id="txtNasabahID" name="txtNasabahID" type="hidden" class="input-mini bersih " >
				</div> <!-- end Button -->
				
			</div>

		</div>

		<?php echo form_close(); ?>
	</div>

	<div id="cari_rek" class="modal hide" style="width:40%;">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>  
			<div class="form-search input-prepend">
			  <input type="text" class="input-medium search-query" id="kwd_search" placeholder="Cari...">
			  <span class="btn btn-primary">
			     <i class="icon-search"></i>&nbsp;
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
		<div id="pageNavPosition" class="pagination"></div>
	</div>

	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	<script src="<?php // echo base_url('bootstrap/js/bootstrap.js') ?>"></script>
    <!--
	<script src="<?php // echo base_url('bootstrap/js/pagination.js') ?>"></script>
    -->
	<script src="<?php //echo base_url('bootstrap/js/bootstrap-paginator.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
    <script src="<?php // echo base_url('bootstrap/js/accounting.min.js') ?>"></script>
	<script src="<?php //echo base_url('bootstrap/js/select2.js') ?>"></script>
	<script src="<?php // echo base_url('bootstrap/js/spiner/spin.min.js') ?>"></script>
	<script src="<?php //echo base_url('bootstrap/js/spiner/ladda.min.js') ?>"></script>
	<script src="<?php //echo base_url('bootstrap/js/spiner/prism.js') ?>"></script>
	<script src="<?php //echo base_url('bootstrap/js/lazada-spin.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/moment.js') ?>"></script>
	<script src="<?php // echo base_url('bootstrap/js/paging.js') ?>"></script>
	
	<script type="text/javascript">
	
	/*
		var pager = new Pager('tabel_rek', 20); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
		*/
		function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
		}
		function saldo_setelah() {
			var jml_trans = parseFloat(CleanNumber($("#txtJml").val()));
		    if (isNaN(jml_trans)) jml_trans = 0;
			var kode_trans= $("#txtTypeTrans").val();
			if(kode_trans=='K'){
				var saldo_saat_ini = parseFloat(CleanNumber($("#txtSaldoBTrans").val()));
		    	if (isNaN(saldo_saat_ini)) saldo_saat_ini = 0;
				var saldo_setelah =CommaFormatted(jml_trans+saldo_saat_ini);
			}else{
				var saldo_saat_ini = parseFloat(CleanNumber($("#txtSaldoDptTarik").val()));
		    	if (isNaN(saldo_saat_ini)) saldo_saat_ini = 0;
				var saldo_setelah =CommaFormatted(saldo_saat_ini-jml_trans);
			}
			$("#txtSaldoStlh").val(number_format(saldo_setelah,2));
		}
		
		$("#txtJml").focusout(function(){
			if ($(this).val() == '') { 
			   $(this).val('0.00');
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
				$('#txtJml').val(0);
				$('#terbilang').text("nol");
				
			}else{
				var angka = $('#txtJml').val();
				var words = toWords(angka);
				$('#terbilang').text(words);
			}
				saldo_setelah();
		});
		/*
		function CommaFormatted(amount) {
		    var delimiter = ",";
		    var i = parseFloat(amount);

		    if (isNaN(i)) { return ''; }
		    i = Math.abs(i);
		    var minus = '';
		    if (i < 0) { minus = '-'; }

		    var n = new String(i);
		    var a = [];
		    while (n.length > 3) {
		        var nn = n.substr(n.length - 3);
		        a.unshift(nn);
		        n = n.substr(0, n.length - 3);
		    }
		    if (n.length > 0) { a.unshift(n); }
		    n = a.join(delimiter);
		    amount = minus + n;
		    return amount;
		}
		*/
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}
		//fungsi cetak
		function cetak_validasi(){

		  var newWindow = window.open('Validasi', '_blank');
		  var d = new Date();
		  var jam =pad2(d.getHours()); // => 9
		  var mnt =pad2(d.getMinutes()); // =>  30
		  var dtk =pad2(d.getSeconds()); // => 51
		 
		
		 var kode_trans = $('#DL_kodetrans').val();//kode trans
		 var desk_trans = $('#DL_kodetrans option:selected').text();
		 var kuitansi= $("#txtKuitansi").val();
		 var kode_gl=$("#txtKodeGL").val();
		 var jml_trans=$("#txtJml").val();
		 var tgl_trans = $('#txtTGlTrans').val();
	  	 var no_rek=$('#txtRekTab').val();
		 var nama=$('#txtNama').val();
		 var saldo_stlh=$('#txtSaldoStlh').val();
		 var html1='<span style="font-size: 11px;">'+tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+kode_trans+"-"+desk_trans+'</span><br>';
		 var html2='<span style="font-size: 11px;">'+no_rek+" "+nama+"</span><br>";
		 var html3='<span style="font-size: 11px;">'+kuitansi+" CR "+jml_trans+"/ Saldo : "+saldo_stlh+'</span>';
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .document.write(html3);
		  newWindow .print();
		  newWindow .document.close();
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
		   var newWindow = window.open('Kuitansi', '_blank');
		   var desk_trans = $('#DL_kodetrans option:selected').text();
		   var kuitansi= $("#txtKuitansi").val();
		   var jml_trans=$("#txtJml").val();
		   var tgl_trans = $('#txtTGlTrans').val();
		   var no_rek=$('#txtRekTab').val();
		   var nama=$('#txtNama').val();
		   var terbilang =$('#terbilang').text();
		   terbilang = terbilang.replace(" koma nol nol","");
		   var ket = $('#txtKet').val();
		   var lokasi=$('#id_session_lokasi').val();
		   var user=$('#id_session_user').val();
		   var nama_lkm = $('#id_session_nama_lkm').val();
	  
		   var htm1='<table style="width:700px; font-size: 11px;">';
		   var htm2 ='<tr>';
		   var htm3 ='';
		   var htm4 = '<td colspan="3">TANDA TERIMA TRANSAKSI TABUNGAN</br>'+nama_lkm+'</td>';
		   var htm5 = '';
		   var htm6 = '<td colspan="4">';
			
		   var htm7 ='<table style="border:1px solid black; border-collapse:collapse; font-size: 11px; width:300px;"><tr><td style="border:1px solid black;">Adm</td><td style="border:1px solid black;">Akunting</td><td style="border:1px solid black;">SPI</td></tr><tr height="20"><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td><td style="border:1px solid black;"></td></tr></table>';//
		  //  var htm7 =desk_trans; <font face="Courier New, Courier, monospace">
		   var htm8 = '</td>';
		   var htm9 = '</tr>';
		   var htm10 = ' <tr><td align="right"></td><td></td><td colspan="4" align="right">'+desk_trans+'</td></tr>';
		   var htm11 = ' <tr><td align="right">No. Bukti </font></td><td>:</td><td>'+kuitansi+'</td><td colspan="4"></td></tr>';
		   var htm12 = ' <tr><td align="right">Nama Nasabah</td><td>:</td><td>'+nama+'</td><td colspan="4"></td></tr>';
		   var htm13 = ' <tr><td align="right">No Rekening</td><td>:</td><td>'+no_rek+'</td><td colspan="4"></td></tr>';
		   var htm14 = ' <tr><td align="right">Keterangan</td><td>:</td><td>'+ket+'</td><td colspan="2"></td></tr>';
		   var htm15 = ' <tr><td align="right">Nominal</td><td>:</td><td>Rp '+jml_trans+'</td><td colspan="2"></td></tr>';
		   var htm16 = ' <tr><td align="right">Terbilang</td><td>:</td><td>'+capitalizeEachWord(terbilang)+' Rupiah</td><td colspan="5"></td></tr>';
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
			newWindow .document.write(htm10);
			newWindow .document.write(htm11);
			newWindow .document.write(htm12);
			newWindow .document.write(htm13);
			newWindow .document.write(htm14);
			newWindow .document.write(htm15);
			newWindow .document.write(htm16);
			newWindow .document.write(htm19);
			newWindow .document.write(htm18);
			newWindow .document.write(htm20);
			newWindow .document.write(htm17);
			newWindow .print();
			newWindow .document.close();
		}
		
		
		//end fungsi cetak
		function DateDiff (date1, date2){
			return (date2 - date1) / (1000 * 30 * 60 * 60 * 24); 
			//mengembalikan jumlah hari
		}
		function proses(){
			var item = $("#txtNasabahID").val();
			
			$.post("<?php echo site_url('/setor_tarik_tabungan/process'); ?>",{'item':item},
			function(data){
				//alert(data.norek.length);
				$('#body').empty();
				var tr;
		        for (var i = 0; i < data.norek.length; i++) {
				
					 a=data.norek[i].NO_REKENING;
					 b=data.norek[i].DESKRIPSI_JENIS_KREDIT;
					 c=data.norek[i].SALDO_AKHIR;
					
		            tr = $('<tr/>');
		            tr.append("<td>" + a + "</td>");
		            tr.append("<td>" + b + "</td>");
		            tr.append("<td>" + number_format(c,2) + "</td>");
		            $('#body').append(tr);
		        }
			},"json");
		}
		
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
				if (r){
					/*
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtJml').val(number_format(0,2));
					$('#txtcounter').val('');
					$('#txtRekTab').focus();
					//$("#btnSimpan").removeAttr("disabled");
					$('#btnSimpan').show();
					*/
					location.reload();
				}
			});
		}
		function ajax_submit_setor(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>setor_tarik_tabungan/setor_tabungan",
				data:dataString,
		
				success:function (data) {
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Transaksi setoran telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		function ajax_submit_tarik(){
			$.ajax({
			  type:"POST",
			  url:"<?php echo base_url(); ?>setor_tarik_tabungan/tarik_tabungan",
			  data:dataString,
	  
			  success:function (data) {
				  $.messager.alert('Perhatian','Transaksi penarikan tersimpan!');
				  $('#btnSimpan').hide();
				  $("#btnSimpan").attr("disabled", "disabled");
			  }
	  
		  });
		  event.preventDefault();
		}
		$(function() {
				$('#formtabung_s').submit(function (event) {
					  dataString = $("#formtabung_s").serialize();
					  var jml_bayar = parseFloat(CleanNumber($("#txtJml").val()));
					  var set_min = parseFloat(CleanNumber($("#txtSaldoATrans").val()));
					 
					  if (jml_bayar==0){
						  $.messager.alert('Perhatian','Jumlah setoran tidak boleh 0 !');
						  return false;
					  }else if(jml_bayar<set_min){
						  
						  $.messager.alert('Perhatian','Jumlah setoran harus lebih besar dari setoran minimum!');
						  return false;
					  }else{
						  var kode_trans= $("#txtTypeTrans").val();
						  if(kode_trans=='K'){
							  var r = confirm('Anda yakin menyimpan data ini?');
							  if (r== true){
								ajax_submit_setor();
							  }else{//if(r)
								return false;
							  }
						  }else{  
						  	$.messager.alert('Perhatian','Kode transaksi salah!');
						  }
						  
					  }
				  }); //end  $contact form
				  
				  $('#formtabung_t').submit(function (event) {
					  dataString = $("#formtabung_t").serialize();
					  var jml_tarik = parseFloat(CleanNumber($("#txtJml").val()));
					  var saldo_dpt_tarik = parseFloat(CleanNumber($("#txtSaldoDptTarik").val()));
					  if (jml_tarik==0){
						  $.messager.alert('Perhatian','Jumlah tarikan tidak boleh 0 !');
						  return false;
					  }else if(jml_tarik>saldo_dpt_tarik){
						  $.messager.alert('Perhatian','Jumlah penarikan tidak boleh lebih besar dari saldo yang dapat ditarik!');
						  return false;
					  }else{
						  var kode_trans= $("#txtTypeTrans").val();
						  if(kode_trans=='D'){
							  var r = confirm('Anda yakin menyimpan data ini?');
							  if (r== true){
								ajax_submit_tarik();
							  }else{//if(r)
								return false;
							  }
						 }else{  
						  	$.messager.alert('Perhatian','Kode transaksi salah!');
						 }//else{
					  }//else{
				  }); //end  $contact form
			
			
			
			
		});/// end $func
		$(document).ajaxStart(function() {
			  $('.modal_json').fadeIn('fast');
			}).ajaxStop(function() {
			  $('.modal_json').fadeOut('fast');
		});
		$(document).ready(function (){
			$('#txtRekTab').focus();
			
			/*
			$('.modal_json').ajaxStart(function () {
				$(this).fadeIn('fast');
			}).ajaxStop(function () {
				$(this).stop().fadeOut('fast');
			});
			*/
				$('#lblStatus').text('');
				$('#lblStatus').hide();
				$('.nomor').val('0.00');
				var trans="<?php echo $judul; ?>";
				if (trans=="Setoran Tabungan"){
					$("#txtDekripTrans").val("Setoran Tunai Mobile");
					$("#txtJenisTrans").val("<?php echo $tob_def; ?>");

				}
				else{
					$("#txtDekripTrans").val("Penarikan Tunai Mobile");
					$("#txtJenisTrans").val("<?php echo $tob_def; ?>");
				}
				
				var tgl_trans=$('#txtTGlTrans').val();
				var substring = tgl_trans.substring(0, tgl_trans.length);
				var coordinates = substring.split("-");
				var tgl = coordinates[0];
				var bln = coordinates[1];
				var thn= coordinates[2];
				var tgl_akhir=thn+"-"+bln+"-"+tgl;
				
				var bln=$('#txtBulan').val();

				$('#txtJml').keyup(function(){		
					var angka = $('#txtJml').val(); 
					var words = toWords(angka);
					$('#terbilang').text(words);
						
				});
				/*
				$("#txtJml").keypress(function (e)
					{
						if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
						{
							$("#errmsg").html("Bukan angka!").show().fadeOut("slow");
							return false;
						}
					});
					*/
					
				$('#txtJml').keyup(function(){
					var val = $(this).val();
					//val=val.toFixed(2);
					if(isNaN(val)){
						 val = val.replace(/[^0-9\.]/g,'');
						 if(val.split('.').length>2) 
							 val =val.replace(/\.+$/,"");
					}
					$(this).val(val); 
				});
				$('#DL_kodetrans').change(function()
					{
						var kd=$('#DL_kodetrans').val();
						$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_trans'); ?>",
							{
								'kodetrans' : kd
							},
							function(data){
								
								$('#txtDekripTrans').val(data.deskripsitrans);
								
								$('#txtKdPerk').val(data.gl_trans);
								
								var t=(data.tob);
								$('#txtJenisTrans').val(t);
								/*
								if(t=='T'){
									$('#txtJenisTrans').val('Tunai');
								}
								else if(t=='O'){
									$('#txtJenisTrans').val('Overbooking');
								}
								*/
							},"json");
							//$('#txtJml').focus();
					});

				$("#txtJml").focus(function(){
					$('#txtJml').val('');
					$('#txtJml').focus();
				});
				
				$( "#txtRekTab" ).focusout(function() {
					this.value = this.value.toUpperCase();
				   var kd=$('#txtRekTab').val();
				   kd=kd.trim();
				   if (kd!=''){
					 //  alert(kd);
				   	$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",
							{
								'norek' : kd
							},
							function(data){
								if(data.baris==1){
									var saldo=number_format(data.SALDO_AKHIR,2);
									var setor_min=number_format(data.SETORAN_MINIMUM,2);
									var saldo_blk=number_format(data.SALDO_BLOKIR,2);
									var	saldo_min=number_format(data.MINIMUM_DEFAULT,2);
									var saldo_dpt_tarik=(data.SALDO_AKHIR)-(data.SETORAN_MINIMUM);
									var saldo_dpt_tarik=number_format(saldo_dpt_tarik,2);
									//txtSaldoDptTarik
									$('#txtNama').val(data.NAMA_NASABAH);
									$('#txtNasabahID').val(data.NASABAH_ID);
									$('#txtAlamat').val(data.ALAMAT);
									$('#txtSaldoBTrans').val(saldo);
									$('#txtSaldoATrans').val(setor_min);
									$('#txtSaldoMin').val(saldo_min);
									$('#txtSetorNormal').val(saldo_blk);
									$('#txtJenisSimp').val(data.DESKRIPSI_JENIS_TABUNGAN);
									
									$('#txtSaldoDptTarik').val(saldo_dpt_tarik);
									var kode_trans= $("#txtTypeTrans").val();
									if(kode_trans=='K'){
										$('#txtSaldoStlh').val(saldo);
									}else{
										$('#txtSaldoStlh').val(saldo_dpt_tarik);
									}
									var tanggal=(data.TGL_TRANS_TERAKHIR);
									var t=moment(tanggal).format('YYYY-MM-DD');
									
									var dt=DateDiff(new Date(t), new Date(tgl_akhir)) ;
									if(dt>bln){
										$("#lblStatus").show();
										$("#lblStatus").text("PASIF");
									}else{
										$("#lblStatus").show();
										$("#lblStatus").text("AKTIF");
									}
									var k= "<?php echo $f; ?>";
									var c="<?php echo $count+1; ?>";
									$("#txtcounter").val(c);
									$("#txtKuitansi").val(k);
									//$('#cari_rek').modal('hide');
									$('#txtJml').val('');
									$('#txtJml').focus();
									//proses();
								}else{
									 $.messager.alert('Perhatian','Data tidak ditemukan!');
									  $('.bersih').val('');
									  $('.nomor').val('0.00');
									  $('#txtJml').val(number_format(0,2));
									  $('#txtcounter').val('');
									  $('#txtRekTab').focus();
								}
							},"json");
				   }//if kd<>''
		
				});
				
			}); //end ready document
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