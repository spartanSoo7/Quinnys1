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
            <h2>Activating Stock Item:</h2>
      </div>

<?php
    include 'stockItemsDetails.php';
?>

    </table>
    <h2 style="text-align: center">
        Are you sure you want to Activate this stock item?
        </br>
        <a href="customerActivated.php?STOCK_ID=<?php echo "$STOCK_ID" ?>">Yes</a> - <a href="stockItemsView.php">No</a>
    </h2>
<?php
      include '../include/footer.php';
?>