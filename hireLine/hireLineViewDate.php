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
    <h2>Billing By Date: </h2>
</div>
<script>
    /*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
    $(document).ready(

        /* This is the function that will get executed after the DOM is fully loaded */
        function () {
            $( ".datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,//this option for allowing user to select month
                changeYear: true //this option for allowing user to select from year range
            });
        }

    );
</script>



<?php
if(isset($_POST['submit']))
{
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $CUSTOMER_ID = $_POST['CUSTOMER_ID'];

//if check hire contains anything, turn on
    if(isset($_POST['checkHire'] ) ){
        $checkHire = 0;
    }
    else{
        $checkHire = 1; //1==off
    }

    if(isset( $_POST['checkDam'] ) ){
        $checkDam = 0;
    }
    else{
        $checkDam = 1;
    }
    ?>

    <div id="custForm">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div id = "custFormFloat" style="width: 18%; min-width: 209px; margin-top: 31px;">
            Start Date:
            <input type="text" class="datepicker" size="6" name="startDate" value="<?php echo $startDate;?>" required>
        </div>
        <div id = "custFormFloat" style="width: 18%; min-width: 203px; margin-top: 31px;">
            End Date:
            <input type="text" class="datepicker" size="6" name="endDate" value="<?php echo $endDate;?>" required>
        </div>
        <div id = "custFormFloat" style="width: 9%; min-width: 107px; margin-top: 31px;">
            Hire lines:
            <input type="checkbox" name="checkHire" value="0"
            <?php
            if($checkHire == 0){
                echo "checked";
            }
            ?>
            ></div>
        <div id = "custFormFloat" style="width: 13%; min-width: 159px;  margin-top: 31px;">
            Damaged Stock:
            <input type="checkbox" name="checkDam" value="0"
            <?php
                if($checkDam == 0){
                    echo "checked";
                }
            ?>
        ></div>

        <div id = "custFormFloat" style="width: 20%; font-size: 14px; height: 64px; min-width: 209px;  ">
            Customer (Name and Address)
            <select name="CUSTOMER_ID" id="CUSTOMER_ID" style="width: 100%;" required>
                <option>
                <?php
                   $sql = "SELECT `CUSTOMER_ID`, `CUSTOMER_NAME`, `CUSTOMER_ACTIVE`, `CUSTOMER_PHYSICAL_ADDRESS` FROM `customer_table`";
                   $result2 = $conn->query($sql);

                   if ($result2->num_rows > 0) {
                       // output data of each row
                       while ($row = $result2->fetch_assoc())
                       {
                           $activeCustomer = $row["CUSTOMER_ACTIVE"];
                           if ($activeCustomer == 0)
                           {
                               echo "<option id='" .$row["CUSTOMER_ID"]. "' value = '" .$row["CUSTOMER_ID"]. "'";

                               if($row["CUSTOMER_ID"] == $CUSTOMER_ID){
                                    echo "selected";
                               }

                               echo ">" .$row["CUSTOMER_NAME"]. " | " .$row["CUSTOMER_PHYSICAL_ADDRESS"]. "</option>";
                           }
                       }
                   }
                ?>
            </select>
        </div>

        <div id = "custFormFloat" style="width: 6%; margin-top: 34px;">
            <input type="submit" name="submit" value="Go!">
        </div>
    </form>
</div>
<?php

//new format is 2015-09-01
    $startDateFormatted = date('Y-m-d', (strtotime($startDate)) );
    $endDateFormatted = date('Y-m-d', (strtotime($endDate)) );

    //add time
    $startDateFormatted = $startDateFormatted. ' 00:00:00';
    $endDateFormatted = $endDateFormatted. ' 23:59:59';  //without telling the query the end date ends at midnight it doesnt out put data on that day


//MYSQLI for customer display
    $sqlCust = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          s.HIRE_NUMBER,
          s.CUSTOMER_ID,
          s.STOCK_ID,

          c.CUSTOMER_ID,
          c.CUSTOMER_NAME,

          n.HIRE_LINE_NUMBER,
          n.HIRE_QUANTITY,
          n.HIRE_LINE_COST_TOTAL,
          n.HIRE_DATE

FROM
    hire_transaction_table n inner join total_at_customer_table s
    on n.HIRE_NUMBER = s.HIRE_NUMBER

    inner join STOCK_ITEMS_TABLE i
    on s.STOCK_ID = i.STOCK_ID

    inner join customer_table c
      on s.CUSTOMER_ID = c.CUSTOMER_ID

   inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

WHERE c.CUSTOMER_ID = '$CUSTOMER_ID' && n.HIRE_DATE between '$startDateFormatted' and '$endDateFormatted'

ORDER BY HIRE_DATE ASC
";



    //MYSQLI for damaged stock display
$sqlDam = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          c.CUSTOMER_ID,
          c.CUSTOMER_NAME,

          d.DAMAGED_LINE_ID,
          d.CUSTOMER_ID,
          d.STOCK_ID,
          d.DAMAGED_QUANTITY,
          d.DAMAGED_TOTAL_COST,
          d.DAMAGED_DATE

FROM
    DAMAGED_TABLE d inner join customer_table c
      on d.CUSTOMER_ID = c.CUSTOMER_ID

    inner join STOCK_ITEMS_TABLE i
    on d.STOCK_ID = i.STOCK_ID

   inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

WHERE c.CUSTOMER_ID = '$CUSTOMER_ID' && d.`DAMAGED_DATE` between '$startDateFormatted' and '$endDateFormatted'

ORDER BY DAMAGED_DATE ASC
";

    //initialise the total amount to charge the customer
    $totalCost = 0;

    echo "<table id = 'viewTable' style='margin-top: 120px; '>";

    if($checkDam == 0 || $checkHire == 0){
        echo "
                <tr>
                    <th>Customer Name</th>
                    <th>Stock Name</th>
                    <th>Stock Type</th>
                    <th>Bill Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Cost</th>
                </tr>";

        /*
         * IF CUSTOMER BOX IS CHECKED
         */
        if ($checkHire == 0){
            $resultCust = $conn->query($sqlCust);

            if ($resultCust->num_rows > 0)
            {
                // output data of each row

                while ($row = $resultCust->fetch_assoc())
                {
                    $totalCost = $totalCost + $row["HIRE_LINE_COST_TOTAL"];
                    echo "
            <tr>
                <td>
                    " .$row["CUSTOMER_NAME"]. "
                </td>
                <td>
                    " .$row["STOCK_NAME"]. "
                </td>
                <td>
                    " .$row["STOCK_TYPE_NAME"]. "
                </td>
                <td>
                    Hired
                </td>
                <td>
                    " .$row["HIRE_QUANTITY"]. "
                </td>
                <td>
                    " .$row["HIRE_DATE"]. "
                </td>
                <td>
                    $" .$row["HIRE_LINE_COST_TOTAL"]. "
                </td>
            </tr>
        ";
                }

            }
            else{
                echo "<tr>
            <th colspan='7'>
                <h1 style='width: 100%; margin: 10px 0 0 0; text-align: center'>
                    No bills for hiring stock are found for this customer, in this date range.
                <h1>
            </th>
        </tr>";
            }
        }
        /*
         * END OF CUSTOMER DISPLAY
         */




 /*
 * IF DAMAGED BOX IS CHECKED
 */
        if ($checkDam == 0){
            $resultDam = $conn->query($sqlDam);

            if ($resultDam->num_rows > 0)
            {
                // output data of each row

                while ($row = $resultDam->fetch_assoc())
                {
                    $totalCost = $totalCost + $row["DAMAGED_COST_TOTAL"];
                    echo "
            <tr>
                <td>
                    " .$row["CUSTOMER_NAME"]. "
                </td>
                <td>
                    " .$row["STOCK_NAME"]. "
                </td>
                <td>
                    " .$row["STOCK_TYPE_NAME"]. "
                </td>
                <td>
                    Damaged
                </td>
                <td>
                    " .$row["DAMAGED_TOTAL_QUANTITY"]. "
                </td>
                <td>
                    " .$row["DAMAGED_DATE"]. "
                </td>
                <td>
                    $" .$row["DAMAGED_COST_TOTAL"]. "
                </td>
            </tr>
        ";
                }

            }
            else{
                echo "<tr>
            <th colspan='7'>
                <h1 style='width: 100%; margin: 10px 0 0 0; text-align: center'>
                    No bills for damaged stock are found for this customer, in this date range.
                <h1>
            </th>
        </tr>";
            }
        }
        /*
         * END OF DAMAGED DISPLAY
         */


        /*
         * Display tottal cost
         */

        echo    "<tr>
            <td colspan='5' style='border-bottom: 0px; border-left: 0px;'></td>
            <th>Total Cost</th>
            <td>$";

        //format cost to 2 decimal places
        echo number_format((float)$totalCost, 2, '.', '');

        echo "</td>
        </tr>";

    }
    else{   //else no check boxes where checked
        echo "<tr>
            <th colspan='7'>
                <h1 style='width: 100%; margin: 150px 0 0 0; text-align: center'>
                    No bills for this customer in this date range
                <h1>
            </th>
        </tr>";
    }

echo "</table>";

?>

    <!--Print friendly link--->
    <form id="FormName" action="hireLineViewDatePrint.php" method="post" name="FormName" style="width: 50%; margin: 0 auto; ">
        <input type="submit" id="submit" name="submitButtonName" value="Printable version" style="width: 100%; "/>
        <input type="hidden" name="endDateFormatted" value="<?php echo $endDateFormatted ?>"/>
        <input type="hidden" name="startDateFormatted" value="<?php echo $startDateFormatted ?>"/>
        <input type="hidden" name="endDate" value="<?php echo $endDate ?>"/>
        <input type="hidden" name="startDate" value="<?php echo $startDate ?>"/>
        <input type="hidden" name="CUSTOMER_ID" value="<?php echo $CUSTOMER_ID ?>"/>
        <input type="hidden" name="checkHire" value="<?php echo $checkHire ?>"/>
        <input type="hidden" name="checkDam" value="<?php echo $checkDam ?>"/>
    </form>


<?php
    /*
     * ELSE nothing has been set yet
     */
}
else{
    ?>
    <div id="custForm">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div id = "custFormFloat" style="width: 18%; min-width: 209px; margin-top: 31px; ">
            Start Date:</th>
            <input type="text" size="6" class="datepicker" name="startDate" required>
        </div>
        <div id = "custFormFloat" style="width: 20%; min-width: 203px; margin-top: 31px; ">
            End Date:
            <input type="text" size="6" class="datepicker" name="endDate" required>
        </div>
        <div id = "custFormFloat" style="width: 9%; min-width: 107px; margin-top: 31px;">
            Hire lines:
            <input type="checkbox" name="checkHire" value="0">
        </div>
        <div id = "custFormFloat" style="width: 13%; min-width: 159px; margin-top: 31px;">
            Damaged Stock:
            <input type="checkbox" name="checkDam" value="0">
        </div>
        <div id = "custFormFloat" style="width: 20%; font-size: 14px; height: 64px; min-width: 209px; ">
            Customer (Name and Address)
            <select name="CUSTOMER_ID" id="CUSTOMER_ID" style="width: 100%;" required>
                        <option selected disabled hidden value=''></option>
                        <?php
                        $sql = "SELECT `CUSTOMER_ID`, `CUSTOMER_NAME`, `CUSTOMER_ACTIVE`, `CUSTOMER_PHYSICAL_ADDRESS` FROM `customer_table`";
                        $result2 = $conn->query($sql);


                        if ($result2->num_rows > 0) {
                            // output data of each row
                            while ($row = $result2->fetch_assoc())
                            {
                                $activeCustomer = $row["CUSTOMER_ACTIVE"];
                                if ($activeCustomer == 0)
                                {
                                    echo "<option id='" .$row["CUSTOMER_ID"]. "' value = '" .$row["CUSTOMER_ID"]. "'>" .$row["CUSTOMER_NAME"]. " | " .$row["CUSTOMER_PHYSICAL_ADDRESS"]. "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
        </div>
        <div id = "custFormFloat" style="width: 6%; margin-top: 34px;">
            <input type="submit" name="submit" value="Go!">
        </div>
    </form>
<?php
}

echo "</div>";


include '../include/footer.php';
$conn->close();
?>