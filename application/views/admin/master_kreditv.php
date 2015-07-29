<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row ">
    <!-- BEGIN TAB PORTLET-->
    <div class="portlet box blue tabbable">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Master kredit
            </div>
        </div>
        <div class="portlet-body">
        	<form id="formkredit" role="form" method="post"   action="<?php echo base_url('master_kredit_c/buat_baru'); ?>">
            <div class=" portlet-tabs">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="#portlet_tab7" data-toggle="tab">
                        Simpan </a>
                    </li>
                    <li>
                        <a href="#portlet_tab6" data-toggle="tab">
                        Rek Tabungan </a>
                    </li>
                    <li>
                        <a href="#portlet_tab5" data-toggle="tab">
                        Lap Bul & SID </a>
                    </li>
                    <li>
                        <a href="#portlet_tab4" data-toggle="tab">
                        Penjamin </a>
                    </li>
                    <li>
                        <a href="#portlet_tab3" data-toggle="tab">
                        Biaya </a>
                    </li>
                    <li>
                        <a href="#portlet_tab2" data-toggle="tab">
                        Angsuran </a>
                    </li>
                    <li class="active">
                        <a href="#portlet_tab1" data-toggle="tab">
                        Profil Kredit </a>
                    </li>
                </ul>
                <div class="tab-content">
                	<!-- START portlet_tab1-->
                    <div class="tab-pane active" id="portlet_tab1">
                        <?php include "master_kreditv_f1.inc.php"; ?>
                    </div>
                    <!-- END portlet_tab1-->
                    <!-- START portlet_tab2-->
                    <div class="tab-pane" id="portlet_tab2">
                        <?php include "master_kreditv_f2.inc.php"; ?>
                    </div>
                    <!-- END portlet_tab2-->
                    <!-- START portlet_tab3-->
                    <div class="tab-pane" id="portlet_tab3">
                        <?php  include "master_kreditv_f3.inc.php"; ?>
                    </div>
                    <!-- END portlet_tab3-->
                    <!-- START portlet_tab4-->
                    <div class="tab-pane" id="portlet_tab4">
                        <?php  include "master_kreditv_f4.inc.php"; ?>
                    </div>
                    <!-- END portlet_tab4-->
                    <!-- START portlet_tab5-->
                    <div class="tab-pane" id="portlet_tab5">
                        <?php  include "master_kreditv_f5.inc.php"; ?>
                    </div>
                    <!-- END portlet_tab5-->
                    <!-- START portlet_tab6-->
                    <div class="tab-pane" id="portlet_tab6">
                        <?php  include "master_kreditv_f6.inc.php"; ?>
                    </div>
                    <!-- END portlet_tab6-->
                    <!-- START portlet_tab7-->
                    <div class="tab-pane" id="portlet_tab7">
                    	<button type="submit" class="btn blue" id="btnSimpan" name="btnSimpan">
                       <span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
                        <a class="btn green" id="btnUbah" name="btnUbah"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                        <a class="btn btn-danger" id="btnReset" name="btnReset" onclick="confirm_reset();"><span class="glyphicon glyphicon-repeat"></span> Reset</a>		
                        <a class="btn yellow" id="btnHapus" name="btnHapus">
                        	<span class="glyphicon glyphicon-trash"></span> Hapus
                        </a>
                        
                    </div>
                    <!-- END portlet_tab7-->
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- END TAB PORTLET-->
</div>

<!-- MODAL -->
<div id="input_cari_nasabah"  class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tabel Perkiraan</h4>
            </div>
           <!-- START MODAL BODY-->
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                                <div class="input-group">
                                      <input type="text" class="form-control"  id="txtCariNasabah" placeholder="Cari...">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary"  id="CmdCariNasabah"><i class="fa fa-search"></i>&nbsp;</button> 
                                      </span>  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                      <input type="text" class="form-control" id="kwd_search" placeholder="Cari...">  
                                </div>
                            </div>
                            
                            <table class='table table-hover' style="" id="tabel_rek">
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
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn red" id="id_button_close_modal">Close</button>
               
            </div>
            
        </div>
    </div>
    
