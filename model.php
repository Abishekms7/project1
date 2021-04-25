<?php
session_start();
if(isset($_SESSION['admin']))
{
    require_once("db.php");
    if(isset($_GET['equipment']))
    {
        $equipment=$_GET['equipment']; 
        if($equipment!="ALL") {
            ?>
            <label class="col-lg-1">Model:</label>
            <div class="col-lg-2">
                <select class="form-control" id="modelitem" name="model" onchange="load1()"> 
                    <option value="" disabled>Select Model</option>
                    <option selected="selected">ALL</option>
                    <?php
                        echo $query="SELECT model from inventory WHERE equipment='$equipment' GROUP BY model ";
                        $result=mysqli_query($stat,$query);
                        while($row=mysqli_fetch_array($result))
                        {?>
                            <option value="<?php echo $row['model'];?>"><?php echo $row['model'];?></option>
                            <?php
                        }
                        ?>
                </select>
            </div>
            <?php
        }
    }
}
else
{
  header("refresh:0;url=index.php");
}
?>