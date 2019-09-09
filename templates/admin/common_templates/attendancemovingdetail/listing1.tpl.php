<section class="panel" >
    <!--<a href="javascript:;" onclick="show_datatable(334,'j.priority=3')">hello</a>-->

<div class="panel-body panel_bg_d">
    <div class="row">
        <div class="pull-right panel-body panel_bg_d" id="">
                    <?php
                        echo $this->custom_buttons(); 
                    ?>
        </div>   
</div>

<div class="tabbable tooltip-area">
                        <ul id="profile-tab" class="nav nav-tabs" data-provide="tabdrop">
                                
                                <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-list"></i>  &nbsp;  <?php echo $ui_string['tableview']?></a></li>
                                <li><a href="#tab2" data-toggle="tab"><i class="fa fa-map-marker"></i> &nbsp; <?php echo $ui_string['mapview']?> </a></li>
                            
                                
                        </ul>
                        
                    <div class="row">
                        
                        <div class="tab-content row resultSearch">
                        
                        <div class="tab-pane fade col-lg-12 in active" id="tab1">       
                            <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="table table-striped">
                                <thead>
                                    <tr>
                                        <?php 
                                        $table_header = $this->get_table_header();
                                        
                                        if(is_array($table_header) && count($table_header)) { 
                                            
                                            foreach($table_header as $val) {
                                                ?>
                                                <th class="text-center2">
                                                    <?= $ui_string[$val]; ?>
                                                </th>
                                                <?php
                                            }
                                            ?>
                                        <?php } ?>
                                    </tr>
                                </thead>
                            </table>
                                                    
                        </div>
                        
                        <div class="tab-pane fade col-lg-12" id="tab2">

                            <div class="map" id="map" ></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>                                                  
          
                    </div>
                </div>
        
        
    
</div>
</section>

<style>
.nopadding-left{ padding-left:0;}
.map{ width:100% !important; height:400px !important; position:relative !important;}
</style>

<?php get_admin_footer(); 
//pr($attendence_map); die('tst');
?>  
<script>
var ui_url='<?php echo admin_ui_url();?>';
var jsonResult='';
var assets_url = "<?php echo assets_url(); ?>";
var data = [];
</script>
<script type="text/javascript" src="<?php echo assets_url(); ?>map/map.js" ></script>
<script type="text/javascript">
    function get_result(data)
    {
        if((data) && (data!=undefined))
        {
            jsonResult = JSON.parse(data);
            jsonResult = jsonResult['all_data']['userMapData'];
           // console.log(jsonResult);
        }
    }

</script>
<script type="text/javascript">
    var map, map2;
    $(document).ready(function(){



    
    
    $('a[href="#tab2"]').click(function()
    {       
          setTimeout( function(){
            var initializemap = [];
            initializemap['zoom'] = 13;
            initializemap['div_id'] = 'map';
                if(map=='')
                {
                    initialize_map(initializemap);
                    call_map_attendence();  
                }

            },500);
    });

    });


    
    var parseresult = [];
    function call_map_attendence()
    {
        var bound_data = [];
        parseresult = jsonResult;//JSON.parse(jsonResult);
        var lengthofmap=parseresult.length;
        for(si=0;si<lengthofmap;si++ )
        {
             
             var id=  parseresult[si]['id'];
             var lat=  parseFloat(parseresult[si]['lat']);
             var lng=  parseFloat(parseresult[si]['lng']);
             var type = parseresult[si]['type'];
             var location = parseresult[si]['type'];
             var address=parseresult[si]['address'];
             var sdt = new Date(parseresult[si]['serverTimestamp']['sec']*1000);
             var ddt = new Date(parseresult[si]['timestamp']['sec']*1000);
             var servertime = '';
             var devicetime = '';
            if(sdt)
            {

                var d = sdt;
                var formattedDate = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
                var hours = d.getHours();
                var minutes = d.getMinutes();
                var servertime = formattedDate+' '+hours + ":" + minutes;
            }
            if(ddt) 
            {     var d = ddt;
                 var formattedDate = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
                 var hours = d.getHours();
                 var minutes = d.getMinutes();
                 var devicetime = formattedDate+' '+hours + ":" + minutes;
             }
             if(servertime!='' || devicetime!='' )
             {
                alltm = servertime+'/'+devicetime;  
             }
             

             
             var data = [];
             data['id'] = id;
             data['lat'] = lat;
             data['lng'] = lng;
             data['lat'] = lat;
             data['div_id'] = 'map';
             data['icon'] = admin_ui_url+'attendance/map_images/'+type+'.png';
             data['bind'] = '<p>'+location+'<br/>lat '+lat+',lng '+lng+'<br/>'+address+'</p>';

             add_map_marker(data);
             var bound_data_temp = [];
             bound_data_temp.push(lat,lng);
             bound_data.push(bound_data_temp);
             //console.log(bound_data);
             //add_marker(id,lat,lng,address,alltm);
             if(si==(lengthofmap-1))
             {  
                var map_boud_array = [];
                map_boud_array['div_id'] = 'map';
                map_boud_array['data'] = bound_data;
                console.log(map_boud_array);
                map_fitbound(map_boud_array);
             }
        }
       
    }
  </script>



<script>
    function get_instant_location(uid)
    {
        var url = '<?php echo $admin_ui_url ?>'+'attendance/ajax/attendance_manage.php';
        var result = '';
        $.ajax({


            url:url,
            type:'post',
            data:{'instant_location':'yes','userId':uid},
            success:function(suc)
            {
                
                suc = JSON.parse(suc);
                
                //var address=suc.data.userdata.address;
                console.log(suc.data.userdata);
                if(suc.data.userdata){
                    if((suc.data.userdata.address!=null) || (suc.data.userdata.address!='undefined') || (suc.data.userdata.address!=''))
                    {
                        $("#statusid").html("current Location :"+address);
                    }
                    else
                    {
                        $("#statusid").html("current location not found");
                    }
                    //alert("exist");
            }
            else
            {
                    $("#statusid").html("current location not found");
            }
                

            }
        });
    }


</script>


