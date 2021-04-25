<?php
include_once("constants.php");

$queryToGetUserImages = "SELECT * FROM userImages;";
$resultToGetUserImages = mysqli_query($stat, $queryToGetUserImages);

$response["images"] = array();
while($userImages=mysqli_fetch_array($resultToGetUserImages))
{
	array_push($response["images"], $userImages);
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>