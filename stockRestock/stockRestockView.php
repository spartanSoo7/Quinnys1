<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'>Home</a>
</div>

<div id = "centerTitle">
    <h2>Restock Lines: </h2>
</div>

<script>
    /*for the datepicker*/
    /*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
    $(document).ready(

        /* This is the function that will get executed after the DOM is fully loaded */
        function () {
            $( ".datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,//this option for allowing user to select month
                changeYear: true //this option for allowing user to select from year range
            });
        }

    );
</script>

<?php
//custom view, if selected
if(isset($_POST['submit'])) {
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$STOCK_ID = $_POST['STOCK_ID'];

?>

<div id="custForm" style="max-width: 628px;">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div id="custFormFloat" style="width: 11%; min-width: 115px; margin-top: 6px; font-size: 14px">
            Start Date:
            <input type="text" class="datepicker" size="6" name="startDate" value="<?php echo $startDate; ?>"
                   required>
        </div>
        <div id="custFormFloat" style="width: 11%; min-width: 115px; margin-top: 6px; ; font-size: 14px">
            End Date:
            <input type="text" class="datepicker" size="6" name="endDate" value="<?php echo $endDate; ?>" required>
        </div>

        <div id="custFormFloat" style="width: 27%; font-size: 14px; height: 64px; min-width: 320px; margin-top: 2px; ">
            Name/ Description  |  Type  |  Size  |  Colour)
            <select name="STOCK_ID" id="STOCK_ID" style="width: 100%; font-size: 16px; " required>
                <?php


                $sql = "
SELECT
  i.*,
  t.*
FROM
  STOCK_ITEMS_TABLE i inner join STOCK_TYPE_TABLE t
on
  i.STOCK_TYPE_ID = t.STOCK_TYPE_ID
