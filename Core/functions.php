<?php

use Core\Response;
use Core\Session;

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

function controller($path, $arguments)
{
    extract($arguments);
    require base_path('/Http/controllers/' . $path);
}

function login($user)
{
    $_SESSION['user'] = $user;

}

function logout()
{
    Session::destroy();
}

function isUri(string $pathToMatch): bool
{
    return $_SERVER['REQUEST_URI'] === $pathToMatch;
}

function redirect($path)
{
    header("Location: $path");
    exit();
}

function isLoggedIn()
{
    if ($_SESSION['user'] ?? false) {
        return true;
    }
    return false;
}
