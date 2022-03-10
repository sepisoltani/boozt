<?php
//DB Params
define('DB_HOST', 'db');
define('DB_USER', 'root');
define('DB_PASS', 'password');
define('DB_NAME', 'boozt');
define('DB_PORT', 3306);
//App Root
define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
//site name
define('SITENAME', 'Boozt - Sepehr Soltani');
define('DEBUG', true);
