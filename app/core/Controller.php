<?php

class Controller {

  public function view($viewName, $data ) {
    $view = new View($viewName, $data);
    echo $view;
  }

}