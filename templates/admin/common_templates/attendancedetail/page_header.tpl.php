<section class="panel" >
    <header class="panel-heading sm">
        <div class="row">
            <div class="col-md-6">
                <h3><?= !empty($request_data['page_heading']) ? $ui_string[$request_data['page_heading']] : ''; 
                ?></h3>
                
            </div>
            <div class="col-md-6 text-right">
            
                <h4><?= date('M-Y');
                ?></h4>
                
            
            
                
            </div>
            

        </div>
            <div class="row">
                
                <?php

                  //  echo "<pre>"; print_r($_REQUEST); die;
                    $fromdate = (isset($_GET['fromDate']))? $_GET['fromDate']:date('2017-05-01');
                    $todate = (isset($_GET['toDate']))? $_GET['toDate']:date("Y-m-d");
                    $userid = $_REQUEST['id'];
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