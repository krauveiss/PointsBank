<?php


class Transaction
{
    public $id;
    public $date;
    public $type;
    public $currency;
    public $sender;
    public $destination;
    public $amount;
    public $comment;
    private static $db;

    protected static function arrayToTransaction(array $arr): Transaction
    {
        $transaction = new Transaction();
        $transaction->id = $arr['id'];
        $transaction->date = $arr['date'];
        $transaction->type = $arr['type'];
        $transaction->currency = $arr['currency'];
        $transaction->sender = $arr['sender'];
        $transaction->destination = $arr['destination'];
        $transaction->amount = $arr['amount'];
        $transaction->comment = $arr['comment'];
        return $transaction;
    }


    public static function setDB(Database $db): void
    {

        self::$db = $db;
    }

    public static function viewAllTransacions(int $id): ?array
    {

        $res = self::$db->query("SELECT * FROM transactions WHERE destination =  :id OR sender = :id", [':id' => $id])->fetchAll(PDO::FETCH_ASSOC);
        if (!$res) {
            return null;
        }
        $transactions = array();
        foreach ($res as $item) {
            $transactions[] = self::arrayToTransaction($item);
        }
        return $transactions;
    }

    public static function transferMoney($fromWallet, $toWallet, $amount, $currency, $comment)
    {
        self::$db->query("START TRANSACTION");

        $sender = self::$db->query('SELECT id, balance, currency FROM wallets where id = ? FOR UPDATE', [$fromWallet]);
        $reciver = self::$db->query('SELECT id, balance, currency FROM wallets where id = ? FOR UPDATE', [$toWallet]);

        $senderData = $sender->fetch(PDO::FETCH_ASSOC);
        $receiverData = $reciver->fetch(PDO::FETCH_ASSOC);

        if (!$senderData || !$receiverData) {
            throw new Exception("Wallet not found");
        }
        if ($senderData['currency'] !== $currency || $receiverData['currency'] !== $currency) {
            echo
            throw new Exception("Currency mismatch");
        }
        if ($senderData['balance'] < $amount) {
            throw new Exception("Low balance");
        }
        self::$db->query('UPDATE wallets SET balance = balance - ? where id = ?', [$amount, $fromWallet]);
        self::$db->query('UPDATE wallets SET balance = balance + ? where id = ?', [$amount, $toWallet]);
        self::$db->query(
            "INSERT INTO transactions (type, currency, sender, destination, amount, comment) VALUES (?, ?, ?, ?, ?, ?)",
            ['TRANSFER', $currency, $fromWallet, $toWallet, $amount, $comment]
        );
        self::$db->query("COMMIT");
    }
}
