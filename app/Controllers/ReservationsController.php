<?php

namespace App\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Reservation;

class ReservationsController
{
    public static function index(): void
    {
        $reservation = new Reservation();
        $reservations = $reservation->readAll();
        require_once APP_ROOT . '/Views/Reservations/index.phtml';
    }

    public static function show(string $id_string): void
    {
        $id = (int)$id_string;
        $reservation = new Reservation();
        $reservation = $reservation->read($id);
        $user = $reservation->getUserName();
        $movie = $reservation->getMovieName();
        $hall = $reservation->getHallName();
        $date = $reservation->getMovieDate();
        $row = $reservation->getRow();
        $column = $reservation->getColumn();
        require_once APP_ROOT . '/Views/Reservations/show.phtml';
    }

    public static function create(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /users/login');
            exit();
        }
        elseif (!isset($_POST['movie']))
            require_once APP_ROOT . '/Views/Movies/index.phtml';
        elseif (!isset($_POST['seats'])) {
            $movie = new Movie();
            $movie = $movie->find([
                'id' => (int)$_POST['movie']
            ])[0];
            $hall = new Hall();
            $hall = $hall->find([
                'id' => $movie->getHall()
            ])[0];
            $rows = $hall->getRows();
            $columns = $hall->getColumns();
            $reservedSeats = $movie->getReservedSeats();

            require_once APP_ROOT . '/Views/Reservations/create.phtml';
        }
        else {
            $seat = $_POST['seats'];
            // echo '<pre>';
            // print_r($seat);
            // echo '</pre>';
            foreach ($seat as $key => $value) {
                $position = explode('-', $value);
                $row = $position[0];
                $column = $position[1];
                $hall = new Hall();
                $movie = new Movie();
                $movie = $movie->find([
                    'id' => (int)$_POST['movie']
                ])[0];
                $hall = $hall->find([
                    'id' => $movie->getHall()
                ])[0];
                $reservation = new Reservation();
                $reservation->create(
                    [
                        'movie' => $movie->getId(),
                        'hall' => $movie->getHall(),
                        'user' => (int)$_SESSION['user_id'],
                        'row' => (int)$row,
                        'column' => (int)$column
                    ]
                );
                $reservation = $reservation->find([
                    'movie' => (int)$_POST['movie'],
                    'user' => (int)$_SESSION['user_id'],
                    'row' => (int)$row,
                    'column' => (int)$column
                ])[0];
            }
            header('Location: /users/show/' . $_SESSION['user_id']);
            exit();
        }
    }
}