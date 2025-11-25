<?php

$router->get('/', 'controllers/home.php');
$router->get('/login', 'controllers/login.php');
$router->post('/login', 'controllers/login.php');
$router->get('/logout', 'controllers/logout.php');

$router->get('/register', 'controllers/register.php');
$router->post('/register', 'controllers/register.php');

$router->get('/dashboard', 'controllers/dashboard.php');
$router->get('/profile', 'controllers/profile.php');
$router->post('/new_wallet', 'controllers/new_wallet.php');
