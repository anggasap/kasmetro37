<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	<?php
		foreach($counter->result() as $row){
			$count= $row->CounterNo;
			
			$pecah=explode(";",$row->StructuredNo);
			$f1= $pecah[0];
			$f2=$pecah[1];
			$f=$f1.$f2.($count+1);
		}
		
		foreach($transid->result() as $row){
		    $t= $row->kretrans_id;
			$trans_id=$t+1;
		}
		
		foreach($kode_tab->result() as $row){
			$kd_tab= $row->kode_trans;
			$gl_tab=$row->GL_TRANS;
		}
		foreach($kode_kredit->result() as $row){
			$kd_kre= $row->kode_trans;
			$gl_kre=$row->GL_TRANS;
		}
	?>
	<legend>&nbsp;Angsuran Bunga Harian</legend>
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
		$attributes = array('id' => 'formangsur');
		echo form_open('angsur_kredit_harian/setor_pinjaman', $attributes);
	?>
    <div class="row-fluid"><!-- row fluid 12 besar -->
      <div class="span12"><!-- span 12 -->
        <div class="row-fluid"><!-- row fluid kecil -->
          <div class="span6"><!-- span 6 1-->       
    		
            <!-- kolom kiri -->
				<h5>Info Rekening</h5>
					<div class="row-fluid">
						<div class="span2 teks-kanan">No Rekening</div>
						<div class="span6 input-prepend">
							<?php echo  form_input(array('name'=>'txtRekKre','class'=>'input-medium bersih','id'=>'txtRekKre','required'=>'required','placeholder'=>'No rek pinjaman'));?>
							<span class="btn btn-primary" id="btnRekKre" ><i class="icon-search"></i>&nbsp;</span>
						</div>
							<?php echo  form_input(array('name'=>'txtNasIDKre','type'=>'hidden','class'=>'input-mini bersih hidden','id'=>'txtNasIDKre','required'=>'required'));?>
						<div class="span2">
						</div>
					</div>
					<div class="row-fluid">
						<div class="span2">&nbsp;</div>
						<div class="span5">
							<?php echo  form_input(array('name'=>'txtNamaKre','class'=>'bersih','id'=>'txtNamaKre','placeholder'=>'Nama nasabah','readonly'=>'true','required'=>'required','style'=>'width:290px;'));?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span2 teks-kanan">Tipe</div>
						<div class="span4">
							<?php echo  form_input(array('name'=>'txtTipeKredit','class'=>'input-mini bersih','id'=>'txtTipeKredit','required'=>'required','placeholder'=>'Tipe kredit','readonly'=>'true'));?>
						</div>
						<div class="span2 teks-kanan">Jml Pinjaman</div>
						<div class="span4">
							<?php echo  form_input(array('name'=>'txtJmlKredit','class'=>'nomor','id'=>'txtJmlKredit','required'=>'required','placeholder'=>'Jml kredit','readonly'=>'true','style'=>'width:120px;text-align:right'));?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span2 teks-kanan">BD - Pokok</div>
						<div class="span4">
							<?php echo  form_input(array('name'=>'txtBDpokok','class'=>'input-small nomor','id'=>'txtBDpokok','required'=>'required','readonly'=>'true','style'=>'text-align:right;width:120px'));?>
                            <?php echo  form_input(array('type'=>'hidden','name'=>'txtBDpokok_oper','class'=>'input-small nomor','id'=>'txtBDpokok_oper'));?>
						</div>
						<div class="span2 teks-kanan">BD - Bunga </div>
						<div class="span4">
							<?php echo  form_input(array('name'=>'txtBDbunga','class'=>'input-small nomor','id'=>'txtBDbunga','required'=>'required','readonly'=>'true','style'=>'text-align:right;width:120px'));?>
                            <?php echo  form_input(array('type'=>'hidden','name'=>'txtBDbunga_oper','class'=>'input-small nomor','id'=>'txtBDbunga_oper'));?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span2 teks-kanan"></div>
						
					</div>
				<br />
				<!-- Overbooking dari tabungan -->

            
          </div><!-- end span 6 1-->
          <div class="span6"  id ="statusbyr"><!-- span 6 2-->
          <!-- kolom kanan -->
				<h4>Status Pembayaran</h4>
					<div class="row-fluid">
						<div class="span2 teks-kanan" style="width:70px;">Kode Trans</div>
						<div class="span2">
							<?php
							$data = array();
							foreach($kodetrans_kre->result_array() as $row)
							{
								$data[$row['kode_trans']] = $row['kode_trans'];
							}
							echo form_dropdown('DL_kodetrans_kre', $data,$kd_kre,'id="DL_kodetrans_kre" style="width:75px"');
							?>
						</div>
						<div class="span5">
							<?php echo form_input(array('name'=>'txtDeskripTransKre','id'=>'txtDeskripTransKre','readonly'=>'true','class'=>'input-medium')); ?>
							<?php echo form_input(array('name'=>'txtJenisTransKre','style'=>'width:20px;','id'=>'txtJenisTransKre','readonly'=>'true')); ?>
							<?php echo form_input(array('type'=>'hidden','name'=>'txtGlKre','id'=>'txtGlKre','readonly'=>'true','class'=>'input-mini bersih hidden')); ?>
							<?php echo  form_input(array('type'=>'hidden','name'=>'txtcounter','class'=>'span2 bersih hidden','id'=>'txtcounter'));?>
						</div>
					</div><!-- end div baris 1 -->
					<div class="row-fluid">
						<div class="span2 teks-kanan" style="width:70px;">Cicilan ke</div>
						<div class="span1">
							<?php echo form_input(array('name'=>'txtCicilan','style'=>'width:20px;','id'=>'txtCicilan','required'=>'required')); ?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Tgl Tagihan</div>
						<div class="span2">
							<?php echo form_input(array('name'=>'txtTglTagihan','class'=>'bersih','id'=>'txtTglTagihan','readonly'=>'true','style'=>'width:80px;')); ?>
						</div>	
						<div class="span2 teks-kanan" style="width:70px;">Tgl Trans</div>
						<div class="span2">
							<?php echo form_input(array('name'=>'txtTglTrans','id'=>'txtTglTrans','readonly'=>'true','style'=>'width:80px;','value'=>$_SESSION['tglD'])); ?>
						</div>
					</div>
                    <!--Jumlah setoran-->
                    <!--
                    <div class="row-fluid">
						<div class="small-celldiv" style="text-align: right;">Jumlah Setoran</div>
						<div class="small-celldiv">
							<?php //echo  form_input(array('name'=>'txtJumlahSetoran','class'=>'input-medium nomor byr','id'=>'txtJumlahSetoran','required'=>'required','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
						
					</div>
                    -->
                    <!--end jumlah setoran-->
					<div class="row-fluid">
						<div class="span2 teks-kanan" style="width:70px;">Pokok</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAngsPokok_j','class'=>'input-small nomor byr','readonly'=>'true','id'=>'txtAngsPokok_j','required'=>'required','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Bunga</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAngsBunga_j','class'=>'input-small nomor byr','readonly'=>'true','id'=>'txtAngsBunga_j','required'=>'required','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Denda</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAngsDenda_j','class'=>'input-small nomor byr','readonly'=>'true','id'=>'txtAngsDenda_j','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
					</div>
                    <h4>Alokasi Pembayaran</h4>
					<div class="row-fluid">
						<div class="span2 teks-kanan" style="width:70px;">Pokok</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAngsPokok','class'=>'input-small nomor byr','id'=>'txtAngsPokok','required'=>'required','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Bunga</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAngsBunga','class'=>'input-small nomor byr','id'=>'txtAngsBunga','required'=>'required','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Denda</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAngsDenda','class'=>'input-small nomor byr','id'=>'txtAngsDenda','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span2 teks-kanan" style="width:70px;">&nbsp;</div>
						<div class="span2">&nbsp;</div>
						<div  class="span2 teks-kanan" style="width:70px;">Adm.</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtAdm','class'=>'input-small nomor byr','id'=>'txtAdm','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Pend Lain</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtPendLain','class'=>'input-small nomor byr','id'=>'txtPendLain','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
					</div>
	
				<!-- Kuitansi -->
               	 	<div class="row-fluid">	
                        <div  class="span2 teks-kanan" style="width:70px;">Kuitansi</div>
						<div class="span2">
							<?php echo form_input(array('name'=>'txtKuitansi','id'=>'txtKuitansi','class'=>'input-small bersih','placeholder'=>'No kuitansi'));?>
						</div>
                    </div>
					<div class="row-fluid">
						<div class="span2 teks-kanan" style="width:70px;">Jumlah</div>
						<div class="span2">
							<?php echo form_input(array('name'=>'txtTotalTrans','id'=>'txtTotalTrans','class'=>'input-small nomor','readonly'=>'true','style'=>'text-align:right'));?>
						</div>
						<div class="span2 teks-kanan" style="width:70px;">Jumlah Uang</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtJmlByr','class'=>'input-small nomor','id'=>'txtJmlByr','style'=>'text-align:right','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
						</div>
                        <div class="span2 teks-kanan" style="width:70px;">Kembali</div>
						<div class="span2">
							<?php echo  form_input(array('name'=>'txtJmlKembali','class'=>'input-small nomor','id'=>'txtJmlKembali','style'=>'text-align:right','readonly'=>'true'));?>
						</div>

					</div>
					<div class="row-fluid">
						<div  class="span2 teks-kanan">&nbsp;</div>
						<div class="span8">
							<label id="terbilang" style="color: red"></label>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span3">
							<span id="errmsg" style="color: red;" class="label label-error"></span>
						</div>
					</div>
					<div class="row-fluid">
						
						<div class="span2 teks-kanan" style="width:70px;">Keterangan</div>
						<div class="span3">
							<?php echo  form_input(array('name'=>'txtKet','class'=>'input-xlarge bersih','id'=>'txtKet','placeholder'=>'Keterangan'));?>
						</div>
					</div>
					<div class="row-fluid" style="padding-right: 32px;">
						<div class="control">
							<button type="submit" class="btn btn-success ladda-button" id="btnSimpan" name="btnSimpan" data-style="expand-right"><i class="icon-save"></i><span class="ladda-label"> Simpan</span></button>
							<a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><i class="icon-undo"></i> Reset</a>
							<a class="btn btn-primary ladda-button" onclick="popUp();" id="btnCetak" name="btnCetak" data-style="expand-right"><i class="icon-print"></i><span class="ladda-label"> Validasi</span></a>
							<a class="btn btn-warning" onclick="return confirm('Anda yakin?');" href="<?php echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>
						</div>	
					</div>
				 <!-- end kolom kanan -->

          
          </div><!-- end span 6 2-->
        </div><!-- end row fluid kecil -->
      </div><!-- end span 12 -->
    </div><!-- end row fluid 12 besar -->	
		
		<?php echo form_close(); ?>
	
		<!-- modal rekening kredit -->
	<div id="cari_rek_kre" class="modal hide " style="width:40%;" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">x</a>  
			<div class="form-search input-prepend">
			  <input type="text" class="input-medium search-query" id="kwd_search_kre">
			  <span class="btn btn-primary">
			     <i class="icon-search"></i>&nbsp;
			  </span>
			</div>
		</div>
		<div class="modal-body" style="height:500px;">
			<table class='table table-bordered table-hover table-striped' id="tabel_rek_kre">
			 	<thead>
			      <tr>
			         <th width='30%' align='left'>NO REK KREDIT</th>
			         <th width='70%' align='left'>NAMA NASABAH</th>
			      </tr>
				</thead>
				<tbody >
				  <?php
				   foreach($rekening_kredit->result() as $row)
				   {
				      ?>
				      <tr>
				         <td><?php echo $row->NO_REKENING;?></td>
				         <td><?php echo $row->nama_nasabah;?></td>
				      </tr>
				      <?php
				   }
				  ?>
			   </tbody>
		 </table>
		 
		</div>
		<div id="pageNavPosition"></div>
	</div>

	<script src="<?php echo base_url('bootstrap/js/jquery.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/pagination.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap-paginator.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/terbilang.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/select2.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/spin.min.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/ladda.min.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/prism.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/lazada-spin.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/moment.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/paging.js') ?>"></script>
	
	<script type="text/javascript">
		var pager = new Pager('tabel_rek_kre', 10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
		
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}
		//angga print
		function popUp(){

		  var newWindow = window.open('', 'Cetak','height=' + screen.height + ',width=' + screen.width + ',resizable=yes,scrollbars=yes,toolbar=yes,menubar=yes,location=yes');
		  var d = new Date();
		  var jam =pad2(d.getHours()); // => 9
		  var mnt =pad2(d.getMinutes()); // =>  30
		  var dtk =pad2(d.getSeconds()); // => 51
		 
		 var total_trans = $('#txtTotalTrans').val();
		 var tgl_trans = $('#txtTglTrans').val();
		 var user =$('#id_session_user').val();
		 var kuitansi =$('#txtKuitansi').val();
		 var no_rek =$('#txtRekKre').val();
		 var nama = $('#txtNamaKre').val();
		 var pokok = $('#txtAngsPokok').val();
		 var bunga = $('#txtAngsBunga').val();
		 var denda = $('#txtAngsDenda').val();
		 var saldo = $('#txtBDpokok').val();//baki debet
	  	 var html1=tgl_trans+" "+jam+":"+mnt+":"+dtk+" "+user+" "+kuitansi+"<br>";
		 var html2="Setoran angsuran tunai "+no_rek+" "+nama+" "+"<br>";
	  	 var html3="Pokok: "+pokok+" Bng/Mrg: "+bunga+" Denda: "+denda+"<br>";
		 var html4="Total: "+total_trans+" Saldo: "+saldo;	
		  newWindow .document.open();
		  newWindow .document.write(html1);
		  newWindow .document.write(html2);
		  newWindow .document.write(html3);
		  newWindow .document.write(html4);
		  newWindow .print();
		  newWindow .document.close();
		}	
		// end angga print
		function confirm_reset()
		{
			var r=confirm("Reset formulir ??");
			if (r==true)
			{
				$('.bersih').val('');
				$('.nomor').val('0.00');
				$('#txtRekKre').focus();
				$('input[name=chkPelunasan]').attr('checked', false);
				$('#txtCicilan').val('0');
				$('#terbilang').text("nol");
			
			}
		}
		
		function kode_kre(){
		var kd=$('#DL_kodetrans_kre').val();
		$.post("<?php echo site_url('/angsur_kredit_harian/deskripsi_trans_kredit'); ?>",
			{
				'kodetrans' : kd
			},
			function(data)
			{
				$('#txtDeskripTransKre').val(data.deskripsitrans);
				$('#txtGlKre').val(data.gl_trans);
				$('#txtJenisTransKre').val(data.tob)
			},"json");
		}
		/*
		function kode_tab(){
		var kd=$('#DL_kodetrans_tab').val();
		$.post("<?php // echo site_url('/setor_tarik_tabungan/deskripsi_trans'); ?>",
			{
				'kodetrans' : kd
			},
			function(data)
			{
				//$('#txtDeskripTransTab').val(data.deskripsitrans);
				//$('#txtGlTab').val(data.gl_trans);
				//$('#txtJenisTransTab').val(data.tob)
			},"json");
		}
		*/
