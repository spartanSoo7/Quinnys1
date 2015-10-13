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
            <a href="customerStockView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
      </div>
      <div id = "centerTitle">
            <h2>Deactivating Customer Stock Level:</h2>
      </div>

<?php
    include 'customerStockDetails.php';
?>

    </table>
    <h2 style="text-align: center">
        Are you sure you want to Deactivate this customer stock level?
        </br>
        <a href="customerStockDeactivated.php?HIRE_NUMBER=<?php echo "$HIRE_NUMBER" ?>">Yes</a> - <a href="customerStockView.php">No</a>
    </h2>
<?php
      include '../include/footer.php';
?>