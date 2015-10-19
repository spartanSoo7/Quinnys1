<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


//MYSQLI
$STOCK_TYPE_ID = $_GET['STOCK_TYPE_ID'];

$sql = "UPDATE stock_type_table SET
  `STOCK_TYPE_ACTIVE` = '1'
WHERE STOCK_TYPE_ID ='$STOCK_TYPE_ID'";


if (mysqli_query($conn, $sql)) {

} else {
    include '../include/header.php';
    include '../include/Error.php';
    echo "Error disabling stock type: " . mysqli_error($conn);
}


//all stock that is this type
$sql = "UPDATE stock_items_table SET
  `ACTIVE` = '1'
WHERE STOCK_TYPE_ID ='$STOCK_TYPE_ID'";


if (mysqli_query($conn, $sql))
{

    header("refresh:0; url=stockTypeView.php");

} else {
    include '../include/header.php';
    include '../include/Error.php';
    echo "Error disabling all stock items that are of this type " . mysqli_error($conn);
}

$conn->close();

?>