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
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_EMAIL">Customer Email Address: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_EMAIL" name="CUSTOMER_EMAIL" type="email" size="50" value="" maxlength="50" minlength="5" />
            </td>
        </tr>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_PHONE1">Customer Primary Phone Number: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_PHONE1" name="CUSTOMER_PHONE1" type="text" size="15" value="" maxlength="15" minlength="5" />
            </td>
        </tr>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_PHONE2">Customer Secondary Phone Number: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_PHONE2" name="CUSTOMER_PHONE2" type="text" size="15" value="" maxlength="15" minlength="5" />
            </td>
        </tr>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_POSTAL_ADDRESS">Customer Postal Address: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_POSTAL_ADDRESS" name="CUSTOMER_POSTAL_ADDRESS" type="text" size="15" value="" maxlength="50" minlength="5" />
            </td>
        </tr>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_PHYSICAL_ADDRESS">Customer Physical Address: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_PHYSICAL_ADDRESS" name="CUSTOMER_PHYSICAL_ADDRESS" type="text" size="15" value="" maxlength="50" minlength="5" />
            </td>
        </tr>
        <tr>
            <td width = "150">
                <div align="left">
                    <label for="CUSTOMER_CONTACT_NAME">Customer Contact Name: </label>
                </div>
            </td>
            <td>
                <input id="CUSTOMER_CONTACT_NAME" name="CUSTOMER_CONTACT_NAME" type="text" size="15" value="" maxlength="25" minlength="3" />
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
<?php
    $conn->close();
    include '../include/footer.php';
?>
