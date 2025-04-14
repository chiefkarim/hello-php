<?php


function dd($data)
{
    echo var_dump($data);
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

function abort($status = Response::Not_FOUND)
{
    http_response_code($status);
    view("$status.php");
    die();
}
