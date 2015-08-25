<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="stockTypeView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>

<?php
$id = $_GET['STOCK_TYPE_ID'];
$qP = "SELECT * FROM STOCK_TYPE_TABLE WHERE STOCK_TYPE_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);
$STOCK_TYPE_NAME = trim($STOCK_TYPE_NAME);
?>

<div id = "centerTitle">
    <h2>Deleting a stock type:</h2>
    <p>Stock type name:  <?php echo $STOCK_TYPE_NAME ?></p>
</div>



    <div id ="centerTitle">
        </br>
        </br>
        <h2>Are you sure?</h2>
        <h2><a href="stockTypeDeleted.php?STOCK_TYPE_ID=<?php echo "$id" ?>">Yes</a> - <a href="stockTypeView.php">No</a></h2>
    </div>


<?php include '../include/footer.php';?>