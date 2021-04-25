<?php
include_once("constants.php");
if(isset($_GET['email']))
{
	$email = mysqli_real_escape_string($stat, $_GET['email']);
	$queryToDelete = "DELETE FROM `users` WHERE email='$email'";
	mysqli_query($stat, $queryToDelete);
	$response['success'] = 1;
	echo json_encode($response,JSON_PRETTY_PRINT);
}
?>