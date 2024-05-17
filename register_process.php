<?php

// Include database connection and configuration files
include 'config.php';
include 'opendb.php';

// Initialize error message
$errorMessage = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize user inputs
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $nrp = htmlspecialchars($_POST['nrp'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $nomorhandphone = htmlspecialchars($_POST['nomorhandphone'], ENT_QUOTES);
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    // Prepare and execute the PostgreSQL insert query
    $sql = "INSERT INTO users (nama, nrp, alamat, tempat_tanggal_lahir, email, nomorhandphone, username, password)
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
    $stmt = pg_prepare($conn, "insert_query", $sql);
    
    $result = pg_execute($conn, "insert_query", array(
        $nama,
        $nrp,
        $alamat,
        $tempat_tanggal_lahir,
        $email,
        $nomorhandphone,
        $username,
        $password
    ));

    if ($result) {
        echo 'Registrasi berhasil. Anda dapat login.';
    } else {
        $errorMessage = 'Registrasi gagal. Harap coba lagi.';
    }

    // Close the database connection
    include 'closedb.php';
}

// Display error message if any
if ($errorMessage != '') {
    echo '<p style="color: red;">' . htmlspecialchars($errorMessage) . '</p>';
}
?>
