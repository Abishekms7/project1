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

        <div id="page-wrapper">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-fw fa-star-o"></i>
                            <?php echo $rating; ?>
                        </h1>
                    </div>
                </div>
                    <center><p id="incor1"></p></center>
                    <div class="row">
                        <label for="formyear" class="col-lg-1">Name</label>
                        <div class="col-lg-2" id="formyear">
                            <select name="fromname" id="name" class="form-control" required="true" onchange="load()">
                            <option value="" disabled selected="">Select Name</option>
                            <?php
                                $query1="SELECT name from coach WHERE step!=3";
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
                    <br>
                    <div id="rating">
                        <script type="text/javascript">
                            function load()
                            {
                                var st=document.getElementById('name');
                                var name=st.options[st.selectedIndex].text;
                                // $.get("coach.php?name="+name,function(data,status)
                                // {
                                //    document.getElementById("rating").innerHTML=data;
                                // });    
                                window.location.href = "coach.php?name="+name;
                            }
                        </script>
                    </div>
                </div>
                <br>
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

</body>
<?php 
        }
        else
        {
            header("refresh:0,url=index.php");
        }
    }?>
    

</html>
