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
    <h2>Here are all the customers currently in the system: </h2>
</div>



<?php

$result = mysql_query("SELECT * FROM CUSTOMER_TABLE");
$num = mysql_num_rows ($result);


echo "<table border='1' align='center' width='50%' class = 'viewTable'>";
echo "<tr> <th>Customer Name</th><th>Update/Delete</th></tr>";
$icount = 0 ;

while ($icount < $num)
{
    $id = mysql_result($result,$icount,"CUSTOMER_ID");
    echo "<tr>";
    echo "    <td> " .mysql_result($result,$icount,"CUSTOMER_NAME"). "</td>";
    echo "    <td align='center'> <a href=\"customerUpdate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                <a href=\"customerDelete.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 10px; display: block;'>Delete</a>        <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key-->
              </td>";
    echo "<tr>";
    $icount++;
}
echo "<tr><td colspan='5' align='center'><a href='customerAdd.php'> Add a new Customer  </a></td></tr>";
echo "<tr><td colspan='5' align='center'> You have ".$icount." customer(s) </td> </tr>";

echo "</table>";



mysql_close();
?>




<?php include '../include/footer.php';?>
