<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require base_path('classes/User.php');
    $config = require(base_path('\\config\\database.php'));
    $db = new Database($config);
    User::setDB($db);
    $user = User::login($_POST['email'], $_POST['password']);
    if (!$user) {
        die("No user with this credits");
    }
    Session::addUser($user);
    header('location: /dashboard');
    session_regenerate_id(true);
}
$heading = "Login";
require view("login");
