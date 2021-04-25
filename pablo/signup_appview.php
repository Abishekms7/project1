<?php
require_once('constants.php');
if(!isset($_COOKIE['signup']))
{
    if(isset($_POST['name']) && $_POST['name']!="" && isset($_POST['email']) && $_POST['email']!="" && isset($_POST['pass']) && $_POST['pass']!="" && isset($_POST['phno']) && $_POST['phno']!="")// && isset($_POST['image']) && $_POST['image']!="")
    {
        $name = mysqli_real_escape_string($stat, $_POST['name']);
        $email = mysqli_real_escape_string($stat, $_POST['email']);
        $pass = mysqli_real_escape_string($stat, $_POST['pass']);
        $phno = mysqli_real_escape_string($stat, $_POST['phno']);
        $queryToCheckAccount = "SELECT * FROM users where email='$email' or phno='$phno';";
        $resultToCheckAccount = mysqli_query($stat,$queryToCheckAccount);
        if(mysqli_num_rows($resultToCheckAccount) >= 1)
        {
            $response["message"] = "Email or mobile number already registered";
        }
        else
        {
            $blowfish_salt=bin2hex(openssl_random_pseudo_bytes(22));
            $passwordhash=crypt($pass,"$2a$12$".$blowfish_salt);
            $emailhash = md5(rand(0,10000));
            if(isset($_POST['image']) && $_POST['image']!="")
            {
                $imageid = mysqli_real_escape_string($stat, $_POST['image']);
                $queryToCheckUserImage = "SELECT * FROM `userImages` WHERE id='$imageid'";
                $resultToCheckUserImage = mysqli_query($stat,$queryToCheckUserImage);
                if ($userImage = mysqli_fetch_array($resultToCheckUserImage))
                {
                    $image = $userImage['name'];
                }
                else
                {
                    $image = "";
                }
            }
            else
            {
                $image = "";
            }

            $queryToInsetNewUser="INSERT INTO `users`(`id`, `name`, `image`, `email`, `phno`, `password`, `hash`) VALUES (NULL,'$name','$image','$email','$phno','$passwordhash', '$emailhash')";
            mysqli_query($stat,$queryToInsetNewUser);
            require_once("mail.php");
            $mail->addAddress($email, $name);
            $mail->Subject = $product.' Signup | Verification'; 
            $mail->Body = '
            <div style="width:80%; background-color: #ddd; padding: 30px"> 
                <h1 style="color: green">'.$product.' Account Activation</h1>
                Dear '.$name.',
                <div style="margin-left: 20px">
                    <p>
                        Thanks for signing up! Welcome to '.$product.'!
                    </p>
                    <p>
                        Your account has been created, you can login with your credentials after you have activated your account by pressing the url below.
                    </p>    
                    <p>
                        Please click <a href=\''.$domain.'verify.php?email='.$email.'&hash='.$emailhash.'\'>here</a> to activate your account.
                        
                    </p>
                </div>
                <p>Sincerely,</p>
                <p><b>'.$product.' Team</b></p>
            </div>
            '; 
            if(!$mail->send()) 
            {
                $response["message"]="ERROR:".$mail->ErrorInfo;
                $response["success"]=0;
            } 
            else 
            {
                $response["message"]="Account registered Successfully. Please Check your email to verify!";
                $response["success"]=1;
            }
            setcookie("signup",$email,time() + 10);
        }
    }
    else
    {
        $response["message"]="Invalid Details Provided!";
        $response["success"]=0;
    }
}
else
{
    $response["message"]="Try After Sometime!";
    $response["success"]=0;
}
echo json_encode($response);
?>