<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>

<link href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>" rel="stylesheet">
<link href="<?php // echo base_url('bootstrap/css/todc-bootstrap.css') ?>" rel="stylesheet">
<link href="<?php   echo base_url('bootstrap/css/font-awesome.min.css') ?>" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="<?php  echo  base_url('assets/easyui/themes/default/easyui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php // echo base_url('assets/easyui/themes/icon.css'); ?>">
<link href="<?php echo base_url('bootstrap/css/mtm.ico') ?>" rel="shortcut icon">
<?php
if(($title=="Laporan Kas User") || ($title=="Laporan Kas Kantor") ){
?>
<link href="<?php  echo base_url('bootstrap/css/demo_table.css') ?>" rel="stylesheet">
<?php 
}else if($title=="Master Tabungan"){
?>
	<link href="<?php  //echo base_url('css/smoothness/jquery-ui-1.10.4.custom.min.css') ?>" rel="stylesheet">
    
<?php
}
?>
<style type="text/css">    
.tabelborder{
border: 1px solid black;
}
div.scroll
{overflow:scroll;
max-height:500px;
}
    .pg-normal {
        color: black;
        font-weight: normal;
        text-decoration: none;    
        cursor: pointer;    
    }
    .pg-selected {
        color: black;
        font-weight: bold;        
        text-decoration: underline;
        cursor: pointer;
    }
.form-inline .hidden{
	display:none;
}
.form-inline .span1 .hidden{
	display:none;
}
.teks-kanan{
	text-align:right;
}
.modal_json {
		display:    none;
		position:   fixed;
		z-index:    1000;
		top:        0;
		left:       0;
		height:     100%;
		width:      100%;
		background:  rgba( 255, 255, 255, .8 ) 
					url(../../bootstrap/img/loading.gif) 
					50% 50% 
					no-repeat;
		opacity: 0.80;
		-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity = 80);
		filter: alpha(opacity = 80)
		}
.nomor {
	text-align:right;
}
.nomor1{
	text-align:right;
}
</style>

</head>
<body class="easyui-layout">
<div style="display:none;" class="modal_json"></div>
 <!-- top -->
<div data-options="region:'north',split:true" title="APLIKASI WEB TELLER PT MITRA TEKNO MADANI" style="height:80px;padding:10px;">
    <span style="font-size:20px"">
    <?php
	echo $this->session->userdata('kantor');
    
    ?>
    </span>
    <span style="float:right;font-size:10px">
    <span class="btn"><i class="icon-calendar icon-white"></i>&nbsp;<?php echo $this->session->userdata('tglD');?></span>
    <span class="btn btn-primary" id="session_username"><i class="icon-user icon-white"></i>&nbsp;<?php echo $this->session->userdata('nama');?></span>
	<a href="<?php echo site_url('main/logout');?>" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin keluar ?');" ><i class="icon-off icon-white"></i>&nbsp;Keluar</a>
    <input type="hidden" id="id_session_user" value="<?php echo $this->session->userdata('nama');?>" />
    <input type="hidden" id="id_session_user_id" value="<?php echo $this->session->userdata('user_id');?>" />  
    <input type="hidden" id="id_session_tgl_D" value="<?php echo $this->session->userdata('tglD');?>" />
    <input type="hidden" id="id_session_lokasi" value="<?php echo $this->session->userdata('lokasi');?>" />
    <input type="hidden" id="id_session_nama_lkm" value="<?php echo $this->session->userdata('nama_lkm');?>" />  
	</span>
</div>
<div data-options="region:'west',split:true" title="MAIN MENU" style="width:200px;padding1:1px;overflow:hidden;">
    <div class="easyui-accordion" data-options="fit:true,border:false" >
        <div title="&emsp;Menu" style="padding:10px;overflow:auto;" data-options="selected:true"  >
		<ul class="easyui-tree">
			<?php
				foreach($multilevel as $data){
				echo '<li>';
				echo '<span>'.anchor($data['link'],$data['nama']).'</span>' ;
				echo '<ul>';
				echo print_recursive_list($data['child']);
				echo '</ul>';
				echo '</li>';
				}
			?>
        </ul>
        </div>
        <div title="&emsp;Exit" style="padding:10px;">
            <a href="<?php echo site_url('main/logout');?>" onclick="return confirm('Apakah yakin ingin keluar ?');"><i class="icon-off"></i> Logout</a>
        </div>
    </div>
</div>
<!-- isi form -->
<div class="" data-options="region:'center'" title="MAIN CONTENT" style="overflow:hidden;padding:1px">       

	<?php
	// dynamic content loaded here
	echo $contents
	?>

</div>

<!-- footer 
<div class="navbar navbar-inverse navbar-fixed-bottom navbar-min">
<div class="navbar-inner">
<div class="container">
<small style="color:#fff">&copy; 2013 - Mitra Tekno Madani</small>
</div>                
</div>            
</div>-->

</body>
</html>