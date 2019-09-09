<?php
function get_language()
{
	if(isset($_SESSION['engine-language']))
		return $_SESSION['engine-language'];
	else
		return "en";
	
}

function set_language($lang)
{
	$_SESSION['engine-language'] = $lang;
}

$error_string=array();
$ui_string=array();


$dir    = $server_path.'lang';

if(is_dir($dir)){

$lang_list = scandir($dir);

foreach ($lang_list as $key => $val) {
	if($val=="."||$val=="..")
		continue;
	if(strpos($val,".")===false)
	{
		$lang_list1 = scandir($dir."/".$val);
		foreach ($lang_list1 as $key1 => $val1) {
			if($val1=="."||$val1=="..")
				continue;
			if(@end(explode(".",$val1))=="json")
			{
				add_lang_code($dir."/".$val."/".$val1);
			}
		}
	}
	else
	{

	}
	if(@end(explode(".",$val))=="json")
	{
		add_lang_code($dir."/".$val);
	}
}
}


$dir    = $server_path.'lang_ui';
if(is_dir($dir)){
$lang_list = scandir($dir);
foreach ($lang_list as $key => $val) {
	if($val=="."||$val=="..")
		continue;
	if(strpos($val,".")===false)
	{
		$lang_list1 = scandir($dir."/".$val);
		foreach ($lang_list1 as $key1 => $val1) {
			if($val1=="."||$val1=="..")
				continue;
			if(@end(explode(".",$val1))=="json")
			{
				add_lang_code_ui($dir."/".$val."/".$val1);
			}
		}
	}
	else
	{

	}
	if(@end(explode(".",$val))=="json")
	{
		add_lang_code_ui($dir."/".$val);
	}
}
}

function add_lang_code($file)
{
	global $error_string,$ui_string;
	if(file_exists($file)&&(@end(explode("_",$file))==get_language().".json"))
	{
		$tmp = json_decode(file_get_contents($file));
		if($tmp!="")
		{
			foreach ($tmp as $key => $val) {
				$error_string[$key]=$val;
				$ui_string[$key]=$val;
			}
		}
	}
}


function add_lang_code_ui($file)
{
	global $ui_string;
	if(file_exists($file)&&(@end(explode("_",$file))==get_language().".json"))
	{
		$tmp = json_decode(file_get_contents($file));
		if($tmp!="")
		{
			foreach ($tmp as $key => $val) {
				$ui_string[$key]=$val;
			}
		}
	}
}
$dir    = $server_path.'langController';
$lang_list = scandir($dir);
foreach ($lang_list as $key => $val) {
	if($val=="."||$val=="..")
		continue;
	if(strpos($val,".")===false)
	{
		$lang_list1 = scandir($dir."/".$val);
		foreach ($lang_list1 as $key1 => $val1) {
			if($val1=="."||$val1=="..")
				continue;
			if(@end(explode(".",$val1))=="json")
			{
				add_lang_DataTable($dir."/".$val."/".$val1);
			}
		}
	}
	else
	{

	}
	if(@end(explode(".",$val))=="json")
	{
		add_lang_code_ui($dir."/".$val);
	}
}

function add_lang_DataTable($file)
{
	global $error_string,$ui_string;
	if(file_exists($file)&&(@end(explode("_",$file))==get_language().".json"))
	{
		$tmp = json_decode(file_get_contents($file));
		if($tmp!="")
		{
			foreach ($tmp as $key => $val) {
				$error_string[$key]=$val;
				$ui_string[$key]=$val;
			}
		}
	}
}
?>