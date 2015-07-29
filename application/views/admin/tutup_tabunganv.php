<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
foreach($counter->result() as $row){
	$count= $row->CounterNo;			
	$pecah=explode(";",$row->StructuredNo);
	$f=($count+1)."-".$this->session->userdata('user_id');
}
?>
<div class="row">
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list"></i> <?php echo $judul; ?>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="id_form_tutuptabungan" role="form" method="post">
                	<!-- START FORM BODY-->
                    <div class="form-body">
                        <div class="form-group">
                            <label>No rekening tabungan :</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rek Tabungan" class="form-control bersih" required="">
                    			<?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','id'=>'txtcounter'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama nasabah :</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo form_input(array('name'=>'txtNama','id'=>'txtNama','class'=>'form-control bersih','required'=>'required','placeholder'=>'Nama Nasabah','readonly'=>'true'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
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
                                    'class'       => 'form-control bersih',
                                    'readonly' =>'readonly'
                                  );
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Saldo tabungan :</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo form_input(array('name'=>'txtSaldoTab','id'=>'txtSaldoTab','class'=>'form-control nomor','required'=>'required','readonly'=>'true'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kuitansi :</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo form_input(array('name'=>'txtKuitansi','id'=>'txtKuitansi','readonly'=>'readonly','class'=>'form-control bersih','placeholder'=>'No kuitansi'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Biaya Administrasi  :</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo form_input(array('name'=>'txtJmlAdm','id'=>'txtJmlAdm','class'=>' form-control nomor','required'=>'required','style'=>'text-align:right;'));?>
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
										 foreach($kodetrans_adm_tab_def->result() as $row){
											  $kd_adm_tab_def= $row->kode_trans;
											  $gl_adm_tab_def=$row->GL_TRANS;
											  $des_adm_tab_def=$row->DESKRIPSI_TRANS;
											  $tob_adm_tab_def=$row->TOB;
										  }
											$data = array();
											$data[$kd_adm_tab_def] = $des_adm_tab_def;
											echo form_dropdown('DL_kodetrans_adm', $data,$kd_adm_tab_def,'id="DL_kodetrans_adm" class="form-control"');
											
										?>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <div class="input-group">
                                        <?php echo form_input(array('name'=>'txtJnsTransAdm','id'=>'txtJnsTransAdm','class'=>'form-control','readonly'=>'readonly','required'=>'required','value'=>$tob_adm_tab_def));?>
                    
										<?php echo form_input(array('name'=>'txtKdPerkAdm','type'=>'hidden','id'=>'txtKdPerkAdm','class'=>'','value'=>$gl_adm_tab_def));?> 
                                    </div>                                   
                                </div>
                            </div>
                        </div>	
                        <div class="form-group">
                            <label>Jumlah pengambilan :</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo form_input(array('name'=>'txtJmlAmbil','id'=>'txtJmlAmbil','class'=>'form-control nomor','required'=>'required','readonly'=>'readonly','style'=>'text-align:right;'));?>
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
										 foreach($kodetrans_tutup_tab_def->result() as $row){
											  $kd_tutup_tab_def= $row->kode_trans;
											  $gl_tutup_tab_def=$row->GL_TRANS;
											  $des_tutup_tab_def=$row->DESKRIPSI_TRANS;
											  $tob_tutup_tab_def=$row->TOB;
										  }
											$data = array();
											$data[$kd_tutup_tab_def] = $des_tutup_tab_def;
											echo form_dropdown('DL_kodetrans_tab', $data,$kd_tutup_tab_def,'id="DL_kodetrans_tab" class="form-control"');
										?>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <div class="input-group">
                                        <?php echo form_input(array('name'=>'txtJnsTransTtp','id'=>'txtJnsTransTtp','class'=>'form-control','readonly'=>'readonly','required'=>'required','value'=>$tob_tutup_tab_def));?>
                     					<?php echo form_input(array('name'=>'txtKdPerkTtp','type'=>'hidden','id'=>'txtKdPerkTtp','class'=>'','value'=>$gl_tutup_tab_def));?>
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
                    </div>
                    <!-- END FORM BODY-->
                    <div class="form-actions">
                        <button type="submit" class="btn blue" id="btnSimpan" name="btnSimpan"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>               
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
        <!-- END PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <!-- END PORTLET-->
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
  function confirm_reset(){
	  var r = confirm('Reset formulir ??');
	  if (r==true){
		  
		  $('.bersih').val('');
		  $('.nomor').val('0.00');
		  $('#txtRekKre').focus();
		  //$('input[name=chkPelunasan]').attr('checked', false);
		  $('#txtCicilan').val('0');
		  $('#terbilang').text("nol");
		  $("#btnSimpan").removeAttr("disabled");
		 // $('#btnSimpan').show();
		  //check_load();
		  //location.reload();
	  }
  }

  function pad2(number) {
		  return (number < 10 ? '0' : '') + number
  }
  //fungsi cetak
  function cetak_validasi(){

	var newWindow = window.open('', 'Cetak','height=' + screen.height + ',width=' + screen.width + ',resizable=yes,scrollbars=yes,toolbar=yes,menubar=yes,location=yes');
	var d = new Date();
	var jam =pad2(d.getHours()); // => 9
	var mnt =pad2(d.getMinutes()); // =>  30
	var dtk =pad2(d.getSeconds()); // => 51
   
   var no_rek = $('#txtRekTab').val();
   var nama = $('#txtNama').val();
   var jml_trans=$("#txtJmlAmbil").val();
   var jml_adm=$("#txtJmlAdm").val();
   var des_trans = $('#DL_kodetrans_tab option:selected').text();//kode trans
   var kuitansi= $("#txtKuitansi").val();
   var user=$("#id_session_user").val();
   var tgl_trans = $('#id_session_tgl_D').val();
   
   var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+user+" "+kuitansi+" "+"<br>";
   var html2=no_rek+" "+nama+" "+"<br>";
   var html3=des_trans+" : "+jml_trans+"<br>";
   var html4="Adm"+" "+jml_adm;
	newWindow .document.open();
	newWindow .document.write(html1);
	newWindow .document.write(html2);
	newWindow .document.write(html3);
	newWindow .document.write(html4);
	newWindow .print();
	newWindow .document.close();
  }
  //end fungsi cetak
	$(document).ajaxStart(function() {
		  $('.modal_json').fadeIn('fast');
		}).ajaxStop(function() {
		  $('.modal_json').fadeOut('fast');
	});
	function ajax_submit_tutuptabung(){
		$.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>tutup_tabungan_c/simpan_tutup_adm_tabungan",
			data:dataString,
	
			success:function (data) {					
				//$('#btnSimpan').hide();
				alert('Penutupan tabungan berhasil dilakukan!');
				$("#btnSimpan").attr("disabled", "disabled");
			}
	
		});
		event.preventDefault();
	}
	
	$(function(){
		$('#id_form_tutuptabungan').submit(function (event) {
			  dataString = $("#id_form_tutuptabungan").serialize();
			  var r = confirm('Anda yakin menyimpan data ini?');
			  if (r== true){
				ajax_submit_tutuptabung();
			  }else{//if(r)
				return false;
			  }
		}); //end  $contact form
	});
	
	$(document).ready(function (){
		$("#txtRekTab").focus();
		$('.nomor').val('0.00');
		//fungsi untuk kalkulasi pembayaran textbox
	function CleanNumber(value) {     
		newValue = value.replace(/\,/g, '');
		return newValue;
	}
/*
	function CommaFormatted(amount) {
		var delimiter = ",";
		var i = parseInt(amount);

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
	function calculateSum() {
		var SaldoTab = parseFloat(CleanNumber($("#txtSaldoTab").val()));
		if (isNaN(SaldoTab)) SaldoTab = 0;
		var JmlAdm = parseFloat(CleanNumber($("#txtJmlAdm").val()));
		if (isNaN(JmlAdm)) JmlAdm = 0;
		
		
		var total = SaldoTab-JmlAdm;
		var total_ditutup  = number_format(total,2);
		$("#txtJmlAmbil").val(total_ditutup); 
		
	 }
		$( "#txtRekTab" ).focusout(function() {
			this.value = this.value.toUpperCase();
			var kd=$('#txtRekTab').val();
			kd=kd.trim();
			   if (kd!=''){
				 //  alert(kd);
				$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",{
					'norek' : kd
					},
					function(data){
						if(data.baris==1){
							var saldo=number_format(data.SALDO_AKHIR,2);
							var saldo_blk=number_format(data.SALDO_BLOKIR,2);
							var adm = number_format(data.ADM_BLN_INI,2);
							var saldo_dpt_ditutup = (data.SALDO_AKHIR)-(data.ADM_BLN_INI);
							
							//txtSaldoDptTarik
							$('#txtNama').val(data.NAMA_NASABAH);
							$('#txtNasabahID').val(data.NASABAH_ID);
							$('#txtAlamat').val(data.ALAMAT);
							$('#txtSaldoTab').val(saldo);
							$('#txtJmlAdm').val(adm);
							$('#txtJmlAmbil').val(number_format(saldo_dpt_ditutup,2));
/*
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
*/								
							var k= "<?php echo $f; ?>";
							var c="<?php echo $count+1; ?>";
							$("#txtcounter").val(c);
							$("#txtKuitansi").val(k);
							$('#txtKet').focus();
						}else{
							  alert('Data tidak ditemukan!');
							  $('.bersih').val('');
							  $('.nomor').val('0.00');
							  $('#txtSaldoTab').val(number_format(0,2));
							  $('#txtcounter').val('');
							  $('#txtRekTab').focus();
						}
					},"json");
			   }//if kd<>''
	
			});// END $( "#txtRekTab" ).focusout(function() {
		$('.nomor').keyup(function(){
			var val = $(this).val();
			//val=val.toFixed(2);
			if(isNaN(val)){
				 val = val.replace(/[^0-9\.]/g,'');
				 if(val.split('.').length>2) 
					 val =val.replace(/\.+$/,"");
			}
			$(this).val(val); 
		});	// END $('.nomor').keyup(function(){	
		
		$( "#txtJmlAdm" ).focusout(function() {	
			if ($(this).val() == '') { 
			   $(this).val('0.00');
			   calculateSum();
			 }else{
				var angka = $(this).val(); 
				var result = number_format(angka,2);
				$(this).val(result);
				calculateSum();
			 }
		});
		$("#txtJmlAdm").focus(function(){
			$(this).val('');
			$(this).focus();
		});

	});	// END $(document).ready(function (){
</script>