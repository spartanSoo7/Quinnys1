<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

      <div id = "backBtn">
            <a href="stockRestockItemsView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
      </div>

<?php
$id = $_GET['STOCK_ID'];
$qP = "SELECT * FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);
$STOCK_NAME = trim($STOCK_NAME);
//$ACTIVE = trim($ACTIVE);
?>

      <div id = "centerTitle">
            <h2>Restock item:</h2>
            <table id = "updateTable" border='0px' align='center' width='50%'>
                  <tr>
                        <td>Stock name:  </td>
                        <td><?php echo $STOCK_NAME ?></td>
                  </tr>
                  <tr>
                        <td>Current instock total: </td>
                        <td><?php echo $STOCK_IN?></td>
                  </tr>
                  <tr>
                        <td>Current stock total: </td>
                        <td><?php echo $STOCK_TOTAL?></td>
                  </tr>
                  <form id="FormName" action="stockRestocked.php" method="post" name="FormName">
                  <tr>
                        <td><label for="RESTOCK_QUANTITY">Restock amount: </label></td>
                        <td><input id="RESTOCK_QUANTITY" name="RESTOCK_QUANTITY" type="number" size="10" value="" maxlength="10" minlength="1" required/></td>
                  </tr>
                  <tr>
                         <td><input type="submit" name="submitButtonName" value="Add Stock"/><input type="hidden" name="STOCK_ID" value="<?php echo $id?>"/></td>
                  </tr>
                  </form>
            </table>
      </div>


<?php include '../include/footer.php';?>