<?php

namespace App\Controllers;

use App\Models\Hall;

class HallsController
{
    public static function index(): void
    {
        $hall = new Hall();
        $halls = $hall->readAll();
        require_once APP_ROOT . '/Views/Halls/index.phtml';
    }

    public static function show(string $id_string): void
    {
        $id = (int)$id_string;
        $hall = new Hall();
        $hall = $hall->read($id);
        $movies = $hall->getMovies();
        require_once APP_ROOT . '/Views/Halls/show.phtml';
    }
}