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
    echo "<th style= 'background-color: #59E059; width: 50%; text-align: center; '><p>Active</br>
                <a href=\"stockItemsDeactivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></p></th>";
} else if ($active == 1) {
    echo "<th style = 'background-color: #FF6666; width: 50%;'><p>NOT Active<br/>
                <a href=\"stockItemsActivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a></p></th>";
}

echo "  <td style='text-align: center; width: 50%; '>
                    <a href=\"stockItemsUpdate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
        </td></tr></table>
                ";
    include '../include/footer.php';
?>