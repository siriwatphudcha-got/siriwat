<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>พรรษวสา กวนขุนทด(บอม)</title>
</head>

<body>
<h1>พรรษวสา กวนขุนทด(บอม)</h1>
<form method="post" action="">
	กรอกตัวเลข <input type="number"name="a" autofocus required>
	<button type="submit" name="Submit">OK</button>
</form>
<?php
if(isset($_POST['Submit'])) {
	$gender =  $_POST['a'];
	if ($gender == 1) {
		echo "เพศชาย";
	} else if ($gender == 2)  {
	   echo "เพศหญิง";
	} else if ($gender == 3)  {
		  echo "เพศทางเลือก";
    } else if ($gender == 4)  {
		  echo "อื่นๆ";
  }
}
?>
</body>
</html>