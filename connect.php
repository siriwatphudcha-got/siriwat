<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "66010914019_db";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>