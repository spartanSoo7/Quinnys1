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
    <a href="customerView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>
<div id = "centerTitle">
    <h2>Add Customer: </h2>
</div>

<form id="FormName" action="customerAdded.php" method="post" name="FormName">
    <table class = "updateTable">
        <tr>
            <th>
                <label for="CUSTOMER_NAME">Customer Name: </label>
            </th>
            <td>
                <input id="CUSTOMER_NAME" name="CUSTOMER_NAME" type="text"  value="" maxlength="50" minlength="5" required/>
            </td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_EMAIL" style="color: #888;">Customer Email Address: </label>
            </td>
            <td>
                <input id="CUSTOMER_EMAIL" name="CUSTOMER_EMAIL" type="email"  value="" maxlength="50" minlength="5" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_PHONE1" style="color: #888;">Customer Primary Phone Number: </label>
            </th>
            <td>
                <input id="CUSTOMER_PHONE1" name="CUSTOMER_PHONE1" type="text"  value="" maxlength="15" minlength="5" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_PHONE2" style="color: #888;">Customer Secondary Phone Number: </label>
            </th>
            <td>
                <input id="CUSTOMER_PHONE2" name="CUSTOMER_PHONE2" type="text"  value="" maxlength="15" minlength="5" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_POSTAL_ADDRESS" style="color: #888;">Customer Postal Address: </label>
            </th>
            <td>
                <input id="CUSTOMER_POSTAL_ADDRESS" name="CUSTOMER_POSTAL_ADDRESS" type="text"  value="" maxlength="50" minlength="5" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_PHYSICAL_ADDRESS" style="color: #888;">Customer Physical Address: </label>
            </th>
            <td>
                <input id="CUSTOMER_PHYSICAL_ADDRESS" name="CUSTOMER_PHYSICAL_ADDRESS" type="text"  value="" maxlength="50" minlength="5" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_CONTACT_NAME" style="color: #888;">Customer Contact Name: </label>
            </th>
            <td>
                <input id="CUSTOMER_CONTACT_NAME" name="CUSTOMER_CONTACT_NAME" type="text"  value="" maxlength="25" minlength="3" />
            </td>
        </tr>
        <tr style="border-bottom: 0px; ">
            <td colspan="2" style="text-align: center">
                <input type="submit" id = "submit" name="submitButtonName" value="Add Customer"/>
            </td>
        </tr>
    </table>
</form>
<?php
$conn->close();
include '../include/footer.php';
?>
