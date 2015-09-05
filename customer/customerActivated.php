<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

//MYSQLI
$CUSTOMER_ID = $_GET['CUSTOMER_ID'];


$sql = "UPDATE CUSTOMER_TABLE SET
  `CUSTOMER_ACTIVE` = '0'
WHERE CUSTOMER_ID ='$CUSTOMER_ID'";

//echo $sql. "</BR>";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully </br>";
    header( 'Location:customerView.php' );
} else {
    echo "Error updating record: " . mysqli_error($conn);
}



$conn->close();
include '../include/footer.php';
?>
