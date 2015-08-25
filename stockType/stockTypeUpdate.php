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
    <h2>Update Stock Type: </h2>
</div>


<?php
$id = $_GET['STOCK_TYPE_ID'];
$qP = "SELECT * FROM STOCK_TYPE_TABLE WHERE STOCK_TYPE_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);
$STOCK_TYPE_NAME = trim($STOCK_TYPE_NAME);
?>

<form id="FormName" action="stockTypeUpdated.php" method="post" name="FormName">
    <table class = "updateTable" border='0' align='center' width='50%'>
        <tr><td width="150">
                <div align="left">
                    <label for="STOCK_TYPE_NAME">Stock Type Name </label></div>
            </td>
            <td>
                <input id="STOCK_TYPE_NAME" name="STOCK_TYPE_NAME" type="text" size="30" value="<?php echo $STOCK_TYPE_NAME ?>" maxlength="35" required/></td>
        </tr>
        <tr>
            <td width="150"></td>
            <td><input type="submit" name="submitButtonName" value="Update"/><input type="hidden" name="STOCK_TYPE_ID" value="<?php echo $id?>"/></td>
        </tr>
    </table>
</form>

<?php include '../include/footer.php';?>

