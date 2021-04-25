<?php
function succ()
{
    ?>
    <script type="text/javascript">
        alert("Account Verified Successfully!!")
    </script>
    <?php
    //echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
}
require_once('constants.php');
if(isset($_GET['email'])&&isset($_GET['hash']))
{
	$email = mysqli_real_escape_string($stat, $_GET['email']);
	$hash = mysqli_real_escape_string($stat, $_GET['hash']);
    $queryToCheckAccount = "SELECT * FROM users where email='$email' and hash='$hash' and active=0;";
    $resultToCheckAccount = mysqli_query($stat, $queryToCheckAccount);
    if($account = mysqli_fetch_array($resultToCheckAccount))
    {
        $query="UPDATE users SET active=1 where email='$email';";
        $result=mysqli_query($stat,$query);
        succ();
    }
    echo "<script>window.close();</script>";
}