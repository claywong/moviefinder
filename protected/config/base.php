<?php
!defined('SYSTEM_NAME') && define('SYSTEM_NAME', 'template');
!defined('WWW_DIR') && define('WWW_DIR', realpath(__DIR__ . '/../../..'));
!defined('VENDOR_DIR') && define('VENDOR_DIR', WWW_DIR . '/vendor');
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
            'class' => app\modules\demo\DemoModule::className(),
        ],
    ],

    // application components
    'components' => [
        'user' => [
            'class' => \pgc\web\User::className(),
            'identityClass' => \pgc\web\UserIdentity::className(),
            'enableSession' => false,
            'ssoConfig' => 'ssoUser', 
            'appname' => SYSTEM_NAME,
            'cache' => 'cache.login',
            'cacheExpire' => 86400,
        ],
        // uncomment the following to enable URLs in path-format
        'urlManager' => [
            'class' => \pgc\web\UrlManager::className(),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'log' => [
            'targets' => [
                'file' => [
                    'class' => \pgc\log\FileTarget::className(),
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/application.log',
                    'enableRotation' => false,
                    'logVars' => [],
                ],
                'notice' => [
                    'class' => \pgc\log\FileTarget::className(),
                    'levels' => ['notice', 'trace', 'info'],
                    'logFile' => '@runtime/notice.log',
                    'enableRotation' => false,
                    'logVars' => [],
                ],
                'profile' => [
                    'class' => \pgc\log\FileTarget::className(),
                    'levels' => ['profile'],
                    'logFile' => '@runtime/profile.log',
                    'enableRotation' => false,
                    'logVars' => [],
                ],
            ],
        ],
        'mongo' => [
            'class' => \pgc\db\MongoConnection::className(),
            'server' => 'mongodb://127.0.0.1:27017',
            'options' => [
                'connect' => false,
                'readPreference' => \MongoClient::RP_PRIMARY,//RP_SECONDARY_PREFERRED,//MongoClient::RP_PRIMARY,RP_NEAREST
                'connectTimeoutMS' => 1000,
            ],
        ],
        'cache.login'=>[
            'class' => \pgc\caching\PGRedis::className(),
            'cacheInUse' => true,
            'profilePrefix' => 'c.l',
            'servers' => [
                ['host' => '127.0.0.1', 'port' => 6379],
            ],
            'keyPrefix' => '',
            'hashKey' => false,
            'usePersistent' => false,
            'balancePolicy' => \pgc\caching\PGRedis::BALANCE_POLICY_RANDOM,
            'options' => array(
                \Redis::OPT_SERIALIZER => \Redis::SERIALIZER_PHP,
            )
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
        'ssoUser' => [
            'host'      => 'https://i.camera360.com',
            'appkey'    => 'fd8463e40988de06', // change to your appkey
            'appsecret' => '825b682ffd8463e40988de0695328954', // change to your appsecret
        ],
    ],
];

return $config;
