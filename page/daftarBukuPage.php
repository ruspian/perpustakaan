<?php
include "../db/db.php";

// Ambil nilai limit dari dropdown (default: 10)
$limit = isset($_GET['limit']) && $_GET['limit'] !== 'all' ? (int)$_GET['limit'] : 1000;

// Ambil keyword pencarian (jika ada)
$keyword = isset($_GET['q']) ? trim($_GET['q']) : "";

// Query pencarian buku
$query = "SELECT * FROM buku";
if (!empty($keyword)) {
    $query .= " WHERE nama_buku LIKE '%$keyword%' OR penulis LIKE '%$keyword%' OR tahun_terbit LIKE '%$keyword%'";
}
$query .= " LIMIT $limit";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="../style/daftarBukuStyle.css">
</head>
<body>

    <div class="container">
        <h1 class="title">Daftar Buku</h1>

        <!-- Form Pencarian -->
        <form method="GET" style="display: none;">
            <input type="text" name="q" id="search-input" placeholder="Cari buku..." value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit">Cari</button>
        </form>

        <!-- Filter Jumlah Buku -->
        <label for="filterJumlah">Tampilkan:</label>
        <select id="filterJumlah">
            <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
            <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
            <option value="30" <?= $limit == 30 ? 'selected' : '' ?>>30</option>
            <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
            <option value="all" <?= $limit == 1000 ? 'selected' : '' ?>>Semua</option>
        </select>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Buku</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="daftarBuku">
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td><img src='../uploads/images/{$row['gambar']}' width='50'></td>";
                        echo "<td>{$row['nama_buku']}</td>";
                        echo "<td>{$row['penulis']}</td>";
                        echo "<td>{$row['tahun_terbit']}</td>";
                        echo "<td>" . (strlen($row['deskripsi']) > 100 ? substr($row['deskripsi'], 0, 100) . "..." : $row['deskripsi']) . "</td>";
                        echo "<td>
                                <button class='btn-edit' onclick='tampilFormEdit({$row['id_buku']}, \"{$row['nama_buku']}\", \"{$row['penulis']}\", \"{$row['tahun_terbit']}\", \"{$row['deskripsi']}\")'>
                                    Edit
                                </button>
                                <a href='../logic/hapusBuku.php?id={$row['id_buku']}' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                              </td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <br>
        <!-- Tombol Tambah Buku -->
        <button id="btnTambahBuku" class="btn-add">Tambah Buku</button>

        <!-- Tombol Kembali -->
        <button class="btn back-btn"><a href="../index.php">Kembali</a></button>

        <!-- Form Tambah Buku -->
        <div id="formContainer" style="display: none;">
            <h2>Tambah Buku</h2>
            <form method="post" enctype="multipart/form-data" action="../logic/tambahBuku.php">
                <label>Nama Buku:</label>
                <input type="text" name="nama_buku" required>

                <label>Penulis:</label>
                <input type="text" name="penulis" required>

                <label>Tahun Terbit:</label>
                <input type="number" name="tahun" required>

                <label>Deskripsi:</label>
                <textarea name="desc" required></textarea>

                <label>Gambar:</label>
                <input type="file" name="gambar" required>

                <label>File PDF:</label>
                <input type="file" name="file_pdf" accept=".pdf" required>

                <button type="submit">Simpan</button>
            </form>
        </div>

        <!-- Form Edit Buku -->
        <div id="formEditContainer" style="display: none;">
            <h2>Edit Buku</h2>
            <form method="post" id="formEditBuku" enctype="multipart/form-data" action="../logic/editBuku.php">
                <input type="hidden" name="id_buku" id="editIdBuku">

                <label>Nama Buku:</label>
                <input type="text" name="nama_buku" id="editNamaBuku" required>

                <label>Penulis:</label>
                <input type="text" name="penulis" id="editPenulis" required>

                <label>Tahun Terbit:</label>
                <input type="number" name="tahun" id="editTahun" required>

                <label>Deskripsi:</label>
                <textarea name="desc" id="editDesc" required></textarea>

                <label>Gambar:</label>
                <input type="file" name="gambar">

                <button type="submit">Update</button>
            </form>
        </div>

    <script src="../script/tambahBuku.js"></script>
   
</body>
</html>
