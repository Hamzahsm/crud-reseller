<?php 
//connect ke database 
// $db = mysqli_connect("localhost", "root", "", "amazon_laptop");
 
$db_host = "localhost";
$db_username= "id15978646_bolehkan";
$db_password = "mVLLT7*oJn+ED&FK";
$db_database = "id15978646_coba1";

$db = mysqli_connect($db_host, $db_username, $db_password, $db_database);

if(!$db) {
    die("gagal terhubung ke database: ". mysqli_connet_error());
} 

function query($datas) {   
    global $db;
    $result = mysqli_query($db, $datas); 
    $datakosong = [];

    while( $isidata = mysqli_fetch_assoc($result)) {
        $datakosong[] = $isidata;
    }

    return $datakosong; 
}

//untuk menambah data
function tambah($data) {
    global $db; 

    $merek = htmlspecialchars($data["merek"]);
    $ram = htmlspecialchars($data["ram"]);
    $hdd = htmlspecialchars($data["hdd"]);
    $windows = htmlspecialchars($data["windows"]);
    $processor = htmlspecialchars($data["processor"]);
    $layar = htmlspecialchars($data["layar"]);
    $kelengkapan = htmlspecialchars($data["kelengkapan"]);
    $harga = htmlspecialchars($data["harga"]);
    $status = htmlspecialchars($data["status"]);
    $tersediadi = htmlspecialchars($data["tersediadi"]);
    $image = upload();
    if ( !$image) {
        return false; 
    }

    $query = "INSERT INTO produk (merek, ram, hdd, windows, processor, layar, kelengkapan, harga, status, image , tersediadi) VALUES ('$merek','$ram','$hdd','$windows','$processor','$layar','$kelengkapan','$harga','$status','$image', '$tersediadi')";

    mysqli_query($db, $query); 

    var_dump(mysqli_error($db)); 

    return mysqli_affected_rows($db);

}

//untuk menghapus data 

function hapus($id) {
    global $db;
    mysqli_query($db, "DELETE FROM produk WHERE id = $id");
    return mysqli_affected_rows($db); 
}

//untuk update data 
function update($post) {
    global $db; 

    $id = htmlspecialchars($post["id"]);
    $merek = htmlspecialchars($post["merek"]);
    $ram = htmlspecialchars($post["ram"]);
    $hdd = htmlspecialchars($post["hdd"]);
    $windows = htmlspecialchars($post["windows"]);
    $processor = htmlspecialchars($post["processor"]);
    $layar = htmlspecialchars($post["layar"]);
    $kelengkapan = htmlspecialchars($post["kelengkapan"]);
    $harga = htmlspecialchars($post["harga"]);
    $status = htmlspecialchars($post["status"]);
    $gambarLama = htmlspecialchars($post["gambarLama"]);
    $tersediadi = htmlspecialchars($post["tersediadi"]);

    //cek apakah user menekan tombol uploaded untuk memasukkan gambar baru atau tidak

    if( $_FILES['image']['error'] === 4) {
        $image = $gambarLama; 
    } else {
        $image = upload();
    }

    $query = "UPDATE produk SET merek = '$merek', ram = '$ram', hdd = '$hdd', windows = '$windows', processor = '$processor', layar = '$layar', kelengkapan = '$kelengkapan', harga = '$harga', status = '$status', image = '$image', tersediadi = '$tersediadi' WHERE id = $id ";
    mysqli_query($db, $query); 

    // var_dump(mysqli_error($db));

    return mysqli_affected_rows($db);
}

//untuk cari data 

function cari($keyword) {
    $query = "SELECT * FROM produk WHERE merek LIKE '%$keyword%' OR status LIKE '%$keyword%'";

    return query($query);  
} 

//untuk upload gambar 

function upload() {
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name']; 

    if ($error === 4 ) {
        echo "<script> alert(`pilih gambar terlebih dahulu!`)</script>";

        return false;//kalo upload foto gagal maka fungsi tambahnya juga gagal
    }
    
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiImage = explode('.', $namaFile);
    $ekstensiImage = strtolower(end($ekstensiImage));

    if (!in_array($ekstensiImage, $ekstensiValid)) {
        echo "<script> alert(`format harus jpg/jpeg/png!`)</script>";

        return false;
    }

    //cek jika ukurannya terlalu besaar 

    if ($ukuranFile > 3000000) {
        echo "<script> alert(`ukuran image maksimal 5mb!`)</script>";
    
        return false;
    }

    //lolos pengecekan, image siap di upload
    //generate nama baru biar namanya ga sama
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiImage; 

    move_uploaded_file($tmpName, 'images/produk/' . $namaFileBaru);

    var_dump(mysqli_error($db));

    return $namaFileBaru;
}

function register($post) {
    global $db;

    $username = strtolower(stripslashes($post["username"]));
    $password1 = mysqli_real_escape_string($db, $post["password"]);
    $password2 = mysqli_real_escape_string($db, $post["password2"]);

    //cek apakah username sudah ada di database apa belum 
    $query = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");

    if(mysqli_fetch_assoc($query)) {
        echo"<script>alert('username sudah terdaftar');</script>";
        return false; 
    }

    //cek konfirmasi password 
    if($password1 !== $password2) {
        echo "<script> alert('password tidak match!');</script>";
        return false;
    }
    //enkripsi password

    $password1 = password_hash($password1, PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username','$password1')");

    // var_dump(mysqli_error($db));

    return mysqli_affected_rows($db); 
}

function tambahkritik($data) {
    global $db; 
  
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $date =  htmlspecialchars($data["date"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kritik = htmlspecialchars($data["kritik"]);
  
    $query = "INSERT INTO comments (nama, email, date,alamat, kritik) VALUES ('$nama','$email', '$date','$alamat','$kritik')";
  
    mysqli_query($db, $query); 
  
    return mysqli_affected_rows($db);
  
  }
?> 