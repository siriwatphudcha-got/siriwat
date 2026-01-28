<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ตารางรายการสั่งซื้อ</title>

<style>
:root{
    --primary:#2c3e50;
    --bg:#f4f6f9;
    --card:#ffffff;
    --hover:#f1f1f1;
}

body{
    font-family:"Segoe UI", Tahoma, sans-serif;
    background:var(--bg);
    margin:0;
}

h2{
    text-align:center;
    margin:20px 0;
}

table{
    width:90%;
    margin:20px auto;
    border-collapse:collapse;
    background:var(--card);
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

th{
    background:var(--primary);
    color:white;
    padding:12px;
    text-align:center;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

.amount{
    text-align:right;
}

tr:hover{
    background:var(--hover);
}

img{
    width:55px;
    height:55px;
    object-fit:cover;
    border-radius:6px;
}

.empty{
    text-align:center;
    padding:20px;
    color:#888;
}
</style>
</head>

<body>

<h2>66010914019 สิริวัฒน์ พุฒชา (ก๊อต)</h2>

<table>
<thead>
<tr>
    <th>Order ID</th>
    <th>ชื่อสินค้า</th>
    <th>ประเภทสินค้า</th>
    <th>วันที่</th>
    <th>ประเทศ</th>
    <th>จำนวนเงิน</th>
    <th>รูปภาพ</th>
</tr>
</thead>

<tbody>
<?php
require_once("connectdb.php");

$sql = "SELECT p_order_id, p_product_name, p_category, p_date, p_country, p_amount 
        FROM popsupermarket";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $imagePath = "images/".$row['p_product_name'].".jpg";
?>
<tr>
    <td><?= htmlspecialchars($row['p_order_id']) ?></td>
    <td><?= htmlspecialchars($row['p_product_name']) ?></td>
    <td><?= htmlspecialchars($row['p_category']) ?></td>
    <td><?= htmlspecialchars($row['p_date']) ?></td>
    <td><?= htmlspecialchars($row['p_country']) ?></td>
    <td class="amount"><?= number_format($row['p_amount'],0) ?></td>
    <td>
        <?php if(file_exists($imagePath)): ?>
            <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($row['p_product_name']) ?>">
        <?php else: ?>
            <span>-</span>
        <?php endif; ?>
    </td>
</tr>
<?php
    }
}else{
?>
<tr>
    <td colspan="7" class="empty">ไม่พบข้อมูลรายการสั่งซื้อ</td>
</tr>
<?php
}
mysqli_close($conn);
?>
</tbody>
</table>

</body>
</html>
