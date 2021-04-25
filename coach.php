<?php       
    session_start();
    function succ($name)
    {
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=coach.php?name=$name\">";
    }
    if(isset($_SESSION['admin']) && isset($_POST['submit'])) {
        require_once('db.php');
        $f=1;
        $fromname=mysqli_real_escape_string($stat,$_POST['fromname']);
        $step=mysqli_real_escape_string($stat,$_POST['step']);
        if($step == 0) {
            $col = "honest";
        } else if($step == 1) {
            $col = "hardwork";
        } else if($step == 2) {
            $col = "helpful";
        } 
        $question=mysqli_real_escape_string($stat,$_POST['question']);
        if ($question == "") {
            $f=0;
            ?>
            <script>
              var msg="Question cannot be empty";
            </script>
            <?php
        }
        $query2 = "SELECT * from coach WHERE name='$fromname'";
        $result2=mysqli_query($stat,$query2);
        $rows2 = mysqli_fetch_array($result2);
        if($rows2['step']==3) {
            $f=0;
            ?>
            <script>
              var msg="This Person has already given ratings.";
            </script>
            <?php
        }

        if($f==1) {
            $query1 = "SELECT * from coach WHERE name!='$fromname'";
            $result1=mysqli_query($stat,$query1);
            while($rows1=mysqli_fetch_array($result1)) {
                $name1=$rows1['name'];
                $coachid=$rows1['id'];
                if(isset($_POST[$coachid."star"])) {
                    $rate=mysqli_real_escape_string($stat,$_POST[$coachid."star"]);
                } else {
                    $rate='';
                }
                if($step==0) {
                    $query2 = "INSERT INTO `rating`(`id`, `name`, `toname`, `honesty`) VALUES (NULL, '$fromname', '$name1', '$rate')";
                } else {
                    $query2 = "UPDATE `rating` SET $col='$rate' WHERE name='$fromname' AND toname='$name1'";
                }
                mysqli_query($stat,$query2);
            }
            if($step==0) {
                $query3="INSERT INTO `question`(`id`, `name`, `honesty`) VALUES (NULL, '$fromname', '$question')";
            } else {
                $query3 = "UPDATE `question` SET $col='$question' WHERE name='$fromname'";
            }
            mysqli_query($stat,$query3);
            $query4 = "UPDATE `coach` SET step=step+1 WHERE name='$fromname'";
            mysqli_query($stat,$query4);
            succ($fromname);
        } else {
            ?>
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=rating.php\">";
            <script type="text/javascript">
                document.getElementById("incor1").innerHTML="ERROR : "+msg ;
            </script>
            <?php
        }       
        unset($_POST['submit']);
    }
    else if(!isset($_SESSION['admin']) || !isset($_GET['name']))
    {
        header("refresh:0,url=index.php");
    }
    else
    {
        $fromname = $_GET['name'];
        $name='';
        $id=$_SESSION['admin'];
        require_once('db.php');
        $query="SELECT * from admin WHERE id='$id'";
        $result=mysqli_query($stat,$query); 
        if($rows=mysqli_fetch_array($result))
        {
            $name=$rows['name'];
    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Interface</title>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/view.css" rel="stylesheet">
    <!-- Custom Fonts -->

    <link rel="stylesheet" href="css/bars-square.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">Admin Interface</a>
            </div>
            <?php
                require_once('topmenu.php');
                require_once('common.php');
            ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                    </li>
                    <li>
                        <a href="additem.php"><i class="fa fa-fw fa-plus"></i> <?php echo $additem ?></a>
                    </li>
                    <li>
                        <a href="viewitem.php"><i class="fa fa-fw fa-eye"></i> <?php echo $viewitem ?></a>
                    </li>
                    <li>
                        <a href="viewstock.php"><i class="fa fa-fw fa-eye"></i> <?php echo $viewstock ?></a>
                    </li>
                    <li>
                        <a href="itementry.php"><i class="fa fa-fw fa-edit"></i> <?php echo $itementry ?></a>
                    </li>
                    <li>
                        <a href="deleteitem.php"><i class="fa fa-fw fa-minus"></i> <?php echo $deleteitem ?></a>
                    </li>
                    <li>
                        <a href="summary.php"><i class="fa fa-fw fa-list-alt"></i> <?php echo $summary ?></a>
                    </li>
                    <li class="active">
                        <a href="rating.php"><i class="fa fa-fw fa-star-o"></i> <?php echo $rating ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <?php
            $queryx="SELECT * from coach WHERE name='$fromname'";
            $resultx=mysqli_query($stat,$queryx);
            $rows2 = mysqli_fetch_array($resultx);
            if(mysqli_num_rows($resultx)==0 || $rows2['step']==3) {
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=rating.php\">";
            }
            else {  
                $step = $rows2['step'];
                if($step == 0) {
                    $param = "Honesty";
                    $col = "honest";
                    $question = "Which coach inspires you with their honesty?";
                } else if($step == 1) {
                    $param = "Works hard to improve";
                    $col = "hardwork";
                    $question = "Which coach works very hard to improve?";
                } else if($step == 2) {
                    $param = "Helpful to other coaches";
                    $col = "helpful";
                    $question = "Which coach helps everyone the most?";
                } 
            ?>
        <div id="page-wrapper">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-fw fa-star-o"></i>
                            <?php echo $param; ?>
                        </h1>
                    </div>
                </div>
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <input hidden="" name="fromname" value="<?php echo $fromname; ?>">
                    <center><p id="incor1"></p></center>
                    <br>
                    <div id="rating">
                            <input hidden="" name="step" value="<?php echo $step; ?>">
                            <table class="table table-bordered table-hover table-striped" style="width: 95%;">
                                <tbody>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td><b><?php echo $param; ?></b></td>
                                    </tr>
                                    <?php
                                        $query="SELECT * from coach WHERE name!='$fromname' ORDER BY RAND ()";
                                        $result=mysqli_query($stat,$query);
                                        while($row=mysqli_fetch_array($result))
                                        {?>
                                            <tr>
                                                <td><?php echo $row['name'];?></td>
                                                <td>
                                                <select class="example-square" name="<?php echo $row['id'];?>star" autocomplete="off">
                                                  <option value=""></option>
                                                    <?php
                                                    for ($i=1; $i <=10 ; $i++) { 
                                                        ?>
                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                  
                                                </select> 
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <label for="question" class="col-lg-4"><?php echo $question; ?></label>
                                <div class="col-lg-2" id="question">
                                    <select name="question" id="name" class="form-control" required="true">
                                    <option disabled selected="" value="">Select Name</option>
                                    <?php
                                        echo $query1="SELECT name from coach WHERE name!='$fromname' ORDER BY RAND ()";
                                        $result1=mysqli_query($stat,$query1);
                                        while($rows1=mysqli_fetch_array($result1)) {
                                            ?>
                                            <option value="<?php echo $rows1['name'];?>"><?php echo $rows1['name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    ?>
                    </div>
                </div>
                <br>
                <button name="submit" class="btn btn-success" >Submit</button>
            </form>
                <br>
                <br>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <script src="js/jquery.barrating.js"></script>
    <script src="js/examples.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<?php

}
?>
</body>
</html>
