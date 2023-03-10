<?php declare(strict_types = 1);

namespace Config;

class Router
{
    private static function getURI(): array
    {
        $path_info = $_SERVER['REQUEST_URI'] ?? '/';
        $path_info = substr($path_info, 1);
        return explode('/', $path_info);
    }

    private static function processURI(): array
    {
        $controllerPart = self::getURI()[0] ?? '';
        $methodPart = self::getURI()[1] ?? '';
        $numParts = count(self::getURI());
        $id = null;
        $argsPart = [];
        for ($i = 2; $i < $numParts; $i++) {
            $argsPart[] = self::getURI()[$i];
        }

        $controller = !empty($controllerPart)
            ? '\App\Controllers\\' . ucfirst($controllerPart) . 'Controller'
            : '\App\Controllers\HomeController';

        $method = !empty($methodPart)
            ? $methodPart
            : 'index';

        $args = !empty($argsPart)
            ? $argsPart
            : [];

        return [
            'controller' => $controller,
            'method' => $method,
            'args' => $args
        ];
    }

    public static function contentToRender(): void
    {
        $uri = self::processURI();

        if (class_exists($uri['controller'])) {
            $controller = $uri['controller'];
            $method = $uri['method'];
            $args = $uri['args'];
            // invoke the method with the arguments
            $args ? $controller::{$method}(...$args) : $controller::{$method}();
        }
    }
}