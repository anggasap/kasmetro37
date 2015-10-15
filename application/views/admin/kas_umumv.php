<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
foreach($counter->result() as $row){
	$count= $row->CounterNo;

	$f=($count+1)."-".$this->session->userdata('user_id');
}
?>
<div class="row">
    <div class="col-md-6">
        <!-- BEGIN PORTLET-->
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list"></i> Transaksi Kas Umum
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="id_form_kasumum" role="form" method="post">
                	<!-- START FORM BODY-->
                    <div class="form-body">
                        <div class="form-group hidden">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo form_input(array('name'=>'txtTGlTrans','class'=>'form-control','id'=>'txtTglTrans','value'=>$this->session->userdata('tglD'),'readonly'=>'true'));?>
                                <?php echo form_input(array('name'=>'txtTypetrans','class'=>'span1','readonly'=>'true','id'=>'txtTypetrans'));?>
			<?php echo form_input(array('name'=>'txtcounter','class'=>'span1 hidden','id'=>'txtcounter'));?>
                            </div>
                        </div>
                        <div class="form-group">
                        	<div class="row">
                            	<div class="col-md-3">
                                    <label>Kode Jurnal</label>
                                        <?php
                                        $data = array();
                                        foreach ($kodetrans->result_array() as $row){
                                            $data[$row['kode_trans']] = $row['kode_trans']; 
                                        }  
                                        echo form_dropdown('DL_kodetrans', $data,'KM','id="DL_kodetrans" class="form-control input-xsmall"');
                                        ?>
                                </div>
                                <div class="col-md-4">
                                    <label>&nbsp;</label>
                                        <?php echo form_input(array('name'=>'txtNamaJurnal','id'=>'txtNamaJurnal','readonly'=>'true','class'=>'form-control')); ?>
                                </div>
                                <div class="col-md-5">
                                	<label>Kuitansi</label>
		                                <?php echo form_input(array('name'=>'txtKuitansi','onkeyup'=>'ToUpper(this)','id'=>'txtKuitansi','class'=>'form-control','value'=>set_value('txtKuitansi')));?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        	<div class="row">
                            	<div class="col-md-6">
                            		<label>Uraian</label>
	                                <?php
									$data = array(
										'name'        => 'txtUraian',
										'id'          => 'txtUraian',
										//'onkeyup'     => 'ToUpper(this)',
										'rows'        => '2',
										'class'       => 'form-control',
									  );
									echo form_textarea($data);
									?>
                            	</div>
                            	<div class="col-md-6">
                            		<label>Jumlah</label>
                            		<?php 
									$data = array(
										'name'        => 'txtJml',
										'id'          => 'txtJml',
										//'onkeyup'     => 'AddAndRemoveSeparator(this)',
										'style'       => 'text-align:right;',
										'value'		  => set_value('txtJml'),
										'class'		  =>'nomor form-control'
									  );
									echo form_input($data);
									?>
                            	</div>
                            </div>	
                        </div>
                        
                        <div class="form-group">
                            <span id="errmsg" style="color: red;" class="label label-error"></span>
        					<label id="terbilang" style="color: red"></label>
                        </div>
                        <!-- <div class="form-group">
                        	<div class="row">
                            	<div class="col-md-8">
                                    <label>GL Balance</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-list"></i>
                                        </span> -->
                                         <?php 
								//echo form_input(array('name'=>'txtKodeGL','id'=>'txtKodeGL','class'=>'form-control input-large','readonly'=>'true','value'=> set_value('txtKodeGL')));
								?>
                                    <!-- </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <div class="input-group">
                                        <a href="#" class="btn default" data-target="#GL" data-toggle="modal">
                                        	<span class="glyphicon glyphicon-search"></span>
                                        	Cari 
                                        </a> 
                                    </div>                                   
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
				            <div class="row">
				                <div class="col-md-6">
				                    <label>GL Balance :</label>
				
				                    <div class="input-group">
				                        <input id="txtKodeGL" name="txtKodeGL" type="text" placeholder="Kd Perkiraan"
				                               class="form-control bersih " readonly>
				                                    <span class="input-group-btn">
				                                                  <a href="#" class="btn green" data-target="#idDivTabelPerk"
				                                                     data-toggle="modal" id="idBtnDivTabelPerk"
				                                                     >
				                                                      <span class="glyphicon glyphicon-search"></span>
				                                                  </a>
				                                                  </span>
				
				                    </div>
				                </div>
				                <div class="col-md-6">
				                	<a class="btn default hidden" data-toggle="modal" href="#idDivApprovalLimitKas" 
				                	id="idBtnApprovalLimitKas"></a>
				                </div>
				            </div>
				
				        </div>
                        <div class="form-group">
                               <?php echo form_input(array('name'=>'txtNamaGl','id'=>'txtNamaGL','class'=>'form-control ','placeholder'=>'Nama Perkiraan','readonly'=>'true','value'=>set_value('txtNamaGL')));?>
	                        </div>									
                    </div>
                    <!-- END FORM BODY-->
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
        <!-- END PORTLET-->
    </div>
    <div class="col-md-4">
        <!-- BEGIN PORTLET-->
        <!-- END PORTLET-->
    </div>
</div>
<div class="clearfix">
</div>

<!-- /.modal -->
<div id="idDivTabelPerk" class="modal fade draggable-modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Perkiraan</h4>
            </div>

                <div class="modal-body">
                    <div class="scroller" style="height:400px; ">
                        <div class="row">
                            <div class="col-md-12">
                                <button id="id_Reload" style="display: none;"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body" id="idDivBodyTabelPerk">
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelPerk">
                                        <thead>
                                        <tr>
                                            <th>
                                                Kd Perk
                                            </th>
                                            
                                            <th>
                                                Nama Perk
                                            </th>
                                            <th>
                                                Type
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                    </div>
                    <!-- END SCROLLER-->
                </div>
                <!-- END MODAL BODY-->

                <div class="modal-footer">

                    <button type="button" data-dismiss="modal" class="btn default">Batal</button>
                </div>
        </div>
    </div>
