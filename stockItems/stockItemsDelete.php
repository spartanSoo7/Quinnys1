<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="stockItemsView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>

<?php
$id = $_GET['STOCK_ID'];
$qP = "SELECT i.*, t.* FROM STOCK_ITEMS_TABLE i inner join STOCK_TYPE_TABLE t on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID WHERE STOCK_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);
$STOCK_NAME = trim($STOCK_NAME);
$COLOUR1 = trim($COLOUR1);
$STOCK_TYPE_NAME = trim($STOCK_TYPE_NAME);
$SIZE = trim($SIZE);
?>

<div id = "centerTitle">
    <h2>Deleting a stock Item:</h2>
    <p>Stock name:  <?php echo $STOCK_NAME ?></p>
    <p>Stock type name:  <?php echo $STOCK_TYPE_NAME ?></p>
    <p>Size:  <?php echo $SIZE ?></p>
    <p>Primary colour:  <?php echo $COLOUR1 ?></p>
</div>



    <div id ="centerTitle">
        </br>
        </br>
        <h2>Are you sure?</h2>
        <h2><a href="stockItemsDeleted.php?STOCK_ID=<?php echo "$id" ?>">Yes</a> - <a href="stockItemsView.php">No</a></h2>
    </div>


<?php include '../include/footer.php';?>