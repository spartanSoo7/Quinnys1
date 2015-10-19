<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


$RESTOCK_ID = $_POST['RESTOCK_ID'];
$RESTOCK_QUANTITY = $_POST['RESTOCK_QUANTITY'];


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

//update to restock table

// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_RESTOCK_TABLE SET
  RESTOCK_QUANTITY = ?
WHERE RESTOCK_ID = '$RESTOCK_ID'");


if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $QUANTITY);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$QUANTITY = $RESTOCK_QUANTITY;

$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/header.php';
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}



//////////////////////////////////////////////////////////////////////////

$updatedIn = ($oldSTOCK_IN - $oldRESTOCK_QUANTITY) + $RESTOCK_QUANTITY;
$updatedTotal = ($oldSTOCK_TOTAL - $oldRESTOCK_QUANTITY) + $RESTOCK_QUANTITY;


// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
    STOCK_IN = ?,
    STOCK_TOTAL = ?
WHERE STOCK_ID = '$STOCK_ID' ");

$stmt->bind_param("ii", $in, $total);

// set parameters and execute
$in = $updatedIn;
$total = $updatedTotal;

$stmt->execute();

$stmt->close();
$conn->close();
header("refresh:0; url=stockRestockView.php");

?>