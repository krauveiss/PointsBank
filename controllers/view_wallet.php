<?php
Session::checkAuth();
$heading = "View wallet";
require base_path('classes/User.php');
$config = require(base_path('\\config\\database.php'));
$db = new Database($config);
User::setDB($db);

$user = User::findByEmail($_SESSION['user']['email']);
if (!$user) {
    session_destroy();
    header('location: /login');
}

require base_path('classes/Wallet.php');
Wallet::setDB($db);
$wallet = Wallet::viewWallet($_GET['id']);
if ($wallet->user_id != $user->id) {
    abort(403);
}

require base_path('classes/Transaction.php');
Transaction::setDB($db);
$transactions = Transaction::viewAllTransacions($_GET['id']);
require view("wallet");
