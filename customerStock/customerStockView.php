<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>

<div id = "centerTitle">
    <h2>Customer Stock Levels: </h2>
</div>

<?php
//MYSQLI
$sql = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,
          i.ACTIVE,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          s.HIRE_NUMBER,
          s.CUSTOMER_ID,
          s.STOCK_ID,
          s.TOTAL_QUANTITY_IN,
          s.TOTAL_QUANTITY_NEEDED,
          s.HIRE_ACTIVE,

          c.CUSTOMER_ID,
          c.CUSTOMER_NAME,
          c.CUSTOMER_ACTIVE

FROM
  total_at_customer_table s inner join STOCK_ITEMS_TABLE i
    on s.STOCK_ID = i.STOCK_ID

    inner join customer_table c
      on s.CUSTOMER_ID = c.CUSTOMER_ID

   inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

ORDER BY HIRE_ACTIVE ASC, CUSTOMER_ACTIVE ASC, CUSTOMER_NAME ASC, ACTIVE ASC
";?>

<table id = 'viewTable'>
    <tr>
        <td colspan="3" style="border: 0px; "></td>
        <th colspan="3">Stock levels</th>
    </tr>
    <tr>
            <th>Customer</th>
            <th>Stock</th>
            <th>Type</th>
            <th>At Customer</th>
            <th>Hold</th>
            <th>Needed</th>
            <th>Details</th>
            <th>Active?</th>                <!--alt to delete keeps in table, but maintains data integrity-->
            <th>Update</th>
      </tr>

<?php
$result = $conn->query($sql);
$icount = 0;
$nonActive = 0;
$isActive = 0;
$neededCust = 0;

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $active = $row["ACTIVE"];
        $CUSTOMER_ACTIVE = $row["CUSTOMER_ACTIVE"];
        $HIRE_NUMBER = $row["HIRE_NUMBER"];
        $stockNeeded = $row["TOTAL_QUANTITY_NEEDED"] - $row["TOTAL_QUANTITY_IN"];
        $HIRE_ACTIVE = $row["HIRE_ACTIVE"];

        if( $active == 0 && $CUSTOMER_ACTIVE == 0 && $HIRE_ACTIVE == 0){
        ?>
            <tr>
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_IN"]?></td>     <!--add colour notifications-->
                <td><?php echo $row["TOTAL_QUANTITY_NEEDED"]?></td>
                <td
                <?php
                    if ($stockNeeded > 0)
                    {
                        echo " style = 'background-color: #FF6666;'";
                        $neededCust++;
                    }
                ?>


                ><?php echo $stockNeeded; ?></td>
                <td><a href=customerStockDetailsView.php?HIRE_NUMBER=<?php echo $HIRE_NUMBER ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Details </a></td>
                <td style= 'background-color: #59E059;'>Active</br>
                    <a href=customerStockDeactivate.php?HIRE_NUMBER=<?php echo $HIRE_NUMBER ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></td>
                </td>
                <td>
                    <a href=customerStockUpdate.php?HIRE_NUMBER=<?php echo $HIRE_NUMBER; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                </td>
            </tr>
        <?php
        $isActive++;
        }
        else
        {
?>
            <tr style="background-color: #FF8944; ">
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_IN"]?></td>     <!--add colour notifications-->
                <td><?php echo $row["TOTAL_QUANTITY_NEEDED"]?></td>
                <td>

                <?php
                    if ($CUSTOMER_ACTIVE == 1 && $active == 1){
                        echo "Stock & Customer ";
                    }
                    else if($active == 1){
                        echo "Stock ";
                    }
                    else if($CUSTOMER_ACTIVE == 1){
                        echo "Customer ";
                    }
                    else if ($HIRE_ACTIVE == 1)
                    {
                        echo "";
                    }?>

                Disabled</td>
                <td><a href=customerStockDetailsView.php?HIRE_NUMBER=<?php echo $HIRE_NUMBER ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Details </a></td>
                <td style="background-color: #FF6666;">
                <?php
                    if ($CUSTOMER_ACTIVE == 1 && $active == 1){
                        echo "Stock & Customer Disabled";
                    }
                    else if($active == 1){
                        echo "Stock Disabled";
                    }
                    else if($CUSTOMER_ACTIVE == 1){
                        echo "Customer Disabled";
                    }
                    else if ($HIRE_ACTIVE == 1)
                    {
                        echo "NOT Active<br/>
                        <a href=customerStockActivate.php?HIRE_NUMBER=$HIRE_NUMBER style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a>";
                    }
 ?>

</td>
                <td>
                    <a href=customerStockUpdate.php?HIRE_NUMBER=<?php echo $HIRE_NUMBER; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                </td>
            </tr>
<?php
            $nonActive++;
        }

        $icount++;
    }
}
echo "<tr><td colspan='9' align='center'><a href='customerStockAdd.php'>Add a new stock Item</a></td></tr>";

if($neededCust > 0)
{
    echo "<tr><td colspan='9' align='center' style='padding: 5px; background-color: #FF6666;'> You have <b>".$neededCust."</b> stock items(s) that needs more at the customer(s)</td> </tr>";
}
if($nonActive > 0){
    echo "<tr><td colspan='9' align='center'> You have ".$nonActive." Inactive stock item(s) in customer stock levels</td> </tr>";
}
if($isActive > 0){
    echo "<tr><td colspan='9' align='center'> You have ".$isActive." Active stock item(s) in customer stock levels</td> </tr>";
}
echo "<tr><td colspan='9' align='center'> You have ".$icount." Total stock item(s) in customer stock levels</td> </tr>";


echo "</table>";
