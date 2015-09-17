<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");



$HIRE_NUMBER = $_POST['HIRE_NUMBER'];
$TOTAL_QUANTITY_NEEDED = $_POST['TOTAL_QUANTITY_NEEDED'];



// prepare and bind
$stmt = $conn->prepare("UPDATE total_at_customer_table SET
    TOTAL_QUANTITY_NEEDED = ?
WHERE HIRE_NUMBER = '$HIRE_NUMBER' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totalNeed);

if ( false===$stmt )
{
    //if can't bind the parameters.
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totalNeed = $TOTAL_QUANTITY_NEEDED;


$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "New records created successfully";

$stmt->close();
$conn->close();
header( 'Location:customerStockView.php' );
?>