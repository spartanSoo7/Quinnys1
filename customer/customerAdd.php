<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>
<div id = "backBtn">
    <a href="customerView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>
<div id = "centerTitle">
    <h2>Add Customer: </h2>
</div>

<form id="FormName" action="customerAdded.php" method="post" name="FormName">
    <table class = "updateTable" border='0' align='center' width='50%'>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_NAME">Customer Name: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_NAME" name="CUSTOMER_NAME" type="text" size="50" value="" maxlength="50" minlength="5" required/>
            </td>
        </tr>
        <tr>
            <td width="150"></td>
            <td>
                <input type="submit" name="submitButtonName" value="Add Customer"/>
            </td>
        </tr>
    </table>
</form>
<?php include '../include/footer.php';?>
