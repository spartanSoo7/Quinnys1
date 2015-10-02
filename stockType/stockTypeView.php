<?php
    include '../include/head.php';
    require("../include/securitycheck.php");
    include '../include/header.php';
    include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Home </a>
</div>

<div id = "centerTitle">
    <h2>Here are all the types of stock currently in the system: </h2>
</div>

<div id = "miniMenu">
    <a href='stockTypeAdd.php' style="float: right;">
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047; font-size: 16px; padding: 10px;  height: 20px;">
            Add New Stock type
        </div>
    </a>
</div>

<table id = 'viewTable' ">
    <tr>
        <th>Stock Type</th>
        <th>Active?</th>
        <th>Update</th>
    </tr>

<?php

//MYSQLI
$sql = "SELECT * FROM `stock_type_table` ORDER BY STOCK_TYPE_ACTIVE ASC, STOCK_TYPE_NAME ASC";
$result = $conn->query($sql);
$icount = 0;
if ($result->num_rows > 0)
{
    // output data of each row
    while ($row = $result->fetch_assoc() )
    {

        $active = $row["STOCK_TYPE_ACTIVE"];
        $STOCK_TYPE_ID = $row["STOCK_TYPE_ID"];
        echo "<tr>";
        echo "    <td> " .$row["STOCK_TYPE_NAME"]. "</td>";

        if ($active == 0) {
            echo "<td style= 'background-color: #59E059;'><p>Active</br>
                <a href=\"stockTypeDeactivate.php?STOCK_TYPE_ID=$STOCK_TYPE_ID\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></p></td>";
        } else if ($active == 1) {
            echo "<td style = 'background-color: #FF6666;'><p>NOT Active<br/>
                <a href=\"stockTypeActivate.php?STOCK_TYPE_ID=$STOCK_TYPE_ID\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a></p></td>";
        }

        echo "    <td align='center'>
                    <a href=\"stockTypeUpdate.php?STOCK_TYPE_ID=$STOCK_TYPE_ID\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                    <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key-->
                    <!--<a href=\"stockTypeDelete.php?STOCK_TYPE_ID=$STOCK_TYPE_ID\" style ='padding-bottom: 10px; margin: 10px; display: block;'>Delete</a>-->
              </td>";
        echo "<tr>";
        $icount++;
    }
}
echo "<tr><td colspan='5' align='center'><a href='stockTypeAdd.php'> Add a new stock type</a></td></tr>";
echo "<tr><td colspan='5' align='center'> You have ".$icount." stock type(s) </td> </tr>";

echo "</table>";

$conn->close();
include '../include/footer.php';?>

