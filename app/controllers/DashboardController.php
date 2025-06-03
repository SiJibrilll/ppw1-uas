<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;
use helpers\Auth;
use helpers\Url;

class DashboardController extends BaseController {
  public function index(Type $var = null) {
    Auth::guard();

    $url = new Url();

    echo $url->get('page');

    $dbh = new Dbh;
    $comics = $dbh->paginate('comics', 'DESC');

    $this->view('dashboard', [
        'comics' => $comics
    ]);
  }
}
