<!DOCTYPE html>
<html>
	<head>
		<title>Leaderboard</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php

		// Include config file
		require_once "config.php";
		
		// Define variables and initialise as empty string
		$player1_name = $player2_name = $player3_name = $player4_name = $player5_name = "";
		$player1_score = $player2_score = $player3_score = $player4_score = $player5_score = 0;

		$sql = "SELECT Users.UserName, Scores.Score
				FROM Users
				LEFT JOIN Scores
				ON Users.UserName = Scores.UserName
				WHERE Users.Display = 1
				ORDER BY Score DESC 
				LIMIT 5;";

		if ($stmt = mysqli_prepare($conn, $sql)) {
			// Attempt to execute prepared sql statement
			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_bind_result($stmt, $username, $score);
				if (mysqli_stmt_fetch($stmt)) {
					$player1_name = $username;
					$player1_score = $score;
				}
				if (mysqli_stmt_fetch($stmt)) {
					$player2_name = $username;
					$player2_score = $score;
				}
				if (mysqli_stmt_fetch($stmt)) {
					$player3_name = $username;
					$player3_score = $score;
				}
				if (mysqli_stmt_fetch($stmt)) {
					$player4_name = $username;
					$player4_score = $score;
				}
				if (mysqli_stmt_fetch($stmt)) {
					$player5_name = $username;
					$player5_score = $score;
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		?>
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
					<h1>Leaderboard</h1>
					<?php if (!empty($player1_name)) { echo '<div class="leaderboard"> style="background:goldenrod"' . $player1_name . ': ' . $player1_score .'</div>'; } ?>
					<?php if (!empty($player2_name)) { echo '<div class="leaderboard"> style="background:#C0C0C0"' . $player2_name . ': ' . $player2_score .'</div>'; } ?>
					<?php if (!empty($player3_name)) { echo '<div class="leaderboard"> style="background:#cd7f32"' . $player3_name . ': ' . $player3_score .'</div>'; } ?>
					<?php if (!empty($player4_name)) { echo '<div class="leaderboard">' . $player4_name . ': ' . $player4_score .'</div>'; } ?>
					<?php if (!empty($player5_name)) { echo '<div class="leaderboard">' . $player5_name . ': ' . $player5_score .'</div>'; } ?>
				</div>
			</div>
		</div>
	</body>
</html>