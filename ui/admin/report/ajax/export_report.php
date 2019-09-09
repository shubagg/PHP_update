<?php
include_once '../../../../global.php';


	 $vehicle_id=$_REQUEST['vechileid'];
	 $report_data=$_REQUEST['reportdata'];
	 $report_type=$_REQUEST['reporttype'];
	 //$duration=$_REQUEST['reporttime'];
	 $vehiclenames=$_REQUEST['vehiclenames'];

	 $fromdate= getalldate($_REQUEST['repformdate']);
	 $todate= getalldate($_REQUEST['reptodate']);
	 if($_REQUEST['reporttype']=="distanceWithinTime")
	 {
	     $duration="day";
	 }
	 else
	 {
	   $duration=$_REQUEST['reporttime'];
	 }
	 	


	 $record_report=curl_post("/get_report_data",array('vehicleId'=>$vehicle_id,'duration'=>$duration,'fromDate'=>$fromdate,'toDate'=>$todate,'type'=>$report_type));
     

     $show_data=array();



switch($report_type)
		{
			case "distance":
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"distance"=>$report['distance']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date From','Date To','Total Distance(km)');
				 break;
		
			case "distanceWithinTime":
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"sloc"=>$report['startLocation'],"eloc"=>$report['endLocation'],"distance"=>$report['distance']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Start Time','End Time','Start Location','End Location','Total Distance(km)');
				 break;

			case "ac":

			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"distance"=>convertSecToTime($report['time']));
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date From','Date To','Total A.C. Time(HH:MM:SS)');
		        	break;
			
			case "moving":
			
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"time"=>convertSecToTime($report['time']));
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date From','Date To','Total Moving Time(HH:MM:SS)');
				break;
				
			case "idle":
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"time"=>convertSecToTime($report['time']),"address"=>$report['address']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Start Time','End Time','Time Interval','Location');
				break;
				
			case "stoppage":
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"time"=>convertSecToTime($report['time']),"address"=>$report['address']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date From','Date To','Stoppage Duration','Stoppage Location');

				break;
				
			case "panic":

			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['ftime'],"totime"=>$report['etime'],"panic"=>$report['panic'],"address"=>$report['address']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date From','Date To','Alert','Location');
				
			break;
				
			case "vehicle":
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['startLocation'],"totime"=>$report['startTime'],"stopTime"=>$report['stopTime'],"distance"=>$report['distance'],"moving"=>$report['moving'],"idle"=>$report['idle'],"stoppage"=>$report['stoppage'],"stoppageLocation"=>$report['stoppageLocation']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Start Location','Start Time','Stop Time','Distance(Km)','Moving Time','Idle Time','Stoppage Time','Stoppage Location');
	
				break;
				
			case "trail":
				
			foreach($record_report['data'] as $report)
			{
			   $data=array("vechileid"=>$vehiclenames,"ignition"=>$report['ignition'],"status"=>$report['status'],"lat"=>$report['lat'],"lng"=>$report['lng'],"speed"=>$report['speed']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','ignition','status','lat','lng','speed');
	
							
			break;
				
			case "fuel":

			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>date("Y-m-d h:i:s A",$report['start_date']),"totime"=>date("Y-m-d h:i:s A",$report['end_date']),"fuel"=>$report['fuel']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date From','Date To','Fuel');
				
							
			break;
				
				
			case "overspeed":
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"fromtime"=>$report['datetime'],"speed"=>$report['speed'],"location"=>$report['location']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Date Time','Speed',"Location");
				
			break;
				
			case "geofence":
			
			foreach($record_report['data'] as $report)
			{
			    $data=array("vechileid"=>$vehiclenames,"datetime"=>$report['datetime'],"lat"=>$report['lat'],"lng"=>$report['lng'],"type"=>$report['type'],"location"=>$report['location']);
    array_push($show_data,$data);
			}

			$header_fields=array('Vehicle No','Datetime','Lat','Long','Geofence Type','Location');

			break;
		}


$ex=curl_post("/export_xls",array("header_fields"=>json_encode($header_fields),"show_data"=>json_encode($show_data)));

echo json_encode($ex);


function getalldate($dateformat)
{
 
	$dateformats =explode(" ",$dateformat);
	$d=$dateformats['0'];
        $y=$dateformats['2'];
        $m=$dateformats['1'];

	$mons = array("January"=>"01","February"=>"02","March"=>"03","April"=>"04","May"=>"05","June"=>"06","July"=>"07","August"=>"08","September"=>"09", "October"=>"10","November"=>"11","December"=>"12");
         
	return $y."-".$mons[$m]."-".$d;      

}

?>
