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
$result = mysql_query("SELECT i.*, t.* FROM STOCK_ITEMS_TABLE i
inner join STOCK_TYPE_TABLE t on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID ORDER BY STOCK_TYPE_NAME");

$num = mysql_num_rows ($result);



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
            <th>Total needed</th>
            <th>Total owned</th>
            <th>Restock</th>
      </tr>";
$icount = 0;
$neededCust = 0;
$needOwned = 0;
while ($icount < $num)
{
    $id = mysql_result($result,$icount,"STOCK_ID");
    $active = mysql_result($result,$icount,"ACTIVE");

    if($active == 0){
        echo "<tr>";
        echo "    <td> " .mysql_result($result,$icount,"STOCK_NAME"). "</td>";

        //if shortage at all/any customer
        $stockOut = mysql_result($result,$icount,"STOCK_OUT");
        $stockNeeded = mysql_result($result,$icount,"STOCK_NEEDED");

        //if need is lager than owned
        $stockTotal = mysql_result($result,$icount,"STOCK_TOTAL");

        echo "    <td> " .mysql_result($result,$icount,"STOCK_TYPE_NAME"). "</td>";           //needs to get type name instead of ID
        echo "    <td> " .mysql_result($result,$icount,"SIZE"). "</td>";
        echo "    <td> " .mysql_result($result,$icount,"COLOUR1"). "</td>";
        echo "    <td> " .mysql_result($result,$icount,"STOCK_IN"). "</td>";

        echo "    <td";
            if($stockNeeded > $stockOut){
                echo " style = 'background-color: #FF6666;'";
                $neededCust++;
            }
        echo ">" .$stockOut. "</td>";

        echo "    <td> " .$stockNeeded. "</td>";
        echo "    <td";

        if($stockNeeded > $stockTotal)
        {
            echo " style = 'background-color: #FF6666;'";
            $needOwned++;
        }
        echo ">" .$stockTotal. "</td>";

        echo "    <td align='center'>
                    <a href=\"stockRestockItem.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Restock </a>
              </td>";
        echo "<tr>";
        $icount++;
    }

}
if($needOwned > 0)
{
    echo "<tr><td colspan='9' align='center' style='padding: 5px; background-color: #FF6666;'> You have ".$needOwned." stock items(s) have a higher number needed than total stock</td> </tr>";
}
if($neededCust > 0)
{
    echo "<tr><td colspan='9' align='center' style='padding: 5px; background-color: #FF6666;'> You have ".$neededCust." stock items(s) have a higher number needed than at the customer</td> </tr>";
}

echo "</table>";



mysql_close();
?>

<?php include '../include/footer.php';?>