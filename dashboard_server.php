<?php

session_start();

$conn = new mysqli("localhost", "root", "", "ochendo");

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM register WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$fname = $row["first_name"];
		$lname = $row["last_name"];
	}
} else {
	echo "Not a registered membered of Fada Ochendo's online parish";
}

?>