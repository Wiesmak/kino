<?php declare(strict_types = 1);

namespace App\Models;

use App\Models\Entity;

class Hall extends Entity
{
    //region Properties
    protected int $id;
    protected string $name;
    protected int $rows;
    protected int $columns;
    //endregion

    //region Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function setRows($rows): void
    {
        $this->rows = $rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    public function setColumns($columns): void
    {
        $this->columns = $columns;
    }
    //endregion

    //region CRUD operations
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function read(int $id): Hall
    {
        $hall = $this->find([
            'id' => $id,
        ])[0];
        $this->id = $hall->getId();
        $this->name = $hall->getName();
        $this->rows = $hall->getRows();
        $this->columns = $hall->getColumns();
        return $this;
    }

    public function readAll(): array
    {
        $halls = $this->find();
        $hallsArray = [];
        foreach ($halls as $hall) {
            $hallObject = new Hall();
            $hallObject->id = $hall->getId();
            $hallObject->name = $hall->getName();
            $hallObject->rows = $hall->getRows();
            $hallObject->columns = $hall->getColumns();
            $hallsArray[] = $hallObject;
        }
        return $hallsArray;
    }

    public function getMovies(): array
    {
        $movie = new Movie();
        $movies = $movie->find([
            'hall' => $this->id,
        ]);
        $moviesArray = [];
        foreach ($movies as $movie) {
            $movieObject = new Movie();
            $movieObject->id = $movie->getId();
            $movieObject->setTitle($movie->getTitle());
            $movieObject->setDescription($movie->getDescription());
            $movieObject->setDate($movie->getDate());
            $moviesArray[] = $movieObject;
        }
        return $moviesArray;
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