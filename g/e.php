<?php
include_once("connectdb.php");

$search_term = isset($_POST['a']) ? trim($_POST['a']) : "";
$kw = "%" . $search_term . "%";

// SQL สรุปยอดขายรายประเทศ
$sql = "SELECT p_country, SUM(p_amount) AS total_sales 
        FROM popsupermarket 
        WHERE p_country LIKE ? 
        GROUP BY p_country 
        ORDER BY total_sales DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $kw);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);

// เตรียมตัวแปรสำหรับส่งค่าไปให้กราฟ (Chart.js)
$countries = [];
$sales = [];
$table_data = [];

while ($row = mysqli_fetch_array($rs)) {
    $countries[] = $row['p_country'];
    $sales[] = $row['total_sales'];
    $table_data[] = $row; // เก็บไว้ใช้แสดงตารางด้วย
}

$grand_total = array_sum($sales);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Sales Analytics Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root { --primary: #3b82f6; --success: #10b981; --dark: #1e293b; }
        body { font-family: 'Inter', 'Sarabun', sans-serif; background-color: #f8fafc; margin: 0; padding: 20px; }
        .dashboard { max-width: 1000px; margin: auto; display: flex; flex-direction: column; gap: 20px; }
        .card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        
        h2 { color: var(--dark); margin-top: 0; display: flex; align-items: center; gap: 10px; }
        
        /* สไตล์ตาราง */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { text-align: left; padding: 12px; background: #f1f5f9; color: #64748b; font-size: 13px; text-transform: uppercase; }
        td { padding: 12px; border-bottom: 1px solid #f1f5f9; }
        .amount { font-weight: 600; color: var(--success); text-align: right; }
        .grand-total { background: #f8fafc; font-weight: bold; font-size: 1.1rem; }

        /* ส่วนของกราฟ */
        .chart-container { position: relative; height: 350px; width: 100%; }
        
        @media (max-width: 600px) { .dashboard { padding: 10px; } }
    </style>
</head>
<body>

<div class="dashboard">
    <div class="card">
        <h2>📊 สถิติยอดขายแยกตามประเทศ</h2>
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <div class="card">
        <h2>📑 รายละเอียดข้อมูล</h2>
        <table>
            <thead>
                <tr>
                    <th>ประเทศ</th>
                    <th style="text-align: right;">ยอดขายรวม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($table_data as $data): ?>
                <tr>
                    <td>📍 <?php echo htmlspecialchars($data['p_country']); ?></td>
                    <td class="amount"><?php echo number_format($data['total_sales'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($table_data)) echo "<tr><td colspan='2' style='text-align:center;'>ไม่พบข้อมูล</td></tr>"; ?>
            </tbody>
            <tfoot>
                <tr class="grand-total">
                    <td style="text-align: right;">ยอดรวมสุทธิ:</td>
                    <td class="amount" style="color: var(--primary); font-size: 1.3rem;">
                        <?php echo number_format($grand_total, 2); ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
// --- ส่วนของ JavaScript สำหรับวาดกราฟ ---

const ctx = document.getElementById('salesChart').getContext('2d');

// ดึงข้อมูลจาก PHP ที่เตรียมไว้ในรูปแบบ Array
const countries = <?php echo json_encode($countries); ?>;
const salesData = <?php echo json_encode($sales); ?>;

new Chart(ctx, {
    type: 'bar', // เปลี่ยนเป็น 'pie' หรือ 'line' ได้ตามต้องการ
    data: {
        labels: countries,
        datasets: [{
            label: 'ยอดขายรวม (บาท)',
            data: salesData,
            backgroundColor: 'rgba(59, 130, 246, 0.6)', // สีฟ้าโปร่งแสง
            borderColor: '#3b82f6', // สีฟ้าเส้นขอบ
            borderWidth: 2,
            borderRadius: 8,
            hoverBackgroundColor: '#2563eb'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }, // ปิดตัวอธิบายชื่อกราฟด้านบนเพื่อให้ดูคลีน
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { display: false },
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString() + ' ฿';
                    }
                }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});
</script>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>