<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Mtech Web | Login Options - Login Form</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/global/plugins/simple-line-icons/simple-line-icons.min.css');  ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/global/plugins/bootstrap/css/bootstrap.min.css');  ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/global/plugins/uniform/css/uniform.default.css');  ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');  ?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url('metronic/global/plugins/select2/select2.css');  ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/admin/pages/css/login.css');  ?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('metronic/global/css/components.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('metronic/admin/layout/css/themes/default.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('metronic/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="#">
    <h3>APLIKASI WEB KANTOR KAS</h3>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN ROW1 -->
<div class="">
	<div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div>
        	<center>
        	 <img height="350px" src="<?php echo base_url('img/devices.jpg') ?>">
            </center>
        </div>
        <!-- END PORTLET-->
    </div>
    <!-- BEGIN COL 1 -->
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN LOGIN -->
        <div class="content">
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
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?php echo base_url('main/login') ?>" method="post">
                <h3 class="form-title">Login to your account</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                    Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <?php
                        echo form_input(array('name'=>'username','class'=>'form-control placeholder-no-fix','value'=>set_value('username'),'placeholder'=>'Username','id'=>'username','autocomplete'=>'off'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <?php
                        echo form_password	(array('name'=>'password','class'=>'form-control placeholder-no-fix','placeholder'=>'Password','id'=>'password','autocomplete'=>'off'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Kantor</label>
                    <div class="input-icon">
                        <i class="fa fa-home"></i>
                        <?php
						$data = array(
						//$data['']='Kantor'
						);
						foreach($daftar_kantor as $row) : 
								$data[$row['kode_cab']] = $row['nama_cabang'];
						endforeach; 
						echo form_dropdown('daftar_kantor', $data,'id="id_daftar_kantor"','class="form-control"');
						
						?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Tanggal</label>
                    <div class="input-icon">
                        <i class="fa fa-calendar"></i>
                        <?php
                        //angga
                        foreach($tanggal_hari_ini->result() as $row){
                            $tgl_hr_ini= $row->Value;
                        }
                        $tgl_hr_ini=str_replace("/","-",$tgl_hr_ini);
                        echo form_input(array('name'=>'tgl_login','class'=>'form-control placeholder-no-fix','value'=>"$tgl_hr_ini",'id'=>'tgl_login','readonly'=>'readonly','autocomplete'=>'off'));
                        //angga
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Kantor</label>
                    <div class="input-icon">
                        <i class="fa fa-home"></i>
                        <?php
                        foreach($nama_kantor->result() as $row){
                            $nama_kantor= $row->Value;
                        }
                        echo form_input(array('name'=>'nama_kantor','class'=>'form-control placeholder-no-fix','value'=>"$nama_kantor",'type'=>'text','readonly'=>'readonly','autocomplete'=>'off'));
                        ?>
                    </div>
                </div>
                <div class="form-actions">
                    <label class="checkbox">
                    <input type="checkbox" name="remember" value="1"/> Remember me </label>
                    <button type="submit" class="btn blue pull-right">
                    Masuk <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
                
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->
    </div>
    <!-- END COL 1 -->
</div>
<!-- END ROW1 -->
<div class="clearfix">
</div>



<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2014 &copy; Mitra Tekno Madani - Aplikasi Kantor Kas
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery-1.11.0.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate-1.2.1.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/quick-sidebar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/pages/scripts/login-soft.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
  Login.init();
});
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#username').focusout(function (){
				this.value = this.value.toUpperCase();
			});
			$("#username").keyup(function(){
	            this.value = this.value.toUpperCase();
	        });
			$('#password').focusout(function (){
				this.value = this.value.toUpperCase();
			});
			$("#password").keyup(function(){
	            this.value = this.value.toUpperCase();
	        });
			
				$("#username").focus();

			});
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
