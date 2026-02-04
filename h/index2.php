<?php require_once 'secure/auth_guard.php'; ?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
<h1>Welcome <?= htmlspecialchars($_SESSION['aname']) ?></h1>
<ul>
    <li><a href="customer.php">Customer</a></li>
    <li><a href="product.php">Product</a></li>
    <li><a href="order.php">Order</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>
