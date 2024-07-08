<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ochendo");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$ref = $_GET['reference'];
$sql = "SELECT * FROM intention WHERE reference = '$ref'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$name = $row["name"];
		$int_type = $row["intention_type"];
		$date = $row["date_of_mass"];
		$email = $row["email"];
		$time = $row["mass_time"];
		$intention = $row["intentions"];
		$stipend = $row["stipend"];
		$time_booked = $row["Time_intention_made"];
	}
} else {
	echo "No reference number found";
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book a Mass</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<style type="text/css">
		@media print {
			body * {
				visibility: hidden;
			}
			.ticket, .ticket * {
				visibility: visible;
			}
		}
	</style>
</head>
<body>
	<header>
		<span style="padding-top: 10px; padding-left: 5px;">
			<a href="index.php"><img src="images/ochendo.jpg"></a></span>
			<span class="title">Fada Ochendo Online Parish</span>
		
		<span style=" flex: 1; padding-top: 30px; font-size: 20px; font-weight: bold; font-family: roboto, 'Segoe UI', Arial, sans-serif;">Book a Mass</span>
		<span><a href="dashboard.php"><i class="fas fa-user" style="border-radius: 50%; background-color: black; color: #fef9e7; padding: 10px; margin-right: 30px; margin-top: 20px;"></i></a></span>
	</header>
	<section id="ticket" class="ticket" style="max-width: 350px; margin: auto; background-color: white; margin-top: 30px;  margin-bottom: 30px;">
		<div style="display: flex; background-color: #fef9e7; align-items: center; justify-content: center;">
			<span style="padding-top: 5px; padding-left: 5px;">
			<img src="images/ochendo.jpg" style="border-radius: 50%; height: 40px; width: 40px; margin-right: 10px;"></span>
			<h3>Fada Ochendo Online Parish</h3>
		</div>
		<div style="padding: 5px 5px 5px 15px;">
			<div style="text-align:center; display: flex; flex-direction: column; align-items:center;">
				<img src="images/bible.png" style="width:100px; height: 100px; margin-bottom: 0;">
				<p style="font-style: italic; margin-top: 0; ">Mass Ticket</p>
			</div>
			<div style="display:flex;">
				<p style="padding-right: 10px;"><span style="flex: 1; font-weight: bold;">Ref: </span><?php echo "$ref";?></p>
				<p style="padding-right:1px;"><span style="flex: 1; font-weight: bold;">Date: </span><?php echo "$time_booked";?></p>
			</div>
			<div>
				<p><span style="font-weight: bold;">Booker's Name: </span><?php echo "$name";?></p>
				<p><span style="font-weight: bold;">Intention Type: </span><?php echo "$int_type";?></p>
				<p><span style="font-weight: bold;">Date of Mass: </span><?php echo "$date";?></p>
				<p><span style="font-weight: bold;">E-mail: </span><?php echo "$email";?></p>
				<p><span style="font-weight: bold;">Time of Mass: </span><?php echo "$time";?></p>
				<p><span style="font-weight: bold;">Stipend: </span>NGN <?php echo "$stipend";?></p>
				<p><span style="font-weight: bold;">Intention: </span><?php echo "$intention";?></p>
			</div><hr>
			<p style="font-style: italic; font-family: 'Brush Script MT', 'Comic Sans MS', cursive">Mass booked successfully <i style="border-radius:50%; background-color: black; color: #fef9e7; padding: 2px 3px; " class="fas fa-check"></i></p>
		</div>
		<div style="background-color: #fef9e7; padding: 1px 3px;">
			<p style="font-size: 7px;">"Come and experience God's presence, and let your heart be filled with joy and peace." Ps 100:4-5</p>
		</div>
	
	</section>
	<div>
		<button onclick="window.print()" style="border-radius:5px; border:1px solid lightgray; background-color: #fef9e7; padding: 2px 3px;">Print</button>
		<button id="download-image" style="border-radius:5px; border:1px solid lightgray; background-color: #fef9e7; padding: 2px 3px;">Download as image</button>
		<button id="download-pdf" style="border-radius:5px; border:1px solid lightgray; background-color: #fef9e7; padding: 2px 3px;">Download as pdf</button>
		<button id="share" style="border-radius:5px; border:1px solid lightgray; background-color: #fef9e7; padding: 2px 3px;">Share Ticket</button>
	</div>	
	
		
	<footer style="background-color: #fef9e7; padding: 2px 2px 2px 10px;">
		<div>
			<p style="margin-bottom: 5px;">To contact us, <i class="fas fa-phone"></i> call: <a href="tel:+2348100703040" style="text-decoration: none; color: black;">+2348100703040</a> or  <span ><i class="fas fa-message"></i>  email: <a href="mailto:ambasador_250@yahoo.com" style="text-decoration: none; color: black;">ambasador_250@yahoo.com</a></span></p> 
		</div><hr style="width: 100%; margin: 0; padding: 0; border: 1px solid #ddd;">
		<div style="padding-top: 0px;">
			<p style="margin-bottom: 0px; margin-top:0px;">Copyright &copy; 2024 Fada Ochendo. All rights reserved.</p> <p style="margin-top: 0px;">Designed and Developed by Chiemerie</p>
		</div>
	</footer>

	<script src="library/html2canvas.min.js"></script>
	<script src="library/jspdf.umd.min.js"></script>
	<script>
		document.getElementById('download-image').addEventListener('click', function() {
			const ticket = document.getElementById('ticket');
			html2canvas(ticket, {
				useCORS: true,
				scale: 2,
				scrollX: 0,
				scrollY: -window.scrollY,
				width: ticket.scrollWidth,
				height: ticket.scrollHeight
				 }).then(canvas => {
				let link = document.createElement('a');
				link.download = 'mass_ticket.jpg';
				link.href = canvas.toDataURL('mass_ticket/jpeg');
				link.click();
			});
		});

		document.getElementById('download-pdf').addEventListener('click', function() {
			const ticket = document.getElementById('ticket');
			html2canvas(ticket, {
			 	useCORS: true,
			 	scale: 2,
			 	scrollX: 0,
				scrollY: -window.scrollY,
				width: ticket.scrollWidth,
				height: ticket.scrollHeight
				 }).then(canvas => {
				const {jsPDF} = window.jspdf;
				let pdf = new jsPDF('p', 'mm', 'a4');
				let imgData = canvas.toDataURL('image/jpeg');
				
				pdf.addImage(imgData, 'JPEG', 10, 10);
				pdf.save('mass_ticket.pdf');
			});
		});

		document.getElementById('share').addEventListener('click', function() {
			const ticket = document.getElementById('ticket');
			html2canvas(ticket, {
			 	useCORS: true,
			 	scale: 2,
			 	scrollX: 0,
				scrollY: -window.scrollY,
				width: ticket.scrollWidth,
				height: ticket.scrollHeight
				 }).then(canvas => {
				canvas.toBlob(function(blob) {
					let file = new File([blob], 'mass_ticket.jpg', {type: 'image/jpeg'});
					if (navigator.share) {
						navigator.share({
							title: 'mass_ticket',
							files: [file]
						}).then(() => {
							console.log('Succesfully shared');
						}).catch((error) => {
							console.error('Something went wrong sharing the file', error);
						});
					} else {
						alert('Web share API not supported in this browser');
					}
				}, 'image/jpeg');
			});
		});
	</script>
</body>
</html>