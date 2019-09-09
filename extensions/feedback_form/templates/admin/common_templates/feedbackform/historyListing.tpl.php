<section class="panel">
    <!--<a href="javascript:;" onclick="show_datatable(334,'j.priority=3')">hello</a>-->

<div class="panel-body">
<header class="panel-heading">
    <div class="row">
       <div class="row">
            <div class="col-sm-12">
                <label>Select Status</label>
            </div>
            <div class="col-sm-3">
                <select class="form-control requestType" onchange="getRequestTypeData(this.value)">
                    <option <?php if($_GET['requestType']=='RETURN,CONSUMED'){ echo "selected=''"; } ?> value="RETURN,CONSUMED"> All </option>
                    <option <?php if($_GET['requestType']=='CONSUMED'){ echo "selected=''"; } ?> value="CONSUMED"> Consumed </option>
                    <option <?php if($_GET['requestType']=='RETURN'){ echo "selected=''"; } ?> value="RETURN">Return</option>
                </select>
            </div>
          </div>
</div>
</header>

 <div class="panel-body">
        <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="table table-striped">
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




