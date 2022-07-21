<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">

	<?php

	require_once "config.php";

	$sql = "INSERT INTO Users VALUES ('unTest', 'fnTest', 'lnTest', 'pwTest', 1)";

	if (mysqli_query($link, $sql)) {
		echo "New user successfully created.";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}

	?>

	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a class="current" href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main"></div>
	</body>
</html>