<?php
session_start();
if(isset($_SESSION['admin']))
{
    require_once("db.php");
    if(isset($_GET['equipment']))
    {?>
        <div style="width: 50%; float: left;">
            <select class="form-control" id="modelitem" name="model" onchange="load1()"> 
                <option value="" selected="selected" disabled>Select</option>
                <?php
                $equipment=$_GET['equipment'];  
                if($equipment!="Other") {
                    echo $query="SELECT model from inventory WHERE equipment='$equipment' GROUP BY model ";
                    $result=mysqli_query($stat,$query);
                    while($row=mysqli_fetch_array($result))
                    {?>
                        <option value="<?php echo $row['model'];?>"><?php echo $row['model'];?></option>
                        <?php
                    }
                    ?>
                    <option value="Other">Other</option>
                    </select>
                    </div>
                    <div style="width: 50%; float: left; visibility: hidden;" class="col-lg-3">
                        <input name="newmodel" id="newmodel" class="form-control" type="text">
                    </div>
                    <?php
                }
                else {
                    ?>
                        <option value="Other" selected="selected">Other</option>
                        </select>
                        </div>
                        <div style="width: 50%; float: left;" class="col-lg-3">
                            <input name="newmodel" id="newmodel" placeholder="Enter Model Name" class="form-control" type="text">
                        </div>
                    <?php
                }
            ?>
        <?php
    }
}
else
{
  header("refresh:0;url=index.php");
}
?>