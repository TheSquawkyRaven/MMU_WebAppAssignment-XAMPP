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
			<form class="signup-form" method="POST" autocomplete="off">
				<span class="title">Sign Up</span>
				<span class="message error"><img src="assets/error.svg"><span></span></span>
				<div class="input-field">
					<label>Username</label>
					<input type="text" name="username" placeholder="Username*">
				</div>

				<div class="input-field">
					<label>Full Name</label>
					<input type="text" name="name" placeholder="Username*">
				</div>

				<div class="input-field">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password*">
					<span class="input-side-btn" id="btn-see"><img src="assets/password_see.svg"></span>
				</div>

				<div class="input-field">
					<label>Confirm Password</label>
					<input type="password" name="confirm-password" placeholder="Confirm Password*">
				</div>

				<div class="input-field">
					<label>Register AS</label>
					<select name="type">
						<option disabled selected value=""> -- Select User Type -- </option>
						<option value="student">Student</option>
						<option value="supervisor">Supervisor</option>
					</select>
				</div>

				<div class="input-field">
					<label>Date of Birth</label>
					<input type="date" name="dob">
				</div>

				<div class="form-btn">
					<input class="btn-1" type="submit" value="Sign Up">
				</div>

				<div class="line"></div>

				<div class="footer">
					<span>Already Signed Up?</span>
					<a href="login.php">Login</a>
				</div>
			</form>
		</div>
	</div>

	<script src="js/password_btn.js"></script>
	 <script src="js/check_validate.js"></script> 
	<script>
		/*
	var msg_element = $('.message');
	var message = $('.message span');

	$('.signup-form').on('submit', function() {

		msg_element.addClass('error');
		msg_element.removeClass('success');
		
		var username = $('input[name=username]');
		var name = $('input[name=name]');
		var password = $('input[name=password]');
		var confirm_password = $('input[name=confirm-password]');
		var type = $('select[name=type]');
		var dob = $('input[name=dob]');
		//var id = $('input[name=id');

		if(username.val() == '' || password.val() == '' || 
			confirm_password.val() == '' || type.val() == null || name.val() == '' || dob.val() == '') {
			msg_element.css('display', 'block');
			message.html('Please complete the form');
			return false;
		}else if(password.val() != confirm_password.val()) {
			msg_element.css('display', 'block');
			message.html('Passwords are not same');
			return false;
		}

		msg_element.css('display', 'none');

		$.ajax({
			url: 'php/signup.php',
			method: 'POST',
			data: {username:username.val(), name:name.val(), password:password.val(), type:type.val(), dob:dob.val()},
			success: function(data) {
				msg_element.removeClass('error');
				msg_element.addClass('success');

				msg_element.css('display', 'block');
				message.html('Register Success');
			}
		});
		$('.signup-form')[0].reset();

		return false;
	});
	*/
	</script>
</body>
</html>