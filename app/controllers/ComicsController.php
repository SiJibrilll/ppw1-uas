<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;
use helpers\Auth;
use helpers\Request;
use helpers\Url;

class ComicsController extends BaseController {
  function index() {
    $dbh = new Dbh();
    $request = new Request();
    $search = $request->input('search', '');
    $page = (int) $request->input('page', 1);
    $comics = $dbh->paginate('Comics', 'DESC', $page, 8, 'title', 'like', "%$search%");

    $_SESSION['search'] = $search; // Save search term for later use

    //for each comic, get the cover image path
    foreach ($comics['data'] as &$comic) {
      $image = $dbh->query('SELECT path FROM Images WHERE id = ?', [$comic['image_id']])->fetchAll();
      $comic['cover'] = $image[0]['path'] ?? $GLOBALS['placeholder'];
    }

    $this->view('search_comics', [
      'comics' => $comics['data'],
      'total_pages' => $comics['total_pages'],
      'current_page' => $comics['current_page'],
    ]);
  }

  function info() {
    $request = new Request();
    $id = $request->input('id');

    if (!$id) {
      header('Location: /home');
      exit;
    }

    $dbh = new Dbh();
    $sql = 'SELECT c.*, i.path as cover FROM Comics as c left join Images as i on c.image_id=i.id WHERE c.id = ?';
    $comic = $dbh->query($sql, [$id])->fetch();
    if (!$comic) {
      echo "Comic with id " . $id . " not found";
      exit;
    }

    $chapters = $dbh->paginate('Chapters', 'DESC', $request->input('page', 1), 10, 'comic_id', '=', $id);
    
    foreach ($chapters['data'] as &$chapter) {
      $image = $dbh->query('SELECT path FROM Images WHERE id = ?', [$chapter['image_id']])->fetchAll();
    
      $chapter['cover'] = $image[0]['path'] ?? $GLOBALS['placeholder'];
    }

    

    $this->view('comic_detail', [
      'comic' => $comic,
      'chapters' => $chapters['data'],
      'total_pages' => $chapters['total_pages'],
      'current_page' => $chapters['current_page'],
    ]);
  }

  function read() {
    $request = new Request();
    $comic_id = $request->input('comic');
    $page = $request->input('page', 1);

    $dbh = new Dbh();
    
    $chapters = $dbh->paginate('Chapters', 'DESC', $page, 1, 'comic_id', '=', $comic_id);

    // get pages from chapter
    $chapter_id = $chapters['data'][0]['id'] ?? null;
    if (!$chapter_id) {
      echo "Chapter not found for comic with id " . $comic_id;
      exit;
    }

    $pages = $dbh->query('SELECT p.*, i.path as path FROM Pages as p LEFT JOIN Images as i ON p.image_id = i.id WHERE p.chapter_id = ? ORDER BY p.id ASC', [$chapter_id])->fetchAll();
    
    $comic = $dbh->query('SELECT * FROM Comics WHERE id = ?', [$comic_id])->fetch();

    $this->view('comic_reader', [
      'comic' => $comic,
      'pages' => $pages,
      'comic_id' => $comic_id,
      'chapter_id' => $chapter_id,
      'total_pages' => $chapters['total_pages'],
      'current_page' => $chapters['current_page'] 
    ]);
  }

  public function create() {
    Auth::guard();
    $this->view('create_comics');
  }

  public function edit() {
    Auth::guard();
    $url = new Url;
    $id = $url->get('id');

    if (!$id) {
      header('Location: /home');
      exit;
    }

    $dbh = new Dbh();
    $sql = 'SELECT c.*, i.path as cover FROM Comics as c left join Images as i on c.image_id=i.id WHERE c.id = ?';
    $comic = $dbh->query($sql, [$id])->fetchAll()[0];
    
    if (!$comic) {
      echo "Comic with id " . $id . " not found";
      exit;
    }
    

    // $image = $dbh->query('SELECT path FROM Images WHERE id = ?', [$comic[0]['image_id']])->fetchAll();
    
    $this->view('edit_comics', [
      'prev' => $comic,
    ]);
  }

