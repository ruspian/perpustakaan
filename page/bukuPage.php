<?php
include '../db/db.php';

// Konfigurasi pagination
$limit = 6; // Menampilkan 6 buku per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Ambil total buku
$totalQuery = "SELECT COUNT(*) as total FROM buku";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalBuku = $totalRow['total'];
$totalPages = ceil($totalBuku / $limit);

// Ambil data buku dengan limit
$query = "SELECT * FROM buku LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("❌ ERROR: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="../style/bukuStyle.css">
</head>
<body>
    <header>
        <h1 class="title">Daftar Buku</h1>
    </header>

    <div class="container">
        <div class="book-list">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="book-card">
                    <img src="../uploads/images/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Cover Buku">
                    <h3><?php echo htmlspecialchars($row['nama_buku']); ?></h3>
                    <p>Penulis: <?php echo htmlspecialchars($row['penulis']); ?></p>
                    <p>Tahun Terbit: <?php echo htmlspecialchars($row['tahun_terbit']); ?></p>
                    <form action="bacaBukuPage.php" method="POST">
                        <input type="hidden" name="id_buku" value="<?php echo htmlspecialchars($row['id_buku']); ?>">
                        <button type="submit" class="btn">Baca</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="btn">⬅️ Sebelumnya</a>
            <?php endif; ?>

            <span class="page-number">Halaman <?php echo $page; ?> dari <?php echo $totalPages; ?></span>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="btn">Selanjutnya ➡️</a>
            <?php endif; ?>
        </div>

        <!-- Tombol Kembali -->
        <a href="../index.php" class="btn back-btn">🔙 Kembali</a>
    </div>
</body>
</html>
