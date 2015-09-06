<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = $conn->real_escape_string($_POST['STOCK_TYPE_NAME']);

// prepare and bind
$stmt = $conn->prepare("INSERT INTO STOCK_TYPE_TABLE (
  STOCK_TYPE_NAME
)
VALUES (?)");

if ( false===$stmt )
{
	//if not a valid/ready statement object
	die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("s", $name);

if ( false===$rc )
{
	//if can't bind the parameters.
	die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$name = $STOCK_TYPE_NAME;

$stmt->execute();

if ( false===$rc )
{
	//if execute() failed
	die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "New records created successfully";

$stmt->close();
$conn->close();
header( 'Location:stockTypeView.php' );

/*
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

$conn->close();*/
?>
