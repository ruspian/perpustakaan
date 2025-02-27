<?php
include '../db/db.php'; // Pastikan koneksi database sudah benar

// Pastikan id_buku ada dalam URL dan valid
if (!isset($_POST["id_buku"]) || empty($_POST["id_buku"])) {
    die("❌ ERROR: ID buku tidak ditemukan!");
}

$id = mysqli_real_escape_string($conn, $_POST["id_buku"]);
$query = "SELECT * FROM buku WHERE id_buku='$id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("❌ ERROR: Buku tidak ditemukan!");
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST["nama_buku"]);
    $penulis = mysqli_real_escape_string($conn, $_POST["penulis"]);
    $tahun = mysqli_real_escape_string($conn, $_POST["tahun"]);
    $desc = mysqli_real_escape_string($conn, $_POST["desc"]);

    // Cek apakah ada file gambar yang diunggah
    if (!empty($_FILES["gambar"]["name"])) {
        $gambar = basename($_FILES["gambar"]["name"]);
        $target_dir = __DIR__ . "/../uploads/"; // Pastikan ini sesuai dengan tempat penyimpanan utama

        // Buat folder jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . $gambar;
        
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $query = "UPDATE buku SET 
                      nama_buku='$nama', 
                      penulis='$penulis', 
                      tahun_terbit='$tahun', 
                      deskripsi='$desc', 
                      gambar='$gambar' 
                      WHERE id_buku='$id'";
        } else {
            die("❌ ERROR: Gagal mengunggah gambar!");
        }
    } else {
        $query = "UPDATE buku SET 
                  nama_buku='$nama', 
                  penulis='$penulis', 
                  tahun_terbit='$tahun', 
                  deskripsi='$desc' 
                  WHERE id_buku='$id'";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: ../page/daftarBukuPage.php"); // Pastikan path benar
        exit();
    } else {
        die("❌ ERROR: " . mysqli_error($conn));
    }
}
?>
