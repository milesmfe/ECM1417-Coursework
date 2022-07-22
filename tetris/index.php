<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">

	<?php
			
		// Include config file
		require_once "config.php";
		
		// Define variables and initialize with empty values
		$username = $password = "";
		$username_error = $password_error = $login_error = "";
		
		// Processing form data when form is submitted
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
			
			// Validate credentials
			if (empty($username_err) && empty($password_err)) {
				// Prepare a select statement
				$sql = "SELECT id, username, password FROM Users WHERE username = ?";
				
				if ($stmt = mysqli_prepare($conn, $sql)) {
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "s", $param_username);
					
					// Set parameters
					$param_username = $username;
					
					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						// Store result
						mysqli_stmt_store_result($stmt);
						
						// Check if username exists, if yes then verify password
						if (mysqli_stmt_num_rows($stmt) == 1) {                    
							// Bind result variables
							mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
							if (mysqli_stmt_fetch($stmt)) {
								if (password_verify($password, $hashed_password)) {
									// Password is correct, so start a new session
									session_start();
									
									// Store data in session variables
									$_SESSION["auth"] = true;
									$_SESSION["id"] = $id;
									$_SESSION["username"] = $username;                            
									
									header($_SERVER["PHP_SELF"]);

								} else {
									// Password is not valid, display a generic error message
									$login_err = "Invalid username or password.";
								}
							}
						} else {
							// Username doesn't exist, display a generic error message
							$login_err = "Invalid username or password.";
						}
					} else {
						echo "Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
			}
			
			// Close connection
			mysqli_close($conn);
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