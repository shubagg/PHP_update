<div class="search_lis_d">
        <div class="row">
        <?php 
          $SelectedOne=1;
          if(isset($_GET['action'])){
          include('../global.php');
         
           $data= json_decode($_POST['data'],true);
           $IndexNo=$_GET['index'];
           unset($data['index']);
           $TotalRecordIndex=0;
           for($total=1;$total<$IndexNo;$total++)
           {
              $TotalRecordIndex +=6;
           }
           $data['index']=$TotalRecordIndex;
           $SelectedOne=$_GET['index'];  
        }
        
            if(isset($data['categorys']))
            {
              
              $data['category']= implode("|", $data['categorys']);
              unset($data['categorys']);
            }
            if(isset($data['amenities']))
            {
              $data['amenity']= implode("|", $data['amenities']);
              unset($data['amenities']);
            }
            if(isset($data['range']))
            {
                $data['minPrice']=$data['range'][0];
                $data['maxPrice']=$data['range'][1];
                unset($data['range']);
            } 
            if(isset($data['localityrange']))
            {     //pending..
                /*$data['minLocation']=$data['localityrange'][0];
                $data['maxLocation']=$data['localityrange'][1];*/
                $data['minLocation']='';
                $data['maxLocation']='';
                unset($data['localityrange']);
            }
            
            if(isset($data['orderBy']) || isset($data['type'])){ 

            if(isset($data['minLocation']) || $data['maxLocation'])
            {
                unset($data['minLocation']);     
                unset($data['maxLocation']);
            }
            if(isset($data['minPrice']) && isset($data['minPrice']))
            {
              $data['basePrice']='true';    
            }
            if($data['type']=="")
            {
              $data['type']="";
            }
              
              $getlistingData=curl_posts("/get_listing_by_category",$data);

            }
            else
            { 

              $getlistingData=curl_posts("/manage_filter",$data);
            }
            
            $getlistingData=$getlistingData['data'];

            if(sizeof($getlistingData)==0){?>
            <div style="text-align: center; margin-left: auto;">
              <span>No Record Found.</span>
            </div>
            <?php }
            unset($data['index']);
            unset($data['nor']);
            
           $GetTotalSize=curl_posts("/get_listing_by_category",$data);
           $totalsize= sizeof($GetTotalSize['data']);
           $totalsize=ceil($totalsize/6);

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
                <div class="truncate search-page-text fnt_11"> <strong> </strong> <span class="search-result-address grey-text fnt_10"> Weddings | <?php echo $listingdata['type']?> </span> </div>
              </div>
              <div class="pull-right">
                <button type="button"data-toggle="modal" onclick="QuickView('<?php echo $listingdata['id']; ?>');" class="more_b">Quick view</button>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
      <ul class="pagination pull-right">
      <?php for ($i=1; $i <=$totalsize ; $i++) { ?>
        <li <?php if($SelectedOne==$i) { ?> class="active" <?php } ?> id="active<?php echo $i; ?>"><a href="" class="PaginationLink" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
     <?php }
     ?>
      </ul>