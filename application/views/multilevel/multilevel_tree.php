<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<html>
<head>
	<title>Multi-Level Tree</title>
	<link href="<?php echo base_url();?>assets/multilevel/css/pagestyle.css" rel="stylesheet" type="text/css" />
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/multilevel/tree/jquery.treeview.css" />
	
	<script src="<?php echo base_url();?>assets/multilevel/tree/lib/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/multilevel/tree/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/multilevel/tree/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		});
	</script>
</head>
<body>
	<div id="header"><h2>Multi-Level Tree</h2></div>
	<div id="content">
		
		<div id="sidetreecontrol"><a href="?#">Collapse All</a> | <a href="?#">Expand All</a></div>

		<ul id="tree">
		<?php
			echo print_recursive_list($multilevel);
		?>
		</ul>
	</div>
	<div id="footer">Copyright &copy; anggytrisnawan.com</div>
</body>
</html>