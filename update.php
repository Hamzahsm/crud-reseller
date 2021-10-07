<?php 

session_start();

if(!isset($_SESSION["login"])) {
  header('Location: login.php');
  exit;
}

require 'functions.php';

$id = $_GET["id"];

$data = query("SELECT * FROM produk WHERE id = $id")[0]; 

if(isset($_POST["submit"])) {
    if(update($_POST) > 0 ) {
        echo"<script> 
        alert('data berhasil di update');
        document.location.href='admin.php';
        </script>";
    } else { 
        echo "<script>alert('Ops! Gagal meng-update data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE DATA | AMAZON LAPTOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/logohd.png" type="image/png" />
</head> 
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TSF9BQ4"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<h1 class="text-center" style="margin: 2rem auto;">Update Data</h1>

<form action="" method="post" enctype="multipart/form-data" style="width: 50%; margin: 2rem auto; border: 1px solid silver; padding: 30px; ">
<div class="mb-1">
    <input type="hidden" name="id" value="<?= $data["id"];?>">
    <input type="hidden" name="gambarLama" value="<?= $data["image"];?>">

    <label for="merek" class="form-label">Merek</label>
    <input type="text" id="merek" name="merek" autocomplete="off" required value="<?= $data["merek"];?>" class="form-control">

    <label for="ram" class="form-label">RAM</label>
    <input type="text" id="ram" name="ram" autocomplete="off" required value="<?= $data["ram"];?>" class="form-control"> 

    <label for="hdd" class="form-label">HDD</label>
    <input type="text" id="hdd" name="hdd" autocomplete="off" required value="<?= $data["hdd"];?>" class="form-control">

    <label for="windows" class="form-label">Windows</label>
    <input type="text" id="windows" name="windows" autocomplete="off" required value="<?= $data["windows"];?>" class="form-control">

    <label for="processor" class="form-label">Processor</label>
    <input type="text" id="processor" name="processor" autocomplete="off" required value="<?= $data["processor"];?>" class="form-control">

    <label for="layar" class="form-label">Layar</label>
    <input type="text" id="layar" name="layar" autocomplete="off" required value="<?= $data["layar"];?>" class="form-control">

    <label for="kelengkapan" class="form-label">Kelengkapan</label>
    <input type="text" id="kelengkapan" name="kelengkapan" autocomplete="off" required value="<?= $data["kelengkapan"];?>" class="form-control"> 

    <label for="tersediadi" class="form-label">Lokasi Barang</label>
    <input type="text" id="tersediadi" name="tersediadi" autocomplete="off" required value="<?= $data["tersediadi"];?>" class="form-control"> 

    <label for="harga" class="form-label">Harga</label>
    <input type="text" id="harga" name="harga" autocomplete="off" required value="<?= $data["harga"];?>" class="form-control">
 
    <label for="status" class="form-label">Status</label>
    <input type="text" id="status" name="status" autocomplete="off" required value="<?= $data["status"];?>" class="form-control">

    <label for="image" class="form-label">image</label> <br>
    <img src="images/produk/<?= $data['image'];?>" alt="" width="50" class="form-control"> 
    <input type="file" id="image" name="image">

    <button type="submit" name="submit" class="btn btn-danger">Update</button>
    <button class="btn btn-primary"><a href="admin.php" style="text-decoration: none; color: white;">Back</a></button>
</div>
</form> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>