<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;


class DasboardController extends BaseController {
  public function index(Type $var = null) {
    $this->view('dashboard', [
    ]);
  }
}
