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
		$attributes = array('id' => 'formtabungan');
		echo form_open('master_tabungan_c/buat_baru', $attributes);
	?>
    <div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <div class="row-fluid"><!-- row fluid kecil -->
          <div class="span6" style="padding-left:5px;"><!-- span 6 1-->  
          	<div class="row-fluid" >
                  <div class="span6">
                  <label>Jenis Tab</label>
                  <?php
                  $data = array(
				   $data['']=''
                      );
                      foreach($jenis_tab as $row) : 
                              $data[$row['KODE_JENIS_TABUNGAN']] = $row['DESKRIPSI_JENIS_TABUNGAN'];
                      endforeach; 
                      echo form_dropdown('DL_jenis_tab', $data,'','id="DL_jenis_tab"');
                  ?>
                  </div>
                  <div class="span6">
                  <label>Status</label>
                  <select name="DL_status_tab" onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;">
                      <option value="1" selected="selected">Baru</option>
                      <option value="2">Aktif</option>
                      <option value="3">Tutup</option>
                  </select>	
                  </div>
			</div>
            <div class="row-fluid" >
                  <div class="span6">
                  <label>No Rekening</label>
                  <?php echo  form_input(array('name'=>'txtNoRekTab','class'=>'bersih span11','id'=>'txtNoRekTab','required'=>'required'));?>	
                  </div>
                  <div class="span6">
                  <label>No Series</label>
                  <?php echo  form_input(array('name'=>'txtNoSeries','class'=>'bersih span11','id'=>'txtNoSeries'));?>	
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
                    <div class="span4">
                    <label>Bunga per tahun %</label>
                    <?php echo  form_input(array('name'=>'txtBunga','class'=>'nomor input-small','id'=>'txtBunga'));?>
                    </div>
                    <div class="span3">
                    <label>PPH per bulan %</label>
                    <?php echo  form_input(array('name'=>'txtPph','class'=>'nomor input-small','id'=>'txtPph'));?>	
                    </div>
                    <div class="span5">
                    <label>Tgl terhitung bunga</label>
                    <?php echo  form_input(array('name'=>'txtTerhitungBunga','class'=>'span6','id'=>'txtTerhitungBunga','readonly'=>'readonly','value'=>$this->session->userdata('tglD')));?>	
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
                        echo form_dropdown('DL_kodegroup1_tab', $data,'id="DL_kodegroup1_tab"');
                    ?>    
                    </div>
                    <div class="span6">
                    <label>Kode Group 2</label>
                    <?php
                    $data = array();
                        foreach($kode_group2 as $row) : 
                                $data[$row['KODE_GROUP2']] = $row['DESKRIPSI_GROUP2'];
                        endforeach; 
                        echo form_dropdown('DL_kodegroup2_tab', $data,'id="DL_kodegroup2_tab"');
                    ?>  
                    </div>
              </div>
              
              <div class="row-fluid">
                    <div class="span6">
                    <label>Kode Group 3</label>
                    <?php
                    $data = array();
                        foreach($kode_group3 as $row) : 
                                $data[$row['KODE_GROUP3']] = $row['DESKRIPSI_GROUP3'];
                        endforeach; 
                        echo form_dropdown('DL_kodegroup3_tab', $data,'id="DL_kodegroup3_tab"');
                    ?> 
                    </div>
                    <div class="span6">
                    <label>Kode Pemilik</label>
                    <?php
                    $data = array();
                        foreach($kode_gol_deb_tab as $row) : 
                                $data[$row['KODE_GOL_DEBITUR']] = $row['DESKRIPSI_GOL_DEBITUR'];
                        endforeach; 
                        echo form_dropdown('DL_kodegoldeb_tab', $data,'id="DL_kodegoldeb_tab"');
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
                        foreach($kode_hub_tab as $row) : 
                                $data[$row['KODE_HUBUNGAN']] = $row['DESKRIPSI_HUBUNGAN'];
                        endforeach; 
                        echo form_dropdown('DL_kodehub_tab', $data,'id="DL_kodehub_tab"');
                    ?>
                    </div>
              </div>
          </div><!-- end span 6 1-->
          <div class="span6"><!-- span 6 2-->
            
              <div class="row-fluid" >
                    <div class="span6">
                    <label>Restricted</label>
                    <select name="DL_restrict" id="DL_restrict"  onfocus="this.defaultIndex=this.selectedIndex;" onchange="this.selectedIndex=this.defaultIndex;">
                    <option value="UNRESTRICTED" selected="selected">UNRESTRICTED</option>
                    <option value="RESTRICTED">RESTRICTED</option>
                    </select>	
                    </div>
                    <div class="span6">
                    <label>Tipe Tabungan</label>
                    <select name="DL_tipe_tab" id="DL_tipe_tab">
                    <option value="1" selected="selected">TABUNGAN</option>
                    <option value="2">AB-PASIVA</option>
                    <option value="3">AB-AKTIVA</option>
                    <option value="4">MODAL</option>
                    <option value="5">KEWAJIBAN</option>
                    </select>	
                    </div>
		      </div>
              <div class="row-fluid" >
                    <div class="span3">
                    <label>Saldo Minimal</label>
                    <?php echo  form_input(array('name'=>'txtSaldoMin','class'=>'nomor span12','id'=>'txtSaldoMin'));?>
                    </div>
                    <div class="span3">
                    <label>Biaya Adm</label>
                    <?php echo  form_input(array('name'=>'txtBiayaAdm','class'=>'nomor span12','id'=>'txtBiayaAdm'));?>	
                    </div>
                    <div class="span4">
                    <label>&nbsp;</label>
                    <select name="DL_frek_adm" id="DL_frek_adm">
                    <option value="1"  selected="selected">Per Bulan</option>
                    <option value="2">Per 2 Bulan</option>
                    <option value="3">Per 3 Bulan</option>
                    <option value="4">Per 4 Bulan</option>
                    <option value="5">Per 5 Bulan</option>
                    <option value="6">Per 6 Bulan</option>
                    <option value="7">Per 7 Bulan</option>
                    <option value="8">Per 8 Bulan</option>
                    <option value="9">Per 9 Bulan</option>
                    <option value="10">Per 10 Bulan</option>
                    <option value="11">Per 11 Bulan</option>
                    <option value="12">Per 12 Bulan</option>
                    </select>	
                    </div>
		      </div>
              <div class="row-fluid" >
                    <div class="span3">
                    <label>Setoran Minimal</label>
                    <?php echo  form_input(array('name'=>'txtSetoranMin','class'=>'nomor span12','id'=>'txtSetoranMin'));?>
                    </div>
                    <div class="span3">
                    <label>Estimasi Bunga</label>
                    <?php echo  form_input(array('name'=>'txtEstimasiBunga','class'=>'nomor span12','id'=>'txtEstimasiBunga','readonly'=>'readonly'));?>	
                    </div>
		      </div>
              <div class="row-fluid" >
                    <div class="span3">
                    <label>Setoran Wajib</label>
                    <?php echo  form_input(array('name'=>'txtSetoranWajib','class'=>'nomor span12','id'=>'txtSetoranWajib'));?>
                    </div>
                    <div class="span3">
                    <label>Jangka Waktu</label>
                    <?php echo  form_input(array('name'=>'txtJangkaWaktu','class'=>'nomor1 span12','id'=>'txtJangkaWaktu'));?>	
                    </div>
                    <div class="span4">
                    <label>Transaksi Normal (Max)</label>
                    <?php echo  form_input(array('name'=>'txtTransaksiNormal','class'=>'nomor span12','id'=>'txtTransaksiNormal'));?>	
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
    <script src="<?php //echo base_url('bootstrap/js/paging.js') ?>"></script>
    <script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script type="text/javascript">
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
			if (r==true){
				
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$("#btnSimpan").removeAttr("disabled");
				$('#btnSimpan').show();
				//check_load();
			}
			});
		}
		$( "#DL_jenis_tab" ).change(function() {
			 var kd=$(this).val();
			 kd=kd.trim();
			 if (kd!=''){
			   //  alert(kd);
			  $.post("<?php echo site_url('/master_tabungan_c/desk_prod_tabungan'); ?>",
					  {
						  'kd_tab' : kd
					  },
					  function(data){
						  if(data.baris==1){
							  $('#txtBunga').val(number_format(data.SUKU_BUNGA_DEFAULT,2));
							  $('#txtPph').val(number_format(data.PPH_DEFAULT,2));
							  $('#txtSaldoMin').val(number_format(data.MINIMUM_DEFAULT,2));
							  $('#txtBiayaAdm').val(number_format(data.ADM_PER_BLN_DEFAULT,2));
							  $('#txtSetoranMin').val(number_format(data.SETORAN_MINIMUM_DEFAULT,2));
							  $("#DL_frek_adm").find('option').each(function( i, opt ) {
								  if( opt.value === data.PERIODE_ADM_DEFAULT ) 
									  $(opt).attr('selected', 'selected');
							  });
						  }else{
							   $.messager.alert('Perhatian','Data tidak ditemukan!');
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
		$(document).ready(function(){
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
								$('#txtBunga').focus();
						});
					}
				},"json");
			  }//if kd<>''
			}//function cari_nasabah(){
			/*
			function proses(){
				var item = '';
				
				$.post("<?php // echo site_url('/master_tabungan_c/nasabah2'); ?>",{'item':item},
				function(data){
					alert(data.norek.length);
					
				},"json");
			}
			*/
		
			
			
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekTab').focusout(function(){
				this.value = this.value.toUpperCase();
				//proses();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			$('.nomor1').val(0);
		
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
				
			$(".nomor").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$(".nomor").focus(function(){
				if (($(this).val() == '') || ($(this).val() == 0)) { 
				   $(this).val('');
				 }
					$(this).focus();
			});
			/*
			$("#txtBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtBunga").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtPph").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtPph").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtSaldoMin").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtSaldoMin").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtBiayaAdm").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtBiayaAdm").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtSetoranMin").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtSetoranMin").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtEstimasiBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtEstimasiBunga").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtSetoranWajib").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtSetoranWajib").focus(function(){
					$(this).val('');
					$(this).focus();
			});
			$("#txtTransaksiNormal").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				 }else{
					var angka = $(this).val(); 
					var result = number_format(angka,2);
					$(this).val(result);
				 }
			});
			$("#txtTransaksiNormal").focus(function(){
					$(this).val('');
					$(this).focus();
			});			
			*/
		});//end ready document
		
		function ajax_submit_tabungan(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_tabungan_c/simpan_tabungan",
				data:dataString,
		
				success:function (data) {					
					$('#btnSimpan').hide();
					$.messager.alert('Perhatian','Master tabungan telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){
			
			$('#formtabungan').submit(function (event) {
				  dataString = $("#formtabungan").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_tabungan();
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