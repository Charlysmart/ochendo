<?php
session_start();

$curl = curl_init();

$user_id = $_POST['user_id'];
$name = $_POST['itname'];
$intention_type = $_POST['intention_type'];
$date_of_mass = $_POST['date_of_mass'];
$email = $_POST['email'];
$mass_time = $_POST['mass_time'];
$intention = $_POST['intention'];
$stipend = $_POST['stipend'] * 100;

//save form data temporarily in session
$_SESSION['user_id'] = $user_id;
$_SESSION['itname'] = $name;
$_SESSION['intention_type'] = $intention_type;
$_SESSION['date_of_mass'] = $date_of_mass;
$_SESSION['email'] = $email;
$_SESSION['mass_time'] = $mass_time;
$_SESSION['intention'] = $intention;
$_SESSION['stipend'] = $stipend;

//url to initialize transaction
$url = "https://api.paystack.co/transaction/initialize";

curl_setopt_array($curl, array(
	CURLOPT_URL => $url, 
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'stipend' => $stipend,
		'email' => $email,
	]),
	CURLOPT_HTTPHEADER => [
		"authorization: Bearer sk_test_dd91fc88b4bfda2a45eafe35e80c71d6ef459b12", //replace with your secret key
		"content-type: application/json",
		"cache-control: no-cache"
	],	
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
	die('Curl returned error: ' .$err);
}

$tranx = json_decode($response, true);

if (!$tranx['status']) {
	print_r('API returned error: ' . $tranx['message']);
}

//redirect to page so user can pay
header('Location: ' . $tranx['data'] ['authorization_url']);

?>