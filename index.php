<DOCTYPE html>
<html>
	<?php
		session_start();
		if(isset($_SESSION['admin']))
		{
			header("refresh:0,url=admin.php");
		} else {
	?>
	<head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<title>Admin Login</title>
		<body style="background-image:url(images/yuwa.png); background-repeat: no-repeat; background-size: 100%">
		<div class="container">
			<div class="info">
				<h1>Admin Login</h1>
			</div>
		</div>
		<div class="form">
			<div class="thumbnail"><img src="images/admin.png"/></div>
			<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
				<input type="text" placeholder="Username" value="" name="username" type="text" required autocomplete="off">
				<input type="password" placeholder="Password" name="password" value="" required autocomplete="off">
				<p id="incor1"></p>
				<button name="submit1">Login</button>
			</form>
		</div>
		</body>
	</head>
	<?php
		require_once("db.php");
		if(isset($_POST['submit1']))
		{
			$f=1;
		    if(isset($_POST['username'])) 
                $username=mysqli_real_escape_string($stat,$_POST['username']);
            else
            {
                $f=0;
                ?>  
                <script>
                    var msg="Username cannot be empty!!";
                </script>
                <?php
            }
			if(isset($_POST['password'])) 
                $password=mysqli_real_escape_string($stat,$_POST['password']);
            else
            {
                $f=0;
                ?>  
                <script>
                    var msg="Password cannot be empty!!";
                </script>
                <?php
            }
            if($f==1)
	        {
	            $query3="SELECT * FROM admin where name='$username';";
	            $result3=mysqli_query($stat,$query3);
	            if(mysqli_num_rows($result3)==1 && $r=mysqli_fetch_array($result3))
	            {
	                if(crypt($password,$r['password'])==$r['password'])
	                {
	                    $_SESSION['admin']=$r['id'];
	                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=admin.php\">";
	                }
	                else
	                {
	                    $f=0;
	                    ?>
	                    <script>
	                        var msg="Username or Password is incorrect !! ";
	                    </script>
	                    <?php
	                }
	            }
	            else
	            {
	                $f=0;
	                ?>
	                <script>
	                    var msg="Username or Pasword is incorrect !! ";
	                </script>
	                <?php
	            }   
	        }
	        if($f==0)
            {?>
                <script>
                document.getElementById("incor1").innerHTML="ERROR : "+msg ;
                </script>
                <?php
            }
		}
	}
	?>
</html>