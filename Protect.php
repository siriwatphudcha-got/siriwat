ไฟล์กลางที่ใช้ร่วมกัน (แนะนำทำก่อน)
connect.php
<?php
// ===== connect.php =====
// หน้าที่: เชื่อมต่อฐานข้อมูล MySQL ด้วย mysqli

$host = "localhost";
$user = "root";
$pass = "Golf@2004";
$db   = "4199db";   // เปลี่ยนเป็นชื่อฐานข้อมูลของอาจารย์

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    // ถ้าเชื่อมต่อไม่ได้ ให้หยุดและแสดง error
    die("DB Connect Failed: " . mysqli_connect_error());
}

// ตั้งค่าให้รองรับภาษาไทย
mysqli_set_charset($conn, "utf8mb4");
?>
helpers.php (ช่วย sanitize + upload รูป)
<?php
// ===== helpers.php =====
// หน้าที่: รวมฟังก์ชันช่วยเหลือที่ใช้บ่อย เช่น กัน XSS และอัปโหลดรูป

function e($str) {
    // กัน XSS ตอนแสดงผล
    return htmlspecialchars($str ?? "", ENT_QUOTES, "UTF-8");
}

function upload_image($file, $uploadDir = "uploads") {
    // อัปโหลดรูปแบบปลอดภัย (พื้นฐานสำหรับ Lab)
    // คืนค่า: path ของไฟล์ที่อัปโหลดสำเร็จ หรือ "" ถ้าไม่อัปโหลด

    if (!isset($file) || $file["error"] === UPLOAD_ERR_NO_FILE) {
        return "";
    }

    // ตรวจ error
    if ($file["error"] !== UPLOAD_ERR_OK) {
        return "";
    }

    // จำกัดนามสกุลที่อนุญาต (กันไฟล์แปลก)
    $allowed = ["jpg", "jpeg", "png", "gif", "webp"];
    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        return "";
    }

    // จำกัดขนาด (เช่น 2MB)
    if ($file["size"] > 2 * 1024 * 1024) {
        return "";
    }

    // สร้างโฟลเดอร์ถ้ายังไม่มี
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // ตั้งชื่อไฟล์ใหม่กันชนกัน
    $newName = date("YmdHis") . "_" . bin2hex(random_bytes(4)) . "." . $ext;
    $target  = $uploadDir . "/" . $newName;

    // ย้ายไฟล์ไปยังโฟลเดอร์
    if (move_uploaded_file($file["tmp_name"], $target)) {
        return $target; // path เก็บลง DB
    }

    return "";
}
?>
🥇 โจทย์ 1 (โอกาสออกสูงมาก): Product CRUD + Search + Upload รูป
โครงสร้างตาราง (ตัวอย่าง)

product(product_id, product_name, price, category, image_path)

1.1 product_list.php (SELECT + Search + ปุ่มลบ)
<?php
require "connect.php";
require "helpers.php";

// รับคำค้นหา
$q = isset($_GET["q"]) ? trim($_GET["q"]) : "";
$like = "%$q%";

// SELECT แบบค้นหา (LIKE) + prepared statement
$sql = "SELECT product_id, product_name, price, category, image_path
        FROM product
        WHERE product_name LIKE ? OR category LIKE ?
        ORDER BY product_id DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $like, $like);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title>Product List</title>
</head>
<body>

<h2>รายการสินค้า</h2>

<!-- ฟอร์มค้นหา -->
<form method="get">
  <input name="q" value="<?= e($q) ?>" placeholder="ค้นหาชื่อ/หมวด">
  <button type="submit">ค้นหา</button>
  <a href="product_add.php">+ เพิ่มสินค้า</a>
</form>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th><th>รูป</th><th>ชื่อสินค้า</th><th>หมวด</th><th>ราคา</th><th>จัดการ</th>
  </tr>

  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= e($row["product_id"]) ?></td>
      <td>
        <?php if (!empty($row["image_path"])): ?>
          <img src="<?= e($row["image_path"]) ?>" width="60" alt="">
        <?php else: ?>
          -
        <?php endif; ?>
      </td>
      <td><?= e($row["product_name"]) ?></td>
      <td><?= e($row["category"]) ?></td>
      <td align="right"><?= number_format((float)$row["price"], 2) ?></td>
      <td>
        <!-- ลบแบบส่ง id ผ่าน GET -->
        <a href="product_delete.php?id=<?= urlencode($row["product_id"]) ?>"
           onclick="return confirm('ยืนยันลบสินค้า?')">ลบ</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
1.2 product_add.php (ฟอร์ม INSERT + Upload รูป)
<?php
require "helpers.php";
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title>Add Product</title>
</head>
<body>

<h2>เพิ่มสินค้า</h2>

