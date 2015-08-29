<h2>ERROR </h2>

<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");

var_dump($_GET);

if (!isset($_GET['CUSTOMER_ID']) || empty($_GET['CUSTOMER_ID']))
    die("CUSTOMER_ID not set");


$id = $_GET['CUSTOMER_ID'];


$update = "UPDATE `quinssdb4`.`customer_table` SET `CUSTOMER_ACTIVE` = '1' WHERE `customer_table`.`CUSTOMER_ID` = $id";
echo "</br>" .$update;
$result = mysql_query($update);

//check result
//if (!$result)die("error ".$update);

header( 'Location:customerView.php' );

mysql_close();
?>
