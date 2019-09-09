<?php //pr($_SESSION); die;?>
<section class="panel">
  <header class="panel-heading">
        <div id="filter-panel" class="filter-panel">
   
           
                <div class="row">
                      <div class="col-md-6" >
                      
                        <h3><strong>
                          <?php $heading = $this->get_advance_search_heading();
                              echo $ui_string[$heading];
                          ?>
                          </strong></h3>

                        </div>
                      <div class="col-md-6 text-right" >
                        <h4>  
                        <div><button class="btn btn-theme-inverse" id="adv_search_btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $ui_string['expand'];?></button></div>
                        </h4>
                      </div>
                </div>
                       </div>
                   </header>
				   <div class="panel-body">
                    <div class="grid" id="adv_search" style="display: none">
                    <div id="stadd" class="" style="display:block" >
                               
                                
                         
                    </div>
                      <div class=" mt-15">
                            <label><?php echo $ui_string['saved_queries'];?></label>
                            <select id="sel_query" class="form-control" onchange="show_query(this.value)">
                                <option value=""><?php echo $ui_string['select_query']; ?></option>

                            </select>

                      </div> 
                      <div class="text-right mt-15">
                      <button type="button" onclick="make_query()" class="btn btn-theme-inverse"><?php echo $ui_string['make_query'];?></button>
                      <button type="button" onclick="set_query_name()" class="btn btn-theme-inverse after-query" disabled="disabled"><?php echo $ui_string['save_query'];?></button>
                      <button type="button" disabled="disabled" onclick="make_datatable()" class="btn btn-theme-inverse after-query"><?php echo $ui_string['search'];?></button>
                      <button type="button" onclick="refresh_custom_dt()" class="btn btn-theme-inverse"><?php echo $ui_string['refresh'];?></button>
                      </div> 
                      <div class="row">
                      <div class="col-md-12 margn_tp_7" style="display: block;">
                        <label><?php echo $ui_string['query_string'];?></label>
                        <textarea id="query_write" readonly  class="form-control" rows="5"></textarea>
                      </div>
                    </div>

                    </div>

</div>
           
     
   
</section>
