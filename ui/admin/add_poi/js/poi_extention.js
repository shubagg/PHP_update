var activeClassId = '';
function updateVehicle()
{
  $.ajax({
        url:admin_ui_url+"traking/ajax/trail_with_stopage_report.php",
        data:'userId='+userId,
        type:'post',
        success:function(suc)
        { 
            a = JSON.parse(suc);
            vh_data = JSON.stringify(a['location']);
            vhPath_data = JSON.stringify(a['path']);
            var vjsonData = a['vjson'];
            //updateVehicleCurrentStatus(vjsonData);
            flag1 = 1;
            //get_trialwithstoppage();
        }
  })
}

function updateVehicleCurrentStatus(vdata)
{        
    var vl = 0;
    var str = '';
    vjson=[];
    for(i=0;i<vdata.length;i++)
    {
        var fillColor = '';
        switch(vdata[i]['status'])
        {
          case 'inactive' :
            fillColor = 'btn-inactive-color';
          break;
          case 'running' :
            fillColor = 'btn-running-color';
          break;
          case 'idle' :
            fillColor = 'btn-idle-color';
          break;
          case 'stop' :
            fillColor = 'btn-stop-color';
          break;
        }

        var ignsign = (vdata[i].ign == 0)? fillColor : fillColor;
        var acsign = (vdata[i].ac == 0)? 'color-inverse' : fillColor;
        //var gpssign = (vdata[i].gps == 0)? 'inverse' : 'primary';
        var signalImage = vdata[i].ss+".png";
        var vehicleJson = JSON.stringify(vdata[i]);
	var activeClass = (vdata[i].vehicleId == activeClassId)? 'active' : '';
        vjson.push(vehicleJson);
	
        str+='<li class="cmn_cls '+activeClass+'" id="'+vdata[i].vehicleId+'" onclick="updateVehicleInfo('+vl+')">';
        str+='<small> <span class="pull-left more_car"> <i class="fa fa-car"></i> &nbsp;'+vdata[i].title+' </span> <span class="pull-right">';
        str+='<Span data-toggle="tooltip" title="IGN" data-container="body" data-placement="top" ><i class="fa fa-power-off '+ignsign+'" style="font-size:20px"></i></span>';
        str+='<Span data-toggle="tooltip" title="AC" data-container="body" data-placement="top" ><i class="fa  fa-bolt '+acsign+'" style="font-size:20px"></i></span>';
        str+='<Span data-toggle="tooltip" title="Signal" data-container="body" data-placement="top" ><img style="width:20px;" src="'+admin_ui_url+'traking/marker_icon_img/'+signalImage+'"></span>';
        //str+='<Span data-toggle="tooltip" title="GPS" data-container="body" data-placement="top" ><i class="fa fa-location-arrow color-'+gpssign+'"></i></span>';
        str+='</small></li>';    
        vl++;
    } 
    $("#vehicleList").html(str);
}

//setInterval(function(){ updateVehicle(); }, 30000);

function searchVehicle()
{                     
  var parsevdata = vjson;
  var search_text=$('#searchText').val();
  var str = '';
  for(i=0;i<parsevdata.length;i++)
  {
    var pdta = JSON.parse(parsevdata[i]);
    var vname = pdta['title'];
                
    vname = vname.toLowerCase();
    search_text=search_text.toLowerCase();
    var ignsign = acsign = gpssign = '';
    var n = vname.search(search_text);
    if(n!='-1')
    {
      var fillColor = '';
        switch(pdta['status'])
        {
          case 'inactive' :
            fillColor = 'btn-inactive-color';
          break;
          case 'running' :
            fillColor = 'btn-running-color';
          break;
          case 'idle' :
            fillColor = 'btn-idle-color';
          break;
          case 'stop' :
            fillColor = 'btn-stop-color';
          break;
        } 

      if(pdta['ign'] == 0){ ignsign= fillColor}else{ ignsign= fillColor} ;
      if(pdta['ac'] == 0){ acsign='color-inverse'}else{ acsign=fillColor} ;
      //if(pdta['gps'] == 0){ gpssign='inverse'}else{ gpssign='primary'} ;

      var signalImage = img_url+""+pdta['ss']+".png";

      str+='<li class="cmn_cls" id="'+pdta['vehicleId']+'" onclick="updateVehicleInfo('+i+')">'
      str+='<small> <span class="pull-left more_car"> <i class="fa fa-car"></i> &nbsp;'+pdta['title']+' </span> <span class="pull-right">';
      str+='<Span data-toggle="tooltip" title="IGN" data-container="body" data-placement="top" ><i class="fa fa-power-off '+ignsign+'" style="font-size:20px"></i></span>';
      str+='<Span data-toggle="tooltip" title="AC" data-container="body" data-placement="top" ><i class="fa fa-certificate '+acsign+'" style="font-size:20px"></i></span>';
      str+='<Span data-toggle="tooltip" title="Signal" data-container="body" data-placement="top" ><img style="width:20px;" src="'+signalImage+'"></span>';
     // str+='<Span data-toggle="tooltip" title="GPS" data-container="body" data-placement="top" ><i class="fa fa-map-marker color-'+gpssign+'"></i></span>';
      str+='</small></li>';
    }
  }

  if(str != '')
  {
    $("#vehicleList").html(str);
  }
  else
  {
    str ='<li style="color:grey">No Record Found</li>';
    $("#vehicleList").html(str);
  }    
}

