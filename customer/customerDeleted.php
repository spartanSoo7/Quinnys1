<!--

NOT IN USE WILL BREAK DATABASE INTEGRITY
NOT USING MYSQLI

-->

<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

$id = $_GET['CUSTOMER_ID'];

$delete = "DELETE FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$id' ";
mysql_query($delete);


header( 'Location:customerView.php' ) ;
?>