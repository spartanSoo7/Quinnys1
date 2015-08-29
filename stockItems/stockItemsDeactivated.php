<h2>ERROR </h2>

<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

var_dump($_GET);

if (!isset($_GET['STOCK_ID']) || empty($_GET['STOCK_ID']))
    die("stock_id not set");


$id = $_GET['STOCK_ID'];


//$STOCK_TOTAL = trim($STOCK_TOTAL);  no changing stock levels here, you'll break the other stock levels (instock, out, needed) it will no longer total properly



$update = "UPDATE `quinssdb4`.`stock_items_table` SET `ACTIVE` = '1' WHERE `stock_items_table`.`STOCK_ID` = $id";
echo "</br>" .$update;
$result = mysql_query($update);

//check result
//if (!$result)die("error ".$update);

header( 'Location:stockItemsView.php' );

mysql_close();
?>
