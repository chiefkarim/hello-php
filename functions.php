<?php


function dd($data)
{
    echo var_dump($data);
    die();
}

function abort($status = 404)
{
    http_response_code($status);
    include "controllers/$status.php";
    die();
}
