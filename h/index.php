<?php
  session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สิริวัฒน์ พุดชา</title>
</head>

<body>
<h1> หน้าเข้าสู่ระบบ - สิริวัฒน์ </h1>
<form method="post" action="">
Username <input type="text"name="auser"autofocus required <br>
Username <input type="password"name="apwd"autofocus required <br>
<button type="submit"name ="Submit">LOGIN</button>
</form>
<?php
if(isset($_POST['Submit'])){
    include_once("connectdb.php");
    $sql = "SELECT * FROM admin WHERE a_username='{$_POST['auser']}'AND a_password='{$_POST['apwd']}' LIMIT 1";
    $rs = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($rs);

    if($num==1){
        $data = mysqli_fetch_array($rs);
        $_SESSION['aid'] = $data['a_id'];
        $_SESSION['aname']=$data['a_name'];
        echo "<scrip>";
        echo "window.location='index2.php';";
        echo "</scrip>";
    }else{
        echo"<script>";
        echo"alert('Username หรือ Password ไม่ถูกต้อง');"
        echo"</scipt>";
    }
    

</body>
</html>