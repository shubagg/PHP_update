function create_dashboards(){
    $("#add_dashboard").attr("disabled","disabled");
    renderComponents($("#DASH_TYPE"));
    var dash_name=$('#categoryname').val();
    
        //$('#ecategoryname').html();
    var dashboard_type=$('input[name="priglob"]:checked').val();   
    if (typeof(dashboard_type) == 'undefined')
        {
            var dash_type=1;
        } 
    else
        {
         var dash_type=dashboard_type;
        }
        var DashManage='def'
          if(dashboard_type==0)
          {
            var checked = []
          
    $("input[name='manage_dashboard[]']:checked").each(function ()
    {
        checked.push(parseInt($(this).val()));
    });
    if(checked=='')
    {
    var DashManage=2;
    }
    else
    {
      var DashManage=checked;
    }
  }
    var user_id=$('#user_id').val();
    var template_type=$('#tplType').val();
    //var creation_date=new Date();
    var dash_desc=$('#categorydescription').val();
    
   // alert("Type : "+template_type);
        $.ajax({
            url:admin_ui_url+"dashboard/ajax/create_dashboard.php",
            data:"dash_name="+dash_name+"&user_id="+user_id+"&dash_desc="+dash_desc+"&dash_type="+dash_type+"&template_type="+template_type+"&DashManage="+DashManage,  
            type:"POST",
              success:function(suc){
               console.log(suc);
               
               },
               complete:function(){
                  window.location.href='dashboardMainUI.php';
                 location.reload();
               }
        });  
}
function show_basic_charts(module,smid){
    $.ajax({
        url:admin_ui_url+"dashboard/ajax/show_basic_charts.php",
        data:"mid="+module+"&smid="+smid,
        type:"POST",
        success:function(suc){
      // alert(suc);
        $basic_chart_data=suc;
        $('#basic_charts111').html(suc);
$('#categories').modal();
         }
        });  
 }
 function show_report(module,smid){
    $.ajax({
        url:admin_ui_url+"dashboard/ajax/add_report_ajax.php",
        data:"mid="+module+"&smid="+smid,
        type:"POST",
        success:function(suc){
      // alert(suc);
        $basic_chart_data=suc;
        $('#basic_report111').html(suc);
$('#report').modal();
         }
        });  
 }
 function get_widget_info(chart_id)
 {
     var widgetDetail;
     $.ajax({
            url:admin_ui_url+"dashboard/ajax/get_widget_info.php",
            data:"widget_id="+chart_id,
            type:"POST",
            async:false,
            success:function(suc){
                widgetDetail = suc;
            }
        });
     return widgetDetail;
 }
 
 function open_add_widget(chart_id, chart_type, chart_name, chart_img, chart_url, prefix, widget_config)
{
            var dash_id = $("#myTab li.active").attr('id');
            var widget_info = get_widget_info(chart_id);
            widget_info = JSON.parse(widget_info);
            var chart_Img =  widget_info['chart_Img'];
            var chart_title = widget_info['chart_name'];
            var chart_desc = widget_info['chart_desc'];
            var module_name = widget_info['module_name'];
            $("#hdn_dash_id").val(dash_id);
            $("#hdn_chart_id").val(chart_id);
            $("#hdn_chart_type").val(chart_type);
            $("#hdn_chart_name").val(chart_name);
            $("#hdn_chart_img").val(chart_img);
            $("#hdn_chart_url").val(chart_url);
            $("#hdn_prefix").val(prefix);
            $.ajax({
            url:admin_ui_url+module_name+"/widget/widget_config/"+widget_config,
            data:"dash_id="+dash_id+"&chart_id="+chart_id+"&chart_type="+chart_type+"&chart_name="+chart_name+"&chart_img="+chart_img+"&chart_url="+chart_url+"&prefix="+prefix,
            type:"POST",
            success:function(suc){
           //alert(suc);
              //alert(admin_assets_url+"img/chart/"+chart_img);
                $("#config_title").text(chart_title);
                $("#config_desc").text(chart_desc);
                 $("#custom_config_file").html(suc);
                $("#Chart_Image").attr("src", admin_assets_url+"img/chart/"+chart_img);
                $('#add_category').modal();
                renderComponents($("#projectList"));
                renderComponents($("#period"));
                renderComponents($("#days_prev"));
                renderComponents($("#avg_dur"));
                renderComponents($("#all_status"));
                renderComponents($("#staticType"));
                renderComponents($("#sor_Dir"));
                renderComponents($("#data_type"));
                renderComponents($("#attendance"));
                renderComponents($("#getQuery"));
                renderComponents($("#formList"));
                renderComponents($("#resourcePeriod"));
                renderComponents($("#assignUser"));
                renderComponents($("#fromStatus"));
                renderComponents($("#toStatus"));
                renderComponents($("#jobPriority"));
                renderComponents($("#jobCategory"));
                $('#fromDate').datetimepicker({
                bornIn:"body",
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 2,
                minView: 2,
                multidate: true,
                format: "yyyy-mm-dd"
              });
                $('#toDate').datetimepicker({
                bornIn:"body",
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 2,
                minView: 2,
                multidate: true,
                format: "yyyy-mm-dd"
              });
                
          
            }
        })
 
    
      
}
function addChart()
    {
//alert($('#addChart').serialize());
if ( $('#from_date').val()!==undefined) {
  var startDate = new Date($('#from_date').val());
  var endDate = new Date($('#to_date').val());
  var currDate = new Date();
if(startDate=='Invalid Date')
{
  $("#e_from_date").html(ui_string['error_fromdate']);
  $("#from_date").focus();
   return false;
}
  else if (endDate=='Invalid Date') {
    $("#e_to_date").html(ui_string['error_todate']);
    $("#to_date").focus();
   return false;
}
else if (startDate > endDate) {
    $("#e_to_date").html(ui_string['error_date_check']);
    $("#to_date").focus();
   return false;
}
 else if (startDate > currDate){
   $("#e_from_date").html(ui_string['error_end_date_check']);
   $("#from_date").focus();
   return false;
  }
  else if (endDate > currDate){
   $("#e_to_date").html(ui_string['error_end_date_check']);
   $("#to_date").focus();
   return false;
  }

  }
 
    document.getElementById('add_chart').disabled = true;
      var color_code =  Math.floor(Math.random() * 10);
      //alert($('#addChart').serialize() + "&color_code=" +color_code);
        $.ajax({
            url: admin_ui_url+"dashboard/ajax/add_charts.php",
            data:$('#addChart').serialize() + "&color_code=" +color_code, 
            type:"POST",
            success:function(suc){
               // alert(suc); 
                
            },
            complete: function(){
                parent.$('#add_category').modal('hide');
              
                parent.$('#categories').modal('hide');
                //location.reload();
                redirect_to_tab();
            }
        });
    }
