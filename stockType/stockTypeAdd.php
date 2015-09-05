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
    <h2>Add Stock Type: </h2>
</div>

<form id="FormName" action="stockTypeAdded.php" method="post" name="FormName">
    <table class = "updateTable" border='0' align='center' width='50%'>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_TYPE_NAME">Stock Type Name: </label>
                </div>
            </td>
            <td>
                <input id="STOCK_TYPE_NAME" name="STOCK_TYPE_NAME" type="text" size="50" value="" maxlength="50" minlength="3" required/>
            </td>
        </tr>
        <tr>
            <td width="150"></td>
            <td>
                <input type="submit" name="submitButtonName" value="Add Stock Type"/>
            </td>
        </tr>
    </table>
</form>
<?php include '../include/footer.php';?>
