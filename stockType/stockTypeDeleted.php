<!--

NOT IN USE WILL BREAK DATABASE INTEGRITY
NOT USING MYSQLI

-->
<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

$id = $_GET['STOCK_TYPE_ID'];

$delete = "DELETE FROM STOCK_TYPE_TABLE WHERE STOCK_TYPE_ID = '$id' ";
mysql_query($delete);


header( 'Location:stockTypeView.php' ) ;
?>