<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สรุปผลการสมัครงาน</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #ffffff;
            width: 100%;
            max-width: 600px;
            border-radius: 18px;
            padding: 30px 35px;
            box-shadow: 0 25px 55px rgba(0,0,0,0.4);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h1 {
            text-align: center;
            color: #203a43;
            margin-bottom: 8px;
        }

        h2 {
            text-align: center;
            color: #666;
            margin-top: 0;
            font-size: 18px;
        }

        .data {
            background: #f4f7fb;
            padding: 20px;
            border-radius: 14px;
            margin-top: 20px;
        }

        .data p {
            font-size: 16px;
            padding: 8px 0;
            border-bottom: 1px dashed #ccc;
            margin: 0;
        }

        .data p:last-child {
            border-bottom: none;
        }

        .back {
            display: block;
            margin-top: 22px;
            text-align: center;
            text-decoration: none;
            background: linear-gradient(90deg, #203a43, #2c5364);
            color: white;
            padding: 12px;
            border-radius: 12px;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .back:hover {
            transform: scale(1.03);
            opacity: 0.95;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>✅ ข้อมูลการสมัครงาน</h1>
    <h2>66010914019 สิริวัฒน์ พุดชา</h2>

    <div class="data">
        <p><strong>ตำแหน่งที่สมัคร:</strong> <?php echo $_POST['position']; ?></p>
        <p><strong>ชื่อผู้สมัคร:</strong> <?php echo $_POST['title']." ".$_POST['fullname']; ?></p>
        <p><strong>วันเดือนปีเกิด:</strong> <?php echo $_POST['birthdate']; ?></p>
        <p><strong>ระดับการศึกษา:</strong> <?php echo $_POST['education']; ?></p>
        <p><strong>ความสามารถพิเศษ:</strong> <?php echo $_POST['skill']; ?></p>
        <p><strong>ประสบการณ์ทำงาน:</strong> <?php echo $_POST['experience']; ?></p>
    </div>

    <a href="form.php" class="back">🔁 กลับไปสมัครใหม่</a>
</div>

</body>
</html>
