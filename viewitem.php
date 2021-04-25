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
            if(isset($_POST['year'])) {
                $iyear=mysqli_real_escape_string($stat,$_POST['year']);    
            } else {
                $iyear="";
            }
            if(isset($_POST['team'])) {
                $iteam=mysqli_real_escape_string($stat,$_POST['team']);    
            } else {
                $iteam="";
            }
            if(isset($_POST['month'])) {
                $imonth=mysqli_real_escape_string($stat,$_POST['month']);    
            } else {
                $imonth="";
            }
            if(isset($_POST['equipment'])) {
                $iequipment=mysqli_real_escape_string($stat,$_POST['equipment']);    
            } else {
                $iequipment="";
            }
            if(isset($_POST['brand'])) {
                $ibrand=mysqli_real_escape_string($stat,$_POST['brand']);    
            } else {
                $ibrand="";
            }
            if(isset($_POST['model'])) {
                $imodel=mysqli_real_escape_string($stat,$_POST['model']);    
            } else {
                $imodel="";
            }
            if(isset($_POST['size'])) {
                $isize=mysqli_real_escape_string($stat,$_POST['size']);    
            } else {
                $isize="";
            }
            if(isset($_POST['receivedfrom'])) {
                $ireceivedfrom=mysqli_real_escape_string($stat,$_POST['receivedfrom']);    
            } else {
                $ireceivedfrom="";
            }
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
                    <li class="active">
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
                    <li>
                        <a href="rating.php"><i class="fa fa-fw fa-star-o"></i> <?php echo $rating ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid" >
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <i class="fa fa-fw fa-gift"></i>
                        <?php echo $viewitem; ?>
                    </h1>
                </div>
            </div>
            
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="row">
                        <label for="formyear" class="col-lg-1">Year:</label>
                        <div class="col-lg-2" id="formyear">
                            <select name="year" class="form-control" required="true">
                            <option value="" disabled>Select Year</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT year from inventory GROUP BY year";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($iyear==$rows1['year']){
                                        ?>
                                        <option selected="" value="<?php echo $rows1['year'];?>"><?php echo $rows1['year']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $rows1['year'];?>"><?php echo $rows1['year']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div id="month" class="row">
                        <label class="col-lg-1">Month:</label>
                        <div class="col-lg-2">
                            <select name="month" class="form-control" required="">
                            <option value="" disabled>Select Month</option>
                            <option selected="">ALL</option>
                            <?php
                                for($i=1; $i<=12; $i++) {
                                    if($imonth==$i) {
                                        ?>
                                        <option selected=""><?php echo $i; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option><?php echo $i; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-lg-1">Team:</label>
                        <div class="col-lg-2">
                            <select name="team" class="form-control" required="true">
                            <option value="" disabled>Select Team</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT team from inventory WHERE team!='' GROUP BY team";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($iteam==$rows1['team']) {
                                        ?>
                                        <option selected="" value="<?php echo $rows1['team'];?>"><?php echo $rows1['team']; ?></option>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <option value="<?php echo $rows1['team'];?>"><?php echo $rows1['team']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-lg-1">Brand:</label>
                        <div class="col-lg-2">
                            <select name="brand" class="form-control" required="true">
                            <option value="" disabled>Select Brand</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT brand from inventory GROUP BY brand";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($ibrand==$rows1['brand']) {
                                        ?>
                                        <option selected="" value="<?php echo $rows1['brand'];?>"><?php echo $rows1['brand']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $rows1['brand'];?>"><?php echo $rows1['brand']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div id="" class="row">
                        <label class="col-lg-1">Equipment:</label>
                        <div class="col-lg-2">
                            <select name="equipment" id="equipment" class="form-control" onchange="load()" required="">
                            <option value="" disabled>Select Equipment</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT equipment from inventory GROUP BY equipment";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($iequipment==$rows1['equipment']) {
                                        ?>
                                        <option selected="" value="<?php echo $rows1['equipment']; ?>"><?php echo $rows1['equipment']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $rows1['equipment']; ?>"><?php echo $rows1['equipment']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div id="model">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-1">Given For</label>
                        <div class="col-lg-2">
                            <select name="givento" class="form-control" required="true">
                            <option value="" disabled>Select Name</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT receivedfrom from inventory WHERE income=1 GROUP BY receivedfrom ORDER BY id";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($ireceivedfrom==$rows1['receivedfrom']) {
                                        ?>
                                        <option selected="" value="<?php echo $rows1['receivedfrom'];?>"><?php echo $rows1['receivedfrom']; ?></option>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <option value="<?php echo $rows1['receivedfrom'];?>"><?php echo $rows1['receivedfrom']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                </div>
                <br>
                <button name="submit" class="btn btn-success" >Submit</button>
            </form>
                <br>
                <br>
                <?php
                if(isset($_POST['submit'])) {

                    require_once('db.php');
                    $f=1;
                    $query = "SELECT * from inventory WHERE income=1 ";
                    $year=mysqli_real_escape_string($stat,$_POST['year']);
                    if($year!="ALL") {
                        $query=$query."&& year='$year'";
                    } else {
                        $query=$query."&& year!=''";
                    }
                    $month=mysqli_real_escape_string($stat,$_POST['month']);
                    if($month!="ALL") {
                        $query=$query." && month='$month'";
                    } 
                    $team=mysqli_real_escape_string($stat,$_POST['team']);
                    if($team!="ALL") {
                        $query=$query." && team='$team'";
                    } else {
                        $query=$query." && team!=''";
                    }
                    $brand=mysqli_real_escape_string($stat,$_POST['brand']);
                    if($brand!="ALL") {
                        $query=$query." && brand='$brand'";
                    } 
                    $equipment=mysqli_real_escape_string($stat,$_POST['equipment']);
                    if($equipment!="ALL") {
                        $query=$query." && equipment='$equipment'";
                    } 
                    $model="ALL";
                    if($equipment!="ALL") {
                        $model=mysqli_real_escape_string($stat,$_POST['model']);    
                    } 
                    if($model!="ALL") {
                        $query=$query." && model='$model'";
                    }
                    $givento=mysqli_real_escape_string($stat,$_POST['givento']);
                    if($givento!="ALL") {
                        $query=$query." && givento='$givento'";
                    }
                    if ($year == "" || $month =="") {
                        $f=0;
                        ?>
                        <script>
                          var msg="Date cannot be empty";
                        </script>
                        <?php
                    }

                    ?>
                    <table class="table table-bordered table-hover table-striped" style="width: 95%;">
                    <tbody>
                        <tr>
                            <td><b>Date</b></td>
                            <td><b>Team</b></td>
                            <td><b>Items</b></td>
                            <td><b>Brand</b></td>
                            <td><b>Model</b></td>
                            <td><b>Size</b></td>
                            <td><b>Given For</b></td>
                            <td><b>Given To</b></td>
                            <td><b>Price</b></td>
                            <td><b>No.</b></td>
                            <td><b>Amount</b></td>
                        </tr>
                        <?php
                            require_once('db.php');
                            $query=$query." ORDER BY id desc;";
                            $result=mysqli_query($stat,$query);
                            $i=1;
                            $total=0;
                            $ids="";
                            while($rows=mysqli_fetch_array($result))
                            {   
                                $ids=$ids.$rows['id'].",";
                                ?>  <tr>
                                        <td><?php echo sprintf("%02d", $rows['date'])."-".sprintf("%02d", $rows['month'])."-".$rows['year']; ?></td>
                                        <td><?php echo $rows['team'];?></td>
                                        <td><?php echo $rows['equipment'];?></td>
                                        <td><?php echo $rows['brand'];?></td>
                                        <td><?php echo $rows['model'];?></td>
                                        <td><?php echo $rows['size'];?></td>
                                        <td><?php echo $rows['receivedfrom'];?></td>
                                        <td><?php echo $rows['givento'];?></td>
                                        <td><?php echo $cost = $rows['cost']; ?></td>
                                        <td><?php echo $quantity = $rows['quantity']; ?></td>
                                        <td><?php echo $cost*$quantity; $total+=$cost*$quantity; ?></td>
                                    </tr>
                                    <?php    
                                    $i++;
                            }
                            if($total!=0) {
                                ?>
                                    <tr>
                                        <td colspan="9"><b>Total Amount<b></td>
                                        <td><?php echo $total; ?></td>
                                <?php
                            }
                            ?>

                    </tbody>
                </table>
                    <?php
                    if($i>1) {
                        ?>
                        <a href="excel.php?ids=<?php echo $ids; ?>">Download In Excel</a>
                        <?php
                    }
                   unset($_POST['submit']);
                }
                ?>
                <br>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
        function load()
        {
            var st=document.getElementById('equipment');
            var equipment=st.options[st.selectedIndex].text;
            $.get("model.php?equipment="+equipment,function(data,status)
            {
               document.getElementById("model").innerHTML=data;
            });    
        }
    </script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

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
