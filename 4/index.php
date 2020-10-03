<?php
include "connection.php";

$news = $conn->query("SELECT news.*, user.name FROM news INNER JOIN user ON news.user_id = user.id");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <title>Home</title>
  </head>
  <body>
    <a href="dashboard" class="ml-5">Dashboard</a>
    <div class="container mt-3">
      <?php foreach ($news as $item) :?>
      <div class="card mt-2">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <img src="assets/img/<?= $item["image"] ?>" height="200">
            </div>
            <div class="col-md-9">
              <h2><?= $item["title"] ?></h2>
              <p><b>Created By: <?= $item["name"] ?></b></p>
              <p>
                <?= $item["deskripsi"] ?>
              </p>
              <a href="detail.php?id=<?= $item['id'] ?>" class="btn btn-primary">Baca Berita</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/bootstrap/js/jquery.js"></script>
    <script src="assets/bootstrap/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>