//==========================ANGSURAN YANG MINUS===========================
		function tagihan(){
		var kd=$('#txtRekKre').val();
		var tgltrans=$("#txtTglTrans").val();
		var tgl=tgltrans.slice(0,2);
		var bln=tgltrans.slice(3,5);
		var thn=tgltrans.slice(6,11);
		var tglsys=thn+'-'+bln+'-'+tgl;

		$.post("<?php echo site_url('/angsur_kredit_harian/nilai_tagihan'); ?>",
			{
				'norek' : kd,
				'bln'	: bln,
				'thn'	: thn,
				'tglsys'	: tglsys
			},
			function(data){
				//var tagihan_pokok=number_format(data.pokok_angsur,0);
				var tagihan_pokok =data.pokok_angsur;
				if (tagihan_pokok<0){tagihan_pokok='0.00';}else{tagihan_pokok=number_format(tagihan_pokok,0);}
				//var tagihan_bunga=number_format(data.bunga_angsur,0);
				var tagihan_bunga =data.bunga_harian;
				if (tagihan_bunga<0){tagihan_bunga='0.00';}else{tagihan_bunga=number_format(tagihan_bunga,0);}
				
				//var	tagihan_denda=number_format(data.denda_angsur,0);
				var	tagihan_denda=data.denda_angsur;
				if (tagihan_denda<0){tagihan_denda='0.00';}else{tagihan_denda=number_format(tagihan_denda,0);}
				
				//var	tagihan_badmin=number_format(data.badmin_angsur,0);
				var	tagihan_badmin=data.badmin_angsur;
				if (tagihan_badmin<0){tagihan_badmin='0.00';}else{tagihan_badmin=number_format(tagihan_badmin,0);}
				
				//var	tagihan_padmin=number_format(data.padmin_angsur,0);
				var	tagihan_padmin=data.padmin_angsur;
				if (tagihan_padmin<0){tagihan_padmin='0.00';}else{tagihan_padmin=number_format(tagihan_padmin,0);}
				
				$('#txtAngsPokok_j').val(tagihan_pokok);
				$('#txtAngsBunga_j').val(tagihan_bunga);
				$('#txtAngsDenda_j').val(tagihan_denda);
				$('#txtAdm').val(tagihan_badmin);
				$('#txtPendLain').val(tagihan_padmin);
				
				calculateSum();
			},"json");
		}
