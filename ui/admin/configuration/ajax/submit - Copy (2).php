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
function get_on_failure($value){

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
	return $on_failure_Final;
}

function makeNestableListUsingJSONArray($jsonArray)
{
	for ( $i = 0; $i < sizeof($jsonArray); $i++) {
				echo $jsonArray[$i]['id'];
			if ( is_array($jsonArray[$i]['children'])) {
	        makeNestableListUsingJSONArray($jsonArray[$i]['children']);
	      }
	}
}
$get_sequence_index=json_decode($_POST['nestable_structure'],true);
makeNestableListUsingJSONArray($get_sequence_index);
die;
if(sizeof($_POST)>0){
		  			
		$get_sequence_index="";	  			
		if(isset($_POST['nestable_structure']) && $_POST['nestable_structure']!=""){

			$get_sequence_index=json_decode($_POST['nestable_structure'],true);
		}

		$postdata=$_POST;
		unset($postdata['variablenamearray']);
		unset($postdata['variabletypearray']);
		unset($postdata['variabledefaultarray']);
		unset($postdata['nestable_structure']);
		$finalpostsize= sizeof($postdata);

		//For post size end.
		$variablenames[]=array('type'=>"string","name"=>"temp_return_result", "value"=>"");
		$variablenames[]=array('type'=>"string","name"=>"next_action", "value"=>"");
		
		$counterno=1;
		$taskCounter=1;
		$nextActionCounter=2;
		//print_r($_POST);

		foreach ($get_sequence_index as $seq_key) {
					$sq_key=$seq_key['id'];
					$get_form_value=$_POST[$sq_key];

					$id=explode("-",$sq_key); 
					if(isset($id['0']) && $id['0']!="" && $id['0']=="tasklist"){ 
						
						foreach ($get_form_value as $keys => $taskvalue){
							
							$uniqueid=$_SESSION['user']['name']."_".rand();
							if(!empty($getfinaldata)){
								$tasklistArray['tasklist'][]=array("task_id"=>$taskCounter,"uniqueid"=>$uniqueid,"userId"=>$_SESSION['user']['user_id'],"nm"=>"","actionlist"=>$getfinaldata);
								$counterno=1;
								$taskCounter=1;
								$nextActionCounter=2;
								unset($getfinaldata);
							}
							//for task list..
								$taskarray=getTaskListData(array('id'=>$taskvalue));
								$variableList=$taskarray['data'][0]['variablelist'];
								$taskarray=$taskarray['data'][0]['robot'][0]['tasklist'];
								
								$tasklistArray['tasklist'][]=$taskarray;
								//$taskCounter++;
								foreach ($variableList as $key => $variablevalue){
									$variablenames[]=$variablevalue;
								}
						}
					}
					else if(isset($id['1']) && $id['1']!="")
				  	{
					  	$getdata=get_data_by_table(array("table"=>"configure","id"=>$id['1']));	
					  	$tablerecord=$getdata['data'];
					  	unset($tablerecord[0]['id']);
					  	$tablerecord[0]['action_id']=intval($counterno);
					  	$tablerecord[0]['on_success']['next']['next_action']="";
						foreach ($get_form_value as $value){
							if(isset($value['setvariablename']) && sizeof($value['setvariablename'])>0){
								if($value['setvariablename'][0]!=""){
									$on_failure_Final=get_on_failure($value);
								}
							}
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

						  	if(isset($value['comment'])){
						  		unset($value['comment']);	
						  	}
						  	if(isset($value['wait'])){
						  		unset($value['wait']);	
						  	}
						  	if(isset($value['nextAction'])){
						  		unset($value['nextAction']);	
						  	}
						  	if(isset($value['variablename'])){
						  		unset($value['variablename']);	
						  	}
						  	if(isset($value['setvariablename'])){
						  		unset($value['setvariablename']);	
						  	}
						  	if(isset($value['variablevalue'])){
						  		unset($value['variablevalue']);	
						  	}
						  	if(isset($value['returntype'])){
						  		unset($value['returntype']);	
						  	}

						  	if(isset($value['value']) && $value['value']!=""){
						  		$value['value']="[var]".$value['value'];
						  	}if(isset($value['command']) && $value['command']!=""){
						  		$value['command']="[var]".$value['command'];
						  		
						  	}if(isset($value['content']) && $value['content']!=""){
						  		$value['content']="[var]".$value['content'];
						  	}if(isset($value['sumvalue']) && $value['sumvalue']!=""){
						  		foreach ($value['sumvalue'] as $key => $sumvalue) {
						  			$value['value'][]="[var]".$sumvalue;
						  		}
						  		unset($value['sumvalue']);
						  	}if(isset($value['filelocation']) && $value['filelocation']!=""){
						  		$value['workbook_name']=$value['filelocation'];
						  	}

						  	if(isset($value['nextAction']) && $value['nextAction']!=""){
						  		$tablerecord[0]['on_success']['next']['next_action']=intval($value['nextAction']);	
						  	}
						}
							if($tablerecord[0]['on_success']['next']['next_action']=="")
						  	{
						  		if($finalpostsize==$counterno){
						  			$zero=0;
						  			$tablerecord[0]['on_success']['next']['next_action']=intval($zero);	
						  		}else{
						  			$tablerecord[0]['on_success']['next']['next_action']=intval($nextActionCounter);	
						  		}
						  		$nextActionCounter++;
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

				  print_r($getfinaldata); die;
			  		if(sizeof($getfinaldata)>0 || sizeof($tasklistArray)>0){
			  					$title="";
			  					if(isset($_GET['title']) && $_GET['title']!=""){
			  						$title=$_GET['title'];
			  					}
				  			  $final_variablenames=unique_multidim_array($variablenames,'name');
				  			  $uniqueid=$_SESSION['user']['name']."_".rand();
				  			  if(sizeof($getfinaldata)>0){
				  			  		$tasklistArray['tasklist'][]=array("task_id"=>$taskCounter,"uniqueid"=>$uniqueid,"userId"=>$_SESSION['user']['user_id'],"nm"=>"","actionlist"=>$getfinaldata);
				  			  }
				  			  $submitdata[]=$tasklistArray;
							  $responseAddRobot=add_robot(array("id"=>"0","robot"=>$submitdata,"variablelist"=>$final_variablenames,'title'=>$title,"createdBy"=>$_SESSION['user']['user_id'],'nestable_structure'=>$_POST['nestable_structure']));
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