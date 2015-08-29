<h2>ERROR </h2>

<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

var_dump($_GET);

if (!isset($_GET['STOCK_TYPE_ID']) || empty($_GET['STOCK_TYPE_ID']))
    die("STOCK_TYPE_ID not set");


$id = $_GET['STOCK_TYPE_ID'];


$update = "UPDATE `quinssdb4`.`stock_type_table` SET `STOCK_TYPE_ACTIVE` = '1' WHERE `stock_type_table`.`STOCK_TYPE_ID` = $id";
echo "</br>" .$update;
$result = mysql_query($update);

//check result
//if (!$result)die("error ".$update);

header( 'Location:stockTypeView.php' );

mysql_close();
?>
