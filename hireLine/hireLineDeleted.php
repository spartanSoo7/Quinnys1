<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");
?>
<style>

  HTML{
      color: white;
  }

</style>

<?php
$HIRE_LINE_NUMBER = $_GET['HIRE_LINE_NUMBER'];
echo $HIRE_LINE_NUMBER;


$sql = "SELECT
/*stock table*/
          i.STOCK_ID,
          i.HIRE_COST,
          i.STOCK_OUT,
          i.STOCK_IN,

/*total at customer table*/
          s.CUSTOMER_ID,
          s.STOCK_ID,
          s.TOTAL_QUANTITY_IN,

/*hire line table*/
          n.HIRE_LINE_NUMBER,
          n.HIRE_NUMBER,
          n.HIRE_QUANTITY

FROM
    hire_transaction_table n inner join total_at_customer_table s
    on n.HIRE_NUMBER = s.HIRE_NUMBER

    inner join STOCK_ITEMS_TABLE i
    on s.STOCK_ID = i.STOCK_ID

WHERE HIRE_LINE_NUMBER = '$HIRE_LINE_NUMBER'
";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        //set all the variables required
        $HIRE_NUMBER = $row["HIRE_NUMBER"];
        $CUSTOMER_ID =$row["CUSTOMER_ID"];
        $STOCK_ID = $row["STOCK_ID"];
        $HIRE_COST = $row["HIRE_COST"];
        $TOTAL_QUANTITY_IN = $row["TOTAL_QUANTITY_IN"];
        $STOCK_OUT = $row["STOCK_OUT"];
        $STOCK_IN = $row["STOCK_IN"];
        $origQuantity = $row["HIRE_QUANTITY"];
    }

}
else{
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center'>Something broke</h3>";
    die();
}



//delete hire line table row

// prepare and bind
$stmt = $conn->prepare("
  DELETE FROM hire_transaction_table
  WHERE
  HIRE_LINE_NUMBER = ?
");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $id);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$id = $HIRE_LINE_NUMBER;

$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/header.php';
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "<br>hire transaction table deleted successfully";


/*
 * end of change to delete
 */


//change stock totals at customer

//calc new total at customer            //orginal hire quantity
$newTotalCust = $TOTAL_QUANTITY_IN - $origQuantity;

// prepare and bind
$stmt = $conn->prepare("UPDATE total_at_customer_table SET
    TOTAL_QUANTITY_IN = ?
WHERE HIRE_NUMBER = '$HIRE_NUMBER' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("i", $totalIn);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$totalIn = $newTotalCust;


$stmt->execute();

echo "<br>Total at customer table updated successfully";




//change stock totals
//get total stock in + $origQuantity - $HIRE_QUANTITY
//get total stock out - $origQuantity + $HIRE_QUANTITY

//-5 = 8 - 13   //changed for delete
$quantityDiff = $origQuantity;

$newTotalStockIn = $STOCK_IN  + $quantityDiff;

$newTotalStockOut = $STOCK_OUT - $quantityDiff;

echo "<br><br>
        origional quantity: " .$origQuantity.
    "<br>new quantity" .$HIRE_QUANTITY. "<br><br>

        differnce: " .$quantityDiff. "<br><br>
        --------------------------------------

        <br><br>original stock in at quinnys: " .$STOCK_IN. "<br>original Stock out at quinnys: " . $STOCK_OUT.
    "<br><br>
newTotalStockIn: " .$newTotalStockIn. "<br> newTotalStockOut: " .$newTotalStockOut. "<br>
";


//change stock table

// prepare and bind
$stmt = $conn->prepare("UPDATE stock_items_table SET
    STOCK_OUT = ?,
    STOCK_IN = ?
WHERE STOCK_ID = '$STOCK_ID' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("ii", $out, $in);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$out = $newTotalStockOut;
$in = $newTotalStockIn;

$stmt->execute();

if ( false===$stmt )
{
    //if execute() failed
    include '../include/header.php';
    include '../include/Error.php';
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "<br>stock table updated successfully";


$stmt->close();
$conn->close();
header( 'Location:hireLineView.php' );
?>