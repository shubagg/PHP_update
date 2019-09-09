function add_schedule()
{

$.ajax({
    url:admin_ui_url+'schedule/ajax/schedule_popup.php',
    data:'',
    type:'post',
    async:false,
    success:function(suc)
    {
        unloading();
        $("#scheduletable").html(suc);
        $("#md-full-width1").modal();
        
    }
})
}
function validation_successfull(fm){
    switch(fm)
        {
            case "createschedule":
            var every = $("#every").val();

            if(every < 0)
            {
                $("#everyerror").html("Every Value is not less than 0");
                $("#everyerror").focus();
                return false
            }
            
            

            var createSchedule= $("#createschedule").serialize();
            $.ajax({
                url:admin_ui_url+'schedule/ajax/schedulesubmit.php',
                type:'post',
                data:createSchedule,
                async:false,
                success:function(suc)
                {
                   var data = JSON.parse(suc);
                    if(data['success']=='schedule')
                    {
                        $("#success_modal").modal();
                        $("#model_des").html("Schedule Already Exists");  
                        setTimeout(() => {
                            window.location = admin_ui_urls+'schedule';
                        }, 3000); 
                    }
                    if(data['success']=='true')
                    {
                        $("#success_modal").modal(); 
                                setTimeout(() => {
                                window.location = admin_ui_urls+'schedule';
                            }, 1000);
                    }
                    else{
                        $("#success_modal").modal();
                        $("#model_des").html("Schedule not added");  
                        setTimeout(() => {
                            window.location = admin_ui_urls+'schedule';
                        }, 2000);
                    } 
                                
                }

            })
            
        }
}
function selectRobot()
{
   var user =  $(".selectschedule").val();
   if(user!=""){
    $.ajax({
        url:admin_ui_url+'schedule/ajax/getrobot.php',
        type:'post',
        data:"userid="+user,
        async:false,
        success:function(suc)
        {
            var suc=JSON.parse(suc);
            var option="<option value=''>Select Robot </option>";
            for(var i=0;i<suc.length;i++){
                option +="<option value="+suc[i]['asid']+'-'+suc[i]['id']+" >"+suc[i]['name']+"</option>";
            }
            $("#robot_option").html(option);
        }
   });
    }
}

function selectSchedule()
{
    var scheduleType = $('.selectscheduletype').val();
    var scheduleVal= scheduleType.split("-");
    var scheduleValue = scheduleVal[0];
    var scheduleName = scheduleVal[1];
    
    var noofsche = '<label class="control-label remove_bg col-md-5"><span class="color">'+scheduleName+'</span></label>';
        noofsche += '<div class="col-md-7">';
        noofsche +='<input class="form-control required_field createschedule" id="noschedule" name="enoschedule" type="text" placeholder="08:15AM" data-check-valid="blank" data-error-show-in="enoschedule" value="">';
        noofsche += '<span class="input_arror error" id="enoschedule"> </span>';
    $("#noofschedule").html(noofsche);
    var starttime = '<label class="control-label remove_bg col-md-5"><span class="color">Start Time</span></label>';
    starttime += '<div class="col-md-7">';
    starttime += '<div class="input-group clockpicker">';
    starttime +='<input class="form-control required_field createschedule" id="starttime" name="starttime" type="text" placeholder="08:15AM" data-check-valid="blank" data-error-show-in="estarttime" value="">';
    starttime +='<span class="input-group-addon">';
    starttime +='<span class="glyphicon glyphicon-time"></span>';
    starttime +='</span>';   
    starttime += '<span class="input_arror error" id="estarttime"> </span>';
    
    if(scheduleName == 'Hourly')
    {
        var every = '<label class="control-label remove_bg col-md-5"><span class="color">Every</span></label>';
        every += '<div class="col-md-7">';
        every +='<input class="form-control required_field createschedule" id="every" name="every" min="1" type="number" placeholder="" data-check-valid="blank" data-error-show-in="everyerror" value="">';
        every += '<span class="input_arror error" id="everyerror"> </span>';
        $("#noofschedule").html(starttime);
        $("#every-div").html(every);
        $("#noofschedule1").html("");
        $("#noofschedule1").hide();
        $("#every-div").show();
    }
    else if(scheduleName == 'Daily' || scheduleName == 'Weekly' || scheduleName == 'Monthly' || scheduleName == 'Yearly' || scheduleName=='One Time')
    {
        $("#noofschedule").html(starttime);
        var startdate = '<label class="control-label remove_bg col-md-5"><span class="color">Start Date</span></label>';
        startdate += '<div class="col-md-7">';
        startdate +='<input class="form-control required_field createschedule" id="startdate" name="startdate" type="text" placeholder="" data-check-valid="blank" data-error-show-in="estartdate" value="">';
        startdate += '<span class="input_arror error" id="estartdate"> </span>';
        $("#noofschedule1").html(startdate);
        $("#noofschedule1").show();
        $("#every-div").html("");
        $("#every-div").hide();
        
    }
    else
    {
        $("#noofschedule").html("");
        $("#noofschedule").hide();
        $("#every-div").html("");
        $("#every-div").hide();
        $("#noofschedule1").html("");
        $("#noofschedule1").hide();
    }
	
$(document).ready(function(){
$('.clockpicker').clockpicker();
/*$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

    $('input.timepicker').timepicker({});*/
	$( function() {
    $( "#startdate" ).datepicker({
            dateFormat: 'yy-mm-dd'
          });
  } );
});
    
} 


function edit_schedule(scheduleid){
    $.ajax({
        url:admin_ui_url+'schedule/ajax/schedule_popup.php',
        data:'id='+scheduleid,
        type:'post',
        async:false,
        success:function(suc)
        {
            //alert(suc);
            unloading();
            $("#scheduletable").html(suc);
            $("#md-full-width1").modal();
            
        }
    })
}
function delete_schedule(scheduleid)
{
    $.ajax({
        url:admin_ui_url+'schedule/ajax/schedule_delete.php',
        data:'id='+scheduleid,
        type:'post',
        async:false,
        success:function(suc)
        {
           var data = JSON.parse(suc);
           if(data['success']=='true')
           {
            $("#success_modal").modal();
            $("#model_des").html("Schedule Delete Successfully");  
            setTimeout(() => {
                window.location = admin_ui_urls+'schedule';
            }, 2000);
           }
            
        }
    }) 
}





