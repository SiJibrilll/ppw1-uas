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
    $comics = $dbh->paginate('Comics', 'DESC', $page, 8, 'title', $search);

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

  function read() {
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
    // $chapters = $dbh->query('SELECT * FROM Chapters WHERE comic_id = ? ORDER BY id DESC', [$id])->fetchAll();
    //modify above to also get the cover image path
    // $chapters = $dbh->query('SELECT c.*, i.path as cover FROM Chapters as c LEFT JOIN Images as i ON c.image_id = i.id WHERE c.comic_id = ? ORDER BY c.id DESC', [$id])->fetchAll();
    // use paginate method and get the image
    $chapters = $dbh->paginate('Chapters', 'DESC', $request->input('page', 1), 10, $id);
    //get chapter cover images
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
    $sql = 'SELECT * FROM Comics as c join Images as i on c.image_id=i.id WHERE c.id = ?';
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
}
