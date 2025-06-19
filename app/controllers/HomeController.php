<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;


class HomeController extends BaseController {
  public function index(Type $var = null) {
  
    $sql = "SELECT c.*, i.path AS cover, ch.created_at
            FROM Comics c
            LEFT JOIN Images i ON c.image_id = i.id
            LEFT JOIN (
                SELECT comic_id, MAX(created_at) AS created_at
                FROM Chapters
                GROUP BY comic_id
            ) ch ON c.id = ch.comic_id
            ORDER BY ch.created_at DESC
            LIMIT 4;
            ";
    
    $dbh = new Dbh();
    $updates = $dbh->query($sql)->fetchAll();

    $sqlNewest = "SELECT c.*, i.path as cover 
            FROM Comics c 
            LEFT JOIN Images i ON c.image_id = i.id 
            ORDER BY c.id DESC 
            LIMIT 3";

    $comic = $dbh->query($sqlNewest)->fetchAll();

  
    $this->view('home', [
      'updates' => $updates,
      'comics' => $comic
    ]);
  }
}
