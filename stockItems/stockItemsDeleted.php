<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

$id = $_GET['STOCK_ID'];

$delete = "DELETE FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$id' ";
mysql_query($delete);


header( 'Location:stockItemsView.php' ) ;
?>