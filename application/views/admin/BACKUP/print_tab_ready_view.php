<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
  
  <head data-gwd-animation-mode="quickMode">
    <title>Cetak Buku Tabungan</title>
    <style type="text/css">
	/*
     @media print {
	  body {
		width: 100px;
		height: 200px;
	  }
	}
	*/
    </style>
  </head>
  
  <body>
  <?php
//echo $baris;
$x=1;
for($x=1;$x<=$baris;$x++){
	echo "<br>";
}
?>
   <table>
   <?php
    $i=1;
    $saldo = $saldo_sblm;
	foreach($rekening->result() as $row){
		?>
		<tr>
		   <td><?php echo $i.") ";?></td>
           <td width="200">
		   <?php 
		   	//echo $row->TGL_TRANS;
			$timestamp = strtotime($row->TGL_TRANS);
			$tgl = date('d/m/Y', $timestamp);
			echo $tgl;
			?>
           </td>
		   
           
        <?php
			if($row->my_kode == 2){// penarikan
			$saldo = $saldo - $row->SALDO_TRANS;
				?>
                <td width="200"><?php echo number_format($row->SALDO_TRANS,2);?></td>
                <td width="200"></td>
                <td width="200"><?php echo number_format($saldo,2);?></td>
                <?php
			}elseif($row->my_kode == 1){// penarikan
			$saldo = $saldo + $row->SALDO_TRANS;
				?>
                <td width="200"></td>
                <td width="200"><?php echo number_format($row->SALDO_TRANS,2);?></td>
                <td width="200"><?php echo number_format($saldo,2);?></td>
                <?php
			}
		?>   
		</tr>
		<?php
		$i++;
	 }
	 ?>
	 </table>
  </body>

</html>


<script type="text/javascript">
document.body.style.fontFamily="Courier New";
//document.body.style.width="300px";
//document.body.style.height="500px";
window.print();
</script>	