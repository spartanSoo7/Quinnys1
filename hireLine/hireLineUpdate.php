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
        <a href="hireLineView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
    </div>
    <div id = "centerTitle">
        <h2>Update Hire Line: </h2>
    </div>


<?php
    include 'hireLineDetails.php';
echo "</table>";
    $HIRE_LINE_NUMBER = $_GET['HIRE_LINE_NUMBER'];
//MYSQLI
$sql = "SELECT * FROM `hire_transaction_table` WHERE HIRE_LINE_NUMBER = '$HIRE_LINE_NUMBER';";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc() )
    {
        $HIRE_QUANTITY = $row["HIRE_QUANTITY"];
        ?>
        <form id="FormName" action="hireLineUpdated.php" method="post" name="FormName">
            <table class="updateTable">
                <tr style="border-bottom: 0px;">
                    <th style="padding: 3% 5%;">
                        <label for="HIRE_QUANTITY">Update hire quantity: </label>
                    </th>
                    <td style="padding: 3% 5%;">
                        <?php
                        //stop enduser hireing out more stock than they have instock
                        $stockMax = $STOCK_IN + $origQuantity;
                        echo "<input id='HIRE_QUANTITY' name='HIRE_QUANTITY' style='width: 100%; margin-top: 0px; text-align: center;' type='number' value='" .$HIRE_QUANTITY. "' maxlength='9' minlength='1' max='" .$stockMax. "' required/>";

                        ?>
                    </td>
                </tr>
                <tr style="border-bottom: 0px; ">
                    <td style="text-align: center;" colspan='2'>
                        <input type="submit" id="submit" name="submitButtonName" value="Update"/>
                        <input type="hidden" name="HIRE_LINE_NUMBER" value="<?php echo $HIRE_LINE_NUMBER ?>"/>
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