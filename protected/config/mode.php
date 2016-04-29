<?php
mb_internal_encoding("UTF-8");
$hostname = gethostname();

if ($hostname == 'newdev') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    define('APPLICATION_ENV', 'newdev');
    define('YII_DEBUG', true);
    
} else {
    define('APPLICATION_ENV', 'production');
}



