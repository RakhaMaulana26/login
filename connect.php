<?php

$dbhost = 'localhost'; 
$dbport = '5432'; 
$dbname = 'percobaanphp'; 
$dbuser = 'postgres'; 
$dbpass = 'Rakha260206'; 

$conn_string = "host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass";

$conn = pg_connect($conn_string);

if (!$conn) {
    die('Error: Could not connect to the PostgreSQL database. ' . pg_last_error());
}

echo 'Connected to PostgreSQL database successfully.';

pg_close($conn);

?>
