<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;
use helpers\Auth;
use helpers\Request;
use helpers\Url;

class ChaptersController extends BaseController {
    function index() {
        Auth::guard();

        $request = new Request();
        $comicId = $request->input('comic_id');
        $search = $request->input('search', '');
        if (!$comicId) {
            header('Location: /dashboard');
            exit;
        }

        $dbh = new Dbh();
        $chapters = $dbh->paginateJoin('Chapters', 'DESC', $request->input('page', 1), 10, 'comic_id', $comicId, 'title', 'like', "%$search%");
        foreach ($chapters['data'] as &$chapter) {
            $image = $dbh->query('SELECT path FROM Images WHERE id = ?', [$chapter['image_id']])->fetchAll();
            $chapter['cover'] = $image[0]['path'] ?? $GLOBALS['placeholder'];
        }

        $comic = $dbh->query('SELECT * FROM Comics WHERE id = ?', [$comicId])->fetch();
        if (!$comic) {  
            echo "Comic with id " . $comicId . " not found";
            exit;
        }

        $totalChapters = $dbh->query('SELECT COUNT(*) as count FROM Chapters WHERE comic_id = ? AND title like ?', [$comicId, "%$search%"])->fetch();

        $this->view('comic_dashboard', [
            'chapters' => $chapters['data'],
            'total_pages' => $chapters['total_pages'],
            'current_page' => $chapters['current_page'],
            'comic' => $comic,
            'total_chapters' => $totalChapters['count'],
            'search' => $search,
        ]);
    }
}