<?php
include "../connection.php";

$news = $conn->query("SELECT news.*, user.name FROM news INNER JOIN user ON news.user_id = user.id");
$users = $conn->query("SELECT * FROM user");

if (isset($_POST["tambah"])) {
    $user_id = $_POST["user_id"];
    $title = $_POST["title"];
    $deskripsi = $_POST["deskripsi"];
	$image = $_FILES['image']['name'];
	$file_tmp = $_FILES['image']['tmp_name'];		
	move_uploaded_file($file_tmp, '../assets/img/'.$image);
    $query = "INSERT INTO news (title, deskripsi, image, user_id) VALUES ('{$title}', '{$deskripsi}', '{$image}', {$user_id})";

    if ($conn->query($query))
        header("Location: ?tambah=sukses");
    else
        header("Location: ?tambah=gagal");
} elseif (isset($_POST["ubah"])) {
    $id = $_POST["id"];
    $user_id = $_POST["user_id"];
    $title = $_POST["title"];
    $deskripsi = $_POST["deskripsi"];
    $image = $_FILES["image"]["name"];
    $file_tmp = $_FILES['image']['tmp_name'];		
	move_uploaded_file($file_tmp, '../assets/img/'.$image);
    $query = "UPDATE news SET title = '{$title}', deskripsi = '{$deskripsi}', image = '{$image}', user_id = {$user_id} WHERE id = {$id}";

    if ($conn->query($query))
        header("Location: ?ubah=sukses");
    else
        header("Location: ?ubah=gagal");
} elseif (isset($_GET["action"]) && $_GET["action"] == "hapus") {
    $query = "DELETE FROM news WHERE id = {$_GET['id']}";

    if ($conn->query($query))
        header("Location: ?hapus=sukses");
    else
        header("Location: ?hapus=gagal");
}

if (isset($_GET["tambah"])) {
    if ($_GET["tambah"] == "sukses")
        echo "<script>alert('Berhasil menambah record');</script>";
    else
        echo "<script>alert('Gagal menambah record');</script>";
} elseif (isset($_GET["ubah"])) {
    if ($_GET["ubah"] == "sukses")
        echo "<script>alert('Berhasil mengubah record');</script>";
    else
        echo "<script>alert('Gagal mengubah record');</script>";
} elseif (isset($_GET["hapus"])) {
    if ($_GET["hapus"] == "sukses")
        echo "<script>alert('Berhasil menghapus record');</script>";
    else
        echo "<script>alert('Gagal menghapus record');</script>";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

    <title>Berita - Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="../dashboard/">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user.php">User</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <a href="#modal-tambah" data-toggle="modal" class="btn btn-success">Tambah Berita</a>
            </div>
            <div class="card-body">
                <div class="table-response mt-3">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penulis</th>
                                <th>Tanggal Dibuat</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($news as $item) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item["name"] ?></td>
                                <td><?= $item["create_time"] ?></td>
                                <td><?= $item["title"] ?></td>
                                <td><?= $item["deskripsi"] ?></td>
                                <td><img src="../assets/img/<?= $item["image"] ?>" height="100"></td>
                                <td class="text-center">
                                    <a href="#ubah-<?= $item["id"] ?>" data-toggle="modal" class="btn btn-primary btn-sm">Ubah</a>
                                    <a href="?action=hapus&id=<?= $item["id"] ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">                 
                        <div class="form-group">
                            <label>Penulis</label>
                            <select name="user_id" class="form-control">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['id'] ?>"><?= $user["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal ubah -->
    <?php foreach ($news as $item) : ?>
    <div class="modal fade" id="ubah-<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">                 
                        <div class="form-group">
                            <label>Penulis</label>
                            <select name="user_id" class="form-control">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['id'] ?>" <?= $item['name'] == $user['name'] ? 'selected' : '' ?>><?= $user["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" value="<?= $item['title'] ?>" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required><?= $item['deskripsi'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <img src="../assets/img/<?= $item['image'] ?>" height="100">
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Ubah Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/bootstrap/js/jquery.js"></script>
    <script src="../assets/bootstrap/js/popper.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
  </body>
</html>