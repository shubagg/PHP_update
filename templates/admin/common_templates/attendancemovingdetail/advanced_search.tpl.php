<section class="panel" >
    <div class="panel-body panel_bg_d">
        <div id="filter-panel" class="filter-panel">
    
            
                <div class="row">
                      <div class="col-md-6" style="display: ">
                      
                        <h4><strong>
                          <?php $heading = $this->get_advance_search_heading();
                              echo $ui_string[$heading];
                          ?>
                          </strong></h4>

                        </div>
                      <div class="pull-right panel-body panel_bg_d text-right" >
                        <h4>  
                        <div><button class="btn btn-theme-inverse" id="adv_search_btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $ui_string['expand'];?></button></div>
                        </h4>
                      </div>
                </div>
                    
                   
                    <div class="grid" id="adv_search" style="display: none;">
                    <div id="stadd" class="" style="display:block" >
                               
                                
                         
                    </div>
                      <div class="mt-15">
                      <button type="button" onclick="make_query()" class="btn btn-theme-inverse"><?php echo $ui_string['make_query'];?></button>
                       <button type="button" disabled="disabled" onclick="set_query_name()" class="btn btn-theme-inverse after-query" ><?php echo $ui_string['save_query'];?></button>
                      <button type="button" disabled="disabled" onclick="make_datatable()" class="btn btn-theme-inverse"><?php echo $ui_string['search'];?></button>
                      <button type="button" onclick="refresh_custom_dt()" class="btn btn-theme-inverse"><?php echo $ui_string['refresh'];?></button>
                      </div> 
                      <div class="row">
                      <div class="col-md-12 margn_tp_7" style="display: none;">
                        <label><?php echo $ui_string['query_string'];?></label>
                        <textarea id="query_write" readonly  class="form-control" rows="5"></textarea>
                      </div>
                    </div>

                    </div>


                
            
        </div>
    </div>
</section>
