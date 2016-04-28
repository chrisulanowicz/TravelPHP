<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Travel Buddy - Plan your Travels and Travel your Plans!" />
	<title>Login/Registration</title>
	<link rel="stylesheet" href="<?=base_url();?>/user_guide/_static/css/style.css" />
</head>
<body>
	<div id="container">
		<div class="errors">
		<?php
			if($this->session->flashdata('success'))
			{
				echo $this->session->flashdata('success');
			}
			elseif($this->session->flashdata('errors'))
			{
				echo "<p id='errors'>" . $this->session->flashdata('errors') . "</p>";
			}
		?>
		</div>
		<h2>Welcome!</h2>
		<form id="login" action="/Users/authenticate" method="post">
			<fieldset>
				<legend>Log In</legend>
					<p>Username:</p><input type="text" name="username" />
					<p>Password:</p><input type="password" name="password1" />
					<input class="button" type="submit" value="Login" />
			</fieldset>
		</form>
		<form id="register" action="/Users/create" method="post">
			<fieldset>
				<legend>Register</legend>
					<p>Name:</p><input type="text" name="name" />
					<p>Username:</p><input type="text" name="username" />
					<p>Password</p><input type="password" name="password" placeholder="Minimum 6 Characters" />
					<p>Confirm Password:</p><input type="password" name="confirm_pw" />
					<input class="button" type="submit" value="Register" />
			</fieldset>
		</form>
	</div>
</body>
</html>