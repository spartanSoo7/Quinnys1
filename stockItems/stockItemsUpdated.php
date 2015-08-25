<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<h2>ERROR </h2>


<?php


$id = $_POST['STOCK_ID'];
$STOCK_NAME = mysql_real_escape_string($_POST['STOCK_NAME']);
$STOCK_TYPE_ID  = $_POST['STOCK_TYPE_ID'];
//$STOCK_TYPE_NAME should not be need here
$HIRE_COST  = $_POST['HIRE_COST'];
$REPLACE_COST  = $_POST['REPLACE_COST'];
$SIZE = mysql_real_escape_string($_POST['SIZE']);
$COLOUR1 = mysql_real_escape_string($_POST['COLOUR1']);
$COLOUR2 = mysql_real_escape_string($_POST['COLOUR2']);
$COLOUR3 = mysql_real_escape_string($_POST['COLOUR3']);
//$STOCK_TOTAL = trim($STOCK_TOTAL);  no changing stock levels here, you'll break the other stock levels (instock, out, needed) it will no longer total properly








$update = "UPDATE STOCK_ITEMS_TABLE SET
      STOCK_TYPE_ID = '$STOCK_TYPE_ID',
      STOCK_NAME = '$STOCK_NAME',
      HIRE_COST = '$HIRE_COST',
      REPLACE_COST = '$REPLACE_COST',
      SIZE = '$SIZE',
      COLOUR1 = '$COLOUR1',
      COLOUR2 = '$COLOUR2',
      COLOUR3 = '$COLOUR3'
WHERE STOCK_ID = '$id' ";

mysql_query($update);
header( 'Location:stockItemsView.php' );



mysql_close();
?>




<?php include '../include/footer.php';?>