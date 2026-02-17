<?php
$host = "127.0.0.1";     
$user = "root";
$pwd  = "Golf@2004";
$db   = "4199db";

$conn = mysqli_connect($host, $user, $pwd, $db);

if (!$conn) {
    die("DB ERROR: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
