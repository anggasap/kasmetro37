<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	foreach($counter->result() as $row){
		$count= $row->CounterNo;
		$pecah=explode(";",$row->StructuredNo);
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
?>
<div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> <?php echo $judul; ?>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form id="id_form_pindahbuku" role="form" method="post">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<h4>Rekening Asal</h4>
                            <div class="form-body">
                            	<div class="form-group">
                                    <label>Tanggal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <?php echo form_input(array('name'=>'txtTGlTrans','class'=>'form-control','id'=>'txtTglTrans','value'=>$this->session->userdata('tglD'),'readonly'=>'true'));?>
                                        <?php echo  form_input(array('name'=>'txtcounter','class'=>'span1 bersih hidden','type'=>'hidden','id'=>'txtcounter'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No rekening :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rekening" class="form-control bersih" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama nasabah :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <?php echo form_input(array('name'=>'txtNama','id'=>'txtNama','class'=>'bersih form-control','placeholder'=>'Nama nasabah','readonly'=>'true'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-home"></i>
                                        </span>
                                        <?php
                                        $data = array(
                                            'name'        => 'txtAlamat',
                                            'id'          => 'txtAlamat',
                                            'placeholder'     => 'Alamat nasabah',
                                            'rows'        => '2',
                                            'class'       => 'form-control',
                                            'readonly' =>'readonly'
                                          );
                                        echo form_textarea($data);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Saldo saat ini :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <?php echo form_input(array('name'=>'txtSaldoSaatIni','id'=>'txtSaldoSaatIni','class'=>'form-control nomor','readonly'=>'true','style'=>'text-align:right'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Saldo minimum :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <?php echo form_input(array('name'=>'txtSaldoMin','id'=>'txtSaldoMin','class'=>'form-control nomor','readonly'=>'true','style'=>'text-align:right'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kuitansi :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="txtKuitansi" name="txtKuitansi" type="text" placeholder="no kuitansi" readonly="readonly" class="form-control bersih" required="" onkeyup="ToUpper(this);">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Kode transaksi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-gears"></i>
                                                </span>
                                                <?php
												$data = array();
												foreach($kode_debet as $row){
													$data[$row['kode_trans']] = $row['DESKRIPSI_TRANS'];
												}
												
												echo form_dropdown('DL_kodetrans1', $data,$kd1,'id="DL_kodetrans1" class="form-control"');
												
												?>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-1">
                                            <label>&nbsp;</label>
                                            <div class="input-group">
                                                <input id="txtJenisTrans" name="txtJenisTrans" type="text" class="form-control" readonly="readonly"> 
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <?php echo form_input(array('name'=>'txtJml','style' =>'text-align:right;','id'=>'txtJml','required'=>'required','class'=>'form-control nomor')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="terbilang" style="color: red"></label>
                                </div>
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <div class="form-body">
                            	<h4>Rekening Tujuan</h4>
                            	<div class="form-group">
                                    <label>No rekening tujuan :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="txtRekTujuan" name="txtRekTujuan" type="text" placeholder="No rek tabungan" class="form-control bersih" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="txtNamaTujuan" name="txtNamaTujuan" type="text" placeholder="nama nasabah" required="" disabled="" class="form-control bersih">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Saldo tabungan :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="txtSaldoTabTujuan" name="txtSaldoTabTujuan" type="text" class="form-control nomor" required="" style="text-align:right;" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Saldo minimum :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="txtSaldoMinTujuan" name="txtSaldoMinTujuan" type="text" class="form-control nomor" required="" style="text-align:right;" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Kode transaksi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-gears"></i>
                                                </span>
                                                <?php
												$data = array();
												foreach($kode_kredit as $row)
												{
													$data[$row['kode_trans']] = $row['DESKRIPSI_TRANS'];
												}
												echo form_dropdown('DL_kodetrans2', $data,$kd2,'id="DL_kodetrans2" class="form-control"');
												//echo form_input(array('name'=>'txtDeskripTrans2','style'=>'width:165px;','id'=>'txtDeskripTrans2','readonly'=>'true'));
												?>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-1">
                                            <label>&nbsp;</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name'=>'txtJenisTrans2','id'=>'txtJenisTrans2','readonly'=>'true','class'=>'form-control')); ?> 
                                            </div>                                   
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label>Keterangan :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-list"></i>
                                        </span>
                                        <?php
                                        $data = array(
                                            'name'        => 'txtKet',
                                            'id'          => 'txtKet',
                                            'placeholder'     => 'Keterangan',
                                            'rows'        => '2',
                                            'class'       => 'form-control bersih'
                                          );
                                        echo form_textarea($data);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="txtModal" name="txtModal" type="text" class="input-mini bersih " >
                                    <input id="txtKdPerk" name="txtKdPerk" type="text" class="input-mini bersih">
                                    <input id="txtKdPerk2" name="txtKdPerk2" type="text" class="input-mini bersih">
                                    <input id="txtNasabahID" name="txtNasabahID" type="text" class=" input-mini bersih " >
                                    <input id="txtNasabahID2" name="txtNasabahID2" type="text" class=" input-mini bersih " >
                                    <input type="text" id="txtsaldosetor" name="txtsaldosetor" class="input-mini bersih " />
                                    <input type="text" id="txtsaldotarik" name="txtsaldotarik" class="input-mini bersih " />
                                    <input type="text" id="txtsaldosetor2" name="txtsaldosetor2" class="input-mini bersih " />
                                    <input type="text" id="txtsaldotarik2" name="txtsaldotarik2" class="input-mini bersih " />
                                    <?php echo form_input(array('name'=>'txtTransID','id'=>'txtTransID','class'=>'input-mini','value'=>''));?>
                                </div>   
                                
                            </div>
                            <!-- END FORM BODY-->
                        </div>    
                    </div>
                    <!-- END DIV CLASS ROW FOR SIZE 6 -->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" id="btnSimpan"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>               
       					<a class="btn green" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi">
                        	<span class="glyphicon glyphicon-print"></span> Validasi
                        </a>
       					<a class="btn red" id="btnReset" name="btnReset" onclick="confirm_reset();">
       						<span class="glyphicon glyphicon-repeat"></span>  Reset
       					</a>
       					<a class="btn yellow" onclick="cetak_kuitansi();" id="btnCetak_kuitansi" name="btnCetak_kuitansi">
                        	<span class="glyphicon glyphicon-print"></span> Kuitansi
                        </a>
                    </div>
            	</form>    
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php //echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php //echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>"
        type="text/javascript"></script>
<script
    src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>"
    type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN DATATABLE PLUGINS -->
<script src="<?php echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"
        type="text/javascript"></script>
<!-- END DATATABLE PLUGINS -->
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>

<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
<script>

    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Demo.init(); // init demo features
    });
</script>
<script>
// MENU OPEN
	$(".menu_root").removeClass('start active open');
	$("#menu_root_3").addClass('start active open');
	// END MENU OPEN

//alert("y");
</script>
<script type="text/javascript">

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
					//$('#btnSimpan').hide();
					alert('Transaksi setoran telah tersimpan!');
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
				  alert('Jumlah setoran tidak boleh 0 !');
				  return false;
			  }else if(jml_bayar>saldo_saat_ini){
				  alert('Jumlah penarikan lebih besar dari saldo!');
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
				//$('#txtDeskripTrans1').val(data.deskripsitrans);
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
					alert('Data tidak ditemukan!');
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
					alert('Data tidak ditemukan!');
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
		var r =confirm('Reset formulir ?');
				if (r){
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtRekTab').focus();
				}
	}
	$(document).ajaxStart(function() {
		$('.modal_json').fadeIn('fast');
	  }).ajaxStop(function() {
		$('.modal_json').fadeOut('fast');
	});
	$(document).ready(function(){
		$('#txtRekTab').focus();
		$('.nomor').val('0.00');
		//$("#txtDeskripTrans1").val("Pemindabukuan Debet");
		//$("#txtDeskripTrans2").val("Pemindabukuan Kredit");
		$("#txtJenisTrans").val("O");
		$("#txtJenisTrans2").val("O");
		
		var gl1="<?php echo $gl1; ?>";
		var gl2="<?php echo $gl2; ?>";
		$("#txtKdPerk").val(gl1);
		$("#txtKdPerk2").val(gl2);
		
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