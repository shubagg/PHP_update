<?php get_admin_header_menu($language); ?>
<?php get_admin_left_sidebar(); ?>

<div id="main">
<!--
      /////////////////////////////////////////////////////////////////////////
      //////////     SLIDE LEFT MAIL BOX     //////////
      //////////////////////////////////////////////////////////////////////
      -->
<style>

	
		.horizontal-tabs .nav-tabs {
		float: left;
		padding: 10px 12px 10px 5px;
		
	
		}
		.horizontal-tabs .badge{
			top:0px;
			position:absolute;
			left:-15px;
			
			
		}
		.horizontal-tabs .nav-tabs li {
		float: none;
		
		}
		.horizontal-tabs .nav-tabs li a {
			
		}

.js-signature canvas{width:600px;}

		.horizontal-tabs .nav-tabs>li.active>a,
		.horizontal-tabs .nav-tabs>li.active>a:hover,
		.horizontal-tabs .nav-tabs>li.active>a:focus {
		border: 0;
		background-color:#fff;
		}

		.horizontal-tabs .tab-content {
			margin-left: 118px;
		}
		.horizontal-tabs .tab-content .tab-pane {
		display: none;
		background-color: #fff;
		padding: 0 1.6rem;
		overflow-y: auto;
		}
		.horizontal-tabs .tab-content .active {
		display: block;
		}
		
		#mini-Gmap{width:100% !important; height:250px !important;}
		
   
   .mendetry { color:red; padding-left:5px; font-size:18px;}
   .fileinput .thumbnail {border: 1px solid #999 !important;}
.fileinput-exists {border: 1px solid #999 !important;}
.fileinput .btn {border: 1px solid #999 !important;}
.no_pad_left { padding-left:0;}
.no_pad_right { padding-right:0;}
.myfrm .form-group { margin-bottom:15px !important;}
.color_heding tr th { color:#333 !important;}
.odd.gradeX { background:#fff !important;}
	  </style>

<?php  if($_REQUEST['action']=='submitservey'){ ?>
                  <h2>Thank you for feedback</h2>
                  <?php }else{?>

               
<form role="form" id="form" action="" method="post" enctype="multipart/form-data">
<!-- //nav-->
<div class="col-lg-12">
 
<section class="panel" style=" margin-bottom:10px;">
		<header class="panel-heading att_head">
			<h3 style="margin-bottom:7px; margin-top:5px;"><strong>SITE</strong> / PROPERTY APPROVAL FORM </h3>
		</header>
</section>

  <div class="col-sm-6 no_pad_left">
  <section class="panel" >
  <div class="panel-body myfrm">
   

      <div class="form-group">
        <label class="control-label"> Name of the Applicant <span class="mendetry">*</span></label>
        <input type="text" name="name" value="<?php echo $fd['name'];?>" class="form-control parsley-validated" parsley-type="email" parsley-trigger="change" placeholder="">
        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
         <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
         <input type="hidden" name="action" value="submitservey">
      </div>
      
       <div class="form-group">
          <label>Applying for SHEMROCK or SHEMFORD<span class="mendetry">*</span></label>
          <ul class="iCheck "  data-color="green">
            <li>
              <input type="radio" name="applyfor" value="Shemrock" <?php if("Shemrock"==$fd['applyfor']) { echo "checked"; }?>>
              <label>Shemrock</label>
            </li>
            <li>
              <input  type="radio" name="applyfor" value="Shemford" <?php if("Shemford"==$fd['applyfor']) { echo "checked"; }?>>
              <label >Shemford</label>
            </li>
          </ul>
      </div>
      
      <label>Complete Branch Address <span class="mendetry">*</span></label>
       <div class="clearfix"></div>
       <div class="form-group col-md-4 no_pad_left">
			    <label>Address</label>
					<textarea class="form-control" rows="1" name="address"><?php echo $fd['address'];?></textarea>
			</div>
       
       
        
       <div class="form-group col-md-4">
        <label>Pin Code</label>
        <input type="text" name="pincode" value="<?php echo $fd['pincode'];?>" class="form-control" placeholder="">
       </div>
      
      
      <?php $arr =array("India","United States","United Kingdom","Australia","China","Japan","Thailand");
      //print_r($arr);
       {?>
      <div class="form-group col-md-4 no_pad_right">
      <label>Select Area</label>
    			<select name="area"  class="selectpicker form-control">
    					<option value=""> Select Area </option>
              <?php foreach ($arr as $cat_key)
              { ?>
                  <option value="<?php echo $cat_key; ?>" <?php if($cat_key==$fd['area']) { echo "selected"; }?> ><?php echo $cat_key; ?></option>
              <?php
              } ?>
    			</select>
			</div>
        <?php } ?>                                                                              
       <div class="clearfix"></div>
      
      
      <div class="form-group">
        <label>Main Occupation of Applicant & Spouse<span class="mendetry">*</span></label>
        <textarea name="occupation" class="form-control" rows="2" placeholder=" "><?php echo $fd['occupation'];?></textarea>
      </div>
      
      <div class="form-group">
        <label>Other School/pre-school ventures run by Applicant or Spouse<span class="mendetry">*</span></label>
        <textarea name="ventures"  class="form-control" rows="2" placeholder=" "><?php echo $fd['ventures'];?></textarea>
      </div>
      

     <!--   <div class="col-md-12">
      <div class="row">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="input-group">
<div class="form-control uneditable-input" data-trigger="fileinput">
<i class="glyphicon glyphicon-file fileinput-exists"></i>
<span class="fileinput-filename"></span>
</div>
<span class="input-group-addon btn btn-inverse btn-file">
<span class="fileinput-new">SELECT FILE TO UPLOAD</span>
<span class="fileinput-exists">Change</span>
<input type="file" name="...">
</span>
<a href="#" class="input-group-addon  btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
</div>
</div>
</div>
</div>
     //fileinput-->
      
      
      
       <label>(A) If Land/Building is Self Owned</label>
      
      
    <div class="form-group">
        <label>Total Plot Area <span class="mendetry">*</span></label>
        <input type="text" name="plotarea" value="<?php echo $fd['plotarea'];?>" class="form-control" placeholder="">
    </div>
      
     
     <div class="form-group">
        <label>Status of land <span class="mendetry">*</span></label>
        <ul class="iCheck"  data-color="green">
          <li>
            <input type="radio" name="status" value="School" <?php if("School"==$fd['status']) { echo "checked"; }?>>
            <label>School</label>
          </li>
          <li>
            <input  type="radio" name="status" value="Agriculture" <?php if("Agriculture"==$fd['status']) { echo "checked"; }?>>
            <label >Agriculture</label>
          </li>
          
          <li>
            <input  type="radio" name="status" value="Commercial" <?php if("Commercial"==$fd['status']) { echo "checked"; }?>>
            <label >Commercial</label>
          </li>
          <li>
            <input  type="radio" name="status" value="Residential" <?php if("Residential"==$fd['status']) { echo "checked"; }?>>
            <label >Residential</label>
          </li>
          
          <li>
            <input  type="radio" name="status" value="Industrial" <?php if("Industrial"==$fd['status']) { echo "checked"; }?>>
            <label >Industrial</label>
          </li>
          
          <li> 
            <input  type="radio" name="status" value="Other" <?php if("Other"==$fd['status']) { echo "checked"; }?>>
            <label >Other</label>
          </li>
        </ul>
      </div>
     
    
     <div class="form-group">
        <label>If the Land is not for school purpose then can the Land Use be changed? <span class="mendetry">*</span></label>
        <ul class="iCheck "  data-color="green">
          <li>
            <input type="radio" name="land" value="Yes"  <?php if("Yes"==$fd['land']) { echo "checked"; }?>>
            <label>Yes</label>
          </li>
          <li>
            <input  type="radio" name="land" value="No"  <?php if("No"==$fd['land']) { echo "checked"; }?>>
            <label >No</label>
          </li>
        </ul>
      </div>
      
      
      
      <div class="form-group">
        <label>Owner of land <span class="mendetry">*</span></label>
        <input type="text" name="owner" value="<?php echo $fd['owner'];?>" class="form-control" placeholder="">
      </div>
      
      <div class="form-group">
        <label>Relationship with Owner <span class="mendetry">*</span></label>
        <input type="text" name="relationship" value="<?php echo $fd['relationship'];?>" class="form-control" placeholder="">
      </div>
      
      <div class="form-group">
        <label>Is land available for immediate construction?<span class="mendetry">*</span></label>
        <ul class="iCheck "  data-color="green">
          <li>
            <input type="radio" name="available" value="Yes" <?php if("Yes"==$fd['available']) { echo "checked"; }?>>
            <label>Yes</label>
          </li>
          <li>
            <input  type="radio" name="available" value="No" <?php if("No"==$fd['available']) { echo "checked"; }?>>
            <label >No</label>
          </li>
        </ul>
      </div>
      
      
      
      
    
  </div>
  </section>
  </div>

  <div class="col-sm-6 no_pad_right">
   <section class="panel" >
  <div class="panel-body myfrm">
    
      
     
    <label>(B) If Land/Building is rented <span class="mendetry">*</span></label>
   
    <div class="form-group">
      <label>Total Area of Rented building/Land?</label>
      <input type="text" name="rented" value="<?php echo $fd['rented'];?>" class="form-control" placeholder="">
    </div>
   
   <?php 
   $arr1 =array("January","February","March","April","May","June","July","August","September","October","November","December");
   //print_r($arr);
   {?>   
   <label>Lease/rental agreement is till<span class="mendetry">*</span> </label>
   <div class="clearfix"></div>
   <div class="form-group col-md-6 no_pad_left">
      <label> Month </label>
				<select name="agreementmonth"  class="selectpicker form-control">
          <?php foreach ($arr1 as $key)
              { ?>
                  <option value="<?php echo $key; ?>"<?php if($key==$fd['agreementmonth']) { echo "selected"; }?> ><?php echo $key; ?></option>
              <?php
              } ?>
				</select>
		</div>
        
      
      
    <div class="form-group col-md-6 no_pad_right">
      <label> Year </label>
			<select name="agreementyear" class="selectpicker form-control">
					<?php $firstYear = (int)date('Y');
          $lastYear = $firstYear + 20;
          for($i=$firstYear;$i<=$lastYear;$i++)
          {   
              if($i==intval($fd['agreementyear']))
              {
              echo '<option value='.$i.' selected>'.$i.'</option>';
              }
              else
              {
               echo '<option value='.$i.'>'.$i.'</option>';  
              }
          }
          ?>
			</select>
		</div>
  <?php } ?> 
      
      <div class="clearfix"></div>
      
      <div class="form-group">
        <label>Amount of Rent <span class="mendetry">*</span></label>
        <input type="text" name="rent" value="<?php echo $fd['rent'];?>" class="form-control" placeholder="">
      </div>
      
   <?php 
   $arr1 =array("January","February","March","April","May","June","July","August","September","October","November","December");
   //print_r($arr);
   {?>   
  <label>When is Applicant planning to shift to Actual or bigger site/Land <span class="mendetry">*</span> </label>
  <div class="clearfix"></div>
   <div class="form-group col-md-6 no_pad_left">
      <label> Month </label>
			<select name="shiftmonth" class="selectpicker form-control">
					 <?php foreach ($arr1 as $key)
              { ?>
                  <option value="<?php echo $key; ?>"<?php if($key==$fd['shiftmonth']) { echo "selected"; }?> ><?php echo $key; ?></option>
              <?php
              } ?>
			</select>
	</div>

      
      
  <div class="form-group col-md-6 no_pad_left">
      <label> Year </label>
      <select name="shiftyear" class="selectpicker form-control">
         <?php $firstYear = (int)date('Y');
          $lastYear = $firstYear + 20;
          for($i=$firstYear;$i<=$lastYear;$i++)
          {   
              if($i==intval($fd['shiftyear']))
              {
              echo '<option value='.$i.' selected>'.$i.'</option>';
              }
              else
              {
               echo '<option value='.$i.'>'.$i.'</option>';  
              }
          }
          ?>
      </select>
	</div>
        <?php } ?>
      
       <div class="clearfix"></div>
      
       <label>(C) In case of conversion of a running 10+2 School to SHEMFORD <span class="mendetry">*</span></label> 
     
      <div class="form-group">
        <label>No. of students in the school<span class="mendetry">*</span></label>
        <input type="text" name="totalstudents" value="<?php echo $fd['totalstudents'];?>" class="form-control" placeholder="">
      </div>
      
      
       <div class="form-group">
        <label>Whether affiliated to(Applicable for SHEMFORD)<span class="mendetry">*</span></label>
        <ul class="iCheck "  data-color="green">
          <li>
            <input type="radio" name="samford" value="CBSE" <?php if("CBSE"==$fd['samford']) { echo "checked"; }?>>
            <label>CBSE</label>
          </li>
          <li>
            <input type="radio" name="samford" value="ICSE" <?php if("ICSE"==$fd['samford']) { echo "checked"; }?>>
            <label >ICSE</label>
          </li>
          
          <li>
            <input  type="radio" name="samford" value="Others" <?php if("Others"==$fd['samford']) { echo "checked"; }?>>
            <label >Others</label>
          </li>
        </ul>
      </div>

      <div class="form-group">
        <label>Website address of school<span class="mendetry">*</span></label>
        <input type="text" name="addressschool" value="<?php echo $fd['addressschool'];?>" class="form-control" placeholder="">
      </div>
     
      <div class="form-group">
        <label>Current fee structure<span class="mendetry">*</span></label>
        <textarea name="fee" class="form-control" rows="2" placeholder=" "><?php echo $fd['fee'];?></textarea>
      </div>
     
     
  
    </div>
    </section>
    
    
    
   
    
    
  </div>
  
  <div class="col-lg-12 no_pad_left no_pad_right">

<div class="panel-body myfrm">
                          
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped color_heding options-table" id="table-example">
              <thead>
                  <tr>
                      <th>Name of Schools </th>
                      <th>Area (For 10+2 in acres) (For pre-school in Sq.ft)</th>
                      <th>Established in year</th>
                      <th>Facilities provided by Schools</th>
                      <th>No. of children</th>
                      <th>Fee Structure</th>
                      <th>Photographs submitted</th>
                      <th><button type="button" class="btn btn-inverse add_tr">Add</button></th>
                  </tr>
              </thead>
           <tbody id="innertable" align="center">
  <?php  for($i=0;$i<sizeof($fd['schoolname']);$i++) {?>
  <tr class="odd gradeX gradeX_approvel" >
                      <td><div class="form-group">

        <input type="text" name="schoolname" value="<?php echo $fd['schoolname'][$i];?>" class="form-control" placeholder="">
      </div></td>
                                            <td><div class="form-group">

        <input type="text" name="schoolarea" value="<?php echo $fd['schoolarea'][$i];?>" class="form-control" placeholder="">
      </div></td>
                                            <td><div class="form-group">

        <input type="text" name="schoolestd" value="<?php echo $fd['schoolestd'][$i];?>" class="form-control" placeholder="">
      </div></td>
                                            <td > <div class="form-group">

        <input type="text" name="schoolfacility" value="<?php echo $fd['schoolfacility'][$i];?>" class="form-control" placeholder="">
      </div></td>
                                            <td ><div class="form-group">

        <input type="text" name="totalchild" value="<?php echo $fd['totalchild'][$i];?>" class="form-control" placeholder="">
      </div></td>
      
      <td ><div class="form-group">

        <input type="text" name="feestructure" value="<?php echo $fd['feestructure'][$i];?>" class="form-control" placeholder="">
      </div></td>
      
      <td > <div class="form-group">
         <ul data-color="green">
        <?php
             if($i>0){   $newVar=$i;   } 
             if(isset($fd['photographs'.$newVar]) && $fd['photographs'.$newVar]=='Yes')
             {  
                 $chk='checked="checked"';
                 $chk1='';
             }
             else
             {
                 $chk1='checked="checked"';
                 $chk='';
             }
         ?>
          <li>
            <input type="radio" name="photographs<?php if($i>0){echo $i;}?>" value="Yes" <?php echo $chk; ?>>
            <label>Yes</label>
          </li>
          <li>
            <input  type="radio" name="photographs<?php if($i>0){echo $i;}?>" value="No"  <?php echo $chk1; ?> >
            <label >No</label>
          </li>
        </ul>
        
        </div>
        </td>
        <td class="center"><button type="reset" class="btn btn-theme del">Delete</button></td>
        
        
    </tr>
  <?php } ?>                                      
                                        
                                        
                                    </tbody>
                                </table>
                           
                        </div>

</div>
  
 
  
  
</div>



 <footer class="panel-footer">
  <button type="submit" class="btn btn-inverse">Submit</button>
  <button type="reset" class="btn btn-theme"  onclick="location.href='<?php echo $admin_ui_urls;?>job?job=1'">Skip</button>
   <button type="button" id="goToPanel" class="btn btn-inverse">Back To Panel</button>
</footer>
  <!-- //col-sm-6 -->
  
  </form>
 <?php }?>

</div>

<script>
$(document).ready(function(){
	$('#crossbtn').click(function(){
	alert('hello');
	
	return false;
});

});
</script> 
<script>

	$(document).ready(function(){

	$("#formID").submit(function(e){
			e.preventDefault();
			if($(this).parsley( 'validate' )){
				alert("send");
			}
		});
		
		//iCheck[components] validate
		$('input').on('ifChanged', function(event){
			$(event.target).parsley( 'validate' );
		});
		
	});
</script> 
<script>
$(document).ready(function(){
	$('#crossbtn').click(function(){
	alert('hello');
	
	return false;
});

});
</script>


<script type="text/javascript">
			$(document).ready(function(){		
				
				$('.del').live('click',function(){
					$(this).parent().parent().remove();
				});
				
				$('.add_tr').live('click',function(){
					$('#innertable').append('<tr class="odd gradeX" ><td><div class="form-group"><input type="text" class="form-control" placeholder=""></div></td><td><div class="form-group"><input type="text" class="form-control" placeholder=""></div></td><td><div class="form-group"><input type="text" class="form-control" placeholder=""></div></td><td class="center"> <div class="form-group"><input type="text" class="form-control" placeholder=""></div></td><td class="center"><div class="form-group"><input type="text" class="form-control" placeholder=""></div></td><td class="center"><div class="form-group"><input type="text" class="form-control" placeholder=""></div></td><td class="center"> <div class="form-group"><ul class="iCheck "  data-color="green"><li><input type="radio" name="land"><label>Yes</label></li><li><input  type="radio" name="land" checked="checked"><label >No</label></li></ul></div></td><td class="center"><button type="reset" class="btn btn-theme del">Delete</button></td></tr>');		
				});        
			});
		</script>