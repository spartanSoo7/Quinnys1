<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = $conn->real_escape_string($_POST['STOCK_TYPE_NAME']);


$sql ="INSERT INTO STOCK_TYPE_TABLE (
	STOCK_TYPE_NAME
	)
	VALUES (
	'$STOCK_TYPE_NAME'
	)";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
	header( 'Location:stockTypeView.php' );
} else {
	echo "Error: " . $conn->error;
}

$conn->close();
?>
