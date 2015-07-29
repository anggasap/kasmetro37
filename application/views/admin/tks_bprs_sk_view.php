	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main-content">
	<legend >&nbsp;<?php echo $judul; ?></legend>
	<?php
		$attributes = array('id' => 'form_tks_bprs');
		echo form_open('tks_bprs_c/tampil_skor', $attributes);
		?>
        <div class="row-fluid"><!-- row fluid 12 besar -->
          <div class="span12"><!-- span 12 -->
            <div class="row-fluid"><!-- row fluid kecil -->
              <div class="span6" style="padding:20px;"><!-- span 6 1-->  
              	<div class="row-fluid">
                  <div class="span5 input-prepend">
                  <span class="add-on"><i class="icon-calendar"></i></span>
                      <?php echo  form_input(array('name'=>'txtTanggal','class'=>'bersih span11','id'=>'txtTanggal','required'=>'required','placeholder'=>'Tanggal(dd-mm-yyyy)'));?>
                  </div>
				</div>  <!-- end row fluid -->
                <div class="row-fluid" >
                  <div class="span5 input-prepend">
                  <span class="add-on"><i class="icon-dollar"></i></span>
                      <?php echo  form_input(array('name'=>'txtPajak','class'=>'nomor span11','id'=>'txtPajak','required'=>'required','placeholder'=>'Pajak'));?>
                  </div>
				</div>  <!-- end row fluid -->
                <div class="row-fluid" >
					<div class="controls">
						<button type="submit" class="btn btn-success ladda-button" id="btnTampil" name="btnTampil">
							<i class="icon-save"></i><span class="ladda-label"> Simpan</span>
						</button>
					</div>
           	  	</div>     <!-- end Button -->   
              </div><!-- end span 6 1-->
              
              <div class="span6"><!-- span 6 2-->
              
              </div><!-- end span 6 2-->
            </div><!-- end row fluid kecil -->
          </div><!-- end span 12 -->
        </div><!-- end row fluid 12 besar -->
    	

		<?php echo form_close(); ?>
	
	<script src="<?php echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap/js/php_number_format.js') ?>"></script>
    
	<script type="text/javascript">
		$(document).ready(function(){
			$('.nomor').val('0.00');
			$(".nomor").focus(function(){
				$(this).val('');
			});
			$(".nomor").focusout(function(){
				if ($(this).val() == '') { 
				   $(this).val('0.00');
				   
				}else{
					var angka = $('.nomor').val(); 
					var result = number_format(angka,2);
					$('.nomor').val(result);
				}
			});	
		});
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
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
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>
</div>	