  function store() {
    Auth::guard();

    $request = new Request();

    $title = $request->input('title');
    $author = $request->input('author');
    $description = $request->input('description');
    $cover = $request->file('cover');
   
    $cover_id = null;

    $_SESSION['old'] = [
        'title' => $title,
        'author' => $author,
        'description' => $description,
    ];

    if ($title == '' || $author == "" || $description == "") {
        $_SESSION['errors'] = ['title, author, and description cannot be empty!'];
        header('Location: /comics/create');
        exit;
    }

    
    $dbh = new Dbh();
    $conn = $dbh->getConn();
    
    if ($cover != null) {
        $ih = new ImageHandler;
        $path = $ih->upload($cover);
        if (array_key_exists('path', $path)) {
            $sql = 'INSERT INTO Images (path) VALUES (?)';
            $dbh->query($sql, [$path['path']]); // simpan image dalam db

            $cover_id = $conn->lastInsertId(); // ambil lagi id image nya
        }
    }

    $sql = 'INSERT INTO Comics (title, author, description, image_id) VALUES (?, ?, ?, ?)';

    $result = $dbh->query($sql, [$title, $author, $description, $cover_id]);

    if (!$result->rowCount() > 0) { // if no rows are inserted, that means theres an error
        $_SESSION['errors'] = ["Oops, something went wrong!"];
        header("Location: /comics/create");
        exit;
    }

    unset($_SESSION['old']);
    header("Location: /dashboard");
    exit;

  }

  function update() {
    Auth::guard();
    

    $request = new Request();
    $id = $request->input('id');
    $title = $request->input('title');
    $author = $request->input('author');
    $description = $request->input('description');
    $cover = $request->file('cover');

    $_SESSION['old'] = [
        'title' => $title,
        'author' => $author,
        'description' => $description,
    ];

    if ($title == '' || $author == "") {
        $_SESSION['errors'] = ['title and author cannot be empty!'];
        header('Location: /comics/edit?id=' . $id);
        exit;
    }
    

    $dbh = new Dbh();
    $conn = $dbh->getConn();
    
    $imageId = null;

    if ($cover != null) {
        $ih = new ImageHandler;
        $path = $ih->upload($cover);

        if (array_key_exists('path', $path)) {
            // Check if there's already an image for this comic
            $checkSql = 'SELECT id FROM Images WHERE id = ?';
            $checkResult = $dbh->query($checkSql, [$id]);

            if ($checkResult && $checkResult->rowCount() > 0) {
                // Update existing image
                $updateSql = 'UPDATE Images SET path = ? WHERE id = ?';
                $dbh->query($updateSql, [$path['path'], $id]);
                $imageId = $id;
            } else {
                // Insert new image
                $insertSql = 'INSERT INTO Images (path) VALUES (?)';
                $dbh->query($insertSql, [$path['path']]);

                // Get the new image ID
                $imageId = $dbh->getConn()->lastInsertId();
            }
        }
    }

    // Update the comic
    if ($imageId !== null) {
        $sql = 'UPDATE Comics SET title = ?, author = ?, description = ?, image_id = ? WHERE id = ?';
        $result = $dbh->query($sql, [$title, $author, $description, $imageId, $id]);
    } else {
        $sql = 'UPDATE Comics SET title = ?, author = ?, description = ? WHERE id = ?';
        $result = $dbh->query($sql, [$title, $author, $description, $id]);
    }


    if (!$result || $result->rowCount() <= 0) { // if no rows are updated, that means theres an error
        $_SESSION['errors'] = ["Oops, something went wrong!"];
        header("Location: /comics/edit?id=" . $id);
        exit;
    }

    
    

    unset($_SESSION['old']);
    header("Location: /dashboard");
    exit;
    
  }

  function delete() {
    Auth::guard();
    $request = new Request();
    $id = $request->input('id');
    if (!$id) {
      header('Location: /dashboard');
      exit;
    }
    $dbh = new Dbh();
    $sql = 'DELETE FROM Comics WHERE id = ?';
    $result = $dbh->query($sql, [$id]);
    if (!$result || $result->rowCount() <= 0) { // if no rows are deleted, that means theres an error
      $_SESSION['errors'] = ["Oops, something went wrong!"];
      header("Location: /dashboard");
      exit;
    }

    unset($_SESSION['old']);
    header("Location: /dashboard");
    exit;
  }
}
