<?php include_once ('../../../../global.php');

function buildArr(array $elements, $parentId = 0)
{
	$branch = array();
	foreach ($elements as $element) 
	{
	    if ($element['parent_id'] == $parentId) 
	    {
	        $children = buildArr($elements, $element['id']);
	        if ($children) 
	        {
	           
	            $element['perform']['params']['perform'] = $children[0]['perform'];
	        }
	         
	        $branch[] = $element;
	    }
	}
	return $branch;
}

print_r(json_decode($_POST['nestable_structure'],true));
print_r($_POST); die;
	  		if(sizeof($_POST)>0){
		  			
	  			
	  				//For post size start.
		  			$postdata=$_POST;
		  			unset($postdata['variablenamearray']);
		  			unset($postdata['variabletypearray']);
		  			unset($postdata['variabledefaultarray']);
	  				$finalpostsize= sizeof($postdata);
	  				//For post size end.
					$variablenames[]=array('type'=>"string","name"=>"temp_return_result", "value"=>"");
					$variablenames[]=array('type'=>"string","name"=>"next_action", "value"=>"");
					$counterno=1;
					$taskCounter=1;
					$nextActionCounter=2;
					
					foreach ($_POST as $key => $value){
					//start
						if(isset($value['setvariablename']) && sizeof($value['setvariablename'])>0){
							if($value['setvariablename'][0]!=""){
							$on_failure=array_combine($value['setvariablename'],$value['variablevalue']);
							$i = 1;
							foreach($on_failure as $failure_name=>$failure_value)
							{
								$erroearray[$i-1]=array('perform'=>array('type'=>$failure_name,'params'=>array('value'=>$failure_value)),'parent_id'=>$i-1,'id'=>$i);
								$i++;
							}
							$on_failure_Final = buildArr($erroearray);
							unset($on_failure_Final[0]['id']);
							unset($on_failure_Final[0]['parent_id']);
						  }
						}	
					//end

						  	$id=explode("-",$key);
						  	if(isset($id['0']) && $id['0']!="" && $id['0']=="tasklist"){ //for task list..
						  		
						  		$taskarray=getTaskListData(array('id'=>$value['tasklist']));
						  		$variableList=$taskarray['data'][0]['variablelist'];
						  		$taskarray=$taskarray['data'][0]['robot'][0]['tasklist'];
						  		$uniqueid=$_SESSION['user']['name']."_".rand();
						  		$submitdata[]['tasklist'][]=array("task_id"=>$taskCounter,"uniqueid"=>$uniqueid,"userId"=>$_SESSION['user']['user_id'],"nm"=>"","actionlist"=>$taskarray);
						  		$taskCounter++;
						  		foreach ($variableList as $key => $variablevalue) {
						  			$variablenames[]=$variablevalue;
						  		}
						  	}
							else if(isset($id['2']) && $id['2']!="")
						  	{
							  	$getdata=get_data_by_table(array("table"=>"configure","id"=>$id['2']));	
							  	$tablerecord=$getdata['data'];
							  	unset($tablerecord[0]['id']);
							  	$tablerecord[0]['action_id']=intval($counterno);
							  	$tablerecord[0]['nm']=$value['comment'];
							  	$tablerecord[0]['on_success']['next']['wait_time']=intval($value['wait']);
							  	
							  	if(isset($value['mode'])){

							  		if(isset($value['xpath_getvalue']) && $value['xpath_getvalue']!="")
								  	{
								  		$value['xpath']=$value['xpath_getvalue'];
								  		unset($value['xpath_getvalue']);
								  	}
								  	if(isset($value['xpath_set_value']) && $value['xpath_set_value']!="")
								  	{
								  		$value['xpath']=$value['xpath_set_value'];	
								  		unset($value['xpath_set_value']);
								  	}
								  	if(isset($value['xpath_click']) && $value['xpath_click']!="")
								  	{
								  		$value['xpath']=$value['xpath_click'];
								  		unset($value['xpath_click']);
								  	}	
							  	}
							  	

							  	if(isset($value['nextAction']) && $value['nextAction']!=""){
							  		$tablerecord[0]['on_success']['next']['next_action']=intval($value['nextAction']);	
							  	}else{
							  		if($finalpostsize==$counterno){
							  			$zero=0;
							  			$tablerecord[0]['on_success']['next']['next_action']=intval($zero);	
							  		}else{
							  			$tablerecord[0]['on_success']['next']['next_action']=intval($nextActionCounter);	
							  		}
							  		
							  		$nextActionCounter++;
							  	}
							  	if(isset($value['returntype']) && $value['returntype']!=""){
							  		$tablerecord[0]['on_success']['return_type']=$value['returntype'];	
							  	}else{
							  		$tablerecord[0]['on_success']['return_type']="none";
							  	}
							  	
							  	if(isset($value['variablename'])){
							  		$tablerecord[0]['on_success']['save'][]=array("var"=>"[var]".$value['variablename']);	
							  	}
							  	
							  	if(isset($on_failure_Final[0])){
							  		$tablerecord[0]['on_failure']['error_handle'][0]['val']['do']=$on_failure_Final[0];	
							  	}
							  	if(isset($value['x_loc'])){
							  		$value['x_loc']=intval($value['x_loc']);
							  	}
							  	if(isset($value['y_loc'])){
							  		$value['y_loc']=intval($value['y_loc']);
							  	}
							  	if(isset($value['row'])){
							  		$value['row']=intval($value['row']);	
							  	}

							  	//unset data not use..
							  	unset($value['comment']);
							  	unset($value['wait']);
							  	unset($value['nextAction']);
							  	unset($value['variablename']);
							  	unset($value['setvariablename']);
							  	unset($value['variablevalue']);
							  	unset($value['returntype']);
							  	
							  	if(isset($value['value']) && $value['value']!=""){
							  		$value['value']="[var]".$value['value'];
							  	}

							  	if(isset($value['command']) && $value['command']!=""){
							  		$value['command']="[var]".$value['command'];
							  		
							  	}

							  	if(isset($value['content']) && $value['content']!=""){
							  		$value['content']="[var]".$value['content'];
							  	}
							  	
							  	
							  	if(isset($value['sumvalue']) && $value['sumvalue']!=""){
							  		
							  		foreach ($value['sumvalue'] as $key => $sumvalue) {
							  			$value['value'][]="[var]".$sumvalue;
							  		}
							  		unset($value['sumvalue']);
							  	}

							  	if(isset($value['filelocation']) && $value['filelocation']!=""){
							  		$value['workbook_name']=$value['filelocation'];
							  	}
							  	$getadddata['data']=array_merge($getdata['data'][0]['data'], $value);
							  	$getfinaldata[]=array_merge($tablerecord[0],$getadddata);

							  	foreach ($getdata['data'][0]['data'] as $key => $formvalue){
										$search="[var]";
										$checkdata="";
										$pos=strripos($formvalue,"[var]");
										if ($pos === false){
											 
										}else{
											
											$variablename= str_replace("[var]","", $formvalue);
											$variablenames[]=array("type"=>"string","name"=>$variablename,"value"=>"");
										}
							  	}
							  	$counterno++;
							}else{

							}
					}

					//variable array..
				  	if(isset($_POST['variablenamearray']) && $_POST['variablenamearray']!=""){
				  		$namevar=explode(",",$_POST['variablenamearray']);
				  		$typevar=explode(",",$_POST['variabletypearray']);
				  		$defvar=explode(",",$_POST['variabledefaultarray']);
				  		for ($variabearr=0; $variabearr < sizeof($namevar); $variabearr++){
								$variablenames[]=array("type"=>$typevar[$variabearr],"name"=>$namevar[$variabearr],"value"=>$defvar[$variabearr]);
				  		}
				  	}
				  	
			  		if(sizeof($getfinaldata)>0){
			  					$title="";
			  					if(isset($_GET['title']) && $_GET['title']!=""){
			  						$title=$_GET['title'];
			  					}
				  			  $final_variablenames=unique_multidim_array($variablenames,'name');
				  			  $uniqueid=$_SESSION['user']['name']."_".rand();
				  			  $submitdata[]['tasklist'][]=array("task_id"=>$taskCounter,"uniqueid"=>$uniqueid,"userId"=>$_SESSION['user']['user_id'],"nm"=>"","actionlist"=>$getfinaldata);
							  $responseAddRobot=add_robot(array("id"=>"0","robot"=>$submitdata,"variablelist"=>$final_variablenames,'title'=>$title,"createdBy"=>$_SESSION['user']['user_id']));
							  //print_r($submitdata); 
							  if($responseAddRobot['success']=="true"){
							  		echo $responseAddRobot['data'];
							  }
							  else{
							  		echo "0";
							  }	
			  		}
			  		else{
						  		echo "0";
					}
			}
			else{
			
				echo "3";
			}
function unique_multidim_array($array, $key) { 
	    $temp_array = array(); 
	    $i = 0; 
	    $key_array = array(); 
	    
	    foreach($array as $val) { 
	        if (!in_array($val[$key], $key_array)) { 
	            $key_array[$i] = $val[$key]; 
	            $temp_array[] = $val; 
	        } 
	        $i++; 
	    } 
	    return $temp_array; 
}
?>