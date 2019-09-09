<header>
<div class="row">
<div class="col-md-7 col-xs-7">
 <div class=" tooltip-area">
            <?php
              $jobsmid=$_GET['job'];
              $smid_j_name=get_submodule_name(array("mid"=>'5',"smid"=>$jobsmid));
              $smid_name_job=$smid_j_name['data'][0]['smval'];
              if(check_user_permission("job",$smid_name_job,"add")==1 || check_user_permission("job",$smid_name_job,"all")==1) {?>
               <button type="button" data-toggle="tooltip" data-placement="bottom" title="<?php echo $ui_string['add_new'];?>" id='newjob' class="btn btn-theme-inverse btn-transparent" onclick="add_job();"><i class="fa fa-plus"></i></button>
              <?php }  if(check_user_permission("job",$smid_name_job,"view")==1 || check_user_permission("job",$smid_name_job,"all")==1) { ?>
               <button type="button" data-toggle="tooltip" data-placement="bottom" title="<?php echo $ui_string['creater_job'];?>" id="myjob" class="btn btn-theme-inverse btn-transparent jobactive active" onclick="getJoblist(this.id);"><i class="fa fa-briefcase"></i></button>
               <button type="button" data-toggle="tooltip" data-placement="bottom" title="<?php echo $ui_string['user_job'];?>" id="userjob" class="btn btn-theme-inverse btn-transparent jobactive" onclick="getJoblist(this.id);"><i class="fa fa-user"></i></button>
               <?php } ?>
            </div>
</div>
<div class="col-md-5 col-xs-5">
<div id="filter-panel" class="filter-panel">
	<div class="text-right">
	 <?php $heading = $this->get_advance_search_heading(); 
    if(check_user_permission("job",$smid_name_job,"advance_search")==1 || check_user_permission("job",$smid_name_job,"all")==1) {?>
                      <a href="javascript:;" id="adv_search_btn"> <?php echo $ui_string[$heading];?> <i
      class="fa fa-plus-circle" aria-hidden="true"></i></a>
      <?php }?>
	</div>
</div>
</div>
</div>
</header>
<div class="grid" id="adv_search" style="display: none">
			<div id="stadd" class="" style="display: block"></div>

			<div class="margn_btm_10">
                            <label><?php echo $ui_string['saved_queries'];?></label>
                            <select id="sel_query" class="form-control" onchange="show_query(this.value)">
                                <option value=""><?php echo $ui_string['select_query']; ?></option>

                            </select>

            </div> 
			<div class="text-right">
                      <button type="button" onclick="make_query()" class="btn btn-theme-inverse"><?php echo $ui_string['make_query'];?></button>
                      <button type="button" onclick="set_query_name()" class="btn btn-theme-inverse after-query" disabled="disabled"><?php echo $ui_string['save_query'];?></button>
                      <button type="button" disabled="disabled" onclick="make_datatable()" class="btn btn-theme-inverse after-query"><?php echo $ui_string['search'];?></button>
                      <button type="button" onclick="refresh_custom_dt()" class="btn btn-theme-inverse"><?php echo $ui_string['refresh'];?></button>
                      </div> 
			<div class="row">
				<div class="col-md-12 margn_tp_7" style="display: block">
					<label><?php echo $ui_string['query_string'];?></label>
					<textarea id="query_write" readonly class="form-control" rows="3" placeholder=""></textarea>
				</div>
			</div>

		</div>