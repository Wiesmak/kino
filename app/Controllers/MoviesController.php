<?php declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Movie;

class MoviesController
{
    public static function show(string $id_string): void
    {
        $id = (int)$id_string;
        $movie = new Movie();
        $movie = $movie->read($id);
        require_once APP_ROOT . '/Views/Movies/show.phtml';
    }

    public static function index(): void
    {
        $movies = new Movie();
        $movies = $movies->readAll();
        require_once APP_ROOT . '/Views/Movies/index.phtml';
    }

    public static function create(): void
    {
        $movie = new Movie();
        $movie->create(
            [
                'title' => 'Dzień świra',
                'description' => 'szczanie w pkp',
                'date' => \DateTime::createFromFormat('Y-m-d', '2020-12-12'),
                'hall' => 1
            ]
        );
        //$movie->create($_POST);
        //header('Location: /movies');
    }

    public static function update(): void
    {
        $movie = new Movie();
        $movie->create(
            [
                'id' => 1,
                'title' => 'Dzień świra',
                'description' => 'szczanie w pkp lepsze',
                'date' => \DateTime::createFromFormat('Y-m-d', '2020-12-12'),
                'hall' => 1
            ]
        );
        //$movie->update($_POST);
        //header('Location: /movies');
    }

    public static function destroy($id): void
    {
        $movie = new Movie();
        $movie->read((int)$id);
        $movie->remove();
        //header('Location: /movies');
    }
}