<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['user_is_logged_in']) || !isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Sertakan koneksi database
include 'config.php';
include 'opendb.php';

// Ambil username pengguna yang login dari sesi
$username = $_SESSION['username'];

// Inisialisasi pesan sukses dan error
$successMessage = '';
$errorMessage = '';

// Fungsi untuk mendapatkan data pengguna dari database
function getUserData($conn, $username) {
    $query = "SELECT nama, nrp, alamat, tempat_tanggal_lahir, email, nomorhandphone, username FROM users WHERE username = $1";
    $stmt = pg_prepare($conn, 'get_user_data', $query);
    $result = pg_execute($conn, 'get_user_data', array($username));
    if ($result && pg_num_rows($result) > 0) {
        return pg_fetch_assoc($result);
    } else {
        return false;
    }
}

// Fungsi untuk memperbarui data pengguna di database
function updateUserData($conn, $username, $nama, $nrp, $alamat, $tempat_tanggal_lahir, $email, $nomorhandphone) {
    $query = "UPDATE users SET nama = $1, nrp = $2, alamat = $3, tempat_tanggal_lahir = $4, email = $5, nomorhandphone = $6 WHERE username = $7";
    $stmt = pg_prepare($conn, 'update_user_data', $query);
    return pg_execute($conn, 'update_user_data', array($nama, $nrp, $alamat, $tempat_tanggal_lahir, $email, $nomorhandphone, $username));
}

// Ambil data pengguna
$userData = getUserData($conn, $username);

// Tangani permintaan POST untuk pembaruan data pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input pengguna dan lakukan sanitasi
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $nrp = htmlspecialchars($_POST['nrp'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $nomorhandphone = htmlspecialchars($_POST['nomorhandphone'], ENT_QUOTES);

    // Perbarui data pengguna di database
    if (updateUserData($conn, $username, $nama, $nrp, $alamat, $tempat_tanggal_lahir, $email, $nomorhandphone)) {
        $successMessage = 'Data pengguna berhasil diperbarui.';
        // Perbarui data pengguna dalam variabel `$userData`
        $userData = getUserData($conn, $username);
    } else {
        $errorMessage = 'Gagal memperbarui data pengguna.';
    }
}

// Tutup koneksi database
include 'closedb.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="styleprofile.css">
</head>
<body>
    <h2>Profil Pengguna</h2>
    <?php
    if ($successMessage != '') {
        echo '<p style="color: green;">' . htmlspecialchars($successMessage) . '</p>';
    }
    if ($errorMessage != '') {
        echo '<p style="color: red;">' . htmlspecialchars($errorMessage) . '</p>';
    }
    ?>

    <form action="" method="post">
        <table width="400" border="1" align="center" cellpadding="2" cellspacing="2">
            <tr>
                <td>Nama:</td>
                <td><input name="nama" type="text" value="<?php echo htmlspecialchars($userData['nama']); ?>" required></td>
            </tr>
            <tr>
                <td>NRP:</td>
                <td><input name="nrp" type="text" value="<?php echo htmlspecialchars($userData['nrp']); ?>" required></td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td><input name="alamat" type="text" value="<?php echo htmlspecialchars($userData['alamat']); ?>" required></td>
            </tr>
            <tr>
                <td>Tempat & Tanggal Lahir:</td>
                <td><input name="tempat_tanggal_lahir" type="date" value="<?php echo htmlspecialchars($userData['tempat_tanggal_lahir']); ?>" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input name="email" type="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required></td>
            </tr>
            <tr>
                <td>Nomor Handphone:</td>
                <td><input name="nomorhandphone" type="text" value="<?php echo htmlspecialchars($userData['nomorhandphone']); ?>" required></td>
            </tr>
        </table>
    </form>
</body>
</html>
