<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Home </a>
</div>

<div id = "centerTitle">
    <h2>Customer Stock Levels: </h2>
    <a href="../customerStock/customerStockPrint.php">Print friendly version (all active hold levels)</a>
</br>
</br>
    <a href="../customerStock/customerStockPrintCust.php">Print friendly version (only active hold levels NEEDING stock)</a>
</div>

<!---->






















<?php
if(isset($_POST['submit']))
{
    $CUSTOMER_ID = $_POST['CUSTOMER_ID'];
    $STOCK_ID = $_POST['STOCK_ID'];
    ?>

    <div id="custForm">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


        <div id="custFormFloat" style="width: 27%; font-size: 14px; height: 64px; min-width: 320px; margin-top: 2px; ">
            Stock (Name/ Description  |  Type  |  Size  |  Colour)
            <select name="STOCK_ID" id="STOCK_ID" style="width: 100%; font-size: 16px; " required>
<?php
$sql = "
SELECT
  i.*,
  t.*
FROM
  STOCK_ITEMS_TABLE i inner join STOCK_TYPE_TABLE t
on
  i.STOCK_TYPE_ID = t.STOCK_TYPE_ID
ORDER BY STOCK_TYPE_NAME ASC, STOCK_NAME ASC
";

            $result3 = $conn->query($sql);

                if ($result3->num_rows > 0)
                {
                    // output data of each row
                    if($STOCK_ID == "All"){
                        echo "<option id='All' value = 'All' selected>All</option>";
                    }
                    else{
                        echo "<option id='All' value = 'All'>All</option>";
                    }
                    while ($row = $result3->fetch_assoc())
                    {
                        $activeStock = $row["ACTIVE"];
                        if ($activeStock == 0)
                        {
                            $name = $row["STOCK_NAME"];
                            $outputString = $row["STOCK_NAME"]. " | " .$row["STOCK_TYPE_NAME"]. " |  " .$row["SIZE"]. " |  " .$row["COLOUR1"];

                            echo "<option id='" .$row["STOCK_ID"]. "' value = '" .$row["STOCK_ID"]. "'";

                            if ($row["STOCK_ID"] == $STOCK_ID)
                            {
                                echo "selected";
                            }
                            echo ">" .$outputString. "</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div id="custFormFloat" style="width: 20%; font-size: 14px; height: 64px; min-width: 209px; margin-top: 3px; ">
            Customer (Name and Address)
            <select name="CUSTOMER_ID" id="CUSTOMER_ID" style="width: 100%; font-size: 17px; " required>
<?php
    $sql = "
      SELECT
        `CUSTOMER_ID`,
        `CUSTOMER_NAME`,
        `CUSTOMER_ACTIVE`,
        `CUSTOMER_PHYSICAL_ADDRESS`
      FROM `customer_table`
    ";

    $result2 = $conn->query($sql);

            if ($result2->num_rows > 0)
            {
                // output data of each row
                if($CUSTOMER_ID == "All")
                {
                    echo "<option id='All' value = 'All' selected>All</option>";
                }
                else
                {
                    echo "<option id='All' value = 'All'>All</option>";
                }

                while ($row = $result2->fetch_assoc())
                {
                    $activeCustomer = $row["CUSTOMER_ACTIVE"];

                        if ($activeCustomer == 0)
                        {
                            echo "<option id='" . $row["CUSTOMER_ID"] . "' value = '" . $row["CUSTOMER_ID"] . "'";

                            if ($row["CUSTOMER_ID"] == $CUSTOMER_ID)
                            {
                                echo "selected";
                            }

                            echo ">" . $row["CUSTOMER_NAME"] . " | " . $row["CUSTOMER_PHYSICAL_ADDRESS"] . "</option>";
                        }
                }
            }
?>
            </select>
       </div>

        <div id = "custFormFloat" style="width: 6%; margin-top: 34px; height: 17px; ">
            <input type="submit" name="submit" value="Go!">
        </div>
    </form>
</div>

//}


<!-------------------------->


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

ORDER BY CUSTOMER_ACTIVE ASC, ACTIVE ASC, HIRE_ACTIVE ASC, CUSTOMER_NAME ASC, STOCK_TYPE_NAME
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
