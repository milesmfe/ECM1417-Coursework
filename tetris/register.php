<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php

		// Include config file
		require_once "config.php";
		
		// Define variables and initialise as empty string
		$username = $password = $confirm_password = $first_name = $last_name = "";
		$username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = $register_err = "";
		
		// Process user data from form follwing submission
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			// Check if username is valid
			if (empty(trim($_POST["username"]))) {
				$username_err = "Username cannot be blank.";
			} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
				$username_err = "Username may only contain letters, numbers, and underscores.";
			} else {
				// Prepare a select statement
				$sql = "SELECT username FROM Users WHERE username = ?";
				
				if ($stmt = mysqli_prepare($link, $sql)) {
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "s", $param_username);
					$param_username = trim($_POST["username"]);
					
					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						/* store result */
						mysqli_stmt_store_result($stmt);
						
						if (mysqli_stmt_num_rows($stmt) == 1) {
							$username_err = "Username taken.";
						} else {
							$username = trim($_POST["username"]);
						}
					} else {
						echo "Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
			}
			
			// Validate password
			if (empty(trim($_POST["password"]))) {
				$password_err = "Please enter a password.";     
			} elseif (strlen(trim($_POST["password"])) < 6) {
				$password_err = "Password must have atleast 6 characters.";
			} else {
				$password = trim($_POST["password"]);
			}
			
			// Validate confirm password
			if (empty(trim($_POST["confirm_password"]))) {
				$confirm_password_err = "Please confirm password.";     
			} else {
				$confirm_password = trim($_POST["confirm_password"]);
				if (empty($password_err) && ($password != $confirm_password)) {
					$confirm_password_err = "Password did not match.";
				}
			}

			// Check if first name is valid
			if (empty(trim($_POST["first_name"]))) {
				$first_name_err = "Please enter your first name.";
			} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["first_name"]))) {
				$first_name_err = "Please enter a valid first name.";
			}

			// Check if last name is valid
			if (empty(trim($_POST["last_name"]))) {
				$last_name_err = "Please enter your last name.";
			} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["last_name"]))) {
				$last_name_err = "Please enter a valid last name.";
			}
			
			// Check input errors before inserting in database
			if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err)) {
				
				// Prepare an insert statement
				$sql = "INSERT INTO Users (username, password, firstname, lastname, display) VALUES (?, ?, ?, ?, ?)";
				
				if($stmt = mysqli_prepare($link, $sql)) {
					// Bind variables to the prepared statement as parameters
					mysqli_stmt_bind_param($stmt, "ssssi", $param_username, $param_password, $param_first_name, $param_last_name, $param_display);
					$param_username = $username;
					$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
					$param_first_name = $first_name;
					$param_last_name = $last_name;
					$param_display = $_POST["display"] == "yes" ? 1 : 0;
					
					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						// Redirect to home page
						header("location: index.php");
					} else {
						$register_err = "Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
			}
			
			// Close connection
			mysqli_close($link);
		}

		?>
	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main">
			<div class="landing">
				<div class="content-box">
				<h1>Register</h1>
				<p>Please register by entering your details below:</p>
				<?php if (!empty($register_err)) { echo '<div class="error">' . $register_err . '</div>'; } ?>
				<form class="register" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<input class="large" type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">
				<input class="large" type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">
				<input class="large" type="text" name="username" placeholder="username" value="<?php echo $username; ?>">
				<input class="large" type="text" name="password" placeholder="password" value="">
				<input class="large" type="text" name="confirm_password" placeholder="confirm password" value="">
				<label>Display scores on leaderboard</label>
				<label for="yes">Yes
				<input type="radio" id="yes" name="display" value="yes" checked="checked">
				</label>
				<label for="no">No
				<input type="radio" id="no" name="display" value="no">
				</label>
				<input id="login-btn" type="submit" value="Login">
				<?php if (!empty($username_err)) { echo '<div class="error">' . $username_err . '</div>'; } ?>
				<?php if (!empty($password_err)) { echo '<div class="error">' . $password_err . '</div>'; } ?>		
				<?php if (!empty($confirm_password_err)) { echo '<div class="error">' . $confirm_password_err . '</div>'; } ?>		
				<?php if (!empty($first_name_err)) { echo '<div class="error">' . $first_name_err . '</div>'; } ?>
				<?php if (!empty($last_name_err)) { echo '<div class="error">' . $last_name_err . '</div>'; } ?>				
				<p id="no-user-msg">Already have a user account? <a href="index.php">Login</a></p>
				</form>
				</div>
			</div>
		</div>
	</body>
</html>