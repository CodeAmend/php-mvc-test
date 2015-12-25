<?php

class App {

  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  public function __construct() {
    $url = $this->parseURL();
    if(file_exists("../app/controllers/" . ucfirst($url[0]) . ".php")) {

      $this->controller = $url[0];
      unset($url[0]);
    }
    require_once '../app/controllers/' . ucfirst($this->controller) . '.php';
    $this->controller = new $this->controller();
    if(isset($url[1])) {
      if(method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }
    $this->params = !empty($url) ? array_values($url) : [];

    call_user_func([$this->controller, $this->method], $this->params);
  }

  protected function parseURL() {
    if(isset($_GET['url'])) {
      $url = preg_replace('/public\//', '', $_GET['url']);
      return explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
    }
  }
}