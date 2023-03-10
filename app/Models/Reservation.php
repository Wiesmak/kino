<?php declare(strict_types = 1);

namespace App\Models;

use App\Models\Entity;

class Reservation extends Entity
{
    //region Properties
    protected int $id;
    protected string $hall;
    protected string $movie;
    protected int $row;
    protected int $column;
    //endregion

    //region Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getHall(): string
    {
        return $this->hall;
    }

    public function setHall($hall): void
    {
        $this->hall = $hall;
    }

    public function getMovie(): string
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
    //endregion

    //region CRUD operations
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function read(int $id)
    {
        // TODO: Implement read() method.
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
    //endregion
}