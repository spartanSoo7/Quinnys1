<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_ID = $_GET['STOCK_ID'];

$sql = "UPDATE STOCK_ITEMS_TABLE SET
  `ACTIVE` = '0'
WHERE STOCK_ID ='$STOCK_ID'";

if (mysqli_query($conn, $sql)) {

    echo "<h1 style='text-align: center'>The stock item has been activated successfully </h1> </br>";
    header("refresh:3; url=stockItemsView.php");

} else {
    include '../include/Error.php';
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
include '../include/footer.php';

?>

