<?php
//комментируем, если хотим подавить вывод ошибок (например ошибок парсинга php)
//error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE);

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

date_default_timezone_set("Europe/Moscow");

define('YII_ENABLE_ERROR_HANDLER',true);
define('YII_ENABLE_EXCEPTION_HANDLER',true);

// remove the following lines when in production mode
 defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
 defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();