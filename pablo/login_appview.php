<pre>
<?php
require_once('constants.php');
function resetCookies() {
	setcookie("users", "", time() - 3600);
	setcookie("users_hash", "", time() - 3600);
	setcookie("mail_hash", "", time() - 3600);
}

if(isset($_GET['logout']) && $_GET['logout']=="1")
{
	resetCookies();
	$response["message"]="Account Logged out Successfully";
	$response["success"] = 1;
}
else
{
	if (isset($_COOKIE['users']) && isset($_POST['users'])
		&& mysqli_real_escape_string($stat, $_POST['users']) != mysqli_real_escape_string($stat, $_COOKIE['users']))
	{
		resetCookies();
	}
	if (!isset($_COOKIE['users']))
	{
		$response["message"]="cookie not set";
		if(isset($_POST['email'])&&isset($_POST['pass']))
		{
		    $email = mysqli_real_escape_string($stat, $_POST['email']);
		    $pass = mysqli_real_escape_string($stat, $_POST['pass']);
		    $queryToCheckAccount = "SELECT * FROM users WHERE email='$email'";
		    $accounts = mysqli_query($stat, $queryToCheckAccount);
		    if(mysqli_num_rows($accounts) < 1)
		    {
			   $response["success"] = 0;
			   $response["message"] = "Account Not Registered";
		    }
		    else
		    {
		        $account = mysqli_fetch_array($accounts);
		        if(crypt($pass, $account['password']) == $account['password'] && $account['active'] == 1)
				{
					$cookiename = "users";
					$cookievalue = $email;
					$blowfish_salt = bin2hex(openssl_random_pseudo_bytes(22));
                    $hash = crypt($email, "$2a$12$".$blowfish_salt);
                    $mailhash = $account['hash'];
					setcookie($cookiename, $cookievalue, time() + (10 * 365 * 24 * 60 * 60));
					setcookie("users_hash", $hash, time() + (10 * 365 * 24 * 60 * 60));
					setcookie("mail_hash", $mailhash, time() + (10 * 365 * 24 * 60 * 60));
					$response["success"] = 1;
					$profile = array();
					$profile["name"] = $account["name"];
					if($account['image'] == "")
                    {
                        $profile["image"] = $site.$userImageDirectory.$defaultImage;
                    }
                    else if($account['type'] != "")
                    {
                        $profile["image"] = $account['image'];
                    }
                    else
                    {
                        $profile["image"] = $site.$account['image'];
                    }
					$profile["email"] = $account["email"];
					$profile["phno"] = $account["phno"];
					$response["info"] = array();
					$response["message"] = "Login Successful";
					array_push($response["info"], $profile);
				}
				else if($account['active'] != 1)
				{
					$response["message"] = "Account Not Active";
					$response["success"] = 0;
				}
				else
				{
					$response["message"] = "Username or Password Incorrect";
					$response["success"] = 0;
				}
		   }
		}
	}
	else if (isset($_COOKIE['users']) && isset($_COOKIE['users_hash'])
		&& crypt($_COOKIE['users'], $_COOKIE['users_hash']) == $_COOKIE['users_hash'])
	{
		$email = mysqli_real_escape_string($stat, $_COOKIE['users']);
		$mailhash = mysqli_real_escape_string($stat, $_COOKIE['mail_hash']);
		$queryToGetAccount = "SELECT * FROM users WHERE email = '$email' and hash = '$mailhash'";
		$resultToGetAccount = mysqli_query($stat, $queryToGetAccount);
		$account = mysqli_fetch_array($resultToGetAccount);
		$profile = array();
		$profile["name"] = $account["name"];
		if ($account['image'] == "")
        {
            $profile["image"] = $site.$userImageDirectory.$defaultImage;
        }
        else if ($account['type'] != "")
        {
            $profile["image"] = $account['image'];
        }
        else
        {
            $profile["image"] = $site.$account['image'];
        }
		$profile["email"] = $account["email"];
		$profile["phno"] = $account["phno"];
		$response["info"] = array();
		array_push($response["info"], $profile);
	}
}
echo json_encode($response);
?>
</pre>