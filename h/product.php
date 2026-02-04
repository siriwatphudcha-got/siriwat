<?php
require_once 'secure/auth_guard.php';
require_once 'connectdb.php';

$stmt = $conn->query("SELECT * FROM product ORDER BY id DESC");
$data = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Product</title></head>
<body>
<h1>Product</h1>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Price</th></tr>
<?php foreach ($data as $p): ?>
<tr>
<td><?= $p['id'] ?></td>
<td><?= htmlspecialchars($p['name']) ?></td>
<td><?= number_format($p['price'],2) ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
