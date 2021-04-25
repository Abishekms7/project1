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
                    <li>
                        <a href="itementry.php"><i class="fa fa-fw fa-edit"></i> <?php echo $itementry ?></a>
                    </li>
                    <li>
                        <a href="deleteitem.php"><i class="fa fa-fw fa-minus"></i> <?php echo $deleteitem ?></a>
                    </li>
                    <li class="active">
                        <a href="summary.php"><i class="fa fa-fw fa-list-alt"></i> <?php echo $summary ?></a>
                    </li>
                    <li>
                        <a href="rating.php"><i class="fa fa-fw fa-star-o"></i> <?php echo $rating ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <script type="text/javascript">
            function setSelectedValue(selectObj, valueToSet) {
                // alert(valueToSet);
                for (var i = 0; i < selectObj.options.length; i++) {
                    // alert(valueToSet+"---"+selectObj.options[i].text);
                    if (selectObj.options[i].text== valueToSet) {
                        selectObj.options[i].selected = true;
                        return;
                    }
                }
            }
        </script>
        <div id="page-wrapper">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-fw fa-gift"></i>
                            <?php echo $summary; ?>
                        </h1>
                    </div>
                </div>
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="row">
                        <label for="formyear" class="col-lg-1">Year:</label>
                        <div class="col-lg-2" id="formyear">
                            <select id="selectyear" name="year" class="form-control" required="true">
                            <option disabled>Select Year</option>
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
                            <select id="selectmonth" name="month" class="form-control" required="">
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
                    <div id="" class="row">
                        <label class="col-lg-1">Equipment:</label>
                        <div class="col-lg-2">
                            <select id="selectequipment" name="equipment" class="form-control" required="">
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
                        <label class="col-lg-1">Brand:</label>
                        <div class="col-lg-2">
                            <select name="brand" id="selectbrand" class="form-control" required="">
                            <option value="" disabled>Select brand</option>
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
                            <?php
                            if($ibrand!="") {
                                ?>
                                <script>
                                    var objSelect = document.getElementById("selectbrand");
                                    // alert(objSelect.options[1].text);
                                    alert(<?php echo $ibrand ?>);
                                    setSelectedValue(objSelect, <?php echo $ibrand?>);
                                </script>
                                    <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-lg-1">Model:</label>
                        <div class="col-lg-2">
                            <select name="model" id="model" class="form-control" required="">
                            <option value="" disabled>Select Model</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT model from inventory GROUP BY model";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($imodel==$rows1['model']) {
                                        ?>
                                        <option selected="" value="<?php echo $rows1['model'];?>"><?php echo $rows1['model']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $rows1['model'];?>"><?php echo $rows1['model']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-lg-1">Size:</label>
                        <div class="col-lg-2">
                            <select name="size" id="size" class="form-control" required="">
                            <option value="" disabled>Select Size</option>
                            <option selected="">ALL</option>
                            <?php
                                $query1="SELECT size from inventory GROUP BY size";
                                $result1=mysqli_query($stat,$query1); 
                                while($rows1=mysqli_fetch_array($result1)) {
                                    if($isize==$rows1['size']) {
                                        ?>
                                        <option selected="" value="<?php echo $rows1['size'];?>"><?php echo $rows1['size']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $rows1['size'];?>"><?php echo $rows1['size']; ?></option>
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
                    ?>
                    <table class="table table-bordered table-hover table-striped" style="width: 95%;">
                    <tbody>
                        <tr>
                            <td><b>Item</b></td>
                            <td><b>Brand</b></td>
                            <td><b>Model</b></td>
                            <td><b>Size</b></td>
                            <td><b>Remaining Quantity</b></td>
                            <td><b>Income</b></td>
                            <td><b>Expenditure</b></td>
                        </tr>
                        <?php
                            require_once('db.php');
                            //$query1="SELECT SUM(quantity) AS sumquant, SUM(cost) AS sumcost, equipment from inventory WHERE ";
                            $query1="SELECT * from inventory WHERE ";
                            $iequipment=$equipment=mysqli_real_escape_string($stat,$_POST['equipment']);
                            if($equipment!="ALL") {
                                $query1=$query1." equipment='$equipment'";
                            } else {
                                $query1=$query1." equipment!=''";
                            }
                            $ibrand=$brand=mysqli_real_escape_string($stat,$_POST['brand']);
                            if($brand!="ALL") {
                                $query1=$query1." && brand='$brand'";
                            }
                            $imodel=$model=mysqli_real_escape_string($stat,$_POST['model']);
                            if($model!="ALL") {
                                $query1=$query1." && model='$model'";
                            }
                            $isize=$size=mysqli_real_escape_string($stat,$_POST['size']);
                            if($size!="ALL") {
                                $query1=$query1." && size='$size'";
                            }
                            $query1=$query1." GROUP BY equipment,brand,model,size";
                            $result1=mysqli_query($stat,$query1);
                            $totalincome=0;
                            $totalexpenditure=0;
                            while($rows1=mysqli_fetch_array($result1))
                            {
                                $item=$rows1['equipment'];
                                $brand=$rows1['brand'];
                                $model=$rows1['model'];
                                $size=$rows1['size'];
                                $query2="SELECT SUM(quantity) AS sumquant, SUM(cost) AS sumcost, equipment from inventory WHERE equipment='$item' && brand='$brand' && model='$model' && size='$size' ";
                                $iyear=$year=mysqli_real_escape_string($stat,$_POST['year']);
                                
                                if($year!="ALL") {
                                    $query2=$query2."&& year='$year'";
                                } else {
                                    $query2=$query2."&& year!=''";
                                }
                                $imonth=$month=mysqli_real_escape_string($stat,$_POST['month']);
                                if($month!="ALL") {
                                    $query2=$query2." && month='$month'";
                                }
                                $query3=$query2." && income = 1 GROUP By equipment";
                                $query4=$query2." && income = 0 GROUP By equipment";
                                $query5="SELECT SUM(quantity) AS sumquant from inventory WHERE equipment='$item' && brand='$brand' && model='$model' && size='$size'";
                                $query6=$query5." && income = 1 GROUP By equipment";
                                $query7=$query5." && income = 0 GROUP By equipment";
                                $result3=mysqli_query($stat,$query3);
                                $result4=mysqli_query($stat,$query4);
                                $result6=mysqli_query($stat,$query6);
                                $result7=mysqli_query($stat,$query7);
                                ?>
                                <tr>
                                    <td><?php echo $item; ?></td>
                                    <td><?php echo $brand; ?></td>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $size; ?></td>
                                    <?php 
                                        $incomecost = 0;
                                        $expensecost = 0;
                                        $quantity = 0;
                                        if($rows3=mysqli_fetch_array($result3)) {
                                            $incomecost = ($rows3['sumcost']*$rows3['sumquant']);
                                        }
                                        if($rows4=mysqli_fetch_array($result4)) {
                                            $expensecost = $rows4['sumcost']*$rows4['sumquant'];
                                        }
                                        if($rows6=mysqli_fetch_array($result6)) {
                                            $quantity -= $rows6['sumquant'];
                                        }
                                        if($rows7=mysqli_fetch_array($result7)) {
                                            $quantity += $rows7['sumquant'];
                                        }
                                    ?>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $incomecost; 
                                    $totalincome+=$incomecost;
                                    ?></td>
                                    <td><?php echo $expensecost; 
                                    $totalexpenditure+=$expensecost;
                                    ?></td>

                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                    <td colspan="5" style=""><b>Total</b></td>
                                    <td><b><?php echo $totalincome ?></b></td>
                                    <td><b><?php echo $totalexpenditure ?></b></td>
                                </tr>
                    </tbody>
                </table>
                <?php
                unset($_POST['submit']);
            }
            ?>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
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
    