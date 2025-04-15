<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function add($uri, $method, $controller)
    {

        $this->$routes[] = [
        "uri" => $uri,
        "method" => $method,
        "controller" => $controller
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, 'GET', $controller);
    }

    public function post($uri, $controller)
    {
        $this->add($uri, 'POST', $controller);
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, 'DELETE', $controller);
    }

    public function update($uri, $controller)
    {
        $this->add($uri, 'UPDATE', $controller);
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, 'PATCH', $controller);
    }

    public function route($uri, $method)
    {
        foreach ($this->$routes as $route) {
            if ($route['uri'] === $uri and $route['method'] === strtoupper($method)) {
                return include base_path($route['controller']);
            }
        }

        abort(\Core\Response::NOT_FOUND);
    }
}
