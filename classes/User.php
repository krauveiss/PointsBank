<?php


class User
{
    public $id;
    public $username;
    public $email;
    public $password_hash;
    public $reg_date;
    public $status;
    private static $db;

    public static function setDB(Database $db): void
    {
        self::$db = $db;
    }

    public static function register(string $email, string $username, string $password): ?User
    {
        $user = self::$db->query("INSERT into users (email, username, password) VALUES (:email,:username,:password)", [':email' => $email, ':username' => $username, ':password' => $password])->fetch();
        if (!$user) {
            return null;
        }
        return $user;
    }

    public static function login(string $email, string $password): ?User
    {
        $user = self::$db->query("SELECT * FROM users WHERE email = :email", ['email' => $email])->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return null;
        }
        $user = self::arrayToUser($user);
        if (password_verify($password, $user->password_hash)) {
            return $user;
        }
        return null;
    }

    public static function findByEmail(string $email): ?User
    {
        $user = self::$db->query("SELECT * FROM users where email = :email", ['email' => $email])->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return null;
        }
        return self::arrayToUser($user);
    }

    protected static function arrayToUser(array $arr): ?User
    {
        $user = new User();
        $user->username = $arr['username'];
        $user->id = $arr['id'];
        $user->email = $arr['email'];
        $user->reg_date = $arr['reg_date'];
        $user->status = $arr['status'];
        $user->password_hash = $arr['password'];
        return $user;
    }
}
