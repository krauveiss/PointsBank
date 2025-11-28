<?php
Session::checkAuth();

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

if ($_POST['amount'] <= 0) {
    die("wrong amount");
}

Transaction::transferMoney($wallet->id, $_POST['destination'], $_POST['amount'], $wallet->currency, $_POST['comment']);
header('location: /wallet/?id=' . $wallet->id);
