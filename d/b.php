<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สิริวัฒน์ พุดชา (ก็อต)</title>
</head>

<body>
<h1>ฟอร์มรับข้อมูล - สิริวัฒน์ พุดชา (ก็อต)</h1>
<form method="post" action="">
    ชื่อ-สกุล <input type="text" name="fullname" autofocus required> ***<br>
    เบอร์โทร <input type="text" name="phone" required> ***<br>
    ส่วนสูง <input type="number" name="height" min="100" max="200" required> ซม. ***<br>
    ที่อยู่ <br><textarea name="address" cols="40" rows="4"></textarea><br>
    วันเดือนปีเกิด <input type="date" name="birthday"><br>
    สีที่ชอบ <input type="color" name="color"><br>
    สาขาวิชา
    <select name="major">
        <option value="การบัญชี">การบัญชี</option>
        <option value="การตลาด">การตลาด</option>
        <option value="การจัดการ">การจัดการ</option>
        <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
    </select>
    <br><br>
    <button type="submit" name="Submit">สมัครสมาชิก</button>
    <button type="reset">ยกเลิก</button>
    <button type="button" onClick="window.location='https://www.youtube.com/watch?v=tn7_CFkr6Oo&list=RDm4lNSIy_bUg&index=3';">เพลง ยาพิษ Bodyslam</button>
    <button type="button" onDblClick="alert('จิ๊จ๊ะ!');">อย่ากด</button>
    <button type="button" onClick="window.print();">พิมพ์</button>
</form>
<br>
<hr>

<?php
if (isset($_POST['Submit'])) {
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $height = isset($_POST['height']) ? $_POST['height'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $major = isset($_POST['major']) ? $_POST['major'] : '';
    
    echo "ชื่อ-สกุล: " . htmlspecialchars($fullname) . "<br>";
    echo "เบอร์โทร: " . htmlspecialchars($phone) . "<br>";
    echo "ส่วนสูง: " . htmlspecialchars($height) . " ซม.<br>";
    echo "ที่อยู่: " . nl2br(htmlspecialchars($address)) . "<br>";
    echo "วันเดือนปีเกิด: " . htmlspecialchars($birthday) . "<br>";
    echo "สีที่ชอบ: <div style='background-color:{$color}; width:300px; height:30px;'>".$color."</div>";
    echo "สาขาที่ชอบ: " .$major. "<br>";
}
?>
</body>
</html>
