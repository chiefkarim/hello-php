<?php

namespace Core;

class Session
{
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
    public static function get($key, $default = null)
    {
        return $_SESSION['__flash'][$key] ?? $_SESSION[$key] ?? $default;
    }
    public static function has($key)
    {
        return (bool) $_SESSION[$key];
    }
    public static function flash($key, $val)
    {
        $_SESSION['__flash'][$key] = $val;
    }
    public static function expire()
    {
        unset($_SESSION['__flash']);
    }
    public static function flush()
    {
        session_unset();
    }
    public static function destroy()
    {
        // get session params
        $params = session_get_cookie_params();
        // deelete session data and destroy it
        static::flush();
        session_destroy();
        //remove user cookie
        setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
