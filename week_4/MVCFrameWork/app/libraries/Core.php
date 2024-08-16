<?php
class Core {

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected array $params = [];
    protected Router $router;
    protected Request $request;
    protected array $url;

    public function __construct(){
        $this->request = new Request;
        $this->router = new Router;
        $this->url = $this->request->getUrl();
        $this->addAllRoutes();
        $this->checkRoute();
    }

    public function addAllRoutes(){
        $this->router->addRoute("", "pages", "index", "GET");
        $this->router->addRoute("tasks/", "tasks", "index", "GET");
        $this->router->addRoute("tasks/", "tasks", "index", "POST");
        $this->router->addRoute("tasks/add", "tasks", "add", "GET");
        $this->router->addRoute("tasks/add", "tasks", "add", "POST");
        $this->router->addRoute("tasks/delete/{id}", "tasks", "delete", "POST");
    }

    public function checkRoute(){
        if (count($this->request->getQueryParams()) == 0) {
            require_once('../app/controllers/' . $this->currentController . '.php');
            $this->currentController = new $this->currentController($this->request);
            return $this->setMethod();
        }

        foreach ($this->router->available_routes as $key => $value) {
            if (count($this->url) >= 2) {
                if ($this->url[1] == "delete" && isset($this->url[2]) && is_numeric($this->url[2])) {
                    return $this->setController();
                }
            }
            if ($value["full_route"] == $this->request->getQueryParams()["url"] &&
                $value["request_method"] == $this->request->getMethod()) {
                return $this->setController();
            }
        }

        die('Wrong path');
    }

    public function setController(){
        if (isset($this->url[0]) && !empty($this->url[0])) {
            $this->currentController = ucwords($this->url[0]);
            unset($this->url[0]);
            $controllerPath = '../app/controllers/' . $this->currentController . '.php';

            if (file_exists($controllerPath)) {
                require_once($controllerPath);
                $this->currentController = new $this->currentController($this->request);
            } else {
                die('Controller not found');
            }
        } else {
            die('Controller not specified');
        }

        return $this->setMethod();
    }

    public function setMethod(){
        if (isset($this->url[1])) {
            if (method_exists($this->currentController, $this->url[1])) {
                $this->currentMethod = $this->url[1];
                unset($this->url[1]);
            } else {
                die('Method not found');
            }
        }

        return $this->setParams();
    }

    public function setParams(){
        $this->params = $this->url ? array_values($this->url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
}
