<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<h2>Here are all the customers currently in the system: </h2>


<?php


$id = $_POST['CUSTOMER_ID'];
$CUSTOMER_NAME = mysql_real_escape_string($_POST['CUSTOMER_NAME']);


$update = "UPDATE CUSTOMER_TABLE SET CUSTOMER_NAME = '$CUSTOMER_NAME' WHERE CUSTOMER_ID = '$id' ";
mysql_query($update);
header( 'Location:customerView.php' );



mysql_close();
?>




<?php include '../include/footer.php';?>