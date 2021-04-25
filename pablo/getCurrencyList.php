<?php
include_once("constants.php");

$queryToGetCurrencyList = "SELECT * FROM currency ORDER BY name;";
$resultToGetCurrencyList = mysqli_query($stat, $queryToGetCurrencyList);

$response["currency"] = array();
while($currency=mysqli_fetch_array($resultToGetCurrencyList))
{
	array_push($response["currency"], $currency);
}
echo json_encode($response,JSON_PRETTY_PRINT);
?>