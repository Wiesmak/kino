<?php

namespace App\Controllers;

class HomeController
{
    public static function index(): void
    {
        require_once APP_ROOT . '/Views/Home/index.phtml';
    }
}