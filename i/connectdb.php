<?php
		$host = "45.136.255.138";
		$user = "root";
		$pwd = "";
		$db = "4199db";
		$conn = mysqli_connect($host, $user, $pwd, $db) or die ("เชื่อมต่อฐานข้อมูลไม่ได้");
		mysqli_query($conn, "SET NAMES utf8");
?>