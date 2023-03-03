<?php declare(strict_types = 1);

namespace App\Models;

class Hall
{
    protected $id;
    protected $name;
    protected $rows;
    protected $collumns;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param mixed $rows
     */
    public function setRows($rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return mixed
     */
    public function getCollumns()
    {
        return $this->collumns;
    }

    /**
     * @param mixed $collumns
     */
    public function setCollumns($collumns): void
    {
        $this->collumns = $collumns;
    }
}