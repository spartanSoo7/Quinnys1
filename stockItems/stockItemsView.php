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
    <h2>Here are all the stock Items that are currently in the system: </h2>
</div>


<?php
$result = mysql_query("SELECT * FROM STOCK_ITEMS_TABLE");
$num = mysql_num_rows ($result);


echo "<table id = 'viewTable'>";
echo "<tr>
            <th>Name/ Description</th>
            <th>Type</th>
            <th>Size</th>
            <th>Main Colour</th>
            <th>Secondary Colour</th>
            <th>Tertiary Colour</th>
            <th>Update/Delete</th>
      </tr>";
$icount = 0 ;

while ($icount < $num)
{
    $id = mysql_result($result,$icount,"STOCK_ID");
    echo "<tr>";
    echo "    <td> " .mysql_result($result,$icount,"STOCK_NAME"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"STOCK_TYPE_ID"). "</td>";           //need to get type name instead of ID
    echo "    <td> " .mysql_result($result,$icount,"SIZE"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"COLOUR1"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"COLOUR2"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"COLOUR3"). "</td>";

    echo "    <td align='center'>
                    <a href=\"stockItemsUpdate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                    <a href=\"stockItemsDelete.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 10px;
                display: block;'>Delete</a>             <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key-->
              </td>";
    echo "<tr>";
    $icount++;
}
echo "<tr><td colspan='7' align='center'><a href='stockItemsAdd.php'> Add a new stock Item</a></td></tr>";
echo "<tr><td colspan='7' align='center'> You have ".$icount." stock(s) </td> </tr>";

echo "</table>";



mysql_close();
?>




<?php include '../include/footer.php';?>

