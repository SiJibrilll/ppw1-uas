<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
  </head>
  <body>

    <h1>Welcome to the home page</h1>
    <p>Currently active worker:</p>

    <?php foreach ($petugas as $value): ?>
    <p> <?= $value['nama'] ?> </p>
    <?php endforeach; ?>

  </body>
</html>
