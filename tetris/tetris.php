<!DOCTYPE html>
<html>
	<head>
		<title>Play Tetris</title>
		<link rel="stylesheet" href = "css/main.css">

		<?php echo "<script>console.log(" . $_SESSION["username"] . ")</script>" ?>

	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a class="current" href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main"></div>
	</body>
</html>