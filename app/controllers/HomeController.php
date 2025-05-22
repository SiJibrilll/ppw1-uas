<?php

require 'BaseController.php';

class HomeController extends BaseController {
  public function index(Type $var = null) {
    $this->view('home', [
      "product" => "Computers"
    ]);
  }
}
