

$query = "INSERT INTO STOCK_ITEMS_TABLE (
	STOCK_NAME, STOCK_TYPE_ID, HIRE_COST, REPLACE_COST, SIZE, COLOUR1, COLOUR2, COLOUR3, STOCK_TOTAL, STOCK_OUT, STOCK_NEEDED, STOCK_IN
	)
	VALUES (
	'$STOCK_NAME', '$STOCK_TYPE_ID', '$HIRE_COST', '$REPLACE_COST', '$SIZE', '$COLOUR1', '$COLOUR2', '$COLOUR3', '$STOCK_TOTAL', '$STOCK_OUT', '$STOCK_NEEDED', '$STOCK_IN'
	)";

$results = mysql_query($query);

if ($results)
{
    header( 'Location:stockItemsView.php' ) ;
}
else
{
    echo "Error! Could not add to information to stock table";
}
mysql_close();
?>

<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");


$STOCK_NAME = $conn->real_escape_string($_POST['STOCK_NAME']);
$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$HIRE_COST = $conn->real_escape_string($_POST['HIRE_COST']);
$REPLACE_COST = $conn->real_escape_string($_POST['REPLACE_COST']);
$SIZE = $conn->real_escape_string($_POST['SIZE']);
$COLOUR1 = $conn->real_escape_string($_POST['COLOUR1']);
$COLOUR2 = $conn->real_escape_string($_POST['COLOUR2']);
$COLOUR3 = $conn->real_escape_string($_POST['COLOUR3']);
$STOCK_TOTAL =  $_POST['STOCK_TOTAL'];
$STOCK_OUT = 0;
$STOCK_NEEDED = 0;
$STOCK_IN = $STOCK_TOTAL;


$sql = "INSERT INTO STOCK_ITEMS_TABLE (STOCK_NAME, STOCK_TYPE_ID, HIRE_COST, REPLACE_COST, SIZE, COLOUR1, COLOUR2, COLOUR3, STOCK_TOTAL, STOCK_OUT, STOCK_NEEDED, STOCK_IN)
VALUES (
  '$STOCK_NAME',
  '$STOCK_TYPE_ID',
  '$HIRE_COST',
  '$REPLACE_COST',
  '$SIZE',
  '$COLOUR1',
  '$COLOUR2',
  '$COLOUR3',
  '$STOCK_TOTAL',
  '$STOCK_OUT',
  '$STOCK_NEEDED',
  '$STOCK_IN'
)";


if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
	header( 'Location:stockItemsView.php' );
} else {
	echo "Error: " . $conn->error;
}

$conn->close();
?>
