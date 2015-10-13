<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


$startDateFormatted = $_POST['startDateFormatted'];
$endDateFormatted = $_POST['endDateFormatted'];
$STOCK_ID = $_POST['STOCK_ID'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

echo "<div id = 'centerTitle'>";

echo "<h2>Restocked Lines for ";

//MYSQLI
//find customer name
if($STOCK_ID != "all")
{
    $sql = "SELECT STOCK_NAME FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$STOCK_ID'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {
        ?>

        <div id = "centerTitle">
                <?php
                    echo $row["STOCK_NAME"];
                ?>
        </div>

        <?php
        }
    }
}else{
    echo "All Stock";
}

echo "</h2>
        <h3>For the days:</br>" .$startDate. " - " .$endDate. "</h3>
            <p>(Date range is inclusive)</p>";

$dateSQL = "RESTOCK_DATE between '" .$startDateFormatted. "' and '" .$endDateFormatted. "'";
echo "</div>";


if($STOCK_ID != "All"){
    $magicSql = "r.STOCK_ID = '" .$STOCK_ID. "' && " .$dateSQL;
}
elseif($STOCK_ID == "All"){
    $magicSql = $dateSQL;
}
else{
    include '../include/Error.php';
    die('Something broke');
}



$sql = "SELECT
        i.STOCK_ID,
        i.STOCK_TYPE_ID,
        i.STOCK_NAME,
        i.REPLACE_COST,

        t.STOCK_TYPE_ID,
        t.STOCK_TYPE_NAME,

        r.RESTOCK_DATE,
        r.RESTOCK_QUANTITY,
        r.STOCK_ID

FROM
  stock_restock_table r inner join STOCK_ITEMS_TABLE i
    on r.STOCK_ID = i.STOCK_ID

  inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

WHERE $magicSql

ORDER BY RESTOCK_DATE ASC, STOCK_NAME ASC
";


//next is display the query
?>


<table id = 'viewTable'>
    <tr>
        <td colspan="3" style="border: 0px; "></td>
        <th colspan="2">Cost</th>
    </tr>
    <tr>
        <th>Stock</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Replacement Cost</th>
        <th>Total Cost</th>
        <th>Date</th>
    </tr>
    <?php


    $result = $conn->query($sql);
    $icount = 0;
$totalCost = 0;
if ($result->num_rows > 0)
{
    // output data of each row

    while ($row = $result->fetch_assoc())
    {
        $cost = $row["RESTOCK_QUANTITY"] * $row["REPLACE_COST"];
        $totalCost = $totalCost + $cost;
        ?>
        <tr>
            <td><?php echo $row["STOCK_NAME"]?></td>
            <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
            <td><?php echo $row["RESTOCK_QUANTITY"]?></td>
            <td>$<?php echo $row["REPLACE_COST"]?></td>
            <td><?php echo "$" .$cost ?></td>

            <?php
            //2015-09-13 15:44:41
            $getDate = $row["RESTOCK_DATE"];
            $date = strtotime($getDate);

            //new format is 13-09-2015
            $dateFormated = date('j-m-Y', $date);
            ?>

            <td><?php echo $dateFormated ?></td>
        </tr>
        <?php
        $icount++;
    }

}else {
    echo "<tr>
                        <td colspan='4'>There are no Bills for hiring</td>
                        <td>From:</br>" . $startDate . " to " . $endDate . "</td>
                        <td>$0</td>
                      </tr>";
}


    /*
     * Display total cost
     */

    echo    "<tr>
            <td colspan='4' style='border-bottom: 0px; border-left: 0px;'></td>
            <th>Total Cost</th>
            <td>$";

    //format cost to 2 decimal places
    echo number_format((float)$totalCost, 2, '.', '');

    echo "</td>
        </tr>";

echo "</table>";
$conn->close();
?>