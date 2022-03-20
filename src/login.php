<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/main.css" />
	<script src="libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="form-container">
		<div class="wrap">
			<form class="login-form" method="POST" autocomplete="off">
				<span class="title">Log In</span>
				<span class="message error"><img src="assets/error.svg"><span></span></span>
				<div class="input-field">
					<label>Username</label>
					<input type="text" name="username" placeholder="Username*">
				</div>

				<div class="input-field">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password*">
					<span class="input-side-btn" id="btn-see"><img src="assets/password_see.svg"></span>
				</div>

				<div class="form-btn">
					<input class="btn-1" type="submit" value="Login">
				</div>

				<div class="line"></div>

				<div class="footer">
					<span>Don’t have an account?</span>
					<a href="signup.php">Sign Up</a>
				</div>
			</form>
		</div>
	</div>

	<script src="js/password_btn.js"></script>
	<script src="js/check_validate.js"></script>
</body>
</html>