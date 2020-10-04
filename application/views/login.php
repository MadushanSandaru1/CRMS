<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap.css');?>">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/fav_icon');?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login_util.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login_main.css');?>">
<!--===============================================================================================-->
    <style>
        body{
/*            background-image: url(<?php echo base_url('assets/images/bg_login.jpg');?>);*/
        }
    </style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(<?php echo base_url('assets/images/bg_login.jpg');?>);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                              <label class="form-check-label" for="defaultCheck1">
                                Remeber me
                              </label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/js/vendor/jquery-2.2.4.min.js');?>"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/js/login_main.js');?>"></script>

</body>
</html>