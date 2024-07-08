<?php include ('register.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book a Mass</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
</head>
<body style="background: url(images/churchbkg.jpg); margin: 0; background-size: cover; background-repeat: none;">
	<header>
		<span style="padding-top: 10px; padding-left: 5px;">
			<a href="index.php"><img src="images/ochendo.jpg"></a></span>
			<span class="title">Fada Ochendo Online Parish</span>
		
		<span style=" flex: 1; padding-top: 30px; font-size: 20px; font-weight: bold; font-family: roboto, 'Segoe UI', Arial, sans-serif;">Book a Mass</span>
		<span><a href="dashboard.php"><i class="fas fa-user" style="border-radius: 50%; background-color: black; color: #fef9e7; padding: 10px; margin-right: 30px; margin-top: 20px;"></i></a></span>
	</header>
	<div class="container">
	<section id="bookamass">
	<h1 style="text-align: center; padding-top: 20px;">Be a part of Fada Ochendo's Online Parish</h1>
		<form  class="bookamass" method="post" action="register.php" enctype="multitype/form-data">
			<div class="form-group">
				<label>First Name: </label><input type="text" name="first_name" required>
			</div>
			<div class="form-group">
				<label>Last Name: </label><input type="text" name="last_name" required>
			</div>
			<div class="form-group">
				<label>Email: </label><input type="email" name="email" required>
			</div>
			<div class="form-group">
				<label>Date of Birth: </label><input type="date" name="date_of_birth" required>
			</div>
			<div class="form-group">
				<label>Gender: </label><select>
					<option value="" disabled selected>--select your gender--</option>
					<option value="male" name = "sex">Male</option>
					<option value="female" name = "sex">Female</option>
				</select>
			</div>
			<div class="form-group">
				<label>Phone Number: </label><input type="tel" name="phone_number" required>
			</div>
			<div class="form-group">
				<label>Password: </label><input type="password" name="password" required>
			</div>
			<div class="form-group">
				<label>Confirm Password: </label><input type="password" name="confirmpassword" required>
			</div>
			<button type="submit" class="payment">Register</button>
		</form>
	</section>
</div>
<footer style="background-color: #fef9e7; padding: 2px 2px 2px 10px;">
		<div>
			<p style="margin-bottom: 5px;">To contact us, <i class="fas fa-phone"></i> call: <a href="tel:+2348100703040" style="text-decoration: none; color: black;">+2348100703040</a> or  <span ><i class="fas fa-message"></i>  email: <a href="mailto:ambasador_250@yahoo.com" style="text-decoration: none; color: black;">ambasador_250@yahoo.com</a></span></p> 
		</div><hr style="width: 100%; margin: 0; padding: 0; border: 1px solid #ddd;">
		<div style="padding-top: 0px;">
			<p style="margin-bottom: 0px; margin-top:0px;">Copyright &copy; 2024 Fada Ochendo. All rights reserved.</p> <p style="margin-top: 0px;">Designed and Developed by Chiemerie</p>
		</div>
	</footer>
</body>
</html>