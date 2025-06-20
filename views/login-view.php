<?php



// Show old values
$oldUsername = $_SESSION['old']['username'] ?? '';
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ImComic | Login</title>
  <link rel="stylesheet" href="assets/css/login.css" />
  <!-- Font Awesome CDN link for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
  <div class="wrapper">
    <div class="title"><span>Login</span></div>
    <form method="POST" action="/login">
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
        ?>
      <div class="row">
        <i class="fas fa-user"></i>
        <input name="username" type="text" placeholder="Enter your username" value="<?php echo htmlspecialchars($oldUsername); ?>" required />
      </div>
      <div class="row">
        <i class="fas fa-lock"></i>
        <input name="password" type="password" placeholder="password" required />
      </div>
      <div class="row button">
        <input type="submit" value="Login" />
      </div>
      <div class="signup-link">Not a member? <a href="/register">Register now</a></div>
    </form>
  </div>
</body>
</html>