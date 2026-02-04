<?php
require 'secure.php';
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Dashboard</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: #f4f6f9;
}

/* Header */
.header {
    background: #667eea;
    color: #fff;
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    margin: 0;
    font-size: 24px;
}

.header .user {
    font-size: 14px;
}

/* Layout */
.container {
    display: flex;
}

/* Sidebar */
.sidebar {
    width: 230px;
    background: #2f3542;
    min-height: calc(100vh - 70px);
    padding-top: 20px;
}

.sidebar a {
    display: block;
    color: #dfe4ea;
    padding: 15px 25px;
    text-decoration: none;
    font-size: 15px;
}

.sidebar a:hover {
    background: #57606f;
    color: #fff;
}

/* Content */
.content {
    flex: 1;
    padding: 30px;
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.card h2 {
    margin-top: 0;
    color: #333;
}
</style>
</head>

<body>

<!-- Header -->
<div class="header">
    <h1>Admin Dashboard</h1>
    <div class="user">
        ผู้ใช้งาน: <?= htmlspecialchars($_SESSION['aname']) ?>
    </div>
</div>

<!-- Main Layout -->
<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="customer.php">👥 จัดการลูกค้า</a>
        <a href="product.php">📦 จัดการสินค้า</a>
        <a href="order.php">🧾 จัดการคำสั่งซื้อ</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="card">
            <h2>ยินดีต้อนรับ</h2>
            <p>
                สวัสดีคุณ <strong><?= htmlspecialchars($_SESSION['aname']) ?></strong><br>
                คุณเข้าสู่ระบบเรียบร้อยแล้ว สามารถเลือกเมนูทางด้านซ้ายเพื่อจัดการข้อมูลต่าง ๆ ได้
            </p>
        </div>
    </div>

</div>

</body>
</html>
