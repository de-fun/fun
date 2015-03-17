<?php
  error_reporting(E_ALL);
  date_default_timezone_set('PRC');
  
  /*可在此修改目录名*/
  define('SYSDIR', 'system/');
  define('COFDIR', 'config/');
  define('LIBDIR', 'libraries/');
  define('APPDIR', 'application/');
  define('CTRDIR', 'controllers/');
  define('MOLDIR', 'models/');
  define('VIEWDIR', 'views/');
  
  /*可在此修改后缀*/
  define('CTRSUF', 'Controller');
  define('MOLSUF', 'Model');
  define('VIEWSUF', 'View');
  
  require SYSDIR.COFDIR.'init.php';
  require SYSDIR.COFDIR.'select_controller_method.php';
  
  $CM = controller_method::getInstance();
  
  $fun = new $CM['controller'];
  $fun->$CM['method']();