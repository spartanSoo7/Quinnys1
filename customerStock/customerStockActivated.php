<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");

//MYSQLI
$HIRE_NUMBER = $_GET['HIRE_NUMBER'];

$sql = "UPDATE total_at_customer_table SET
  `HIRE_ACTIVE` = '0'
WHERE HIRE_NUMBER ='$HIRE_NUMBER'";

if (mysqli_query($conn, $sql)) {

    echo "<h1 style='text-align: center'>Customer stock totals/Hold level has been activated successfully </h1> </br>";
    header("refresh:0; url=customerStockView.php");

} else {
    include '../include/header.php';
    include '../include/Error.php';
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
?>
