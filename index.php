<?php
session_start();

  // check if the user is logged in
if (!isset($_SESSION['user_id'])){
  header('Location: login.php'); exit();//Redirect to the login page if not logged in exit();
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
	<script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body style="background: url(images/churchbkg.jpg); margin: 0; background-size: cover; background-repeat: none;">
	<header>
		<span style="padding-top: 10px; padding-left: 5px;">
			<a href="index.html"><img src="images/ochendo.jpg"></a></span>
			<span class="title">Fada Ochendo Online Parish</span>
		
		<span style=" flex: 1; padding-top: 30px; font-size: 20px; font-weight: bold; font-family: roboto, 'Segoe UI', Arial, sans-serif;">Book a Mass</span>
		<span><a href="dashboard.php"><i class="fas fa-user" style="border-radius: 50%; background-color: black; color: #fef9e7; padding: 10px; margin-right: 30px; margin-top: 20px;"></i></a></span>
	</header>
	<div class="container">
	<section id="bookamass">
		<div>
			<h2 style="text-align: center; padding-top: 20px;">Book a Mass</h2>
			<form class="bookamass" id="massintention" enctype="multipart/form-data">
				<div>
					<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
				</div>
				<div class="form-group"><label>Booked by (Name): </label><input type="text" name="itname" id="itname" class="it_name" required></div><br><br>
				<div class="form-group"><label>Intention type: </label><select name="intention_type" id="intention_type" required>
					<option value="" disabled selected>--Select your intention--</option>
					<option value="birthday">Birthday</option>
					<option value="repose of the dead">Repose of the soul</option>
					<option value="special intention">Special Intention</option>
					<option value="wedding anniversary">Wedding Anniversary</option>
				</select></div><br><br>
				<div class="form-group"><label>Date of Mass: </label><input type="date" name="date_of_mass" id="date_of_mass" required></div><br><br>
				<div class="form-group"><label>Email: </label><input type="email" name="email" id="email" required></div><br><br>
				<div class="form-group"><label>Mass Time: </label><select name="mass_time" id="mass_time" required>
					<option value="" disabled selected>--Mass Time--</option>
					<option value="morning mass">Morning Mass</option>
					<option value="evening mass">Evening Mass</option>
				</select></div><br><br>
				<div class="form-group"><label>Intention: </label><textarea name="intention" id="intention" rows="5" cols="40" required style="flex: 1;padding: 8px;box-sizing: border-box; border-radius: 5px; border: none; box-shadow: 1px 1px 10px black; resize: none;"></textarea></div><br><br>
				<div class="form-group" style="margin-bottom: 5px;"><label>Stipend: </label><div class="number_input" required>
					<button type="button" onclick="changeValue(-100)">-</button>
						<input type="number" name="stipend" min="100" value="100" id="stipend">
					<button type="button" onclick="changeValue(100)">+</button>
				</div></div>
				<p style="font-size: 10px; margin-top: 0; color: white; margin-bottom:25px;"><span style="color: #fef9e7;">NB:</span> Per mass amounts to #100. Pay based on the number of days you want to book. Novena mass costs #1000</p>
				<button type="button" class="payment" onclick="payWithPaystack()">Pay</button>
			</form>
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

	<script type="text/javascript">
		function changeValue(delta) {
			var input = document.getElementById('stipend');
			var value = parseInt(input.value, 10);
			var newValue = value + delta;
			if (newValue >= parseInt(input.min, 10)) {
				input.value = newValue;
			}
		}
	</script>
	
	<script>
		function payWithPaystack() {
			var user_id = document.getElementById('user_id').value;
			var itname = document.getElementById('itname').value;
			var intention_type = document.getElementById('intention_type').value;
			var date_of_mass = document.getElementById('date_of_mass').value;
			var email = document.getElementById('email').value;
			var mass_time = document.getElementById('mass_time').value;
			var intention = document.getElementById('intention').value;
			var stipend = document.getElementById('stipend').value * 100; //amount in kobo
			var reference = 'OchM' + Math.floor((Math.random() * 100000 + 1)); //Generate a random reference number

			var handler = PaystackPop.setup({
				key: 'pk_test_561e7d9530d560b4da6e2bc786009d86ebf221ca', //replace with public key
				email: email,
				amount: stipend,
				currency: 'NGN',
				ref: reference, //pass the generated reference
				
				callback: function(response) {
					//send reference to server for verification
					var xhr = new XMLHttpRequest();
					xhr.open("POST", "verify_transaction.php", true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							alert(xhr.responseText);
						} else if (xhr.readyState === 4) {
							alert('There was an error: ' + xhr.status);
						}
					};

					var data = "user_id=" + user_id + "&status=" + status + "&itname=" + itname + "&intention_type=" + intention_type + "&date_of_mass=" + date_of_mass + "&email=" + email + "&mass_time=" + mass_time + "&intention=" + intention + "&stipend=" + stipend +  "&reference=" + reference;
					xhr.send(data);
				},
				onClose: function() {
					alert('Transaction was not completed, window closed.');
				}
			});
			handler.openIframe();
		}
	</script>
</body>
</html>