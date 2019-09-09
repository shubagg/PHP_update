
 
				   
                    <div class="grid advance_ui u02toolpop" id="adv_search" style="display: none">
                    <i></i>
                    <div id="stadd" class="col-md-12" style="display:block" >
                         
                    </div>
                      <div style="display: none" class="">
                            <label><?php echo $ui_string['saved_queries'];?></label>
                            <select id="sel_query" class="form-control" onchange="show_query(this.value)">
                                <option value=""><?php echo $ui_string['select_query']; ?></option>

                            </select>

                      </div> 
                      <div class="text-right mt-15">
                      <button style='display:none' type="button" onclick="make_query()" class="btn btn-theme-inverse"><?php echo $ui_string['make_query'];?></button>
                      <button style='display:none' type="button" onclick="set_query_name()" class="btn btn-theme-inverse after-query" disabled="disabled"><?php echo $ui_string['save_query'];?></button>
                      <button  type="button"  onclick="make_query()" class="btn btn-theme-inverse after-query"><?php echo $ui_string['search'];?></button>
                      <button type="button" onclick="refresh_custom_dt()" class="btn btn-theme-inverse"><?php echo $ui_string['refresh'];?></button>
                      </div> 
                      <div class="row" style="display: none">
                      <div class="col-md-12 margn_tp_7" style="display: block;">
                        <label><?php echo $ui_string['query_string'];?></label>
                        <textarea id="query_write" readonly  class="form-control" rows="5"></textarea>
                      </div>
                    </div>

                    </div>

           
     
   

