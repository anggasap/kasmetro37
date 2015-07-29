<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<?php
		foreach($counter->result() as $row){
			$count= $row->CounterNo;			
			$pecah=explode(";",$row->StructuredNo);
			$f=($count+1)."-".$this->session->userdata('user_id');
		}
	?>
	<legend >&nbsp;
    <?php echo $judul; ?> 
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
		 <?php 
		 $attributes = array('id' => 'id_form_tutuptabungan');
		 echo form_open('tutup_tabungan_c/tutup',$attributes);
		 ?>
     <div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <div class="row-fluid"><!-- row fluid kecil -->
          <div class="span6"  style="padding:20px;"><!-- span 6 1--> 
             <div class="row-fluid">
                <div class="span6">
                    <input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rek Tabungan" class="input-large bersih" required="">
                    <?php echo  form_input(array('name'=>'txtcounter','type'=>'hidden','class'=>'','id'=>'txtcounter','value'=>''));?>
                    
                </div>
                <div class="span6">
                    
                </div>
             </div>
             <div class="row-fluid">
                <div class="span6">
                    <?php echo form_input(array('name'=>'txtNama','id'=>'txtNama','class'=>'bersih','required'=>'required','style'=>'width:310px','placeholder'=>'Nama Nasabah','readonly'=>'true'));?>
                </div>
                <div class="span6">
                </div>
             </div>
             <div class="row-fluid">
                <div class="span6">
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
                <div class="span6">
                </div>
             </div>
             <div class="row-fluid">
             	<div class="span3 teks-kanan"><label>Saldo Tabungan</label></div>
                <div class="span3">
                <?php echo form_input(array('name'=>'txtSaldoTab','id'=>'txtSaldoTab','class'=>'nomor','required'=>'required','readonly'=>'true'));?>
                </div>
             </div>
             <div class="row-fluid">
                <div class="span6">
                    <?php echo form_input(array('name'=>'txtKuitansi','id'=>'txtKuitansi','readonly'=>'readonly','class'=>'input-small bersih','placeholder'=>'No kuitansi'));?>
                </div>
                <div class="span6">
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <label>Biaya Administrasi</label>
                    <?php echo form_input(array('name'=>'txtJmlAdm','id'=>'txtJmlAdm','class'=>'nomor','required'=>'required'));?>
                </div>
                <div class="span6">
                    <label>Kode Transaksi</label>
                     <?php
					 foreach($kodetrans_adm_tab_def->result() as $row){
						  $kd_adm_tab_def= $row->kode_trans;
						  $gl_adm_tab_def=$row->GL_TRANS;
						  $des_adm_tab_def=$row->DESKRIPSI_TRANS;
						  $tob_adm_tab_def=$row->TOB;
					  }
						$data = array();
						$data[$kd_adm_tab_def] = $des_adm_tab_def;
						echo form_dropdown('DL_kodetrans_adm', $data,$kd_adm_tab_def,'id="DL_kodetrans_adm" style="width:150px;"');
						
					?>
                    <?php echo form_input(array('name'=>'txtJnsTransAdm','id'=>'txtJnsTransAdm','class'=>'span2','readonly'=>'readonly','required'=>'required','value'=>$tob_adm_tab_def));?>
                    <?php echo form_input(array('name'=>'txtKdPerkAdm','type'=>'hidden','id'=>'txtKdPerkAdm','class'=>'','value'=>$gl_adm_tab_def));?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <label>Jumlah Pengambilan</label>
                    <?php echo form_input(array('name'=>'txtJmlAmbil','id'=>'txtJmlAmbil','class'=>'nomor','required'=>'required','readonly'=>'readonly'));?>
                </div>
                <div class="span6">
                    <label>Kode Transaksi</label>
                    <?php
					 foreach($kodetrans_tutup_tab_def->result() as $row){
						  $kd_tutup_tab_def= $row->kode_trans;
						  $gl_tutup_tab_def=$row->GL_TRANS;
						  $des_tutup_tab_def=$row->DESKRIPSI_TRANS;
						  $tob_tutup_tab_def=$row->TOB;
					  }
						$data = array();
						$data[$kd_tutup_tab_def] = $des_tutup_tab_def;
						echo form_dropdown('DL_kodetrans_tab', $data,$kd_tutup_tab_def,'id="DL_kodetrans_tab" style="width:150px;"');
					?>
                    <?php echo form_input(array('name'=>'txtJnsTransTtp','id'=>'txtJnsTransTtp','class'=>'span2','readonly'=>'readonly','required'=>'required','value'=>$tob_tutup_tab_def));?>
                     <?php echo form_input(array('name'=>'txtKdPerkTtp','type'=>'hidden','id'=>'txtKdPerkTtp','class'=>'','value'=>$gl_tutup_tab_def));?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <?php echo  form_input(array('name'=>'txtKet','class'=>'span12 bersih','id'=>'txtKet','placeholder'=>'Keterangan'));?>
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
	<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/moment.js') ?>"></script>
    <script type="text/javascript">
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
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Penutupan tabungan berhasil dilakukan!');
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
	
</div>