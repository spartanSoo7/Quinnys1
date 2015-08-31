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
$result = mysql_query("SELECT i.*, t.* FROM STOCK_ITEMS_TABLE i
inner join STOCK_TYPE_TABLE t on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID ORDER BY STOCK_TYPE_NAME");

$num = mysql_num_rows ($result);



echo "<table id = 'viewTable'>";
echo "<tr>
            <th>Name/ Description</th>
            <th>Type</th>
            <th>Size</th>
            <th>Main Colour</th>
            <th>Secondary Colour</th>
            <th>Tertiary Colour</th>
            <th>Active?</th>                <!--alt to delete keeps in table, but maintains data integrity-->
            <th>Update/Delete</th>
      </tr>";
$icount = 0 ;

while ($icount < $num)
{
    $id = mysql_result($result,$icount,"STOCK_ID");
    $active = mysql_result($result,$icount,"ACTIVE");
    echo "<tr>";
    echo "    <td> " .mysql_result($result,$icount,"STOCK_NAME"). "</td>";


    echo "    <td> " .mysql_result($result,$icount,"STOCK_TYPE_NAME"). "</td>";           //need to get type name instead of ID
    echo "    <td> " .mysql_result($result,$icount,"SIZE"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"COLOUR1"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"COLOUR2"). "</td>";
    echo "    <td> " .mysql_result($result,$icount,"COLOUR3"). "</td>";
    if($active == 0){
        echo "<td style= 'background-color: #59E059;'><p>Active</br>
                <a href=\"stockItemsDeactivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></p></td>";
    }else if ($active == 1){
        echo "<td style = 'background-color: #FF6666;'><p>NOT Active<br/>
                <a href=\"stockItemsActivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a></p></td>";
    }

    echo "    <td align='center'>
                    <a href=\"stockItemsUpdate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                    <a href=\"stockItemsDelete.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 10px;
                display: block;'>Delete</a>             <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key, WORK AROUND set total_stock_level to 0 if no hire-->
              </td>";
    echo "<tr>";
    $icount++;
}
echo "<tr><td colspan='8' align='center'><a href='stockItemsAdd.php'> Add a new stock Item</a></td></tr>";
echo "<tr><td colspan='9' align='center'> You have ".$icount." stock item(s) </td> </tr>";

echo "</table>";



mysql_close();
?>

<?php include '../include/footer.php';?>