<?php
session_start();
if (isset($_SESSION['aid'])) {
    header('Location: index2.php');
    exit;
}
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Login</title>

<style>
body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
}
.box{
    background:#fff;
    padding:30px;
    width:320px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}
.box h1{text-align:center;}
.box input, .box button{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}
.box button{
    background:#667eea;
    color:#fff;
    border:none;
    cursor:pointer;
}
</style>
</head>

<body>
<div class="box">
<h1>Login</h1>

<?php if(isset($_GET['error'])): ?>
<p style="color:red;text-align:center">Username หรือ Password ไม่ถูกต้อง</p>
<?php endif; ?>

<form method="post" action="check_login.php">
    <label>Username</label>
    <input type="text" name="auser" required>

    <label>Password</label>
    <input type="password" name="apwd" required>

    <button type="submit">LOGIN</button>
</form>
</div>
</body>
</html>
