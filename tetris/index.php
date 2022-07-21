<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">

	<?php
	
	$_SERVER["auth"] = true;

	?>

	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a class="current" href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main">
			<div class="landing" <?php if ($_SERVER['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!-- Logged in -->
			</div>
			<div class="landing" <?php if (!$_SERVER['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!-- Logged Out -->
			</div>
		</div>
	</body>
</html>