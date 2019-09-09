<section class="panel" >
    <header class="panel-heading sm">
        <div class="row">
            <div class="col-md-12 panel-heading">
                <h3><?= !empty($request_data['page_heading']) ? $ui_string[$request_data['page_heading']] : ''; 
                    if(isset($_REQUEST['fromDate']))
                    {
                      echo " " .$ui_string['from'] . '  ' . '<span id="fDate">'. $_REQUEST['fromDate'] .'</span>';
                      if(isset($_REQUEST['toDate']))
                      {
                        echo " " .$ui_string['to'] . '  ' . '<span id="tDate">'.$_REQUEST['toDate'] . '</span>';
                      }
                      else
                      {
                        echo " " .$ui_string['to'] . '  ' . '<span id="tDate">' .date('Y-m-d') . '</span>';
                      }
                    $fromdate = (isset($_GET['fromDate']))? $_GET['fromDate']:date('yyyy-mm-01');
                    $todate = (isset($_GET['toDate']))? $_GET['toDate']:date("Y-m-d");
                    $userid = $_REQUEST['id'];


                    }
                  ?>
                </h3>
            </div>
            
        <div class="col-md-2 margn-tp-10">
        <label><?php echo $ui_string['fromdate'];?></label>
           <div class="input-group date form_datetime " data-picker-position="bottom-left"  data-date-format="yyyy-mm-dd" >
    					<input type="text" readonly id="fromDate" class="form-control input-height" value="<?php echo $fromdate; ?>">
              <span class="error" id="e_fromDate"></span>
    					<span class="input-group-btn">
    					<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
    					<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
    					</span>
    			</div>
        </div>
        
        <div class="col-md-2  margn-tp-10">
        <label><?php echo $ui_string['todate'];?></label>
        <div class="input-group date form_datetime " data-picker-position="bottom-left"  data-date-format="yyyy-mm-dd" >
					<input type="text" id="toDate" readonly class="form-control input-height" value="<?php echo $todate; ?>">
          <span class="error" id="e_toDate"></span>
					<span class="input-group-btn">
					<button class="btn btn-default" type="button"><i class="fa fa-times"></i></button>
					<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
			  </div>
        </div>


        <div class="col-md-2  margn-tp-10">
          <div class="input-group ">
<div><label>&nbsp;</label></div>
              <button class="btn btn-theme-inverse" onclick="changeData()" ><?php echo $ui_string['submit']?></button>
          </div>
        </div>
            <!--<div class="col-md-6 text-right">
            

                <h4><?= date('M-Y');
                ?></h4>
                
            
            
                
            </div>-->
            

        </div>
            <div class="row">
                
                <?php

                  //  echo "<pre>"; print_r($_REQUEST); die;
                    
                    $attdetail=get_user_attendance(array("mid"=>"22","smid"=>"1","userId"=>$userid,"fromDate"=>$fromdate,"toDate"=>$todate,"trackType"=>"web"));

                  //  echo "<pre>"; print_r($attdetail); die;


                ?>
                
               <div class="col-md-6 col-sm-12 col-xs-12 ">
                  <!--<span class="pull-left usercircle pt10-mt15"><i class="fa fa-user"></i></span>-->
                  <h4 class="cust_h4 pt10-mt15"><?php echo $ui_string['name']?> <br><span class="f14-c6"><?php echo $attdetail['data']['userInfo']['name']; ?></span></h4>
               </div>
               <div class="col-md-6 col-sm-12 col-xs-12  text-right" >
                  <h4 class="cust_h4 mt-15"><?php echo $ui_string['deviceid']?><br> <span class="f14-c6"><?php echo $attdetail['data']['userInfo']['deviceId']; ?></span></h4>
                  <!--<h4 class="cust_h4 mt-10"><?php echo $ui_string['currentlocation']?><br><span class="f14-c6"><?php echo $attdetail['data']['userInfo']['lastAddress']; ?></span></h4>-->
               </div>
               <div class="clearfix"></div>
            
                            
                
            </div>
    </header>
    
</section>