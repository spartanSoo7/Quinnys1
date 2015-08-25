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
$id = $_GET['CUSTOMER_ID'];
$qP = "SELECT * FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);
$CUSTOMER_NAME = trim($CUSTOMER_NAME);
?>

<form id="FormName" action="customerUpdated.php" method="post" name="FormName">
    <table class = "updateTable" border='0' align='center' width='50%'>
        <tr>
            <td width="150">
                <div align="left">
                    <label for="CUSTOMER_NAME">Customer Name  </label></div>
            </td>
            <td>
                <input id="CUSTOMER_NAME" name="CUSTOMER_NAME" type="text" size="30" value="<?php echo $CUSTOMER_NAME ?>" maxlength="35" required/></td>
        </tr>
        <tr>
            <td width="150"></td>
            <td><input type="submit" name="submitButtonName" value="Update"/><input type="hidden" name="CUSTOMER_ID" value="<?php echo $id?>"/></td>
        </tr>
    </table>
</form>

<?php include '../include/footer.php';?>

