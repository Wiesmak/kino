<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public static function create(): void
    {
        if (!isset($_POST['username']) || !isset($_POST['password']))
            require_once APP_ROOT . '/Views/Users/register.phtml';
        else {
            $user = new User();
            $matching = $user->find(['username' => $_POST['username']]);
            if (!empty($matching)) {
                $flash = 'Użytkownik o takiej nazwie już istnieje';
                require_once APP_ROOT . '/Views/Users/register.phtml';
                return;
            }
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->create(
                [
                    'username' => $_POST['username'],
                    'password' => $passwordHash
                ]
            );
            $user = $user->find(['username' => $_POST['username']])[0];
            $_SESSION['user_id'] = $user->getId();
            self::show($user->getId());
        }
    }

    public static function register(): void
    {
        require_once APP_ROOT . '/Views/Users/register.phtml';
    }

    public static function login(): void
    {
        if(isset($_SESSION['user_id']))
            self::show($_SESSION['user_id']);
        if (!isset($_POST['username']) || !isset($_POST['password']))
            require_once APP_ROOT . '/Views/Users/login.phtml';
        else {
            $user = new User();
            $matching = $user->find(['username' => $_POST['username']]);
            if (empty($matching)) {
                $flash = 'Nie ma takiego użytkownika';
                require_once APP_ROOT . '/Views/Users/login.phtml';
                return;
            }
            $user = $matching[0];
            if (password_verify($_POST['password'], $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                self::show($user->getId());
            } else {
                $flash = 'Niepoprawne hasło';
                require_once APP_ROOT . '/Views/Users/login.phtml';
            }
        }
    }

    public static function show(string $idString): void
    {
        $id = (int)$idString;
        $user = new User();
        $user = $user->read($id);
        $reservations = $user->getReservations();
        require_once APP_ROOT . '/Views/Users/show.phtml';
    }

    public static function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit();
    }
}