<?php       
    session_start();
    function succ()
    {
        ?>
        <script type="text/javascript">
            alert("Item Successfully added!!")
        </script>
        <?php
    }
    if(!isset($_SESSION['admin']))
    {
        header("refresh:0,url=index.php");
    }
    else
    {
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

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="assets/ico/favicon.png">

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
                    <li class="active">
                        <a href="itementry.php"><i class="fa fa-fw fa-edit"></i> <?php echo $itementry ?></a>
                    </li>
                    <li>
                        <a href="deleteitem.php"><i class="fa fa-fw fa-minus"></i> <?php echo $deleteitem ?></a>
                    </li>
                    <li>
                        <a href="summary.php"><i class="fa fa-fw fa-list-alt"></i> <?php echo $summary ?></a>
                    </li>
                    <li>
                        <a href="rating.php"><i class="fa fa-fw fa-star-o"></i> <?php echo $rating ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
                <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-fw fa-gift"></i>
                            <?php echo $itementry; ?>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                            <table class="table table-bordered table-hover table-striped">
                                <tbody>
                                    <center><p id="incor1"></p></center>
                                    <tr>
                                        <td><strong>Date</strong></td>
                                        <td>
                                            <input name="date" class="form-control" style="width:100%" type="date" required autocomplete="off" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Team</strong></td>
                                        <td>
                                            <div style="width: 50%; float: left;">
                                                <select onchange="loadteam()" id="team" name="team" required="" class="form-control">
                                                    <option disabled="" selected="">Select</option>
                                                    <?php
                                                        $query1="SELECT * from inventory where team!='' GROUP BY team";
                                                        $result1=mysqli_query($stat,$query1); 
                                                        while($rows1=mysqli_fetch_array($result1)) {
                                                            ?>
                                                            <option value="<?php echo $rows1['team'];?>"><?php echo $rows1['team']; ?></option>
                                                            <?php
                                                        }
                                                        
                                                    ?>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <script>
                                                function loadteam()
                                                {
                                                    var st=document.getElementById('team');
                                                    var model=st.options[st.selectedIndex].text;
                                                    if(model=="Other") {
                                                        document.getElementById("newteam").style.visibility="visible";
                                                    }
                                                    else {
                                                        document.getElementById("newteam").style.visibility="hidden";
                                                        document.getElementById("newteam").value="";
                                                    }
                                                }
                                            </script>
                                            </div>  
                                            <div style="width: 50%; float: left;" class="col-lg-3">
                                                <input id="newteam" name="newteam" class="form-control" type="text" placeholder="Enter Team Name" style="visibility: hidden;">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Equipment</strong>
                                            <br>
                                            (Item-Brand-Model-Size)
                                        </td>
                                        <td>
                                            <!--<input  name="equipment" class="form-control" style="width:50%" type="text" required autocomplete="off">-->
                                            <div style="width: 50%; float: left;">
                                            <select onchange="loadquantity()" id="equipment" name="equipment" required="" class="form-control">
                                                <option disabled="" selected="">Select</option>
                                                <?php
                                                    $query1="SELECT * from inventory WHERE income=0 GROUP BY equipment,brand,model,size";
                                                    $result1=mysqli_query($stat,$query1); 
                                                    while($rows1=mysqli_fetch_array($result1)) {
                                                        ?>
                                                        <option><?php echo $rows1['equipment']."-".$rows1['brand']."-".$rows1['model']."-".$rows1['size']; ?></option>
                                                        <?php
                                                    }
                                                    
                                                ?>
                                            </select>
                                            </div>
                                            <div style="width: 50%; float: left;" class="col-lg-3">
                                                <input id="newEquipment" name="newequipment" class="form-control" type="text" style="visibility: hidden;">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quantity</strong></td>
                                        <td>
                                            <script type="text/javascript">
                                                function loadquantity()
                                                {
                                                    var st=document.getElementById('equipment');
                                                    var equipment=st.options[st.selectedIndex].text;
                                                    document.getElementById("newEquipment").value="";
                                                    $.get("getquantity.php?equipment="+equipment,function(data,status)
                                                    {
                                                       document.getElementById("quantity").innerHTML=data;
                                                    });
                                                }
                                            </script>
                                            <div id="quantity"></div>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Cost</strong></td>
                                        <td><input name="amount" class="form-control" style="width:100%" type="number" min="0" required autocomplete="off"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Given For</strong></td>
                                        <td><input name="for" class="form-control" style="width:100%" type="text" required autocomplete="off" value=""></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Given To</strong></td>
                                        <td><input name="to" class="form-control" style="width:100%" type="text" required autocomplete="off" value=""></td>
                                    </tr>
                                </tbody>
                            </table>                    
                            <button onclick="return confirm('Confirm submission?');" name="submit" class="btn btn-success" >Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php  
    if(isset($_POST['submit']))
    {
        require_once('db.php');
        $f=1;
        $date=mysqli_real_escape_string($stat,$_POST['date']);
        $equipment=mysqli_real_escape_string($stat,$_POST['equipment']);
        list($item, $brand, $model, $size) = explode("-", $equipment);  
        $to=mysqli_real_escape_string($stat,$_POST['to']);
        $gfor=mysqli_real_escape_string($stat,$_POST['for']);
        $amount=mysqli_real_escape_string($stat,$_POST['amount']);
        $quantity=mysqli_real_escape_string($stat,$_POST['quantity']);
        $team=mysqli_real_escape_string($stat,$_POST['team']);
        if($team=="Other") {
            $team=mysqli_real_escape_string($stat,$_POST['newteam']);
        }
        if ($date == "") {
            $f=0;
            ?>
            <script>
              var msg="Date cannot be empty";
            </script>
            <?php
        }
        if ($item == "") {
            $f=0;
            ?>
            <script>
              var msg="Equipment cannot be empty";
            </script>
            <?php
        }
        if ($model == "") {
            $f=0;
            ?>
            <script>
              var msg="Model cannot be empty";
            </script>
            <?php
        }
        if ($brand == "") {
            $f=0;
            ?>
            <script>
              var msg="Brand cannot be empty";
            </script>
            <?php
        }
        if ($amount == "") {
            $f=0;
            ?>
            <script>
              var msg="Amount cannot be empty";
            </script>
            <?php
        }
        if ($quantity == "" || $quantity==0) {
            $f=0;
            ?>
            <script>
              var msg="Quantity cannot be empty";
            </script>
            <?php
        }
        $queryx="SELECT SUM(quantity) AS sumquantity from inventory WHERE income=0 && equipment='$item' && brand='$brand' && model='$model' && size='$size' GROUP BY equipment, brand, model, size;";
        $resultx=mysqli_query($stat,$queryx);
        $sumquantityx=0;
        if($rowx=mysqli_fetch_array($resultx))
        {
            $sumquantityx+=$rowx['sumquantity'];
        }
        $queryy="SELECT SUM(quantity) AS sumquantity from inventory WHERE income=1 && equipment='$item' && brand='$brand' && model='$model' && size='$size' GROUP BY equipment, brand, model, size;";
        $resulty=mysqli_query($stat,$queryy);
        if($rowy=mysqli_fetch_array($resulty))
        {
            $sumquantityx-=$rowy['sumquantity'];
        }
        if ($quantity > $sumquantityx) {
            $f=0;
            ?>
            <script>
              var msg="The given Quantity is not available.";
            </script>
            <?php
        }
        if ($size == "") {
            $f=0;
            ?>
            <script>
              var msg="Size cannot be empty";
            </script>
            <?php
        }
        if ($to == "") {
            $f=0;
            ?>
            <script>
              var msg="Given To cannot be empty";
            </script>
            <?php
        }
        if ($gfor == "") {
            $f=0;
            ?>
            <script>
              var msg="Given To cannot be empty";
            </script>
            <?php
        }
        if($f==1)
        {
            list($year, $month, $day) = explode('-', $date);
            $query="INSERT INTO `inventory`(`id`, `equipment`,`model` ,`cost`, `quantity`, `date`, `month`, `year`, `brand`, `size`, `givento`, `receivedfrom`, `income`, `team`) VALUES (NULL,'$item','$model','$amount','$quantity','$day','$month','$year', '$brand', '$size', '$to', '$gfor', '1', '$team')";
            mysqli_query($stat,$query);
            $query="INSERT INTO `backup`(`id`, `equipment`,`model` ,`cost`, `quantity`, `date`, `month`, `year`, `brand`, `size`, `givento`, `income`, `team`) VALUES (NULL,'$item','$model','$amount','$quantity','$day','$month','$year', '$brand', '$size', '$to', '$gfor', '1', '$team')";
            mysqli_query($stat,$query);
            succ();
       }
       else
       {
            ?>
            <script type="text/javascript">
                document.getElementById("incor1").innerHTML="ERROR : "+msg ;
            </script>
            <?php
       }
       unset($_POST['submit']);
    }
    ?>
    <!-- jQuery -->
    <script src="js/jquery-1.12.0.min.js"></script>    
        <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>
<?php 
        }
        else
        {
            header("refresh:0,url=index.php");
        }
    }?>
</html>
    