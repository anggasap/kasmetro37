<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>CRUD CodeIgniter dengan EasyUI - Dida Nurwanda</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/metro-blue/easyui.css'); ?>">
    
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js'); ?>"></script>
</head>
<body class="easyui-layout">
     
    <!-- top -->
    <div data-options="region:'north',split:true" title="North Title" style="height:100px;padding:10px;">
        <span style="font-size:30px">CRUD CodeIgniter dengan EasyUI</span>
        <span style="float:right; font-size:30px">mutaqin</span>
    </div>
    <!-- left -->
    <div data-options="region:'west',split:true" title="Main Menu" style="width:280px;padding1:1px;overflow:hidden;">
        <div class="easyui-accordion" data-options="fit:true,border:false">
            <div title="Title1" style="padding:10px;overflow:auto;" data-options="selected:true" >
                <p>content1</p>
                <p>content1</p>
            </div>
            <div title="Title2" style="padding:10px;">
                content2
            </div>
            <div title="Title3" style="padding:10px">
                content3
            </div>
        </div>
    </div>
     
    <!-- center -->
    <div data-options="region:'center'" title="Main Content" style="overflow:hidden;padding:1px">
        <?php $this->load->view('admin/grid'); ?>
    </div>
</body>
</html>