<?php
include '../db/db.php';

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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['nama_buku']); ?></title>
    <link rel="stylesheet" href="../style/bacaBukuStyle.css">
</head>
<body>
    <div class="container">
       
        <?php if (!empty($row['file_pdf'])): ?>
            <div class="pdf-container">
                <iframe src="../uploads/pdf/<?php echo htmlspecialchars($row['file_pdf']); ?>" class="pdf-viewer"></iframe>
            </div>
        <?php else: ?>
            <p class="error-message">❌ Buku ini belum memiliki file PDF.</p>
        <?php endif; ?>

        <br>
        <a href="bukuPage.php" class="btn">Kembali</a>
    </div>
</body>
</html>
