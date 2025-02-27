<?php
// logout.php - Logout pengguna
session_start();
session_destroy();
header("Location: ../index.php");
exit;
?>