function get_vehicle_name(id)
{
  var parsevdata = vjson;
  for(i=0;i<parsevdata.length;i++)
  {
    var pdta = JSON.parse(parsevdata[i]);
    if(pdta.vehicleId == id)
    {
      return pdta.title;
    }
  }
}

var nLat='';
var nLng='';
function updateVehicleInfo(indexval)
{
  flag = 0;
  //re_initialize_map();
  remove_path();
  remove_markers();
  get_trialwithstoppage();
  $('#mapControl').show();
  $("#tooltipbtn").show();
  
  var mjson = JSON.parse(vjson[indexval]);
  nLat=mjson['lat'];
  nLng=mjson['lng'];
  
  pan(mjson['lat'],mjson['lng']);
  map.setZoom(18);
  $(".cmn_cls").removeClass("active");
  $("#"+mjson['vehicleId']).addClass("active");
  activeClassId = mjson['vehicleId'];
  $("#vh_name").html(mjson['title']);
  $("#vhId").val(mjson['vehicleId']);
	
   show_poi_on_map();
  $("#vh_driver").html('Driver, '+mjson['driverName']);
  //var date1 = new Date(mjson['datetime']['sec']*'1000');
  //var d1 = date1.customFormat( "#DD#/#MM#/#YYYY# #hh#:#mm#:#ss#" )
  //var d1 = date1.toString("dd/MM/yyyy HH:mm:ss");
  var d1 = mjson['datetime'];
  $("#vh_lastUpdate").html(d1);
  $("#vh_reachedTime").html(mjson['lastStopTime']);
  var latlngArr = [];
  $("#vh_location").html(mjson['location']);
  if(mjson['location']=='')
  {
    var y = {lat: mjson['lat'], lng: mjson['lng'], id: "vh_location"};
          latlngArr.push(y);
    update_latlngArr(latlngArr);
  }
  $("#vh_lat").html(mjson['lat']);
  $("#vh_lng").html(mjson['lng']);
  $("#vh_paniclat").html(mjson['panic_lat']);
  $("#vh_paniclng").html(mjson['panic_lng']);
  $("#vh_cspeed").html(mjson['speed']+' km/h');
  $("#vh_aspeed").html(mjson['aspeed']+' km/h');
  $("#vh_mspeed").html(mjson['mspeed']+' km/h');
  $("#vh_stop").html(toHHMMSS(mjson['stop']));
  $("#vh_lstop").html(toHHMMSS(mjson['lastStop']));
  $("#vh_trunning").html(toHHMMSS(mjson['running']));
  $("#vh_crunning").html(toHHMMSS(mjson['crunning']));
  $("#vh_lrunning").html(toHHMMSS(mjson['lrunning']));
  $("#vh_tdistance").html(mjson['distance']+' km');
  $("#vh_cdistance").html(mjson['cdistance']+' km');
  $("#vh_ldistance").html(mjson['ldistance']+' km');

  /*$("#vh_ign").removeClass("color-warning");
  $("#vh_ign").removeClass("color-inverse");
  $("#vh_ac").removeClass("color-inverse");
  $("#vh_ac").removeClass("color-success");
  $("#vh_gps").removeClass("color-inverse");
  $("#vh_gps").removeClass("color-primary");


  if(mjson['ign']==0)
  {
    $("#vh_ign").addClass("color-inverse");
  }
  else
  {
    $("#vh_ign").addClass("color-warning");
  }

  if(mjson['ac']==0)
  {
    $("#vh_ac").addClass("color-inverse");
  }
  else
  {
    $("#vh_ac").addClass("color-success");
  }

  if(mjson['gps']==0)
  {
    $("#vh_gps").addClass("color-inverse");
  }
  else
  {
    $("#vh_gps").addClass("color-primary");
  }*/
  $("#mapSetting").addClass( "active" );
}

