<?php declare(strict_types = 1);

namespace App\Models;

use App\Models\Entity;

class Reservation extends Entity
{
    //region Properties
    protected int $hall;
    protected int $movie;
    protected int $row;
    protected int $column;
    protected int $user;
    //endregion

    //region Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getHall(): int
    {
        return $this->hall;
    }

    public function setHall($hall): void
    {
        $this->hall = $hall;
    }

    public function getMovie(): int
    {
        return $this->movie;
    }

    public function setMovie($movie): void
    {
        $this->movie = $movie;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function setRow($row): void
    {
        $this->row = $row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function setColumn($column): void
    {
        $this->column = $column;
    }

    public function getUser(): int {
        return $this->user;
    }
    public function setUser($user): void {
        $this->user = $user;
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

    public function getUserName(): string
    {
        $user = new User();
        $user = $user->read($this->user);
        return $user->getUsername();
    }

    public function read(int $id): Reservation
    {
        $reservation = $this->find([
            'id' => $id
        ])[0];
        $this->id = $reservation->id;
        $this->hall = $reservation->hall;
        $this->movie = $reservation->movie;
        $this->row = $reservation->row;
        $this->column = $reservation->column;
        $this->user = $reservation->user;
        return $this;
    }

    public function update(int $id, array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        $this->save();
    }

    public function getMovieName(): string
    {
        $movie = new Movie();
        $movie = $movie->read($this->movie);
        return $movie->getTitle();
    }

    public function getMovieDate(): \DateTime
    {
        $movie = new Movie();
        $movie = $movie->read($this->movie);
        return $movie->getDate();
    }

    public function getHallName(): string
    {
        $hall = new Hall();
        $hall = $hall->read($this->hall);
        return $hall->getName();
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
    //endregion
}