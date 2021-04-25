<?php
session_start();
if(isset($_SESSION['admin']))
{
    require_once("db.php");
    if(isset($_GET['equipment']))
    {?>
        <div style="width: 50%; float: left;">
            <?php
            $equipment=$_GET['equipment'];
            list($item, $brand, $model, $size) = explode("-", $equipment);  
            $query="SELECT SUM(quantity) AS sumquantity from inventory WHERE income=0 && equipment='$item' && brand='$brand' && model='$model' && size='$size' GROUP BY equipment, brand, model, size;";
            $result=mysqli_query($stat,$query);
            $sumquantity=0;
            if($row=mysqli_fetch_array($result))
            {
            	$sumquantity+=$row['sumquantity'];
            }
            $query="SELECT SUM(quantity) AS sumquantity from inventory WHERE income=1 && equipment='$item' && brand='$brand' && model='$model' && size='$size' GROUP BY equipment, brand, model, size;";
            $result=mysqli_query($stat,$query);
            if($row=mysqli_fetch_array($result))
            {
            	$sumquantity-=$row['sumquantity'];
            }
            ?>
            <input name="quantity" class="form-control" style="width:100%" placeholder="Enter Quantity" type="number" min="0" max="<?php echo $sumquantity; ?>" required autocomplete="off"
            >
        </div>
        <div style="width: 40%; float:left; margin-left: 10px;">
            <?php
            echo "Quantity Available:".$sumquantity;
            ?>
        </div>	
        <?php
    }
}
else
{
  header("refresh:0;url=index.php");
}
?>


