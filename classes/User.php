<?php


class User
{
    public $id;
    public $username;
    public $email;
    public $password_hash;
    private static $db;

    public static function setDB(Database $db): void
    {
        self::$db = $db;
    }

    public static function register($email, $username, $password)
    {
        $user = self::$db->query("INSERT into users (email, username, password) VALUES (:email,:username,:password)", [':email' => $email, ':username' => $username, ':password' => $password])->fetch();
        return $user;
    }
}
