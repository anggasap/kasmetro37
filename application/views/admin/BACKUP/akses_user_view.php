<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="main-content">
<legend >&nbsp;Role manager</legend>
	<?php
		if($this->session->flashdata('success') != ''){
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>'.$this->session->flashdata('success').'
			</div>
			</div>';
		} 
		if($this->session->flashdata('error') != ''){
			echo '
			<div class="row-fluid">
			<div class="span12 alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>'.$this->session->flashdata('error').'
			</div>
			</div>';
		} 
	?>
	<div class="span11 form-inline" style="height: 450px; max-height: 500px;">
		<?php echo form_open('akses_user/aksesuser');?>
		
			<ul class="nav nav-tabs">
		        <li class="active"><a data-toggle="tab" href="#tab1">Setup Wewenang</a></li>
		        <li class=""><a data-toggle="tab" href="#tab2">Input User</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id ="tab1">
					<div class="row-fluid">
						<div style="float:left; width:300px;">
							<div class="legend" >Menu</div>
							<div  id="tree_menu" style="border-color:#FFFFFF;">
								<ul class="easyui-tree" data-options="checkbox:true">
									<?php
									echo print_tree($tree);
									?>
								</ul>
							</div> <!-- end tree menu -->
							<br />
							<a href="#" class="easyui-linkbutton" onclick="getChecked()">GetChecked</a> 
						</div>
						
						<div style="margin-right: 250px; width:500px;float: right;" class="form-horizontal">
							<div class="legend">Pilih User Level</div>
							<fieldset >
								<table >
									<tr>
										<td>
											<label class="control-label" for="input01">
												Level Id
											</label>
											<div class="controls">
											<div class ="input-append" >
												<?php echo form_input(array('name' =>'txtUserid','id' =>'txtUserid','class'=>'input-small bersih','required'=>'required','readonly'=>'readonly'));?>
												<span class="btn btn-primary" id="btnUser" ><i class="icon-search"></i></span>
	
											</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>
											<label class="control-label" for="input01">
												Deskripsi
											</label>
											<div class="controls">
												<?php echo form_input(array('name' =>'txtUsername','id' =>'txtUsername','class'=>'input-medium bersih','required'=>'required','readonly'=>'readonly'));?>
											</div>
										</td>
									</tr>

									<tr>
										<td  >
											<br />
											<div class="controls">
											<button type="submit" class="btn btn-success ladda-button" id="btnSimpanAkses" name="btnSimpanAkses" data-style="expand-right"><i class="icon-save" ></i><span class="ladda-label"> Simpan</span></button>
											 <a class="btn btn-danger" id="btnReset1" name="btnReset1">
										       <i class="icon-undo"></i> Reset
										     </a>
											<a class="btn btn-warning" onclick="return confirm('Anda yakin?');" href="<?php echo site_url('main/index'); ?>"><i class="icon-off"></i> Exit</a>
											</div>
										</td>
									</tr>

								</table>

							</fieldset>
						</div><!-- kolom kedua -->
					</div>
				</div><!-- end tab 1 -->
				
				<!-- tab kedua -->
				<div class="tab-pane" id="tab2">
					<div class="row-fluid">
					<div style="float:left; width:300px;" class="form-horizontal">
						<table >
							<tr>
								<td>
									<label class="control-label" for="input01">
										Username
									</label>
									<div class="controls">
										<div class ="input-append" >
											<?php echo form_input(array('name'=>'txtUsernameInput','id'=>'txtUsernameInput','class'=>'input-medium bersih','required'=>'required'));?>
											
										</div>
									</div>
								</td>
							</tr>
							
							<tr>
								<td>
									<label class="control-label" for="input01">
										Password
									</label>
									<div class="controls">
										<?php echo form_password(array('name' =>'txtPassword','id' =>'txtPassword','class' =>'input-medium','required'=>'required'));?>
									</div>
								</td>
							</tr>
							
							<tr>
								<td>
									<label class="control-label" for="input01">
										Input ulang Password
									</label>
									<div class="controls">
										<?php echo form_password(array('name' =>'txtRePassword','id' =>'txtRePassword','class' =>'input-medium','required'=>'required'));?>
									</div>
								</td>
							</tr>
							
							<tr>
								<td>
									<label class="control-label" for="input01">
										Limit Penarikan
									</label>
									<div class="controls">
										<?php echo form_input(array('name' =>'txtLimitTarik','id' =>'txtLimitTarik','class' =>'input-medium nomor','style' =>'text-align:right','required'=>'required','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
										<span id="errmsg" style="color: red;font-weight: bold;"></span>
									</div>
								</td>
							</tr>

							<tr>
								<td>
									<label class="control-label" for="input01">
										Limit Setor
									</label>
									<div class="controls ">
										<?php echo form_input(array('name' =>'txtLimitSetor','id'=>'txtLimitSetor','class' =>'input-medium nomor','style'=>'text-align:right','required'=>'required','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
									</div>
								</td>
							</tr>

							<tr>
								<td>
									<label class="control-label" for="input01">
										Limit Kas Umum
									</label>
									<div class="controls ">
										<?php echo form_input(array('name' =>'txtLimitKas','id' =>'txtLimitKas','class'=>'input-medium nomor','style'=>'text-align:right','required'=>'required','onkeyup'=>'AddAndRemoveSeparator(this);'));?>
									</div>
								</td>
							</tr>
							
							<tr>
								<td>
									<label class="control-label" for="input01">
										User Group
									</label>
									<div class="controls">
										<?php
											$data = array();
											foreach ($groupname->result_array() as $row)
												{
													$data[$row['GROUPNAME']] = $row['GROUPNAME']; 
												}  
											  echo form_dropdown('DL_groupname', $data,'','id="DL_groupname" class="input-medium"');
										?>
									</div>
								</td>
							</tr>
							
							<tr>
								<td>
									<label class="control-label" for="input01">
										User Level
									</label>
									<div class="controls">
										<?php
											$data = array();
											foreach ($level->result_array() as $row)
												{
													$data[$row['level_nama']] = $row['level_nama']; 
												}  
											  echo form_dropdown('DL_level', $data,'','id="DL_level" class="input-medium"');
											  
											  echo form_input(array('name' =>'txtLevelId','id' =>'txtLevelId','style'=>'width:5px;','required'=>'required','class'=>'hidden'));
										?>
									</div>
									
								</td>
							</tr>

							<tr>
								<td  >
								<br />
									<div class="controls">
										<button type="submit" class="btn btn-success ladda-button" id="btnSimpanUser" name="btnSimpanUser" >
											<i class="icon-save"></i><span class="ladda-label"> Simpan</span>
										</button>
										<a class="btn btn-danger" id="btnReset" name="btnReset"><i class="icon-undo"></i> Reset</a>
									</div>
								</td>
							</tr>

						</table>

					</div>
					
					<div style="margin-right: 50px; width:600px;float: right; margin-top: 5px;" class="form-horizontal">	
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
										Data User
									</a>
								</div>
								<div id="collapseOne" class="accordion-body">
									<div class="accordion-inner" style="height: 300px;overflow:auto;">
										<table class='table table-bordered table-hover table-striped' id="tabel_user">
											<thead >
												<tr>
													<th width='10%' align='left'>Userid</th>
													<th width='30%' align='left'>Username</th>
													<th width='15%' align='center'>User Group</th>
													<th width='15%' align='left'>Limit Tarik</th>
													<th width='15%' align='left'>Limit Kas</th>
													<th width='15%' align='center'>Limit Setor</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach($passwd->result() as $row){
													?>
													<tr>
														<td><?php echo $row->USERID;?></td>
														<td><?php echo $row->USERNAME;?></td>
														<td><?php echo $row->USERGROUP;?></td>
														<td><?php echo number_format($row->LIMIT_TARIK);?></td>
														<td><?php echo number_format($row->LIMIT_KASUMUM);?></td>
														<td><?php echo number_format($row->LIMIT_SETOR);?></td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
										<div id="pageNavPosition"></div>
									</div>
								</div>
							</div>

						</div>
					</div>
					</div>
				</div><!-- end tab 2 -->
			</div>
			
			
		<?php echo form_close(); ?>
	</div>
	
	<!-- modal user -->
	<div id="cari_user" class="modal hide " style="width:30%;" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>  
			<div class="form-search input-append">
			  <input type="text" class="input-medium search-query" id="kwd_search">
			  <span class="btn">
			     <i class="icon-search"></i>
			  </span>
			</div>
		</div>
		<div class="modal-body" style="height:80%;">
			<table class='table table-bordered table-hover table-striped' id="tabel_userid">
			 	<thead>
			      <tr>
			         <th width='10%' align='left'>ID</th>
			         <th width='90%' align='left'>LEVEL</th>
			      </tr>
				</thead>
				<tbody>
				  <?php
					foreach($level->result() as $row){
						?>
						<tr>
							<td><?php echo $row->level_id;?></td>
							<td><?php echo $row->level_nama;?></td>
						</tr>
						<?php
					}
				  ?>
			   </tbody>
		 </table>
		</div>
	</div>

	<!-- start tree configuration -->
    <script src="<?php echo base_url('bootstrap/js/jquery.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap.js') ?>"></script> 
	<script src="<?php echo base_url('bootstrap/js/bootstrap-tab.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap-collapse.js') ?>"></script>
	<!--<script src="<?php echo base_url('assets/tree/js/jquery-ui.js') ?>"></script>-->
    <script src="<?php echo base_url('assets/tree/js/jquery.tree.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/spin.min.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/ladda.min.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/spiner/prism.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/lazada-spin.js') ?>"></script>	
	<script src="<?php echo base_url('bootstrap/js/pembantu.js') ?>"></script>
	<script src="<?php echo base_url('bootstrap/js/paging.js') ?>"></script>
	
	<script type="text/javascript">
		var pager = new Pager('tabel_user', 5); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
		
		function getChecked(){
            var nodes = $('#tree_menu').tree('getChecked');
            var s = '';
            for(var i=0; i<nodes.length; i++){
                if (s != '') s += ',';
                s += nodes[i].text;
            }
            alert(s);
        }
		
		function get_level_id(){
		var kd=$('#DL_level').val();
		$.post("<?php echo site_url('/akses_user/level_id'); ?>",
			{
				'kode' : kd
			},
			function(data)
			{
				$('#txtLevelId').val(data.level_id);
			},"json");
		}
		
		$(document).ready(function()
			{
				get_level_id();
				$('#DL_level').change(function(){
					get_level_id();
				});
			
				$("#btnUser").click(function(event){
				  	$("#cari_user").modal('show');
				});
				
				$('#tree_menu').tree(
					{
						onCheck:
						{
							node: 'expand'
						},
						onUncheck:
						{
							node: 'collapse'
						}
					});
					
				 $('#checkAll').click(function(){
                    $('#tree_menu').tree('checkAll');
                 });
				 
				  $('#UncheckAll').click(function(){
                    $('#tree_menu').tree('uncheckAll');
                 });

				$('.nomor').val('0');
				
				$("#txtLimitTarik").focus(function(){
					$('#txtLimitTarik').val('');
					$('#txtLimitTarik').focus();
				});
				
				$("#txtLimitSetor").focus(function(){
					$('#txtLimitSetor').val('');
					$('#txtLimitSetor').focus();
				});
				
				$("#txtLimitKas").focus(function(){
					$('#txtLimitKas').val('');
					$('#txtLimitKas').focus();
				});
				
				$("#btnReset").click(function()
					{
						$('.bersih').val('');
						$('.nomor').val('0');
						$('#txtUsername').focus();
					});
					
				$("#btnReset1").click(function()
					{
						$('#txtUserid').val('');
						$('#txtUsername').val('');
						 $('#tree_menu').tree('uncheckAll');
					});

				$(".nomor").keypress(function (e)
					{
						if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
						{
							$("#errmsg").html("Digits Only").show().fadeOut("slow");
							return false;
						}
					});

				$("#kwd_search").keyup(function()
					{
						if( $(this).val() != "")
						{
							$("#tabel_userid tbody>tr").hide();
							$("#tabel_userid td:contains-ci('" + $(this).val() + "')").parent("tr").show();
						}
						else
						{
							$("#tabel_userid tbody>tr").show();
						}
					});

				var tr = $('#tabel_userid').find('tr');
				tr.bind('click', function(event)
					{
						var userid = '';
						var usernama = '';

						tr.removeClass('row-highlight');
						var td1 = $(this).addClass('row-highlight').find('td:nth-child(1)');
						var td2 = $(this).addClass('row-highlight').find('td:nth-child(2)');

						$.each(td1, function(index, item)
							{
								userid = userid + item.innerHTML;
							});
						$.each(td2, function(index, item)
							{
								usernama = usernama + item.innerHTML;
							});
							
						$('#txtUserid').val(userid);
						$('#txtUsername').val(usernama);
						$('#cari_user').modal('hide');
					});
					
				var tr = $('#tabel_user').find('tr');
				tr.bind('click', function(event)
					{
						var userid = '';
						var usernama = '';
						var group = '';
						var tarik = '';
						var kas = '';
						var setor = '';

						tr.removeClass('row-highlight');
						var td1 = $(this).addClass('row-highlight').find('td:nth-child(1)');
						var td2 = $(this).addClass('row-highlight').find('td:nth-child(2)');
						var td3 = $(this).addClass('row-highlight').find('td:nth-child(3)');
						var td4 = $(this).addClass('row-highlight').find('td:nth-child(4)');
						var td5 = $(this).addClass('row-highlight').find('td:nth-child(5)');
						var td6 = $(this).addClass('row-highlight').find('td:nth-child(6)');

						$.each(td1, function(index, item)
							{
								userid = userid + item.innerHTML;
							});
						$.each(td2, function(index, item)
							{
								usernama = usernama + item.innerHTML;
							});
						$.each(td3, function(index, item)
							{
								group = group+ item.innerHTML;
							});
						$.each(td4, function(index, item)
							{
								tarik = tarik+ item.innerHTML;
							});
						$.each(td5, function(index, item)
							{
								kas = kas + item.innerHTML;
							});
						$.each(td6, function(index, item)
							{
								setor = setor+ item.innerHTML;
							});
							
						$('#txtUseridInput').val(userid);
						$('#txtUsernameInput').val(usernama);	
						$('#DL_groupname').val(group);	
						$('#txtLimitKas').val(kas);
						$('#txtLimitTarik').val(tarik);	
						$('#txtLimitSetor').val(setor);
						$('#txtPassword').focus();
					});

				$(".modal").on('shown', function()
					{
						$(this).find("#kwd_search").focus();
						$(this).find("#kwd_search").val('');
					});
				
				$("#txtRePassword").focusout(function(){
					if ($(this).val() != $("#txtPassword").val()) { 
						alert("Pasword tidak sama");
					    $(this).val('');
						$("#txtPassword").val('');
						$("#txtPassword").focus();
					}
				});

			});
			$.extend($.expr[":"],
			{
				"contains-ci": function(elem, i, match, array)
				{
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "")
						.toLowerCase()) >= 0;
				}
			});
	</script>
</div>