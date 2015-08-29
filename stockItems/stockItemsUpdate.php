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
    <h2>Update Stock Type: </h2>
</div>


<?php
$id = $_GET['STOCK_ID'];
$qP = "SELECT * FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$id'  ";
$rsP = mysql_query($qP);
$row = mysql_fetch_array($rsP);
extract($row);

$STOCK_NAME = trim($STOCK_NAME);
$STOCK_TYPE_ID  = trim($STOCK_TYPE_ID);
//$STOCK_TYPE_NAME NEEDS TO GO HERE FOR THE DROPDOWNLIST
$HIRE_COST  = trim($HIRE_COST);
$REPLACE_COST  = trim($REPLACE_COST);
$SIZE = trim($SIZE);
$COLOUR1 = trim($COLOUR1);
$COLOUR2 = trim($COLOUR2);
$COLOUR3 = trim($COLOUR3);
$STOCK_TOTAL = trim($STOCK_TOTAL);



?>

<form id="FormName" action="stockItemsUpdated.php" method="post" name="FormName">
    <table id = "updateTable" border='0px' align='center' width='50%'>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_NAME">Name/ Description: </label>
                </div>
            </td>
            <td>
                <input id="STOCK_NAME" name="STOCK_NAME" type="text" size="50" value="<?php echo $STOCK_NAME ?>" maxlength="50" minlength="5" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="STOCK_TYPE_ID">Stock Type Name: </label>
                </div>
            </td>
            <td>
                <select name="STOCK_TYPE_ID" id="STOCK_TYPE_ID">

                    <?php
                    $result = mysql_query("SELECT * FROM STOCK_TYPE_TABLE");
                    $num = mysql_num_rows ($result);
                    $icount = 0 ;


                    //its gooooood
                    while ($icount < $num)
                    {
                        $activeStock = mysql_result($result,$icount,"STOCK_TYPE_ACTIVE");
                        if(mysql_result($result,$icount,"STOCK_TYPE_ID") == $STOCK_TYPE_ID){
                            echo"<option id='1' value = '".mysql_result($result,$icount,"STOCK_TYPE_ID")."' selected>".mysql_result($result,$icount,"STOCK_TYPE_NAME")."</option>";
                        }
                        else if($activeStock == 0){
                            echo"<option id='1' value = '".mysql_result($result,$icount,"STOCK_TYPE_ID")."'>".mysql_result($result,$icount,"STOCK_TYPE_NAME")."</option>";
                        }

                        $icount++;
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
                <input id="HIRE_COST" name="HIRE_COST" type="number" size="50" value="<?php echo $HIRE_COST ?>" maxlength="25" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="REPLACE_COST">Replacement Cost: </label>
                </div>
            </td>
            <td>
                <input id="REPLACE_COST" name="REPLACE_COST" type="number" size="50" value="<?php echo $REPLACE_COST ?>" maxlength="15" minlength="1" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="SIZE">Size: </label>
                </div>
            </td>
            <td>
                <input id="SIZE" name="SIZE" type="text" size="50" value="<?php echo $SIZE ?>" maxlength="15" minlength="2" />
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR1">Main colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR1" name="COLOUR1" type="text" size="50" value="<?php echo $COLOUR1 ?>" maxlength="25" minlength="3" required/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR2">Secondary colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR2" name="COLOUR2" type="text" size="50" value="<?php echo $COLOUR2 ?>" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <td width = "150">
                <div align="left">
                    <label for="COLOUR3">Tertiary colour: </label>
                </div>
            </td>
            <td>
                <input id="COLOUR3" name="COLOUR3" type="text" size="50" value="<?php echo $COLOUR3 ?>" maxlength="25" minlength="3"/>
            </td>
        </tr>

        <tr>
            <td width = "150" colspan='2'>
                <div align="left">
                    <label for="STOCK_TOTAL"><p>You cannot change stock levels here, it would break stock level calculations</p> </label>
                </div>
            </td>
        </tr>
        <tr>
            <td width="150"></td>
            <td><input type="submit" name="submitButtonName" value="Update"/><input type="hidden" name="STOCK_ID" value="<?php echo $id?>"/></td>
        </tr>
    </table>
</form>

<?php include '../include/footer.php';?>

