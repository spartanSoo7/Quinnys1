<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");

$STOCK_ID = $_POST['STOCK_ID'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];

$TOTAL_QUANTITY_IN = 0;
$TOTAL_QUANTITY_NEEDED = $_POST['TOTAL_QUANTITY_NEEDED'];
$HIRE_ACTIVE = 0;

/*
 *
 * CHECK TO SEE IF HOLD LVL ALREADY EXITS
 *
 */
//MYSQLI query
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

 WHERE s.CUSTOMER_ID = '$CUSTOMER_ID' AND s.STOCK_ID = '$STOCK_ID'

ORDER BY CUSTOMER_ACTIVE ASC, ACTIVE ASC, HIRE_ACTIVE ASC, CUSTOMER_NAME ASC, STOCK_TYPE_NAME
";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    include '../include/header.php';
    while ($row = $result->fetch_assoc()) {
        ?>
        <div id = "backBtn">
            <a href="customerStockView.php" style ='padding-bottom: 10px; margin: 5px; display: block;'>Back</a>
        </div>

        <div id = "centerTitle">
            <h1 style="text-align: center">This customer already has a set hold level</h1>
        </div>

        <p style="text-align: center">Please update the already existing record rather than making another one. The combination you choose is:</p>
        <table id = 'viewTable'>
            <tr>
                <td colspan="3" style="border: 0px; "></td>
                <th colspan="2">Stock levels</th>
            </tr>
            <tr>
                <th>Customer</th>
                <th>Stock</th>
                <th>Type</th>
                <th>At Customer</th>
                <th>Current Hold Level</th>
                <th>Update</th>
            </tr>
                <tr>
                <td><?php echo $row["CUSTOMER_NAME"]?></td>
                <td><?php echo $row["STOCK_NAME"]?></td>
                <td><?php echo $row["STOCK_TYPE_NAME"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_IN"]?></td>
                <td><?php echo $row["TOTAL_QUANTITY_NEEDED"]?></td>
                <td>
                    <a href=customerStockUpdate.php?HIRE_NUMBER=<?php echo $row['HIRE_NUMBER']; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                </td>
            </tr>
        </table>
        <?php
        Die();
    }
}
else { //this combination of stock and customer must not exist
    //so the record can be created


// prepare and bind
    $stmt = $conn->prepare("INSERT INTO total_at_customer_table (
  STOCK_ID,
  CUSTOMER_ID,
  TOTAL_QUANTITY_IN,
  TOTAL_QUANTITY_NEEDED,
  HIRE_ACTIVE
)
VALUES (?, ?, ?, ?, ?)");

    if (false === $stmt) {
        //if not a valid/ready statement object
        include '../include/header.php';
        include '../include/Error.php';
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("iiiii", $sockID, $customerID, $totalIn, $totalNeed, $active);

    if (false === $stmt) {
        //if can't bind the parameters.
        include '../include/header.php';
        include '../include/Error.php';
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

// set parameters and execute
    $sockID = $STOCK_ID;
    $customerID = $CUSTOMER_ID;
    $totalIn = $TOTAL_QUANTITY_IN;
    $totalNeed = $TOTAL_QUANTITY_NEEDED;
    $active = $HIRE_ACTIVE;

    $stmt->execute();

    if (false === $stmt) {
        //if execute() failed
        include '../include/header.php';
        include '../include/Error.php';
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }


//save the new hold lvl into the total hold lvl on the stock page

//find the current total stock lvl
//MYSQLI
    $sql = "SELECT STOCK_ID, STOCK_NEEDED FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$STOCK_ID'";
    $result2 = $conn->query($sql);

    if ($result2->num_rows > 0) {
        // output data of each row

        while ($row = $result2->fetch_assoc()) {
            $totalStockHoldLvl = $row["STOCK_NEEDED"];
            $newTotalStockHoldLvl = $totalStockHoldLvl + $TOTAL_QUANTITY_NEEDED;
        }
    }


//update total stock hold level
// prepare and bind
    $stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
    STOCK_NEEDED = ?
WHERE STOCK_ID = '$STOCK_ID' ");

    if (false === $stmt) {
        //if not a valid/ready statement object
        include '../include/header.php';
        include '../include/Error.php';
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("i", $totHoldLvl);

    if (false === $stmt) {
        //if can't bind the parameters.
        include '../include/header.php';
        include '../include/Error.php';
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

// set parameters and execute
    $totHoldLvl = $newTotalStockHoldLvl;

    $stmt->execute();

    if (false === $stmt) {
        //if execute() failed
        include '../include/header.php';
        include '../include/Error.php';
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }


    $stmt->close();
    $conn->close();

header("refresh:0; url=customerStockView.php");
}
?>