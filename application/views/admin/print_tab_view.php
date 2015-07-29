	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<legend >&nbsp;<?php echo $judul; ?></legend>
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

		$attributes = array('id' => 'form_print_tab');
		echo form_open('print_tab_c/cetak_tab', $attributes);
		?>
    <div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <div class="row-fluid"><!-- row fluid kecil -->
          <div class="span6"  style="padding-left:15px;"><!-- span 6 1-->    
          	<div class="row-fluid" >
                    <div class="span6">
                    <label>Mulai tanggal</label>
                        <?php  echo  form_input(array('name'=>'txtTglMulaiC','class'=>'easyui-datebox','id'=>'txtTglMulaiC','style'=>'width:27px;'));?>
                        <br />
                        <?php  echo  form_input(array('name'=>'txtTglMulai','class'=>'','id'=>'txtTglMulai'));?>
                        <br />
                    </div>
                    <div class="span6">
                    <label>Sampai tanggal</label>
                    <?php echo  form_input(array('name'=>'txtTglSampai','class'=>'easyui-datebox','id'=>'txtTglSampai'));?>	
                    </div>
		    </div>
            &nbsp;
            <div class="row-fluid span6"><!-- start <div class="row-fluid span6"> -->
                <div class="row-fluid">
                      <div class="span7">
                      &nbsp;
                        <div class="input-append">
                        <?php echo  form_input(array('name'=>'txtNoRekTab','class'=>'bersih span11 appendedInputButtons','id'=>'txtNoRekTab','placeholder'=>'No Rek Tab'));?>	
                              
                         <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#input_cari_rektab').window('open')" id="idCmdBrowse"><i class="icon-search icon-white"></i>&nbsp;</a>     
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
                    <label>Mulai baris</label>
                    <?php echo  form_input(array('name'=>'txtBaris','class'=>'input-small','id'=>'txtBaris'));?>
                    </div>
		    </div> 
            <div class="row-fluid" >
					<div class="controls">
						<a class="btn btn-warning" id="button_cetak"><i class="icon-print"></i> Cetak</a>
					</div>
           </div>     <!-- end Button -->   
          </div><!-- end span 6 1-->
          <div class="span6"><!-- span 6 2-->
          </div><!-- end span 6 2-->
        </div><!-- end row fluid kecil -->
      </div><!-- end span 12 -->
    </div><!-- end row fluid 12 besar -->

		<?php echo form_close(); ?>
	<div id="input_cari_rektab" class="easyui-window" title="Rekening Tabungan" data-options="iconCls:'icon-save'" style="width:320px; height:120px;overflow: auto;overflow-y: auto; padding:20px;">
    	<div class="input-append">
        	<input type="text" class="appendedInputButtons"  id="txtCariRekTab" placeholder="Cari...">
            	<button class="btn btn-primary"  id="CmdCariRekTab"><i class="icon-search icon-white"></i>&nbsp;</button>>     
		</div>
    </div>
    
	<div id="cari_rektab" class="easyui-window" title="Rekening Tabungan" data-options="iconCls:'icon-save'" style="width:800px; height:500px;overflow: auto;overflow-y: auto; padding:20px;">
    	
        <div class="form-search input-prepend">
			  <input type="text" class="" id="kwd_search" placeholder="Cari...">
		</div>
        <table class='table table-bordered table-striped' style="" id="tabel_rek">
            <thead>
                <tr>
                    <th width='15%' align='center'>
                        No Rekening
                    </th>
                    <th width='35%' align='center'>
                        Nama
                    </th>
                    <th width='40%' align='center'>
                        Alamat
                    </th>
                </tr>
            </thead>
            <tbody id="body"></tbody>				
        </table>
	</div>
	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	
	
	<script type="text/javascript">
		$('#button_cetak').click( function() {
		  $norek_tab =	$('#txtNoRekTab').val();
		  $tgl_mulai =	$('#txtTglMulai').val();
		  $tgl_akhir =	$('#txtTglSampai').val();
		  $baris =	$('#txtBaris').val();
		  //$url = "/print_tab_c/coba/"+$norek_tab;
		  $url = "<?php echo site_url('/print_tab_c/tampil_trans_tab'); ?>";
		  $url = $url + "/" +$norek_tab+ "/" +$tgl_mulai+ "/" +$tgl_akhir+ "/" +$baris;
		  $(this).prop('target', '_blank'); 
		  $(this).prop('href', $url);
		});
		
		// end angga print
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
			if (r==true){
			
				location.reload();
			}
			});
		}
		
		$( "#txtNoRekTab" ).focusout(function() {
		   var kd=$('#txtNoRekTab').val();
		   kd=kd.trim();
		   if (kd!=''){
			 //  alert(kd);
			$.post("<?php echo site_url('/setor_tarik_tabungan/deskripsi_norek'); ?>",
					{
						'norek' : kd
					},
					function(data){
						if(data.baris==1){
							$('#txtNama').val(data.NAMA_NASABAH);
							$('#txtAlamat').val(data.ALAMAT);
							
						}else{
							 $.messager.alert('Perhatian','Data tidak ditemukan!');
							 $('#txtNoRekTab').val('');
							 $('#txtNama').val('');
							 $('#txtAlamat').val('');
							  $('#idCmdBrowse').focus();
						}
					},"json");
		   }//if kd<>''

		});// end $( "#txtNas
		
		$(document).ready(function(){
			$('#txtTglMulai').focus();
			$('#input_cari_rektab').window('close');
			$('#cari_rektab').window('close');
			
			$("#CmdCariRekTab").click(function(){
					cari_rektab();	
			});
			$("#idCmdBrowse").click(function(){
					$('#txtCariRekTab').val('');
					$('#txtCariRekTab').focus();
					
			});
			
			  $('#txtTglMulaiC').datebox({
			 
			 });
			
			function cari_rektab(){
				var item = $("#txtCariRekTab").val();
				item=item.trim();
			  if (item!=''){
				$.post("<?php echo site_url('/master_tabungan_c/process_cari_rektab_byname'); ?>",{'item':item},
				function(data){
					$('#input_cari_rektab').window('close');
					$('#cari_rektab').window('open');
					$('#kwd_search').val('');
					$('#kwd_search').focus();
					$('#body').empty();
					var tr="";
					for (var i = 0; i < data.norek.length; i++) {
					
						 a=(data.norek[i].no_rekening).trim();
						 b=(data.norek[i].nama_nasabah).trim();
						 c=(data.norek[i].alamat).trim();
						 
						a = a.replace("@", ".");
						// alert(a);
						tr = '<tr>';
						tr+='<td>'+a+'</td>'+'<td>'+b+'</td>'+'<td>'+c+'</td>';
						tr+= '</tr>';
						$('#body').append(tr);
						/*
						$('#'+a).click(function(){
								$('#txtCariRekTab').val('');
								$('#txtNoRekTab').val($(this).attr('id'));
								$('#cari_rektab').window('close');
								$( "#txtCariRekTab" ).trigger( "focusout" );
								//$('#txtBunga').focus();
						});
						*/
						
					}
					$('#tabel_rek tbody tr').click(function() {
						var no_rek = $(this).find("td").eq(0).html();
						var nama = $(this).find("td").eq(1).html();
						var alamat = $(this).find("td").eq(2).html();    
						$('#txtNoRekTab').val(no_rek);
					    $('#txtNama').val(nama);
					    $('#txtAlamat').val(alamat);
						$('#cari_rektab').window('close');
					});
				},"json");
			  }//if kd<>''
			}//function cari_nasabah(){
			
			$("#btnUbah").attr("disabled", "disabled");
			
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
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
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