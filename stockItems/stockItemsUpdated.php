<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

$STOCK_ID = $_POST['STOCK_ID'];
$STOCK_NAME = $conn->real_escape_string($_POST['STOCK_NAME']);
$STOCK_TYPE_ID  = $_POST['STOCK_TYPE_ID'];
$HIRE_COST  = $_POST['HIRE_COST'];
$REPLACE_COST  = $_POST['REPLACE_COST'];
$SIZE = $conn->real_escape_string($_POST['SIZE']);
$COLOUR1 = $conn->real_escape_string($_POST['COLOUR1']);
$COLOUR2 = $conn->real_escape_string($_POST['COLOUR2']);
$COLOUR3 = $conn->real_escape_string($_POST['COLOUR3']);



$sql = "UPDATE STOCK_ITEMS_TABLE SET
      STOCK_TYPE_ID = '$STOCK_TYPE_ID',
      STOCK_NAME = '$STOCK_NAME',
      HIRE_COST = '$HIRE_COST',
      REPLACE_COST = '$REPLACE_COST',
      SIZE = '$SIZE',
      COLOUR1 = '$COLOUR1',
      COLOUR2 = '$COLOUR2',
      COLOUR3 = '$COLOUR3'
WHERE STOCK_ID = '$STOCK_ID' ";


if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully </br>";
      header( 'Location:StockItemsView.php' );
} else {
      echo "Error updating record: " . mysqli_error($conn);
}



$conn->close();
include '../include/footer.php';
?>
