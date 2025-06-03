<?php

use controllers\BaseController;
use app\Dbh;
use helpers\ImageHandler;


class AuthController extends BaseController {
  public function create() {
    $this->view('register');
  }

  function login() {
    $this->view('login');
  }

  function store() { // TODO buat supaya kalo duplikat nggak sql error
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        $_SESSION['old'] = ['username' => $username]; // Save old input

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = "Username and password are required.";
            header("Location: /register");
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $dbh = new Dbh();

        $result = $dbh->query('INSERT INTO users (username, password) VALUES (?, ?)', [$username, $hashed_password]);

        if (!$result->rowCount() > 0) { // if no rows are inserted, that means theres an error
            $_SESSION['error'] = "Something went wrong: Username might already exist.";
            header("Location: /register");
            exit;
        }

        $_SESSION['success'] = "Registration successful!";
        unset($_SESSION['old']); // Clear old input

        header("Location: /dashboard");
        exit;
    }
  }

  public function authenticate() {
    session_start();
    // If form submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';


        $_SESSION['old'] = ['username' => $username]; // Save old input


        $dbh = new Dbh();
        $user  = $dbh->query('SELECT id, password FROM users WHERE username = ?', [$username])->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            unset($_SESSION['old']);
            header("Location: /dashboard");
            exit();
        }

        $_SESSION['error'] = "Invalid username or password.";
        header("Location: /login");
        $stmt->close();
    }
  }

  function logout() {
    // Start the session
    session_start();

    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // (Optional) Redirect to login page or home page
    header("Location: /home");
    exit();
  }
}
