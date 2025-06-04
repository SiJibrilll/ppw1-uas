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

    $page = $url->get('page', 1);

    $dbh = new Dbh;
    $comics = $dbh->paginate('comics', 'DESC', $page);

    $this->view('dashboard', [
        'comics' => $comics
    ]);
  }
}
