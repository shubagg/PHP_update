<?php

include_once("../../global.php");

$c=get_company_data();
setcookie('customer_id',$c['cid'] , time() + (86400 * 30), "/");
include(lang_url()."global_en.php");

include(lang_url()."resourse/en.php");

is_user_logged_in();

//print_r($_SESSION);

//$arr=checkUserAttendance(array('userId'=>'578491805806b5594d86185e','mid'=>'22','smid'=>'1','date'=>'2016-08-23'));
//print_r($arr);
?>

<?php get_admin_header(); ?>
<link rel="stylesheet" href="<?php echo assets_url(); ?>ladda/ladda-themeless.min.css">
<?php get_admin_header_menu($language); ?>

<?php get_admin_left_sidebar($language); ?> 

<?php require_once ($server_path."templates/admin/dashboard.php"); ?>
<script type="text/javascript">
function ladda_toggle(button_id)
{   
    var l= Ladda.create(document.querySelector('#'+button_id));
    l.toggle();       
} 
function manageAttendance()
{
	ladda_toggle('inout');
    $.ajax({
            type: "POST",
            url:  "<?php echo admin_ui_url();?>attendance/ajax/attendance_manage.php",
            data: "action=manageAttendance",
            success: function(data) 
            {         
            	ladda_toggle('inout');
                var type =  data.split("-");

                if(type[0].trim() == "checkin")
                {
                    $("#inout").html("checkout");
                    $("#cintime").html(type[1]);
                    $("#couttime").html("--");
                }
                else if(type[0].trim() == "checkout")
                {
                    $("#inout").html("checkin");
                    $("#couttime").html(type[1]);
                }
                else if(type[0].trim() == "3")
                {
                    $("#inout").removeAttr("style").hide();
                    $("#chandu").html("(Your have already marked your attendance)");
                }
                else
                {
                    
                }
            }
        })
}

</script>
<script src="<?php echo assets_url(); ?>ladda/spin.min.js"></script>
<script src="<?php echo assets_url(); ?>ladda/ladda.min.js"></script>
<?php get_admin_footer(); ?>