function getIndex(id)
{
  var parsevdata = vjson;
  for(i=0;i<parsevdata.length;i++)
  {
    var pdta = JSON.parse(parsevdata[i]);
    if(pdta.vehicleId == id)
    {
      updateVehicleInfo(i);
      $(".cmn_cls").removeClass("active");
      $("#"+id).addClass("active");
      break;
    }
  }
}


function toHHMMSS(t) 
{
    var sec_num = parseInt(t, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    var time    = hours+':'+minutes+':'+seconds;
    return time;
}




/////////////////////////Lalit functions////////////////////////////////////

function show_poi_on_map()
{
  $.ajax({
    url:admin_ui_url+"add_geofence/ajax/get_geofence_data.php",
    data:"userId="+userid+"&mid="+mid+"&smid="+smid+"&iid="+iid,
    type:"POST",
    success:function(suc)
        {
          console.log(suc);
          if(suc!='false')
          {
            suc=JSON.parse(suc);
            var poiData=JSON.parse(suc[0]['poiData']);

            setPointerOnMap(poiData,map); 
          }
        }
      })

}

function open_geofence(link,pr)
{
  var othervar='';
  if(panelId){  othervar='&panel='+panelId; }
  if(pr)
  {
    window.location=link+"?vid="+btoa($('#vhId').val())+"&pr="+pr+othervar+"&lng="+nLng+"&lat="+nLat;
  }
  else
  {
    window.location=link+"?vid="+btoa($('#vhId').val())+othervar+"&lng="+nLng+"&lat="+nLat;
  }
}

function show_poi()
{
  
  $.ajax({
    url:admin_ui_url+"add_geofence/ajax/get_geofence_data.php",
    data:"userId="+userid+"&mid="+mid+"&smid="+smid+"&iid="+iid,
    type:"POST",
    success:function(suc)
        {
          
            var html='';
            if(suc!='false')
            {
              suc=JSON.parse(suc);
              var poiData = [];
              
              if(suc['success'] != 'false')
              {
                poiData = JSON.parse(suc[0]['poiData']);
              }
              
              if(poiData.length>0)
              {
                for(i=0;i<poiData.length;i++)
                {
                    html+='<tr id="poi-'+i+'">';
                      html+='<td>'+(i+1)+'</td>';
                      html+='<td>'+poiData[i]['creationDate']+'</td>';
                      html+='<td>'+poiData[i]['address']+'</td>';
                      html+='<td><a data-original-title="Delete" onclick="delete_poi_temp('+i+');" class="btn btn-default btn-sm" title=""><i class="fa fa-trash-o"></i></a><a onclick="open_geofence(\''+admin_ui_url+'add_poi/add_poi.php\',\''+i+'\')" class="btn btn-default btn-sm" title="Show" data-original-title="Show" data-toggle="modal"><i class="fa fa-binoculars"></i></a></td>';
                      html+='</tr>';
                }
              }
              else
              {
                html='<tr><td colspan="4">Nothing Found</td></tr>';
              }
            }
            $('#dttable1').dataTable().fnDestroy();
            $('#poiDataTable').html(html);
            $('#dttable1').dataTable();
            $('#md-poi').modal();
        }

  })
  
}

function delete_poi_temp(id)
{
  $('#deletType').html('<button type="button" id="delete_sure_button" class="btn btn-theme-inverse" onclick="delete_poi(\''+id+'\')"><i class="glyphicon glyphicon-ok"></i>Confirm</button>');  
  $('#sure_to_delete').modal();
}


function delete_poi(id)
{
  $('#sure_to_delete').modal('toggle');
    $.ajax({
      url:admin_ui_url+"add_poi/ajax/delete_poi.php",
      data:"userId="+atob(userid)+"&mid="+mid+"&smid="+smid+"&iid="+iid,
      type:"POST",
      success:function(suc)
          {
            suc=JSON.parse(suc);
            if(suc['success']=='true')
            {
                $('#model_des').html('POI Deleted Successfully');
                $('#poi-'+id).remove();
            }
            else
            {
                $('#model_des').html('POI Not Deleted Successfully');
            }
            $('#success_modal').modal();
            setTimeout(function(){ $('#success_modal').modal('toggle'); },1000);
          }
    })
}

function trip_start()
{ 
  var id = $("#vhId").val();
    $.ajax({
      url:webservice_url+"/trip_start",
      data:{id:id},
      type:"POST",
      success:function(suc)
        {
          $('#trip_modal').modal("show");
          setTimeout(function(){ $('#trip_modal').modal('hide'); },1000);
        }
    })
}
