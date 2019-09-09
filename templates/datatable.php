<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover datatable" id="data_table_1">
            <thead>
                <?php $head_rows=$data['table_data']['head']; $table_id=$data['table_id'];$class=isset($data['class'])?$data['class']:"";$attr=isset($data['attr'])?$data['attr']:"";?>
                
					<tr>
                    <?php foreach($head_rows as $row){ ?>
                        <?php if($row=='checkbox'){ ?>
    						<th class="checkbox_width">
                            </th>
                        <?php }else{ ?>
                        <th><?php echo $row; ?></th>
					<?php  } ?>
                    <?php  } ?>
                    	
					</tr>
				</thead>
                <tbody align="center" id="tableData">
										<?php $rows=$data['table_data']['rows']; ?>
                                        <?php $i=0;  foreach($rows as $row){?>
                                        <?php $show_data=$row['data']; ?>  
                                          
                                            <tr>
                                                <?php foreach($show_data as $row_data){ ?>
                                                <?php  
                                                        switch($row_data)
                                                        {
                                                            case "checkbox":
                                                                ?>
                                                                    <td>
                                                                        <span class="checkbox" data-color="red">
                            													<input id="ch_<?php echo $row['id']; ?>" class="check_box <?php echo $class;?>" value="<?php echo $row['id']; ?>" <?php echo $attr;?> name="numbers[]" onclick="checkBoxChecked(this.id)" type="checkbox"> <label></label>
                            											</span>
                                                                    </td>
                                                                <?php
                                                             break;   
                                                             case "Action":
                                                                
                                                                ?>
                                                                    <td>
                                                                        <span class="tooltip-area"> 
                                                                        <?php
                                                                        $buttons=$data['table_data']['rows'][$i]['Action'];
                                                                        get_action_button($buttons,$row['id'],$table_id);
                                                                        ?>
                											            </span>
                                                                    </td>
                                                                
                                                                <?php   
                                                            break;
                                                            default:
                                                                ?> <td><?php echo $row_data; ?></td> <?php
                                                            break;
                                                        }
                                                }
                                                ?>
    										</tr>
                                        <?php $i++;} ?>
                        </tbody>
</table>