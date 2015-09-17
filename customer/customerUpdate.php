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
    <h2>Update Customer: </h2>
</div>


<?php
$CUSTOMER_ID = $_GET['CUSTOMER_ID'];

//MYSQLI
$sql = "SELECT
          CUSTOMER_ID,
          CUSTOMER_EMAIL,
          CUSTOMER_NAME,
          CUSTOMER_PHONE1,
          CUSTOMER_PHONE2,
          CUSTOMER_POSTAL_ADDRESS,
          CUSTOMER_PHYSICAL_ADDRESS,
          CUSTOMER_CONTACT_NAME
        FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$CUSTOMER_ID' ";
$result = $conn->query($sql);




if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>
        <form id="FormName" action="customerUpdated.php" method="post" name="FormName">
    <table class = "updateTable">
        <tr>
            <th>
                    <label for="CUSTOMER_NAME">Customer Name</label>
            </th>
            <td>
                <input id="CUSTOMER_NAME" name="CUSTOMER_NAME" type="text" size="30" value="<?php echo $row["CUSTOMER_NAME"]?>" maxlength="50" required/></td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_EMAIL">Customer Email Address</label>
            </th>
            <td>
                <input id="CUSTOMER_EMAIL" name="CUSTOMER_EMAIL" type="text" size="30" value="<?php echo $row["CUSTOMER_EMAIL"] ?>" maxlength="50" /></td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_PHONE1">Customer Primary Phone Number</label>
            </th>
            <td>
                <input id="CUSTOMER_PHONE1" name="CUSTOMER_PHONE1" type="text" size="30" value="<?php echo $row["CUSTOMER_PHONE1"] ?>" maxlength="15" /></td>
        </tr>
        <tr>
            <th>
                    <label for="CUSTOMER_PHONE2">Customer Secondary Phone Number</label>
            </th>
            <td>
                <input id="CUSTOMER_PHONE2" name="CUSTOMER_PHONE2" type="text" size="30" value="<?php echo $row["CUSTOMER_PHONE2"] ?>" maxlength="15" /></td>
        </tr>
        <tr>
            <th>
                    <label for="CUSTOMER_POSTAL_ADDRESS">Customer Postal Address</label>
            </th>
            <td>
                <input id="CUSTOMER_POSTAL_ADDRESS" name="CUSTOMER_POSTAL_ADDRESS" type="text" size="30" value="<?php echo $row["CUSTOMER_POSTAL_ADDRESS"] ?>" maxlength="50" /></td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_PHYSICAL_ADDRESS">Customer Physical Address</label>
            </th>
            <td>
                <input id="CUSTOMER_PHYSICAL_ADDRESS" name="CUSTOMER_PHYSICAL_ADDRESS" type="text" size="30" value="<?php echo $row["CUSTOMER_PHYSICAL_ADDRESS"] ?>" maxlength="50" /></td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_CONTACT_NAME">Customer Contact Name</label>
            </th>
            <td>
                <input id="CUSTOMER_CONTACT_NAME" name="CUSTOMER_CONTACT_NAME" type="text" size="30" value="<?php echo $row["CUSTOMER_CONTACT_NAME"] ?>" maxlength="25" /></td>
        </tr>

        <tr style="border-bottom: 0px; ">
            <td colspan="2" style="text-align: center">
                <input type="submit" id="submit" name="submitButtonName" value="Update"/><input type="hidden" name="CUSTOMER_ID" value="<?php echo $row["CUSTOMER_ID"]?>"/></td>
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
