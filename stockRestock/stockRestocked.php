<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


$STOCK_ID = $_POST['STOCK_ID'];
$RESTOCK_DATE  = null; //$get current datetime;
$RESTOCK_QUANTITY = $_POST['RESTOCK_QUANTITY'];

//may need to get from stock table
$STOCK_TOTAL = $_POST['STOCK_TOTAL'];
$STOCK_IN = $_POST['STOCK_IN'];

$updatedTotal = $RESTOCK_QUANTITY + $STOCK_TOTAL;
$updatedIn = $RESTOCK_QUANTITY + $STOCK_IN;


//add to restock table
// prepare and bind
$stmt = $conn->prepare("INSERT INTO STOCK_RESTOCK_TABLE (
  STOCK_ID,
  RESTOCK_QUANTITY
)
VALUES (?, ?)");

$stmt->bind_param("ii", $ID, $QUANTITY);

// set parameters and execute
$ID = $STOCK_ID;
$QUANTITY = $RESTOCK_QUANTITY;

$stmt->execute();




//////////////////////////////////////////////////////////////////////////

// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
    STOCK_IN = ?,
    STOCK_TOTAL = ?
WHERE STOCK_ID = '$STOCK_ID' ");

$stmt->bind_param("ii", $in, $total);

// set parameters and execute
// set parameters and execute
$in = $updatedIn;
$total = $updatedTotal;

$stmt->execute();


$stmt->close();
$conn->close();
header("refresh:0; url=stockRestockItemsView.php");

?>