<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <div id = "backBtn">
        <a href="stockItemsView.php" > Back </a>
    </div>

    <div id = "centerTitle">
        <h2>Stock Item Details: </h2>
    </div>


<?php
    include 'stockItemsDetails.php';
echo"<tr>";

if ($active == 0) {
    echo "<td style= 'background-color: #59E059;'><p>Active</br>
                <a href=\"stockItemsDeactivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></p></td>";
} else if ($active == 1) {
    echo "<td style = 'background-color: #FF6666;'><p>NOT Active<br/>
                <a href=\"stockItemsActivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a></p></td>";
}

echo "  <td style='text-align: center;'>
                    <a href=\"stockItemsUpdate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
        </td></tr></table>
                ";
    include '../include/footer.php';
?>