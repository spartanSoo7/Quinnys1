<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

//MYSQLI
$STOCK_ID = $_GET['STOCK_ID'];

$sql = "SELECT STOCK_TOTAL, STOCK_IN FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$STOCK_ID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc() ) {
        $STOCK_IN = $row["STOCK_IN"];
        $STOCK_TOTAL = $row["STOCK_TOTAL"];
    }
}

?>

      <div id = "backBtn">
            <a href="stockRestockItemsView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
      </div>

      <div id = "centerTitle">
            <h2>Restock item:</h2>
      </div>

      <table id = "updateTable" border='0px' align='center' width='50%'>



            <form id="FormName" action="stockRestocked.php" method="post" name="FormName">
                <?php
                include '../stockItems/stockItemsDetails.php'
                ?>
                <tr>
                        <th><label for="RESTOCK_QUANTITY">Restock amount: </label></th>
                        <td><input id="RESTOCK_QUANTITY" name="RESTOCK_QUANTITY" type="number" size="10" value=""
                                   maxlength="9" minlength="1" required/></td>
                        <th></th>



                  </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="submitButtonName" value="Add Stock"/>
                        <input type="hidden" name="STOCK_ID" value="<?php echo $STOCK_ID ?>"/>
                        <input type="hidden" name="STOCK_TOTAL" value="<?php echo $STOCK_TOTAL ?>"/>
                        <input type="hidden" name="STOCK_IN" value="<?php echo $STOCK_IN ?>"/>
                    </td>
                </tr>
            </form>
            </table>


<?php
include '../include/footer.php';?>