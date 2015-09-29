<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


$HIRE_NUMBER = $_POST['HIRE_NUMBER'];
$TOTAL_QUANTITY_NEEDED = $_POST['TOTAL_QUANTITY_NEEDED'];



// prepare and bind
$stmt = $conn->prepare("UPDATE total_at_customer_table SET
    TOTAL_QUANTITY_NEEDED = ?
WHERE HIRE_NUMBER = '$HIRE_NUMBER' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totalNeed);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totalNeed = $TOTAL_QUANTITY_NEEDED;


$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}


echo "<h1 style='text-align: center'>Customer stock totals/Hold level has been updated successfully </h1> </br>";

include '../include/footer.php';

$stmt->close();
$conn->close();

header("refresh:3; url=customerStockView.php");
?>