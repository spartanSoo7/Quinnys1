<!--
--Page was built by Kane Wardle
-->
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
        <h2>Delete Restock Record:</h2>
    </div>

<?php
    include '../stockItems/stockItemsDetails.php';
?>
<tr></tr>
<tr>
    <th>Restock Quantity</th>
    <td><?php echo $RESTOCK_QUANTITY ?></td>
</tr>


<tr>
    <th colspan="2" style="font-size: 28px; text-align: center; padding: 30px 0px 15px 0px; ">
        Are you sure you want to delete this restock record?
    </th>
</tr>
<tr style="font-size: 25px">
    <th width="50%" style="text-align: center; border-right: solid 1px; background-color: #59E059">
        <a href="stockRestockDeleted.php?RESTOCK_ID=<?php echo $RESTOCK_ID ?>" style="display: block">Yes</a>
    </th>
    <th width="50%" style="text-align: center; background-color: #FF6666">
        <a href="stockRestockView.php" style="display: block">No</a>
    </th>
</tr>
    </table>


<?php
include '../include/footer.php';?>