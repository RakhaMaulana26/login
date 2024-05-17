<?php
session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['user_is_logged_in']) || !$_SESSION['user_is_logged_in']) {
    header('Location: login.php');
    exit;
}

// Include database connection and configuration files
include 'config.php';
include 'opendb.php';

// Get the NRP parameter from the URL
$nrp = isset($_GET['nrp']) ? htmlspecialchars($_GET['nrp'], ENT_QUOTES) : '';

// Prepare the query to fetch student details based on NRP
$sql = 'SELECT * FROM users WHERE nrp = $1';
$stmt = pg_prepare($conn, 'detail_query', $sql);
$result = pg_execute($conn, 'detail_query', array($nrp));

// Check if the student is found
if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $nama = htmlspecialchars($row['nama']);
    $alamat = htmlspecialchars($row['alamat']);
    $tempat_tanggal_lahir = htmlspecialchars($row['tempat_tanggal_lahir']);
    $email = htmlspecialchars($row['email']);
    $nomorhandphone = htmlspecialchars($row['nomorhandphone']);
} else {
    echo 'Mahasiswa dengan NRP tersebut tidak ditemukan.';
    exit;
}

// Close the database connection
include 'closedb.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Mahasiswa</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="styledetail.css">

</head>

<body>
    <h2>Detail Mahasiswa</h2>
    <table border="1">
        <tr>
            <td>Nama:</td>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td>Alamat:</td>
            <td><?php echo $alamat; ?></td>
        </tr>
        <tr>
            <td>Tempat & Tanggal Lahir:</td>
            <td><?php echo $tempat_tanggal_lahir; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <td>Nomor Handphone:</td>
            <td><?php echo $nomorhandphone; ?></td>
        </tr>
    </table>
    <p><a href="tabel_mahasiswa.php">Kembali ke Daftar Mahasiswa</a></p>
</body>

</html>
