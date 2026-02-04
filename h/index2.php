<?php
require 'secure.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>
<body>

<h1>ยินดีต้อนรับ</h1>
<p>สวัสดีคุณ <?= htmlspecialchars($_SESSION['aname']) ?></p>

<ul>
    <li><a href="customer.php">จัดการลูกค้า</a></li>
    <li><a href="product.php">จัดการสินค้า</a></li>
    <li><a href="order.php">จัดการคำสั่งซื้อ</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
