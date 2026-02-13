<?php

    declare(strict_types=1);

    namespace App\Core;

    use App\Exceptions\AppException;
    use App\Exceptions\NotFoundException;

    class Router
    {
        /**
         * Registered routes grouped by HTTP method
         */
        private array $routes = [];


        /*
        |--------------------------------------------------------------------------
        | Route Registration
        |--------------------------------------------------------------------------
        */

        private function register(string $method, string $uri, $action): self
        {
            $method = strtoupper($method);
            $uri    = $this->normalizeUri($uri);

            $this->routes[$method][$uri] = [
                'action' => $action,
                'regex'  => $this->convertPatternToRegex($uri)
            ];

            return $this;
        }


        public function get(string $uri, $action): self
        {
            return $this->register('GET', $uri, $action);
        }


        public function post(string $uri, $action): self
        {
            return $this->register('POST', $uri, $action);
        }


        public function put(string $uri, $action): self
        {
            return $this->register('PUT', $uri, $action);
        }


        public function patch(string $uri, $action): self
        {
            return $this->register('PATCH', $uri, $action);
        }


        public function delete(string $uri, $action): self
        {
            return $this->register('DELETE', $uri, $action);
        }


        /*
        |--------------------------------------------------------------------------
        | Request Resolving
        |--------------------------------------------------------------------------
        */

        public function resolve(): void
        {
            $uri    = $this->getCurrentUri();
            $method = $this->getCurrentMethod();

            // No routes for this method
            if (!isset($this->routes[$method])) {
                throw new NotFoundException("No routes registered for method ({$method })");
            }

            // Static routes first
            foreach ($this->routes[$method] as $routeUri => $routeData) {
                if ($routeUri === $uri) {
                    $this->dispatch($routeData['action']);
                    return;
                }
            }

            // Dynamic routes
            foreach ($this->routes[$method] as $routeUri => $routeData) {

                if (strpos($routeUri, '{') === false) {
                    continue;
                }

                if (preg_match($routeData['regex'], $uri, $matches)) {

                    array_shift($matches);
                    $this->dispatch($routeData['action'], $matches);
                    return;
                }
            }

            // Nothing matched
            throw new NotFoundException("No route found for ({$method}) ({$uri})");
        }


        /*
        |--------------------------------------------------------------------------
        | URI & Method
        |--------------------------------------------------------------------------
        */

        private function getCurrentUri(): string
        {
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            $uri = parse_url($uri, PHP_URL_PATH);

            // Remove base path
            $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
            $basePath   = dirname($scriptName);

            if ($basePath !== '/' && strpos($uri, $basePath) === 0) {
                $uri = substr($uri, strlen($basePath));
            }

            return $this->normalizeUri($uri);
        }


        private function normalizeUri(string $uri): string
        {
            $uri = trim($uri, '/');
            return $uri === '' ? '/' : $uri;
        }


        private function getCurrentMethod(): string
        {
            $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

            // Method override (PUT, DELETE...)
            if ($method === 'POST' && isset($_POST['_method'])) {
                $override = strtoupper($_POST['_method']);

                if (in_array($override, ['PUT', 'PATCH', 'DELETE'], true)) {
                    return $override;
                }
            }

            return strtoupper($method);
        }


        /*
        |--------------------------------------------------------------------------
        | Route Regex
        |--------------------------------------------------------------------------
        */

        private function convertPatternToRegex(string $pattern): string
        {
            $regex = preg_quote($pattern, '#');

            // {id}
            $regex = preg_replace(
                '/\\\{[a-zA-Z_][a-zA-Z0-9_]*\\\}/',
                '([^/]+)',
                $regex
            );

            // {id:\d+}
            $regex = preg_replace(
                '/\\\{[a-zA-Z_][a-zA-Z0-9_]*:\\\\d\+\\\}/',
                '(\d+)',
                $regex
            );

            // {id:[a-z]+}
            $regex = preg_replace(
                '/\\\{[a-zA-Z_][a-zA-Z0-9_]*:([^}]+)\\\}/',
                '($1)',
                $regex
            );

            // {id?}
            $regex = preg_replace(
                '/\\\{[a-zA-Z_][a-zA-Z0-9_]*\?\\\}/',
                '([^/]*)?',
                $regex
            );

            return '#^' . $regex . '$#';
        }


        /*
        |--------------------------------------------------------------------------
        | Dispatching
        |--------------------------------------------------------------------------
        */

        private function dispatch($action, array $params = []): void
        {
            // Controller@method
            if (is_string($action) && strpos($action, '@') !== false) {

                [$controllerName, $method] = explode('@', $action);
                $controllerClass = "App\\Controllers\\{$controllerName}";


                if (!class_exists($controllerClass)) {
                    throw new NotFoundException("Controller class ({$controllerClass}) not found !");
                }

                $controller = new $controllerClass();

                if (!method_exists($controller, $method)) {
                    throw new NotFoundException("Method ({$method}) not found in controller ({$controllerClass}) !");
                }

                call_user_func_array([$controller, $method], $params);
                return;
            }

            // Closure
            if (is_callable($action)) {
                call_user_func_array($action, $params);
                return;
            }

            throw new AppException("Invalid route action !");
        }


        /*
        |--------------------------------------------------------------------------
        | Debug
        |--------------------------------------------------------------------------
        */

        public function getRoutes(): array
        {
            return $this->routes;
        }
    }