<!-- 
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<?php if (isset($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form method="POST" action="/register">
    <label>Username:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['old']['username'] ?? '', ENT_QUOTES); ?>" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Register</button>
</form>

<?php unset($_SESSION['old']); ?>

</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ImComic | Register</title>
  <link rel="stylesheet" href="assets/css/login.css" />
  <!-- Font Awesome CDN link for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
  <div class="wrapper">
    <div class="title"><span>Register</span></div>
    <form method="POST" action="/register">
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
        ?>
      <div class="row">
        <i class="fas fa-user"></i>
        <input name="username" type="text" placeholder="Enter your username" value="<?php echo htmlspecialchars($_SESSION['old']['username'] ?? '', ENT_QUOTES); ?>" required />
      </div>
      <div class="row">
        <i class="fas fa-lock"></i>
        <input name="password" type="password" placeholder="password" required />
      </div>
      <div class="row button">
        <input type="submit" value="Login" />
      </div>
      <div class="signup-link">Already have an accoount? <a href="/login">Login</a></div>
    </form>
  </div>
  <?php unset($_SESSION['old']); ?>
</body>
</html>