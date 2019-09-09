<table cellpadding="0" cellspacing="0" border="0" class="table datatable" id="<?php echo $data['table_id']; ?>" >
				<thead>
                <?php $head_rows=$data['table_data']['head']; $table_id=$data['table_id']; ?>
                
					<tr>
                    <?php foreach($head_rows as $row){ ?>
                        <?php if($row=='checkbox'){ ?>
						<th class="checkbox_width">&nbsp;</th>
                        <?php }else{ ?>
                        <th><?php echo $row; ?></th>
					<?php  }} ?>
                    	
					</tr>
				</thead>
									<tbody >
										<?php $rows=$data['table_data']['rows']; ?>
                                        <?php $i=0;  foreach($rows as $row){ ?>
                                        <?php $show_data=$row['data']; ?>  
                                          
                                            <tr>
                                                <?php foreach($show_data as $row_data){ ?>
                                                <?php  
                                                        $row_data=explode("|-|",$row_data);
                                                        switch($row_data[0])
                                                        {
                                                            case "checkbox":
                                                                ?>
                                                                    <td>
                                                                        <span class="checkbox" data-color="red">
                            													<input id="ch_<?php echo $row['id']; ?>" onclick="checkBoxChecked(this.id)" name="numbers[]" value="<?php echo $row['id']; ?>" class="check_box" type="checkbox"/> <label></label>
                            											</span>
                                                                    </td>
                                                                <?php
                                                             break;   
                                                             
                                                             case "status":
                                                             $color="red";
                                                             $status='inactive';
                                                             if($row_data[1]=='1')
                                                             {
                                                                $color="green";
                                                                $status='active';
                                                             }
                                                                ?>
                                                                    <td>
                                                                        <a onclick="update_status(this.id)" data-status="<?php echo $status; ?>" data-id="<?php echo $row['id']; ?>" id="status-<?php echo $row['id']; ?>" style="border-color: <?php echo $color; ?>; color: <?php echo $color; ?>;" class="btn btn-default btn-link" title="">
                                                                           <i class="glyphicon glyphicon-off"></i>
                                                                        </a>
                                                                    </td>
                                                                <?php
                                                             break;
                                                              case "image":
                                                                ?>
                                                                    <td><img src="<?php echo $row_data[1]; ?>" width="50" height="50"/></td>
                                                                <?php
                                                             break;
                                                             
                                                             case "Action":
                                                                
                                                                ?>
                                                                    <td>
                                                                        <span class="tooltip-area"> 
                                                                        <?php
                                                                        $buttons=$data['table_data']['rows'][$i]['Action'];
                                                                        get_admin_action_button($buttons,$row['id'],$table_id);
                                                                        ?>
                											            </span>
                                                                    </td>
                                                                
                                                                <?php   
                                                            break;
                                                            case "eventlink":
                                                                
                                                                ?>
                                                                    <td><a href="<?php echo $row_data[1]; ?>">Detail</a></td>
                                                                
                                                                <?php   
                                                            break;
                                                            case "lat":
                                                                
                                                                ?>
                                                                    <td><?php echo base64_decode(($row_data[1])); ?></td>
                                                                
                                                                <?php   
                                                            break;
                                                            case "lng":
                                                                
                                                                ?>
                                                                    <td><?php echo base64_decode(($row_data[1])); ?></td>
                                                                
                                                                <?php   
                                                            break;
                                                            default:
                                                                ?> <td><?php echo $row_data[0]; ?></td> <?php
                                                            break;
                                                        }
                                                }
                                                ?>
    										</tr>
                                        <?php $i++;} ?>
                        </tbody>
</table>
