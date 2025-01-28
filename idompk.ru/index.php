<?php

if (in_array(get_ip(), [ '85.21.233.34']))
            exit();

//file_put_contents('log.html', get_ip().' '.$_SERVER['HTTP_USER_AGENT'].' '. $_SERVER['REQUEST_URI'] ."<br><br><br>\n", FILE_APPEND);



  error_reporting(0);

  $_SERVER['REQUEST_URI'] = mb_strtolower($_SERVER['REQUEST_URI']);
  //$_SERVER['HTTPS'] = 0; // Убрать в проде
// comment out the following two lines when deployed to production
//  defined('YII_DEBUG') or define('YII_DEBUG', true);
//  defined('YII_ENV') or define('YII_ENV', 'dev');

  require(__DIR__ . '/../_idompk.ru/vendor/autoload.php');
  require(__DIR__ . '/../_idompk.ru/vendor/yiisoft/yii2/Yii.php');

  $config = require(__DIR__ . '/../_idompk.ru/config/web.php');

  (new yii\web\Application($config))->run();
  
  
  function get_ip()
{
	$value = '';
	
	if (!empty($_SERVER['REMOTE_ADDR'])) {
		return $value = $_SERVER['REMOTE_ADDR'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}  
  
}