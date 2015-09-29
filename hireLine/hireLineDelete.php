<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <div id = "backBtn">
        <a href="hireLineView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
    </div>
    <div id = "centerTitle">
        <h2>Delete Hire Line: </h2>
    </div>


<?php
include 'hireLineDetails.php';
?>

<tr>
    <th colspan="2" style="font-size: 28px; text-align: center; padding: 30px 0px 15px 0px; ">
        Are you sure you want to delete this transaction?
    </th>
</tr>
<tr style="font-size: 25px">
    <th width="50%" style="text-align: center; border-right: solid 1px; background-color: #59E059">
        <a href="hireLineDeleted.php?HIRE_LINE_NUMBER=<?php echo $HIRE_LINE_NUMBER ?>" style="display: block">Yes</a>
    </th>
    <th width="50%" style="text-align: center; background-color: #FF6666">
        <a href="hireLineView.php" style="display: block">No</a>
    </th>
</tr>
</table>


<?php
$conn->close();
include '../include/footer.php';
?>