</div>
<!-- END MODAL-->


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
<script src="<?php echo base_url('bootstrap/js/moment.js') ?>"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>
// MENU OPEN
	$(".menu_root").removeClass('start active open');
	$("#menu_root_6").addClass('start active open');
	// END MENU OPEN
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features 
   //Index.init();
  // Index.initDashboardDaterange();
//   Index.initJQVMAP(); // init index page's custom scripts
  // Index.initCalendar(); // init index page's custom scripts
  // Index.initCharts(); // init index page's custom scripts
  // Index.initChat();
  // Index.initMiniCharts();
   //Index.initIntro();
//   TableManaged.init();
 //  Tasks.initDashboardWidget();

});
//alert("y");
</script>
<script type="text/javascript">
			function validatedate(inputText,vbl) {  
				var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;  
				// Match the date format through regular expression  
				if(inputText.match(dateformat)){  
				   // document.form1.text1.focus();  
					//Test which seperator is used '/' or '-'  
					var opera1 = inputText.split('/');  
					var opera2 = inputText.split('-');  
					lopera1 = opera1.length;  
					lopera2 = opera2.length;  
					// Extract the string into month, date and year  
					if (lopera1>1) {  
						//var pdate = inputText.split('/');  
						alert('Format tanggal salah!');  
						$( vbl ).focus();
						return false;
					}else if (lopera2>1){  
						var pdate = inputText.split('-');  
						var dd = parseInt(pdate[0]);  
						var mm  = parseInt(pdate[1]);  
						var yy = parseInt(pdate[2]);  
						// Create list of days of a month [assume there is no leap year by default]  
						var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
						if (mm==1 || mm>2){  
						  if (dd>ListofDays[mm-1]){  
							  alert('Format tanggal salah!');  
							  $( vbl ).focus();
							  return false;  
						  }  
						}  
						if (mm==2){  
							var lyear = false;  
							if ( (!(yy % 4) && yy % 100) || !(yy % 400)){  
								lyear = true;  
							}  
							if ((lyear==false) && (dd>=29)){  
								alert('Format tanggal salah!'); 
								$( vbl ).focus();
								return false;  
							}  
							if ((lyear==true) && (dd>29)){  
								alert('Format tanggal salah!');  
								$( vbl ).focus();
								return false;  
							}  
					   }//if (mm==2){  
					}  
					
				}else{  
					alert("Format tanggal salah!");  
					$( vbl ).focus();
					return false;  
				}  
		  }  //function validatedate(inputText)
		  
		  $( "#txtTglPkLama" ).focusout(function() {
			  var tgl = $(this).val();
			  var vbl= "#txtTglPkLama";
			  validatedate(tgl,vbl);
		  });
		  $( "#txtTglReal" ).focusout(function() {
			  var tgl = $(this).val();
			  var vbl= "#txtTglReal";
			  validatedate(tgl,vbl);
		  });
