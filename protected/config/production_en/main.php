<?php

require(__DIR__ . '/../../../../config/configparser.php');

$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../base.php'),
    []
);

return $config;