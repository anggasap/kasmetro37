<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
<?php echo form_open('setting/konfig_teller');?>
	<div class ="form-inline ">
		<legend >&nbsp;Setup Konfigurasi Teller</legend>
		<?php
		if($this->session->flashdata('success') != '')
		{
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>'.$this->session->flashdata('success').'
			</div>
			</div>';
		} ?>
		<div class="span6">
		<table>
			<tr>
				<td>
					<?php echo form_label('Setor-Tarik Tabungan');?>
				</td>
				<td>
					&nbsp;
				</td>
				<td >
					<?php
					$data = array('0'=> 'TIDAK MENAMPILKAN NOREK KREDIT','1'=>'MENAMPILKAN NOREK KREDIT');
					$value = array();
					foreach ($konfig_norek->result_array() as $row)
					{
						$value[$row['Value']] = $row['Value']; 
					}
					$selected='';
					if(($value[$row['Value']])=='MENAMPILKAN NOREK KREDIT'){$selected='1';}else{$selected='0';}
					echo form_dropdown('DL_tampil_kredit', $data,$selected,'id="DL_tampil_kredit" class="span4"');
					?>
				</td>
			</tr>

			<tr>
				<td>
					<?php echo form_label('Informasi Tabungan Pasif');?>
				</td>
				<td>
					&nbsp;
				</td>
				<td >
					<?php
					$data = array('0'=> 'TIDAK DITAMPILKAN','1'=> 'DITAMPILKAN');
					$value = array();
					foreach ($konfig_pasif->result_array() as $row)
					{
						$value[$row['Value']] = $row['Value']; 
					}
					$selected='';
					if(($value[$row['Value']])=='DITAMPILKAN'){$selected='1';}else{$selected='0';}
					echo form_dropdown('DL_tab_pasif', $data,$selected,'id="DL_tab_pasif" class="span4"');
					?>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					<div class ="pull-left">
						<button type="submit" class="btn btn-primary" name="btnSimpan" id="btnSimpan">
							<i class="icon-save icon-white">
							</i> Simpan
						</button>
						<a class="btn btn-warning" onclick="return confirm('Anda yakin?');" href="<?php echo site_url('main/index'); ?>">
							<i class="icon-off icon-white">
							</i> Exit
						</a>
					</div>
				</td>
			</tr>
		</table>
		</div>
	<?php echo form_close(); ?>
	
	</div>
	
	<script src="<?php echo base_url('bootstrap/js/jquery.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap.js') ?>"></script>

</div>






