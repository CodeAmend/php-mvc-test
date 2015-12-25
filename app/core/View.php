<?php

class View {

  protected $twig;
  protected $file;
  protected $data;

  public function __construct($file, $date) {
    $this->file = $file;
    $this->data = $date;

    $twigLoader = new Twig_Loader_Filesystem(INC_ROOT . "/app/views", '__MAIN__');
    $this->twig = new Twig_Environment($twigLoader, [
      'cache' => INC_ROOT . '/app/cache'
    ]);

  }

  public function __toString() {
    return $this->parseView();
  }

  public function parseView() {
    $file = $this->file . '.php';
    if(is_null($this->data)) {
      return $this->twig->render($file);
    }
    return $this->twig->render($file, $this->data);
  }

}