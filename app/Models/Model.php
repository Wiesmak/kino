<?php declare(strict_types = 1);

namespace App\Models;

interface Model
{
    public function getId(): int;
    // crud
    public function create(array $data);
    public function read(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}