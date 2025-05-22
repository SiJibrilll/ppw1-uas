<?php

require_once 'BaseController.php';
require_once __DIR__ .'/../Dbh.php';

class HomeController extends BaseController {
  public function index(Type $var = null) {
    $db = new Dbh();
    
    $data = $db->query("SELECT * FROM petugas")->fetchAll();
    

    $this->view('home', [
      "petugas" => $data 
    ]);
  }
}
