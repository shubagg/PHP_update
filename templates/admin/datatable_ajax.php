<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover datatable" id="<?php echo $data['table_id']; ?>">
				<thead>
                <?php $head_rows=$data['table_data']['head']; $table_id=$data['table_id']; ?>
                
					<tr>
                    <?php foreach($head_rows as $row){ ?>
                        <?php if($row=='checkbox'){ ?>
						<th class="checkbox_width"><span class="iCheck checkbox"
							data-color="red"> <input type="checkbox"> <label></label>
						</span></th>
                        <?php }else{ ?>
                        <th><?php echo $row; ?></th>
					<?php  }} ?>
                    	
					</tr>
				</thead>
				        <tbody align="center">
										
                        </tbody>
</table>
