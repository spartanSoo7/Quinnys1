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
$STOCK_TYPE_ID = $_GET['STOCK_TYPE_ID'];

//MYSQLI
$sql = "SELECT * FROM `stock_type_table` WHERE STOCK_TYPE_ID = '$STOCK_TYPE_ID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
            ?>

            <div id="centerTitle" style="text-align: center">
                  <h2>Deactivating stock item:</h2>

                  <p style="text-align: center">Stock type name: <?php echo $row["STOCK_TYPE_NAME"] ?></p>
            </div>
            <?php
      }
}
?>

      <h2 style="text-align: center">
            </br>
            </br>
            Are you sure?</br>
            <a href="stockTypeDeactivatedAll.php?STOCK_TYPE_ID=<?php echo "$STOCK_TYPE_ID" ?>">
                  Yes and ALL the stock items of this type
            </a>
            </br></br>
            <a href="stockTypeDeactivated.php?STOCK_TYPE_ID=<?php echo "$STOCK_TYPE_ID" ?>">
                  Yes, and NOT the stock items of this type
            </a>
            </br></br>
            <a href="stockTypeView.php">
                  No
            </a>
      </h2>



<?php include '../include/footer.php';?>