<?php

namespace App\Controllers;

class HomeController
{
    public static function index(): void
    {
        $logged = false;
        if (isset($_SESSION['user_id']))
            $logged = true;
        require_once APP_ROOT . '/Views/Home/index.phtml';
    }
}