<?php

namespace Core;

use Core\middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($uri, $method, $controller)
    {

        $this->routes[] = [
        "uri" => $uri,
        "method" => $method,
        "controller" => $controller,
        "middleware" => null,
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, 'GET', $controller);
        return $this;
    }

    public function post($uri, $controller)
    {
        $this->add($uri, 'POST', $controller);
        return $this;
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, 'DELETE', $controller);
        return $this;
    }

    public function update($uri, $controller)
    {
        $this->add($uri, 'UPDATE', $controller);
        return $this;
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, 'PATCH', $controller);
        return $this;
    }

    public function middleware($key)
    {
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri and $route['method'] === strtoupper($method)) {
                // if middleware == auth
                if ($route['middleware']) {
                    Middleware::resolve($route['middleware']);
                }

                //middleware == null
                return include base_path($route['controller']);
            }
        }
        abort(\Core\Response::NOT_FOUND);
    }
}
