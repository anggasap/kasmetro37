	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<legend >&nbsp;<?php echo $judul; 
	
	//echo $ada_memcached;
	//print_r ($data_nasabah);
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
		$attributes = array('id' => 'formdeposito');
		echo form_open('master_deposito_c/buat_baru', $attributes);
	?>
   <div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <div class="row-fluid"><!-- row fluid kecil -->
          <div class="span6" style="padding-left:5px;"><!-- span 6 1-->
          	<div class="row-fluid" >
                  <div class="span5">
                  <label>Jenis </label>
                  <?php
                  $data = array(
				  $data['']=''
                      );
                      foreach($jenis_dep as $row) : 
                              $data[$row['KODE_JENIS_DEPOSITO']] = $row['DESKRIPSI_JENIS_DEPOSITO'];
                      endforeach; 
                      echo form_dropdown('DL_jenis_dep', $data,'','id="DL_jenis_dep" required="required"');
                  ?>
                  </div>
                  <div class="span4">
                      <label>Tipe Deposito</label>
                      <select name="DL_tipe_dep" id="DL_tipe_dep" style="width:120px;">
                      <option value="1" selected="selected">DEPOSITO</option>
                      <option value="2">AB-PASIVA</option>
                      <option value="3">AB-AKTIVA</option>
                      </select>	
                  </div>
                  <div class="span3">
                  <label>Status</label>
                  <select name="DL_status_dep" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;"  style="width:80px;">
                      <option value="1" selected="selected">Baru</option>
                      <option value="2">Aktif</option>
                      <option value="3">Tutup</option>
                  </select>	
                  </div>
			</div> 
            <div class="row-fluid" >
                  <div class="span6">
                  <label>No Rekening</label>
                  <?php echo  form_input(array('name'=>'txtNoRekDep','class'=>'bersih span11','id'=>'txtNoRekDep','required'=>'required'));?>	
                  </div>
                  <div class="span6">
                  <label>No Bilyet</label>
                  <?php echo  form_input(array('name'=>'txtNoBilyet','class'=>'bersih span11','id'=>'txtNoBilyet'));?>	
                  </div>
		    </div>
            <div class="row-fluid span6"><!-- start <div class="row-fluid span6"> -->
                <div class="row-fluid">
                      <div class="span7">
                        <div class="input-append">
                        <?php echo  form_input(array('name'=>'txtNasabahId','class'=>'bersih span11 appendedInputButtons','id'=>'txtNasabahId','placeholder'=>'Nasabah/Anggota ID'));?>	
                              
                         <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#input_cari_nasabah').window('open')" id="idCmdBrowse"><i class="icon-search icon-white"></i>&nbsp;</a>     
                        </div>	
                      </div>
                      
                </div>
                <div class="row-fluid">
                      <div class="span10">
                      <?php echo  form_input(array('name'=>'txtNama','class'=>'bersih span12','id'=>'txtNama','placeholder'=>'Nama Nasabah/Anggota','readonly'=>'readonly'));?>	
                      </div>
                </div>
              </div>    <!-- end <div class="row-fluid span6"> -->
            <div class="row-fluid" >
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
		    </div>
            <div class="row-fluid" >
                    <div class="span6">
                    <label>Jumlah Deposito</label>
                    <?php echo  form_input(array('name'=>'txtJmlDep','class'=>'nomor','id'=>'txtJmlDep'));?>
                    </div>
                    <div class="span3">
                    <label>Bunga per tahun %</label>
                    <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor input-small','id'=>'txtBunga'));?>	
                    </div>
                    <div class="span3">
                    <label>PPH per bulan %</label>
                    <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor input-small','id'=>'txtPph'));?>	
                    </div>
		    </div>
            <div class="row-fluid" >
                    <div class="span3">
                    <label>Tanggal Registrasi</label>
                    <?php echo  form_input(array('name'=>'txtTglReg','class'=>'span12','id'=>'txtTglReg','value'=>$this->session->userdata('tglD')));?>
                    </div>
                    <div class="span3">
                    <center>
                    <label>Jk Waktu (Bulan)</label>
                    <?php echo  form_input(array('name'=>'txtJkWaktu','class'=>'teks-kanan span5','id'=>'txtJkWaktu','readonly'=>'readonly'));?>	
                    </center>
                    </div>
                     <div class="span3">
                    <label>Tanggal JT</label>
                    <?php echo  form_input(array('name'=>'txtTglJT','class'=>'span12','id'=>'txtTglJT','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>
                    </div>
		      </div>
              <div class="row-fluid" >
                    <div class="span4">
                    <label>Tanggal Penempatan</label>
                    <?php echo  form_input(array('name'=>'txtTglPenempatan','class'=>'bersih span12','id'=>'txtTglPenempatan','value'=>$this->session->userdata('tglD')));?>
                    </div>
                    <div class="span4">
                    <center>
                    <label>Tanggal Valuta</label>
                    <?php echo  form_input(array('name'=>'txtTglValuta','class'=>'teks-kanan span4','id'=>'txtTglValuta','readonly'=>'readonly'));?>
                    </center>
                    </div>
                    <div class="span4">
                    <label>Tipe Bunga</label>
                      <select name="DL_tipe_bunga" id="DL_tipe_bunga" style="width:120px;">
                      <option value="1" selected="selected">Reguler</option>
                      <option value="2">SBI</option>
                      </select>
                    </div>  
		      </div>
              <div class="row-fluid" >
                    <div class="span4">
                      <label class="checkbox">
                        <input type="checkbox" value="1" name="chkBungaTitipan" id="chkBungaTitipan"> Masuk ke titipan
                      </label>
                      <label class="checkbox">
                        <input type="checkbox" value="1" name="chkBungaPokok" id="chkBungaPokok"> Bunga ke pokok
                      </label>
                      <label class="checkbox">
                        <input type="checkbox" value="1" name="chkBungaTabungan" id="chkBungaTabungan"> Bunga ke tabungan
                      </label>
                    </div>
                    <div class="span4">
                      <input id="txtRekTab" name="txtRekTab" type="text" placeholder="No Rek Tabungan" class="input-large bersih">
                      <?php echo form_input(array('name'=>'txtNamaRekTab','id'=>'txtNamaRekTab','class'=>'bersih','style'=>'width:310px','placeholder'=>'Nama Nasabah','readonly'=>'true'));?>
                    </div>
		      </div>      
          </div><!-- end span 6 1-->
          <div class="span6"><!-- span 6 2-->
          	<div class="row-fluid" >
                  <div class="span6">
                  <label class="checkbox">
                      <input type="checkbox" value="1" name="chkAro"> ARO (Update tanggal registrasi & SBI) 
                    </label>
                  </div>
            </div>
            <div class="row-fluid" >
                  <div class="span6">
                  <label>Catatan</label>
                  <?php echo  form_input(array('name'=>'txtCatatan','class'=>'bersih span12','id'=>'txtCatatan'));?>
                  </div>
            </div>
            <div class="row-fluid" >
                  <div class="span6">
                  <label>Kode Group 1</label>
                  <?php
                    $data = array();
                        foreach($kode_group1 as $row) : 
                                $data[$row['KODE_GROUP1']] = $row['DESKRIPSI_GROUP1'];
                        endforeach; 
                        echo form_dropdown('DL_kodegroup1_dep', $data,'id="DL_kodegroup1_dep"');
                    ?>
                  </div>
                  <div class="span6">
                  <label>Kode Group 2</label>
                  <?php
                    $data = array();
                        foreach($kode_group2 as $row) : 
                                $data[$row['KODE_GROUP2']] = $row['DESKRIPSI_GROUP2'];
                        endforeach; 
                        echo form_dropdown('DL_kodegroup2_dep', $data,'id="DL_kodegroup2_dep"');
                    ?>
                  </div>
            </div>
            <div class="row-fluid" >
                  <div class="span6">
                  <label>Kode Group 3</label>
                  <?php
                    $data = array();
                        foreach($kode_group3 as $row) : 
                                $data[$row['KODE_GROUP3']] = $row['DESKRIPSI_GROUP3'];
                        endforeach; 
                        echo form_dropdown('DL_kodegroup3_dep', $data,'id="DL_kodegroup3_dep"');
                    ?>
                  </div>
                  <div class="span6">
                  <label>Kode Pemilik</label>
                    <?php
                    $data = array();
                        foreach($kode_pemilik as $row) : 
                                $data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
                        endforeach; 
                        echo form_dropdown('DL_kodepemilik', $data,'id="DL_kodepemilik"');
                    ?>
                  </div>
            </div>
            <div class="row-fluid">
                    <div class="span6">
                    <label>Kode Metoda</label>
                    <?php
                    $data = array();
                        foreach($kode_metoda as $row) : 
                                $data[$row['KODE_METODA']] = $row['DESKRIPSI_METODA'];
                        endforeach; 
                        echo form_dropdown('DL_kodemetoda', $data,'id="DL_kodemetoda"');
                    ?>
                    </div>
                    <div class="span6">
                    <label>Hubungan</label>
                    <?php
                    $data = array();
                        foreach($kode_hub_dep as $row) : 
                                $data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
                        endforeach; 
                        echo form_dropdown('DL_kodehub_dep', $data,'id="DL_kodehub_dep"');
                    ?>
                    </div>
              </div>
              <div class="row-fluid" style=" float:right;">
						<div class="control">
							<button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
                            <i class="icon-save"></i><span class="ladda-label"> Simpan</span></button>
                            <a class="btn btn-primary" id="btnUbah" name="btnUbah"><i class="icon-print"></i><span class="ladda-label"> Ubah</span></a>
							<a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>		
                            <a class="btn btn-warning" onclick="return confirm('Anda yakin?');" href="<?php echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>
                            </div>
			  </div>
          </div><!-- end span 6 2-->
        </div><!-- end row fluid kecil -->
      </div><!-- end span 12 -->
    </div><!-- end row fluid 12 besar -->
		
	<?php echo form_close(); ?>
    <div id="input_cari_nasabah" class="easyui-window" title="Nasabah" data-options="iconCls:'icon-save'" style="width:320px; height:120px;overflow: auto;overflow-y: auto; padding:20px;">
    	<div class="input-append">
        	<input type="text" class="appendedInputButtons"  id="txtCariNasabah" placeholder="Cari...">
            	<button class="btn btn-primary"  id="CmdCariNasabah"><i class="icon-search icon-white"></i>&nbsp;</button>>     
		</div>
    </div>
    
	<div id="cari_nasabah" class="easyui-window" title="Nasabah" data-options="iconCls:'icon-save'" style="width:800px; height:500px;overflow: auto;overflow-y: auto; padding:20px;">
    	
        <div class="form-search input-prepend">
			  <input type="text" class="" id="kwd_search" placeholder="Cari...">
		</div>
        <table class='table table-bordered table-striped' style="" id="tabel_rek">
            <thead>
                <tr>
                    <th width='15%' align='center'>
                        Nasabah Id
                    </th>
                    <th width='35%' align='center'>
                        Nama
                    </th>
                    <th width='40%' align='center'>
                        Alamat
                    </th>
                    <th width='10%' align='center'>
                        Btn
                    </th>
                </tr>
            </thead>
            <tbody id="body"></tbody>				
        </table>
	</div>
                
    
	

	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
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
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}	
			$( "#DL_jenis_dep" ).change(function() {
			 var kd=$(this).val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/master_deposito_c/desk_prod_deposito'); ?>",
					  {
						  'kd_dep' : kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtJkWaktu').val(data.JKW_DEFAULT);
							  $('#txtBunga').val(data.SUKU_BUNGA_DEFAULT);
							  $('#txtPph').val(data.PPH_DEFAULT);
							  
						  }else{
							   $.messager.alert('Perhatian','Data tidak ditemukan!');
							  /*
							   $('#txtNasabahId').val('');
							   $('#txtNama').val('');
							   $('#txtAlamat').val('');
								$('#idCmdBrowse').focus();
								*/
						  }
					  },"json");
			 }//if kd<>''
  
		  });
		  
			$( "#txtNasabahId" ).focusout(function() {
			 var kd=$('#txtNasabahId').val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/master_tabungan_c/deskripsi_nasabah'); ?>",
					  {
						  'norek' : kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtNama').val(data.NAMA_NASABAH);
							  $('#txtAlamat').val(data.ALAMAT);
							  
						  }else{
							   $.messager.alert('Perhatian','Data tidak ditemukan!');
							   $('#txtNasabahId').val('');
							   $('#txtNama').val('');
							   $('#txtAlamat').val('');
								$('#idCmdBrowse').focus();
						  }
					  },"json");
			 }//if kd<>''
  
		  });
		  $( "#txtRekTab" ).focusout(function() {
			 var kd=$('#txtRekTab').val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek_dep'); ?>",
					  {
						  'norek' : kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtNamaRekTab').val(data.NAMA_NASABAH);
						  }else{
							   $.messager.alert('Perhatian','Data tidak ditemukan!');
							   $('#txtNamaRekTab').val('');
						  }
					  },"json");
			 }//if kd<>''
  
		  });
		$(document).ready(function(){
			$("#txtRekTab").attr("disabled", "disabled");
			$('#chkBungaTabungan').change(function() {
			  if ($(this).is(':checked')) {
			  	$("#txtRekTab").removeAttr("disabled");
				$('#chkBungaTitipan').prop('checked', false);
				$('#chkBungaPokok').prop('checked', false);
			  }else{
			  	$("#txtRekTab").attr("disabled", "disabled");
			  }
			});
			$('#chkBungaPokok').change(function() {
			  if ($(this).is(':checked')) {
			  	//$("#chkBungaTitipan").attr("checked", "checked");
				//$("#chkBungaTitipan").trigger("click");
				$('#chkBungaTitipan').prop('checked', true);
				
			  }
			});
			
			$("#txtJkWaktu").val(0); 
			var tanggal_reg = $("#txtTglReg").val();
			var tgl_reg=tanggal_reg.slice(0,2);
			$("#txtTglValuta").val(tgl_reg);
			
			$("#txtTglReg").focusout(function(){
				var tanggal_reg = $(this).val();
				var tgl_reg=tanggal_reg.slice(0,2);
				$("#txtTglValuta").val(tgl_reg);
				
				var jw = $("#txtJkWaktu").val();
				jw = parseInt(jw);
				//alert(jw);
				
				var tgl=tanggal_reg.slice(0,2);
				var bln=tanggal_reg.slice(3,5);
				var thn=tanggal_reg.slice(6,11);
				var tanggal =bln+'-'+tgl+'-'+thn;// bulan tanggal tahun
				
				var tanggal_sblm = new Date(tanggal);
				var bulan = tanggal_sblm.getFullYear();
				
				tanggal_sblm.setMonth(tanggal_sblm.getMonth() + jw);
				
				tgl_stlh = tanggal_sblm.getDate();
				bln_stlh = tanggal_sblm.getMonth();
				thn_stlh = tanggal_sblm.getFullYear();
				
				bln_stlh = bln_stlh+1;
				
				tgljt =pad2(tgl_stlh)+'-'+pad2(bln_stlh)+'-'+pad2(thn_stlh);
				$("#txtTglJT").val(tgljt);
				
			});
			
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
			$('#txtNoRekTab').focus();
			$('#input_cari_nasabah').window('close');
			$('#cari_nasabah').window('close');
			
			$("#CmdCariNasabah").click(function(){
					cari_nasabah();	
			});
			$("#idCmdBrowse").click(function(){
					$('#txtCariNasabah').val('');
					$('#txtCariNasabah').focus();
			});
			
			function cari_nasabah(){
				var item = $("#txtCariNasabah").val();
				item=item.trim();
			  if (item!=''){
				$.post("<?php echo site_url('/master_tabungan_c/process_cari_nasabah'); ?>",{'item':item},
				function(data){
					$('#input_cari_nasabah').window('close');
					$('#cari_nasabah').window('open');
					$('#kwd_search').val('');
					$('#kwd_search').focus();
					$('#body').empty();
					var tr="";
					for (var i = 0; i < data.norek.length; i++) {
					
						 a=(data.norek[i].nasabah_id).trim();
						 b=(data.norek[i].nama_nasabah).trim();
						 c=(data.norek[i].alamat).trim();
						tr = '<tr>';
						tr+='<td>'+a+'</td>'+'<td>'+b+'</td>'+'<td>'+c+'</td>'+'<td><button class"btn btn-success" id="'+a+'"><i class="icon-ok"></i></button></td>';
						tr+= '</tr>';
						$('#body').append(tr);
						
						$('#'+a).click(function(){
								$('#txtCariNasabah').val('');
								$('#txtNasabahId').val($(this).attr('id'));
								$('#cari_nasabah').window('close');
								$( "#txtNasabahId" ).trigger( "focusout" );
								$('#txtJmlDep').focus();
						});
					}
				},"json");
			  }//if kd<>''
			}//function cari_nasabah(){
			
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekTab').focusout(function(){
				this.value = this.value.toUpperCase();
				//proses();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			
		
			$("#kwd_search").keyup(function(){
				var c = $("#kwd_search").val();
					if(c==""){
						//pager.showPage(1);
						$("#tabel_rek tbody>tr").show();
					}
			  		if( c != ""){//if( (c != "") && ((c.length == 4) || (c.length == 7) || (c.length > 10)) ){
			  			// Show only matching TR, hide rest of them
			  			$("#tabel_rek tbody>tr").hide();
			  			$("#tabel_rek td:contains-ci('" + $(this).val() + "')").parent("tr").show();
			  		}
			});// end $("#kwd_search").keyup(function(){
			
		});//end ready document
		
		function ajax_submit_deposito(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_deposito_c/simpan_deposito",
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
			
			$('#formdeposito').submit(function (event) {
				  dataString = $("#formdeposito").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_deposito();
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