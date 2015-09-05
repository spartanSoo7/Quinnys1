<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = $conn->real_escape_string($_POST['STOCK_TYPE_NAME']);


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
include '../include/footer.php';
?>