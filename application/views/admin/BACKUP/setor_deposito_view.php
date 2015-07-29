	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<legend >&nbsp;<?php echo $judul; 
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
		$attributes = array('id' => 'formsetordeposito');
		echo form_open('setor_deposito_c/setor_dep', $attributes);
	?>
  	<div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <div class="row-fluid"  style="padding:10px;"><!-- row fluid kecil -->
          <div class="span6"><!-- span 6 1-->   
          	<div class="row-fluid">
                  <div class="span6">
                  <label>No Rekening</label>
                  <?php echo  form_input(array('name'=>'txtNoRekDep','class'=>'bersih span11','id'=>'txtNoRekDep','required'=>'required'));?>	
                  </div>
                  <div class="span6">
                  <label>No Bilyet</label>
                  <?php echo  form_input(array('name'=>'txtNoBilyet','class'=>'bersih span11','id'=>'txtNoBilyet','readonly'=>'readonly'));?>	
                  </div>
		    </div>
            <div class="row-fluid">
                  <div class="span6">
                  <label></label>
                   <?php echo  form_input(array('name'=>'txtNama','class'=>'bersih span12','id'=>'txtNama','placeholder'=>'Nama Nasabah/Anggota','readonly'=>'readonly'));?>		
                  </div>
                  <div class="span6">
                  <label></label>
                 	<?php
                        $data = array(
                            'name'        => 'txtAlamat',
                            'id'          => 'txtAlamat',
                            'onkeyup'     => 'ToUpper(this)',
                            'rows'        => '3',
                            'style'       => 'width:253px',
                            'class'		  =>'span12 bersih',
                            'maxlength'	  =>'100',
                            'placeholder' => 'Alamat',
                            'readonly'    =>'readonly'
                          );
                        echo form_textarea($data);
                        ?>
                  </div>
		    </div>
              <div class="row-fluid" >
                    <div class="span6">
                    <label>Jumlah Deposito</label>
                    <?php echo  form_input(array('name'=>'txtJmlDep','class'=>'nomor','id'=>'txtJmlDep','readonly'=>'readonly'));?>
                    </div>
                    <div class="span3">
                    <label>Bunga per tahun %</label>
                    <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor input-small','id'=>'txtBunga','readonly'=>'readonly'));?>	
                    </div>
                    <div class="span3">
                    <label>PPH per bulan %</label>
                    <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor input-small','id'=>'txtPph','readonly'=>'readonly'));?>	
                    </div>
              </div>
              <div class="row-fluid" >
                    <div class="span3">
                    <label>Tanggal Registrasi</label>
                    <?php echo  form_input(array('name'=>'txtTglReg','class'=>'span12','id'=>'txtTglReg','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                    </div>
                    <div class="span3">
                    <center>
                    <label>Jk Waktu (Bulan) </label>
                    <?php echo  form_input(array('name'=>'txtJkWaktu','class'=>'teks-kanan span5','id'=>'txtJkWaktu','readonly'=>'readonly'));?>	
                    </center>
                    </div>
                     <div class="span3">
                    <label>Tanggal JT</label>
                    <?php echo  form_input(array('name'=>'txtTglJT','class'=>'span12','id'=>'txtTglJT','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                    </div>
		      </div>    
              <div class="row-fluid">
                <div class="span6">
                    <label>Kode Transaksi</label>
                     <?php
					 foreach($kodetrans_dep_def->result() as $row){
						  $kd_dep_def= $row->kode_trans;
						  $gl_dep_def=$row->GL_TRANS;
						  $des_dep_def=$row->DESKRIPSI_TRANS;
						  $tob_dep_def=$row->TOB;
					  }
						$data = array();
						$data[$kd_dep_def] = $des_dep_def;
						echo form_dropdown('DL_kodetrans_dep', $data,$kd_dep_def,'id="DL_kodetrans_dep" style="width:150px;"');
						
					?>
                    <?php echo form_input(array('name'=>'txtJnsTransDep','id'=>'txtJnsTransDep','class'=>'span2','readonly'=>'readonly','required'=>'required','value'=>$tob_dep_def));?>
                    <?php echo form_input(array('name'=>'txtKdPerkDep','type'=>'hidden','id'=>'txtKdPerkDep','class'=>'','value'=>$gl_dep_def));?>
                </div>
                <div class="span6">
                <label>Kuitansi</label>
                <?php
					foreach($counter->result() as $row){
						$count= $row->CounterNo;			
						$pecah=explode(";",$row->StructuredNo);
						$f=($count+1)."-".$this->session->userdata('user_id');
					}
				?>
                <?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','class'=>'','id'=>'txtcounter','value'=>''));?>
                <?php echo form_input(array('name'=>'txtKuitansi','id'=>'txtKuitansi','readonly'=>'readonly','class'=>'bersih','placeholder'=>'No kuitansi'));?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                
                <button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
						<i class="icon-save"></i><span class="ladda-label"> Simpan</span>
						</button>
                        <a class="btn btn-primary" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi"><i class="icon-print"></i><span class="ladda-label"> Validasi</span></a>
						<a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>
						<a class="btn btn-warning" onclick="return confirm('Anda yakin?');" 
						href="<?php echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>
                    
                </div>
            </div>
          </div><!-- end span 6 1-->
          <div class="span6"><!-- span 6 2-->
          
          </div><!-- end span 6 2-->
        </div><!-- end row fluid kecil -->
      </div><!-- end span 12 -->
    </div><!-- end row fluid 12 besar -->
		
	<?php echo form_close(); ?>
   
                
    
	

	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
    <script src="<?php //echo base_url('bootstrap/js/paging.js') ?>"></script>
    <script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script type="text/javascript">
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
		function cetak_validasi(){

		 // var newWindow = window.open("","Cetak","width=300,height=300,scrollbars=0,resizable=1")
		  var newWindow = window.open('Validasi', '_blank');
		  var d = new Date();
		  var jam =d.getHours(); // => 9
		  var mnt =d.getMinutes(); // =>  30
		  var dtk =d.getSeconds(); // => 51
		 
		 var total_trans = $('#txtJmlDep').val();
		 var tgl_trans = $('#id_session_tgl_D').val();
		 var user =$('#id_session_user').val();
		 var kuitansi =$('#txtKuitansi').val();
		 var no_rek =$('#txtNoRekDep').val();
		 var nama = $('#txtNama').val();
		 var destranskre=$('#DL_kodetrans_dep :selected').html();
		 
	  	 var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+user+" "+kuitansi+"<br>";
		 var html2=destranskre+" "+total_trans+" "+"<br>";
		 var html3=no_rek+" "+nama;
	  	
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .document.write(html3);
		  newWindow .print();
		  newWindow .document.close();
		}
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}	
			
		$(document).ready(function(){
			$('#txtNoRekDep').focus();
			$('#txtJkWaktu').val(0);
			 $('#txtJmlDep').val('0.00');
			$('#txtBunga').val('0.00');
			$('#txtPph').val('0.00');
		});//end ready document
		$( "#txtNoRekDep" ).focusout(function() {
		  //this.value = this.value.toUpperCase();
		  var kd=$('#txtNoRekDep').val();
		  kd=kd.trim();
			 if (kd!=''){
			  $.post("<?php echo site_url('/setor_deposito_c/deskripsi_norek_dep'); ?>",{
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
						   $.messager.alert('Perhatian','Data tidak ditemukan!');
							$('.bersih').val('');
							$('.nomor').val('0.00');
							$('#txtSaldoTab').val(number_format(0,2));
							$('#txtcounter').val('');
							$('#txtRekTab').focus();
					  }
				  },"json");
			 }//if kd<>''
  
		  });// END $( "#txtRekTab" ).focusout(function() {
		function ajax_submit_setordeposito(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>setor_deposito_c/simpan_setor_deposito",
				data:dataString,
		
				success:function (data) {					
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Data Deposito telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){
			
			$('#formsetordeposito').submit(function (event) {
				  dataString = $("#formsetordeposito").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_setordeposito();
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
</div>	