<?php
function manage_admin_menu($data)
{
	$totalMenus=count_mongo('menus',array());
	
	$menuId=$totalMenus+1;
	$checkMenus=select_mongo("menus",array('order'=>array('$gte'=>intval($data['order']))),array('id','stringId','order'));
	$checkMenus=add_id($checkMenus);
	
	//foreach($checkMenus as $menu){ update_mongo('menus',array('order'=>$menu['order']+1),array('_id'=>new MongoId($menu['id']))); }
	$data['menuId']=$menuId;
	if(!isset($data['parentId'])){ $data['parentId']='0'; }
	//insert_mongo('menus',$data);


	/*insert_mongo('menus',array('mid'=>'1','stringId'=>'resource','order'=>1,'display'=>'true','icon'=>'fa-users'));
	insert_mongo('menus',array('mid'=>'2','stringId'=>'course','order'=>2,'display'=>'true','icon'=>'fa-book'));
	insert_mongo('menus',array('mid'=>'3','stringId'=>'notification','order'=>3,'display'=>'true','icon'=>'fa-bell'));
	insert_mongo('menus',array('mid'=>'5','stringId'=>'job','order'=>5,'display'=>'true','icon'=>'fa-briefcase'));
	insert_mongo('menus',array('mid'=>'6','stringId'=>'forum','order'=>6,'display'=>'true','icon'=>'fa-commenting-o'));
	insert_mongo('menus',array('mid'=>'7','stringId'=>'blog','order'=>7,'display'=>'true','icon'=>'fa-rss'));
	insert_mongo('menus',array('mid'=>'16','stringId'=>'product','order'=>11,'display'=>'true','icon'=>'fa-shopping-cart'));
	insert_mongo('menus',array('mid'=>'22','stringId'=>'attendance','order'=>12,'display'=>'true','icon'=>'fa-calendar-check-o'));

	insert_mongo('menus',array('mid'=>'16','smid'=>'1','stringId'=>'ecommerce','order'=>1,'display'=>'true'));
	insert_mongo('menus',array('mid'=>'16','smid'=>'2','stringId'=>'events_venues','order'=>2,'display'=>'true'));*/
}

function get_admin_menu()
{
	$html='<nav id="menu" data-search="close"><ul>';
	$menuTree=menu_tree();
	$permissions=get_module_and_submodule_id_from_permission();
	$html.=menu_html($menuTree,'',$permissions);
	$html.='</ul></nav>';
	return $html;
}

function get_module_and_submodule_id_from_permission()
{
	//if(!empty($_SESSION['user'])){
	$permission=$_SESSION['user']['permission'];
	$moduleId=array();
	$subModuleId=array();
	$access=array();
	if(!empty($permission)){
		foreach($permission as $key=>$mid){ 
			array_push($moduleId,get_module_by_name($key));
			foreach($mid as $smid=>$v){
				array_push($subModuleId,$smid);
				$access[$smid]=$v;
			}
		}
	}

	return array('mid'=>$moduleId,'smid'=>$subModuleId,'permissions'=>$access);
}

function check_permission($mid,$smid)
{
	$permissions=get_module_and_submodule_id_from_permission();
	$moduleIds=$permissions['mid'];
	if(!in_array($mid, $moduleIds)){ header("location:".site_url()."admin/access_denied"); }
}

function menu_html($menus,$title,$permissions)
{
	global $ui_string;
	$menuHtml='';
	$urlTitle='';
	$mid=$permissions['mid'];
	$smid=$permissions['smid'];
	foreach($menus as $menu)
	{
		$showMenu=true;
		if(sizeof($permissions['permissions'][$menu['smid']])==1 && $permissions['permissions'][$menu['smid']][0]=='assigned' && $menu['permissionExcept']=='assigned'){
			$showMenu=false;
		}

		if($menu['permissionRequired'])
		{
			$showMenu=false;
			if(in_array($menu['permissionRequired'],$permissions['permissions'][$menu['smid']])){
				$showMenu=true;
			}
		}
		if(in_array($menu['mid'],$mid) && (in_array($menu['smid'],$smid) || !isset($menu['smid'])) && $showMenu)
		{
			$menuHtml.="<li>";
			$icon='';
			$attr='';
			if(isset($menu['icon'])){ $icon="<i class='icon fa ".$menu['icon']."'></i> "; }
			if(isset($ui_string[$menu['stringId']])){ $menuTitle=$icon.ucfirst($ui_string[$menu['stringId']]); }
			else{ $menuTitle=$icon.$menu['stringId']; }
			
			$link=array();
			if($title){ array_push($link,$title); }
			if(isset($menu['urlTitle']))
			{
				array_push($link,$menu['urlTitle']);
				$urlTitle=$menu['urlTitle'];
			}
			$link=implode("/",$link);
			if(isset($menu['subMenu']))

			{
				if(sizeof($menu['subMenu'])){ 
					$menuHtml.="<span>".$menuTitle."</span>";
					$menuHtml.="<ul>";
				 		$menuHtml.=menu_html($menu['subMenu'],$urlTitle,$permissions);
				    $menuHtml.="</ul>"; 
				}
			}
				else{

					if(isset($menu['url'])){ $link=$menu['url'];  }
					if(isset($menu['attr'])){ $attr='target="blank"';  }
					$mtitle=$menuTitle;
					if(isset($ui_string[$menuTitle])){  $mtitle=$ui_string[$menuTitle]; }
					$menuHtml.="<a href='".admin_url().$link."' ".$attr.">".ucfirst($mtitle)."</a>";
				}
			$menuHtml.="</li>";
		}
	}
	return $menuHtml;
}

function menu_tree()
{
	global $server_path;
	$cid = get_company_data();
	include_once($server_path."company/$cid[cid]/menu.php");
	return $myTree = buildTree($menus, 0);
}

function buildTree($itemList, $parentId) {
  // return an array of items with parent = $parentId
  $result = array();
  foreach ($itemList as $item) {
    if ($item['parentId'] == $parentId) {
      $newItem = $item;
      $newItem['subMenu'] = buildTree($itemList, $newItem['menuId']);
      if(sizeof($newItem['subMenu'])==0){ unset($newItem['subMenu']); }
      $result[] = $newItem;
    }
  }
  if (count($result) > 0) return $result;
  return null;
}


?>