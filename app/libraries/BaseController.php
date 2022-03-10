<?php

namespace App\libraries;

abstract class BaseController
{
    public function view($view, $data = [])
    {
        # check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('view does not exist');
        }
    }
}