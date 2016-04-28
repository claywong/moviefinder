<?php
!defined('SYSTEM_NAME') && define('SYSTEM_NAME', 'moviefinder');
!defined('WWW_DIR') && define('WWW_DIR', realpath(__DIR__ . '/../../..'));
!defined('VENDOR_DIR') && define('VENDOR_DIR', WWW_DIR . '/vendor');
!defined('VAR_DIR') && define('VAR_DIR', WWW_DIR . '/../var/' . SYSTEM_NAME);    // 存储程序运行所需数据
!defined('RUNTIME_DIR') && define('RUNTIME_DIR', WWW_DIR . '/runtime/' . SYSTEM_NAME);
$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'demo' => [
            'class' => 'app\modules\demo\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PmWWetDRSFOKjQo5IR9QCpv7mYRh2Y5Q',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],

    'params' => [
    ],
];
return $config;
