<section>
    <div class="panel-body">
        <div id="filter-panel" class="filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                      <strong>
                      <?php $heading = $this->get_advance_search_heading();
                        echo $ui_string[$heading];
                      ?>
                      </strong>
                    </h4>
                    <br/>
                    <div class="grid"></div>
                    <div id="stadd" style="display:block">
                               
                                
                         
                    </div>
                      <div class="text-right mt-15">
                      <button type="button" onclick="make_query()" class="btn btn-theme-inverse"><?php echo $ui_string['make_query'];?></button>
                       <button type="button" disabled="disabled" onclick="set_query_name()" class="btn btn-theme-inverse after-query" ><?php echo $ui_string['save_query'];?></button>
                      <button type="button" disabled="disabled" onclick="make_datatable()" class="btn btn-theme-inverse"><?php echo $ui_string['search'];?></button>
                      <button type="button" onclick="refresh_custom_dt()" class="btn btn-theme-inverse"><?php echo $ui_string['refresh'];?></button>
                      </div> 
                      <div class="row">
                      <div class="col-md-12 margn_tp_7">
                        <label><?php echo $ui_string['query_string'];?></label>
                        <textarea id="query_write" readonly  class="form-control" rows="5"></textarea>
                      </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</section>
