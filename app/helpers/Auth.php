<?php

namespace helpers;

class Auth {
    static function guard() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            // Not logged in, redirect to login page
            header("Location: /login");
            exit;
        }
    }
}
