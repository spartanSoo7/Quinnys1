<!--
--Page was built by Kane Wardle
-->
<?php
$RETURN_ID = $_GET['RETURN_ID'];

//MYSQLI
$sql = "SELECT
          i.*,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          s.*,

          c.*,

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

WHERE RETURN_ID = '$RETURN_ID'
";


$result = $conn->query($sql);
echo "<table class = 'detailsTable'>";

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $active = $row["ACTIVE"];
        $CUSTOMER_ACTIVE = $row["CUSTOMER_ACTIVE"];
        //$HIRE_NUMBER = $row["HIRE_NUMBER"];
        $HIRE_ACTIVE = $row["HIRE_ACTIVE"];
        $RETURN_ID = $row["RETURN_ID"];
        //$CUSTOMER_ID =$row["CUSTOMER_ID"];
        //$STOCK_ID = $row["STOCK_ID"];
        $TOTAL_QUANTITY_IN = $row["TOTAL_QUANTITY_IN"];
        //$STOCK_OUT = $row["STOCK_OUT"];
        $STOCK_IN = $row["STOCK_IN"];
        $origQuantity = $row["RETURNED_QUANTITY"];
        $totalAtCustomer = $row["TOTAL_QUANTITY_IN"] + $origQuantity;




        ?>
        <tr>
            <th colspan="2">Customer</th>
        </tr>
        <tr>
            <th>
                Name /Description:
            </th>
            <td>
                <?php echo $row["CUSTOMER_NAME"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Physical Address:
            </th>
            <td>
                <?php echo $row["CUSTOMER_PHYSICAL_ADDRESS"] ?>
            </td>
        </tr>
        <tr style="border: 0px; ">

        </tr>
        <tr>
            <th colspan="2">Stock</th>
        </tr>
        <tr>
            <th>
                Stock Name:
            </th>
            <td>
                <?php echo $row["STOCK_NAME"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Stock Type:
            </th>
            <td>
                <?php echo $row["STOCK_TYPE_NAME"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Size:
            </th>
            <td>
                <?php echo $row["SIZE"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Primary Colour:
            </th>
            <td>
                <?php echo $row["COLOUR1"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Secondary Colour:
            </th>
            <td>
                <?php echo $row["COLOUR2"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Tertiary Colour:
            </th>
            <td>
                <?php echo $row["COLOUR3"] ?>
            </td>
        </tr>
        <tr style="border: 0px; ">

        </tr>
        <tr>
            <th colspan="2">Stock Levels</th>
        </tr>
        <?php
        $stockNeeded = $row["TOTAL_QUANTITY_NEEDED"] - $row["TOTAL_QUANTITY_IN"];
        ?>
        <tr>
            <th>
                Stock at Customer:
            </th>
            <td>
                <?php echo $TOTAL_QUANTITY_IN ?>
            </td>
        </tr>
        <tr
            <?php
            if ($stockNeeded > 0) {
                echo " style = 'background-color: #FF6666;'";
            }
            else{
                echo " style = 'background-color: #59E059;'";
            }
            ?>
            >
            <th>
                Stock Needed at Customer:
            </th>
            <td>
                <?php echo $stockNeeded ?>
            </td>
        </tr>
        <tr>
            <th>
                Current Stock Hold Level:
            </th>
            <td>
                <?php echo $row["TOTAL_QUANTITY_NEEDED"] ?>
            </td>
        </tr>

        <tr style="border: 0px; ">

        </tr>
        <tr>
            <th colspan="2">Returned Stock Line</th>
        </tr>

        <tr>
            <th>
                Current Returned Quantity
            </th>
            <td>
                <?php echo $row["RETURNED_QUANTITY"] ?>
            </td>
        </tr>
        <tr>
            <th>Returned timestamp</th>
            <td>
                <?php echo $row["RETURNED_DATE"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Total stock out
            </th>
            <td><?php echo $row["STOCK_OUT"];?> </td>
        </tr>
        <?php

    }
}
?>