<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

//MYSQLI
$HIRE_NUMBER = $_GET['HIRE_NUMBER'];

$sql = "UPDATE total_at_customer_table SET
  `HIRE_ACTIVE` = '1'
WHERE HIRE_NUMBER ='$HIRE_NUMBER'";

//echo $sql. "</BR>";
if (mysqli_query($conn, $sql)) {
    echo "<h1 style='text-align: center'>Customer stock totals/Hold level has been Deactivated successfully </h1> </br>";
    header("refresh:3; url=customerStockView.php");
} else {
    include '../include/Error.php';
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
include '../include/footer.php';
?>
