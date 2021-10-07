<?php
session_start();

require 'functions.php';

$datas = query("SELECT * FROM produk");

?>  
 
<!doctype html> 
<html lang="en">
  <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="images/logohd.png" type="image/png" />
    <title>Admin | AMAZON LAPTOP</title>
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TSF9BQ4"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<section class="content-container">

  <div class="header">
          <div class="title">
              <img src="images/logohd.png" alt="" width="80px" height="80px">
              <h2 id="produk" style="margin-left: 3rem; ">Selamat Datang Admin!</h2>
          </div>

          <div class="menus">
            <form action="" method="post">
            <input type="text" name="keyword" placeholder="Temukan produk" autocomplete="off" autofocus>
            <button type="submit" name="cari"> Cari</button>
            </form>
          <a href="tambah.php"> [+] tambah data</a>
          <a href="comments.php">kritik & saran</a>
          <a href="index.php">Log out</a> 
          </div>
      </div>

  <div class="row row-cols-1 row-cols-md-4 g-2 content" style="margin-top: 90px;">
    <?php foreach($datas as $data) :?>
    <div class="col">
      <div class="card" style="width: 18rem;">
        <img src="../images/produk/<?= $data["image"];?>" class="card-img-top" alt="komputer asus">
          <div class="card-body"> 
            <h5 class="card-title"><?= $data["merek"];?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><strong><?= $data["status"];?></strong></h6>
            <h6 style="color: green;"><strong><?= $data["harga"];?></strong></h6>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog" style="font-size:20px; color: white;"></i> Edit Data</button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <section class="detail">
                      <h5 class="text-center">Spesifikasi Produk</h5>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <tbody>
                            <tr>
                              <th scope="row">RAM</th>
                              <td><?= $data["ram"];?> GB</td>
                            </tr>
                        
                            <tr>
                              <th scope="row">HDD</th>
                              <td><?= $data["hdd"];?> GB</td>
                            </tr>
                        
                            <tr>
                              <th scope="row">Processor</th>
                              <td><?= $data["processor"];?></td>
                            </tr>
                                        
                            <tr>
                              <th scope="row">Windows</th>
                              <td><?= $data["windows"]; ?></td>
                            </tr>
                        
                            <tr>
                              <th scope="row">Layar</th>
                              <td><?= $data["layar"];?></td>
                            </tr> 
                        
                            <tr>
                              <th scope="row">Kelengkapan</th>
                              <td><?= $data["kelengkapan"];?></td>
                            </tr>

                            <tr>
                              <th scope="row">Lokasi Barang</th>
                              <td><?= $data["tersediadi"];?></td>
                            </tr>

                            <tr>
                              <th scope="row">Hub Penjual</th>
                              <td><a href="https://wa.me/+6287777007453">  <i class="fa fa-whatsapp" style="font-size:36px">  </i></a></td>
                            </tr>

                            <tr>
                              <th scope="row">Edit</th>
                              <td><a href="hapus.php?id=<?= $data["id"];?>" onclick="return confirm('Ingin hapus data?');">Hapus | <a href="update.php?id=<?= $data["id"];?>">Update</a></a></td> 
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </section>
                  </div> 
                </div>
              </div>
            </div>
    <?php endforeach; ?>
  </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>