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
    <h2>Add Stock Type: </h2>
</div>

<form id="FormName" action="stockItemsAdded.php" method="post" name="FormName">
    <table class = "updateTable">
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_NAME">Name/ Description: </label>
                </div>
            </td>
            <td>
                <input id="STOCK_NAME" name="STOCK_NAME" type="text" size="50" value="" maxlength="50" minlength="4" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_TYPE_ID">Stock Type Name: </label>
                </div>
            </td>
            <td>
                <select name="STOCK_TYPE_ID" id="STOCK_TYPE_ID" required>
                    <option selected disabled hidden value=''></option>
<?php
    $sql = "SELECT * FROM `stock_type_table`;";
    $result2 = $conn->query($sql);


    if ($result2->num_rows > 0) {
        // output data of each row
        while ($row = $result2->fetch_assoc())
        {
            $activeStock = $row["STOCK_TYPE_ACTIVE"];
            if ($activeStock == 0)
            {
                echo "<option id='" .$row["STOCK_TYPE_ID"]. "' value = '" .$row["STOCK_TYPE_ID"]. "'>" .$row["STOCK_TYPE_NAME"]. "</option>";
            }
echo "loop";

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
            <td>
                <input id="HIRE_COST" name="HIRE_COST" type="number" size="50" value="" maxlength="25" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="REPLACE_COST">Replacement Cost: </label>
                </div>
            </td>
            <td>
                <input id="REPLACE_COST" name="REPLACE_COST" type="number" size="50" value="" maxlength="15" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="SIZE">Size: </label>
                </div>
            </td>
            <td>
                <input id="SIZE" name="SIZE" type="text" size="50" value="" maxlength="15" minlength="2" />
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR1">Main colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR1" name="COLOUR1" type="text" size="50" value="" maxlength="25" minlength="3" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR2">Secondary colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR2" name="COLOUR2" type="text" size="50" value="" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR3">Tertiary colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR3" name="COLOUR3" type="text" size="50" value="" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_TOTAL">Starting Stock Total: </label>
                </div>
            </td>
            <td>
                <input id="STOCK_TOTAL" name="STOCK_TOTAL" type="number" size="50" value="" maxlength="11" minlength="3" required/>
            </td>
        </tr>

        <tr>
            <td width="150"></td>
            <td>
                <input type="submit" name="submitButtonName" value="Add Stock Item"/>
            </td>
        </tr>
    </table>
</form>
<?php include '../include/footer.php';?>
