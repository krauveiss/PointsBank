<?php

function base_path($path)
{
    return __DIR__ . "\\" . $path;
}

function view($view)
{
    return __DIR__ . "\\views\\" . $view . ".view.php";
}


function abort($code = 404)
{
    http_response_code($code);
    require base_path("views\\errors\\{$code}.php");
    $heading = "oops";
    die();
}
