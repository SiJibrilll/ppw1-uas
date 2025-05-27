<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
  </head>
  <body>

    <h1>Welcome to the home page</h1>
    <p>Image: </p>
    <?php var_dump($image) ?>
    <img src="<?= $image; ?>" alt="">

    <form action="/home" method="POST" enctype="multipart/form-data">
      <input type="file" name="image">
      <button type="submit">Upload Image</button>
  </form>

  </body>
</html>
