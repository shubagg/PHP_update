
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6"><?php echo get_chart_date_picker('From Date','conf_from_date'); ?></div>
<div class="col-md-6 col-sm-6 col-xs-6"><?php echo get_chart_date_picker('To Date','conf_to_date'); ?></div>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12"><?php echo get_select_box('select','Refresh Interval','conf_refresh_interval','conf_refresh_interval','','','<option value="15">15 Min</option><option value="30">30 Min</option><option value="60">60 Min</option>'); ?></div>
</div>
</div>
