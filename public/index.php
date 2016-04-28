<?php


defined('YII_DEBUG') or define('YII_DEBUG', true);

ini_set('display_errors', 1);
error_reporting(E_ALL);

require(__DIR__ . '/../protected/config/mode.php');
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../protected/config/' . strtolower(APPLICATION_ENV) . '/main.php');
(new yii\web\Application($config))->run(); 

