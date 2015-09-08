<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <h2>something may have broken </h2>

<?php
//Array ( [RESTOCK_QUANTITY] => 111 [submitButtonName] => Add Stock [STOCK_ID] => 4 [STOCK_TOTAL] => 500 [STOCK_IN] => 500 )

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


echo "New record created successfully";

/*


//need to update stock
   /* $update = "UPDATE STOCK_ITEMS_TABLE SET
      STOCK_IN = '$updatedIn',
      STOCK_TOTAL = '$updatedTotal'
      WHERE STOCK_ID = '$STOCK_ID' ";

    mysql_query($update);

    header( 'Location:stockRestockItemsView.php' ) ;

*/



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

echo "records updated successfully";

$stmt->close();
$conn->close();
header( 'Location:stockRestockItemsView.php' );
?>