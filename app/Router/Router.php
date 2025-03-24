<?php 

include_once "Route.php";

final readonly class Router
{
    /** @param Route[] $routes */
    public function __construct(
        private readonly array $routes
    ) {
    }

    public function resolve(string $url, string $method): void
    {
        $route = $this->filterRoute($url, $method);

        if (empty($route)) {
            throw new Exception('Invalid route');
        }

        require $_SERVER["DOCUMENT_ROOT"].'/src/Controller/'.$route->controller();

        $parameters = $this->getParameters($route, $url);

        $controller = new ($route->className())();
        $controller->start(...$parameters);
    }

    private function filterRoute(string $url, string $method): ?Route
    {
        foreach ($this->routes as $route) {
            $parameters = $this->getParameters($route, $url);

            if (
                str_contains($url, $route->url()) && 
                $method === $route->method() && 
                $this->validateParameters($parameters, $route->parameters())
            ) {
                return $route;
            }
        }      

        return null;
    }

    private function getParameters(Route $route, string $url): array
    {
        $param_str = str_replace($route->url(), '', $url);
        $params = explode('/', trim($param_str, '/'));
        return array_filter($params);        
    }

    private function validateParameters(array $urlParameters, array $routeParameters): bool 
    {
        if (sizeof($urlParameters) !== sizeof($routeParameters)) {
            return false;
        }

        $validParams = 0;

        for ($i = 0; $i < sizeof($routeParameters); $i++) {
            $type = $routeParameters[$i]['type'] ?? 'string';
            if ($type == 'int' && (int) $urlParameters[$i] !== 0) $validParams++;
        }

        if ($validParams !== sizeof($urlParameters)) return false;

        return true;
    }
}