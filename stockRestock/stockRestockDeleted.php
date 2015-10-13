<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");


$RESTOCK_ID = $_GET['RESTOCK_ID'];


//get old values to be updated
$sql = "SELECT
          i.STOCK_ID,
          i.STOCK_TOTAL,
          i.STOCK_IN,

          r.RESTOCK_ID,
          r.RESTOCK_QUANTITY,
          r.STOCK_ID

FROM
    stock_restock_table r inner join STOCK_ITEMS_TABLE i
    on r.STOCK_ID = i.STOCK_ID

WHERE RESTOCK_ID = '$RESTOCK_ID'
";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        $STOCK_ID = $row["STOCK_ID"];
        $oldSTOCK_TOTAL = $row["STOCK_TOTAL"];
        $oldSTOCK_IN = $row["STOCK_IN"];
        $oldRESTOCK_QUANTITY = $row["RESTOCK_QUANTITY"];
    }
}
//echo "<br>new restock quantity: " .$RESTOCK_QUANTITY;

//delete to restock table

//delete hire line table row

// prepare and bind
$stmt = $conn->prepare("
  DELETE FROM STOCK_RESTOCK_TABLE
  WHERE
  RESTOCK_ID = ?
");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/Error.php';
    echo "SQL statment";
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $id);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$id = $RESTOCK_ID;

$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "<br>Restock record has been deleted successfully";






$updatedIn = $oldSTOCK_IN - $oldRESTOCK_QUANTITY;
$updatedTotal = $oldSTOCK_TOTAL - $oldRESTOCK_QUANTITY;

/*echo "<br><br>updated total in = " .$updatedIn;
echo "<br>updated total = " .$updatedTotal;*/

// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
    STOCK_IN = ?,
    STOCK_TOTAL = ?
WHERE STOCK_ID = '$STOCK_ID' ");

$stmt->bind_param("ii", $in, $total);

// set parameters and execute
// set parameters and execute
$in = $updatedIn;
$total = $updatedTotal;

$stmt->execute();

echo "<h1 style='text-align: center'>total stock records have updated successfully</h1></br>";

$stmt->close();
$conn->close();
header("refresh:3; url=stockRestockView.php");

include '../include/footer.php';
?>