<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>
    <div id = "backBtn">
        <a href="customerStockView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
    </div>
    <div id = "centerTitle">
        <h2>Update Customer Stock Level: </h2>
    </div>


<?php
$HIRE_NUMBER = $_GET['HIRE_NUMBER'];
//MYSQLI
$sql = "SELECT * FROM `total_at_customer_table` WHERE HIRE_NUMBER = '$HIRE_NUMBER';";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc() )
    {

?>
        <?php $needed = $row["TOTAL_QUANTITY_NEEDED"]; ?>
        <form id="FormName" action="customerStockUpdated.php" method="post" name="FormName">
            <table class="updateTable">
                <?php include 'customerStockDetails.php';?>
                <tr style="border-bottom: 0px;">
                    <th style="padding: 3% 5%;">
                        <label for="TOTAL_QUANTITY_NEEDED">New Hold level Total: </label>
                    </th>
                    <td style="padding: 3% 5%;">

                   <?php echo "<input id='TOTAL_QUANTITY_NEEDED' name='TOTAL_QUANTITY_NEEDED' style='width: 100%; margin-top: 0px; text-align: center;' type='number' value='" .$needed. "' maxlength='9' minlength='1' required/>"; ?>
                    </td>
                </tr>
                <tr style="border-bottom: 0px; ">
                    <td style="text-align: center;" colspan='2'>
                        <input type="submit" id="submit" name="submitButtonName" value="Update"/>
                        <input type="hidden" name="HIRE_NUMBER" value="<?php echo $HIRE_NUMBER ?>"/>
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