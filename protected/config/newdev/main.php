<?php
$mongoServer = 'mongodb://127.0.0.1:27017';
$cacheServer = [
    ['host' => '127.0.0.1', 'port' => 6379],
];

$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../base.php'),
    [
        'params' => [
            'ssoUser' => [
                'appkey'    => 'fd8463e40988de06', // change to your appkey
                'appsecret' => '825b682ffd8463e40988de0695328954', // change to your appsecret
            ],
        ],
    ]
);

return $config;