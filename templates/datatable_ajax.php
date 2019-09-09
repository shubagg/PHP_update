<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover" id="<?php echo $data['table_id']; ?>">
				<thead>
                <?php $head_rows=$data['table_data']['head']; $table_id=$data['table_id']; ?>
                
					<tr>
                    <?php foreach($head_rows as $row){ ?>
                        <?php if($row=='checkbox'){ ?>
						<th style="" class="checkbox_width ripu"> <label></label>
						</th>
                        <?php }else{ ?>
                        <th><?php echo $row; ?></th>
					<?php  }} ?>
                    	
					</tr>
				</thead>
				        <tbody align="center">
										
                        </tbody>
</table>
<?php 
    $ar=array();
    foreach($show_fields as $fields)
    {
        array_push($ar,array("mDataProp"=>$fields));
    }
?>
<script>

showFields.push({'<?php echo $table_id; ?>':<?php echo json_encode($ar); ?>});

$(document).ready(function() {
	$('#<?php echo $table_id; ?>')
        .on('xhr.dt', function ( e, settings, json ) {
            if(e['type']){
                checkalldata('<?php echo $table_id; ?>');
            }
        } )
    
    
        .dataTable( {
    		"bProcessing": true,
    		"bServerSide": true,
    		"sAjaxSource": "<?php echo $url.'?_csrf='; ?>" + $('#_csrf').val(),
            "aoColumns":<?php echo json_encode($ar); ?>
    	} );

} );
</script>
