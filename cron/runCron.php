<?php

class TeamCron 
{

	public $cronName="";
	public $cronId="";
	public $currentRunId = 0;
	public $cronStatusId=0;
	public $action="";
	function __construct($id,$action)
	{
		
    	$this->cronId=$id;
    	$this->action=$action;

    	if($this->action!="" && $this->action=='cron_stop')
		{
			exit();
		}
	    $cronInfo=get_crons(array('cronId'=>$this->cronId));
	    
		if($cronInfo['success']=='true')
        {
        	
        	$this->cronName=$cronInfo['data'][0]['name'];
        	$this->currentRunId =time()*1000;
		    $cronStatus=$this->cron_status($this->cronStatusId,time(),'start',1);

		    if($cronStatus)
	        {
	        	$this->cronStatusId=$cronStatus;
	        }
            if($cronInfo['data'][0]['multiRun']=='false')
            {
            	
            	
                $infoData=$this->execute();
               
            }
            else
            {
            	
            	$previousCronStatus=get_previous_cron_status(array('cronId'=>$id,'status'=>'running'));
				if($previousCronStatus['success']=='true')
				{
                    // how to find if a php is actually running. If this is actually running then
                        $cronStatus=$this->cron_status($previousCronStatus['data'][0]['id'],time(),'Already Running Stop',5);
                    /*else // if this php is actually not running, but only in database entry.
                        {
                            update database for this cron, to stop for all running status.
                            $this->update_current_cron_status($this->cronId);
                        }*/
                }
                else
                {

                	$infoData=$this->execute();

                	//print_r($infoData);
                }            
               
            }

        }
	}

	public function execute()
	{

		$cronStatus=$this->cron_status($this->cronStatusId,'','running',2);

		$allTriggers=get_all_time_triggers_data(array('cronId'=>$this->cronId));
		//echo "<pre>";
		//print_r($allTriggers);die;
		if(!empty($allTriggers['data']))
		{
			$i=0;
			foreach ($allTriggers['data'] as $value) 
			{
				$responseResult="Ok";
				$cronResult="Ok";
				$starttime=time();
				$url=site_url().$value['fileName'];
				$response=get_curl_cron_response($url,array('starttime'=>$this->currentRunId));
				if($response=='0')
				{
					  $responseResult="Not Ok";
					  $cronResult="Not Ok";
				}
				else if($response=='2')
				{
					  $responseResult="No Data";
					  
				}
				$endtime = time();
				$totaltime=$endtime-$starttime;
				if($totaltime>=$value['alermTime'])
				{
					$this->alerm_send();
				}

				$this->cron_error_logs($value['id'],$this->currentRunId,$value['fileName'],$starttime,$endtime,$responseResult,$totaltime);
				if($value['continueCronOnFailure']=='false')
				{
					 break;   
				}
				$i++;
			}
			$cronStatus=$this->cron_status($this->cronStatusId,time(),'stop',3,$cronResult);
		}
		

		
	}

	public function cron_error_logs($triggerId,$logsId,$triggerName,$starttime,$endtime,$response,$totaltime)
	{
		$cronErrorLogs=manage_cron_error_logs(array('id'=>'0','logsId'=>"$logsId",'cronId'=>$this->cronId,'cronName'=>$this->cronName,'triggerId'=>$triggerId,'triggerName'=>$triggerName,'starttime'=>"$starttime",'endtime'=>"$endtime",'totaltime'=>"$totaltime",'result'=>$response));
	}

	public function cron_status($cronStatusId,$time,$status,$type,$result="")
	{
		if($type==1)
		{
			$Info=manage_cron_status(array('id'=>$cronStatusId,'cronId'=>$this->cronId,'cronName'=>$this->cronName,'logsId'=>"$this->currentRunId",'starttime'=>"$time",'status'=>$status));
			
			if($Info['success']=='true')
			{
				return $Info['data'];
			}
			return false;
		}
		else if($type==2)
		{
			$Info=manage_cron_status(array('id'=>$cronStatusId,'cronId'=>$this->cronId,'status'=>$status));
			if($Info['success']=='true')
			{
				return $Info['data'];
			}
			return false;
		}
		else if($type==3)
		{
			$Info=manage_cron_status(array('id'=>$cronStatusId,'cronId'=>$this->cronId,'status'=>$status,'endtime'=>"$time",'result'=>$result));
			if($Info['success']=='true')
			{
				return $Info['data'];
			}
			return false;
		}
		else if($type==4)
		{
			$Info=manage_cron_status(array('id'=>$cronStatusId,'cronId'=>$this->cronId,'endtime'=>"$time",'status'=>$status));
			if($Info['success']=='true')
			{
				return $Info['data'];
			}
			return false;
		}
		else if($type==5)
		{
			$Info=manage_cron_status(array('id'=>$cronStatusId,'cronId'=>$this->cronId,'endtime'=>"$time",'status'=>$status));
			if($Info['success']=='true')
			{
				return $Info['data'];
			}
			return false;
		}
	}

	public function check_previous_cron_status($cronId)
	{
		$Info=get_previous_cron_status(array('cronId'=>$cronId));
		if($Info['success']=='true')
		{
			$currentCronStatusId=$Info['data'][0]['id'];
			$currentCronStatus=$Info['data'][0]['status'];
			if($currentCronStatus=='running')
			{
				return $currentCronStatusId;
			}
			return false;
		}
		return false;
		
	}

	public function alerm_send()
	{

	}

	public function update_current_cron_status($cronId)
	{
		$Info=update_cron_status(array('cronId'=>$cronId,'status'=>'running'));
			if($Info['success']=='true')
			{
				return $Info['data'];
			}
			return false;
	}

}


?>