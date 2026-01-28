<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>พรรษวสา กวนขุนทด (บอม) -for</title>
</head>

<body>
<h1>พรรษวสา กวนขุนทด (บอม)<h1>

<form method="post" action="">
	แม่สูตรคูณ <input type="number"min="2"name="a"max="100"autofocus required>
	<button type="submit" name="Submit">OK</button>
</form>
<hr>

<?php
if (isset($_POST['Submit'])) {
	$m = $_POST['a'];
	for($i=1; $i<=12; $i++){
		$x= $m*$i;
		echo "{$m} x {$i} = {$x}<br>";
	}
}
?>

</body>
</html>