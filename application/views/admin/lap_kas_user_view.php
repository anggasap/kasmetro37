<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
	
<div class ="form-inline ">
<?php
$attributes = array('id' => 'id_form_lap_kas_user');
echo form_open('laporan_kas/lap_kas_user',$attributes);
?>

<legend >
&nbsp;Laporan Kas User
<div  style="float:right;">
<!--<a href="lap_kas_user/testpdf/user" target=_new> Click here to download blah.pdf</a>-->
<button type="submit" formtarget="_blank" class="btn btn-warning" id="btnCetak" name="btnCetak"><i class="icon-print"></i>&nbsp;Cetak</button>
&nbsp;&nbsp;&nbsp;
</div>
<div  style="float:right;">
</div>

</legend>

<?php
echo form_close();
/*
$attributes = array('id' => 'id_form_lap_kas_user');
 echo form_open('laporan_kas/lap_kas_user',$attributes);?>
<legend >&nbsp;Laporan Kas User</legend>

<div>
<table>
<tr>
<td>
<?php echo form_label('Tanggal ');?>
</td>
<td >&nbsp;</td> 
<td>
<?php echo form_input(array('name'=>'txtTGlTrans','class'=>'span2','id'=>'txtTglTrans','placeholder'=>'dd-mm-yyyy'));?>
</td>
<td colspan="3" align="center">
<button type="submit" class="btn btn-success ladda-button" id="btnLihat" name="btnLihat" data-style="expand-right">
       <i class="icon-play"></i> <span class="ladda-label">Lihat</span>
       </button>
</td>
</tr>
</table>


</div>

<?php
 echo form_close();
*/
 ?>

</div>
<div class="scroll">
 <table cellpadding="0" cellspacing="0" border="0"  class="display" id="id_tabel_laporan" >
        <thead>
        <tr>
			<th class="h_1">No</th>
            <th class="h_2">Modul</th>
            <th class="h_3">No. Bukti</th>
            <th class="h_4">Uraian</th>
            <th class="h_5">TOB</th>
            <th class="h_6">OB Debet</th>
            <th class="h_7">OB Kredit</th>
            <th class="h_8">T Debet</th>
            <th class="h_9">T Kredit</th>
        </tr>
        </thead>
        <tbody>
<?php
$i=1;
$st200=0;
$st300=0;
$so200=0;
$so300=0;
			
				   foreach($data_kas->result() as $row)
				   {
				      ?>
				      <tr>
                      	 <td><?php echo $i; $i++; ?></td>
				         <td><?php echo $row->modul;?></td>
				         <td><?php echo $row->NO_BUKTI;?></td>
				         <td><?php echo $row->uraian;?></td>
                         <td><?php echo $row->tob;?></td>
                         
                         <?php			 
						 if(($row->my_kode_trans==200) && ($row->tob=='O')){
						 ?>
                         <td align="right"><?php echo number_format($row->saldo_trans,2); $so200=$so200+$row->saldo_trans; ?></td>
				         <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                         <?php
						 }else if(($row->my_kode_trans==300) && ($row->tob=='O')){
						 ?>
                         <td>&nbsp;</td>
				         <td align="right"><?php echo number_format($row->saldo_trans,2); $so300=$so300+$row->saldo_trans;?></td>
                         <td>&nbsp;</td><td>&nbsp;</td>
                         <?php
						 }else if(($row->my_kode_trans==200) && ($row->tob=='T')){
						 ?>
                         <td>&nbsp;</td><td>&nbsp;</td>
				         <td align="right"><?php echo number_format($row->saldo_trans,2); $st200=$st200+$row->saldo_trans;?></td>
                         <td>&nbsp;</td>
                         <?php
						 }else if(($row->my_kode_trans==300) && ($row->tob=='T')){
						 ?>
                         <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				         <td align="right"><?php echo number_format($row->saldo_trans,2); $st300=$st300+$row->saldo_trans;?></td>
                         
                         <?php
						 }
						 ?>
				      </tr>
				      <?php
				   }
				   
				  ?>            
            	</tbody>
            <tfoot>
            <tr>
            <td colspan="5">Total</td>
            <td align="right"><?php echo number_format($so200,2); ?></td>
            <td align="right"><?php echo number_format($so300,2); ?></td>
            <td align="right"><?php echo number_format($st200,2); ?></td>
            <td align="right"><?php echo number_format($st300,2); ?></td>
            </tr>
            
            </tfoot> 
</table>
</div>


<script src="<?php  echo base_url('bootstrap/js/jquery-2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/jquery.dataTables.js') ?>"></script> 

<script type="text/javascript" charset="utf-8">
			var oTable;
				
			$(document).ready(function() {
				/* Add a click handler to the rows - this could be used as a callback */
				$("#id_tabel_laporan tbody tr").click( function( e ) {
					var trid = $(this).closest('tr').attr('id'); // table row ID 
					//alert(trid);
					$("#id_oper_rowid").val(trid);
					if ( $(this).hasClass('row_selected') ) {
						$(this).removeClass('row_selected');
					}
					else {
						oTable.$('tr.row_selected').removeClass('row_selected');
						$(this).addClass('row_selected');
					}
				});
				
				
				/* Init the table */
				oTable = $('#id_tabel_laporan').dataTable( );
			});			
			/* Get the rows which are currently selected */
			function fnGetSelected( oTableLocal )
			{
				return oTableLocal.$('tr.row_selected');
			}
		</script>


</div>






