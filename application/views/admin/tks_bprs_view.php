	<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div id="main-content">
	<legend >&nbsp;<?php echo $judul; ?></legend>
	<?php
		$attributes = array('id' => 'form_tks_bprs');
		echo form_open('tks_bprs_c/tampil_faktor', $attributes);
		?>
    	<div class="row-fluid" style="padding:10px;"><!-- row fluid 12 besar -->
          <div class="span12"><!-- span 12 -->
            <div class="row-fluid"><!-- row fluid kecil -->
              <div class="span6"><!-- span 6 1-->
              <input type="hidden" id="id_faktor_o" />
              <input type="hidden" id="id_rasio_o" />
              <input type="hidden" id="id_komponen_o" />
              <input type="hidden" id="nm_komponen_o" />
              <input type="hidden" id="id_komponen_perk_o" />
              
              	<table class='table table-hover' id="tabel_rasio">
			 	<thead>
			      <tr>
                  	<th style="display:none;"></th>
                    <th style="display:none;"></th>
                    <th style="display:none;"></th>
                     <th width='30%' align='left'>Faktor</th>
			         <th width='30%' align='left'>Rasio</th>
                     <th width='20%' align='left'>Jenis Rasio</th>
                     <th width='20%' align='left'>Komponen</th>
                    
			      </tr>
				</thead>
				<tbody>
				  <?php
				   foreach($tampil_faktor->result() as $row){
				      ?>
				      <tr  class="listrasio">
                      	<td style="display:none;"><?php echo $row->id_faktor;?></td>
                        <td style="display:none;"><?php echo $row->id_rasio;?></td>
                        <td style="display:none;"><?php echo $row->id_komponen_master;?></td>
				         <td><?php echo $row->nama_faktor;?></td>
				         <td><?php echo $row->nama_rasio;?></td>
                         <td><?php echo $row->jenis_rasio;?></td>
                         <td><?php echo $row->nama_komponen;?></td>
                      </tr>
				      <?php
				   }
				  ?>
			   </tbody>
		 </table>       
              </div><!-- end span 6 1-->
              <div class="span6"><!-- span 6 2-->
              <!-- START LIST KOMPONEN PERKRAAN-->
              	<div id="list_komponen" class="easyui-window" title="List Komponen Perk" data-options="iconCls:'icon-save'" style="width:700px; height:500px;overflow: auto;overflow-y: auto; padding:20px;">
                <div id="head_komponen"></div>  
                	<table class='table table-hover' style="" id="tabel_list">
                      <thead>
                          <tr>
                          	  <th width='30%' align='left' style="display:none;">Id komp perk</th>
                              <th width='40%' align='center'>
                                  Kode Perk
                              </th>
                              <th width='60%' align='center'>
                                  Nama Perk
                              </th>
                          </tr>
                      </thead>
                      <tbody id="body"></tbody>				
                  </table>
                  <div style="float:right">
                      <button class="btn btn-primary" id="add_perk">+</button>
                      <button class="btn btn-danger" id="sub_perk">-</button>
                      <button class="btn btn-primary" id="btn_refresh"><i class="icon icon-refresh"></i></button>
    			  </div>
    			</div>
                <!-- END LIST KOMPONEN -->
                <!--START PERKIRAAN -->
                <div id="GL" class="easyui-window" title="GL PERKIRAAN" data-options="iconCls:'icon-save'" style="width:500px;height:580px;padding:10px;">  
                  <div class="input-append">
                        <input type="text" class="appendedInputButtons search-query" id="kwd_search" placeholder="Cari...">
                        <span class="btn">
                           <i class="icon-search"></i>&nbsp;
                        </span>
                  </div>
                  <input type="text" class="span1" id="pos_neg" value="+" style="width:10px; float:right;">
           <table class='table table-hover' id="tabel_perk">
              <thead >
                <tr>
                   <th width='20%' align='left'>Kd Perk</th>
                   <th width='70%' align='left'>Nama Perk</th>
                   <th width='10%' align='center'>Type</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 foreach($perkiraan->result() as $row){
                    ?>
                    <tr>
                       <td><?php echo $row->kode_perk;?></td>
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
                <!-- ENE PERKIRAAN -->
              </div><!-- end span 6 2-->
            </div><!-- end row fluid kecil -->
          </div><!-- end span 12 -->
        </div><!-- end row fluid 12 besar -->

		<?php echo form_close(); ?>
	
	<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#list_komponen').window('close');
			$('#GL').window('close');
			
			$("#tabel_rasio tbody tr").click(function(){
				$(".listrasio").removeClass('alert alert-info');
				$(this).addClass('alert alert-info');
				
				var id_faktor = $(this).find("td").eq(0).html();
				$('#id_faktor_o').val(id_faktor);
				var id_rasio= $(this).find("td").eq(1).html();
				$('#id_rasio_o').val(id_rasio);
				var id_komponen_master = $(this).find("td").eq(2).html();
				$('#id_komponen_o').val(id_komponen_master);
				var nama_komponen = $(this).find("td").eq(6).html();
				$('#nm_komponen_o').val(nama_komponen);
				
				cari_komponen(id_komponen_master);
				
				var head_komponen = "<h4>"+$('#nm_komponen_o').val();+"</h4>";
				
				$('#head_komponen').html(head_komponen);
				$('#list_komponen').window('open');
			});
		});
		$("#sub_perk").click(function(){
			hapus_komp_perk();
			var id_komponen_master = $("#id_komponen_o").val();
			cari_komponen(id_komponen_master);
		});
		$("#btn_refresh").click(function(){
			var id_komponen_master = $("#id_komponen_o").val();
			cari_komponen(id_komponen_master);
		});
		function hapus_komp_perk(){
			var id_komponen_perk = $("#id_komponen_perk_o").val();
			//var id_komponen_master = $("#id_komponen_o").val();
			//alert(id_komponen_master); 
			$.post("<?php echo site_url('/tks_bprs_c/hapus_komponen_perk'); ?>",{
						  'id_komp_perk' : id_komponen_perk
			  },function(data){
				 // var id_komponen_master = $("#id_komponen_o").val();
				 //  alert("x");
				   //cari_komponen(id_komponen_master);
					
			  },"json");
		}
		
		function cari_komponen(id_komponen){
			var id_komponen;
			var item;
			item=id_komponen.trim();
			  if (item!=''){
				$.post("<?php echo site_url('/tks_bprs_c/proses_cari_komponen_perk'); ?>",{'item':item},
				function(data){
					$('#body').empty();
					var tr="";
					for (var i = 0; i < data.norek.length; i++) {
						 z=(data.norek[i].id_komp_perk).trim();
						 a=(data.norek[i].kode_perk).trim();
						 b=(data.norek[i].nama_perk).trim();
						tr = '<tr class="listdata">';
						tr+='<td style="display:none;">'+z+'</td>'+'<td>'+a+'</td>'+'<td>'+b+'</td>';
						tr+= '</tr>';
						$('#body').append(tr);
					}
					
					$("#tabel_list tbody tr").click(function(){	
						$(".listdata").removeClass('alert alert-info');
						$(this).addClass('alert alert-info');
						
						var id_komp_perk = $(this).find("td").eq(0).html();
						var kdperk = $(this).find("td").eq(1).html();
						var tipe = $(this).find("td").eq(2).html();
						
						$('#id_komponen_perk_o').val(id_komp_perk);
					});
				},"json");
			  }//if kd<>''
			}//function cari_komponen(){
			$("#kwd_search").keyup(function(){
				// When value of the input is not blank
				if( $(this).val() != ""){
					// Show only matching TR, hide rest of them
					$("#tabel_perk tbody>tr").hide();
					$("#tabel_perk td:contains-ci('" + $(this).val() + "')").parent("tr").show();
				}
			});	
			$("#add_perk").click(function(){
				$('#GL').window('open');
				$('#kwd_search').focus();
			});	
			$("#tabel_perk tbody tr").click(function(){	
				var kdperk = $(this).find("td").eq(0).html();
				var tipe = $(this).find("td").eq(2).html();
				if(tipe=='G'){
					alert("Kode induk tidak dapat dipilih.");
				}else{
					insert_komponen(kdperk);
					//$('#GL').window('close');
					var id_komponen = $('#id_komponen_o').val();
					cari_komponen(id_komponen);
				}
				
			});
			function insert_komponen(kode_perk){
			  var id_faktor = $('#id_faktor_o').val();
			  var id_rasio = $('#id_rasio_o').val();
			  var id_komponen = $('#id_komponen_o').val();
			  var nm_komponen = $('#nm_komponen_o').val();
			  var pos_neg = $('#pos_neg').val();
			  
			var kode_perk;
			kode_perk=kode_perk.trim();
			  if (kode_perk!=''){
				$.post("<?php echo site_url('/tks_bprs_c/insert_komponen_perk'); ?>",{
					'kd_perk':kode_perk,
					'id_f':id_faktor,
					'id_r':id_rasio,
					'id_k':id_komponen,
					'pos_neg' : pos_neg
					},
				function(data){
					//alert("angga");
				},"json");
			  }//if kd<>''
			}//function insert komponen(){

			
		
		
		
		$(document).ajaxStart(function() {
			$('.modal_json').fadeIn('fast');
		  }).ajaxStop(function() {
			$('.modal_json').fadeOut('fast');
		});
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"],{
				"contains-ci": function(elem, i, match, array){
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
					.toLowerCase()) >= 0;
				}
		});
	</script>
</div>	