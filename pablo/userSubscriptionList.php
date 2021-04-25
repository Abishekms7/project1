<pre>
<?php
require_once('constants.php');
$response["success"] = 0;
$response["message"] = "No POST data found.";
if (isset($_COOKIE['users']) && isset($_COOKIE['users_hash'])
		&& crypt($_COOKIE['users'], $_COOKIE['users_hash']) == $_COOKIE['users_hash'])
{
	$email = mysqli_real_escape_string($stat, $_COOKIE['users']);
	$mailhash = mysqli_real_escape_string($stat, $_COOKIE['mail_hash']);
	$queryToGetAccount = "SELECT * FROM `$users_table` WHERE email = '$email' and hash = '$mailhash'";
	$resultToGetAccount = mysqli_query($stat, $queryToGetAccount);
	if ($account = mysqli_fetch_array($resultToGetAccount))
	{
		if (isset($_POST["appid"]) && mysqli_real_escape_string($stat, $_POST["appid"])!="")
		{
			$appid = mysqli_real_escape_string($stat, $_POST["appid"]);
			if (isset($_POST['delete']) && mysqli_real_escape_string($stat, $_POST["delete"]) == 1) {
				$queryToDeleteRow = "DELETE FROM '$user_subsciption_list_table' WHERE 'email'='$email' and 'appid'='$appid'";
				$resultToDeleteRow = mysqli_query($stat, $queryToDeleteRow);
				$response["message"] = "Subscription deleted successfully";
				$response["success"] = 1;
			}
			else if (isset($_POST["frequency"]) && mysqli_real_escape_string($stat, $_POST["frequency"]) != "" &&
				isset($_POST["bill_date"]) && mysqli_real_escape_string($stat, $_POST["bill_date"]) != "" &&
				isset($_POST["category"]) && mysqli_real_escape_string($stat, $_POST["category"]) != "" &&
				isset($_POST["currency"]) && mysqli_real_escape_string($stat, $_POST["currency"]) != "" &&
				isset($_POST["price"]) && mysqli_real_escape_string($stat, $_POST["price"]) != "")
			{
					$frequency = mysqli_real_escape_string($stat, $_POST["frequency"]);
					$bill_date = mysqli_real_escape_string($stat, $_POST["bill_date"]);
					$category = mysqli_real_escape_string($stat, $_POST["category"]);
					$notes = "";
					if (isset($_POST["notes"]) && mysqli_real_escape_string($stat, $_POST["notes"]) != "")
					{
						$notes = mysqli_real_escape_string($stat, $_POST["notes"]);
					}
					$currency = mysqli_real_escape_string($stat, $_POST["currency"]);
					$price = mysqli_real_escape_string($stat, $_POST["price"]);
					$subscriptionId = 0;
					if (mysqli_real_escape_string($stat, $_POST["subscriptionId"]) != "") {
						$subscriptionId = mysqli_real_escape_string($stat, $_POST["subscriptionId"]);
					}
					
					$queryToCheckRow = "SELECT * FROM '$user_subsciption_list_table' WHERE 'email'='$email' and 'appid'='$appid'";
					$resultToCheckRow = mysqli_query($stat, $queryToCheckRow);
					if (mysqli_num_rows($resultToCheckRow) == 0)
					{
						$queryToChangeRow = "INSERT INTO `user_subsciption_list`(`id`, `email`, `appid`, `frequency`, `bill_date`, `category`, `notes`, `currencyId`, `price`, `subscriptionId`) VALUES (NULL,'$email','appid','$frequency','$bill_date','category','$notes','$currency','$price', '$subscriptionId'";
					}
					else
					{
						$row = mysqli_fetch_array($resultToCheckRow);
						$id = $row['id'];
						$queryToChangeRow = "UPDATE `user_subsciption_list` SET `frequency`='$frequency' AND `bill_date`='$bill_date' AND `category`='$category' AND `notes`='$notes' AND `currencyId`='$currency' AND `price`='$price' AND `subscriptionId`='$subscriptionId' WHERE `email`='$email' and `appid`='$appid'";
					}
			}
		}
	}
}
echo json_encode($response);
?>
</pre>