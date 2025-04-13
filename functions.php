<?php

require_once "Response.php";

function dd($data)
{
    echo var_dump($data);
    die();
}

function abort($status = Response::Not_FOUND)
{
    http_response_code($status);
    include "controllers/$status.php";
    die();
}

function authorize($condition, $status = Response::Not_FOUND)
{
    if (!$condition) {
        abort($status);
    }
}
