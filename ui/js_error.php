<?php 
include_once '../global.php';
header('Content-Type: application/javascript');
$tmp ="";
foreach($error_string as $key =>$val)
{
	$tmp .= '"'.$key.'":"'.$val.'",';
}
$tmp = rtrim($tmp,",");
?>
var error_string = {<?php echo $tmp;?>};
<?php
$tmp ="";
foreach($ui_string as $key =>$val)
{
	$tmp .= '"'.$key.'":"'.$val.'",';
}
$tmp = rtrim($tmp,",");
?>

var ui_string = {<?php echo $tmp;?>};
var site_url = "<?php echo site_url();?>";
var webservice_url = "<?php echo $webservice_url;?>";
var admin_ui_url = "<?php echo $admin_ui_url;?>";
var ui_url="<?php echo ui_url();?>";

function formatDate(date) {
  //console.log(date);
  var years = date.getFullYear();
  var months = ("0" + (date.getMonth() + 1)).slice(-2);
  var dates = ("0" + date.getDate()).slice(-2);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  seconds = seconds < 10 ? '0'+seconds : seconds;
  var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
  /*return date.getFullYear() + "-" + date.getMonth()+1 + "-" + date.getDate() + " " + strTime;*/
  return years + "-" + months + "-" + dates + " " + strTime;
}

function formatDateNew(date) {
  //console.log(date);
  var years = date.getFullYear();
  var months = ("0" + (date.getMonth() + 1)).slice(-2);
  var dates = ("0" + date.getDate()).slice(-2);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  seconds = seconds < 10 ? '0'+seconds : seconds;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  /*return date.getFullYear() + "-" + date.getMonth()+1 + "-" + date.getDate() + " " + strTime;*/
  return years + "-" + months + "-" + dates + " " + strTime;
}

function formatDateJob(date) {
  //console.log(date);
  var years = date.getFullYear();
  var months = ('0' + (date.getMonth()+1)).slice(-2);
  var dates = ("0" + date.getDate()).slice(-2);
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  //hours = hours < 10 ? '0'+hours : hours;     //hours ? hours : 12  the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  seconds = seconds < 10 ? '0'+seconds : seconds;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  /*return date.getFullYear() + "-" + date.getMonth()+1 + "-" + date.getDate() + " " + strTime;*/
  return years +"-"+ months + "-" + dates;
}

function curl_post(url,parameter,callback)
{
	$.ajax({
            type: "POST",
            url:  url,
            data:parameter,
            success: function(data)
            {
            	callback(data);
        	}
            
        });
}

function curl_post_webservice(webservice,parameter,callback)
{
    $.ajax({
            type: "POST",
            url:  webservice_url+webservice,
            data:parameter,
            success: function(data)
            {
            	callback(data);
        	}
            
        });
}


function setloader()
{
  $('.loader-box').toggle();
}


function unloading(){
  $('.loader-box').hide();
}


function setloadercustom(divId)
{
  var overlay=$('<div class="load-overlay"><div><div class="c1"></div><div class="c2"></div><div class="c3"></div><div class="c4"></div></div><span>Loading...</span></div>');
  $("#"+divId).append(overlay);
  overlay.css('opacity',1).fadeIn("slow");
  
}


function unloadingcustom(divId){
  $("#"+divId).find(".load-overlay").fadeOut("slow",function(){ $(this).remove() });
}

