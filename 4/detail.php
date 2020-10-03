<?php
include "connection.php";

$news = $conn->query("SELECT news.*, user.name FROM news INNER JOIN user ON news.user_id = user.id WHERE news.id = {$_GET['id']}")->fetch_assoc();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    
    <title><?= $news['title'] ?> - Detail</title>
  </head>
  <body>
    <a href="index.php" class="ml-5">Home</a>
    <a href="dashboard">Dashboard</a>
    <div class="container mt-3">
      <div class="card mt-2">
        <div class="card-body">
            <h1><?= $news['title'] ?></h1>
            <p><b>Created By: <?= $news['name'] ?></b> - <span class="text-secondary"><?= $news['create_time'] ?></span></p>
            <img src="assets/img/<?= $news['image'] ?>" height="350">
            <p>
                <?= $news['deskripsi'] ?>
            </p>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/bootstrap/js/jquery.js"></script>
    <script src="assets/bootstrap/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>