<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/loginStyle.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="post" action="../logic/login.php">
            <h2 class="login-title">Login</h2>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="input-field" placeholder="Masukkan Email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="input-field" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <div class="register-link">
            <p>Belum punya akun? <a href="registerPage.php">Daftar</a></p>
        </div>
    </div>
</body>
</html>
