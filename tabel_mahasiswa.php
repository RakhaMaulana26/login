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

// Fetch data from the 'users' table
$sql = 'SELECT * FROM users ORDER BY nrp ASC';
$result = pg_query($conn, $sql);

// Close the database connection
include 'closedb.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="styletabel.css">

</head>

<body>
    <h2>Daftar Mahasiswa</h2>
    <table border="1">
        <tr>
            <th>NRP</th>
            <th>Nama</th>
            <th>Detail</th>
        </tr>

        <?php while ($row = pg_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nrp']); ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><a href="detail.php?nrp=<?php echo htmlspecialchars($row['nrp']); ?>">Detail</a></td>
            </tr>
        <?php endwhile; ?>

    </table>
</body>

</html>