</div>
<!--  END MODAL-->
<!--  MODAL APPROVAL -->
<div class="modal fade draggable-modal" id="idDivApprovalLimitKas" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Approval</h4>
			</div>
			<div class="modal-body">
				<div class="Metronic-alerts alert alert-danger fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
					Maaf, nominal anda melebihi batas yang diinzinkan.
				</div>	
				 <form role="form" id="idFormApprovalLimitKas" method="post">
					<div class="form-body">
						<div class="form-group">
							<label>User name</label>
								<input type="text" name="approvalUserName" id="idApprovalUserName" class="form-control" placeholder="User name">
						</div>
						<div class="form-group">
							<label>Password</label>
								<input type="password" name="approvalPassword" class="form-control" placeholder="Password">
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn blue">Approve</button>
						<button type="button" class="btn default">Batal</button>
					</div>
				</form>
					

			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalApproval">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!--  END MODAL APPROVAL -->

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
        TableManaged.init();
        $("#idDivTabelPerk").draggable({
            handle: ".modal-header"
        });
    });
</script>
<script type="text/javascript">
	// MENU OPEN
	$(".menu_root").removeClass('start active open');
	$("#menu_root_2").addClass('start active open');
	// END MENU OPEN
	var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#idTabelPerk');

        // begin first table
        table.dataTable({
            "ajax": "<?php  echo base_url("/kasumum/getPerkAll"); ?>",
            "columns": [
                { "data": "kodePerk" },
                //{ "data": "kodeAlt" },
                { "data": "namaPerk" },
                { "data": "typePerk" }

            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


            "lengthMenu": [
                [5, 10,15, 20, -1],
                [5, 10,15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "Cari: ",
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
           // "aaSorting": [[0,'asc']/*, [5,'desc']*/],
            "columnDefs": [{  // set default column settings
                'orderable': true,
                'type'      :'string',
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });
        $('#id_Reload').click(function () {
            table.api().ajax.reload();
        });

        var tableWrapper = jQuery('#example_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
        table.on('click', 'tbody tr', function () {
            var kdPerk = $(this).find("td").eq(0).html();
            var nmPerk = $(this).find("td").eq(1).html();
            $('#txtKodeGL').val(kdPerk);
            $('#txtNamaGL').val(nmPerk);
            $('#id_button_close_modal').trigger('click');
            $('#txtKodeGL').focus();

        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable1();
        }
    };

}();
	$('.nomor').val('0.00');
	$('#DL_kodetrans').focus();
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
	/* $('#idBtnDivTabelPerk').click(function(){
		$('div.idTabelPerk_filter label input').attr('id', 'your-id-value');
		//$('div.idTabelPerk_filter input').focus();
	}); */
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
		if( $(this).val()=='0' || $(this).val()=='0.00' ){
			$(this).val('');
		}		
	}); 
	
	
	function confirm_reset(){
		var r = confirm('Reset formulir ?');
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
			}else{
				//return false();
			}
		
	}
	function ajaxSimpanKasUmum(){
		ajaxModal();
		dataString = $("#id_form_kasumum").serialize();
		$.ajax({
			  type:"POST",
			  url:"<?php echo base_url(); ?>kasumum/insert_teller",
			  data:dataString,
			  success:function (data) {
				  alert('Transaksi kas umum tersimpan!');
				  $("#btnSimpan").attr("disabled", "disabled");
			  }	  
		  });
		  event.preventDefault();
	}
	$('#id_form_kasumum').submit(function (event) {
		var jml_bayar=parseFloat(CleanNumber($("#txtJml").val()));
		var sessionLimitKasUmum = parseFloat(CleanNumber($("#idSessionLimitKasUmum").val()));
		  if (jml_bayar==0){
			  alert('Nominal transaksi tidak boleh 0!');
			  return false;
		  }else if(jml_bayar > sessionLimitKasUmum){
			  //$('idApprovalUserName').focus();
			  $('#idBtnApprovalLimitKas').trigger('click');
			  //alert('Nominal transaksi melebihi batasan! \nHubungi supervisor anda.');
			  return false;
		  }else{
			  var r = confirm("Apakan anda yakin menyimpan data ini?");
			  if(r){
				  ajaxSimpanKasUmum();
			  }else{
				  return false;
			  }
		  }
  }); //end  $contact form
  function ajaxApprovalLimitKas(){
		dataString = $("#idFormApprovalLimitKas").serialize();
		$.ajax({
			  type:"POST",
			  url:"<?php echo base_url(); ?>kasumum/approvalLimitKas",
			  data:dataString,
			  dataType: 'json',
			  success:function (data) {
				  if(data.bool == true){
					  var jml_bayar=parseFloat(CleanNumber($("#txtJml").val()));
					  if(jml_bayar < data.limitKas){
						  ajaxSimpanKasUmum();
						  $('#btnCloseModalApproval').trigger('click');
					  }else{
						  alert("Maksimal nominal transaksi anda "+ number_format(data.limitKas,2) +"\nSilahkan appoval dengan user yang lain.");
					  }
				  }else{
					  alert("User name atau password anda salah.");
					  return false;
				  }	  
			  }
	  
		  });
		  event.preventDefault();
	}
  $('#idFormApprovalLimitKas').submit(function (event) {
	  ajaxApprovalLimitKas();
  });
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
  
</script>