<!-- ต้องใส่ enctype เมื่อมี file upload -->
<form method="post" action="product_save.php" enctype="multipart/form-data">
  รหัสสินค้า: <input name="product_id" required><br><br>
  ชื่อสินค้า: <input name="product_name" required><br><br>
  หมวด: <input name="category" required><br><br>
  ราคา: <input type="number" step="0.01" name="price" required><br><br>

  รูปสินค้า: <input type="file" name="image"><br><br>

  <button type="submit">บันทึก</button>
  <a href="product_list.php">กลับ</a>
</form>

</body>
</html>
1.3 product_save.php (INSERT)
<?php
require "connect.php";
require "helpers.php";

// รับค่าจากฟอร์ม
$product_id   = $_POST["product_id"] ?? "";
$product_name = $_POST["product_name"] ?? "";
$category     = $_POST["category"] ?? "";
$price        = $_POST["price"] ?? 0;

// อัปโหลดรูป (ถ้ามี) แล้วได้ path เก็บลง DB
$image_path = upload_image($_FILES["image"] ?? null, "uploads/products");

// INSERT แบบ prepared
$sql = "INSERT INTO product (product_id, product_name, price, category, image_path)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// s=string, d=double
mysqli_stmt_bind_param($stmt, "ssdss", $product_id, $product_name, $price, $category, $image_path);

mysqli_stmt_execute($stmt);

// ปิด และกลับหน้า list
mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: product_list.php");
exit;
?>
1.4 product_delete.php (DELETE)
<?php
require "connect.php";

// รับ id จาก URL
$id = $_GET["id"] ?? "";

// DELETE แบบ prepared กัน SQL Injection
$sql = "DELETE FROM product WHERE product_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: product_list.php");
exit;
?>
🥈 โจทย์ 2: ระบบสมาชิก (Register/Login/List/Delete) + อัปโหลดรูปโปรไฟล์

ตารางตัวอย่าง
customer(id, username, password_hash, fullname, avatar_path)

2.1 register.php
<!doctype html>
<html lang="th">
<meta charset="utf-8">
<title>Register</title>
<body>
<h2>สมัครสมาชิก</h2>

<form method="post" action="register_save.php" enctype="multipart/form-data">
  Username: <input name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  Fullname: <input name="fullname" required><br><br>

  รูปโปรไฟล์: <input type="file" name="avatar"><br><br>

  <button type="submit">สมัคร</button>
  <a href="login.php">ไปหน้า Login</a>
</form>
</body>
</html>
2.2 register_save.php (INSERT + password_hash)
<?php
require "connect.php";
require "helpers.php";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";
$fullname = $_POST["fullname"] ?? "";

// hash รหัสผ่าน (สำคัญมาก อาจารย์ชอบ)
$hash = password_hash($password, PASSWORD_DEFAULT);

// upload avatar (ถ้ามี)
$avatar_path = upload_image($_FILES["avatar"] ?? null, "uploads/avatars");

// INSERT
$sql = "INSERT INTO customer (username, password_hash, fullname, avatar_path)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $username, $hash, $fullname, $avatar_path);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: login.php");
exit;
?>
2.3 login.php
<!doctype html>
<html lang="th">
<meta charset="utf-8">
<title>Login</title>
<body>
<h2>เข้าสู่ระบบ</h2>

<form method="post" action="check_login.php">
  Username: <input name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <button type="submit">Login</button>
</form>

<p><a href="register.php">สมัครสมาชิก</a></p>
</body>
</html>
2.4 check_login.php (SELECT + password_verify)
<?php
require "connect.php";

session_start();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

// SELECT user ตาม username
$sql = "SELECT id, username, password_hash, fullname
        FROM customer
        WHERE username = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user["password_hash"])) {
    // ถ้ารหัสผ่านถูก -> สร้าง session
    $_SESSION["uid"] = $user["id"];
    $_SESSION["name"] = $user["fullname"];

    header("Location: customer_list.php");
    exit;
} else {
    echo "Login ไม่สำเร็จ";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
2.5 customer_list.php (SELECT + Delete link)
<?php
require "connect.php";
require "helpers.php";

session_start();
if (!isset($_SESSION["uid"])) {
  die("กรุณา Login ก่อน");
}

$sql = "SELECT id, username, fullname, avatar_path FROM customer ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="th">
<meta charset="utf-8">
<title>Customers</title>
<body>

<h2>รายชื่อสมาชิก</h2>
<p>สวัสดี, <?= e($_SESSION["name"]) ?> | <a href="logout.php">Logout</a></p>

<table border="1" cellpadding="8">
<tr><th>ID</th><th>Avatar</th><th>Username</th><th>Fullname</th><th>ลบ</th></tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
  <td><?= e($row["id"]) ?></td>
  <td>
    <?php if ($row["avatar_path"]): ?>
      <img src="<?= e($row["avatar_path"]) ?>" width="50" alt="">
    <?php else: ?> - <?php endif; ?>
  </td>
  <td><?= e($row["username"]) ?></td>
  <td><?= e($row["fullname"]) ?></td>
  <td>
    <a href="customer_delete.php?id=<?= urlencode($row["id"]) ?>"
       onclick="return confirm('ยืนยันลบ?')">ลบ</a>
  </td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>
<?php mysqli_close($conn); ?>
2.6 customer_delete.php
<?php
require "connect.php";
session_start();
if (!isset($_SESSION["uid"])) die("กรุณา Login ก่อน");

$id = $_GET["id"] ?? "";

// ลบด้วย prepared
$sql = "DELETE FROM customer WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: customer_list.php");
exit;
?>
2.7 logout.php
<?php
session_start();
session_destroy();
header("Location: login.php");
exit;
?>
🥉 โจทย์ 3: Order + คำนวณยอดรวม (SUM)

