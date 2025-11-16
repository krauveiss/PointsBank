<?php

function base_path($path)
{
    return __DIR__ . "\\" . $path;
}

function view($view)
{
    return __DIR__ . "\\views\\" . $view . ".view.php";
}
