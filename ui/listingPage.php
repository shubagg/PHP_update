<?php 
    include('../global.php');
    include('../templates/ui/header.php'); 


    if(isset($_GET['id']))
 	{
    	$categoryId=base64_decode($_GET['id']);
    	/*$getlistingData=curl_posts("/get_listing_by_category",array('category'=>$categoryId,'userId'=>$_SESSION['userInfo']['id']));*/
    	
        $myarray=$_GET;
        foreach($myarray as $key=>$value)
        {
            if(is_null($value) || $value == '')
            unset($myarray[$key]);
        }
       
        if($_GET['orderBy']!=""){
            $myarray['by']='basePrice';
        }
        unset($myarray['id']);
        $myarray['category']=$categoryId;
        $myarray['userId']=$_SESSION['userInfo']['id'];
        $myarray['index']=0;
        $myarray['nor']=6;

        $SelectedRange=10000;
        $valid=0;
        if(isset($_GET['range'])){
            $SelectedRange=$_GET['range']['1'];
            $valid=1;
            $ShortPrice='Min-₹'.$SelectedRange;
        }
        
    }
    else
    {
    	$getlistingData=array();
    }
    $getCategoriesData=curl_posts('/get_categories',array());
    $amenitiesData=curl_posts("/get_feature_list_by_id",array('fields'=>'title'));

    include_once(include_ui_template("listingpage"));
    
?>
<script type="text/javascript">
    /*var searchUrl="<?php echo get_url('listingpage').'/' ?>";
    var currnetUrl="<?php echo get_url('listingpage').'/'.$_GET['id'] ?>";*/

    var searchUrl="<?php echo get_url('listingpage/filter'); ?>";
    var settime_formsubmit="";
    jQuery("input[type='checkbox'][name='categorys[]'],input[type='range']").click(function(){
    clearTimeout(settime_formsubmit);
    settime_formsubmit = setTimeout(function()
    {
        shortorder();
    },1500);
    });
    
    function shortorder()    //send to the link..
    {
        var filter=$("#filterData").serialize();
        var att=$('#shortby-pc').serialize();
        window.location=searchUrl+"?"+att+"&"+filter; 
    }

    $(document).on('click','.PaginationLink',function (){
        $("body").addClass("over_flow_hid");
        $("html, body").animate({ scrollTop: 0 }, "slow");
        var index=$(this).attr('id');
        searchdata(index);
        return false;
    });

    function searchdata(index)
    {
         $(".loader_box").show();
        jQuery(".search_lis_data").html("");
        var datafield='<?php echo json_encode($myarray) ?>';
        $.ajax({
                url:"<?php echo site_url()?>ui/listingBox.php?action=1&index="+index,
                type:'POST',
                data: 'data='+datafield,
                success:function (suc) {
                    
                    setTimeout(function(){ jQuery(".search_lis_data").html(suc); $("body").removeClass("over_flow_hid"); $(".loader_box").hide(); }, 1500);

                    
                }
            })
        
    }
    function clearfilter() {
       window.location=currnetUrl;
    }
</script>

    <!-- <div>Country: <span id="country"></span></div>
    <div>State: <span id="state"></spa></div>
    <div>City: <span id="city"></span></div>
    <div>Latitude: <span id="latitude"></span></div>
    <div>Longitude: <span id="longitude"></span></div>
    <div>IP: <span id="ip"></span></div>    
    <script>
      $.getJSON('https://geoip-db.com/json/geoip.php?jsonp=?') 
         .done (function(location) {
            $('#country').html(location.country_name);
            $('#state').html(location.state);
            $('#city').html(location.city);
            $('#latitude').html(location.latitude);
            $('#longitude').html(location.longitude);
            $('#ip').html(location.IPv4);               
         });
    </script> -->
<?php 
include('../templates/ui/footer.php'); 
?>