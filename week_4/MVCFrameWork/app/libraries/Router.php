<?php

class Router {

    public array $available_routes = [];

    public function addRoute(string $full_route, string $controller, string $method, string $request_method){

        $this->available_routes [] = [
            "full_route" => $full_route,
            "controller"=> $controller,
            "method" => $method,
            "request_method" => $request_method
        ];
    }
}
