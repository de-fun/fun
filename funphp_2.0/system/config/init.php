<?php
/*
 *��ʼ���ļ�����ų�ʼ���ĺ����볣��
 */

//���URI
$_fun_uri = $_SERVER['REQUEST_URI'];
//�ָ������
$_fun_ch_uri = explode('/',$_fun_uri);

/* ���ָ��Ժ��URI 
foreach($_fun_ch_uri as $key=>$value)
 echo $key.'=>'.$value.'<br/>';
*/

/*���ڴ��޸�BASE_URL·��*/
define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');
define('SITE_URL', BASE_URL.$_fun_ch_uri['1'].'/');


/*�Զ����ض���*/
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