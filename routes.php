<?php

$router->get('/', 'controllers/home.php');
$router->get('/login', 'controllers/login.php');
$router->get('/register', 'controllers/register.php');
$router->post('/register', 'controllers/register.php');
