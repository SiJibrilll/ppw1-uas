<?php

namespace helpers;

class Url {
    private $params = [];

    function __construct($source = null) {
        $this->params = $source ?? $_GET;
    }

    public function get(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }
}