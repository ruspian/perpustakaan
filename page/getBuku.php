<?php
include "../db/db.php";

$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$no}</td>";
    echo "<td><img src='../uploads/{$row['gambar']}' width='50'></td>";
    echo "<td>{$row['nama_buku']}</td>";
    echo "<td>{$row['penulis']}</td>";
    echo "<td>{$row['tahun_terbit']}</td>";
    echo "<td>{$row['deskripsi']}</td>";
    echo "<td>
            <a href='editBukuPage.php?id={$row['id_buku']}' class='btn-edit'>Edit</a>
            <a href='../logic/hapusBuku.php?id={$row['id_buku']}' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
          </td>";
    echo "</tr>";
    $no++;
}
?>
