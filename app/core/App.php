<?php

class App {

  public function __construct() {
    echo "<pre>", print_r($this->parseURL()), "<pre>";
  }

  protected function parseURL() {
    if(isset($_GET['url'])) {
      $url = ltrim($_GET['url'], "public/");
      return explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
    }
  }
}