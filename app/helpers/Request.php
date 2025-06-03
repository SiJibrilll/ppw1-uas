<?php

namespace helpers;

class Request {
    public array $get;
    public array $post;
    public array $server;
    public array $files;

    public function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->files = $_FILES;
    }

    public function input(string $key, $default = null) {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function file(string $key) {
        return $this->files[$key] ?? null;
    }

    public function method(): string {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function all(): array {
        return array_merge($this->get, $this->post);
    }
}
