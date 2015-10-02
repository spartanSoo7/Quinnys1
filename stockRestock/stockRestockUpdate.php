<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

//MYSQLI
$RESTOCK_ID = $_GET['RESTOCK_ID'];


//inner join with restock table
$sql = "
SELECT
          i.STOCK_ID,
          i.STOCK_IN,
          i.STOCK_TOTAL,

          r.RESTOCK_QUANTITY,
          r.STOCK_ID,
          r.RESTOCK_ID

FROM
    stock_restock_table r inner join STOCK_ITEMS_TABLE i
    on r.STOCK_ID = i.STOCK_ID

WHERE RESTOCK_ID = '$RESTOCK_ID'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc() ) {

        $STOCK_ID = $row["STOCK_ID"];
        $RESTOCK_QUANTITY = $row["RESTOCK_QUANTITY"];
    }
}
?>

    <div id = "backBtn">
        <a href="stockRestockView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
    </div>

    <div id = "centerTitle">
        <h2>Update Restock Record:</h2>
    </div>

<?php
    include '../stockItems/stockItemsDetails.php';
?>



        <form id="FormName" action="stockRestockUpdated.php" method="post" name="FormName">
            <tr>
                <th><label for="RESTOCK_QUANTITY">Restock amount: </label></th>
                <td><input id="RESTOCK_QUANTITY" name="RESTOCK_QUANTITY" type="number" size="10" value="<?php echo $RESTOCK_QUANTITY; ?>"
                           maxlength="9" minlength="1" required/></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="submitButtonName" value="Update restock record"/>
                    <input type="hidden" name="RESTOCK_ID" value="<?php echo $RESTOCK_ID ?>"/>
                </td>
            </tr>
        </form>
    </table>


<?php
include '../include/footer.php';?>