<?php
session_start();
$errorMessage = '';

if (isset($_POST['txtUsername']) && isset($_POST['txtPassword'])) {
    include 'config.php';
    include 'opendb.php';

    // Ambil input pengguna
    $username = htmlspecialchars($_POST['txtUsername'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['txtPassword'], ENT_QUOTES);

    // Siapkan dan eksekusi query PostgreSQL
    $sql = "SELECT username FROM users WHERE username = $1 AND password = $2";
    $result = pg_prepare($conn, "login_query", $sql);
    $result = pg_execute($conn, "login_query", array($username, $password));

    if ($result && pg_num_rows($result) === 1) {
        $_SESSION['user_is_logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: main2.php');
        exit;
    } else {
        $errorMessage = 'Maaf, username atau password salah';
    }

    include 'closedb.php';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <!-- Pesan Error -->
        <?php if (!empty($errorMessage)): ?>
            <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>
        
        <!-- Form Login -->
        <form action="" method="post" name="frmLogin" id="frmLogin" autocomplete="off">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input name="txtUsername" type="text" id="txtUsername" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input name="txtPassword" type="password" id="txtPassword" required></td>
                </tr>
            </table>
            <!-- Tombol Login -->
            <input name="btnLogin" type="submit" id="btnLogin" value="Login">
        </form>

        <!-- Link Register -->
        <p class="register-link">
            Belum punya akun? <a href="register.php">Register</a>
        </p>
    </div>
</body>
</html>

