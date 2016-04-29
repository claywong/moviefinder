<?php

$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    [
        'enableCoreCommands' => false,
        'components' => [
            'log' => [
                'flushInterval' => 1,
                'targets' => [
                    'file' => [
                        'exportInterval' => 1,
                    ],
                    'notice' => [
                        'exportInterval' => 1,
                    ],
                    'profile' => [
                        'exportInterval' => 1,
                    ],
                ],
            ],
        ],
    ]
);

unset($config['components']['user'] );
unset($config['components']['log'] );
unset($config['components']['request'] );
//print_r($config);exit;
return $config;
