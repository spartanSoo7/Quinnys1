<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_ID = $_GET['STOCK_ID'];

$sql = "UPDATE STOCK_ITEMS_TABLE SET
  `ACTIVE` = '0'
WHERE STOCK_ID ='$STOCK_ID'";

if (mysqli_query($conn, $sql)) {

    header("refresh:0; url=stockItemsView.php");

} else {
    include '../include/header.php';
    include '../include/Error.php';
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
?>

