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
    <table id = "updateTable" border='0px' align='center' width='50%'>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_NAME">Name/ Description: </label>
                </div>
            </td>
            <td>
                <input id="STOCK_NAME" name="STOCK_NAME" type="text" size="50" value="<?php echo $row["STOCK_NAME"]?>" maxlength="50" minlength="5" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_TYPE_ID">Stock Type Name: </label>
                </div>
            </td>
            <td>
                <select name="STOCK_TYPE_ID" id="STOCK_TYPE_ID">

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
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="HIRE_COST">Hire Cost: </label>
                </div>
            </td>
            <td>                                                            <!--to allow decimals upto 2 places-->
                <input id="HIRE_COST" name="HIRE_COST" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" size="50" value="<?php echo $row["HIRE_COST"]?>" maxlength="25" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="REPLACE_COST">Replacement Cost: </label>
                </div>
            </td>
            <td>                                                            <!--to allow decimals upto 2 places-->
                <input id="REPLACE_COST" name="REPLACE_COST" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" size="50" value="<?php echo $row["REPLACE_COST"] ?>" maxlength="15" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="SIZE">Size: </label>
                </div>
            </td>
            <td>
                <input id="SIZE" name="SIZE" type="text" size="50" value="<?php echo $row["SIZE"] ?>" maxlength="15" minlength="2" />
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR1">Main colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR1" name="COLOUR1" type="text" size="50" value="<?php echo $row["COLOUR1"] ?>" maxlength="25" minlength="3" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR2">Secondary colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR2" name="COLOUR2" type="text" size="50" value="<?php echo $row["COLOUR2"] ?>" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR3">Tertiary colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR3" name="COLOUR3" type="text" size="50" value="<?php echo $row["COLOUR3"] ?>" maxlength="25" minlength="3"/>
            </td>
        </tr>
        <tr>
            <td width="150"></td>
            <td><input type="submit" name="submitButtonName" value="Update"/><input type="hidden" name="STOCK_ID" value="<?php echo $row["STOCK_ID"]?>"/></td>
        </tr>
        <tr>
            <td width = "150" colspan='2'>
                <div align="left">
                    <label for="STOCK_TOTAL"><p>*You cannot change stock levels here, it would break stock level calculations</p> </label>
                </div>
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