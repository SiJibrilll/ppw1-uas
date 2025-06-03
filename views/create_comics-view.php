<?php
// Get previous input values if available
$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];

var_dump($_SESSION);

// Clear the session data so it's not reused accidentally
unset($_SESSION['old'], $_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (!empty($errors)): ?>
    <div style="color:red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method='POST' action="/comics" enctype="multipart/form-data">
        <label for="cover">Comic cover</label>
        <input name='cover' type="file">

        <label for="title">Comic title</label>
        <input value="<?= htmlspecialchars($old['title'] ?? '') ?>" name='title' type="text">

        <label for="author">Comic author</label>
        <input value="<?= htmlspecialchars($old['author'] ?? '') ?>" name='author' type="text">

        <label for="description">Comic description</label>
        <textarea name="description" id=""><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
        
        <button type='submit'>Submit</button>
    </form>
</body>
</html>