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
        $_SESSION = [];
    }
}
