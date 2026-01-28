<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ฟอร์มรับข้อมูล - สิริวัฒน์ พุดชา (ก็อต) </title>

<!-- Bootstrap 5.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">ฟอร์มรับข้อมูล - สิริวัฒน์ พุดชา (ก็อต)</h3>
        </div>

        <div class="card-body">
            <form method="post" action="">
                
                <div class="mb-3">
                    <label class="form-label">ชื่อ - สกุล</label>
                    <input type="text" name="fullname" class="form-control" autofocus required>
                </div>

                <div class="mb-3">
                    <label class="form-label">เบอร์โทร</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ส่วนสูง (ซม.)</label>
                    <input type="number" name="height" min="100" max="200" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ที่อยู่</label>
                    <textarea name="address" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">วันเดือนปีเกิด</label>
                    <input type="date" name="birthday" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">สีที่ชอบ</label><br>
                    <input type="color" name="color" class="form-control form-control-color" value="#000000">
                </div>

                <div class="mb-4">
                    <label class="form-label">สาขาวิชา</label>
                    <select name="major" class="form-select">
                        <option value="การบัญชี">การบัญชี</option>
                        <option value="การตลาด">การตลาด</option>
                        <option value="การจัดการ">การจัดการ</option>
                        <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="Submit" class="btn btn-success">✔ สมัครสมาชิก</button>
                    <button type="reset" class="btn btn-secondary">ล้างข้อมูล</button>

                    <button type="button" 
                        class="btn btn-danger"
                        ondblclick="alert('กดทำไมจร๊ะ!!!!');">
                        อย่ากด
                    </button>

                    <button type="button" class="btn btn-warning"
                        onclick="window.location='https://www.youtube.com/watch?v=tn7_CFkr6Oo&list=RDm4lNSIy_bUg&index=3';">
                        🎵 เพลง ยาพิษ Bodyslam
                    </button>

                    <button type="button" class="btn btn-info text-white"
                        onclick="window.print();">
                        🖨 พิมพ์
                    </button>
                </div>

            </form>
        </div>
    </div>

    <hr class="my-4">

    <!-- PHP ส่วนแสดงผล -->
    <?php
if (isset($_POST['Submit'])) {

    $fullname = $_POST['fullname'];
    $phone    = $_POST['phone'];
    $height   = $_POST['height'];
    $address  = $_POST['address'];
    $birthday = $_POST['birthday'];
    $color    = $_POST['color'];
    $major    = $_POST['major'];

    include_once("connectdb.php");

    mysqli_set_charset($conn, "utf8mb4");

    $sql = "INSERT INTO register
            (r_name, r_phone, r_height, r_address, r_birthday, r_color, r_major)
            VALUES
            ('$fullname', '$phone', '$height', '$address', '$birthday', '$color', '$major')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
    } else {
        echo "SQL ERROR: " . mysqli_error($conn);
    }
}
?>


</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>