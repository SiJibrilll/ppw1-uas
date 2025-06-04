<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;


class HomeController extends BaseController {
  public function index(Type $var = null) {

    $dbh = new Dbh();

    $comic = $dbh->paginate('Comics', 'DESC');
  
    $this->view('home', [
      'comic' => $comic
    ]);
  }
}
