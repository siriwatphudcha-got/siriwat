<?php
include_once("connectdb.php"); // มั่นใจว่าไฟล์นี้เชื่อมต่อฐานข้อมูลถูกต้อง

// 1. รับค่าการค้นหา (ถ้ามี)
$search_term = isset($_POST['a']) ? trim($_POST['a']) : "";
$kw = "%" . $search_term . "%";

// 2. SQL สำหรับสรุปยอดขายแยกตามประเทศ (ใช้ SUM และ GROUP BY)
// เราจะเลือกชื่อประเทศ และผลรวมของยอดเงิน (p_amount)
$sql = "SELECT p_country, SUM(p_amount) AS total_sales, COUNT(p_order_id) AS order_count 
        FROM popsupermarket 
        WHERE p_country LIKE ? 
        GROUP BY p_country 
        ORDER BY total_sales DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $kw);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);

$grand_total = 0; // ตัวแปรสำหรับยอดรวมสุทธิทุกประเทศ
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Sales Report by Country</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f4f7f6; padding: 30px; }
        .report-container { max-width: 800px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        h2 { color: #2c3e50; text-align: center; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        
        .search-box { margin-bottom: 20px; display: flex; gap: 10px; }
        .input-search { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn-search { background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #34495e; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }
        
        .text-right { text-align: right; }
        .amount { font-weight: bold; color: #27ae60; }
        .footer-row { background: #ecf0f1; font-size: 1.2rem; font-weight: bold; }
        .flag-icon { margin-right: 10px; font-size: 1.2rem; }
    </style>
</head>
<body>

<div class="report-container">
    <h2>🌍 รายงานสรุปยอดขายรายประเทศ</h2>

    <form method="post" class="search-box">
        <input type="text" name="a" class="input-search" placeholder="พิมพ์ชื่อประเทศที่ต้องการค้นหา..." value="<?php echo htmlspecialchars($search_term); ?>">
        <button type="submit" class="btn-search">ค้นหา</button>
    </form>

    <table>
        <thead>
            <tr>
                <th width="10%">ลำดับ</th>
                <th>ชื่อประเทศ</th>
                <th class="text-right">จำนวนออเดอร์</th>
                <th class="text-right">ยอดขายรวม</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            if (mysqli_num_rows($rs) > 0) {
                while ($data = mysqli_fetch_array($rs)): 
                    $grand_total += $data['total_sales'];
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td>
                    <span class="flag-icon">📍</span>
                    <strong><?php echo htmlspecialchars($data['p_country']); ?></strong>
                </td>
                <td class="text-right"><?php echo number_format($data['order_count']); ?> รายการ</td>
                <td class="text-right amount"><?php echo number_format($data['total_sales'], 2); ?></td>
            </tr>
            <?php 
                endwhile; 
            } else {
                echo "<tr><td colspan='4' style='text-align:center; padding:30px;'>ไม่พบข้อมูลยอดขาย</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="footer-row">
                <td colspan="3" class="text-right">ยอดขายรวมทั้งสิ้น (Grand Total):</td>
                <td class="text-right" style="color: #2980b9; border-bottom: 4px double #bdc3c7;">
                    <?php echo number_format($grand_total, 2); ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>