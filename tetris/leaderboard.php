<!DOCTYPE html>
<html>
	<head>
		<title>Leaderboard</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a class="current" href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main">
			<div class="landing">
				<div class="content-box">
				<?php echo '<div>' . $player1_name . '</div>'; ?>
				<?php echo '<div>' . $player1_score . '</div>'; ?>
				</div>
			</div>
		</div>
	</body>
</html>