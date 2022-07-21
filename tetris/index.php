<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">

	<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["auth_test"])) {
		$auth_test = $_POST['auth_test'];
		if ($auth_test == "logout") {
			$_SESSION["auth"] = false;
		} 
		if ($auth_test == "login") {
			$_SESSION["auth"] = true;
		}
	  }
	
	?>

	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a class="current" href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main">
			<div class="landing" <?php if ($_SESSION['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!-- Logged in -->
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"></form>
				<input type="submit" name="auth_test" value="logout">
			</div>
			<div class="landing" <?php if (!$_SESSION['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!-- Logged Out -->
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"></form>
				<input type="submit" name="auth_test" value="login">
			</div>
		</div>
	</body>
</html>