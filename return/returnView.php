<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Home </a>
</div>

<div id = "centerTitle">
    <h2>Return lines: </h2>
</div>
<div id = "miniMenu">
    <a href='../return/returnAdd.php' style="float: right;">
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047; font-size: 21px; padding: 10px;  height: 20px;">
            New Return
        </div>
    </a>

    <a href='../hireLine/hireLineViewDate.php' style="float: right;">
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(245, 90, 153)'"
             onMouseOut="this.style.backgroundColor='rgb(247, 108, 164)'"
             style="background-color: rgb(247, 108, 164); font-size: 21px; padding: 10px;  height: 20px;">
            Billing
        </div>
    </a>
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
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$STOCK_ID = $_POST['STOCK_ID'];

?>

<div id="custForm">
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

        <!--ADD stock-->

        <div id="custFormFloat" style="width: 20%; font-size: 14px; height: 64px; min-width: 209px; margin-top: 3px; ">
            Customer (Name and Address)
            <select name="CUSTOMER_ID" id="CUSTOMER_ID" style="width: 100%; font-size: 17px; " required>
                <?php
                $sql = "SELECT `CUSTOMER_ID`, `CUSTOMER_NAME`, `CUSTOMER_ACTIVE`, `CUSTOMER_PHYSICAL_ADDRESS` FROM `customer_table`";
                $result2 = $conn->query($sql);

                if ($result2->num_rows > 0) {
                    // output data of each row
                    if($CUSTOMER_ID == "All"){
                        echo "<option id='All' value = 'All' selected>All</option>";
                    }
                    else{
                        echo "<option id='All' value = 'All'>All</option>";
                    }
                    while ($row = $result2->fetch_assoc()) {
                        $activeCustomer = $row["CUSTOMER_ACTIVE"];

                        if ($activeCustomer == 0) {
                            echo "<option id='" . $row["CUSTOMER_ID"] . "' value = '" . $row["CUSTOMER_ID"] . "'";

                            if ($row["CUSTOMER_ID"] == $CUSTOMER_ID) {
                                echo "selected";
                            }

                            echo ">" . $row["CUSTOMER_NAME"] . " | " . $row["CUSTOMER_PHYSICAL_ADDRESS"] . "</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div id="custFormFloat" style="width: 27%; font-size: 14px; height: 64px; min-width: 320px; margin-top: 2px; ">
            Stock (Name/ Description  |  Type  |  Size  |  Colour)
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

//add time
$startDateFormatted = $startDateFormatted . ' 00:00:00';
$endDateFormatted = $endDateFormatted . ' 23:59:59';  //without telling the query the end date ends at midnight it doesnt out put data on that day

if($startDateFormatted > $endDateFormatted){
    echo "<h2 style = 'text-align: center; '>Start date is after end date</h2>";
    die();
}

$dateSQL = "n.RETURNED_DATE between '" .$startDateFormatted. "' and '" .$endDateFormatted. "'";

if($CUSTOMER_ID == "All" && $STOCK_ID == "All"){
    $magicSql = $dateSQL;
}
elseif($STOCK_ID == "All" && $CUSTOMER_ID != "All"){
    $magicSql = "s.CUSTOMER_ID = '" .$CUSTOMER_ID. "' && " .$dateSQL;
}
elseif($CUSTOMER_ID == "All" && $STOCK_ID != "All"){
    $magicSql = "s.STOCK_ID = '" .$STOCK_ID. "' && " .$dateSQL;
}
else{
    //stock id and customer id must be both set, as both fields are required
    $magicSql = "s.STOCK_ID = '" .$STOCK_ID. "' && " .$dateSQL. " && s.CUSTOMER_ID = '" .$CUSTOMER_ID. "' ";
}
//MYSQLI for customer display
$sqlCust = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          s.HIRE_NUMBER,
          s.CUSTOMER_ID,
          s.STOCK_ID,

          c.CUSTOMER_ID,
          c.CUSTOMER_NAME,

          n.RETURN_ID,
          n.RETURNED_QUANTITY,
          n.RETURNED_DATE,
          n.HIRE_NUMBER

FROM
    retured_table n inner join total_at_customer_table s
    on n.HIRE_NUMBER = s.HIRE_NUMBER

    inner join STOCK_ITEMS_TABLE i
    on s.STOCK_ID = i.STOCK_ID

    inner join customer_table c
      on s.CUSTOMER_ID = c.CUSTOMER_ID

   inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

WHERE $magicSql

ORDER BY RETURNED_DATE ASC, CUSTOMER_NAME ASC, STOCK_NAME ASC
";
?>

<table id = 'viewTable'>
    <tr>
        <td colspan="3" style="border: 0px; "></td>
        <th colspan="2">Cost</th>
    </tr>
    <tr>
        <th>Customer</th>
        <th>Stock</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Date</th>
        <th>Details</th>
        <th>Update</th>
    </tr>
    <?php


    $result = $conn->query($sqlCust);
    $icount = 0;

    if ($result->num_rows > 0)
    {
        // output data of each row

        while ($row = $result->fetch_assoc())
        { ?>
            <tr>
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["RETURNED_QUANTITY"]?></td>

                <?php
                //2015-09-13 15:44:41
                $getDate = $row["RETURNED_DATE"];
                $date = strtotime($getDate);

                //new format is 13-09-2015
                $dateFormated = date('j-m-Y', $date);
                ?>

                <td><?php echo $dateFormated ?></td>

                <td><a href=returnDetailsView.php?RETURN_ID=<?php echo $row["RETURN_ID"]; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Details </a></td>
                <td>
                    <a href=returnUpdate.php?RETURN_ID=<?php echo $row["RETURN_ID"]; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Update Quantity</a>
                </td>
            </tr>
            <?php
            $icount++;
        }
    }else{
        echo"
        <tr>
            <td colspan='9'>
                No records found
            </td>
        </tr>
    ";
    }
    echo "<tr><td colspan='9' align='center'><a href='returnAdd.php'>Add a new return line</a></td></tr>";
    echo "<tr><td colspan='9' align='center'> You have ".$icount." Total lines of hired stock</td> </tr>";
    echo "</table>";

    }
    else{
//user has filled in a form yet
        ?>
        <div id="custForm">
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

                <!--ADD date val-->

                <div id="custFormFloat" style="width: 20%; font-size: 14px; height: 64px; min-width: 209px; margin-top: 3px; ">
                    Customer (Name and Address)
                    <select name="CUSTOMER_ID" id="CUSTOMER_ID" style="width: 100%; font-size: 17px; " required>
                        <option selected disabled hidden value=''></option>
                        <?php
                        $sql = "SELECT `CUSTOMER_ID`, `CUSTOMER_NAME`, `CUSTOMER_ACTIVE`, `CUSTOMER_PHYSICAL_ADDRESS` FROM `customer_table`";
                        $result2 = $conn->query($sql);

                        if ($result2->num_rows > 0) {
                            // output data of each row
                            echo "<option id='All' value = 'All'>All</option>";

                            while ($row = $result2->fetch_assoc()) {
                                $activeCustomer = $row["CUSTOMER_ACTIVE"];

                                if ($activeCustomer == 0) {
                                    echo "<option id='" . $row["CUSTOMER_ID"] . "' value = '" . $row["CUSTOMER_ID"] . "'";

                                    echo ">" . $row["CUSTOMER_NAME"] . " | " . $row["CUSTOMER_PHYSICAL_ADDRESS"] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

                <div id="custFormFloat" style="width: 27%; font-size: 14px; height: 64px; min-width: 320px; margin-top: 2px; ">
                    Stock (Name/ Description  |  Type  |  Size  |  Colour)
                    <select name="STOCK_ID" id="STOCK_ID" style="width: 100%; font-size: 16px; " required>
                        <option selected disabled hidden value=''></option>
                        <option id='All' value = 'All'>All</option>
                        <?php

                        //need to add
                        //defualt selected
                        //all opton


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

