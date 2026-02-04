<?php
require_once 'secure/auth_guard.php';
require_once 'connectdb.php';

$stmt = $conn->query("SELECT * FROM customer ORDER BY id DESC");
$data = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Customer</title></head>
<body>
<h1>Customer</h1>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Email</th></tr>
<?php foreach ($data as $c): ?>
<tr>
<td><?= $c['id'] ?></td>
<td><?= htmlspecialchars($c['name']) ?></td>
<td><?= htmlspecialchars($c['email']) ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
