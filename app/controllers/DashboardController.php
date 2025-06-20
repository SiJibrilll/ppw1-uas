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
    $search = $url->get('search', '');

    $dbh = new Dbh;
    $comics = $dbh->paginate('Comics', 'DESC', $page, 10, 'title', 'like', "%$search%");

    $comic_count = $dbh->query('SELECT COUNT(*) as count FROM Comics WHERE title LIKE ?', ["%$search%"])->fetch();

    //for each comic, get the cover image path
    foreach ($comics['data'] as &$comic) {
      $image = $dbh->query('SELECT path FROM Images WHERE id = ?', [$comic['image_id']])->fetchAll();
      $comic['cover'] = $image[0]['path'] ?? $GLOBALS['placeholder'];
    }

    //for each comic, get chapter count
    foreach ($comics['data'] as &$comic) {
      $chapterCount = $dbh->query('SELECT COUNT(*) as count FROM Chapters WHERE comic_id = ?', [$comic['id']])->fetch();
      $comic['chapter_count'] = $chapterCount['count'];
    }

    $this->view('dashboard', [
        'comics' => $comics['data'],
        'total_pages' => $comics['total_pages'],
        'current_page' => $comics['current_page'],
        'search' => $search,
        'total_comics' => $comic_count['count'],
    ]);
  }
}
