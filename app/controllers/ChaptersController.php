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

    function create() {
        Auth::guard();

        $request = new Request();
        $comicId = $request->input('comic_id');
        if (!$comicId) {
            exit;
            header('Location: /dashboard');
        }

        $dbh = new Dbh();
        $comic = $dbh->query('SELECT * FROM Comics WHERE id = ?', [$comicId])->fetch();
        if (!$comic) {
            echo "Comic with id " . $comicId . " not found";
            exit;
        }

        $this->view('create_chapters', ['comic' => $comic]);
    }

    function store() {
        Auth::guard();

        $request = new Request();

        $title = $request->input('title');
        $comicId = $request->input('comic_id');
        if (!$comicId) {
            header('Location: /dashboard');
            exit;
        }
        $cover = $request->file('cover');
    
        $cover_id = null;

        $_SESSION['old'] = [
            'title' => $title
        ];

        if ($title == '') {
            $_SESSION['errors'] = ['title cannot be empty!'];
            header('Location: /chapters/create?comic_id=' . urlencode($comicId));
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

        $sql = 'INSERT INTO Chapters (title, comic_id, image_id) VALUES (?, ?, ?)';

        $result = $dbh->query($sql, [$title, $comicId, $cover_id]);

        if (!$result->rowCount() > 0) { // if no rows are inserted, that means theres an error
            $_SESSION['errors'] = ["Oops, something went wrong!"];
            header("Location: /chapters/create?comic_id=" . urlencode($comicId));
            exit;
        }

        unset($_SESSION['old']);
        header("Location: /chapters?comic_id=" . urlencode($comicId));
        exit;
    }
}