<?php
class controller_method
{
	private $controller;
	//设定默认方法
	private $method = 'index';
	
	//数组形式URI
	private $fun_ch_uri;
	
	private function __construct()
	{
		global $_fun_ch_uri;
		$this->fun_ch_uri = $_fun_ch_uri;
		//设定默认控制器
		$this->controller = 'index'.CTRSUF; 
		
		//提取出其中的控制器和方法
		if($this->fun_ch_uri['2'] != '')
		{
			$this->controller = $this->fun_ch_uri['2'].CTRSUF;
			if(isset($this->fun_ch_uri['3']) && $this->fun_ch_uri['3'])
				$this->method = $this->fun_ch_uri['3'];
		}
	}
	
	static function getInstance()
	{
		$obj = new controller_method();
		$data['controller'] = $obj->controller;
		$data['method'] = $obj->method;
		return $data;
	}
	
}




