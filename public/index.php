<?php
require '../vendor/autoload.php';


use App\libraries\Core;

//check if DEBUG=true show all errors.
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}
//cast url for finding controllers and functions
Core::getInstance();
