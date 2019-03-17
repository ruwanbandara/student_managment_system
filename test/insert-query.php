<?php require_once('inc/connection.php'); ?>
<?php 
	//$first_name = 'Tharindu';
	//$last_name = 'bandara';
	$username = 'addmin@gmail.com';
	$password = 'addmin';
	//$is_deleted = 0;

	$hashed_password = sha1($password);
	  // echo "{$hashed_password}";

  
	$query = "INSERT INTO addmin (username, password) VALUES ('{$username}', '{$hashed_password}')";

	$result = mysqli_query($connection, $query);
	 if ($result) {
	 	echo "1 added";
	 }else{
	 	echo "database failed";
	 }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In - User Management System</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
</body>
</html>
<?php mysqli_close($connection); ?>