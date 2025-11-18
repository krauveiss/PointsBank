<?php

$router->get('/', 'controllers/home.php');
$router->get('/login', 'controllers/login.php');
$router->post('/login', 'controllers/login.php');
$router->get('/register', 'controllers/register.php');
$router->get('/dashboard', 'controllers/dashboard.php');
$router->get('/profile', 'controllers/profile.php');
$router->post('/register', 'controllers/register.php');