ORDER BY STOCK_TYPE_NAME ASC, STOCK_NAME ASC
          ";

                $result3 = $conn->query($sql);

                if ($result3->num_rows > 0) {
                    // output data of each row
                    if($STOCK_ID == "All"){
                        echo "<option id='All' value = 'All' selected>All</option>";
                    }
                    else{
                        echo "<option id='All' value = 'All'>All</option>";
                    }
                    while ($row = $result3->fetch_assoc())
                    {
                        $activeStock = $row["ACTIVE"];
                        if ($activeStock == 0)
                        {
                            $name = $row["STOCK_NAME"];

                            $outputString = $row["STOCK_NAME"]. " | " .$row["STOCK_TYPE_NAME"]. " |  " .$row["SIZE"]. " |  " .$row["COLOUR1"];

                            echo "<option id='" .$row["STOCK_ID"]. "' value = '" .$row["STOCK_ID"]. "'";

                            if ($row["STOCK_ID"] == $STOCK_ID) {
                                echo "selected";
                            }

                            echo ">" .$outputString. "</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div id="custFormFloat" style="width: 6%; margin-top: 34px;  margin-top: 39px; height: 17px; ">
            <input type="submit" name="submit" value="Go!">
        </div>
    </form>
</div>
<?php


//new format is 2015-09-01
$startDateFormatted = date('Y-m-d', (strtotime($startDate)));
$endDateFormatted = date('Y-m-d', (strtotime($endDate)));

//add time to the dates
$startDateFormatted = $startDateFormatted . ' 00:00:00';
$endDateFormatted = $endDateFormatted . ' 23:59:59';  //without telling the query the end date ends at midnight it doesnt out put data on that day

if($startDateFormatted > $endDateFormatted){
    echo "<h2 style = 'text-align: center; '>Start date is after end date</h2>";
    die();
}

$dateSQL = "RESTOCK_DATE between '" .$startDateFormatted. "' and '" .$endDateFormatted. "'";



if($STOCK_ID != "All"){
    $magicSql = "r.STOCK_ID = '" .$STOCK_ID. "' && " .$dateSQL;
}
elseif($STOCK_ID == "All"){
    $magicSql = $dateSQL;
}
else{
    include '../include/Error.php';
    die('Something broke');
}
$sql = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,
          i.REPLACE_COST,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          r.RESTOCK_DATE,
          r.RESTOCK_ID,
          r.RESTOCK_QUANTITY,
          r.STOCK_ID

FROM
    stock_restock_table r inner join STOCK_ITEMS_TABLE i
    on r.STOCK_ID = i.STOCK_ID

    inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

WHERE $magicSql

ORDER BY RESTOCK_DATE ASC, STOCK_NAME ASC
";
?>


<table id = 'viewTable'>
    <tr>
        <td colspan="3" style="border: 0px; "></td>
        <th colspan="2">Cost</th>
    </tr>
    <tr>
        <th>Stock</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Replacement Cost</th>
        <th>Total Cost</th>
        <th>Date</th>
        <th>Update/ Delete</th>
    </tr>
    <?php


    $result = $conn->query($sql);
    $icount = 0;

    if ($result->num_rows > 0)
    {
        // output data of each row

        while ($row = $result->fetch_assoc())
        {
            $cost = $row["RESTOCK_QUANTITY"] * $row["REPLACE_COST"];
            $RESTOCK_ID = $row["RESTOCK_ID"];
            $STOCK_ID = $row["STOCK_ID"];
            ?>
            <tr>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["RESTOCK_QUANTITY"]?></td>
                <td>$<?php echo $row["REPLACE_COST"]?></td>

                <td><?php echo "$" .$cost ?></td>

                <?php
                //2015-09-13 15:44:41
                $getDate = $row["RESTOCK_DATE"];
                $date = strtotime($getDate);

                //new format is 13-09-2015
                $dateFormated = date('j-m-Y', $date);
                ?>

                <td><?php echo $dateFormated ?></td>
                <td>
                    <a href='stockRestockUpdate.php?RESTOCK_ID=<?php echo $row["RESTOCK_ID"]. "&STOCK_ID=" .$STOCK_ID; ?>' style ='padding-bottom: 10px; margin: 5px; display: block;'>Update Quantity</a>

                    <a href='stockRestockDelete.php?RESTOCK_ID=<?php echo $row["RESTOCK_ID"]. "&STOCK_ID=" .$STOCK_ID; ?>' style ='padding-bottom: 10px; margin: 5px; display: block;'>Delete</a>
                </td>
            </tr>
            <?php
            $icount++;
        }
        echo "<tr><td colspan='9' align='center'><a href='stockRestockItem.php?STOCK_ID=" .$STOCK_ID. "'>Add a restock line</a></td></tr>";
        echo "<tr><td colspan='9' align='center'> You have ".$icount." Total restock lines</td> </tr>";
        echo "</table>";
?>
        <!--Print friendly link--->
    <form id="FormName" action="stockRestockViewPrint.php" method="post" name="FormName" style="width: 50%; margin: 0 auto; ">
        <input type="submit" id="submit" name="submitButtonName" value="Printable version" style="width: 100%; "/>
        <input type="hidden" name="endDateFormatted" value="<?php echo $endDateFormatted ?>"/>
        <input type="hidden" name="startDateFormatted" value="<?php echo $startDateFormatted ?>"/>
        <input type="hidden" name="STOCK_ID" value="<?php echo $STOCK_ID ?>"/>
        <input type="hidden" name="endDate" value="<?php echo $endDate ?>"/>
        <input type="hidden" name="startDate" value="<?php echo $startDate ?>"/>
    </form>
        <?php
    }
    else{
        ?>
        <tr>
            <td colspan="7">
                No records found in this range
            </td>
        </tr>
        <?php
    }
    }
    else{
//user has filled in a form yet
        ?>
        <div id="custForm" style="max-width: 628px;">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div id="custFormFloat" style="width: 11%; min-width: 115px; margin-top: 6px; font-size: 14px">
                    Start Date:
                    <input type="text" class="datepicker" size="6" name="startDate"
                           required>
                </div>
                <div id="custFormFloat" style="width: 11%; min-width: 115px; margin-top: 6px; ; font-size: 14px">
                    End Date:
                    <input type="text" class="datepicker" size="6" name="endDate" required>
                </div>

                <div id="custFormFloat" style="width: 27%; font-size: 14px; height: 64px; min-width: 320px; margin-top: 2px; ">
                    Name/ Description  |  Type  |  Size  |  Colour)
                    <select name="STOCK_ID" id="STOCK_ID" style="width: 100%; font-size: 16px; " required>
                        <option selected disabled hidden value=''></option>
                        <option id='All' value = 'All'>All</option>
                        <?php

                        $sql = "
SELECT
  i.*,
  t.*
FROM
  STOCK_ITEMS_TABLE i inner join STOCK_TYPE_TABLE t
on
  i.STOCK_TYPE_ID = t.STOCK_TYPE_ID
ORDER BY STOCK_TYPE_NAME ASC, STOCK_NAME ASC
          ";

                        $result2 = $conn->query($sql);

                        if ($result2->num_rows > 0) {
                            // output data of each row
                            while ($row = $result2->fetch_assoc())
                            {
                                $activeStock = $row["ACTIVE"];
                                if ($activeStock == 0)
                                {
                                    $name = $row["STOCK_NAME"];

                                    $outputString = $row["STOCK_NAME"]. " | " .$row["STOCK_TYPE_NAME"]. " |  " .$row["SIZE"]. " |  " .$row["COLOUR1"];

                                    echo "<option id='" .$row["STOCK_ID"]. "' value = '" .$row["STOCK_ID"]. "'>"
                                        .$outputString.
                                        "</option>";
                                }
                            }
                        }
                        ?>
                    </select>

                </div>

                <div id="custFormFloat" style="width: 6%; margin-top: 34px;  margin-top: 39px; ">
                    <input type="submit" name="submit" value="Go!">
                </div>
            </form>
        </div>
        <?php
    }

    include '../include/footer.php';
    $conn->close();
    ?>

