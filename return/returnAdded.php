<!--
--Page was built by Kane Wardle
-->
<?php
require("../include/securitycheck.php");
include '../include/head.php';
include_once("../include/databaselogin.php");

//$HIRE_LINE_NUMBER = $_POST['HIRE_LINE_NUMBER'];
$RETURNED_QUANTITY = $_POST['RETURNED_QUANTITY'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$STOCK_ID = $_POST['STOCK_ID'];


echo "<br>Returned amount: " .$RETURNED_QUANTITY;
echo "<br>Customer id: " .$CUSTOMER_ID;
echo "<br>Stock id: " .$STOCK_ID;

/*check to see if customer has any of the stock they are trying to return
 *
 *check to see if customer actually has that amount of stock on their premises to actually return
 *
 * check to see if any damaged goods are being return
 *      add damaged table
 *
 * add returned line
 *
 * change customer stock lvls
 *
 * change quinnys stock lvls
 */




//to use further down, while updating stock levels at quinnys
$STOCK_IN;
$STOCK_OUT;
$STOCK_NAME;
$HIRE_NUMBER;
$TOTAL_QUANTITY_IN;


//query to get quinnys current stock lvls
$sqlTotAtCust = "SELECT `STOCK_IN`, `STOCK_NAME`, `STOCK_OUT` FROM `stock_items_table`
                    WHERE STOCK_ID = '$STOCK_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc())
    {
        //set value to be used futher down
        $STOCK_IN = $row["STOCK_IN"];
        $STOCK_OUT = $row["STOCK_OUT"];
        $STOCK_NAME = $row["STOCK_NAME"];

        echo "<br>Stock in at quinnys: " .$STOCK_IN;
        echo "<br>Stock out at quinnys: " .$STOCK_OUT;
        echo "<br>Stock name: " .$STOCK_NAME;
    }
}


//For errors
//get customer name
$sqlTotAtCust = "SELECT `CUSTOMER_NAME` FROM `customer_table` WHERE CUSTOMER_ID = '$CUSTOMER_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        //echo "hire number: " .$row["HIRE_NUMBER"];
        $CUSTOMER_NAME = $row["CUSTOMER_NAME"];

    }
}
else{
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>Error getting Customer Name</h3>";
    Die();

}
//end of getting customer name


//check to see if a row in the total_at_customer_table exists
$sqlTotAtCust = "SELECT `HIRE_NUMBER`, `TOTAL_QUANTITY_IN` FROM `total_at_customer_table`
                    WHERE STOCK_ID = '$STOCK_ID' AND CUSTOMER_ID = '$CUSTOMER_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        //echo "hire number: " .$row["HIRE_NUMBER"];
        $HIRE_NUMBER = $row["HIRE_NUMBER"];
        $TOTAL_QUANTITY_IN = $row["TOTAL_QUANTITY_IN"];  //for later when updating this record
        //we have confirmed that this customer has stock totals for this stock

        echo "<br>The hire number is: " .$HIRE_NUMBER;
        echo "<br>The total quantity in at customer is: " .$TOTAL_QUANTITY_IN;

        //next we have to make sure the customers stock total doesnt go into the negative
        if($RETURNED_QUANTITY > $TOTAL_QUANTITY_IN)
        {
            include '../include/header.php';
            include '../include/Error.php';
            echo "<h3 style = 'color: white; text-align: center;'>The  customer: " .$CUSTOMER_NAME. " only has: " .$TOTAL_QUANTITY_IN. " on at their premises. You are trying to return: " .$RETURNED_QUANTITY. "</h3>";
            Die();
        }

    }
}
else{
    //there is no record of this stock at this customer, so the records will not be created
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>No record found for customer: " .$CUSTOMER_NAME. " for the stock: " .$STOCK_NAME. "</h3>";
    Die();
}



die();




//need to check that code works

//haven't done past
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/*
 * Now we can make the hire_transaction, as the total_at_customer row exists.
 * but first we need to find the stock price from above
 */


//but whats the overall cost of this transaction?
//cost * quantity
$HIRE_LINE_COST_TOTAL = $HIRE_COST * $HIRE_QUANTITY;

// prepare and bind
$stmt = $conn->prepare("INSERT INTO hire_transaction_table (
  HIRE_NUMBER,
  HIRE_QUANTITY,
  HIRE_LINE_COST_TOTAL
)
VALUES (?,?,?) ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/Error.php';

    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("iid", $HIRE_NUM, $HIRE_QUAN, $HIRE_COST);


// set parameters and execute
$HIRE_NUM = $HIRE_NUMBER;
$HIRE_QUAN = $HIRE_QUANTITY;
$HIRE_COST = $HIRE_LINE_COST_TOTAL;

$stmt->execute();


//echo "New hire transaction has been created successfully";


/*
 * The transaction has now been recorded, now we need to update the customer stock levels and total stock levels
 *
 * lets do the customer stock levels first
 */

//get current customer stock level from above, that we have already found


//calc new total at customer
$newTotalCust = $TOTAL_QUANTITY_IN + $HIRE_QUANTITY;

// prepare and bind
$stmt = $conn->prepare("UPDATE total_at_customer_table SET
    TOTAL_QUANTITY_IN = ?
WHERE HIRE_NUMBER = '$HIRE_NUMBER' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/Error.php';

    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totalIn);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/Error.php';

    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totalIn = $newTotalCust;


$stmt->execute();

//echo "<br>Total at customer table updated successfully";

/*
 * the total at the customer is now set, now the total stock for quinnys needs to be updated
 */


//what to change stock totals to
//get total stock in (from further up) - $HIRE_QUANTITY
//get total stock out (from further up) + $HIRE_QUANTITY

$newTotalStockIn = $STOCK_IN  - $HIRE_QUANTITY;
$newTotalStockOut = $STOCK_OUT + $HIRE_QUANTITY;


/*echo "<br>quantity going out" .$HIRE_QUANTITY. "<br><br>
        <br>original stock in at quinnys: " .$STOCK_IN.
        "<br>original Stock out at quinnys: " . $STOCK_OUT.
        "<br><br>new stock in at quinnys:: " .$newTotalStockIn. "
        <br> new Stock out at quinnys: " .$newTotalStockOut. "<br>
";*/


/*
 * change stock table
 */

// prepare and bind
$stmt = $conn->prepare("UPDATE stock_items_table SET
    STOCK_OUT = ?,
    STOCK_IN = ?
WHERE STOCK_ID = '$STOCK_ID' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/Error.php';

    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("ii", $out, $in);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/Error.php';

    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$out = $newTotalStockOut;
$in = $newTotalStockIn;


$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/Error.php';

    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

/*
 * Quinnys stock levels are now updated
 */

//$stmt->close();
$conn->close();

//header("refresh:0; url=hireLineView.php");
?>