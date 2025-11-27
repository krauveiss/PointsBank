<?php
class Wallet
{
    public $id;
    public $user_id;
    public $balance;
    public $currency;
    public $status;
    private static $db;

    public static function setDB(Database $db): void
    {

        self::$db = $db;
    }


    public static function openWallet($user_id, $currency): void
    {
        $res = self::$db->query("INSERT INTO wallets (user_id,balance,currency) VALUES (:user_id,0,:currency)", [':user_id' => $user_id, ':currency' => $currency])->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            die("error");
        }
    }


    protected static function arrayToWallet(array $arr): ?Wallet
    {
        $wallet = new Wallet();
        $wallet->id = $arr['id'];
        $wallet->user_id = $arr['user_id'];
        $wallet->balance = $arr['balance'];
        $wallet->currency = $arr['currency'];
        $wallet->status = $arr['status'];
        return $wallet;
    }

    public static function showAllWallets($user_id): ?array
    {
        $res = self::$db->query("SELECT * FROM wallets WHERE user_id =  :user_id", [':user_id' => $user_id])->fetchAll(PDO::FETCH_ASSOC);
        if (!$res) {
            die("error");
        }
        $wallets = array();
        foreach ($res as $item) {
            $wallets[] = self::arrayToWallet($item);
        }
        return $wallets;
    }
}