function editWidget(dash_id, widget_id , chart_id)
    {
          var widget_info = get_widget_info(chart_id);
          widget_info = JSON.parse(widget_info);
          var chart_Img =  widget_info['chart_Img'];
          var chart_title = widget_info['chart_name'];
          var chart_desc = widget_info['chart_desc'];
          var widget_config = widget_info['c_config'];
          var module_name = widget_info['module_name'];
         
          $.ajax({
            url: admin_ui_url+module_name+"/widget/widget_config/"+widget_config,
            data:"dash_id="+dash_id+"&widget_id="+widget_id,
            type:"POST",
            success:function(suc){
              //alert(suc);
              $("#config_title").text(chart_title);
              $("#config_desc").text(chart_desc);
              $("#Chart_Image").attr("src", admin_assets_url+"img/chart/"+chart_Img);
              $("#custom_config_file").html(suc);              
              $("#hdn_request_type").val("update");
              $("#hdn_widget_id").val(widget_id);              
              $('#add_category').modal();
                renderComponents($("#projectList"));
                renderComponents($("#period"));
                renderComponents($("#days_prev"));
                renderComponents($("#avg_dur"));
                renderComponents($("#all_status"));
                renderComponents($("#staticType"));
                renderComponents($("#sor_Dir"));
                renderComponents($("#data_type"));
                renderComponents($("#attendance"));
                renderComponents($("#getQuery"));
                renderComponents($("#formList"));
                renderComponents($("#resourcePeriod"));
                renderComponents($("#assignUser"));
                renderComponents($("#fromStatus"));
                renderComponents($("#toStatus"));
                renderComponents($("#jobPriority"));
                renderComponents($("#jobCategory"));
                                $('#fromDate').datetimepicker({
                bornIn:"body",
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 2,
                minView: 2,
                multidate: true,
                format: "yyyy-mm-dd"
              });
                $('#toDate').datetimepicker({
                bornIn:"body",
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 2,
                minView: 2,
                multidate: true,
                format: "yyyy-mm-dd"
              });
                

            },
            complete: function(){
               
              
            }
        });
    }
