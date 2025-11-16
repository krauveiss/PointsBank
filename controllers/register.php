<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    require view("register");
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require base_path('classes/User.php');
    $config = require(base_path('\\config\\database.php'));
    $db = new Database($config);
    User::setDB($db);
    try {
        User::register($_POST['email'], $_POST['username'], password_hash($_POST['password'], PASSWORD_BCRYPT));
    } catch (Exception $e) {
        abort(500);
    }
}
