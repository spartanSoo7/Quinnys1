<?php
include_once("../include/databaselogin.php");

$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$CUSTOMER_NAME = mysql_real_escape_string($_POST['CUSTOMER_NAME']);


$query = "INSERT INTO CUSTOMER_TABLE (
	CUSTOMER_NAME
	)
	VALUES (
	'$CUSTOMER_NAME'
	)";

$results = mysql_query($query);

if ($results)
{
    header( 'Location:customerView.php' ) ;
}
else
{
    echo "Error! Could not add to information to customer table";
}
mysql_close();
?>