<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="../home/index.php" style ='padding-bottom: 10px; margin: 5px; display: block;'> Back </a>
</div>

<div id = "centerTitle">
    <h2>Hire lines: </h2>
</div>

<?php
//MYSQLI
$sql = "SELECT
          i.STOCK_ID,
          i.STOCK_TYPE_ID,
          i.STOCK_NAME,
          i.HIRE_COST,
          i.ACTIVE,

          t.STOCK_TYPE_ID,
          t.STOCK_TYPE_NAME,

          s.HIRE_NUMBER,
          s.CUSTOMER_ID,
          s.STOCK_ID,
          s.HIRE_ACTIVE,

          c.CUSTOMER_ID,
          c.CUSTOMER_NAME,
          c.CUSTOMER_ACTIVE,

          n.HIRE_LINE_NUMBER,
          n.HIRE_NUMBER,
          n.HIRE_QUANTITY,
          n.HIRE_LINE_COST_TOTAL,
          n.HIRE_DATE

FROM
    hire_transaction_table n inner join total_at_customer_table s
    on n.HIRE_NUMBER = s.HIRE_NUMBER

    inner join STOCK_ITEMS_TABLE i
    on s.STOCK_ID = i.STOCK_ID

    inner join customer_table c
      on s.CUSTOMER_ID = c.CUSTOMER_ID

   inner join STOCK_TYPE_TABLE t
    on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID

ORDER BY HIRE_DATE ASC, CUSTOMER_NAME ASC, STOCK_NAME ASC
";?>

<table id = 'viewTable'>
    <tr>
        <td colspan="3" style="border: 0px; "></td>
        <th colspan="3">Cost</th>
    </tr>
    <tr>
            <th>Customer</th>
            <th>Stock</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Cost per item</th>
            <th>Total Cost</th>
            <th>Date</th>
            <th>Details</th>
            <th>Update</th>
      </tr>

<?php
$result = $conn->query($sql);
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
                <td><?php echo $row["HIRE_QUANTITY"]?></td>
                <td><?php echo "$" .$row["HIRE_COST"]?></td>
                <td><?php echo "$" .$row["HIRE_LINE_COST_TOTAL"] ?></td>
                <td><?php echo $row["HIRE_DATE"] ?></td>

                <td><a href=hireLineDetailsView.php?HIRE_LINE_NUMBER=<?php echo $row["HIRE_LINE_NUMBER"]; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Details </a></td>
                <td>
                    <a href=hireLineUpdate.php?HIRE_LINE_NUMBER=<?php echo $row["HIRE_LINE_NUMBER"]; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Update Quantity</a>
                </td>
            </tr>
        <?php
        $icount++;
    }
}
echo "<tr><td colspan='9' align='center'><a href='hireLineAdd.php'>Add a new hire line</a></td></tr>";


echo "<tr><td colspan='9' align='center'> You have ".$icount." Total lines of hired stock</td> </tr>";


echo "</table>";
