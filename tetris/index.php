<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php

		// Include config file
		require_once "config.php";
		
		// Define variables and initialise as empty strings
		$username = $password = "";
		$username_err = $password_err = $login_err = "";

		// Process user data from form follwing submission
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			// Check if username is empty
			if (empty(trim($_POST["username"]))) {
				$username_err = "Please enter a username.";
			} else {
				$username = trim($_POST["username"]);
			}
			
			// Check if password is empty
			if (empty(trim($_POST["password"]))) {
				$password_err = "Please enter your password.";
			} else {
				$password = trim($_POST["password"]);
			}
			
			// Validate credentials against database
			if (empty($username_err) && empty($password_err)) {
				// Prepare sql statement
				$sql = "SELECT username, password FROM Users WHERE username = ?";
				
				if ($stmt = mysqli_prepare($conn, $sql)) {
					// Bind username to sql statement as a paramater and set its value
					mysqli_stmt_bind_param($stmt, "s", $param_username);
					$param_username = $username;
					
					// Attempt to execute prepared sql statement
					if (mysqli_stmt_execute($stmt)) {
						// Store result
						mysqli_stmt_store_result($stmt);
						
						// Check if username exists
						if (mysqli_stmt_num_rows($stmt) == 1) {                    
							// Bind result variables
							mysqli_stmt_bind_result($stmt, $username, $hashed_password);
							if (mysqli_stmt_fetch($stmt)) {
								// Check if password is correct
								if (password_verify($password, $hashed_password)) {
									// Credentials valid
									session_start();
									
									// Store data in session variables
									$_SESSION["auth"] = true;
									$_SESSION["username"] = $username;                            
									
									// Reload the page
									header($_SERVER["PHP_SELF"]);

								} else {
									// Password invalid
									$login_err = "Invalid username or password.";
								}
							}
						} else {
							// Username doesn't exist
							$login_err = "Invalid username or password.";
						}
					} else {
						// Failed to execute sql statement
						echo "Something went wrong. Please try again later.";
					}
					mysqli_stmt_close($stmt);
				}
			}
			mysqli_close($conn);
		}

		?>
	</head>
	<body>
		<!--Navbar-->
		<ul>
			<li name="home" style="float:left"><a class="current" href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<!--Main content with Tetris background image-->
		<div id="main">
			<!--Show correct landing content according to login status-->
			<div class="landing" <?php if ($_SESSION['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!--Logged in-->
				<div class="content-box">
					<h1>Welcome to Tetris!</h1>
					<p>Logged in as: <span style="color:blue"><?php echo $_SESSION["username"]; ?></span></p>
					<a href="tetris.php"><button>Click here to play</button></a>
				</div>
			</div>
			<div class="landing" <?php if (!$_SESSION['auth']) { ?>style="display: flex"<?php } else { ?>style="display:none"<?php } ?>>
				<!--Logged out-->
				<div class="content-box">
				<h1>Login</h1>
				<p>Please login by entering your username and password below:</p>
				<?php if (!empty($login_err)) { echo '<div class="error">' . $login_err . '</div>'; } ?>
				<form class="login" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<input class="large" type="text" name="username" placeholder="username" value="<?php echo $username; ?>">
				<input class="large" type="text" name="password" placeholder="password" value="<?php echo $password; ?>">
				<input class="large" id="submit-btn" type="submit" value="Login">
				<?php if (!empty($username_err)) { echo '<div class="error">' . $username_err . '</div>'; } ?>
				<?php if (!empty($password_err)) { echo '<div class="error">' . $password_err . '</div>'; } ?>				
				<p id="no-user-msg">Don't have a user account? <a href="register.php">Register now</a></p>
				</form>
				</div>
			</div>		
		</div>
	</body>
</html>