<?php
class funController
{
	function __construct()
	{
		
	}
	
	//加载libraries里的类
	function _load_class($class)
	{
		return new $class();
	}
	
	//重定向到$uri
	function _redirect($uri)
	{
		$siteUrl = SITE_URL;
		header('Location: '.$siteUrl.$uri);
	}
	
	function fun_post($parameter = array())
	{
		$data = array();
		if(count($parameter)>0)
			foreach($parameter as $key)
				$data[$key] = $_POST[$key];
				
		return $data;
	}
	
	function load_view($view, $data = array())
	{
		//传数据
		if(count($data)>0)
			foreach($data as $funKey=>$funValue)	
				$$funKey = $funValue;
		
		require APPDIR.VIEWDIR.$view.VIEWSUF.'.php';
	}
	
	function load_model($funModel)
	{
		$model = $funModel.MOLSUF;
		require APPDIR.MOLDIR.$funModel.MOLSUF.'.php';
		return new $model();
	} 
}