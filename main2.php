<?php
session_start();
// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['user_is_logged_in']) || !$_SESSION['user_is_logged_in']) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Utama Pengguna</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="stylemain.css"> <!-- Menghubungkan file CSS -->
</head>

<body>
    <div class="container">
        <h1>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Ini adalah halaman utama pengguna.</p>

        <!-- Bagian aside untuk tombol -->
        <aside class="user-actions">
            <p><a href="logout.php">Logout</a></p>
            <p><a href="profile.php">Lihat Profil</a></p>
            <p><a href="tabel_mahasiswa.php">Daftar Mahasiswa</a></p>
        </aside>
    </div>
</body>

</html>
