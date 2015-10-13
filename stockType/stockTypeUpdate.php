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
    <a href="stockTypeView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>
<div id = "centerTitle">
    <h2>Update Stock Type: </h2>
</div>


<?php
$STOCK_TYPE_ID = $_GET['STOCK_TYPE_ID'];
//MYSQLI
$sql = "SELECT * FROM `stock_type_table` WHERE STOCK_TYPE_ID = '$STOCK_TYPE_ID';";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>

        <form id="FormName" action="stockTypeUpdated.php" method="post" name="FormName">
            <table class="updateTable" border='0' align='center' width='50%'>
                <tr>
                    <th>
                            <label for="STOCK_TYPE_NAME">Stock Type Name </label>
                    </th>
                    <td>
                        <input id="STOCK_TYPE_NAME" name="STOCK_TYPE_NAME" type="text" size="30"
                               value="<?php echo $row["STOCK_TYPE_NAME"]?>" maxlength="35" required/></td>
                </tr>
                <tr style="border-bottom: 0px; ">
                    <td style="text-align: center;" colspan='2'>
                        <input type="submit" id="submit" name="submitButtonName" value="Update"/>
                        <input type="hidden" name="STOCK_TYPE_ID" value="<?php echo $STOCK_TYPE_ID ?>"/>
                    </td>
                </tr>
            </table>
        </form>

<?php
    }
}
include '../include/footer.php';
?>

