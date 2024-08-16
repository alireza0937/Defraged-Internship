<?php

class Request {

    private $method;
    private $queryParams;
    private $bodyParams;
    private $headers;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->queryParams = $_GET;
        $this->bodyParams = $_POST;
        $this->headers = getallheaders();
    }

    public function getMethod() {
        return $this->method;
    }

    public function getQueryParams() {
        return $this->queryParams;
    }

    public function getBodyParams() {
        return $this->bodyParams;
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function get($key, $default = null) {
        return $this->queryParams[$key] ?? $this->bodyParams[$key] ?? $default;
    }

    public function getAll() {
        return array_merge($this->queryParams, $this->bodyParams);
    }



}