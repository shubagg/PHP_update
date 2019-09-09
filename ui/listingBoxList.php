<div class="search_lis_d">
        <div class="row">
        <?php
            
            if(isset($_GET['action']))  // pagenation filter
            { 
                 include('../global.php');
                 $SelectedOne=$_GET['page'];
                 $userId=$_SESSION['userInfo']['id'];
                 $TotalRecordIndex=0;
                 for($total=1;$total<$SelectedOne;$total++)
                 {
                    $TotalRecordIndex +=6;
                 }
                 
                 $datafield=array('userId'=>$userId,'index'=>$TotalRecordIndex,'nor'=>'6');
                 $data=array_merge($datafield, $_POST);
                
            }
            else
            {

              $SelectedOne='1'; //default page index selected.
              $userId=$_SESSION['userInfo']['id'];
              $data=array('userId'=>$userId,'index'=>'0','nor'=>'6');
              if(!empty($filterdata))
              {
                   $data=array_merge($data, $filterdata);
                   if(isset($filterdata['maxPrice']))
                   {
                      $data['basePrice']='true';
                   }
              }
            }
            
            $getlistingData=curl_posts("/get_listing_by_category",$data);    
            $getlistingData=$getlistingData['data'];
            
            if(sizeof($getlistingData)==0){?>
            <div style="text-align: center; margin-left: auto;">
              <span>No Record Found.</span>
            </div>
            <?php }
           unset($data['index']);
           unset($data['nor']);
           $totalrecord=curl_posts("/get_listing_by_category",$data);
           $totalsize= sizeof($totalrecord['data']);

          foreach($getlistingData as $listingdata){ 
          $eventId=base64_encode($listingdata['id']);
          $link="";
          if($listingdata['type']=='event')
          {
              $link= get_url('eventdetail').'/'.$eventId; 
              $imagepath=html_assets_url()."img/icons/evnt.png";
          }
          else
          {
              $link= get_url('venuedetail').'/'.$eventId;
              $imagepath=html_assets_url()."img/icons/venue.png";
          }
          $favourite='';
          $addclass="loginPopup();";
          if($_SESSION['userInfo']['id']!="")
          {
            $addclass="addwishlist('".$listingdata['id']."');";
            if($listingdata['favourite']=='true')
            {
              $addclass="removewishlist('".$listingdata['id']."');";
              $favourite='fa-heart-wishlistactive';
            }
          }
        ?>
          <div class="col-lg-6 col-md-6 mr_bt_10 over_f">
            <div class="well wel-box"> 
            <img src="<?php echo $listingdata['image'][0]?>" class="cursor" style="height: 261px;" onClick="window.location=('<?php echo $link; ?>')"/> 
            <span class="add-wish" id="wishlist<?php echo $listingdata['id'] ?>" onclick="<?php echo $addclass; ?>" data-product="<?php echo $listingdata['id']; ?>">
            <a href="javascript:void(0);">
            <i class="fa fa-heart <?php echo $favourite; ?>" id="classwishlist<?php echo $listingdata['id'] ?>" aria-hidden="true"></i>
            </a>
            </span> <span class="badge"><img src="<?php echo $imagepath; ?>" /></span>
              <div class="clearfix">
                <div class="pull-left">
                  <h4 class=" bold lg_f_cl no_mr_btm mr_tp_10"><?php echo $listingdata['title']; ?></h4>
                </div>
                <div class="pull-right">
                  <div class="truncate search-page-text fnt_10 mr_tp_10 grey-text">INR <?php echo $listingdata['basePrice'];?>/-</div>
                </div>
              </div>
              <div class="pull-left w_sr_l">
                <div class="truncate search-page-text fnt_11"> <strong><?php echo $listingdata['address']?></strong>  </div>
                <div class="truncate search-page-text fnt_11"> <strong> </strong> 
                <span class="search-result-address grey-text fnt_10">
                <?php 
                $getCategories=curl_posts('/get_feature_list_by_id',array('id'=>$listingdata['category'][0]));
                ?>
                 <?php echo $getCategories['data'][0]['title']; ?> | <?php echo $listingdata['type']?> </span> </div>
              </div>
              <div class="pull-right">
                <button type="button"data-toggle="modal" onclick="QuickView('<?php echo $listingdata['id']; ?>');" class="more_b">Quick view</button>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
<?php
  //for pagination..
  if(isset($_GET["page"]))
  $page = (int)$_GET["page"];
  else
  $page = 1;
  $setLimit = 6;
  $Pagedata=array('limit'=>$setLimit,'page'=>$page,'totalrecord'=>$totalsize);
  echo showPagination($Pagedata);
?>