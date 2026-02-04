<?php
session_start();
$config = require 'connectdb.php';

try {
    $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
    $conn = new PDO($dsn, $config['user'], $config['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("DB Error");
}

$username = $_POST['auser'] ?? '';
$password = $_POST['apwd'] ?? '';

$stmt = $conn->prepare(
    "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ? LIMIT 1"
);
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['a_password'])) {
    $_SESSION['aid']   = $user['a_id'];
    $_SESSION['aname'] = $user['a_name'];
    header('Location: index2.php');
    exit;
}

header('Location: index.php?error=1');
exit;
