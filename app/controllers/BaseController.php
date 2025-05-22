<?php

class BaseController {
  protected function view($view, $data = []) {
    extract($data);

    $path = __DIR__ . '/../../views/' . $view . '-view.php';

    if (file_exists($path)) {
      require_once $path;
    } else {
      echo "404 Not found";
    }
  }
}
