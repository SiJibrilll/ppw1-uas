<?php
session_start();

// Show error message if any
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

// Show old values
$oldUsername = $_SESSION['old']['username'] ?? '';
unset($_SESSION['old']);
?>

<form method="POST" action="/login">
    <label>Username:
        <input type="text" name="username" value="<?php echo htmlspecialchars($oldUsername); ?>" required>
    </label><br>
    <label>Password:
        <input type="password" name="password" required>
    </label><br>
    <button type="submit">Login</button>
</form>