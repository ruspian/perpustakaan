<?php
include "../db/db.php";

$id = $_GET["id"];
$query = "DELETE FROM buku WHERE id_buku=$id";

if (mysqli_query($conn, $query)) {
    header("Location: ../page/daftarBukuPage.php");
} else {
    echo "Gagal menghapus buku.";
}
?>
