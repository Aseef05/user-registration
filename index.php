<?php

// Create connection
$conn = new mysqli("localhost", "root", "", "nosproject");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['register'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phonenumber = $_POST['phonenumber'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "INSERT INTO user (firstname, lastname, phonenumber, email, password)
	VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$password')";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function query($sql) {
	global $conn;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		$rows = [];
		while($row = $result->fetch_assoc()) {
	    	$rows[] = $row;
	  	}
	  	return $rows;
	} else {
		echo "0 results";
	}
	
	$conn->close();
}

$users = query("SELECT * FROM user");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container2">
		<h1>User List</h1>
		<table>
		  <tr>
		    <th>No. </th>
		    <th>First Name</th>
		    <th>Last Name</th>
		    <th>Phone Number</th>
		    <th>Email Address</th>
		    <th>Password</th>
		  </tr>
		  <?php $i = 1; foreach ($users as $user) : ?>
		  <tr>
		    <td><?= $i; ?></td>
		    <td><?= $user['firstname']; ?></td>
		    <td><?= $user['lastname']; ?></td>
		    <td><?= $user['phonenumber']; ?></td>
		    <td><?= $user['email']; ?></td>
		    <td><?= $user['password']; ?></td>
		  </tr>
		<?php endforeach; ?>
		</table>
	</div>
</body>
</html>