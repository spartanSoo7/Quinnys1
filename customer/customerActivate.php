<?php
      include '../include/head.php';
      require("../include/securitycheck.php");
      include '../include/header.php';
      include_once("../include/databaselogin.php");
?>
<!--
--Page was built by Kane Wardle
-->

      <div id = "backBtn">
            <a href="customerView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
      </div>
      <div id = "centerTitle">
            <h2>Activating Customer:</h2>
      </div>

<?php
    include 'customerDetails.php';
?>

    </table>
    <h2 style="text-align: center">
        Are you sure you want to Activate this stock item?
        </br>
        <a href="customerActivated.php?CUSTOMER_ID=<?php echo "$CUSTOMER_ID" ?>">Yes</a> - <a href="customerView.php">No</a>
    </h2>
<?php
      include '../include/footer.php';
?>