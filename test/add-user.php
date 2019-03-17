<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	// checking if a user is logged in
	

	$errors = array();
	$first_name = '';
	$last_name = '';
	$email = '';
	$password = '';
	$address='';
	
	$phone_number='';
	$course='';
	$nic='';
	$birthday='';

	if (isset($_POST['submit'])) {
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// checking required fields
		$req_fields = array('first_name', 'last_name', 'email', 'password');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		// checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}

		// checking if email address already exists
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'Email address already exists';
			}
		}

		if (empty($errors)) {
			// no errors found... adding new record
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			// email address is already sanitized
			$hashed_password = sha1($password);
			$address=mysqli_real_escape_string($connection,$_POST['address']);
			$course=mysqli_real_escape_string($connection,$_POST['course']);
			$phone_number=mysqli_real_escape_string($connection,$_POST['phone_number']);
			$nic=mysqli_real_escape_string($connection,$_POST['nic']);
			$birthday=mysqli_real_escape_string($connection,$_POST['birthday']);


			$query = "INSERT INTO user ( ";
			$query .= "first_name, last_name, email, password, is_deleted , address , course , phone_number ,nic , birthday";
			$query .= ") VALUES (";
			$query .= "'{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', 0 , '{$address}' , '{$course}' , '{$phone_number}' , '{$nic}' ,'{$birthday}' ";
			$query .= ")";

			$result = mysqli_query($connection, $query);

			if ($result) {
				
				
				echo '<script>alert("Successfully added record")</script>';
				header('Location:../Students Managment System/index.html?user_added=true');
				
			} else {
				$errors[] = 'Failed to add the new record.';
			}


		}



	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New User</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body bgcolor="#FFA500">
	<header>
		<div class="appname">Student Register form</div>
		</header>

	<main>
		

		<?php 

			if (!empty($errors)) {
				display_errors($errors);
			}

		 ?>

		<form action="add-user.php" method="post" class="userform">
			
			<p>
				<label for="">First Name:</label>
				<input type="text" name="first_name" >
			</p>

			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" >
			</p>

			<p>
				<label for="">Address:</label>
				<input type="text" name="address" >

			</p>

			<p>
				<label for="">Email Address:</label>
				<input type="text" name="email" >
				
			</p>

			<p>
				<label for="">Phone number:</label>
				<input type="text" name="phone_number" >
				
			</p>

			<p>
				<label for="">Register coure name:</label>
				<select name="course" size="1" >
  				<option value="Software Engineering">Software Engineering</option>
			  	<option value="Computer Science">Computer Science</option>
  				<option value="Computer Engineering">Computer Engineering</option>
  				
				</select>
				
				
			</p>

			<p>
				<label for="">National Id Number:</label>
				<input type="text" name="nic" >
				
			</p>

			<p>
				<label for="">Birthdayr:</label>
				<input type="Date" name="birthday" >
				
			</p>

			<p>
				<label for="">New Password:</label>
				<input type="password" name="password">
			</p>

			<p>
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Save</button>
			</p>

		</form>

		
		
	</main>
</body>
</html>