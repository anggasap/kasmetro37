<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	
<div class ="form-inline ">
<?php
$attributes = array('id' => 'id_form_kasumum');
 echo form_open('kasumum/kas_umum',$attributes);?>
<legend >&nbsp;Transaksi Kas Umum</legend>
<?php if($this->session->flashdata('success') != ''){
    echo '
    <div class="row-fluid">
      <div class="alert alert-success">
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
<?php if(validation_errors()): ?>
    <div class="alert" >
      <a class="close" data-dismiss="alert" href="#" >×</a>
		<?php
		echo form_error('txtTGlTrans'); echo("&nbsp;");
		echo form_error('txtNamaJurnal');echo("&nbsp;");
		echo form_error('txtKuitansi');echo("&nbsp;");
		echo form_error('txtJml');echo("&nbsp;");
		echo form_error('txtNamaGl');
		?>
    </div>
<?php endif;?>
<?php
foreach($counter->result() as $row){
	$count= $row->CounterNo;
	/*
	$pecah=explode(";",$row->StructuredNo);
	$f1= $pecah[0];
	$f2=$pecah[1];
	$f=$f1.$f2.($count+1);
	*/
	$f=($count+1)."-".$this->session->userdata('user_id');
}
?>
<div class="span6">
<table class="">
<tr>
    <td>
    <table >
	<thead>
        <tr>
            <td class="pull-right"><?php echo form_label('Tanggal ');?></td>
            <td >&nbsp;</td> 
            <td >
            <?php echo form_input(array('name'=>'txtTGlTrans','class'=>'span2','id'=>'txtTglTrans','value'=>$this->session->userdata('tglD'),'readonly'=>'true'));?>
			<?php echo form_input(array('name'=>'txtTypetrans','class'=>'span1','readonly'=>'true','id'=>'txtTypetrans'));?>
			<?php echo form_input(array('name'=>'txtcounter','class'=>'span1 hidden','id'=>'txtcounter'));?>
            </td>
        </tr>
	</thead>
	<tbody>
        <tr>
            <td class="pull-right"><?php echo form_label('Kode Jurnal ');?></td>
            <td>&nbsp;</td>
            <td >
            <?php
			$data = array();
			foreach ($kodetrans->result_array() as $row)
				{
					$data[$row['kode_trans']] = $row['kode_trans']; 
				}  
			  echo form_dropdown('DL_kodetrans', $data,'KM','id="DL_kodetrans" class="input-small"');
			  echo "&nbsp;";
			  echo form_input(array('name'=>'txtNamaJurnal','style'=>'width:240px;','id'=>'txtNamaJurnal','readonly'=>'true'));
			 ?>
           
            </td>
        </tr>
        <tr>
            <td class="pull-right"><?php echo form_label('Kuitansi ');?></td>
            <td >&nbsp;</td>
            <td>
            <?php echo form_input(array('name'=>'txtKuitansi','style'=>'width:333px;','readonly'=>'readonly','onkeyup'=>'ToUpper(this)','id'=>'txtKuitansi','value'=>set_value('txtKuitansi')));?>
            </td>
        </tr>
	</tbody>
    </table>
    </td>
</tr>
<tr>
    <td>
        <div style ="float :left ;">
        <?php echo form_label('Uraian ');?><br />
        <?php
		$data = array(
			'name'        => 'txtUraian',
			'id'          => 'txtUraian',
			'onkeyup'     => 'ToUpper(this)',
			'rows'        => '2',
			'style'       => 'width:410px;',
		  );
		echo form_textarea($data);
		?>
        <br /><br />
        <?php echo form_label('Jumlah ');
        echo("&nbsp;");
		$data = array(
			'name'        => 'txtJml',
			'id'          => 'txtJml',
			'onkeyup'     => 'AddAndRemoveSeparator(this)',
			'style'       => 'width:200px;text-align:right;',
			'value'		  => set_value('txtJml'),
			'class'		  =>'nomor'
		  );
		echo form_input($data);
		?>
        </div>
		<span id="errmsg" style="color: red;" class="label label-error"></span>
        <br />
        &emsp;&emsp;&emsp;&nbsp;
        <label id="terbilang" style="color: red"></label>
    </td>
</tr>
<tr>
    <td>
        <div class ="pull-right" >
        <?php 
		echo form_label('Gl Balance');
		echo "&nbsp;";
		echo form_input(array('name'=>'txtKodeGL','id'=>'txtKodeGL','class'=>'input-medium','readonly'=>'true','value'=> set_value('txtKodeGL')));
		?>
        <!--
        <a class="btn btn-success" data-toggle="modal" href="#GL" >
		<i class="icon-list icon-white"></i> Browse</a>
        -->
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="$('#GL').window('open')" id="idCmdBrowse"><i class="icon-list icon-white"></i>&nbsp;Browse</a>
        <br />
        </div><br /><br />
        <?php echo form_input(array('name'=>'txtNamaGl','id'=>'txtNamaGL','style'=>'width:410px;','readonly'=>'true','value'=>set_value('txtNamaGL')));?>
    </td>
</tr>
<tr><td><hr /></td></tr>
<tr>
<td>
    <div class ="pull-left">
    	<!--
       <button type="submit" class="btn btn-success ladda-button" id="btnKuitansi" name="btnKuitansi" data-style="expand-right">
       <i class="icon-print"></i> <span class="ladda-label">Kuitansi</span>
       </button>
       -->
    </div>
    <div class ="pull-right">
       <button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right">
       <i class="icon-save"></i> <span class="ladda-label">Simpan</span>
       </button>
       <a class="btn btn-primary ladda-button" onclick="cetak_validasi();" id="btnCetak_validasi" name="btnCetak_validasi" data-style="expand-right"><i class="icon-print"></i><span class="ladda-label"> Validasi</span></a>
       <a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();">
       <i class="icon-undo"></i> Reset
       </a>
        <a class="btn btn-warning" onclick="cetak_kuitansi();" id="btnCetak_kuitansi" name="btnCetak_kuitansi"><i class="icon-print"></i>Kuitansi</a>
    </div>
</td>
</tr>
</table>
<br />
<label class="checkbox">
      <input type="checkbox" id="chkKasAwal" name="chkKasAwal"> Sebagai Kas Awal</input>
</label>
</div>

<?php echo form_close(); ?>
</div>
<div id="GL" class="easyui-window" title="GL PERKIRAAN" data-options="iconCls:'icon-save'" style="width:500px;height:580px;padding:10px;">  
		<div class="form-search input-prepend">
			  <input type="text" class="input-medium search-query" id="kwd_search" placeholder="Cari...">
			  <span class="btn">
			     <i class="icon-search"></i>&nbsp;
			  </span>
		</div>
 <table class='table table-bordered table-hover table-striped' id="tabel_perk">
 	<thead >
      <tr>
         <th width='10%' align='left'>Kd Perk</th>
         <th width='10%' align='left'>Kd Alt</th>
         <th width='60%' align='left'>Nama Perk</th>
         <th width='20%' align='center'>Type</th>
      </tr>
	</thead>
	<tbody>
	  <?php
	   foreach($perkiraan->result() as $row){
	      ?>
	      <tr>
	         <td><?php echo $row->kode_perk;?></td>
	         <td><?php echo $row->kode_alt;?></td>
	         <td><?php echo $row->nama_perk;?></td>
	     	 <td><?php echo $row->type;?></td>
	      </tr>
	      <?php
	   }
	  ?>
   </tbody>
 </table>
   <div id="pageNavPosition"></div>
</div>

<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
<script src="<?php // echo base_url('bootstrap/js/bootstrap.js') ?>"></script> 
<script src="<?php echo base_url('bootstrap/js/pagination.js') ?>"></script> 
<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script> 
<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/paging.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>

<script type="text/javascript">
	$(function() {
				$('#id_form_kasumum').submit(function (event) {
					dataString = $("#id_form_kasumum").serialize();
					var jml_bayar=$('#txtJml').val();
					var gl=$('#txtKodeGL').val();
					
					  if (jml_bayar==0){
						  //alert("Jumlah setoran tidak boleh 0 !");
						  $.messager.alert('Perhatian','Jumlah setoran tidak boleh 0!');
						  return false;
					  }/*else if(gl.trim()==''){
						  var x =$.messager.alert('Perhatian','GL Balance harus diisi!');
						  if (x){
						  	$('#GL').window('open');
						  }
						  return false;
					  }*/else{
						  $.ajax({
							  type:"POST",
							  url:"<?php echo base_url(); ?>kasumum/insert_teller",
							  data:dataString,
					  
							  success:function (data) {
								  //alert('Data tersimpan');
								  $.messager.alert('Perhatian','Transaksi kas umum tersimpan!');
								  $("#btnSimpan").attr("disabled", "disabled");
								  $("#btnSimpan").hide();
							  }
					  
						  });
						  event.preventDefault();
					  }
				  }); //end  $contact form
			
		});/// end $func
		var pager = new Pager('tabel_perk', 9); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
	$(function(){
			var tr = $('#tabel_perk').find('tr');
			tr.bind('click', function(event)
				{
					var values = '';
					var values3 = '';
					var tipe = '';
					tr.removeClass('row-highlight');
					var td1 = $(this).addClass('row-highlight').find('td:nth-child(1)');
					var td3 = $(this).addClass('row-highlight').find('td:nth-child(3)');
					var td4 = $(this).addClass('row-highlight').find('td:nth-child(4)');


					$.each(td1, function(index, item){
							values = values + item.innerHTML;
						});
					$.each(td3, function(index, item){
							values3 = values3 + item.innerHTML;
						});
					$.each(td4, function(index, item){
							tipe = tipe + item.innerHTML;
						});

					if(tipe=='G'){
						alert('Tipe Induk tidak dapat diplih');
					}
					else{
						$('#txtKodeGL').val(values);
						$('#txtNamaGL').val(values3);
						$('#GL').window('close');
					}
				});
		});
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
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
		//fungsi cetak
		function cetak_validasi(){

		  var newWindow = window.open('Validasi', '_blank');
		  var d = new Date();
		  var jam =pad2(d.getHours()); // => 9
		  var mnt =pad2(d.getMinutes()); // =>  30
		  var dtk =pad2(d.getSeconds()); // => 51
		 
		
		 var kode_trans = $('#DL_kodetrans').val();//kode trans
		 var kuitansi= $("#txtKuitansi").val();
		 var kode_gl=$("#txtKodeGL").val();
		 var jml_trans=$("#txtJml").val();
		 var tgl_trans = $('#txtTglTrans').val();
	  	 var html1='<span style="font-size: 11px;"> Kas / '+kode_trans+" "+kuitansi+" "+kode_gl+'</span><br>';
		 var html2='<span style="font-size: 11px;">'+jml_trans+" "+tgl_trans+" "+jam+":"+mnt+":"+dtk+'</span>';
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .print();
		  newWindow .document.close();
		}
		
		
		//end fungsi cetak
		function cetak_kuitansi(){
			var nominal = $('#txtJml').val();
			if(nominal=='0.00'){
				$('#terbilang').text("nol");
				
			}
			var terbilang = $('#terbilang').html();
			var newWindow = window.open('Kuitansi', '_blank');
			 
			var nama_lkm = $('#id_session_nama_lkm').val();
			var kodeperk = $('#txtKodeGL').val();
			var namaperk = $('#txtNamaGL').val();
			
			var lokasi=$('#id_session_lokasi').val();
			var tgl_trans = $('#txtTglTrans').val();
			var uraian = $("#txtUraian").text();
			//alert(terbilang);
			newWindow .document.open();
			var htm1='<table style="font-size: 11px; width:600px;">';
		    var htm2 ='<tr><td colspan="2">Bank Perkreditan Rakyat</td><td>Validasi</td></tr>';
			var htm3 ='<tr><td  colspan="2">'+nama_lkm+'</td><td>No Bukti :</td></tr>';
			var htm4 = '<tr><td colspan="3" align="center"><h4>Bukti Kas Masuk/Keluar</h4></td></tr>';
			var htm5 = '<tr><td colspan="3">Telah diterima daru : '+nama_lkm+'</td></tr>';
			var htm6 = '<tr><td colspan="3"><hr></td></tr>';
			var htm7 = '<tr><td>No Perk</td><td>Nama Perkiraan</td><td>Nominal (Rp)</td></tr>';
			var htm8 = '<tr><td colspan="3"><hr></td></tr>';
			var htm9 = '<tr><td>'+kodeperk+'</td><td>'+namaperk+'</td><td>'+nominal+'</td></tr>';
			var htm10 = '<tr><td colspan="3"><hr></td></tr>';
			var htm11 = '<tr><td colspan="3" align="right">'+nominal+'</td></tr>';
			var htm12 = '<tr><td colspan="3"><hr></td></tr>';
			var htm13 = '<tr><td colspan="2">Terbilang : '+capitalizeEachWord(terbilang)+'</td><td align="right">'+lokasi+', '+tgl_trans+'</td></tr>';
			var htm14 = '<tr><td colspan="3">Keterangan : '+uraian+'</td></tr>';
			var htm15 = '</table>';
			var html1 = htm1+htm2+htm3+htm4+htm5+htm6+htm7+htm8+htm9+htm10+htm11+htm12+htm13+htm14;
			newWindow .document.write(html1);
			newWindow .print();
			newWindow .document.close();
		}
		function confirm_reset(){
			$.messager.confirm('Konfirmasi','Reset formulir ??',function(r){
				if (r){
					$("#txtKuitansi").val("");
					$("#txtUraian").val("");
					$("#txtJml").val("");
					$("#txtKodeGL").val("");
					$("#txtNamaGL").val("");
					$("#txtcounter").val("");
					var k= "<?php echo $f; ?>";
					var c="<?php echo $count+1; ?>";
					$("#txtcounter").val(c);
					$("#txtKuitansi").val(k);
					$('#terbilang').text("");
					$("#btnSimpan").show();
					$('.nomor').val('0.00');
					$("#btnSimpan").removeAttr("disabled");
				}
			});	
		}
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
$(document).ready(function () {
	$('.nomor').val('0.00');
	$('#DL_kodetrans').focus();
	$('#GL').window('close');
	
	var kd=$('#DL_kodetrans').val();
		$.post("<?php echo site_url('/kasumum/kodejurnal'); ?>",{'kodetrans' : kd},
		function(data){
			$('#txtNamaJurnal').val(data.deskripsitrans);
			$('#txtKodeGL').val(data.gl_trans);
			$('#txtNamaGL').val(data.namaperk);
			var t=(data.typetrans);

			if(t=='K'){
				$('#txtTypetrans').val('300');
			}
			else if(t=='D'){
				$('#txtTypetrans').val('200');
			}
		},"json");
		
	$('#txtTypetrans').hide();
	$('#gl_trans').hide();

	var k= "<?php echo $f; ?>";
	var c="<?php echo $count+1; ?>";
	$("#txtcounter").val(c);
	$("#txtKuitansi").val(k);
	//$("#txtKuitansi").focus();
		
	$('#DL_kodetrans').change(function(){
	   var kd=$('#DL_kodetrans').val();
		$.post("<?php echo site_url('/kasumum/kodejurnal'); ?>",{'kodetrans' : kd},
		function(data){
			$('#txtNamaJurnal').val(data.deskripsitrans);
			$('#txtKodeGL').val(data.gl_trans);
			$('#txtNamaGL').val(data.namaperk);
			var t=(data.typetrans);

			if(t=='K'){
				$('#txtTypetrans').val('300');
			}
			else if(t=='D'){
				$('#txtTypetrans').val('200');
			}
			var k= "<?php echo $f; ?>";
			var c="<?php echo $count+1; ?>";
			$("#txtcounter").val(c);
			$("#txtKuitansi").val(k);
			$("#txtKuitansi").focus();
		},"json");
	}); 
	
	$('#txtJml').keyup(function(){
	  var val = $(this).val();
	  
	  //val=val.toFixed(2);
	  if(isNaN(val)){
		   val = val.replace(/[^0-9\.]/g,'');
		   if(val.split('.').length>2) 
			   val =val.replace(/\.+$/,"");
	  }
	  $(this).val(val); 
	  var words = toWords(val);
	  $('#terbilang').text(words);
  });
  	$('#txtJml').focusout(function(){
		var angka=$('#txtJml').val();
		if ($(this).val() == '') { 
		 	$(this).val('0.00');
	    }else{
	  		$('#txtJml').val(number_format(angka,2));
		}
	});
	$("#txtJml").focus(function(){
		$('#txtJml').val('');
		$('#txtJml').focus();
	});
	/*
	$(this).find("#kwd_search").focus();
	
	$("#idCmdBrowse").click(function()
		$("#kwd_search").focus();
		$("#kwd_search").val('');
	});
	*/
	  $("#kwd_search").keyup(function()
	  	{
	  		// When value of the input is not blank
	  		if( $(this).val() != "")
	  		{
	  			// Show only matching TR, hide rest of them
	  			$("#tabel_perk tbody>tr").hide();
	  			$("#tabel_perk td:contains-ci('" + $(this).val() + "')").parent("tr").show();
	  		}
	  		
	  	});
	/*	
	  $(".modal").on('shown', function() {
		    $(this).find("#kwd_search").focus();
			$(this).find("#kwd_search").val('');
		});
	  */    
});
  $.extend($.expr[":"],
	  {
	  "contains-ci": function(elem, i, match, array)
	  {
	  	return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	  }
	  });
</script>

</div>






