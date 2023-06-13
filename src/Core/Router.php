<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller, $function = 'index')
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'function' => $function,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller, $function = 'index')
    {
        return $this->add('GET', $uri, $controller, $function);
    }

    public function post($uri, $controller, $function)
    {
        return $this->add('POST', $uri, $controller, $function);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        return jsonResponse(['message' => 'Not Found']);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            // if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
            //     return require base_path('Http/controllers/' . $route['controller']);
            // }
            /////

            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                $controllerFilePath = base_path('Http/controllers/' . $route['controller']);
                if (file_exists($controllerFilePath)) {
                    $controllerInstance = require $controllerFilePath;

                    $functionName = $route['function'];

                    if (method_exists($controllerInstance, $functionName)) {
                        return $controllerInstance->$functionName();
                    } else {
                        $this->abort(500);
                    }
                } else {
                    $this->abort(500);
                }
            }
        }

        $this->abort();
    }
}