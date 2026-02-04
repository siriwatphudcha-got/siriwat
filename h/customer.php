<?php require 'secure.php'; ?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>จัดการลูกค้า</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI',Tahoma;
    background:#f4f6f9;
}
.header{
    background:#667eea;
    color:#fff;
    padding:20px 30px;
    display:flex;
    justify-content:space-between;
}
.container{display:flex;}
.sidebar{
    width:230px;
    background:#2f3542;
    min-height:calc(100vh - 70px);
}
.sidebar a{
    display:block;
    color:#dfe4ea;
    padding:15px 25px;
    text-decoration:none;
}
.sidebar a:hover{background:#57606f;color:#fff;}
.content{flex:1;padding:30px;}
.card{
    background:#fff;
    padding:25px;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
table th, table td{
    border-bottom:1px solid #eee;
    padding:12px;
    text-align:left;
}
table th{background:#f1f3f6;}
</style>
</head>

<body>
<div class="header">
    <h2>Admin Dashboard</h2>
    <div>ผู้ใช้งาน: <?= $_SESSION['aname'] ?></div>
</div>

<div class="container">
<div class="sidebar">
    <a href="index2.php">🏠 Dashboard</a>
    <a href="customer.php">👥 ลูกค้า</a>
    <a href="product.php">📦 สินค้า</a>
    <a href="order.php">🧾 คำสั่งซื้อ</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
<div class="card">
    <h3>จัดการข้อมูลลูกค้า</h3>
    <table>
        <tr>
            <th>รหัสลูกค้า</th>
            <th>ชื่อลูกค้า</th>
            <th>อีเมล</th>
            <th>เบอร์โทร</th>
        </tr>
        <tr>
            <td>1</td>
            <td>สมชาย ใจดี</td>
            <td>somchai@email.com</td>
            <td>089xxxxxxx</td>
        </tr>
    </table>
</div>
</div>
</div>
</body>
</html>
