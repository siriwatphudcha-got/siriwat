<?php
require_once 'secure/auth_guard.php';
require_once 'connectdb.php';

$stmt = $conn->query(
    "SELECT o.id, c.name AS customer, p.name AS product, o.qty
     FROM orders o
     JOIN customer c ON o.customer_id = c.id
     JOIN product p ON o.product_id = p.id
     ORDER BY o.id DESC"
);
$data = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Order</title></head>
<body>
<h1>Order</h1>
<table border="1">
<tr><th>ID</th><th>Customer</th><th>Product</th><th>Qty</th></tr>
<?php foreach ($data as $o): ?>
<tr>
<td><?= $o['id'] ?></td>
<td><?= htmlspecialchars($o['customer']) ?></td>
<td><?= htmlspecialchars($o['product']) ?></td>
<td><?= $o['qty'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
