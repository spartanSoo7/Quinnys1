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
    <h2>Here are all the types of stock currently in the system: </h2>
</div>


<?php
$result = mysql_query("SELECT * FROM STOCK_TYPE_TABLE");
$num = mysql_num_rows ($result);


echo "<table border='1' align='center' width='50%' class = 'viewTable'>";
echo "<tr> <th>Stock Type</th><th>Update/Delete</th></tr>";
$icount = 0 ;

while ($icount < $num)
{
    $id = mysql_result($result,$icount,"STOCK_TYPE_ID");
    echo "<tr>";
    echo "    <td> " .mysql_result($result,$icount,"STOCK_TYPE_NAME"). "</td>";
    echo "    <td align='center'>
                    <a href=\"stockTypeUpdate.php?STOCK_TYPE_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                    <a href=\"stockTypeDelete.php?STOCK_TYPE_ID=$id\" style ='padding-bottom: 10px; margin: 10px; display: block;'>Delete</a>             <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key-->
              </td>";
    echo "<tr>";
    $icount++;
}
echo "<tr><td colspan='5' align='center'><a href='stockTypeAdd.php'> Add a new stock type</a></td></tr>";
echo "<tr><td colspan='5' align='center'> You have ".$icount." stock type(s) </td> </tr>";

echo "</table>";

mysql_close();
?>

<?php include '../include/footer.php';?>

