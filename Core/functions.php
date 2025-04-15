<?php

use Core\Response;

function dd($data)
{
    echo var_dump($data);
    die();
}


function authorize($condition, $status = Response::NOT_AUTHORIZED)
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
