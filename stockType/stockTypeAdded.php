<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");




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
	include '../include/Error.php';
	die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("s", $name);

if ( false===$stmt )
{
	//if can't bind the parameters.
    include '../include/Error.php';
	die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$name = $STOCK_TYPE_NAME;

$stmt->execute();

if ( false===$stmt )
{
	//if execute() failed
    include '../include/Error.php';
	die('execute() failed: ' . htmlspecialchars($stmt->error));
}


echo "<h1 style='text-align: center'>The stock type has been added successfully </h1> </br>";

include '../include/footer.php';

$stmt->close();
$conn->close();
header("refresh:3; url=stockTypeView.php");
?>
