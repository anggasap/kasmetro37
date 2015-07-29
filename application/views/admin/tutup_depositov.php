<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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
                <form id="formtutupdeposito" role="form" method="post"  action="<?php echo base_url('tutup_deposito_c/tutup_dep'); ?>">
				<!-- START DIV CLASS ROW FOR SIZE 6 -->
                	<div class="row">
                        <div class="col-md-6">
                        	<div class="form-body">
                            	<div class="form-group">
                                    <label>No rekening :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtNoRekDep','class'=>'bersih form-control','id'=>'txtNoRekDep','required'=>'required'));?>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No bilyet :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php echo  form_input(array('name'=>'txtNoBilyet','class'=>'bersih form-control','id'=>'txtNoBilyet','readonly'=>'readonly'));?>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama nasabah :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php echo  form_input(array('name'=>'txtNama','class'=>'bersih form-control','id'=>'txtNama','placeholder'=>'Nama nasabah','readonly'=>'readonly'));?>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                        <?php
										$data = array(
											'name'        => 'txtAlamat',
											'id'          => 'txtAlamat',
											'onkeyup'     => 'ToUpper(this)',
											'rows'        => '3',
											'class'		  =>'form-control bersih',
											'maxlength'	  =>'100',
											'placeholder' => 'Alamat',
											'readonly'    =>'readonly'
										  );
										echo form_textarea($data);
										?>	
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Bunga per tahun (%) :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor form-control','id'=>'txtBunga','readonly'=>'readonly'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>PPH per bulan (%) :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor form-control','id'=>'txtPph','readonly'=>'readonly'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tanggal registasi:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglReg','class'=>'form-control','id'=>'txtTglReg','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>JKW (bulan) :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtJkWaktu','class'=>'teks-kanan form-control','id'=>'txtJkWaktu','readonly'=>'readonly'));?>
                                            </div>                               
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tanggal JT :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                </span>
                                                <?php echo  form_input(array('name'=>'txtTglJT','class'=>'form-control','id'=>'txtTglJT','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                                            </div>                               
                                        </div>
                                    </div>
                                </div>
                            	
                                
                            </div>    
                        </div><!-- <div class="col-md-6"> -->
                        <div class="col-md-6">
                            <div class="form-body">
                            	<div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kode transaksi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-suitcase"></i>
                                                </span>
                                                <?php
												 foreach($kodetrans_dep_def->result() as $row){
													$kd_dep_def= $row->kode_trans;
													$gl_dep_def=$row->GL_TRANS;
													$des_dep_def=$row->DESKRIPSI_TRANS;
													$tob_dep_def=$row->TOB;
												}
												  $data = array();
												  $data[$kd_dep_def] = $des_dep_def;
												  echo form_dropdown('DL_kodetrans_dep', $data,$kd_dep_def,'id="DL_kodetrans_dep" class="form-control"');
													
												?>
												
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>&nbsp;</label>
                                           	<?php echo form_input(array('name'=>'txtJnsTransDep','id'=>'txtJnsTransDep','class'=>'form-control','readonly'=>'readonly','required'=>'required','value'=>$tob_dep_def));?>
												<?php echo form_input(array('name'=>'txtKdPerkDep','type'=>'hidden','id'=>'txtKdPerkDep','class'=>'','value'=>$gl_dep_def));?>
                                                                               
                                        </div>
                                        <div class="col-md-4">
                                            <label>Kuitansi :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                                </span>
                                                <?php
													foreach($counter->result() as $row){
														$count= $row->CounterNo;			
														$pecah=explode(";",$row->StructuredNo);
														$f=($count+1)."-".$this->session->userdata('user_id');
													}
												?>
												<?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','class'=>'','id'=>'txtcounter','value'=>''));?>
												<?php echo form_input(array('name'=>'txtKuitansi','id'=>'txtKuitansi','readonly'=>'readonly','class'=>'bersih form-control','placeholder'=>'No kuitansi'));?>
                                            </div>
                                                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah deposito:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtJmlDep','class'=>'nomor form-control','id'=>'txtJmlDep','readonly'=>'readonly'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pinalti deposito:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtPinaltiDep','class'=>'nomor form-control','id'=>'txtPinaltiDep'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Materai :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtMateraiDep','class'=>'nomor form-control','id'=>'txtMateraiDep'));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                </div>
                                <div class="form-group">
                                    <label>Total diterima :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                        </span>
                                         <?php echo  form_input(array('name'=>'txtTotalDiterima','class'=>'teks-kanan form-control','id'=>'txtTotalDiterima','readonly'=>'readonly'));?>
                                    </div>
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
	$("#menu_root_5").addClass('start active open');
	// END MENU OPEN
</script>
<script type="text/javascript">
		function confirm_reset(){
			var r = confirm('Reset formulir ??')
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$("#btnSimpan").removeAttr("disabled");
				//$('#btnSimpan').show();
				
				//check_load();
				//location.reload();
			}
		}
		function cetak_validasi(){
		  var newWindow = window.open('Validasi', '_blank');
		  var d = new Date();
		  var jam =d.getHours(); // => 9
		  var mnt =d.getMinutes(); // =>  30
		  var dtk =d.getSeconds(); // => 51
		 
		 var total_trans = $('#txtJmlDep').val();
		 var pinalti = $('#txtPinaltiDep').val();
		 var tgl_trans = $('#id_session_tgl_D').val();
		 var user =$('#id_session_user').val();
		 var kuitansi =$('#txtKuitansi').val();
		 var no_rek =$('#txtNoRekDep').val();
		 var nama = $('#txtNama').val();
		 var destranskre=$('#DL_kodetrans_dep :selected').html();
		 
	  	 var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+user+" "+kuitansi+"<br>";
		 var html2=destranskre+" "+"<br>";
		 var html3=no_rek+" "+nama+"<br>";
		 var html4=total_trans+" "+pinalti;
	  	
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .document.write(html3);
		  newWindow .document.write(html4);
		  newWindow .print();
		  newWindow .document.close();
		}
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}	
		function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
		}
		function calculateSum() {
			var JmlDep = parseFloat(CleanNumber($("#txtJmlDep").val()));
		    if (isNaN(JmlDep)) JmlDep = 0;
		    var Pinalti = parseFloat(CleanNumber($("#txtPinaltiDep").val()));
		    if (isNaN(Pinalti)) Pinalti = 0;
	      	var Materai = parseFloat(CleanNumber($("#txtMateraiDep").val()));
		    if (isNaN(Materai)) Materai = 0;
			
		    var total = JmlDep-Pinalti-Materai;
		    var total_ditutup  = number_format(total,2);
			$("#txtTotalDiterima").val(total_ditutup); 
	        
	     }
		$( "#txtNoRekDep" ).focusout(function() {
		  //this.value = this.value.toUpperCase();
		  var kd=$('#txtNoRekDep').val();
		  kd=kd.trim();
			 if (kd!=''){
			  $.post("<?php echo site_url('/tutup_deposito_c/deskripsi_norek_dep'); ?>",{
				  'norek' : kd
				  },
				  function(data){
					  if(data.baris==1){
						  $('#txtNoBilyet').val(data.NO_ALTERNATIF);
						  $('#txtNama').val(data.NAMA_NASABAH);
						  $('#txtAlamat').val(data.ALAMAT);
						  $('#txtAlamat').val(data.ALAMAT);
						  $('#txtJkWaktu').val(data.JKW);
						  $('#txtJmlDep').val(number_format(data.JML_DEPOSITO,2));
						  $('#txtBunga').val(number_format(data.SUKU_BUNGA,2));
						  $('#txtPph').val(number_format(data.PERSEN_PPH,2));
						  $('#txtTotalDiterima').val(number_format(data.JML_DEPOSITO,2));
						  tgl_reg = data.TGL_REGISTRASI;
						  var thn=tgl_reg.slice(0,4);
						  var bln=tgl_reg.slice(5,7);
						  var tgl=tgl_reg.slice(8,10);
						  var tglregistrasi=tgl+'-'+bln+'-'+thn;
						  $('#txtTglReg').val(tglregistrasi);
						  
						  tgl_jt = data.TGL_JT;
						  var thnjt=tgl_jt.slice(0,4);
						  var blnjt=tgl_jt.slice(5,7);
						  var tgljt=tgl_jt.slice(8,10);
						  var tglJT=tgljt+'-'+blnjt+'-'+thnjt;
						  $('#txtTglJT').val(tglJT);
						  
						  var k= "<?php echo $f; ?>";
						  var c="<?php echo $count+1; ?>";
						  $("#txtcounter").val(c);
						  $("#txtKuitansi").val(k);
						
						 // $('#txtKet').focus();
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
		$(document).ready(function(){
			$('#txtNoRekDep').focus();
			$('#txtJkWaktu').val(0);
			$('#txtJmlDep').val('0.00');
			$('#txtTotalDiterima').val('0.00');
			$('#txtBunga').val('0.00');
			$('#txtPph').val('0.00');
			$('.nomor').val('0.00');
			$(".nomor").focus(function(){
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
			$( "#txtPinaltiDep" ).focusout(function() {	
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
			$( "#txtMateraiDep" ).focusout(function() {	
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
		});//end ready document
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
		function ajax_submit_tutupdeposito(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>tutup_deposito_c/simpan_tutup_deposito",
				data:dataString,
		
				success:function (data) {					
					//$('#btnSimpan').hide();
					alert('Data Deposito telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){
			
			$('#formtutupdeposito').submit(function (event) {
				  dataString = $("#formtutupdeposito").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_tutupdeposito();
				  }else{//if(r)
					return false;
				  }
			}); //end  $contact form
		});
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
	</script>