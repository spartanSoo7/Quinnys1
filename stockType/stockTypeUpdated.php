<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = $conn->real_escape_string($_POST['STOCK_TYPE_NAME']);

/*
$sql = "UPDATE STOCK_TYPE_TABLE SET
    STOCK_TYPE_NAME = '$STOCK_TYPE_NAME'
WHERE STOCK_TYPE_ID = '$STOCK_TYPE_ID' ";


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully </br>";
    header( 'Location:stockTypeView.php' );
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
*/

// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_TYPE_TABLE SET
    STOCK_TYPE_NAME = ?
WHERE STOCK_TYPE_ID = '$STOCK_TYPE_ID' ");

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

echo "records updated successfully";

$stmt->close();
$conn->close();
header( 'Location:stockTypeView.php' );

include '../include/footer.php';
?>