<?php declare(strict_types = 1);

namespace App\Models;

use PDO, PDOException;
use ReflectionClass, ReflectionProperty;

abstract class Entity implements Model
{
    protected string $tableName;
    protected PDO $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    protected int $id = 0;

    public function save()
    {
        $class = new ReflectionClass($this);
        $tableName = strtolower($class->getShortName() . 's');

        $propsToImplode = [];

        foreach ($class->getProperties(ReflectionProperty::IS_PROTECTED) as $property) {
            $propertyName = $property->getName();
            if ($propertyName === 'tableName' || $propertyName === 'db') continue;
            if ($propertyName === 'date') {
                $propsToImplode[] = '`' . $propertyName . '` = "' . $this->{$propertyName}->format('Y-m-d H:i:s') . '"';
                continue;
            }
            $propsToImplode[] = '`' . $propertyName . '` = "' . $this->{$propertyName} . '"';
        }

        $setClause = implode(', ', $propsToImplode);
        $sqlQuery = '';

        if ($this->id > 0) {
            $sqlQuery = 'UPDATE ' . $tableName . ' SET ' . $setClause . ' WHERE id = ' . $this->id;
        } else {
            $sqlQuery = 'INSERT INTO ' . $tableName . ' SET ' . $setClause;
        }

        $result = $this->db->exec($sqlQuery);

        if ($this->db->errorCode()) {
            die($this->db->errorInfo()[2]);
        }

        return $result;
    }

    public function find($options = []): array
    {
        $result = [];
        $query = '';

        $class = new ReflectionClass($this);
        $tableName = strtolower($class->getShortName() . 's');

        $whereClause = '';
        $whereConditions = [];

        if (is_array($options)) {
            if (!empty($options)) {
                foreach ($options as $key => $value) {
                    $whereConditions[] = '`' . $key . '`' . ' = "' . $value . '"';
                }
                $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
            }

            $query = 'SELECT * FROM ' . $tableName . ' ' . $whereClause;
        } elseif (is_string($options)) {
            $query = 'WHERE '.$options;
        } else {
            die('Wrong parameter type of options');
        }

        $raw = $this->db->query($query);
        $raw = $raw->fetchAll(PDO::FETCH_ASSOC);

        if ($this->db->errorCode()) {
            //die($this->db->errorInfo()[2]);
        }

        foreach ($raw as $row) {
            $result[] = self::morph($row);
        }

        return $result;
    }

    public function remove()
    {
        $query = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . $this->id;
        $result = $this->db->exec($query);

        if ($this->db->errorCode()) {
            die($this->db->errorInfo()[2]);
        }

        return $result;
    }

    public static function morph(array $object): Entity
    {
        $class = new ReflectionClass(get_called_class());
        $entity = $class->newInstance();

        foreach ($class->getProperties() as $prop)
        {
            if ($prop->getName() === 'tableName' || $prop->getName() === 'db') continue;
            if ($prop->getName() === 'date') {
                $prop->setValue($entity, new \DateTime($object[$prop->getName()]));
                continue;
            }
            if (isset($object[$prop->getName()])) {
                $prop->setValue($entity,$object[$prop->getName()]);
            }
        }
        //$entity->initialize();
        return $entity;
    }
}