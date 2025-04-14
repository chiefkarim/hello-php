<?php

require_once base_path("Response.php");

function dd($data)
{
    echo var_dump($data);
    die();
}

function abort($status = Response::Not_FOUND)
{
    http_response_code($status);
    include base_path("controllers/$status.php");
    die();
}

function authorize($condition, $status = Response::Not_FOUND)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $arguments = [])
{
    extract($arguments);

    require base_path('/views/' . $path);
}
