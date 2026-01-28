<?php
include_once("connectdb.php");

// 1. Security: ป้องกัน SQL Injection ด้วย Prepared Statements
$kw = isset($_POST['a']) ? "%" . $_POST['a'] . "%" : "%%";
$sql = "SELECT * FROM popsupermarket WHERE p_country LIKE ? OR p_product_name LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $kw, $kw);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);
$total = 0;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard | World Class Design</title>
    <style>
        /* 2. Modern CSS UI Design */
        :root {
            --primary-color: #2563eb;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-gray: #f9fafb;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            padding: 40px 20px;
            color: var(--text-dark);
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        h2 {
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        thead {
            background-color: var(--bg-gray);
        }

        th {
            text-align: left;
            padding: 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-light);
            border-bottom: 2px solid #edf2f7;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #f8fafc;
            transition: 0.2s;
        }

        /* ตกแต่งรูปภาพ */
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        /* ตกแต่งตัวเลขยอดรวม */
        .total-row {
            background-color: #fdfdfd;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .amount-cell {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #059669;
        }

        /* Responsive */
        @media (max-width: 768px) {
            table { display: block; overflow-x: auto; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>รายการสินค้าในระบบ</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>ชื่อสินค้า</th>
                <th>ประเภท</th>
                <th>วันที่</th>
                <th>ประเทศ</th>
                <th style="text-align: right;">จำนวนเงิน</th>
                <th>รูปภาพ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_array($rs)): 
                $total += $data['p_amount'];
            ?>
            <tr>
                <td>#<?php echo htmlspecialchars($data['p_order_id']); ?></td>
                <td><strong><?php echo htmlspecialchars($data['p_product_name']); ?></strong></td>
                <td><?php echo htmlspecialchars($data['p_category']); ?></td>
                <td><?php echo date("d/m/Y", strtotime($data['p_date'])); ?></td>
                <td><?php echo htmlspecialchars($data['p_country']); ?></td>
                <td align="right" class="amount-cell">
                    <?php echo number_format($data['p_amount'], 2); ?>
                </td>
                <td>
                    <img src="images/<?php echo $data['p_product_name']; ?>.jpg" 
                         alt="Product" 
                         class="product-img"
                         onerror="this.src='https://via.placeholder.com/50?text=No+Img';">
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" align="right">ยอดรวมรวมทั้งสิ้น:</td>
                <td align="right" style="color: var(--primary-color);">
                    <?php echo number_format($total, 2); ?>
                </td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

</body>
</html>