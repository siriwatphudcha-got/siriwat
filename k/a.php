<?php
$student_id = "66010914019";  
$student_name = "สิริวัฒน์ พุดชา (ก็อต)";

?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>งาน k - <?php echo $student_name; ?></title>
  <style>
    body{
      font-family: Arial, Helvetica, sans-serif;
      background:#f6f7fb;
      margin:0;
      padding:40px;
      display:flex;
      justify-content:center;
    }
    .card{
      background:#fff;
      width:min(720px, 95vw);
      padding:28px;
      border-radius:16px;
      box-shadow:0 10px 30px rgba(0,0,0,.08);
      text-align:center;
    }
    h1{
      margin:0 0 10px 0;
      font-size:28px;
    }
    .sub{
      color:#555;
      margin:0 0 24px 0;
      font-size:16px;
    }
    .btns{
      display:flex;
      gap:14px;
      justify-content:center;
      flex-wrap:wrap;
      margin-top:10px;
    }
    .btn{
      border:0;
      padding:14px 18px;
      border-radius:12px;
      font-size:16px;
      cursor:pointer;
      font-weight:700;
      min-width:220px;
      transition:.15s transform ease, .15s opacity ease;
    }
    .btn:active{ transform: scale(0.98); }
    .btn-green{ background:#16a34a; color:#fff; }
    .btn-yellow{ background:#f59e0b; color:#111; }
    .hint{
      margin-top:18px;
      color:#666;
      font-size:14px;
    }
  </style>
</head>

<body>
  <div class="card">
    <h1>งาน k</h1>
    <p class="sub">รหัสนิสิต: <b><?php echo $student_id; ?></b> | ชื่อ: <b><?php echo $student_name; ?></b></p>

    <div class="btns">
      <!-- ปุ่มแรก สีเขียว เปิดรูปตัวเอง -->
      <button class="btn btn-green" onclick="openImg('me.PNG')">
        เปิดรูปตัวเอง
      </button>

     
      <button class="btn btn-yellow" onclick="openImg('teacher.PNG')">
        เปิดรูปอาจารย์ผู้สอน
      </button>
    </div>

    <div class="hint">
      * วางไฟล์รูป <b>me.jpg</b> และ <b>teacher.jpg</b> ไว้โฟลเดอร์เดียวกับไฟล์ <b>a.php</b>
    </div>
  </div>

  <script>
    function openImg(file){
     
      window.open(file, '_blank');
    }
  </script>
</body>
</html>
