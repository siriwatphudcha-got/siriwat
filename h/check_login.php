<?php
require 'connectdb.php';
session_start();

$config = require __DIR__ . '/connectdb.php';

$dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
$conn = new PDO($dsn, $config['user'], $config['pass']);

$username = $_POST['auser'] ?? '';
$password = $_POST['apwd'] ?? '';

$stmt = $conn->prepare("SELECT * FROM admin WHERE a_username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['a_password'])) {
    $_SESSION['aid'] = $user['a_id'];
    $_SESSION['aname'] = $user['a_name'];
    header('Location: index2.php');
    exit;
}

header('Location: index.php');
