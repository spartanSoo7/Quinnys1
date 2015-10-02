<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


$STOCK_ID = $_POST['STOCK_ID'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];

$TOTAL_QUANTITY_IN = 0;
$TOTAL_QUANTITY_NEEDED = $_POST['TOTAL_QUANTITY_NEEDED'];
$HIRE_ACTIVE = 0;

/*
 *
 * CHECK TO SEE IF HOLD LVL ALREADY EXITS
 *
 */
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


echo "<h1 style='text-align: center'>Customer stock totals/Hold level has been Added successfully </h1> </br>";


//save the new hold lvl into the total hold lvl on the stock page

//find the current total stock lvl
//MYSQLI
$sql = "SELECT STOCK_ID, STOCK_NEEDED FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$STOCK_ID'";
$result2 = $conn->query($sql);

if ($result2->num_rows > 0) {
    // output data of each row

    while ($row = $result2->fetch_assoc()) {
        $totalStockHoldLvl = $row["STOCK_NEEDED"];
        $newTotalStockHoldLvl = $totalStockHoldLvl + $TOTAL_QUANTITY_NEEDED;
    }
}



//update total stock hold level
// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
    STOCK_NEEDED = ?
WHERE STOCK_ID = '$STOCK_ID' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totHoldLvl);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totHoldLvl = $newTotalStockHoldLvl;

$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}


echo "<h1 style='text-align: center'>Total stock Hold level has been updated successfully </h1> </br>";

include '../include/footer.php';

$stmt->close();
$conn->close();

header("refresh:3; url=customerStockView.php");
?>