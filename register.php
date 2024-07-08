<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['sex'];
	$phone_number = $_POST['phone_number'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	//check if passwords match
      if($password !== $confirmpassword) {echo "<script>alert('passwords do not match. Please try again.');window.location='registration.php';</script>"; exit();
  } else {
  	$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  }

		$conn = new mysqli("Localhost","root", "", "ochendo");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO register (first_name, last_name, email, date_of_birth, phone_number, sex, password) VALUES ('$first_name', '$last_name', '$email', '$date_of_birth', '$phone_number', '$gender', '$hashed_password')";
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert('<span style='color: orange;'>Congratulations</span>, dear $last_name as we welcome you to Fada Ochendo online parish.')</script>";
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		} 

		$conn->close();
	
}