<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

//$STOCK_ID = $_POST['STOCK_ID'];
$STOCK_NAME = mysql_real_escape_string($_POST['STOCK_NAME']);
$STOCK_TYPE_ID = mysql_real_escape_string($_POST['STOCK_TYPE_ID']);
$HIRE_COST = $_POST['HIRE_COST'];
$REPLACE_COST = $_POST['REPLACE_COST'];
$SIZE = $_POST['SIZE'];
$COLOUR1 = mysql_real_escape_string($_POST['COLOUR1']);
$COLOUR2 = mysql_real_escape_string($_POST['COLOUR2']);
$COLOUR3 = mysql_real_escape_string($_POST['COLOUR3']);
$STOCK_TOTAL =  $_POST['STOCK_TOTAL'];
$STOCK_OUT = 0;
$STOCK_NEEDED = 0;
$STOCK_IN = $STOCK_TOTAL;


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