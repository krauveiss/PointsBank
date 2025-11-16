<?php

class Router
{
    private $routes = [];

    private function add($method, $path, $controller)
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($path, $controller)
    {
        $this->add('GET', $path, $controller);
    }

    public function post($path, $controller)
    {
        $this->add('POST', $path, $controller);
    }

    public function put($path, $controller)
    {
        $this->add('PUT', $path, $controller);
    }

    public function patch($path, $controller)
    {
        $this->add('PATCH', $path, $controller);
    }

    public function delete($path, $controller)
    {
        $this->add('DELETE', $path, $controller);
    }

    public function route($path, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['path'] == $path) {
                return require(base_path($route['controller']));
            }
        }
        die("404");
    }
}
