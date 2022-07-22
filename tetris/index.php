<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">

	<?php
	
	

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
			</div>
			<div class="landing" <?php if (!$_SESSION['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!-- Logged Out -->
				<h1>Login</h1>
				<p>Please login by entering your username and password below.</p>
				<?php if (!empty($login_error)) { echo '<div class="error">' . $login_error . '</div>'; } ?>
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<label for="username">Username</label>
					<input type="text" name="username" value="<?php echo $username; ?>">
					<span><?php echo $username_error ?></span>
					<label for="password">Password</label>
					<input type="text" name="password" value="<?php echo $password; ?>">
					<span><?php echo $password_error ?></span>
					<input type="submit" value="Login">
					<p>Don't have a user account? <a href="register.php">Register now</a></p>
				</form>
			</div>		
		</div>
	</body>
</html>