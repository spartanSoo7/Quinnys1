<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

      <div id = "backBtn">
            <a href="stockItemsView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
      </div>
      <div id = "centerTitle">
            <h2>Deactivating Stock Item:</h2>
      </div>

<?php
include 'stockItemsDetails.php';
?>
</table>

      <h2 style="text-align: center">
            Are you sure you want to deactivate this stock item?
            </br>
            <a href="stockItemsDeactivated.php?STOCK_ID=<?php echo "$STOCK_ID" ?>">Yes</a> - <a href="stockItemsView.php">No</a>
      </h2>

<?php include '../include/footer.php';?>