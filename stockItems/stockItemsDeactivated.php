<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_ID= $_GET['STOCK_ID'];


$sql = "UPDATE STOCK_ITEMS_TABLE SET
  `ACTIVE` = '1'
WHERE STOCK_ID ='$STOCK_ID'";

//echo $sql. "</BR>";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully </br>";
    header( 'Location:stockItemsView.php' );
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
include '../include/footer.php';
?>