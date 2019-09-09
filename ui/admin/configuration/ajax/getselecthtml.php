<?php
include_once ('../../../../global.php');
$classid=$_REQUEST['classid'];
$user_id_block=$_SESSION['user']["user_id"];
if(isset($user_id_block) && !empty($user_id_block))
{
        $query1 = array();
        $query1['userId']=$user_id_block;
        $robotdata = select_mongo('ocrtemplate',$query1);
        $robotdataval = add_id($robotdata,"id");
}

if(!empty($robotdataval)  && (count($robotdataval)>0))
{ ?>
<div class="" id="newtempselect_<?php echo $classid ?>">
	<select class="form-control width-100 mandatory_field" data-check="blank" data-error-show-in="user_error" data-error="Please Select Template" id="template"  name="<?php echo $classid."[template_name]"; ?>" data-createform-id="<?php echo $classid ?>">
<?php 
    if(!empty($robotdataval)){  foreach($robotdataval as $ro){?>
    <option value="<?php echo $ro['template_name'];?>"><?php echo $ro['template_name'];?></option>
                  <?php } } }?>
	</select> 
<span class="input_arror error" id="user_error"> </span>
<input type="hidden" name="<?php echo $classid."[new]"; ?>" class="form-control width-100 mandatory_field" placeholder="Templates" data-check="blank" value="0" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
</div>
                        