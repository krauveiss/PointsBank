<?php


class Session
{
    public static function addUser(User $user): void
    {
        $_SESSION['user'] = [
            'email' => $user->email,
            'username' => $user->username
        ];

        $_SESSION['user-agent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['time'] = time();
    }

    public static function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header('location: /login');
            exit();
        }
        if ($_SESSION['user-agent'] !== $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] !== $_SERVER['REMOTE_ADDR']) {
            session_destroy();
            header('location: /login');
        }
        if (time() - $_SESSION['time'] > 1800) {
            session_destroy();
            header('location: /login');
        }
    }

    public static function isAuth(): bool
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
}
