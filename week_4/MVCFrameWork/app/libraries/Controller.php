<?php
  class Controller {

    protected $method;
    protected $body_params;
    protected Request $request;

    public function __construct(Request $request)
    {
      $this->request = $request;
    }
    public function model($model){
      require_once '../app/models/' . ucfirst($model) . '.php';
      return new $model();
    }

    public function view($url, $data = []){
      if(file_exists('../app/views/'.$url.'.php')){
        require_once '../app/views/'.$url.'.php';
      } else {
        die('View does not exist');
      }
    }
  }
