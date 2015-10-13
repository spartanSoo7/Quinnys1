<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

//$HIRE_LINE_NUMBER = $_POST['HIRE_LINE_NUMBER'];
$HIRE_QUANTITY = $_POST['HIRE_QUANTITY'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$STOCK_ID = $_POST['STOCK_ID'];
$HIRE_NUMBER;
$TOTAL_QUANTITY_IN;


//find stock price for further down
$HIRE_COST;

//to use further down, while updating stock levels at quinnys
$STOCK_IN;
$STOCK_OUT;


//query
$sqlTotAtCust = "SELECT `HIRE_COST`, `STOCK_IN`, `STOCK_OUT` FROM `stock_items_table`
                    WHERE STOCK_ID = '$STOCK_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        //echo "</br>Stock Price is: " .$row["HIRE_COST"];
        $HIRE_COST = $row["HIRE_COST"];

        //set value to be used futher down
        $STOCK_IN = $row["STOCK_IN"];
        $STOCK_OUT = $row["STOCK_OUT"];
    }
}

if($HIRE_QUANTITY > $STOCK_IN){
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>You cannot hire out more stock than you have instock at your premises</h3>";
    Die();
}



//check to see if a row in the total_at_customer_table has been created
//may not be created if there is no hold level set and this is the first time the customer is ordering this stock item

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

    }
}
else{
    //echo "brah it dont exist yet</br>Just let me create it</br></br>";

    $TOTAL_QUANTITY_IN = 0;
    $TOTAL_QUANTITY_NEEDED = 0;
    $HIRE_ACTIVE = 0;


// prepare and bind
    $stmt = $conn->prepare("INSERT INTO total_at_customer_table (
  STOCK_ID,
  CUSTOMER_ID,
  TOTAL_QUANTITY_IN,
  TOTAL_QUANTITY_NEEDED,
  HIRE_ACTIVE
)
VALUES (?, ?, ?, ?, ?)");

    if ( false===$stmt )
    {
        //if not a valid/ready statement object
        include '../include/Error.php';

        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("iiiii", $sockID, $customerID, $totalIn, $totalNeed, $active);

    if ( false===$stmt )
    {
        //if can't bind the parameters.
        include '../include/Error.php';

        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

// set parameters and execute
    $sockID = $STOCK_ID;
    $customerID = $CUSTOMER_ID;
    $totalIn = $TOTAL_QUANTITY_IN;
    $totalNeed = $TOTAL_QUANTITY_NEEDED;
    $active = $HIRE_ACTIVE;

    $stmt->execute();

    if ( false===$stmt )
    {
        //if execute() failed
        include '../include/Error.php';

        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }

    //echo "brah New total at customer has been created successfully, with a hold level of 0";

    /*
     * Find new hire_number
     */
    $sqlTotAtCust = "SELECT `HIRE_NUMBER`, `TOTAL_QUANTITY_IN` FROM `total_at_customer_table`
                    WHERE STOCK_ID = '$STOCK_ID' AND CUSTOMER_ID = '$CUSTOMER_ID' ";

//run query
    $result = $conn->query($sqlTotAtCust);


    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {
            //echo "<br><br>hire number: " .$row["HIRE_NUMBER"];
            $HIRE_NUMBER = $row["HIRE_NUMBER"];
            $TOTAL_QUANTITY_IN = $row["TOTAL_QUANTITY_IN"];  //for later when updating this record
        }
    }
    else{
        include '../include/Error.php';
        echo "<h3 style = 'color: white; text-align: center'>Something broke</h3>";
        die();
    }

}
/*
 * checked to see if a total_at_customer_table row has been created
 * if it did not exist yet, it exists now
 */




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

echo "<br><h1 style='text-align: center; '>Hire Line updated successfully</h1>";
include '../include/footer.php';
/*
 * Quinnys stock levels are now updated
 */

//$stmt->close();
$conn->close();

header("refresh:3; url=hireLineView.php");
?>