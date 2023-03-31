<?php declare(strict_types = 1);

namespace App\Models;

use App\Models\Entity;
use DateTime;

class Movie extends Entity
{
    //region Properties
    protected string $title;
    protected string $description;
    protected DateTime $date;
    protected int $hall;
    //endregion

    //region Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getHall(): int
    {
        return $this->hall;
    }

    public function setHall($hall): void
    {
        $this->hall = $hall;
    }
    //endregion

    //region CRUD operations
    public function create(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        $this->save();
    }

    public function read(int $id): Movie
    {
        $movie = $this->find([
            'id' => $id
        ])[0];
        $this->id = $movie->id;
        $this->title = $movie->title;
        $this->description = $movie->description;
        $this->date = $movie->date;
        $this->hall = $movie->hall;
        return $this;
    }

    public function readAll(): array
    {
        $movies = $this->find();
        $moviesArray = [];
        foreach ($movies as $movie) {
            $movieObject = new Movie();
            $movieObject->id = $movie->id;
            $movieObject->title = $movie->title;
            $movieObject->description = $movie->description;
            $movieObject->date = $movie->date;
            $movieObject->hall = $movie->hall;
            $moviesArray[] = $movieObject;
        }
        return $moviesArray;
    }

    public function getReservedSeats(): array
    {
        $reservations = new Reservation();
        $reservations = $reservations->find([
            'movie' => $this->id
        ]);
        $reservedSeats = [];
        foreach ($reservations as $reservation) {
            $row = $reservation->getRow();
            $column = $reservation->getColumn();
            $reservedSeats[] = $row . '-' . $column;
        }
        return $reservedSeats;
    }

    public function update(int $id, array $data)
    {
        $this->read($id);
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        $this->save();
    }

    public function delete(int $id)
    {
        $this->read($id);
        $this->remove();
    }
    //endregion
}