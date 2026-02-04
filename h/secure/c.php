<?php
  session_start();
?>
<!doctype html>
<html>
<head>
<meta chaset="utf-8">
<title>สิริวัฒน์ พุดชา (ก็อต)</title>
</head>
 <body>
<h1>c.php </h1>

<?php
  echo $_SESSION['name']."<br>";
  echo $_SESSION['nickname']."<br>";
  echo $_SESSION['p1']."<br>";
  echo $_SESSION['p2']."<br>";
?>
</body>
</html>