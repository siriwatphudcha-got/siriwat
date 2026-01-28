<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครงาน | FutureTech Solutions</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 600px;
            border-radius: 18px;
            padding: 30px 35px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        }

        h1 {
            text-align: center;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        h2 {
            text-align: center;
            color: #555;
            margin-top: 0;
            font-size: 18px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 15px;
            box-sizing: border-box;
        }

        textarea {
            height: 90px;
            resize: none;
        }

        button {
            margin-top: 22px;
            width: 100%;
            background: linear-gradient(90deg, #1e3c72, #2a5298);
            border: none;
            color: white;
            font-size: 18px;
            padding: 13px;
            border-radius: 12px;
            cursor: pointer;
        }

        .footer {
            margin-top: 18px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>📄 สมัครงานออนไลน์</h1>
    <h2>66010914019 สิริวัฒน์ พุดชา</h2>

    <!-- ✅ แก้ action เป็น f.php ถูกต้องแล้ว -->
    <form action="f.php" method="post">

        <label>ตำแหน่งที่ต้องการสมัคร</label>
        <select name="position" required>
            <option value="">-- เลือกตำแหน่ง --</option>
            <option>Web Developer</option>
            <option>Graphic Designer</option>
            <option>Digital Marketing</option>
            <option>Data Analyst</option>
            <option>IT Support</option>
        </select>

        <label>คำนำหน้าชื่อ</label>
        <select name="title" required>
            <option>นาย</option>
            <option>นาง</option>
            <option>นางสาว</option>
        </select>

        <label>ชื่อ–สกุล</label>
        <input type="text" name="fullname" required>

        <label>วันเดือนปีเกิด</label>
        <input type="date" name="birthdate" required>

        <label>ระดับการศึกษา</label>
        <select name="education" required>
            <option>มัธยมศึกษา</option>
            <option>ปวช.</option>
            <option>ปวส.</option>
            <option>ปริญญาตรี</option>
            <option>ปริญญาโท</option>
        </select>

        <label>ความสามารถพิเศษ</label>
        <textarea name="skill" required></textarea>

        <label>ประสบการณ์ทำงาน</label>
        <textarea name="experience" required></textarea>

        <button type="submit">📩 ส่งใบสมัครงาน</button>

    </form>

    <div class="footer">© 2025 FutureTech Solutions Co., Ltd.</div>
</div>

</body>
</html>