ตารางตัวอย่าง: orders(order_id, product_name, quantity, price)

3.1 order_add.php
<!doctype html>
<html lang="th">
<meta charset="utf-8">
<title>Add Order</title>
<body>
<h2>เพิ่มคำสั่งซื้อ</h2>

<form method="post" action="order_save.php">
  Order ID: <input name="order_id" required><br><br>
  Product: <input name="product_name" required><br><br>
  Quantity: <input type="number" name="quantity" min="1" required><br><br>
  Price: <input type="number" step="0.01" name="price" required><br><br>

  <button type="submit">บันทึก</button>
  <a href="order_list.php">ดูรายการ</a>
</form>
</body>
</html>
3.2 order_save.php (INSERT)
<?php
require "connect.php";

$order_id     = $_POST["order_id"] ?? "";
$product_name = $_POST["product_name"] ?? "";
$quantity     = (int)($_POST["quantity"] ?? 0);
$price        = (float)($_POST["price"] ?? 0);

// INSERT
$sql = "INSERT INTO orders (order_id, product_name, quantity, price)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssid", $order_id, $product_name, $quantity, $price);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: order_list.php");
exit;
?>
3.3 order_list.php (SELECT + SUM)
<?php
require "connect.php";
require "helpers.php";

// ดึงรายการทั้งหมด
$sql = "SELECT order_id, product_name, quantity, price FROM orders ORDER BY order_id DESC";
$result = mysqli_query($conn, $sql);

// คำนวณยอดรวมด้วย SQL (จุดที่อาจารย์ชอบ)
$sqlTotal = "SELECT SUM(quantity * price) AS total FROM orders";
$totalRow = mysqli_fetch_assoc(mysqli_query($conn, $sqlTotal));
$total = (float)($totalRow["total"] ?? 0);
?>
<!doctype html>
<html lang="th">
<meta charset="utf-8">
<title>Orders</title>
<body>

<h2>รายการสั่งซื้อ</h2>
<p><a href="order_add.php">+ เพิ่มคำสั่งซื้อ</a></p>

<table border="1" cellpadding="8">
<tr><th>Order</th><th>สินค้า</th><th>จำนวน</th><th>ราคา</th><th>รวม</th></tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
  <td><?= e($row["order_id"]) ?></td>
  <td><?= e($row["product_name"]) ?></td>
  <td align="right"><?= (int)$row["quantity"] ?></td>
  <td align="right"><?= number_format((float)$row["price"], 2) ?></td>
  <td align="right"><?= number_format((int)$row["quantity"] * (float)$row["price"], 2) ?></td>
</tr>
<?php endwhile; ?>

<tr>
  <td colspan="4" align="right"><b>ยอดรวมทั้งหมด</b></td>
  <td align="right"><b><?= number_format($total, 2) ?></b></td>
</tr>
</table>

</body>
</html>
<?php mysqli_close($conn); ?>
🏅 โจทย์ 4: SELECT แบบ JOIN (2 ตาราง)

ตารางตัวอย่าง
customers(id, name)
orders(id, customer_id, product)

join_view.php
<?php
require "connect.php";
require "helpers.php";

// JOIN เพื่อแสดง "ชื่อลูกค้า + สินค้า"
$sql = "SELECT c.name AS customer_name, o.product AS product_name
        FROM orders o
        JOIN customers c ON o.customer_id = c.id
        ORDER BY o.id DESC";

$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="th">
<meta charset="utf-8">
<title>JOIN View</title>
<body>

<h2>รายการสั่งซื้อ (JOIN)</h2>

<table border="1" cellpadding="8">
<tr><th>ลูกค้า</th><th>สินค้า</th></tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
  <td><?= e($row["customer_name"]) ?></td>
  <td><?= e($row["product_name"]) ?></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
<?php mysqli_close($conn); ?>