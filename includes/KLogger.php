<?php
	
	/* Finally, A light, permissions-checking logging class. 
	 * 
	 * Author	: Kenneth Katzgrau < katzgrau@gmail.com >
	 * Date	: July 26, 2008
	 * Comments	: Originally written for use with wpSearch
	 * Website	: http://codefury.net
	 * Version	: 1.0
	 *
	 * Usage: 
	 *		$log = new KLogger ( "log.txt" , KLogger::INFO );
	 *		$log->LogInfo("Returned a million search results");	//Prints to the log file
	 *		$log->LogFATAL("Oh dear.");				//Prints to the log file
	 *		$log->LogDebug("x = 5");					//Prints nothing due to priority setting
	*/
	
	class KLogger
	{
		
		const DEBUG 	= 1;	// Most Verbose
		const INFO 		= 2;	// ...
		const WARN 		= 3;	// ...
		const ERROR 	= 4;	// ...
		const FATAL 	= 5;	// Least Verbose
		const OFF 		= 6;	// Nothing at all.
		
		const LOG_OPEN 		= 1;
		const OPEN_FAILED 	= 2;
		const LOG_CLOSED 	= 3;
		
		/* Public members: Not so much of an example of encapsulation, but that's okay. */
		public $Log_Status 	= KLogger::LOG_CLOSED;
		public $DateFormat	= "Y-m-d G:i:s";
		public $MessageQueue;
	
		private $log_file;
		private $priority = KLogger::INFO;
		
		private $file_handle;
		
		public function __construct( $filepath , $priority, $type )
		{
			if ( $priority == KLogger::OFF ) return;
			
			if($type==1)
			{
				$this->log_file = $filepath."log-".get_local_ip()."-".date('Y-m-d-H',time()).'_ui.txt';
			}
			else
			{
				$this->log_file = $filepath."log-".get_local_ip()."-".date('Y-m-d-H',time()).'.txt';
			}
			
			//$this->log_file = $filepath.'16-03-2017.txt';
			$this->MessageQueue = array();
			$this->priority = $priority;
			
			if ( file_exists( $this->log_file ) )
			{
				if ( !is_writable($this->log_file) )
				{
					$this->Log_Status = KLogger::OPEN_FAILED;
					$this->MessageQueue[] = "The file exists, but could not be opened for writing. Check that appropriate permissions have been set.";
					return;
				}
			}
			
			if ( $this->file_handle = fopen( $this->log_file , "a" ) )
			{
				$this->Log_Status = KLogger::LOG_OPEN;
				$this->MessageQueue[] = "The log file was opened successfully.";
			}
			else
			{
				$this->Log_Status = KLogger::OPEN_FAILED;
				$this->MessageQueue[] = "The file could not be opened. Check permissions.";
			}
			
			return;
		}
		
		public function __destruct()
		{
			if ( $this->file_handle )
				fclose( $this->file_handle );
		}
		
		public function LogInfo($line)
		{
			$this->Log( $line , KLogger::INFO );
		}
		
		public function LogDebug($line)
		{
			$this->Log( $line , KLogger::DEBUG );
		}
		
		public function LogWarn($line)
		{
			$this->Log( $line , KLogger::WARN );	
		}
		
		public function LogError($line)
		{
			$this->Log( $line , KLogger::ERROR );		
		}

		public function LogFatal($line)
		{
			$this->Log( $line , KLogger::FATAL );
		}
		
		public function Log($line, $priority)
		{
			if ( $this->priority <= $priority )
			{
				$status = $this->getTimeLine( $priority );
				$this->WriteFreeFormLine ( "$status $line \n" );
			}
		}
		
		public function WriteFreeFormLine( $line )
		{
			if ( $this->Log_Status == KLogger::LOG_OPEN && $this->priority != KLogger::OFF )
			{
			    
			    if (fwrite( $this->file_handle , $line ) === false) {
			        $this->MessageQueue[] = "The file could not be written to. Check that appropriate permissions have been set.";
			    }
				
			}

		}
		
		private function getTimeLine( $level )
		{
			global $currentCompany;
			$time = date( $this->DateFormat );
			$user = "";
			if(isset($_SESSION['user'])){
				$user = $_SESSION['user']['email'];
			}
			switch( $level )
			{
				case KLogger::INFO:
					return "$time\t".get_local_ip()."\t".$currentCompany."\t".$user."\tINFO\t";
				case KLogger::WARN:
					return "$time\t".get_local_ip()."\t".$currentCompany."\t".$user."\tWARN\t";				
				case KLogger::DEBUG:
					return "$time\t".get_local_ip()."\t".$currentCompany."\t".$user."\tDEBUG\t";				
				case KLogger::ERROR:
					return "$time\t".get_local_ip()."\t".$currentCompany."\t".$user."\tERROR\t";
				case KLogger::FATAL:
					return "$time\t".get_local_ip()."\t".$currentCompany."\t".$user."\tFATAL\t";
				default:
					return "$time\t".get_local_ip()."\t".$currentCompany."\t".$user."\tLOG\t";
			}
		}
		
	}


function logger($mod_id,$er_c,$log1,$level,$func="")
{
	global $log;

	/*
		1 = Fatal
		2 = Error
		3 = Warn
		4 = Info
		5 = Debug or Detail
	*/
	if(is_array($er_c))
		$er_c=json_encode($er_c);
	if($func=="")
		$func = get_caller();
	$log1 = get_module($mod_id)."\t".$er_c."\t".$func."\t".json_encode($log1);
	switch ($level) {
		case 1:
			$log->LogFatal($log1);
		break;

		case 2:
			$log->LogError($log1);
		break;

		case 3:
			$log->LogWarn($log1);
		break;

		case 4:
			$log->LogInfo($log1);
		break;

		case 5:
			$log->LogDebug($log1);
		break;
		
		default:
			# code...
			break;
	}
}


function logger_ui($pg_name,$er_c,$log1,$level,$func="")
{
	global $log_ui;
	/*
		1 = Fatal
		2 = Error
		3 = Warn
		4 = Info
		5 = Debug
	*/
	if(is_array($er_c))
		$er_c=json_encode($er_c);
	if($func=="")
		$func = get_caller();
	$log1 = get_module($mod_id)."\t".$er_c."\t".$func."\t".json_encode($log1);
	switch ($level) {
		case 1:
			$log_ui->LogFatal($log1);
		break;

		case 2:
			$log_ui->LogError($log1);
		break;

		case 3:
			$log_ui->LogWarn($log1);
		break;

		case 4:
			$log_ui->LogInfo($log1);
		break;

		case 5:
			$log_ui->LogDebug($log1);
		break;
		
		default:
			# code...
			break;
	}
}


function get_caller(){
    $e = new Exception();
    $trace = $e->getTrace();
    //position 0 would be the line that called this function so we ignore it

    $last_call = isset($trace[2])?$trace[2]:'';

    if(isset($last_call['function']))
    	return $last_call['function'];
    else
    	return "";
}

function get_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
}

function get_local_ip(){
	return getHostByName(getHostName());
}
?>
