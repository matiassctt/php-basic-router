<?php 

final readonly class Route
{
    public function __construct(
        private string $name,
        private string $url,
        private string $controller,
        private string $method,
        private array $parameters,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data["name"],
            $data["url"],
            $data["controller"],
            $data["method"],
            $data["parameters"] ?? [],
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function controller(): string
    {
        return $this->controller;
    }

    public function className(): string
    {
        $route = explode("/", $this->controller);
        return str_replace('.php', '', end($route));
    }

    public function method(): string
    {
        return $this->method;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}