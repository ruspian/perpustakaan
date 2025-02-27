<?php
include '../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST["nama_buku"]);
    $penulis = mysqli_real_escape_string($conn, $_POST["penulis"]);
    $tahun = mysqli_real_escape_string($conn, $_POST["tahun"]);
    $desc = mysqli_real_escape_string($conn, $_POST["desc"]);

    // Direktori Penyimpanan
    $imageDir = __DIR__ . "/../uploads/images/";
    $pdfDir = __DIR__ . "/../uploads/pdf/";

    // Buat folder jika belum ada
    if (!is_dir($imageDir)) mkdir($imageDir, 0777, true);
    if (!is_dir($pdfDir)) mkdir($pdfDir, 0777, true);

    // Upload Gambar
    $gambar = null;
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] === UPLOAD_ERR_OK) {
        $gambar = time() . "_" . basename($_FILES["gambar"]["name"]); // Biar unik
        $targetGambar = $imageDir . $gambar;
        
        if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetGambar)) {
            die("❌ Gagal mengunggah gambar ke " . $targetGambar);
        }
    }

    // Upload File pdf
    $file_pdf = null;
    if (isset($_FILES["file_pdf"]) && $_FILES["file_pdf"]["error"] === UPLOAD_ERR_OK) {
        $file_pdf = time() . "_" . basename($_FILES["file_pdf"]["name"]);
        $targetPdf = $pdfDir . $file_pdf;
        
        if (!move_uploaded_file($_FILES["file_pdf"]["tmp_name"], $targetPdf)) {
            die("❌ Gagal mengunggah file pdf ke " . $targetPdf);
        }
    }

    // Simpan ke Database
    $query = "INSERT INTO buku (nama_buku, penulis, tahun_terbit, deskripsi, gambar, file_pdf) 
              VALUES ('$nama', '$penulis', '$tahun', '$desc', '$gambar', '$file_pdf')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../page/daftarBukuPage.php");
        exit;
    } else {
        die("❌ Gagal menambahkan buku: " . mysqli_error($conn));
    }
}
?>
