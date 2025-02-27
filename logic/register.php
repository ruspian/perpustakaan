<?php
// register.php - Registrasi pengguna
    include '../db/db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error dalam persiapan statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $nama, $email, $password);
    if ($stmt->execute()) {
        echo "<alert>Registrasi berhasil. Silahkan Login</alert>";
    } else {
        echo "Gagal registrasi: " . $stmt->error;
    }
        $stmt->close();
    }
?>