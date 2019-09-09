<table cellpadding="0" cellspacing="0" border="0"
								class="table table-striped table-hover" id="table-example2">
								<thead>
									<tr>
										<th>Category Name</th>
										
										<th class="action_width">Action</th>
									</tr>
								</thead>
								<tbody align="center">
									<?php
                                        foreach($categories as $category)
                                        {
                                    ?>
                                        <tr>
    										<td valign="middle"><?php echo $category['name']; ?></td>
    										<td><span class="tooltip-area"> <a
    												href="add_category.html" data-toggle="modal"
    												data-target="#edit-category-1"
    												class="btn btn-default btn-sm" title="Edit"><i
    													class="fa fa-pencil"></i></a>&nbsp; <a
    												href="javascript:void(0)" data-toggle="modal"
    												data-target="#delete0" class="btn btn-default btn-sm"
    												title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp; <a
    												href="javascript:void(0)" data-toggle="modal"
    												data-target="#role-1" class="btn btn-default btn-sm"
    												title="Role"><i class="glyphicon glyphicon-th-large"></i></a>&nbsp;
    												 <a
    												href="javascript:void(0)" data-toggle="modal"
    												data-target="#add-group" class="btn btn-default btn-sm"
    												title="Role"><i class="glyphicon glyphicon-plus-sign"></i></a>
    										</span></td>
    									</tr>
								    <?php
                                        }
                                    ?>	
								</tbody>
							</table>