<?php
	require('conn.php');
	session_start();
	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	$query = "select * from users where user = '".$user."' and pass = '".$pass."'";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	if (mysqli_num_rows($result) == 1) {
		$_SESSION["user"] = $user;
		echo "login";
	}
	else {
		session_unset();
		echo "failed";	
	}
?>