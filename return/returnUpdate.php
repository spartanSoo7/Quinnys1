<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>
<div id = "backBtn">
    <a href="returnView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>
<div id = "centerTitle">
    <h2>Update Return Line: </h2>
</div>


<?php
include 'returnDetails.php';
echo "</table>";
$RETURN_ID = $_GET['RETURN_ID'];
//MYSQLI
$sql = "SELECT * FROM `retured_table` WHERE RETURN_ID = '$RETURN_ID';";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc() )
    {
        $RETURNED_QUANTITY = $row["RETURNED_QUANTITY"];
        ?>
        <form id="FormName" action="returnUpdated.php" method="post" name="FormName">
            <table class="updateTable">
                <tr style="border-bottom: 0px;">
                    <th style="padding: 3% 5%;">
                        <label for="RETURNED_QUANTITY">Update return quantity: </label>
                    </th>
                    <td style="padding: 3% 5%;">
                        <?php
                        //stop enduser hireing out more stock than they have instock
                        $stockMax = $STOCK_IN + $origQuantity;                                                                                                                                              //the current total the customer has in stock
                        echo "<input id='RETURNED_QUANTITY' name='RETURNED_QUANTITY' style='width: 100%; margin-top: 0px; text-align: center;' type='number' value='" .$RETURNED_QUANTITY. "' maxlength='9' minlength='1' max='" .$totalAtCustomer. "' required/>";

                        ?>
                    </td>
                </tr>
                <tr style="border-bottom: 0px; ">
                    <td style="text-align: center;" colspan='2'>
                        <input type="submit" id="submit" name="submitButtonName" value="Update"/>
                        <input type="hidden" name="RETURN_ID" value="<?php echo $RETURN_ID ?>"/>
                    </td>
                </tr>
            </table>
        </form>

        <?php
    }
}else{
    echo "Something went wrong";
}
$conn->close();
include '../include/footer.php';
?>