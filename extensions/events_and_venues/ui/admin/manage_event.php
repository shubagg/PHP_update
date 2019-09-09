<?php 
is_user_logged_in();
get_admin_header(); 
get_admin_header_menu($language);
get_admin_left_sidebar($language);
get_crop_popup(array("id"=>'1'));
$Eventid="0";
$selected="";
if(isset($_GET['id']))
{
	$product=get_product_by_id(array("id"=>$_GET['id']));
	$product=$product['data'][0];
	$Eventid=$product['id'];
}

?>
<div id="main">
	<style type="text/css">
.amenity ul{
	float: left;
    padding-right: 10px;
}
	</style>
			<div id="content">
			<div class="row">
				<section class="panel top-gap">
				<header class="panel-heading">
					<div class="row">
						<div class="col-md-6 margn_tp_7">
						      <h3><strong>Manage</strong> Event</h3>
						</div>
					</div>
					</header>
					<div class="panel-body panel_bg_d">
						<form id="add_event_data" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
							
                          <div class="form-group ">
							<label class="control-label remove_bg col-md-2">Title *</label>
							<div class="col-md-10">
								<input type="text" id="title" name="title" value="<?php echo $product['title']; ?>" data-check-valid="blank" data-error-show-in="eTitle" data-error-setting="2" data-error-text="Please enter title" class="form-control required_field add_event_data editUser" value="" placeholder="">
							     <input type="hidden" id="type" name="type" value="event" >
							     <input type="hidden" name="id" id="eventsId" value="<?php echo $Eventid; ?>">
							     <span id="eTitle" class="error"></span>
						    </div>
						</div>

						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Description *</label>
							<div class="col-md-10">
								<textarea id="desc" name="description" data-check-valid="blank" data-error-show-in="eDescription" data-error-setting="2" data-error-text="Please enter description" class="form-control required_field add_event_data editUser" value="" placeholder=""><?php echo $product['description']; ?></textarea>
							     <span id="eDescription" class="error"></span>
						    </div>
						</div>

						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">State *</label>
							<div class="col-md-10">
								<select id="state" name="stateId" onchange="getLocation('',this)" data-check-valid="blank" data-error-show-in="estateId" data-error-setting="2" data-error-text="Please enter address" class="form-control required_field add_event_data editUser" value="" placeholder="">
									<option value="">Select State</option>
									 <?php $get_states=curl_post("/get_states",array('countryId'=>'101','id'=>'')); 
									 		foreach ($get_states['data'] as $get_statesvalue) {
									 ?>
									<option id="<?php echo $get_statesvalue['stateId']; ?>" <?php if($get_statesvalue['id']==$product['stateId']){ $selected=$get_statesvalue['stateId']; echo "selected"; } ?>  value="<?php echo $get_statesvalue['id']; ?>"><?php  echo $get_statesvalue['title']; ?></option>
									<?php } ?>
									</select>
							     <span id="estateId" class="error"></span>
						    </div>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Location *</label>
							<div class="col-md-10">
								<select id="city" name="cityId" data-check-valid="blank" data-error-show-in="ecityId" data-error-setting="2" data-error-text="Please enter address" class="form-control required_field add_event_data editUser">
									<option value="">Select Location</option>
								</select>
							     <span id="ecityId" class="error"></span>
						    </div>
						</div>
						 <div class="form-group ">
							<label class="control-label remove_bg col-md-2">Location Title *</label>
							<div class="col-md-10">
								<input type="text" id="location_title" name="location_title" value="<?php echo $product['location_title']; ?>" data-check-valid="blank" data-error-show-in="eLoc_Title" data-error-setting="2" data-error-text="Please enter location title" class="form-control required_field add_event_data editUser" value="" placeholder="">
							     <span id="eLoc_Title" class="error"></span>
						    </div>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Address *</label>
							<div class="col-md-10">
								<textarea id="address" name="address" data-check-valid="blank" data-error-show-in="eAddress" data-error-setting="2" data-error-text="Please enter address" class="form-control required_field add_event_data editUser" onblur="GetLatLng();" value="" placeholder=""><?php echo $product['address']; ?></textarea>
							     <span id="eAddress" class="error"></span>
						    </div>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Lat *</label>
							<div class="col-md-10">
								<input type="text" id="lat" name="lat" value="<?php echo $product['lat']; ?>" data-check-valid="blank" data-error-show-in="elat" data-error-setting="2" data-error-text="Please enter Lat" class="form-control required_field add_event_data editUser" value="" placeholder="">
							     <span id="elat" class="error"></span>
						    </div>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Lng *</label>
							<div class="col-md-10">
								<input type="text" id="lng" name="lng" value="<?php echo $product['lng']; ?>" data-check-valid="blank" data-error-show-in="eLng" data-error-setting="2" data-error-text="Please enter Lng" class="form-control required_field add_event_data editUser" value="" placeholder="">
							     <span id="eLng" class="error"></span>
						    </div>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Category *</label>
							<div class="col-md-10 amenity">
								<?php
								
									  $category=curl_post("/get_feature_list_by_id",array('groupId'=>'587f04eca32974a8103c9869','fields'=>'title'));
									  $categoryids=0;  
								?>
							<ul>
								<?php for($categoryid=0;$categoryid<sizeof($category['data']);$categoryid++){  if($categoryid==$categoryids+3) { $categoryids=$categoryid;   echo "</ul> <ul>"; } ?>
								<li><input class="ads_Checkbox required_field add_event_data" <?php if(in_array($category['data'][$categoryid]['id'],$product['category'])) { echo "checked"; } ?> data-check-valid="blank" data-error-show-in="ecategory" data-error-setting="2" data-error-text="Please select category" type="checkbox" id="role-56bec45e6d9557981a3c986aa" name="category[]" value="<?php echo $category['data'][$categoryid]['id']; ?>"> <label><?php echo $category['data'][$categoryid]['title']; ?></label></li>
								<?php }?>
							
						    </div>
						<span id="ecategory" style="padding-left: 237px;" class="error"></span>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Amenities *</label>
							<div class="col-md-10 amenity">
								<?php
								
									  $amenities=curl_post("/get_feature_list_by_id",array('groupId'=>'587f0295a3297480103c9869','fields'=>'title'));
									  $amenitiesids=0;  
								?>
							<ul>
								<?php for($amenitiesid=0;$amenitiesid<sizeof($amenities['data']);$amenitiesid++){  if($amenitiesid==$amenitiesids+3) { $amenitiesids=$amenitiesid;   echo "</ul> <ul>"; } ?>
								<li><input class="ads_Checkbox required_field add_event_data" <?php if(in_array($amenities['data'][$amenitiesid]['id'],$product['attributes'])) { echo "checked"; } ?> data-check-valid="blank" data-error-show-in="eanimities" data-error-setting="2" data-error-text="Please select amenities" type="checkbox" id="role-56bec45e6d9557981a3c986a" name="attributes[]" value="<?php echo $amenities['data'][$amenitiesid]['id']; ?>"> 
									<label><?php echo $amenities['data'][$amenitiesid]['title']; ?></label>
									<?php 
										  $amenitiesId=$amenities['data'][$amenitiesid]['id'];
										  $amenities_media_data=get_association_data("16","10","1",$amenitiesId);
										  $profile_picture=$amenities_media_data['media']['1'][$amenitiesId][0]['mediaName'];
										  if($profile_picture!='')
										  {
										  	$img_url=site_url().'uploads/media/images/'.$profile_picture;
										  	echo $user_avatar="<img src='$img_url' width='30' height='30'/>";
										  }      									  
									?>
									
								</li>
								<?php }?>
							
						    </div>
						<span id="eanimities" style="padding-left: 237px;"  class="error"></span>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Base-Price *</label>
							<div class="col-md-10">
								<input type="text" id="baseprice" name="basePrice" data-check-valid="blank,numeric" data-error-show-in="ebaseprice" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter baseprice" class="form-control required_field add_event_data editUser" value="<?php echo $product['basePrice']; ?>" placeholder="">
							     <span id="ebaseprice" class="error"></span>
						    </div>
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Capacity *</label>
							<div class="col-md-10">
								<input type="text" id="capacity" name="capacity" data-check-valid="blank,numeric" data-error-show-in="eCapacity" data-error-setting="2" data-valid-numeric-error="Please enter only numeric value" data-error-text="Please enter capacity" class="form-control required_field add_event_data editUser" value="<?php echo $product['capacity']; ?>" placeholder="" >
							     <span id="eCapacity" class="error"></span>
						    </div>
						</div>
						 <div class="form-group">
						   <?php  
						   if(isset($product['id'])){
						      $getImage=get_association_data('16','10','1',$product['id']);
						      $logo=$getImage['media'][1][$product['id']][0]['mediaName'];
						  	  }else{ $logo='';}
						      ?>
						   <label class="control-label remove_bg col-md-2">Image *</label>
						   <div class="col-md-10">
						      <!-- hidden id of crop -->
						      <input type="hidden" id="hiddenCropData" name="hiddenCropData"> 
						      <input type="hidden" id="hiddenCropType" name="hiddenCropType">
						      <!-- hidden id of crop -->
						      <input type="file" style="display:none;" name="product_image" id="product_image" data-width="800" data-height="600" data-returnfunction="show_thumbnail" class="form-control cropimage" />
						      <span class="" onclick="$('#product_image').click();" id="showimage1" >
						      <?php if($logo){ ?>  
						      <img id="blah"   class="Cropthumbnail" style="width:100px;height:100px;" src="<?php echo get_upload_dir_uri()."media/images/".$logo; ?>"/> 
						      <?php }else{ ?> 
						      <img id="blah"  class="Cropthumbnail"  style="width:100px;height:100px;" src="<?php echo admin_assets_url();?>img/addg.png"/> 
						      <?php } ?>
						      </span> 
						   </div>
						</div>
						<span id="eshowimage1" class="error crop_error"></span>
						<div class="form-group" id="imagesdata">
							
						</div>
						<div class="form-group ">
							<label class="control-label remove_bg col-md-2">Banners</label>
							<div class="col-md-10">
								<button type="button" onclick="get_banners()" class="btn btn-theme-inverse "><i class="glyphicon glyphic"></i> Manage Banner</button>
						    </div>
						</div>

                            <button type="reset" class="btn btn-inverse right left-gap" onclick="cancel_user_registration('addUser')" >
                                <i class="glyphicon glyphicon-chevron-right"></i> Reset</button>
                            
                            <button  onclick="return validation('add_event_data')" type="button" class="btn btn-theme-inverse right">
								<i class="glyphicon glyphicon-circle-arrow-right"></i> Submit</button>
						</form>
					</div>
					
					</section>
					</div>
			</div>
		</div>
	<?php echo success_fail_message_popup();?> 
	<?php get_banners_popup(array("mid"=>"16","smid"=>"2")); ?>
	</div>
<script type="text/javascript">
function show_thumbnail(datas)
{
	$(".thumbnail").find('img').attr('src',datas['showImg']);
    $(".Cropthumbnail").attr('src',datas['showImg']);
}
</script>
<script type="text/javascript" src="<?php echo extensions_ui_url(); ?>/events_and_venues/ui/admin/js/event_venue.js"></script>
<?php  if(isset($_GET['id'])) { ?>
	<script>
	$( document ).ready(function() {
		getLocation('1','<?php echo $product['cityId'].'|'.$selected ?>');
		});
	</script>
	<?php } ?>
<?php get_admin_footer(); ?> 