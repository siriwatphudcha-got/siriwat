<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>พรรษวสา กวนขุนทด(บอม)</title>
</head>

<body>
<h1>พรรษวสา กวนขุนทด(บอม)</h1>
<form method="post" action="">
	กรอกตัวเลข <input type="number"min="0"name="a"max="100"autofocus required>
	<button type="submit" name="Submit">OK</button>
</form>
<?php
if (isset($_POST['Submit'])) {
	$score = $_POST['a'];

    if ($score >= 80) {
         echo "ได้เกรดA";
    } elseif ($score >= 70) {
          echo "คะแนน ได้เกรดB";
    } elseif ($score >= 60) {
         echo "ได้เกรดC";
    } elseif ($score >= 50) {
        echo "ได้เกรดD";
    } else {
         echo "ได้เกรดF";
	}
}
?>


</body>
</html>