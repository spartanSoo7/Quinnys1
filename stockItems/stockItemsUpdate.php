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
    <a href="stockItemsView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>
<div id = "centerTitle">
    <h2>Update Stock Item: </h2>
</div>


<?php
$STOCK_ID = $_GET['STOCK_ID'];
//MYSQLI
$sql = "SELECT * FROM `stock_items_table` WHERE STOCK_ID = '$STOCK_ID';";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
// output data of each row
while ($row = $result->fetch_assoc())
{
    $STOCK_TYPE_ID = $row["STOCK_TYPE_ID"];
?>

<form id="FormName" action="stockItemsUpdated.php" method="post" name="FormName">
    <table class = "updateTable">

        <tr>
            <th>
                    <label for="STOCK_NAME">Name/ Description: </label>
            </th>
            <td>
                <input id="STOCK_NAME" name="STOCK_NAME" type="text" size="50" value="<?php echo $row["STOCK_NAME"]?>" maxlength="50" minlength="5" required/>
            </td>
        </tr>
        <tr>
            <th>
                    <label for="STOCK_TYPE_ID">Stock Type Name: </label>
            </th>
            <td>
                <select name="STOCK_TYPE_ID" id="STOCK_TYPE_ID" style="width: 50%; float: left; margin-top: 5px;" required>

<?php
    $sql = "SELECT * FROM `stock_type_table`;";
    $result2 = $conn->query($sql);


    if ($result2->num_rows > 0) {
        // output data of each row
        while ($row2 = $result2->fetch_assoc())
        {
            $activeStock = $row2["STOCK_TYPE_ACTIVE"];

            if ($row2["STOCK_TYPE_ID"] == $STOCK_TYPE_ID)
            {
                echo "<option id='" .$row2["STOCK_TYPE_ID"]. "' value = '" .$row2["STOCK_TYPE_ID"]. "' selected>" .$row2["STOCK_TYPE_NAME"]. "</option>";
            }
            else if ($activeStock == 0)
            {
                echo "<option id='" .$row2["STOCK_TYPE_ID"]. "' value = '" .$row2["STOCK_TYPE_ID"]. "'>" .$row2["STOCK_TYPE_NAME"]. "</option>";
            }

            $icount++;
        }
    }
?>

                </select>
                <a href=../stockType/stockTypeAdd.php style ='margin: 5px; display: block;'> Add new? </a>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="HIRE_COST">Hire Cost: </label>
            </th>
            <td>                                                            <!--to allow decimals upto 2 places-->
                <input id="HIRE_COST" name="HIRE_COST" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0"  value="<?php echo $row["HIRE_COST"]?>" maxlength="25" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="REPLACE_COST">Replacement Cost: </label>
            </th>
            <td>                                                            <!--to allow decimals upto 2 places-->
                <input id="REPLACE_COST" name="REPLACE_COST" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" value="<?php echo $row["REPLACE_COST"] ?>" maxlength="15" minlength="1" required/>
            </td>
        </tr>
        <tr>
            <th>
                    <label for="SIZE" style="color: #888;">Size: </label>
            </th>
            <td>
                <input id="SIZE" name="SIZE" type="text" value="<?php echo $row["SIZE"] ?>" maxlength="15" minlength="2" />
            </td>
        </tr>

        <tr>
            <th>
                    <label for="COLOUR1">Main colour: </label>
            </th>
            <td>
                <input id="COLOUR1" name="COLOUR1" type="text" value="<?php echo $row["COLOUR1"] ?>" maxlength="25" minlength="3" required/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="COLOUR2" style="color: #888;">Secondary colour: </label>
            </th>
            <td>
                <input id="COLOUR2" name="COLOUR2" type="text" value="<?php echo $row["COLOUR2"] ?>" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="COLOUR3" style="color: #888;">Tertiary colour: </label>
            </th>
            <td>
                <input id="COLOUR3" name="COLOUR3" type="text" value="<?php echo $row["COLOUR3"] ?>" maxlength="25" minlength="3"/>
            </td>
        </tr>
        <tr style="border-bottom: 0px; ">
            <td colspan="2" style="text-align: center">
            <input type="submit" id="submit" name="submitButtonName" value="Update"/><input type="hidden" name="STOCK_ID" value="<?php echo $row["STOCK_ID"]?>"/></td>
        </tr>
        <tr style="border-bottom: 0px; ">
            <td style="text-align: center" colspan='2'>
                    <label for="STOCK_TOTAL"><p>*You cannot change stock levels here, it would break stock level calculations</p> </label>
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