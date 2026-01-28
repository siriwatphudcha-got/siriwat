<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "4199db"; 

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

$search_term = isset($_POST['a']) ? trim($_POST['a']) : "";
$kw = "%" . $search_term . "%";

$sql = "SELECT * FROM popsupermarket WHERE p_country LIKE ? OR p_product_name LIKE ? OR p_category LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $kw, $kw, $kw);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);
$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Stock Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --success: #10b981;
            --bg-body: #f1f5f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', 'Sarabun', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            margin: 0;
            padding: 20px;
        }

        .main-card {
            max-width: 1100px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 30px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f8fafc;
            padding-bottom: 20px;
        }

        h2 { margin: 0; font-weight: 600; color: var(--primary); }

        /* Search Bar UI */
        .search-wrapper {
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .input-control {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s;
        }

        .input-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        
        .btn-clear { 
            background: #e2e8f0; 
            color: var(--text-muted); 
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .table-responsive { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f8fafc;
            padding: 16px;
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.05em;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 15px;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover { background-color: #fbfcfd; }

        .img-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .badge-id {
            background: #eff6ff;
            color: var(--primary);
            padding: 4px 8px;
            border-radius: 6px;
            font-family: monospace;
            font-weight: bold;
        }

        .amount-text {
            font-weight: 600;
            color: var(--success);
            text-align: right;
        }

        .footer-total {
            background: #f8fafc;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

<div class="main-card">
    <div class="header-section">
        <h2>📦 Inventory Master</h2>
        <div style="color: var(--text-muted); font-size: 14px;">
            <?php echo date('d F Y'); ?>
        </div>
    </div>

    <div class="search-wrapper">
        <form method="post" class="search-form">
            <input type="text" name="a" class="input-control" 
                   placeholder="ค้นหาตามชื่อสินค้า, หมวดหมู่ หรือประเทศ..." 
                   value="<?php echo htmlspecialchars($search_term); ?>">
            <button type="submit" class="btn btn-primary">ค้นหาข้อมูล</button>
            <?php if($search_term): ?>
                <a href="index.php" class="btn btn-clear">ล้างค่า</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภท</th>
                    <th>ประเทศ</th>
                    <th style="text-align: right;">จำนวนเงิน</th>
                    <th style="text-align: center;">รูปภาพ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($rs) > 0) {
                    while ($data = mysqli_fetch_array($rs)): 
                        $total_amount += $data['p_amount'];
                ?>
                <tr>
                    <td><span class="badge-id">#<?php echo $data['p_order_id']; ?></span></td>
                    <td><strong><?php echo htmlspecialchars($data['p_product_name']); ?></strong></td>
                    <td><?php echo htmlspecialchars($data['p_category']); ?></td>
                    <td><?php echo htmlspecialchars($data['p_country']); ?></td>
                    <td class="amount-text"><?php echo number_format($data['p_amount'], 2); ?></td>
                    <td align="center">
                        <img src="images/<?php echo $data['p_product_name']; ?>.jpg" 
                             alt="product" 
                             class="img-thumb"
                             onerror="this.src='https://via.placeholder.com/48?text=N/A'">
                    </td>
                </tr>
                <?php 
                    endwhile; 
                } else {
                    echo "<tr><td colspan='6' class='no-data'>ไม่พบข้อมูลที่คุณค้นหาในระบบ</td></tr>";
                }
                ?>
            </tbody>
            <?php if ($total_amount > 0): ?>
            <tfoot>
                <tr class="footer-total">
                    <td colspan="4" style="text-align: right; padding-right: 20px;">ยอดรวมรวมทั้งสิ้น</td>
                    <td class="amount-text" style="color: var(--primary); border-bottom: 4px double #e2e8f0;">
                        <?php echo number_format($total_amount, 2); ?>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

</body>
</html>