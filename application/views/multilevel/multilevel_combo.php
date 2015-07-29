<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<html>
<head>
	<title>Multi-Level Combobox</title>
	<link href="<?php echo base_url();?>asset/multilevel/css/pagestyle.css" rel="stylesheet" type="text/css" />
	
	<script src="<?php echo base_url();?>asset/multilevel/tree/lib/jquery.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		var site_url = "<?php echo site_url();?>";
		function load_uri(uri,dom)
		{
			$.ajax({
			    url: site_url+'/'+uri,
			    success: function(response){			
				$(dom).html(response);
			    },
			dataType:"html"  		
			});
			return false;
		}
		function show_extra_combo(combo,combo_level)
		{
			var id = $(combo).val();
			// buat dom '.combo-level' di dalam extra-combo jika belum ada
			var domcombo = 'combo-'+combo_level;
			if($('.'+domcombo).length == 0)
			{
				$('#extra-combo').append('&nbsp;<span class="'+domcombo+'"></span>');
			}
			load_uri("multileveldata/show_child/"+id+"/"+combo_level,'.'+domcombo);
		}
	</script>
</head>
<body>
	<div id="header"><h2>Multi-Level Combobox</h2></div>
	<div id="content">
	
	<div class='title'>Masukkan Informasi Tempat Tinggal Anda</div>
	<form name='somename'>
		<table>
			<tr>
				<td>Tempat tinggal saya di </td>
				<td>:</td>
				<td>
					<?php echo form_dropdown('tempat_tinggal[]',$multilevel,'','onchange="show_extra_combo(this,1)"');?>
					<span id='extra-combo'></span>
				</td>
			</tr>
		</table>
	</form>
	
	</div>
	<div id="footer">Copyright &copy; anggytrisnawan.com</div>
</body>
</html>