//==========================END ANGSURAN YANG MINUS===========================			
		
		
		function cicilan(){
			
		var kd=$('#txtRekKre').val();
		var tgltrans=$("#txtTglTrans").val();
		var bln=tgltrans.slice(3,5);
		var thn=tgltrans.slice(6,11);

		$.post("<?php echo site_url('/angsur_kredit_harian/cicilan_ke'); ?>",
			{
				'norek' : kd,
				'bln'	: bln,
				'thn'	: thn,
			},
			function(data)
			{	
			var x=data.ANGSURAN_KE;
			var tgl_cicilan=data.TGL_TRANS;
			var thn=tgl_cicilan.slice(0,4);
			var bln=tgl_cicilan.slice(5,7);
			var tgl=tgl_cicilan.slice(8,10);
			var tglcicilan=tgl+'-'+bln+'-'+thn;
			
				$('#txtCicilan').val(x);
				$('#txtTglTagihan').val(tglcicilan);
				//txtTglTagihan
			},"json");
		}
		
		
		function deskrip_norek(){
		var kd=$('#txtRekKre').val();
		$.post("<?php echo site_url('/angsur_kredit_harian/deskripsi_norek_kre'); ?>",{
				'norek' : kd
			},
			function(data){
				
				var jml_kredit=number_format(data.JML_PINJAMAN,0);
				var out_pokok=number_format(data.POKOK_SALDO_AKHIR,0);
				var	out_bunga=number_format(data.BUNGA_SALDO_AKHIR,0);
				var setor_pokok=number_format(data.POKOK_SALDO_SETORAN,0);
				var	setor_bunga=number_format(data.BUNGA_SALDO_SETORAN,0);
				$('#txtNamaKre').val(data.NAMA_NASABAH);
				$('#txtNasIDKre').val(data.NASABAH_ID);
				$('#txtJmlKredit').val(jml_kredit);
				$('#txtBDpokok').val(out_pokok);
				$('#txtBDbunga').val(out_bunga);
				/*penampung operan baki debet pokok dan bunga*/
				$('#txtBDpokok_oper').val(out_pokok);
				$('#txtBDbunga_oper').val(out_bunga);
				/*end penampung operan baki debet pokok dan bunga*/
				var abp = (data.TYPE_ABP);
				if(abp==1){
					$('#txtTipeKredit').val('KREDIT');
				}
				else if(abp==2){
					$('#txtTipeKredit').val('ABP');
				}
				var k= "<?php echo $f; ?>";
				var c="<?php echo $count+1; ?>";
				$("#txtcounter").val(c);
				$("#txtKuitansi").val(k);
				$('#txtKuitansi').focus();
				
				$('#txtPokokSetoran').val(setor_pokok);
				$('#txtBungaSetoran').val(setor_bunga);
			},"json");
		}
	
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
			var AngsPokok = parseInt(CleanNumber($("#txtAngsPokok").val()));
		    if (isNaN(AngsPokok)) AngsPokok = 0;
		    var AngsBunga = parseInt(CleanNumber($("#txtAngsBunga").val()));
		    if (isNaN(AngsBunga)) AngsBunga = 0;
	      	var AngsDenda = parseInt(CleanNumber($("#txtAngsDenda").val()));
		    if (isNaN(AngsDenda)) AngsDenda = 0;
		    var Adm = parseInt(CleanNumber($("#txtAdm").val()));
		    if (isNaN(Adm)) Adm = 0;
		    var PendLain =  parseInt(CleanNumber($("#txtPendLain").val()));
		    if (isNaN(PendLain)) PendLain = 0;

		    var total = AngsPokok + AngsBunga + AngsDenda + Adm + PendLain;
		    var sum  = CommaFormatted(total); 
	        $("#txtTotalTrans").val(sum);
			if(total==0){
					$('#terbilang').text("nol");
				}
				else{
					var total = toWords(total);
			  		$('#terbilang').text(total);
				}
	    }
		
		function kembalian() {
	          var grand_total = parseInt(CleanNumber($("#txtTotalTrans").val()));
	          //if (isNaN(grand_total)) grand_total = 0;
	          var bayar = parseInt(CleanNumber($("#txtJmlByr").val()));
	         // if (isNaN(bayar)) bayar = 0;

	          var kembalian = grand_total - bayar;
	          if (parseInt(bayar) < parseInt(grand_total)) {
	               $("#txtJmlKembali").val(0);
	          }
	          else{
				var kembali=CommaFormatted(kembalian);
				 $("#txtJmlKembali").val(kembali);
				}

	      }
		  function cek_transaksi_hari_ini(){
			  var kd=$('#txtRekKre').val();
			  
			  var tgltrans=$("#txtTglTrans").val();
			  var tgl=tgltrans.slice(0,2);
			  var bln=tgltrans.slice(3,5);
			  var thn=tgltrans.slice(6,11);
			  var tglsys=thn+'-'+bln+'-'+tgl;
			  $.post("<?php echo site_url('/angsur_kredit_harian/cek_transaksi_hari_ini'); ?>",{
						  'norek' : kd,
							'tglsys'	: tglsys
			  },function(data){
					var jumlah=data.jumlah;	 
					if (jumlah>0){
						var r=alert("Hari ini sudah melakukan transaksi.");
					}
			  },"json");
		  }
		$(function() {
			//var kd=$('#txtRekKre').val();
				$('#formangsur').submit(function (event) {
					  dataString = $("#formangsur").serialize();
					  var jml_bayar=$('#txtTotalTrans').val();
					  var jml_bayar=$('#txtTotalTrans').val();
					  if (jml_bayar==0){
						  alert("Jumlah setoran tidak boleh 0 !");
						  return false;
					  }else{
						  $.ajax({
							  type:"POST",
							  url:"<?php echo base_url(); ?>angsur_kredit_harian/simpan_angsur",
							  data:dataString,
					  
							  success:function (data) {
								  alert('Data tersimpan');
							  }
					  
						  });
						  event.preventDefault();
					  }
				  }); //end  $contact form
			
		});/// end $func
		$(document).ready(function(){
			kode_kre();
			//kode_tab();
			$('.nomor').val('0.00');
			$('#txtCicilan').val('0');
			$('#terbilang').text("nol");
		
			
			$(".byr").each(function() {
	            $(this).keyup(function(){
	                calculateSum();
	            });
	        });
			
			$("#txtJmlByr").keyup(function(){
	            kembalian();
	        });
				
			//focus in textbox
			$("#txtAngsPokok").focus(function(){
				$('#txtAngsPokok').val('');
			});
			$("#txtAngsBunga").focus(function(){
				$('#txtAngsBunga').val('');
			});
			$("#txtAngsDenda").focus(function(){
				$('#txtAngsDenda').val('');
			});
			$("#txtDiscBunga").focus(function(){
				$('#txtDiscBunga').val('');
			});
			$("#txtDiscDenda").focus(function(){
				$('#txtDiscDenda').val('');
			});
			$("#txtAdm").focus(function(){
				$('#txtAdm').val('');
			});
			$("#txtPendLain").focus(function(){
				$('#txtPendLain').val('');
			});
			$("#txtJmlByr").focus(function(){
				$('#txtJmlByr').val('');
			});

			//focus out textbox
		$("#txtAngsPokok").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   calculateSum();
				}
				var AngsPokok = parseInt(CleanNumber($("#txtAngsPokok").val()));
		    	if (isNaN(AngsPokok)) AngsPokok = 0;
				var BDpokok_oper = parseInt(CleanNumber($("#txtBDpokok_oper").val()));
		    	if (isNaN(BDpokok_oper)) BDpokok_oper = 0;
				
				var saldo_BDpokok= CommaFormatted(BDpokok_oper-AngsPokok);
				$('#txtBDpokok').val(saldo_BDpokok);
			});
			$("#txtAngsBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   calculateSum();
				}
				//var BDbunga = $('#txtBDbunga').val();
				var AngsBunga = parseInt(CleanNumber($("#txtAngsBunga").val()));
		    	if (isNaN(AngsBunga)) AngsBunga = 0;
				var BDbunga_oper = parseInt(CleanNumber($("#txtBDbunga_oper").val()));
		    	if (isNaN(BDbunga_oper)) BDbunga_oper = 0;
				
				var saldo_BDbunga= CommaFormatted(BDbunga_oper-AngsBunga);
				$('#txtBDbunga').val(saldo_BDbunga);
			});
			$("#txtAngsDenda").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   calculateSum();
				}
			});
			$("#txtDiscBunga").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}
			});
			$("#txtDiscDenda").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}
			});
			$("#txtAdm").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   calculateSum();
				}
			});
			$("#txtPendLain").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   calculateSum();
				}
			});
			$("#txtJmlByr").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				}
			});
			
			$(".nomor").keypress(function (e){
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
					$("#errmsg").html("Digits Only").show().fadeOut("slow");
					return false;
				}
			});
	
			$('#DL_kodetrans_kre').change(function(){
				kode_kre();
			});
			/*
			$('#DL_kodetrans_tab').change(function(){
				kode_tab();
			});
			
			$("#btnRekTab").click(function(event){
			  	$("#cari_rek_tab").modal('show');
			});
			
			$(".modal").on('shown', function() {
			    $(this).find("#kwd_search_kre").focus();
				$(this).find("#kwd_search_kre").val('');
				
				
				$(this).find("#kwd_search_tab").focus();
				$(this).find("#kwd_search_tab").val('');
				
			});
			*/
			$("#btnRekKre").click(function(event){
				$("#cari_rek_kre").modal('show');
			});
			
			$("#kwd_search_kre").keyup(function(){
		  		if( $(this).val() != "")
		  		{
		  			$("#tabel_rek_kre tbody>tr").hide();
		  			$("#tabel_rek_kre td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		  		}
		  	});
			
			$("#kwd_search_tab").keyup(function(){
		  		if( $(this).val() != "")
		  		{
		  			$("#tabel_rek_tab tbody>tr").hide();
		  			$("#tabel_rek_tab td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		  		}
		  	});
			
			var tr = $('#tabel_rek_kre').find('tr');
			tr.bind('click', function(event){
				var norek = '';
				var nama = '';
				
				tr.removeClass('row-highlight');
				var td1 = $(this).addClass('row-highlight').find('td:nth-child(1)');
				var td2 = $(this).addClass('row-highlight').find('td:nth-child(2)');

				$.each(td1, function(index, item)
					{
						norek = norek + item.innerHTML;
					});
				$.each(td2, function(index, item)
					{
						nama = nama + item.innerHTML;
					});
				
				$('#txtRekKre').val(norek);
				$('#txtNamaKre').val(nama);
				$('#cari_rek_kre').modal('hide');
				
				deskrip_norek();
				tagihan();
				cicilan();
				cek_transaksi_hari_ini();
			});
//edit di sini			
			$( "#txtRekKre" ).focusout(function() {
				deskrip_norek();
				tagihan();
				cicilan();
				cek_transaksi_hari_ini();
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
</div>