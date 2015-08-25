<?php
include_once("../include/databaselogin.php");

$id = $_GET['CUSTOMER_ID'];

$delete = "DELETE FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$id' ";
mysql_query($delete);


header( 'Location:customerView.php' ) ;
?>