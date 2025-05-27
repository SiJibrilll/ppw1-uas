<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;


class HomeController extends BaseController {
  public function index(Type $var = null) {
   $image = new ImageHandler();

    $imageHandler = new ImageHandler();
    $result = $imageHandler->upload($_FILES['image']);
    // $result = $image->getImagePath('tes.png');
    


    $this->view('home', [
     'image' => $result
    ]);
  }
}
