<?php
include_once("connectdb.php");

// SQL สรุปยอดขายรายเดือน
$sql = "SELECT MONTH(p_date) AS Month, 
               SUM(p_amount) AS Total_Sales 
        FROM popsupermarket
        GROUP BY MONTH(p_date)
        ORDER BY Month";

$rs = mysqli_query($conn, $sql);

$months = [];
$sales = [];
$monthNames = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
               "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

while ($data = mysqli_fetch_array($rs)) {
    $months[] = $monthNames[$data['Month']]; // แปลงเลขเดือนเป็นชื่อเดือน
    $sales[] = (float)$data['Total_Sales'];
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - สิริวัฒน์ พุฒชา (ก็อต)</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --bg: #f3f4f6;
            --card: #ffffff;
            --primary: #6366f1; /* Indigo */
            --secondary: #ec4899; /* Pink */
        }
        body {
            font-family: 'Inter', 'Sarabun', sans-serif;
            background-color: var(--bg);
            margin: 0;
            padding: 40px 20px;
            color: #1f2937;
        }
        .container { max-width: 1100px; margin: 0 auto; }
        header { margin-bottom: 30px; text-align: center; }
        h1 { margin: 0; font-weight: 700; color: #111827; }
        
        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr; /* กราฟแท่งใหญ่กว่ากราฟโดนัท */
            gap: 20px;
        }
        @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
        
        .card {
            background: var(--card);
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .card h2 { font-size: 1.1rem; margin-bottom: 20px; color: #4b5563; }
        
        .chart-box { position: relative; height: 350px; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        th { background: #f9fafb; padding: 12px; text-align: left; font-size: 0.8rem; text-transform: uppercase; color: #6b7280; }
        td { padding: 12px; border-top: 1px solid #f3f4f6; }
        .text-right { text-align: right; }
        .font-bold { font-weight: 600; }
    </style>
</head>

<body>

<div class="container">
    <header>
        <h1>รายงานยอดขายประจำปี</h1>
        <p style="color: #6b7280;">ผู้จัดทำ: สิริวัฒน์ พุฒชา (ก็อต)</p>
    </header>

    <div class="grid">
        <div class="card">
            <h2>📊 ยอดขายรายเดือน (เปรียบเทียบ)</h2>
            <div class="chart-box">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="card">
            <h2>🍩 สัดส่วนยอดขาย</h2>
            <div class="chart-box">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top: 20px;">
        <h2>📝 รายละเอียดตัวเลข</h2>
        <table>
            <thead>
                <tr>
                    <th>เดือน</th>
                    <th class="text-right">ยอดขาย (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($months as $index => $name): ?>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td class="text-right font-bold"><?php echo number_format($sales[$index], 0); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const labels = <?php echo json_encode($months); ?>;
    const dataSales = <?php echo json_encode($sales); ?>;

    // 1. กราฟแท่ง (Bar Chart)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขาย',
                data: dataSales,
                backgroundColor: 'rgba(99, 102, 241, 0.8)',
                borderRadius: 8,
                hoverBackgroundColor: '#6366f1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });

    // 2. กราฟโดนัท (Doughnut Chart)
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataSales,
                backgroundColor: [
                    '#6366f1', '#ec4899', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6',
                    '#f43f5e', '#06b6d4', '#84cc16', '#71717a', '#fb7185', '#6d28d9'
                ],
                hoverOffset: 15,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 10, padding: 15 } }
            },
            cutout: '70%' // ความหนาของโดนัท
        }
    });
</script>

</body>
</html>
<?php mysqli_close($conn); ?>