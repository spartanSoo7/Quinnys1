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
//MYSQLI
$sql = "SELECT CUSTOMER_ID, CUSTOMER_ACTIVE, CUSTOMER_NAME FROM CUSTOMER_TABLE ORDER BY CUSTOMER_NAME ASC";
$result = $conn->query($sql);
?>

<table id="viewTable">;
    <tr>
        <th>Customer Name</th>
        <th>View</th>
        <th>Active?</th>
        <th>Update</th>
    </tr>

<?php
$icount = 0 ;

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc() )
    {
        $active = $row["CUSTOMER_ACTIVE"];
        $id = $row["CUSTOMER_ID"];

        echo "<tr>
                <td>
                    " . $row["CUSTOMER_NAME"]. "
                </td>
                <td align='center'>
                    <a href=\"customerDetailsView.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Details </a>
                </td>";
    if ($active == 0)
    {
        echo "  <td style= 'background-color: #59E059;'><p>Active</br>
                    <a href=\"customerDeactivate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a></p>
                </td>";
    }
    else if ($active == 1)
    {
        echo "  <td style = 'background-color: #FF6666;'><p>NOT Active<br/>
                    <a href=\"customerActivate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a></p>
                </td>";
    }

        echo "  <td align='center'>
                    <a href=\"customerUpdate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                <!--<a href=\"customerDelete.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 10px; display: block;'>Delete</a>-->        <!--needs to be ID10t proofed, should not be able to delete id referenced as a foreign key-->
                </td>
        <tr>";
        $icount++;
    }
}
else
{
    echo "<tr>
            <td colspan='5'>There are no customers in the system yet</td>
          </tr>";
}
echo "  <tr>
            <td colspan='5' align='center'><a href='customerAdd.php'> Add a new Customer  </a></td>
        </tr>
        <tr>
            <td colspan='5' align='center'> You have ".$icount." customer(s) </td>
        </tr>
    </table>";



$conn->close();
include '../include/footer.php';
?>