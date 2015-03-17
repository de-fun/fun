<?php
  error_reporting(E_ALL);
  date_default_timezone_set('PRC');
  
  /*���ڴ��޸�Ŀ¼��*/
  define('SYSDIR', 'system/');
  define('COFDIR', 'config/');
  define('LIBDIR', 'libraries/');
  define('APPDIR', 'application/');
  define('CTRDIR', 'controllers/');
  define('MOLDIR', 'models/');
  define('VIEWDIR', 'views/');
  
  /*���ڴ��޸ĺ�׺*/
  define('CTRSUF', 'Controller');
  define('MOLSUF', 'Model');
  define('VIEWSUF', 'View');
  
  require SYSDIR.COFDIR.'init.php';
  require SYSDIR.COFDIR.'select_controller_method.php';
  
  $CM = controller_method::getInstance();
  
  $fun = new $CM['controller'];
  $fun->$CM['method']();