<?php
  class Pages extends Controller{
    public function __construct(){
     
    }

    public function index(){
      
      $data = [
        'title' => 'Welcome To MVCFrameWork',
        'description' => 'Simple TODO application built on the PHP framework'
      ];

      $this->view('pages/index', $data);
    }

  }