<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <h2>something may have broken </h2>

<?php



$STOCK_ID = $_POST['STOCK_ID'];

$RESTOCK_DATE  = null; //$get current datetime;
$RESTOCK_QUANTITY = $_POST['RESTOCK_QUANTITY'];


//get from stock table
$qP = "SELECT * FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$STOCK_ID'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);

$STOCK_TOTAL = trim($STOCK_TOTAL);
$STOCK_IN = trim($STOCK_IN);

$updatedTotal = $RESTOCK_QUANTITY + $STOCK_TOTAL;
$updatedIn = $RESTOCK_QUANTITY + $STOCK_IN;

echo "<br>restock date " .$RESTOCK_DATE;
echo "<br>restock num " .$RESTOCK_QUANTITY;
echo "<br>starting stock total " .$STOCK_TOTAL;
echo "<br>starting stock in " .$STOCK_IN;
echo "<br>updated stock total " .$updatedTotal;
echo "<br>updated stock in "  .$updatedIn;

$query = "INSERT INTO STOCK_RESTOCK_TABLE (
	STOCK_ID, RESTOCK_QUANTITY
	)
	VALUES (
	'$STOCK_ID', '$RESTOCK_QUANTITY'
	)";

$results = mysql_query($query);

if ($results)
{

    $update = "UPDATE STOCK_ITEMS_TABLE SET
      STOCK_IN = '$updatedIn',
      STOCK_TOTAL = '$updatedTotal'
      WHERE STOCK_ID = '$STOCK_ID' ";

    mysql_query($update);

    header( 'Location:stockRestockItemsView.php' ) ;
}
else
{
    echo "Error! Could not add to information to stock table";
}
mysql_close();
?>





<?php include '../include/footer.php';?>