<?php

use controllers\BaseController;
use app\Dbh;

class HomeController extends BaseController {
  public function index(Type $var = null) {
    $db = new Dbh();
    
    $data = $db->query("SELECT * FROM petugas")->fetchAll();
    

    $this->view('home', [
      "petugas" => $data 
    ]);
  }
}
