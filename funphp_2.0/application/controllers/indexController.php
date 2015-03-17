<?php
require SYSDIR.'funController.php';
class indexController extends funController
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$result['title'] = 'Welcome to funphp';
		$result['content'] = 'Funphp is a simple php MVC framework for fun';
		
		$this->load_view('index',$result);
	}
}