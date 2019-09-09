<div id="main" class="dashboard">

  <div id="content">
    <div class="row">
      <div class="col-lg-8 col-md-8  col-sm-12 col-md-12 padding-left-0">
        <section class="panel">
          <header class="panel-heading">
            <h3><strong>Panel</strong> small-heading </h3>
          </header>
          <div class="panel-body">
            <p>Panel-body</p>
          </div>
        </section>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 col-md-12 padding-right-0" >
        <section class="panel" style="background:transparent;<?php if(check_user_permission("attendance","Attendance","all")!=1){ echo 'display:none;';}?>">
          <!--<header class="panel-heading xs" style="background:#fff;">
            <h2><strong>ATTENDANCE</strong></h2>
          </header>-->
          <?php
                  $disable = $action = $chandu = '';
                  $userId = $_SESSION['user']['user_id'];
                  $getAction = checkUserAttendance(array("userId"=>$userId,"mid"=>"22","smid"=>"1","date"=>date("Y-m-d")));
                  if($getAction['data'] == "3")
                  {
                      $disable = "style='display:none'" ;
                      $chandu = "(Your have already marked your attendance)";
                  }
                  else
                  {
                      $action = $getAction['data'];
                  }

                  $fromdate = date("Y-m-d",strtotime('-1 day', strtotime(date("Y-m-d"))));
                  $inoutdata = getUserInoutTime(array("userId"=>$userId,"mid"=>"22","smid"=>"1","toDate"=>date("Y-m-d"),"fromDate"=>$fromdate));
                 
              ?>
      
          <div>
            <div class="info-box bg-yellow ">
            <header class="panel-heading" >
       <h4><strong>Today </strong><small><?php echo date("M d,Y");?></small>
       <br /><small  id="chandu"><?php echo $chandu;?></small> <span id="inout" <?php echo $disable;?> class="chk_in_btn"  onclick="manageAttendance()"><?php echo $action;?></span> </h4>
            
          </header>
             <!--<span class="info-box-icon"><i class="fa fa-sign-in" aria-hidden="true"></i></span>-->
              <div class="info-box-content"> 
			  <div class="row" style="padding: 10px 0px;">
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <span class="info-box-text inl_blk">Last Checkin <strong class="fnt_18" id ="cintime">
          <?php
            date_default_timezone_set("Asia/kolkata");
            if(count($inoutdata['data'][1]['checkindata']) > 0)
            {
                echo date("h:i A",$inoutdata['data'][1]['checkindata']['serverTimestamp']->sec);
            }
            else
            {
                echo "NA";
            }
           ?>
        </strong></span></div>
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <span class="info-box-text inl_blk">Last Checkout <strong class="fnt_18" id ="couttime"><?php
            if(count($inoutdata['data'][1]['checkoutdata']) > 0)
            {
                if($inoutdata['data'][1]['checkindata']['serverTimestamp']->sec > $inoutdata['data'][1]['checkoutdata']['serverTimestamp']->sec)
                {
                    echo "--";
                }
                else
                {
                    echo date("h:i A",$inoutdata['data'][1]['checkoutdata']['serverTimestamp']->sec);
                }
                
            }
            else
            {
                echo "NA";
            }
           ?></strong></span></div>
              
              <!--<div class="col-md-12">
              <div class="progress">
                 
                </div>
                <span class="progress-description"> Thursday 21 April , 2016 </span> 
              
              
              </div>-->
              
			  </div>
			 
			  
                
				</div>
              <!-- /.info-box-content --> 
            </div>
          </div>
          
          
          <div>
            <div class="info-box bg-yellow">
            <header class="panel-heading" >
            <h4><strong>Yesterday</strong> <small style="font-size:13px;"><?php  echo date("M d,Y",strtotime('-1 day', strtotime(date("Y-m-d"))));?></small></h4>
            
          </header>
             <!--<span class="info-box-icon"><i class="fa fa-sign-in" aria-hidden="true"></i></span>-->
              <div class="info-box-content"> 
			  <div class="row" style="padding: 10px 0px;">
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <span class="info-box-text inl_blk">Last Checkin <strong class="fnt_18">
          <?php if(count($inoutdata['data'][0]['checkindata']) > 0)
            {
                echo date("h:i A",$inoutdata['data'][0]['checkindata']['serverTimestamp']->sec);
            }
            else
            {
                echo "NA";
            }?></strong></span></div>
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <span class="info-box-text inl_blk">Last Checkout <strong class="fnt_18"><?php if(count($inoutdata['data'][0]['checkoutdata']) > 0)
            {
                if($inoutdata['data'][0]['checkindata']['serverTimestamp']->sec > $inoutdata['data'][0]['checkoutdata']['serverTimestamp']->sec)
                {
                    echo "--";
                }
                else
                {
                    echo date("h:i A",$inoutdata['data'][0]['checkoutdata']['serverTimestamp']->sec);
                }
            }
            else
            {
                echo "NA";
            }?></strong></span></div>
              
              <!--<div class="col-md-12">
              <div class="progress">
                 
                </div>
                <span class="progress-description"> Thursday 21 April , 2016 </span> 
              
              
              </div>-->
              
			  </div>
			 
			  
                
				</div>
              <!-- /.info-box-content --> 
            </div>
          </div>
          
     
    
          
        
          
          
        </section>
       
        <section class="panel" <?php if(get_module_status(array("id"=>"7","name"=>"blog"))==0){ echo "style='display:none'";}?>>
          <header class="panel-heading">
            <h3><strong>RECENT</strong> Blogs </h3>
          </header>
          <div>
              <ul class="latest_news">
            <?php
              $getAction = get_blog_by_id(array("id"=>"0","index"=>"0","nor"=>"3","amid"=>"10","asmid"=>"1"));
              foreach ($getAction['data'] as $key => $value) {
                 $blogid = $value['id']; 
          
                $blog_img=$value['association_data']['media'][1][$blogid][0]['editedMedia'][4]['image'];
                $comment = get_count(array("aiid"=>$blogid,"commentId"=>"0","type"=>"comment","amid"=>"7","asmid"=>$value['smid']));
            ?>
                <li onclick="window.location='<?php echo $site_url;?>ui/admin/blog/user_blog.php?id=<?php echo $blogid;?>'">
                  <div class="pull-left"> <img src="<?php echo $site_url.'uploads/media/images/'.$blog_img;?>"> </div>
                  <div class="pull-left" style="padding: 0px 10px; width:75%;"> <span><?php echo $value['title'];?></span><br>
                    <span><?php echo date("M d,Y",$value['lastUpdate']->sec);?> , <?php echo $comment['data'];?> Replies</span> </div>
                </li>
            <?php
              }
            ?>
            </ul>
          </div>
          <footer class="panel-footer align-lg-right"> <a href="<?php echo $site_url;?>ui/admin/blog/user_blog.php">view more</a> </footer>
        </section>
        
        
        <section class="panel" <?php if(get_module_status(array("id"=>"6","name"=>"forum"))==0){ echo "style='display:none'";}?>>
          <header class="panel-heading ">
            <h3><strong>RECENT</strong> Forums </h3>
          </header>
          <div>
            <ul class="latest_news">
              <?php
                $getAction = get_forum_by_id(array("id"=>"0","index"=>"0","nor"=>"3","amid"=>"10","asmid"=>"1"));
                foreach ($getAction['data'] as $key => $value) {
                   $forumid = $value['id']; 
                  $comment = get_count(array("aiid"=>$forumid,"commentId"=>"0","type"=>"comment","amid"=>"6","asmid"=>$value['smid']));
              ?>
                  <li onclick="window.location='<?php echo $site_url;?>ui/admin/forum/forumanswer.php?id=<?php echo $forumid;?>&forum=<?php echo $value['smid'];?>'">
                    <!--<div class="pull-left"> <img src="http://192.168.0.165/nav/assets/img/gllary_img3.jpg"> </div>-->
                    <div class="pull-left" style="padding: 7px 10px;"> <span><?php echo $value['question'];?></span><br>
                      <span><?php echo date("M d,Y",$value['lastUpdate']->sec);?> , <?php echo $comment['data'];?> Replies</span> </div>
                  </li>
              <?php
                }
              ?>
            </ul>
          </div>
          <footer class="panel-footer align-lg-right"> <a href="<?php echo $site_url;?>ui/admin/forum/forum.php">view more</a> </footer>
        </section>
         
        
      </div>
    </div>
  </div>
</div>
