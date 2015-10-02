<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");
?>


<?php
    $startDateFormatted = $_POST['startDateFormatted'];
    $endDateFormatted = $_POST['endDateFormatted'];
    $CUSTOMER_ID = $_POST['CUSTOMER_ID'];
    $checkHire = $_POST['checkHire'];
    $checkDam = $_POST['checkDam'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];



//MYSQLI
//find customer name
$sql = "SELECT CUSTOMER_ID, CUSTOMER_NAME FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$CUSTOMER_ID'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
?>

        <div id = "centerTitle">
            <h2>Billing for <?php echo $row["CUSTOMER_NAME"];?></h2>
            <h3>For the days:</br><?php echo $startDate?> - <?php echo $endDate; ?></h3>
            <p>(Date range is inclusive)</p>
        </div>

<?php
    }
}
?>




<?php

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
                        <td colspan='4'>There are no Bills for hiring</td>
                        <td>From:</br>" .$startDate. " to " .$endDate. "</td>
                        <td>$0</td>
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
                        <td colspan='4'>There are no Bills for damaged stock</td>
                        <td>From:</br>" .$startDate. " to " .$endDate. "</td>
                        <td>$0</td>
                     </tr>";
            }
        }
        /*
         * END OF DAMAGED DISPLAY
         */


        /*
         * Display total cost
         */

        echo    "<tr>
            <td colspan='4' style='border-bottom: 0px; border-left: 0px;'></td>
            <th>Total Cost</th>
            <td>$";

        //format cost to 2 decimal places
        echo number_format((float)$totalCost, 2, '.', '');

        echo "</td>
        </tr>";

    }
    else{   //else no check boxes where checked

    }

echo "</table>";
$conn->close();
?>