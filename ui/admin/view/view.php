
<?php include('../../../global.php'); 
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
$getuserip=get_client_ip_env();
get_admin_header();
get_admin_header_menu(); 
get_admin_left_sidebar(); 
$checkhighlight="0";
if(isset($_GET['id']) && $_GET['id']!=""){
  $checkhighlight="1";

}
?>
<?php
	include_once(include_admin_template("controlTower","controlTower")); 
?>

  
        <script>
          var useripaddress='<?php echo $getuserip; ?>';
          var checkhighlight="<?php echo $checkhighlight ?>";
          function checkalldata(){}
          function load_page(type,tab_name )
          { 
            $.ajaxSetup ({
              cache: false
            });
            var loadUrl = site_url+"admin/controller/index.php?type="+type+"&class="+tab_name;
            $( ".tab-pane").html('');
            $( "#"+tab_name ).load(loadUrl,function(){ 
            	setTimeout(function(){ refresh_custom_dt(); 
                
                setTimeout(function(){
                  if(checkhighlight=="1"){ $("#highlight-<?php echo $_GET['id']; ?>").parent().siblings().css('background-color', '#CD5C5C'); $("#highlight-<?php echo $_GET['id']; ?>").parent().css('background-color', '#CD5C5C'); }
                  }, 1000);

              },500);
            });
          }
          load_page('viewlist','view');

          function open_configuration()
          {
          	var page="configuration";
          	window.location=page;
          }
          function configuration_temp(asid,id){
            $.ajax({
                      type: "POST",
                      url:  admin_ui_url+"view/ajax/manage.php?action=senddata",
                      data: {"id":asid,"ip":useripaddress,"c_id":id},
                          success: function(result){
                                  $("#model_head").html(ui_string['success']);
                                  $("#model_des").html("Run Robot.");
                                  $('#success_modal').modal();
                                  setTimeout(function(){ $('#success_modal').modal("toggle"); },1000);
                                  refresh_custom_dt();
                  }});
          }
          function assign_robot(asid,id){
            genericUsersPopup(asid,id);
          }
          function delete_robot(asid,id){
                    $.ajax({
                      type: "POST",
                      url:  admin_ui_url+"view/ajax/manage.php?action=delete_robot",
                      data: {"id":id,"asid":asid},
                          success: function(result){
                                  $("#model_head").html(ui_string['success']);
                                  $("#model_des").html("Delete Robot.");
                                  $('#success_modal').modal();
                                  setTimeout(function(){ location.reload(); },1000);
                                  refresh_custom_dt();
                  }}); 
          }
          function edit_robot(asid,id){
              window.location=site_url+"admin/configuration?id="+asid;
          }
        </script>

<?php get_enroll_users_popup_rpa('',$all_cats,'enroll-user','1',array('mid'=>'50','smid'=>'1')); ?> 
<?php
get_admin_footer();
?>