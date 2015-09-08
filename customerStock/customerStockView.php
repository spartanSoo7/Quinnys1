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

ORDER BY CUSTOMER_NAME ASC
";?>

<table id = 'viewTable'>
    <tr>
            <th>Customer</th>
            <th>Stock</th>
            <th>Type</th>
            <th>Stock at customer</th>
            <th>Hold level</th>
            <th>Details</th>
            <th>Active?</th>                <!--alt to delete keeps in table, but maintains data integrity-->
            <th>Update</th>
      </tr>

<?php
$result = $conn->query($sql);
$icount = 0;
$nonActive = 0;
$isActive = 0;
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $active = $row["ACTIVE"];
        $CUSTOMER_ACTIVE = $row["CUSTOMER_ACTIVE"];
        $id = $row["HIRE_NUMBER"];

        if( ($active == 0 || $CUSTOMER_ACTIVE == 0) || ($active == 0 && $CUSTOMER_ACTIVE == 0) )
        {?>
            <tr>
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_IN"]?></td>     <!--add colour notifications-->
                <td><?php echo $row["TOTAL_QUANTITY_NEEDED"]?></td>
                <td></td>
                <td>do i want one?</td>
                <td></td>
            </tr>
        <?php
        $isActive++;
        }
        else
        {
?>
            <tr style="background-color: #FF6666; ">
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_IN"]?></td>     <!--add colour notifications-->
                <td><?php echo $row["TOTAL_QUANTITY_NEEDED"]?></td>
                <td></td>
                <td>do i want one?</td>
                <td></td>
            </tr>
<?php
            $nonActive++;
        }

        $icount++;
    }
}
echo "<tr><td colspan='8' align='center'><a href='stockItemsAdd.php'> Add a new stock Item</a></td></tr>";
echo "<tr><td colspan='9' align='center'> You have ".$icount." Total stock item(s) in customer stock levels</td> </tr>";
echo "<tr><td colspan='9' align='center'> You have ".$isActive." Active stock item(s) in customer stock levels</td> </tr>";
echo "<tr><td colspan='9' align='center'> You have ".$nonActive." Inactive stock item(s) in customer stock levels</td> </tr>";

echo "</table>";
