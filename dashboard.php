<?php include 'dashboard_server.php';

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php'); exit();
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
<body>
	<header>
		<span style="padding-top: 10px; padding-left: 5px;">
			<a href="index.php"><img src="images/ochendo.jpg"></a></span>
			<span class="title">Fada Ochendo Online Parish</span>
		
		<span style=" flex: 1; padding-top: 30px; font-size: 20px; font-weight: bold; font-family: roboto, 'Segoe UI', Arial, sans-serif;">Book a Mass</span>
		<span><a href="dashboard.php"><i class="fas fa-user" style="border-radius: 50%; background-color: black; color: #fef9e7; padding: 10px; margin-right: 30px; margin-top: 20px;"></i></a></span>
	</header>
	<div class="container">
	<section id="dashboard">
		<div>
			<p>Welcome Back <?php echo "$fname " . "$lname"; ?></p>
		</div>
		<div>
			<h3>View Mass Record</h3>
			<div>
				
					<table class="history">
						<thead>
							<tr>
								<th>Reference</th>
								<th>Intention Type</th>
								<th>Date of Mass</th>
								<th>Stipend</th>
								<th>Process</th>
								<th></th>
							</tr>
						</thead>
						<?php
						

$asql = "SELECT * FROM intention WHERE user_id = '$id'";
$aresult = $conn->query($asql);

if ($aresult->num_rows > 0) {
	while ($arow = $aresult->fetch_assoc()) {
		$name = $arow["name"];
		$ref = $arow["reference"];
		$int_type = $arow["intention_type"];
		$date = $arow["date_of_mass"];
		$stipend = $arow["stipend"];
		$status = $arow["status"];
		echo "<tbody>";
		echo "<tr>";
		echo "<td>$ref</td>";
		echo "<td>$int_type</td>";
		echo "<td>$date</td>";
		echo "<td>NGN $stipend</td>";
		echo "<td>$status</td>";
		echo "<td><button style='border-radius:5px; border:1px solid lightgray; background-color: #fef9e7; padding: 2px 3px;'><a href='mass_ticket.php?reference=$ref' style='text-decoration: none; color: black;'>View Ticket</a></button></td>";
		echo "</tr>";
		echo "</tbody>";
	}
} else {
	echo "<td>No mass booked yet</td>";
}

$conn->close();

?>
							
					</table>
			</div>
		</div>
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