function deleteWidget(widget_id)
{
    if(widget_id)
    {
        var id=widget_id;
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_widget(\''+id+'\')">'+ui_string['confirm']+'</button>');
        
        $('#sure_to_delete').modal();
    }
    else
    { 
            $('#error_head').html(ui_string['error_message']);
            $('#error_body').html(ui_string['select_text_box_error']);
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
    }  
}
function delete_widget(id)
{
  $.ajax({
            url: admin_ui_url+"dashboard/ajax/deleteWidget.php",
            data:"widget_id="+id,
            type:"POST",
            success:function(suc){
               // alert(suc); 
                
            },
            complete: function(){
              redirect_to_tab();
              //location.reload();
            }
        });
  }
    
    function delete_dashboard(id){
    if(id)
    {
        var id=$('#'+id).attr('data-id');
        $('#deletType').html('<button type=\'button\' id=\'delete_sure_button\' class=\'btn btn-theme-inverse\' onclick="delete_dash(\''+id+'\')">'+ui_string['confirm']+'</button>');
        
        $('#sure_to_delete').modal();
    }
    else
    { 
            $('#error_head').html(ui_string['error_message']);
            $('#error_body').html(ui_string['select_text_box_error']);
            $('#error_message').modal();
            setTimeout(function(){ $('#error_message').modal('toggle'); },1500);
    }  
}
function delete_dash(id)
{
    $.ajax({
            url:admin_ui_url+"dashboard/ajax/delete_dashboard.php",
            data:"id="+id,
            type:"POST",
            success:function(suc)
                    {   
                        suc=JSON.parse(suc);
                        if(suc['success']=='true')
                        {
                                    $("#model_head").html(ui_string['confirm']);
                                    $("#model_des").html("Dashboard Deleted Successfully");
                                    $('#success_modal').modal();
                                    //setTimeout(function(){ window.location=userDetailurl; },1000);
                                     setTimeout(function(){ location.reload(); },1000)
                        }
                        else
                        {
                            
                            
                                $("#model_head").html(ui_string['notconfirm']);
                                $("#model_des").html("Dashboard Not Deleted");
                                $('#success_modal').modal();
                            }
                        }
        })
}
 function validation_successfull(tp)
{
 switch (tp){
  case 'addCategory':
    create_dashboards();
    break;
  case 'updateCategory':
    update_dashboards();
    break;
  case 'addChart':
    addChart();
  break;
}
}
function addgadget(mid,smid)
{
show_basic_charts(mid,smid);
}
function redraw_chart(id){
  var condition=$("#"+id).hasClass("active");
  if(!condition){   
    //$('.auto_refresh').hide();
    //setTimeout(function(){ $('.auto_refresh').show(); drawChart(); }, 100);  
    setTimeout(function(){
      var widgetArr = new Array();
      $(".tab-pane.active").find(".auto_refresh").each(function(){widgetArr.push($(this).attr('id'))});
      drawChartWidget(widgetArr);
    },1);
  }
  
}
function refresh(){
  var widgetArr = new Array();
      $(".tab-pane.active").find(".auto_refresh").each(function(){
       delete cachedData[$(this).attr('id')];
        widgetArr.push($(this).attr('id'));
      });
      if ( typeof refreshReports == 'function' ) { 
        refreshReports();
}
     drawChartWidget(widgetArr);
}
function redirect_to_tab(){
  var loc = window.location.href.replace(window.location.hash,"").replace("#");
  var hash = $(".Dashboard.active").attr("id");
  if(loc!=""&&hash!=""){
    setloader(); 
    window.location.href= loc+"#"+hash;
    location.reload();
    //unloading();
  }
}
$(document).ready(function(){
  if(window.location.hash!=""){
    if($(window.location.hash).hasClass("Dashboard")){
      $(window.location.hash).children("a").click();
    }
  }
})
function manage_dashboard(tp,id)
{
  $('#ecategorydescription').html(''); 
  $('#ecategoryname').html(''); 
  $('#manageDash').css('display','none');
  $('#manage_dashboard').attr('checked', false);
  $('#manage_gadget').attr('checked', false);
  $('#dashboard_popup').modal(); 
  $('#addCategory')[0].reset(); 
    if(tp=='addDashboard')
    {
      $('#DashTitle').html(ui_string['create_new_dash']);
      $('#dashSub').html('<button type=\'button\' id=\'add_dashboard\' class=\'btn btn-theme-inverse\' onclick="return validation(\'addCategory\')">'+ui_string['submit']+'</button>');
    }
  else if(tp=='updateDashboard')
  {
    $.ajax({
        url:admin_ui_url+"dashboard/ajax/create_dashboard.php?action=edit_dashboard",
        data:"id="+id,
        type:"POST",
        success:function(suc){
                suc=JSON.parse(suc);
                //console.log(suc);
               $("#dashid").val(id);
               $("#categoryname").val(suc['data'][0]['dash_name'].toString()); 
               $("#categorydescription").val(suc['data'][0]['dash_desc'].toString());
               var dashType=suc['data'][0]['dash_type'].toString();
                 if(dashType==0)
                 {
                  $("#pri").prop('checked', false);
                  $("#glob").prop('checked', true);
                   $('#manageDash').css('display','block');
                   var result=suc['data'][0]['DashManage'].split(',');
                   if(result[0]==1)
                   {
                    $('#manage_dashboard').attr('checked', true);
                   }
                   if(result[1]==0 || result[0]==0)
                   {
                    $('#manage_gadget').attr('checked', true);
                   }
                 }
                 else
                 {
                  $('#manageDash').css('display','none');
                  $("#glob").prop('checked', false);
                    $("#pri").prop('checked', true);
                 }
                 var tpltype=suc['data'][0]['template_type'].toString();
                 setVal(tpltype);
                $('#DashTitle').html(ui_string['Update_Dashboard']);
                $('#dashSub').html('<button type=\'button\' id=\'update_dashboard\' class=\'btn btn-theme-inverse\' onclick="return validation(\'updateCategory\')">'+ui_string['update']+'</button>');
          }
      }); 
  }
     
}
    function update_dashboards(){
      $("#update_dashboard").attr("disabled","disabled");
        var dash_name=$('#categoryname').val();
        var user_id=$('#user_id').val();
        var template_type=$('#tplType').val();
        var dashid=$('#dashid').val();
        var dashboard_type=$('input[name="priglob"]:checked').val();    
        if (typeof(dashboard_type) == 'undefined')
            {
                var dash_type=1;
            } 
        else
            {
             var dash_type=dashboard_type;
            }
            var DashManage='def'
          if(dashboard_type==0)
          {
            var checked = []
          
    $("input[name='manage_dashboard[]']:checked").each(function ()
    {
        checked.push(parseInt($(this).val()));
    });
    if(checked=='')
    {
    var DashManage=2;
    }
    else
    {
      var DashManage=checked;
    }
  }
        var dash_desc=$('#categorydescription').val();
      $.ajax({
            url:admin_ui_url+"dashboard/ajax/create_dashboard.php?action=update_dashboard",
            data:"dash_name="+dash_name+"&user_id="+user_id+"&dash_desc="+dash_desc+"&dash_type="+dash_type+"&template_type="+template_type+"&id="+dashid+"&DashManage="+DashManage,  
            type:"POST",
            success:function(suc){
                 console.log(suc);
              },
                 complete:function(){
                    window.location.href='dashboardMainUI.php';
                   location.reload();
                  }     
      });  
    }
    function GetButton()
      {
        //alert("dfdfd");
        $('#manageDash').css('display','block');
      }
      function RemoveButton()
      {
        $('#manageDash').css('display','none');
        $('#manage_dashboard').attr('checked', false);
        $('#manage_gadget').attr('checked', false);
      }
