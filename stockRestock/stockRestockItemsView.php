<?php
    include '../include/head.php';
    require("../include/securitycheck.php");
    include '../include/header.php';
    include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>

<div id = "centerTitle">
    <h2>Here are the total stock levels: </h2>
</div>


<?php
$sql = "SELECT i.*, t.* FROM STOCK_ITEMS_TABLE i
          inner join STOCK_TYPE_TABLE t on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID ORDER BY STOCK_TYPE_NAME;";
$result = $conn->query($sql);

/*
 * hold lvl (should have at any one time)
 * need is hold - have
 * database name is around the other way to the clients
*/



echo "<table id = 'viewTable'>";
echo "<tr>
       <td colspan='4' style = 'border: 0px;'></td>
       <td colspan='5'>Stock levels</td>
</tr>";
echo "<tr>
            <th>Name/ Description</th>
            <th>Type</th>
            <th>Size</th>
            <th>Main Colour</th>
            <th>Total in stock</th>
            <th>Toatal out</th>
            <th>Total hold</th>
            <th>Total Needed</th>
            <th>Total owned</th>
            <th>Restock</th>
      </tr>";

$neededCust = 0;
$needOwned = 0;
$active;
$icount = 0 ;
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $STOCK_ID = $row["STOCK_ID"];
        $active = $row["STOCK_TYPE_ACTIVE"];

        if ($active == 0) {
            echo "<tr>";
            echo "    <td> " .$row["STOCK_NAME"]. "</td>";

            //if shortage at all/any customer
            $stockOut = $row["STOCK_OUT"];
            $stockHold = $row["STOCK_NEEDED"];
            $stockNeeded = $stockHold - $stockOut;

            //if need is lager than owned
            $stockTotal = $row["STOCK_TOTAL"];

            echo "    <td> " .$row["STOCK_TYPE_NAME"]. "</td>";           //needs to get type name instead of ID
            echo "    <td> " .$row["SIZE"]. "</td>";
            echo "    <td> " .$row["COLOUR1"]. "</td>";
            echo "    <td> " .$row["STOCK_IN"]. "</td>";
            echo "<td>" .$stockTotal . "</td>";

            echo "    <td";
            if ($stockHold > $stockTotal) {
                echo " style = 'background-color: #FF6666;'";
            }
            echo ">" .$stockHold. "</td>";

            echo "    <td";
            if ($stockHold > $stockOut) {
                echo " style = 'background-color: #FF8944;'";
                $neededCust++;
            }
            echo ">" . $stockNeeded . "</td>";


            echo "    <td";
            if ($stockHold > $stockTotal) {
                echo " style = 'background-color: #FF6666;'";
                $needOwned++;
            }
            echo ">" .$stockTotal. "</td>";


            echo "    <td align='center'>
                    <a href=\"stockRestockItem.php?STOCK_ID=$STOCK_ID\"> Restock </a>
              </td>";
            echo "<tr>";

        }
        $icount++; //make sure this is outside of the IF statement, to not embarrise yourself infron of the client... again
    }
}
if($needOwned > 0)
{
    echo "<tr><td colspan='10' align='center' style='padding: 5px; background-color: #FF6666;'> You have <b>".$needOwned."</b> stock items(s) that are needed more than you have in total stock</td> </tr>";
}
if($neededCust > 0)
{
    echo "<tr><td colspan='10' align='center' style='padding: 5px; background-color: #FF8944;'> You have <b>".$neededCust."</b> stock items(s) that needs more at the customer(s)</td> </tr>";
}

echo "</table>";



    $conn->close();
    include '../include/footer.php';
?>