/*	
	
	var pager = new Pager('tabel_rek', 40); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
*/		function CleanNumber(value) {     
		    newValue = value.replace(/\,/g, '');
		    return newValue;
		}
		// end angga print
		function pad2(number) {
     			return (number < 10 ? '0' : '') + number
		}
		function confirm_reset(){
			var r = confirm('Reset formulir ??');
			  if (r==true){
				  
				  $('.bersih').val('');
				  $('.nomor').val('0.00');
				  $('.nomor').val('0');
				  $("#btnSimpan").removeAttr("disabled");
				  //$('#btnSimpan').show();
				  
				  //check_load();
				  //location.reload();
			  }
		}
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
								 alert('Data tidak ditemukan!');
								 $('#txtNasabahId').val('');
								 $('#txtNama').val('');
								 $('#txtAlamat').val('');
								  $('#idCmdBrowse').focus();
							}
						},"json");
			   }//if kd<>''
			});		// END $( "#txtNasabahId" ).focusout(function() {
		$(document).ready(function(){
			$( "#txtJmlKre" ).focusout(function() {
				if($(this).val()==0){
					alert("Jumlah pinjaman harus lebih besar dari 0!");
					$(this).val('');
					$(this).focus();
				}
			});
			$( "#txtNoRekTabWajib" ).focusout(function() {
				this.value = this.value.toUpperCase();
				var kd=$(this).val();
				kd=kd.trim();
				if (kd!=''){
					 //  alert(kd);
				   	$.post("<?php echo site_url('/master_kredit_c/deskripsi_tab'); ?>",
							{
								'norek' : kd
							},
							function(data){
								if(data.baris==1){
									$('#txtNamaTabWajib').val(data.NAMA_NASABAH);
									$('#txtGLTabWajib').val(data.KODE_PERK);
								}else{
									 alert('Data tidak ditemukan!');
								}
							},"json");
				   }//if kd<>''
		
			});// END $( "#txtNoRekTabWajib" ).focusout(function() {
			$( "#txtNoRekNotariel" ).focusout(function() {
				this.value = this.value.toUpperCase();
				var kd=$(this).val();
				kd=kd.trim();
				if (kd!=''){
					 //  alert(kd);
				   	$.post("<?php echo site_url('/master_kredit_c/deskripsi_tab'); ?>",
							{
								'norek' : kd
							},
							function(data){
								if(data.baris==1){
									$('#txtNamaNotariel').val(data.NAMA_NASABAH);
									$('#txtGLNotariel').val(data.KODE_PERK);
								}else{
									 alert('Data tidak ditemukan!');
								}
							},"json");
				   }//if kd<>''
		
			});// END
			$( "#txtNoRekPremi" ).focusout(function() {
				this.value = this.value.toUpperCase();
				var kd=$(this).val();
				kd=kd.trim();
				if (kd!=''){
					 //  alert(kd);
				   	$.post("<?php echo site_url('/master_kredit_c/deskripsi_tab'); ?>",
							{
								'norek' : kd
							},
							function(data){
								if(data.baris==1){
									$('#txtNamaPremi').val(data.NAMA_NASABAH);
									$('#txtGLPremi').val(data.KODE_PERK);
								}else{
									 alert('Data tidak ditemukan!');
								}
							},"json");
				   }//if kd<>''
		
			});// END	
			$("#txtBungaFlatBulan").val('0.00');
			$("#txtByProvisi").val('0.00');
			$("#txtByAdmin").val('0.00');
			$("#txtByTrans").val('0.00');
			$("#txtByProvisiPersen").focusout(function(){
				var jml_kre = $("#txtJmlKre").val();
				var persen_prov = $("#txtByProvisiPersen").val();
				var by_prov = parseFloat(CleanNumber(persen_prov)) * parseFloat(CleanNumber(jml_kre))/100;
				$("#txtByProvisi").val(number_format(by_prov,2));
			});
			$("#txtByAdminPersen").focusout(function(){
				var jml_kre = $("#txtJmlKre").val();
				var persen_adm = $("#txtByAdminPersen").val();
				var by_adm = parseFloat(CleanNumber(persen_adm)) * parseFloat(CleanNumber(jml_kre))/100;
				$("#txtByAdmin").val(number_format(by_adm,2));
			});
			$("#txtByTransPersen").focusout(function(){
				var jml_kre = $("#txtJmlKre").val();
				var persen_trans = $("#txtByTransPersen").val();
				var by_trans = parseFloat(CleanNumber(persen_trans)) * parseFloat(CleanNumber(jml_kre))/100;
				$("#txtByTrans").val(number_format(by_trans,2));
			});
			$("#txtBungaFlatTahun").focusout(function(){
				var bunga_tahun = $("#txtBungaFlatTahun").val();
				var bunga_bulan = bunga_tahun/12;
				$("#txtBungaFlatBulan").val(bunga_bulan);
				$("#txtBungaEkiv").val(bunga_tahun);// BUNGA EKIVALEN = BUNGA FLAT BULAN
			});
			$("#txtJmlAngs").focusout(function(){
				if($(this).val()==0){
					alert("Jumlah angsuran harus lebih besar dari 0!");
					$(this).val('');
					$(this).focus();
				}else{
					var jml_bln_angs =$(this).val();
					jml_bln_angs=jml_bln_angs.trim();
					
					var jw = $("#txtJmlAngs").val(); 
					jw =parseInt(jw);
					
					$("#txtJangkaWaktu").val(jw);
					
					var tgl_real = $("#txtTglReal").val();
					var tgl=tgl_real.slice(0,2);
					var bln=tgl_real.slice(3,5);
					var thn=tgl_real.slice(6,11);
					var tanggal =bln+'-'+tgl+'-'+thn;// bulan tanggal tahun
					
					var tanggal_sblm = new Date(tanggal);
					var bulan = tanggal_sblm.getFullYear();
					
					tanggal_sblm.setMonth(tanggal_sblm.getMonth() + jw);
					
					tgl_stlh = tanggal_sblm.getDate();
					bln_stlh = tanggal_sblm.getMonth();
					thn_stlh = tanggal_sblm.getFullYear();
					
					bln_stlh = bln_stlh+1;
					
					tgljt =pad2(tgl_stlh)+'-'+pad2(bln_stlh)+'-'+pad2(thn_stlh);
					$("#txtJatuhTempo").val(tgljt);
				}
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
			//untuk nasabah
			//$('#input_cari_nasabah').window('close');
			//$('#cari_nasabah').window('close');
			
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
					//$('#input_cari_nasabah').window('close');
					//$('#cari_nasabah').window('open');
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
								//$('#cari_nasabah').window('close');
								$( "#txtNasabahId" ).trigger( "focusout" );
								$('#txtPkBaru').focus();
						});
					}
				},"json");
			  }//if kd<>''
			}//function cari_nasabah(){
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
			//end nasabah
			$('#tt').tabs({
				border:false,
				onSelect:function(title){
					//alert(title+' is selected');
				}
			});
			$('#DL_jenis_kre').focus();
			
			$("#btnUbah").attr("disabled", "disabled");
			$('#txtNoRekKre').focusout(function(){
				this.value = this.value.toUpperCase();
			});
			$('#DL_jenis_tab').focus();
			$('.nomor').val('0.00');
			$('.nomor1').val('0');
			//$('#cari_rek').window('close');
		
			$("#kwd_search").keyup(function(){
				var c = $("#kwd_search").val();
					if(c==""){
						pager.showPage(1);
					}
			  		if( (c != "") && ((c.length == 4) || (c.length == 7) || (c.length > 10)) ){
			  			// Show only matching TR, hide rest of them
			  			$("#tabel_rek tbody>tr").hide();
			  			$("#tabel_rek td:contains-ci('" + $(this).val() + "')").parent("tr").show();
			  		}
			});// end $("#kwd_search").keyup(function(){
				
		});//end ready document
		function ajax_submit_kredit(){
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>master_kredit_c/simpan_kredit",
				data:dataString,
		
				success:function (data) {					
					//$('#btnSimpan').hide();
					alert('Data kredit telah tersimpan!');
					$("#btnSimpan").attr("disabled", "disabled");
				}
		
			});
			event.preventDefault();
		}
		$(function(){
			$('#formkredit').submit(function (event) {
				  dataString = $("#formkredit").serialize();
				  var r = confirm('Anda yakin menyimpan data ini?');
				  if (r== true){
					ajax_submit_kredit();
				  }else{//if(r)
					return false;
				  }
			}); //end  $contact form	
		});
		
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