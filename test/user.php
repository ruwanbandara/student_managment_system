<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php 

	$user_id=$_SESSION['user_id'];

	// prepare database query
	$query = "SELECT email, last_login, Address, course, phone_number, nic, birthday, CONCAT(first_name,' ',last_name) AS name FROM user
			WHERE id = {$user_id}
			LIMIT 1";


			$result = mysqli_query($connection,$query);

			$details = mysqli_fetch_assoc($result);




 ?>





<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>
		
		User Details
	</title>
</head>
<body bgcolor="#FFA500">


	<h3>Welcome : <?php echo $details['name']; ?></h3><br>

	<fieldset>
	Name: <?php echo $details['name'];?><br>
	Emai: <?php echo $details['email'];?><br>
	Address: <?php echo $details['Address'];?><br>
	course: <?php echo $details['course'];?><br>
	Phone Number: <?php echo $details['phone_number'];?><br>
	National ID Number: <?php echo $details['nic'];?><br>
	Birthday: <?php echo $details['birthday'];?><br>
	Last Login:<?php echo $details['last_login'];?>
	

	</fieldset>


</body>
</html>