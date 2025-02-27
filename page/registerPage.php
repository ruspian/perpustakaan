<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="../style/registerStyle.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Daftar Akun</h2>
        <form class="register-form" method="post" action="../logic/register.php">
            <input type="text" name="nama" class="input-field" placeholder="Nama" required>
            <input type="email" name="email" class="input-field" placeholder="Email" required>
            <input type="password" name="password" class="input-field" placeholder="Password" required>
            <button type="submit" class="btn">Daftar</button>
        </form>
        <p class="login-link">Sudah punya akun? <a href="loginPage.php">Login</a></p>
    </div>
</body>
</html>
