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
    <h2>New Hire Line: </h2>
</div>


<table class = "updateTable2">
    <form id="FormName" action="hireLineAdded.php" method="post" name="FormName">
        <tr>
            <th></th>
            <td>Name  |  Physical Address</td>
        </tr>
        <tr>
            <th>
                <label for="CUSTOMER_ID">Customer Name: </label>
            </th>
            <td>
                <select name="CUSTOMER_ID" id="CUSTOMER_ID" style="width: 100%;" required>
                    <option selected disabled hidden value=''></option>
                    <?php
                    $sql = "SELECT `CUSTOMER_ID`, `CUSTOMER_NAME`, `CUSTOMER_ACTIVE`, `CUSTOMER_PHYSICAL_ADDRESS` FROM `customer_table`";
                    $result2 = $conn->query($sql);


                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row = $result2->fetch_assoc())
                        {
                            $activeCustomer = $row["CUSTOMER_ACTIVE"];
                            if ($activeCustomer == 0)
                            {
                                echo "<option id='" .$row["CUSTOMER_ID"]. "' value = '" .$row["CUSTOMER_ID"]. "'>" .$row["CUSTOMER_NAME"]. " | " .$row["CUSTOMER_PHYSICAL_ADDRESS"]. "</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th></th>
            <td style="text-align: left; padding-top: 20px; ">Name/ Description  |  Type  |  Size  |  Colour</td>
        </tr>
        <tr>
            <th>
                <label for="STOCK_ID">Stock: </label>
            </th>
            <td>
                <select name="STOCK_ID" id="STOCK_ID" style="width: 100%; " required>
                    <option selected disabled hidden value=''></option>
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
            </td>
        </tr>

        <tr>
            <th>
                <label for="HIRE_QUANTITY">Quantity Being Hired: </label>
            </th>
            <td>
                <!--partial update from stock select to set max stock limit would be nice-->
                <input id="HIRE_QUANTITY" name="HIRE_QUANTITY" style="width: 100%;" type="number" value="" maxlength="9" minlength="1" required/>
            </td>
        </tr>

        <tr style="border-bottom: 0px; ">
            <td colspan="2" style="text-align: center">
                <input type="submit" name="submitButtonName" id="input" value="Add Hire Line"/>
            </td>
        </tr>
    </table>
</form>
<?php include '../include/footer.php';?>
