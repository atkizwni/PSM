<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-Procurement</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<style>
		body {
			background-color: #7586ad;
			background-image: url("http://mediad.publicbroadcasting.net/p/wcbu/files/201506/15456-rain-drops-on-the-window-1920x1200-abstract-wallpaper.jpg");
		}
			
		.logo {
			margin-top: 0px;
			margin-left: 60px;			
		}
		.login {
			margin: 20px auto;
			width: 400px;
			height: 400px;
		}
		.login-screen {
			background-color: #d4def4;
			padding: 20px;
			border-radius: 5px;
			height: 380px;
		}
		.selectt {
			margin-left: 55px;
			width: 250px;
		}
	</style>
</head>
<body>
	<div class='container'>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class='logo'>
					<img src="Image/head.png" class="img img-responsive"/>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class="login">
				<div class="login-screen">
					<div class="app-title">
						<h1>Login</h1>
					</div>
					<br>
					<div class="login-form">
						<form role="form" action="indexcode.php" method="post">
						<div class="control-group selectt">
							<select name="role" class="form-control" >
								<option>Please choose role</option>
								<option>Client</option>
								<option>Vendor</option>
							</select>
						</div>
						<div class="control-group">
							<input type="text" class="login-field" name='StaffUsername' placeholder="username" id="login-name">
							<label class="login-field-icon fui-user" for="login-name"></label>
						</div>
						<div class="control-group">
							<input type="password" class="login-field" name='StaffPassword' placeholder="password" id="login-pass">
							<label class="login-field-icon fui-lock" for="login-pass"></label>
						</div>
						<input type="submit" class="btn btn-primary btn-md" value='Login'>
						&nbsp;
						<a href="Staff/S_Register_Staff.php">Register as Client</a>
						<div></div>
						<a href="Staff/S_Register_Vendor.php">Register as Vendor</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.metisMenu.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
    
   
</body>
</html>
