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

//MYSQLI
$sql = "SELECT i.*, t.* FROM STOCK_ITEMS_TABLE i
          inner join STOCK_TYPE_TABLE t on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID ORDER BY ACTIVE ASC, STOCK_TYPE_NAME ASC, STOCK_NAME ASC ";
$result = $conn->query($sql);



echo "<table id = 'viewTable'>";
echo "<tr>
            <th style='width: 15%'>Name/ Description</th>
            <th>Type</th>
            <th>Size</th>
            <th>Main Colour</th>
            <th>Details</th>
            <th>Active?</th>                <!--alt to delete keeps in table, but maintains data integrity-->
            <th>Update</th>
      </tr>";




$icount = 0;
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $active = $row["ACTIVE"];
        $id = $row["STOCK_ID"];
        echo "<tr>";
        echo "    <td> " .$row["STOCK_NAME"]. "</td>";


        echo "    <td> " .$row["STOCK_TYPE_NAME"]. "</td>
                  <td> " .$row["SIZE"]. "</td>
                  <td> " .$row["COLOUR1"]. "</td>
                  <td>
                    <a href=\"stockItemsDetailsView.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Details </a>
                  </td>";
        if ($active == 0) {
            echo "<td style= 'background-color: #59E059;'><p>Active</br>
                <a href=\"stockItemsDeactivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></p></td>";
        } else if ($active == 1) {
            echo "<td style = 'background-color: #FF6666;'><p>NOT Active<br/>
                <a href=\"stockItemsActivate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a></p></td>";
        }

        echo "    <td align='center'>
                    <a href=\"stockItemsUpdate.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                    <!--<a href=\"stockItemsDelete.php?STOCK_ID=$id\" style ='padding-bottom: 10px; margin: 10px;
                display: block;'>Delete</a>  -->           <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key, WORK AROUND set total_stock_level to 0 if no hire-->
              </td>";
        echo "<tr>";
        $icount++;
    }
}
echo "<tr><td colspan='8' align='center'><a href='stockItemsAdd.php'> Add a new stock Item</a></td></tr>";
echo "<tr><td colspan='9' align='center'> You have ".$icount." stock item(s) </td> </tr>";
echo "</table>";



    $conn->close();
    include '../include/footer.php';
?>