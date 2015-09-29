<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_TYPE_ID = $_GET['STOCK_TYPE_ID'];

$sql = "UPDATE stock_type_table SET
  `STOCK_TYPE_ACTIVE` = '1'
WHERE STOCK_TYPE_ID ='$STOCK_TYPE_ID'";


if (mysqli_query($conn, $sql)) {

    echo "<h1 style='text-align: center'>The stock type has been deactivated successfully </h1> </br>";
    header("refresh:3; url=stockTypeView.php");

} else {
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
include '../include/footer.php';

?>