<?php
include "../connection.php";

$users = $conn->query("SELECT * FROM user");

if (isset($_POST["tambah"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $query = "INSERT INTO user (name, email, role) VALUES ('{$name}', '{$email}', {$role})";

    if ($conn->query($query))
        header("Location: ?tambah=sukses");
    else
        header("Location: ?tambah=gagal");
} elseif (isset($_POST["ubah"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $query = "UPDATE user SET name = '{$name}', email = '{$email}', role = {$role} WHERE id = {$id}";

    if ($conn->query($query))
        header("Location: ?ubah=sukses");
    else
        header("Location: ?ubah=gagal");
} elseif (isset($_GET["action"]) && $_GET["action"] == "hapus") {
    $query = "DELETE FROM user WHERE id = {$_GET['id']}";

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

    <title>User - Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="../dashboard/">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="berita.php">Berita</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="">User</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <a href="#modal-tambah" data-toggle="modal" class="btn btn-success">Tambah User</a>
            </div>
            <div class="card-body">
                <div class="table-response mt-3">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user["name"] ?></td>
                                <td><?= $user["email"] ?></td>
                                <td><?= $user["role"] == 1 ? "Admin" : "User" ?></td>
                                <td class="text-center">
                                    <a href="#ubah-<?= $user['id'] ?>" data-toggle="modal" class="btn btn-primary btn-sm">Ubah</a>
                                    <a href="?action=hapus&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
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
                <form method="post" action="">
                    <div class="modal-body">                 
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal ubah -->
    <?php foreach ($users as $user) : ?>
    <div class="modal fade" id="ubah-<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">                 
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" value="<?= $user['name'] ?>" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="<?= $user['email'] ?>" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
                                <option value="2" <?= $user['role'] != 1 ? 'selected' : '' ?>>User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Ubah User</button>
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