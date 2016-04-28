<?php
mb_internal_encoding("UTF-8");

define('IDC_NUM', 1); // 机房数
define('IDC_ID', 0); // idc数字编号，编号从0开始
define('APPLICATION_ENV', 'testing');
// define('YII_TRACE_LEVEL', 3);

// 再次check设置
if (! defined('IDC_NUM') || ! defined('IDC_ID')) {
    header('Server Error', true, 500); // 否则直接返回错误
    exit(1);
}

