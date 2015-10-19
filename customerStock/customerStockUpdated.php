<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


$HIRE_NUMBER = $_POST['HIRE_NUMBER'];
$TOTAL_QUANTITY_NEEDED = $_POST['TOTAL_QUANTITY_NEEDED'];


//find old customer hold lvl
//MYSQLI
$sql= "SELECT HIRE_NUMBER, TOTAL_QUANTITY_NEEDED, STOCK_ID FROM total_at_customer_table WHERE HIRE_NUMBER = '$HIRE_NUMBER'";
$result1 = $conn->query($sql);

if ($result1->num_rows > 0) {
    // output data of each row

    while ($row = $result1->fetch_assoc()) {
        $origHoldLvl = $row["TOTAL_QUANTITY_NEEDED"];
        $STOCK_ID = $row["STOCK_ID"];
    }
}
else{
    include '../include/header.php';
    include '../include/Error.php';
    echo "Error finding origional record";
    Die();
}


// prepare and bind
$stmt = $conn->prepare("UPDATE total_at_customer_table SET
    TOTAL_QUANTITY_NEEDED = ?
WHERE HIRE_NUMBER = '$HIRE_NUMBER' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totalNeed);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/Error.php';
    include '../include/header.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totalNeed = $TOTAL_QUANTITY_NEEDED;


$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/header.php';
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}



//save the updated hold lvl into the total hold lvl on the stock page

//find the current total stock lvl
//MYSQLI
$sql = "SELECT STOCK_ID, STOCK_NEEDED FROM STOCK_ITEMS_TABLE WHERE STOCK_ID = '$STOCK_ID'";
$result2 = $conn->query($sql);

if ($result2->num_rows > 0) {
    // output data of each row

    while ($row = $result2->fetch_assoc()) {
        $totalStockHoldLvl = $row["STOCK_NEEDED"];

        //totalHoldLvl - original + new
        $newTotalStockHoldLvl = ($totalStockHoldLvl - $origHoldLvl) + $TOTAL_QUANTITY_NEEDED;
    }
}



//update total stock hold level
// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
    STOCK_NEEDED = ?
WHERE STOCK_ID = '$STOCK_ID' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totHoldLvl);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totHoldLvl = $newTotalStockHoldLvl;

$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/header.php';
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

$stmt->close();
$conn->close();

header("refresh:0; url=customerStockView.php");
?>