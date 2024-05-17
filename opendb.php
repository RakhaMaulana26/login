<?php

$conn_string = "host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass";

$conn = pg_connect($conn_string);

if (!$conn) {
    die('Error connecting to PostgreSQL');
}
?>
