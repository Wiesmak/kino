<?php

namespace App\Models;

class User extends Entity
{
    protected string $username;
    protected string $password;

    //region Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
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

    public function read(int $id): User
    {
        $user = $this->find([
            'id' => $id
        ])[0];
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->password = $user->getPassword();
        return $this;
    }

    public function getReservations(): array
    {
        $reservation = new Reservation();
        return $reservation->find([
            'user' => $this->id
        ]);
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