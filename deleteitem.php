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
                    <li>
                        <a href="itementry.php"><i class="fa fa-fw fa-edit"></i> <?php echo $itementry ?></a>
                    </li>
                    <li class="active">
                        <a href="deleteitem.php"><i class="fa fa-fw fa-minus"></i> <?php echo $deleteitem ?></a>
                    </li>
                    <li>
                        <a href="summary.php"><i class="fa fa-fw fa-list-alt"></i> <?php echo $summary ?></a>
                    </li>
                    <li>
                        <a href="rating.php"><i class="fa fa-fw fa-list-alt"></i> <?php echo $rating ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <i class="fa fa-fw fa-gift"></i>
                        <?php echo $deleteitem; ?>
                    </h1>
                </div>
            </div>
        <div class="container-fluid">
                <h1>Sale</h2>
            <table class="table table-bordered table-hover table-striped" style="width: 95%;">
            <tbody>
                <tr>
                    <td><b>Date</b></td>
                    <td><b>Team</b></td>
                    <td><b>Item</b></td>
                    <td><b>Brand</b></td>
                    <td><b>Model</b></td>
                    <td><b>Size</b></td>
                    <td><b>Given For</b></td>
                    <td><b>Price</b></td>
                    <td><b>No.</b></td>
                    <td><b>Delete</b></td>
                </tr>
                <?php
                    require_once('db.php');
                    $query="SELECT * from inventory where income=1 Order BY id desc";
                    // $query=$query." ORDER BY id desc;";
                    $result=mysqli_query($stat,$query);
                    $i=1;
                    $total=0;
                    while($rows=mysqli_fetch_array($result))
                    {   
                        ?>  <tr>
                                <td><?php echo sprintf("%02d", $rows['date'])." - ".sprintf("%02d",$rows['month'])." - ".$rows['year']; ?></td>
                                <td><?php echo $rows['team'];?></td>
                                <td><?php echo $rows['equipment'];?></td>
                                <td><?php echo $rows['brand'];?></td>
                                <td><?php echo $rows['model'];?></td>
                                <td><?php echo $rows['size'];?></td>
                                <td><?php echo $rows['givento'];?></td>
                                <td><?php echo $cost = $rows['cost']; ?></td>
                                <td><?php echo $quantity = $rows['quantity']; ?></td>
                                <td><a href="delete.php?id=<?php echo $rows['id'] ?>">Delete</a></td>
                            </tr>
                            <?php    
                            $i++;
                    }
                    if($total!=0) {
                        ?>
                            <tr>
                                <td colspan="7"><b>Total Amount<b></td>
                                <td><?php echo $total; ?></td>
                        <?php
                    }
                    ?>

            </tbody>
            </table>
        </div>
        <div class="container-fluid">
                <h1>Stock</h2>
            <table class="table table-bordered table-hover table-striped" style="width: 95%;">
            <tbody>
                <tr>
                    <td><b>Date</b></td>
                    <td><b>Item</b></td>
                    <td><b>Brand</b></td>
                    <td><b>Model</b></td>
                    <td><b>Size</b></td>
                    <td><b>Shop</b></td>
                    <td><b>Given To</b></td>
                    <td><b>Price</b></td>
                    <td><b>No.</b></td>
                    <td><b>Delete</b></td>
                </tr>
                <?php
                    require_once('db.php');
                    $query="SELECT * from inventory where income=0 Order BY id desc";
                    // $query=$query." ORDER BY id desc;";
                    $result=mysqli_query($stat,$query);
                    $i=1;
                    $total=0;
                    while($rows=mysqli_fetch_array($result))
                    {   
                        ?>  <tr>
                                <td><?php echo sprintf("%02d", $rows['date'])." - ".sprintf("%02d",$rows['month'])." - ".$rows['year']; ?></td>
                                <td><?php echo $rows['equipment'];?></td>
                                <td><?php echo $rows['brand'];?></td>
                                <td><?php echo $rows['model'];?></td>
                                <td><?php echo $rows['size'];?></td>
                                <td><?php echo $rows['receivedfrom'];?></td>
                                <td><?php echo $rows['givento'];?></td>
                                <td><?php echo $cost = $rows['cost']; ?></td>
                                <td><?php echo $quantity = $rows['quantity']; ?></td>
                                <td><a href="delete.php?id=<?php echo $rows['id'] ?>">Delete</a></td>
                            </tr>
                            <?php    
                            $i++;
                    }
                    if($total!=0) {
                        ?>
                            <tr>
                                <td colspan="7"><b>Total Amount<b></td>
                                <td><?php echo $total; ?></td>
                        <?php
                    }
                    ?>

            </tbody>
            </table>
        </div>
        <br><br>
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
    