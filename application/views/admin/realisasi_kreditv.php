<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
	foreach($counter->result() as $row){
		$count= $row->CounterNo;
		$f=($count+1)."-".$this->session->userdata('user_id');
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
                <form id="formreal_kredit" role="form" method="post" action="<?php echo base_url('real_kredit_c/simpan_realisasi'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<!--<h4></h4>-->
                            <div class="form-body">
                            	<div class="form-group">
                                    <label>No rekening :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                        </span>
                                        <?php 
										/*TANGGAL TRANSAKSI HIDDEN*/
										echo  form_input(array('name'=>'txtTglTrans','class'=>'form-control hidden','id'=>'txtTglTrans','required'=>'required','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));
										/*END TANGGAL TRANSAKSI HIDDEN*/
										?>
                                        
                                        <?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','class'=>'hidden bersih','id'=>'txtcounter','required'=>'required'));?>
										<?php echo  form_input(array('name'=>'txtNoRekKre','class'=>'bersih form-control','id'=>'txtNoRekKre','required'=>'required'));?>
                                        <?php echo  form_input(array('name'=>'txtStatusAktif','type'=>'hidden','class'=>'bersih','id'=>'txtStatusAktif','required'=>'required'));?>
                                        <?php echo  form_input(array('name'=>'txtTypeABP','type'=>'hidden','class'=>'bersih','id'=>'txtTypeABP','required'=>'required'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama nasabah :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtNamaKre','class'=>'bersih form-control','id'=>'txtNamaKre','placeholder'=>'Nama nasabah','readonly'=>'true','required'=>'required'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah kredit :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php echo  form_input(array('name'=>'txtJmlKre','class'=>'nomor form-control','id'=>'txtJmlKre','required'=>'required','readonly'=>'true'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah bunga :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php echo  form_input(array('name'=>'txtJmlBunga','class'=>'nomor form-control','id'=>'txtJmlBunga','required'=>'required','readonly'=>'true'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tanggal realisasi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglReal','class'=>'form-control','id'=>'txtTglReal','required'=>'required','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Bunga :</label>
                                                <?php echo  form_input(array('name'=>'txtBungaPersen','class'=>'nomor form-control','id'=>'txtBungaPersen','required'=>'required','readonly'=>'readonly'));?>   %                                
                                        </div>
                                        <div class="col-md-2">
                                            <label>JKW :</label>
                                                <?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'nomor form-control','id'=>'txtJangkaWaktu','required'=>'required','readonly'=>'readonly'));?> Bulan                                   
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jatuh Tempo :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJT','class'=>'form-control','id'=>'txtJT','required'=>'required','readonly'=>'readonly','placeholder'=>'dd-mm-yyyy'));?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJenisKre','class'=>'form-control bersih','id'=>'txtJenisKre','readonly'=>'readonly'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Type :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTypeKre','class'=>'form-control bersih','id'=>'txtTypeKre','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode transaksi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
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
												  echo form_dropdown('DL_kodetrans_kre',$data,$kd_kre_def,'id="DL_kodetrans_kre" class="form-control"');
												  ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kuitansi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtKuitansi','class'=>'bersih form-control','id'=>'txtKuitansi','required'=>'required','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                            	
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <div class="form-body">
                            	<!--<h4>Rekening Tujuan</h4>-->
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Provisi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtProvisi','class'=>'nomor form-control','id'=>'txtProvisi','readonly'=>'readonly'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Notariel :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtNotariel','class'=>'nomor form-control','id'=>'txtNotariel','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Premi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtPremi','class'=>'nomor form-control','id'=>'txtPremi','readonly'=>'readonly'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Administrasi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtAdm','class'=>'nomor form-control','id'=>'txtAdm','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Materai :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtMaterai','class'=>'nomor form-control','id'=>'txtMaterai','readonly'=>'readonly'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Lain-lain :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtLain','class'=>'nomor form-control','id'=>'txtLain','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Pokok Materai :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtPkkMaterai','class'=>'nomor form-control','id'=>'txtPkkMaterai','readonly'=>'readonly'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Biaya transaksi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtByTrans','class'=>'nomor form-control','id'=>'txtByTrans','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label>Total diterima :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtTotalDiterima','class'=>'nomor form-control','id'=>'txtTotalDiterima','readonly'=>'readonly'));?>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label id="terbilang" style="color: red"></label>
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
	$("#menu_root_4").addClass('start active open');
	// END MENU OPEN
</script>
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
					alert('Data debitur kredit tidak ditemukan!');
					$('.bersih').val('');
					$('.nomor').val('0.00');
					$('#txtNoRekKre').focus();
					$("#btnSimpan").removeAttr("disabled");
				}
			},"json");
		}

		// end angga print
		function confirm_reset(){
			confirm('Reset formulir ')
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('.nomor1').val('0');
				$('#txtNoRekKre').focus();
				$("#btnSimpan").removeAttr("disabled");
				//$('#btnSimpan').show();	
				//location.reload();
			}		}
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
					alert('Realisasi kredit tersimpan.');
					 $("#btnSimpan").attr("disabled", "disabled");
					// $('#btnSimpan').hide();
				}
			});
			event.preventDefault();
		  }//function ajax_simpan_realisasi(){
			  
		$('#formreal_kredit').submit(function (event) {
			var status_aktif = $('#txtStatusAktif').val();
			dataString = $("#formreal_kredit").serialize();
			if(status_aktif != '1'){
				alert('Debitur ini sudah aktif atau sudah lunas!.');
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