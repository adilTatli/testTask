<?php
declare(strict_types = 1);

namespace App\Helpers;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    /**
     * Adds a route to the router.
     *
     * @param $url
     * @param $controller
     * @param $middleware
     * @return void
     */
    public function addRoute($url, $controller, $middleware = [])
    {
        $this->routes[$url] = [
            'controller' => $controller,
            'middleware' => $middleware,
        ];
    }

    /**
     * Routes a URL to the corresponding controller,
     * applying middleware if specified.
     *
     * @param $url
     * @return void
     */
    public function route($url)
    {
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'];

        if (array_key_exists($path, $this->routes)) {
            $route = $this->routes[$path];
            $controller = $route['controller'];
            list($controllerName, $methodName) = explode('@', $controller);

            if (!empty($route['middleware'])) {
                foreach ($route['middleware'] as $middlewareClass) {
                    $middleware = new $middlewareClass();
                    $middleware->handle();
                }
            }

            $controllerInstance = new $controllerName();
            $controllerInstance->$methodName();
        } else {
            header('HTTP/1.0 404 Not Found');
        }
    }
}