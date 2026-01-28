<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ฟอร์มรับข้อมูล - สิริวัฒน์ พุดชา (ก็อต)</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* พื้นหลังระดับพรีเมียม */
    body {
        background: radial-gradient(circle at top left, #6a11cb, #2575fc);
        min-height: 100vh;
        font-family: 'Prompt', sans-serif;
        padding: 40px 0;
        color: #fff;
    }

    /* การ์ดสไตล์ Glassmorphism */
    .glass-card {
        backdrop-filter: blur(18px);
        background: rgba(255,255,255,0.10);
        border-radius: 22px;
        padding: 25px;
        border: 1px solid rgba(255,255,255,0.35);
        box-shadow: 0 8px 30px rgba(0,0,0,0.25);
    }

    .glass-header {
        background: linear-gradient(135deg, #ff4b2b, #ff416c);
        color: white;
        padding: 20px;
        border-radius: 18px;
        margin: -25px -25px 20px -25px;
        text-shadow: 0 3px 8px rgba(0,0,0,0.3);
        text-align: center;
    }

    /* ช่องกรอกแบบ Neon Focus */
    .form-control, .form-select {
        border-radius: 14px;
        padding: 12px;
        background: rgba(255,255,255,0.15);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.4);
        transition: 0.3s;
    }
    .form-control:focus, .form-select:focus {
        background: rgba(255,255,255,0.25);
        border-color: #00eaff;
        box-shadow: 0 0 12px #00eaff;
        color: #fff;
    }

    /* ปุ่มสุดพรีเมียม */
    .btn-modern {
        border-radius: 12px;
        padding: 12px 22px;
        font-weight: 600;
        transition: 0.25s;
        border: none;
    }
    .btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.35);
    }

    /* สีปุ่มใหม่ */
    .btn-success { background: linear-gradient(135deg, #00b09b, #96c93d); }
    .btn-danger { background: linear-gradient(135deg, #d31027, #ea384d); }
    .btn-warning { background: linear-gradient(135deg, #ffb347, #ffcc33); color: #000; }
    .btn-info { background: linear-gradient(135deg, #2193b0, #6dd5ed); }
    .btn-secondary { background: rgba(255,255,255,0.4); color: #000; }

    /* การ์ดแสดงผล */
    .result-card {
        backdrop-filter: blur(15px);
        background: rgba(0,0,0,0.4);
        border-radius: 18px;
        color: #fff;
        padding: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }
</style>

</head>
<body>

<div class="container col-lg-6 col-md-8 col-11">

    <div class="glass-card shadow-lg">
        <div class="glass-header">
            <h2 class="mb-0">ฟอร์มรับข้อมูล - สิริวัฒน์ พุดชา (ก็อต) - Chat GPT</h2>
        </div>

        <form method="post" action="" class="mt-3">

            <div class="mb-3">
                <label class="form-label text-white">ชื่อ - สกุล</label>
                <input type="text" name="fullname" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">เบอร์โทร</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">ส่วนสูง (ซม.)</label>
                <input type="number" name="height" min="100" max="200" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">ที่อยู่</label>
                <textarea name="address" rows="3" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">วันเดือนปีเกิด</label>
                <input type="date" name="birthday" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label text-white">สีที่ชอบ</label>
                <input type="color" name="color" class="form-control form-control-color" value="#000000">
            </div>

            <div class="mb-4">
                <label class="form-label text-white">สาขาวิชา</label>
                <select name="major" class="form-select">
                    <option value="การบัญชี">การบัญชี</option>
                    <option value="การตลาด">การตลาด</option>
                    <option value="การจัดการ">การจัดการ</option>
                    <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
                </select>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" name="Submit" class="btn btn-success btn-modern">✔ สมัครสมาชิก</button>
                <button type="reset" class="btn btn-secondary btn-modern">ล้างข้อมูล</button>

                <button type="button" class="btn btn-danger btn-modern"
                    ondblclick="alert('กดทำไมจร๊าาา 😡');">อย่ากด</button>

                <button type="button" class="btn btn-warning btn-modern"
                    onclick="window.location='https://www.youtube.com/watch?v=tn7_CFkr6Oo&list=RDm4lNSIy_bUg&index=3';">
                    🎵 เพลง ยาพิษ Bodyslam
                </button>

                <button type="button" class="btn btn-info btn-modern text-white"
                    onclick="window.print();">🖨 พิมพ์</button>
            </div>

        </form>
    </div>

    <br>

    <!-- PHP แสดงข้อมูล -->
    <?php
    if (isset($_POST['Submit'])) {

        $fullname = $_POST['fullname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $height = $_POST['height'] ?? '';
        $address = $_POST['address'] ?? '';
        $birthday = $_POST['birthday'] ?? '';
        $color = $_POST['color'] ?? '';
        $major = $_POST['major'] ?? '';

        echo "
        <div class='result-card mt-4'>
            <h4 class='mb-3'>ข้อมูลที่คุณส่งมา</h4>
            <p><strong>ชื่อ-สกุล:</strong> ".htmlspecialchars($fullname)."</p>
            <p><strong>เบอร์โทร:</strong> ".htmlspecialchars($phone)."</p>
            <p><strong>ส่วนสูง:</strong> ".htmlspecialchars($height)." ซม.</p>
            <p><strong>ที่อยู่:</strong> ".nl2br(htmlspecialchars($address))."</p>
            <p><strong>วันเดือนปีเกิด:</strong> ".htmlspecialchars($birthday)."</p>
            <p><strong>สีที่ชอบ:</strong></p>
            <div style='background:{$color}; width:140px; height:35px; border-radius:8px;'></div>
            <p class='mt-2'><strong>สาขาที่ชอบ:</strong> ".htmlspecialchars($major)."</p>
        </div>";
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
