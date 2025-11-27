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
Wallet::openWallet($user->id, $_POST['currency']);
