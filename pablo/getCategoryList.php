<?php
include_once("constants.php");

$queryToCategoryList = "SELECT * FROM category;";
$resultToCategoryList = mysqli_query($stat, $queryToCategoryList);

$response["category"] = array();
while($category=mysqli_fetch_array($resultToCategoryList))
{
	array_push($response["category"], $category);
}
echo json_encode($response,JSON_PRETTY_PRINT);
?>