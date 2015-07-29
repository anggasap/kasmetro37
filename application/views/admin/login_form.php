<!DOCTYPE html>

<html lang="en" xml:lang="en" class="animated-index-page js no-flexbox canvas canvastext no-touch postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>" rel="stylesheet">
		<link href="<?php // echo base_url('bootstrap/css/bootplus.min.css') ?>" rel="stylesheet"> 
		<link href="<?php echo base_url('bootstrap/css/mtm.ico') ?>" rel="shortcut icon">
		<link href="<?php echo base_url('bootstrap/css/login.css') ?>" rel="stylesheet">
        <link href="<?php   echo base_url('bootstrap/css/font-awesome.min.css') ?>" rel="stylesheet"> 

<!--		<link href="<?php // echo base_url('bootstrap/css/date/datepicker.css') ?>" rel="stylesheet">-->
		<link href="<?php echo base_url('bootstrap/css/spiner/ladda-themeless.min.css') ?>" rel="stylesheet">
		<!--<link href="<?php // echo base_url('bootstrap/css/spiner/prism.css') ?>" rel="stylesheet">
		<!--<link href="<?php //echo base_url('bootstrap/css/keyboard.css') ?>" rel="stylesheet">-->
		
		<script src="<?php echo base_url('bootstrap/js/jquery.min.js') ?>"></script>
		<script src="<?php // echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
<!--		<script src="<?php // echo base_url('bootstrap/js/bootstrap-alert.js') ?>"></script>
		<script src="<?php // echo base_url('bootstrap/js/bootstrap-datepicker.js') ?>"></script>
		
		<script src="<?php // echo base_url('bootstrap/js/bootstrap-alert.js') ?>"></script> -->
		<style type="text/css">
			.centered
			{
				position: absolute;
				height: 200px;
				width: 400px;
				margin: -100px 0 0 -200px;
				top: 50%;
				left: 50%;
			}
		</style>
		<title>
			Kantor Kas
		</title>

	</head>
	<body class="en  webkit" style="">
	
		<div id="outer-frame">
			<div id="page-content">
				<div class="top">
					<div class="devices">
						<div class="comp graph" style="display: block;">
							<img src="<?php echo base_url('bootstrap/css/graph_comp.png') ?>">
						</div>
						<div class="tablet graph" style="display: block;">
							<img src="<?php echo base_url('bootstrap/css/graph_tablet.png') ?>" >
						</div>
						<div class="phone graph" style="display: block;">
							<img src="<?php echo base_url('bootstrap/css/graph_phone.png') ?>">
						</div>
						<img src="<?php echo base_url('bootstrap/css/devices.png') ?>">
					</div>
					<div id="signup-form" class="">
					
						<div class="subtitle">
							Aplikasi Kantor Kas
						</div>
						
						<?php if(validation_errors()): ?>
					    <div class="alert alert-warning">
					      <a class="close" data-dismiss="alert" href="#" >x</a>
							<?php
							echo form_error('username'); echo("&nbsp;");
							echo form_error('password');echo("&nbsp;");
							echo form_error('tgl_login');echo("&nbsp;");
							?>
					    </div>
						<?php endif;?>
						
						<?php
						  // menampilkan informasi error
						  if(isset($login_info))
						  {
							 echo "<div class='alert alert-warning'>";
							 echo "<a class='close' data-dismiss='alert' href='#'>x</a>";
							 echo $login_info;
							 echo '</div>';
						  }
						?>
						<?php echo form_open('main/login');?>
						
							<h2 id="modal-title">Masuk</h2>
								
    						<div id="email-field" >
                            	<div class="span6 input-prepend">
                        			<span class="add-on"><i class="icon-user"></i></span>
							  <?php
						      echo form_input(array('name'=>'username','class'=>'keyboardInput','value'=>set_value('username'),'placeholder'=>'Username','id'=>'username'));
						      ?>
                            	</div>
							</div>
							<div id="email-field">
                            	<div class="span6 input-prepend">
                        			<span class="add-on"><i class="icon-key"></i></span>
						      <?php
						      echo form_password	(array('name'=>'password','class'=>'keyboardInput','placeholder'=>'Password','id'=>'password'));
						      ?>
                            	</div>
							</div>
							<div id="email-field">
                            	<div class="span6 input-prepend">
                        			<span class="add-on"><i class="icon-calendar"></i></span>
						      <?php
							  //angga
							  foreach($tanggal_hari_ini->result() as $row)
							  {
								  $tgl_hr_ini= $row->Value;
							  }
							  $tgl_hr_ini=str_replace("/","-",$tgl_hr_ini);
						      echo form_input(array('name'=>'tgl_login','class'=>'keyboardInput','value'=>"$tgl_hr_ini",'id'=>'tgl_login','readonly'=>'readonly'));
							  foreach($nama_kantor->result() as $row){
								  $nama_kantor= $row->Value;
							  }
						      echo form_input(array('name'=>'nama_kantor','class'=>'keyboardInput','value'=>"$nama_kantor",'type'=>'hidden','readonly'=>'readonly'));
							  //angga
							  ?>
                            	</div>
							</div>

							  <button name="submit" class="btn btn-primary ladda-button" data-style="expand-right"><span class="ladda-label"><i class="icon-play"></i>&nbsp;&nbsp;Login</span></button>
						<?php echo form_close(); ?>
						
					</div>
				</div>

			</div>
		</div>
		
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#username').focusout(function (){
				this.value = this.value.toUpperCase();
			});
			$("#username").keyup(function(){
	            this.value = this.value.toUpperCase();
	        });
			
				$("#username").focus();

				var minDate = new Date();
				minDate.setHours(0);
				minDate.setMinutes(0);
				minDate.setSeconds(0,0);

				$('#tgl_login')
				.datepicker(
					{
						format: 'dd-mm-yyyy'
					})
				.on('changeDate', function(ev)
					{
						if (ev.date.valueOf() > minDate.valueOf())
						{
							// Handle previous date
							alert('Tgl melebihi hari ini !');
							pickerObject.setValue(minDate);
							// And this for later versions (in case)
							ev.preventDefault();
							return false;
						}
						else
						{
							$('#tgl_login').datepicker('hide');
						}
					});
			});
	</script>
	<!--<script src="<?php // echo base_url('bootstrap/js/jquery.keyboard.js') ?>"></script> -->
	<script src="<?php echo base_url('bootstrap/js/spiner/spin.min.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/ladda.min.js') ?>"></script> 
	<script src="<?php // echo base_url('bootstrap/js/spiner/prism.js') ?>"></script> 
	<script src="<?php echo base_url('bootstrap/js/lazada-spin.js') ?>"></script>
	</body>
</html>