<!--

NOT IN USE WILL BREAK DATABASE INTEGRITY
NOT USING MYSQLI

-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="customerView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>

<?php
$id = $_GET['CUSTOMER_ID'];
$qP = "SELECT * FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);
$CUSTOMER_NAME = trim($CUSTOMER_NAME);
?>

<div id = "centerTitle">
    <h2>Delete Customer: </h2>
    <p>Name: <?php echo $CUSTOMER_NAME ?></p>
</div>

<?php $id = $_GET['CUSTOMER_ID'];?>

    <div align="center">
        <h2>Are you sure?</h2>
        <h2><a href="customerDeleted.php?CUSTOMER_ID=<?php echo "$id" ?>">Yes</a> - <a href="customerView.php">No</a></h2>
    </div>

<?php include '../include/footer.php';?>