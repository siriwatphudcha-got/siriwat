<?php
include("connect.php");

$sql = "SELECT * FROM tb_66010914019 ORDER BY song_id ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แสดงข้อมูลเพลงฮิต</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">ข้อมูลเพลงฮิต</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>รหัสเพลง</th>
                <th>ชื่อเพลง</th>
                <th>ศิลปิน</th>
                <th>สังกัด</th>
                <th>แนวเพลง</th>
                <th>รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['song_id'] . "</td>";
                    echo "<td>" . $row['song_name'] . "</td>";
                    echo "<td>" . $row['artist'] . "</td>";
                    echo "<td>" . $row['label_name'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['detail'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูล</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="text-center">
        <a href="form_66010914019.php" class="btn btn-primary">เพิ่มข้อมูลเพลง</a>
    </div>
</div>
</body>
</html>