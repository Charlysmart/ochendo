<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ochendo");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$user_id = $_POST['user_id'];
	$name = $_POST['itname'];
	$intention_type = $_POST['intention_type'];
	$date_of_mass = $_POST['date_of_mass'];
	$email = $_POST['email'];
	$mass_time = $_POST['mass_time'];
	$intention = $_POST['intention'];
	$status = $_POST['status'];
	$stipend = $_POST['stipend'];
	$reference = $_POST['reference'];

	$curl = curl_init();
curl_setopt_array($curl, array(CURLOPT_URL => "https://api.paystack.co/transaction/verify/" .rawurlencode($reference), 
	CURLOPT_RETURNTRANSFER => true, 
	CURLOPT_HTTPHEADER => [
	"Authorization: Bearer sk_test_dd91fc88b4bfda2a45eafe35e80c71d6ef459b12",
	"Content-Type: application/json",
	],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
	die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if (!$tranx['status']) {
	die('API returned error: ' . $tranx['message']);
}

if ('success' == $tranx['data']['status']) {
	$status = $tranx['data']['status'];
	
	$sql = "INSERT INTO intention (user_id, name, intention_type, date_of_mass, email, mass_time, intentions, stipend, reference, status) VALUES ('$user_id', '$name', '$intention_type', '$date_of_mass', '$email', '$mass_time', '$intention', '$stipend', '$reference', '$status')";

	if ($conn->query($sql) === TRUE) {
		echo "Mass booked successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
} else{
	echo "Transaction failed: " . $tranx['data']['gateway_response'];
}
curl_close($curl);
}

$conn->close();

?>