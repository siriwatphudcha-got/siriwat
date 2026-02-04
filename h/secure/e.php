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
<h1>e.php </h1>

<?php
  unset($_SESSION['name']);
  unset($_SESSION['nickname']);
  
?>
</body>
</html>