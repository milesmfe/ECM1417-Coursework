<!DOCTYPE html>
<html>
	<head>
		<title>Tetris Homepage</title>
		<link rel="stylesheet" media="screen" href = "css/main.css">
	</head>
	<body>
		<ul>
			<li name="home" style="float:left"><a class="current" href="index.php">Home</a></li>
			<li name="tetris" style="float:right"><a href="tetris.php">Play Tetris</a></li>
			<li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
		</ul>
		<div id="main">
		<div id="logged-in">
            <h1 class="div-title">Welcome to Tetris</h1><br>
            <a href="tetris.php"><button type="button" class="play-button">Click here to play</button></a>
        </div>
        <div id="not-logged-in">
            <h1 class="div-title">Login Form</h1><br>
            <form class="login-form" method="post" action="res/auth.php">
                <label for="log-uname">Username:</label><br>
                <input type="text" id="log-uname" name="log-uname" placeholder="username"><br>
                <label for="log-pword">Password:<label><br>
                <input type="password" id="log-pword" name="log-pword"><br><br>
                <input type="submit" value="Login" name="log-submit">
            </form>
            <p>Don't have a user account? <a href="register.php">Register now</a></p>
        </div>
		</div>
	</body>
</html>