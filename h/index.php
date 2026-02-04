<?php
declare(strict_types=1);
session_start();
$config = require __DIR__ . '/connectdb.php';

try {
    $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
    $conn = new PDO(
        $dsn,
        $config['user'],
        $config['pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ");
}


if (isset($_SESSION['aid'])) {
    header('Location: index2.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['auser'] ?? '');
    $password = $_POST['apwd'] ?? '';

    $stmt = $conn->prepare(
        "SELECT a_id, a_name, a_password 
         FROM admin 
         WHERE a_username = :u 
         LIMIT 1"
    );
    $stmt->execute(['u' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['a_password'])) {
        session_regenerate_id(true);
        $_SESSION['aid']   = $user['a_id'];
        $_SESSION['aname'] = $user['a_name'];
        header('Location: index2.php');
        exit;
    }
    $error = 'Username หรือ Password ไม่ถูกต้อง';
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
<h1>Login</h1>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<form method="post">
    Username <input name="auser" required><br><br>
    Password <input type="password" name="apwd" required><br><br>
    <button>LOGIN</button>
</form>
</body>
</html>
