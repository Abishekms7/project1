<?php
include_once("constants.php");
if(isset($_POST['currency']))
{
	$currency = mysqli_real_escape_string($stat, $_POST['currency']);
	if(ctype_digit($currency)) {
		$queryToGetPopularSubscription = "SELECT ps.id as id, ps.name as name, ps.imageUrl as imageUrl, ps.color as color, ps.shade as shade, IFNULL(p.monthly,0) as monthly, IFNULL(p.yearly,0) as yearly, ps.category FROM popularsubscription ps LEFT JOIN price p ON ps.id=p.subscriptionId and p.currencyId='$currency' ";
		if (isset($_POST['subscriptionId'])) {
			$subscriptionId = mysqli_real_escape_string($stat, $_POST['subscriptionId']);
			if(ctype_digit($subscriptionId)) {
				$queryToGetPopularSubscription.="WHERE ps.id='$subscriptionId' ";
			}
		}
		$queryToGetPopularSubscription.="ORDER BY name";
		$resultToGetPopularSubscription = mysqli_query($stat, $queryToGetPopularSubscription);
		$response["subscriptions"] = array();
		while($popularSubscription=mysqli_fetch_array($resultToGetPopularSubscription))
		{
			array_push($response["subscriptions"], $popularSubscription);
		}
		echo json_encode($response,JSON_PRETTY_PRINT);		
	}
}
?>