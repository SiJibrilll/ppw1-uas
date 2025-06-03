<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello admin!</h1>

    <?php 
    echo '<pre>';
    var_dump($comics);
    echo '</pre>';
    ?>

    <form method='POST' action="/logout">
        <button type='submit'>LOGOUT</button>
    </form>
</body>
</html>