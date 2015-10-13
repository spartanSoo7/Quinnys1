<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>
<!--
--Page was built by Kane Wardle
-->
<div id = "backBtn">
    <a href="stockItemsView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>
<div id = "centerTitle">
    <h2>Add Stock Item: </h2>
</div>

<form id="FormName" action="stockItemsAdded.php" method="post" name="FormName">
    <table class = "updateTable">
        <tr>
            <th>
                    <label for="STOCK_NAME">Name/ Description: </label>
            </th>
            <td>
                <input id="STOCK_NAME" name="STOCK_NAME" type="text" value="" maxlength="50" minlength="4" required/>
            </td>
        </tr>
        <tr>
            <th>
                    <label for="STOCK_TYPE_ID">Stock Type Name: </label>
            </th>
            <td>
                <select name="STOCK_TYPE_ID" id="STOCK_TYPE_ID" style="width: 50%; float: left; margin-top: 5px;" required>
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
                <input id="HIRE_COST" name="HIRE_COST" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" value="" maxlength="15" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <th width = "150">
                    <label for="REPLACE_COST">Replacement Cost: </label>
            </th>
            <td>                                                            <!--to allow decimals upto 2 places-->
                <input id="REPLACE_COST" name="REPLACE_COST" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" min="0" value="" maxlength="15" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="SIZE">Size: </label>
            </th>
            <td>
                <input id="SIZE" name="SIZE" type="text" value="" maxlength="15" minlength="2" />
            </td>
        </tr>

        <tr>
            <th>
                    <label for="COLOUR1">Main colour: </label>
            </th>
            <td>
                <input id="COLOUR1" name="COLOUR1" type="text" value="" maxlength="25" minlength="3" required/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="COLOUR2">Secondary colour: </label>
            </th>
            <td>
                <input id="COLOUR2" name="COLOUR2" type="text" value="" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="COLOUR3">Tertiary colour: </label>
            </th>
            <td>
                <input id="COLOUR3" name="COLOUR3" type="text" value="" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <th>
                    <label for="STOCK_TOTAL">Starting Stock Total: </label>
            </th>
            <td>
                <input id="STOCK_TOTAL" name="STOCK_TOTAL" type="number" value="" maxlength="9" minlength="3" required/>
            </td>
        </tr>

        <tr style="border-bottom: 0px; ">
            <td colspan="2" style="text-align: center">
                <input type="submit" name="submitButtonName" value="Add Stock Item"/>
            </td>
        </tr>
    </table>
</form>
<?php include '../include/footer.php';?>
