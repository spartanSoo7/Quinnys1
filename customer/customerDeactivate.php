<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
include '../include/header.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");
?>

      <div id = "backBtn">
            <a href="customerView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
      </div>
      <div id = "centerTitle">
            <h2>Deactivating Customer:</h2>
      </div>

<?php
      include 'customerDetails.php';
?>
        </table>
        <p style="width: 60%; margin: 15px auto; ">Please do not disable a customer if they have an outstanding bill, as it will remove this customer form the list of selectable customers</p>
      <h2 style="text-align: center">
            Are you sure you want to deactivate this customer?
       </br>
            <a href="customerDeactivated.php?CUSTOMER_ID=<?php echo "$CUSTOMER_ID" ?>">Yes</a> - <a href="customerView.php">No</a>
       </h2>

<?php include '../include/footer.php';?>