<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<html>
	<head>
	<title>Multi-Level Dropdown</title>
	<link href="<?php echo base_url('multilevel/css/pagestyle.css') ?>" rel="stylesheet"> 
	<link href="<?php echo base_url('multilevel/css/style.css') ?>" rel="stylesheet">
	
	<!--[if lte IE 7]>
        <link type="text/css" href="<?php echo base_url();?>asset/multilevel/css/ie.css" rel="stylesheet"  media="screen" />
	<![endif]-->
			
	<script src="<?php echo base_url('multilevel/js/jquery.js') ?>"></script> 
	<script src="<?php echo base_url('multilevel/js/jquery.dropdownPlain.js') ?>"></script> 
	</head>
<body>
	<div id="header"><h2>Multi-Level Dropdown</h2></div>
	<div id="content">
		
		<ul class="dropdown">
		<?php
		foreach($multilevel as $data)
		{
			echo '<li>'.anchor($data['link'],$data['nama']);
			echo '<ul class="sub_menu">';
			echo print_recursive_list($data['child']);
			echo '</ul></li>';
			
			 //echo '<li>'.anchor($row->menu_uri,$row->menu_nama).'</li>';
		}
		?>
		</ul>
	</div>
	<div id="footer">Copyright &copy; anggytrisnawan.com</div>
</body>
</html>