<?php declare(strict_types = 1);

namespace App\Models;

class Reservation
{
    protected $id;
    protected $hall;
    protected $movie;
    protected $row;
    protected $collumn;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * @param mixed $hall
     */
    public function setHall($hall): void
    {
        $this->hall = $hall;
    }

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     */
    public function setMovie($movie): void
    {
        $this->movie = $movie;
    }

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $row
     */
    public function setRow($row): void
    {
        $this->row = $row;
    }

    /**
     * @return mixed
     */
    public function getCollumn()
    {
        return $this->collumn;
    }

    /**
     * @param mixed $collumn
     */
    public function setCollumn($collumn): void
    {
        $this->collumn = $collumn;
    }
}