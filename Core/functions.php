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
    // get session params
    $params = session_get_cookie_params();
    // deelete session data and destroy it
    session_unset();
    session_destroy();
    //remove user cookie
    setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
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
