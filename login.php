<?php
session_start(); //start the session

//check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  //retrieve the matriculation number and password from the form 
  $email = $_POST['email'];
  $password = $_POST['password'];

  //database connection parameters
  //replace 'your_database', 'your_username' and 'your_password' with your actual database credentials
  $conn = new mysqli('localhost', 'root', '', 'ochendo');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //prepare and execute the sql query
  $sql = "SELECT id, password FROM register WHERE email='$email'";
  $result = $conn->query($sql);

 //check if the query returned any rows
 if ($result->num_rows > 0) {
 	$row = $result->fetch_assoc();
 	if (password_verify($password, $row['password'])) {
 		//if the credentials are valid, set the session and redirect to the dashboard
    	$_SESSION['user_id'] = $row['id'];
    	header("Location: index.php"); //replace with your dashboard page
    } else {
    //if the credentials are not valid, display an error message
    echo "<script>alert('Invalid credentials. Please try again');</script>";
  }
} else {
	echo "invalid credentials";
}

  //close the connection
  $conn->close();
}
?>

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
			<a href="index.html"><img src="images/ochendo.jpg"></a></span>
			<span class="title">Fada Ochendo Online Parish</span>
		
		<span style=" flex: 1; padding-top: 30px; font-size: 20px; font-weight: bold; font-family: roboto, 'Segoe UI', Arial, sans-serif;">Book a Mass</span>
		<span><a href="dashboard.html"><i class="fas fa-user" style="border-radius: 50%; background-color: black; color: #fef9e7; padding: 10px; margin-right: 30px; margin-top: 20px;"></i></a></span>
	</header>
	<div class="container">
	<section id="bookamass">
		<h1 style="text-align: center; padding-top: 20px;">Be a part of Fada Ochendo's Online Parish</h1>
		<form  class="bookamass" method="post" action="login.php" enctype="multitype/form-data">
			<div class="form-group">
				<label>Email: </label><input type="email" name="email" required>
			</div>
			<div class="form-group">
				<label>Password: </label><input type="password" name="password" required>
			</div>
			<button type="submit" class="payment">Login</button>
		</form>
		<p style="text-align:center; margin-top:0; padding-bottom: 10px; color: #fef9e7;">Not a member of the online parish yet? <a href="registration.php" style="text-decoration: none; color: #fef9e7;">Join now</a></p>
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