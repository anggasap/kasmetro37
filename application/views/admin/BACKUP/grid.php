
<script type="text/javascript">
var url;
 
function create(){
    jQuery('#dialog-form').dialog('open').dialog('setTitle','Tambah user');
    jQuery('#form').form('clear');
    url = '<?php echo site_url('/crud/create'); ?>';
}
 
function update(){
    var row = jQuery('#datagrid-crud').datagrid('getSelected');
    if(row){
        jQuery('#dialog-form').dialog('open').dialog('setTitle','Edit user');
        jQuery('#form').form('load',row);
		//alert(row.username);
        url = '<?php echo site_url('/crud/update'); ?>/' + row.userid;
    }
}
 
function save(){
    jQuery('#form').form('submit',{
        url: url,
        onSubmit: function(){
            return jQuery(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                jQuery('#dialog-form').dialog('close');
                jQuery('#datagrid-crud').datagrid('reload');
            } else {
                jQuery.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}
 
function destroyUser(){
    var row = jQuery('#datagrid-crud').datagrid('getSelected');
    
	if (row){
        jQuery.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
            if (r){
                 jQuery.post('<?php echo site_url('/crud/delete'); ?>',{id:row.userid},function(result){
                    if (result.success){
                         jQuery('#datagrid-crud').datagrid('reload');    // reload the user data
                    } else {
                         jQuery.messager.show({    // show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                },'json');
            }
        });
    }
}

</script>

<!-- Data Grid -->
<table id="datagrid-crud" title="user" class="easyui-datagrid" style="width:auto; height: auto" url="<?php echo site_url('crud/index');?>?grid=true" toolbar="#toolbar" pagination="true"  rownumbers="true" fitColumns="true" singleSelect="true" collapsible="true"  iconCls="icon-ok">
    <thead>
        <tr>
            <th field="userid" width="30" sortable="true">USERID</th>
            <th field="username" width="50" sortable="true">USERNAME</th>
            <th field="password" width="50" sortable="true">PASSWORD</th>
            <th field="usergroup" width="50" sortable="true">USERGROUP</th>
			<th field="limit_tarik" width="30" sortable="true">LIMIT TARIK</th>
            <th field="limit_kasumum" width="50" sortable="true">LIMIT KAS</th>
            <th field="limit_setor" width="50" sortable="true">LIMIT SETOR</th>
            <th field="status_user" width="50" sortable="true">STATUS USER</th>
			<th field="nama_komputer" width="30" sortable="true">PC</th>
            <th field="tgl_password" width="50" sortable="true">TGL PASS</th>
            <th field="outlet" width="50" sortable="true">OUTLET</th>
        </tr>
    </thead>
</table>

<!-- Toolbar -->
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="create()">Tambah user</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="update()">Edit User</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Hapus User</a>

</div>
 
<!-- Dialog Form -->
<div id="dialog-form" class="easyui-dialog" style="width:600px; height:500px; padding: 10px 20px" closed="true" buttons="#dialog-buttons">
    <form id="form" method="post" novalidate>
        <div class="fitem">
            <label for="username">username</label><br />
            <input type="text" name="username" class="easyui-validatebox" required="true" />
        </div>
        <div class="fitem">
            <label for="password">password</label><br />
            <input type="text" name="password" class="easyui-validatebox" required="true" />
        </div>
        <div class="fitem">
            <label for="type">usergroup</label><br />
            <input type="text" class="easyui-validatebox" name="usergroup" class="easyui-validatebox" required="true" size="53" maxlength="50" />
        </div>
		<div class="fitem">
            <label for="limit_tarik">limit tarik</label><br />
            <input class="easyui-numberbox" name="limit_tarik" data-options="precision:2,groupSeparator:'.',decimalSeparator:',',prefix:'Rp. '" class="easyui-validatebox" required="true" />
        </div>
		<div class="fitem">
            <label for="limit_kasumum">limit kas</label><br />
            <input class="easyui-numberbox" name="limit_kasumum" data-options="precision:2,groupSeparator:'.',decimalSeparator:',',prefix:'Rp. '" class="easyui-validatebox" required="true" />
        </div>
		<div class="fitem">
            <label for="limit_setor">limit setor</label><br />
            <input class="easyui-numberbox" name="limit_setor" data-options="precision:2,groupSeparator:'.',decimalSeparator:',',prefix:'Rp. '" class="easyui-validatebox" required="true" />
        </div>
		<div class="fitem">
            <label for="status_user">status user</label><br />
            <input type="text" name="status_user" class="easyui-validatebox" required="true" size="53" maxlength="50" />
        </div>
		<div class="fitem">
            <label for="nama_komputer">nama PC</label><br />
            <input type="text" name="nama_komputer" class="easyui-validatebox" required="true" size="53" maxlength="50" />
        </div>
		<div class="fitem">
            <label for="tgl_password">tgl pass</label><br />
            <input type="text" name="tgl_password" class="easyui-validatebox" required="true" size="53" maxlength="50" />
        </div>
		<div class="fitem">
            <label for="outlet">outlet</label><br />
            <input type="text" name="outlet" class="easyui-validatebox" required="true" size="53" maxlength="50" />
        </div>
    </form>
</div>
 
<!-- Dialog Button -->
<div id="dialog-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:jQuery('#dialog-form').dialog('close')"> Batal</a>
</div>