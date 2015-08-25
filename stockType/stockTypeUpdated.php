<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<h2>ERROR </h2>


<?php


$id = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = mysql_real_escape_string($_POST['STOCK_TYPE_NAME']);


$update = "UPDATE STOCK_TYPE_TABLE SET STOCK_TYPE_NAME = '$STOCK_TYPE_NAME' WHERE STOCK_TYPE_ID = '$id' ";
mysql_query($update);
header( 'Location:stockTypeView.php' );



mysql_close();
?>




<?php include '../include/footer.php';?>