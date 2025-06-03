<?php session_start(); ?>
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
</html>