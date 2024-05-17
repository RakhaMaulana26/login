<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="ISO-8859-1">
    <!-- Tambahkan tautan CSS -->
    <link rel="stylesheet" href="styleregister.css">
</head>

<body>
    <div class="register-container">
        <h2>Registrasi Pengguna</h2>
        <form action="register_process.php" method="post" autocomplete="off">
            <table>
                <tr>
                    <td>Nama:</td>
                    <td><input name="nama" type="text" required></td>
                </tr>
                <tr>
                    <td>NRP:</td>
                    <td><input name="nrp" type="text" required></td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td><input name="alamat" type="text" required></td>
                </tr>
                <tr>
                    <td>Tempat & Tanggal Lahir:</td>
                    <td><input name="tempat_tanggal_lahir" type="date" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input name="email" type="email" required></td>
                </tr>
                <tr>
                    <td>Nomor Handphone:</td>
                    <td><input name="nomorhandphone" type="text" required></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input name="username" type="text" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input name="password" type="password" required></td>
                </tr>
            </table>
            <!-- Pindahkan tombol register keluar dari tabel -->
            <div class="submit-button-container">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>
