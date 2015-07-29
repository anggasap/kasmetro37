  <div id="cari_rek" class="easyui-window" title="Nasabah" data-options="iconCls:'icon-save'" style="width:800px; height:580px;padding:10px;">  
		<div class="form-search input-prepend">
			  <input type="text" class="input-medium search-query" id="kwd_search" placeholder="Cari...">
		</div>
        <div class="scroll">
            <table class='table table-bordered table-hover table-striped' id="tabel_rek">
              <thead>
                        <tr>
                           <th width='10%' align='left'>NASABAH ID</th>
                           <th width='20%' align='left'>NAMA</th>
                           <th width='70%' align='left'>ALAMAT</th>
                        </tr>
                      </thead>
              <tbody>
                <?php
				
                 foreach($data_nasabah as $row){
                            ?>
                            <tr>
                               <td><?php echo $row['nasabah_id'];?></td>
                               <td><?php echo $row['nama_nasabah'];?></td>
                               <td><?php echo $row['alamat'];?></td>
                            </tr>
                            <?php
                         } 
                ?>
             </tbody>
            </table>
        </div><!-- end scroll -->    
        <div id="pageNavPosition"></div>
    </div>
	