<?php
/*
 *初始化文件，存放初始化的函数与常量
 */

//获得URI
$_fun_uri = $_SERVER['REQUEST_URI'];
//分割成数组
$_fun_ch_uri = explode('/',$_fun_uri);

/* 检测分割以后的URI 
foreach($_fun_ch_uri as $key=>$value)
 echo $key.'=>'.$value.'<br/>';
*/

/*可在此修改BASE_URL路径*/
define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');
define('SITE_URL', BASE_URL.$_fun_ch_uri['1'].'/');


/*自动加载对象*/
function __autoload($class)
{
	$controllerFile = APPDIR.CTRDIR.$class.'.php';
	$librariesFile = SYSDIR.LIBDIR.$class.'.php';
	
	foreach(array($controllerFile, $librariesFile) as $file)
	{	
		if(file_exists($file))
		{
			require $file;
			return;
		}
	}
}