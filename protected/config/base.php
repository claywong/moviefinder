<?php
!defined('SYSTEM_NAME') && define('SYSTEM_NAME', 'moviefinder');
!defined('WWW_DIR') && define('WWW_DIR', realpath(__DIR__ . '/../../..'));
!defined('VAR_DIR') && define('VAR_DIR', WWW_DIR . '/../var/' . SYSTEM_NAME);    // 存储程序运行所需数据
!defined('RUNTIME_DIR') && define('RUNTIME_DIR', WWW_DIR . '/runtime/' . SYSTEM_NAME);

$config = [
    'id' => SYSTEM_NAME,
    'basePath' => __DIR__.DIRECTORY_SEPARATOR.'..',
    'name' => SYSTEM_NAME,
    'bootstrap' => ['log'],
    'runtimePath' => constant('RUNTIME_DIR'),
    'modules' => [
        'demo' => [
            'class' => 'app\modules\demo\Module',
        ],
        'crawl' => [
            'class' => 'app\modules\crawl\Module',
        ],
    ],

    // application components
    'components' => [
            
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xC_QA0RvyS33s2_-oEOe1RiRm6iREIK1',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        
        // uncomment the following to use a MySQL database
        /*
        'db' => [
            'connectionString' => 'mysql:host=localhost;dbname=testdrive',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        */
        // uncomment the following to use mq
        /*
        'mq' => [
            'class' => '/pgc/mq/PGMq',
            'host'  => $GLOBALS['mq_service'],
        ],
        */
    ],

    'params' => [
        'innerHost' => 'http://127.0.0.1:8010',
    ],
];

return $config;
