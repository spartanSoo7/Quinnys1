<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");
?>

<div id = "centerTitle">
    <h2>Customer Stock Levels: </h2>
</div>

<?php
//MYSQLI
$sql = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,
          i.ACTIVE,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          s.HIRE_NUMBER,
          s.CUSTOMER_ID,
          s.STOCK_ID,
          s.TOTAL_QUANTITY_IN,
          s.TOTAL_QUANTITY_NEEDED,
          s.HIRE_ACTIVE,

          c.CUSTOMER_ID,
          c.CUSTOMER_NAME,
          c.CUSTOMER_ACTIVE

FROM
  total_at_customer_table s inner join STOCK_ITEMS_TABLE i
    on s.STOCK_ID = i.STOCK_ID

    inner join customer_table c
      on s.CUSTOMER_ID = c.CUSTOMER_ID

   inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

ORDER BY CUSTOMER_NAME ASC, STOCK_NAME ASC
";?>

<table id = 'viewTable'>
    <tr>
        <td colspan="3" style="border: 0px; "></td>
        <th colspan="3">Stock levels</th>
    </tr>
    <tr>
            <th>Customer</th>
            <th>Stock</th>
            <th>Type</th>
            <th>At Customer</th>
            <th>Hold</th>
            <th>Needed</th>
      </tr>

<?php
$result = $conn->query($sql);

$neededCust = 0;

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $active = $row["ACTIVE"];
        $CUSTOMER_ACTIVE = $row["CUSTOMER_ACTIVE"];
        $HIRE_NUMBER = $row["HIRE_NUMBER"];
        $stockNeeded = $row["TOTAL_QUANTITY_NEEDED"] - $row["TOTAL_QUANTITY_IN"];
        $HIRE_ACTIVE = $row["HIRE_ACTIVE"];

        if( $active == 0 && $CUSTOMER_ACTIVE == 0 && $HIRE_ACTIVE == 0){
        ?>
            <tr>
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_IN"]?></td>     <!--add colour notifications-->
                <td><?php echo $row["TOTAL_QUANTITY_NEEDED"]?></td>
                <td
                <?php
                    if ($stockNeeded > 0)
                    {
                        echo " style = 'background-color: #DCDCDC; '";
                    }
                ?>


                ><?php echo $stockNeeded; ?></td>
            </tr>
        <?php
        }
?>
<?php

    }
}


echo "</table>";
