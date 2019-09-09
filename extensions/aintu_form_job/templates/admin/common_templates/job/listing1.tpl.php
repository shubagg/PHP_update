<section class="panel">
<div class="">
  <div class="row">
  <div class="col-xs-12 text-right">
  	<?php
                        echo $this->custom_buttons(); 
                    ?>
  </div>
  	
  </div>
 <div class="">
        <table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-striped">
            <thead>
                <tr>
                    <?php 
                    $table_header = $this->get_table_header();
                    
                    if(is_array($table_header) && count($table_header)) { 
                        
                        foreach($table_header as $val) {
                            ?>
                            <th class="text-center2">
                                <?= $ui_string[$val]; ?>
                            </th>
                            <?php
                        }
                        ?>
                    <?php } ?>
                </tr>
            </thead>
        </table>
        </div>
</div>
</section>




