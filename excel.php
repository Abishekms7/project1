<?php
    include_once("xlsxwriter.class.php");
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);
    if(isset($_GET['ids']))
    {
        require_once('db.php');
        $ids=mysqli_real_escape_string($stat,$_GET['ids']);
        // $out='';
        $ids=rtrim($ids, ',');
        $ids= str_replace(',', ' or id=', $ids);
        $query1="SELECT * from inventory WHERE id=$ids";
        $result1=mysqli_query($stat,$query1);
        if(mysqli_num_rows($result1)>0) 
        {
            $out = array(array("S.No", "Date", "Team", "Equipment", "Model", "Brand", "Size", "Given To", "Quantity", "Cost", "Amount"));

            // $out.= '<table class="table" bordered="2">
            //             <tr>
            //                 <th>S.No</th>
            //                 <th>Date</th>
            //                 <th>Team</th>
            //                 <th>Equipment</th>
            //                 <th>Model</th>
            //                 <th>Brand</th>
            //                 <th>Size</th>
            //                 <th>Given To</th>
            //                 <th>Quantity</th>
            //                 <th>Cost</th>
            //                 <th>Amount</th>
            //             </tr>
            // ';
            $s=1;
            $total=0;
            while($row=mysqli_fetch_array($result1))
            {
                array_push($out, array($s++, sprintf("%02d",$row["date"]).'/'.sprintf("%02d",$row["month"]).'/'.$row["year"],
                $row["team"], $row["equipment"], $row["model"], $row["brand"], $row["size"], $row["givento"], $row["quantity"], $row["cost"], $row["quantity"]*$row["cost"])); 
                // $out.='
                // <tr>
                //     <td>'. $s++ .'</td>
                //     <td>'. sprintf("%02d",$row["date"]).'/'.sprintf("%02d",$row["month"]).'/'.$row["year"] .'</td>
                //     <td>'. $row["team"] .'</td>
                //     <td>'. $row["equipment"] .'</td>
                //     <td>'. $row["model"] .'</td>
                //     <td>'. $row["brand"] .'</td>
                //     <td>'. $row["size"] .'</td>
                //     <td>'. $row["givento"] .'</td>
                //     <td>'. $row["quantity"] .'</td>
                //     <td>'. $row["cost"] .'</td>
                //     <td>'. $row["quantity"]*$row["cost"] .'</td>
                // </tr>
                // ';
                $total+=$row['quantity']*$row['cost'];
            }
            array_push($out, array("", "", "", "", "", "", "", "", "", "Total Amount", $total));
            // $out.='
            // <tr>
            //     <td colspan="10"><b>Total Amount</b></td>
            //     <td>'.$total.'</td>
            // <tr>
            // ';
            // $out.='</table>';
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8");
            header("Content-Disposition: attachment; filename=SellItem.xlsx");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            // echo $out;
            $writer = new XLSXWriter();
            $writer->writeSheet($out);
            $writer->writeToStdOut();
            exit(0);
        }
    }
    else
    {
        header("refresh:0,url=viewitem.php");
    } 
?>  