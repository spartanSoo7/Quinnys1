<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = mysql_real_escape_string($_POST['STOCK_TYPE_NAME']);


$query = "INSERT INTO STOCK_TYPE_TABLE (
	STOCK_TYPE_NAME
	)
	VALUES (
	'$STOCK_TYPE_NAME'
	)";

$results = mysql_query($query);

if ($results)
{
    header( 'Location:stockTypeView.php' ) ;
}
else
{
    echo "Error! Could not add to information to customer table";
}
mysql_close();
?>