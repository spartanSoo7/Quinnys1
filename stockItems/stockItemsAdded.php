<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


$STOCK_NAME = $conn->real_escape_string($_POST['STOCK_NAME']);
$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$HIRE_COST = $conn->real_escape_string($_POST['HIRE_COST']);
$REPLACE_COST = $conn->real_escape_string($_POST['REPLACE_COST']);
$SIZE = $conn->real_escape_string($_POST['SIZE']);
$COLOUR1 = $conn->real_escape_string($_POST['COLOUR1']);
$COLOUR2 = $conn->real_escape_string($_POST['COLOUR2']);
$COLOUR3 = $conn->real_escape_string($_POST['COLOUR3']);
$STOCK_TOTAL =  $_POST['STOCK_TOTAL'];
$STOCK_OUT = 0;
$STOCK_NEEDED = 0;
$STOCK_IN = $STOCK_TOTAL;


// prepare and bind
$stmt = $conn->prepare("INSERT INTO STOCK_ITEMS_TABLE (
  STOCK_NAME,
  STOCK_TYPE_ID,
  HIRE_COST,
  REPLACE_COST,
  SIZE,
  COLOUR1,
  COLOUR2,
  COLOUR3,
  STOCK_TOTAL,
  STOCK_OUT,
  STOCK_NEEDED,
  STOCK_IN
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("siddssssiiii", $name, $type, $hire, $replace, $stock_size, $col1, $col2, $col3, $tot, $out, $need, $in);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$name = $STOCK_NAME;
$type = $STOCK_TYPE_ID;
$hire = $HIRE_COST;
$replace = $REPLACE_COST;
$stock_size = $SIZE;
$col1 = $COLOUR1;
$col2 = $COLOUR2;
$col3 = $COLOUR3;
$tot = $STOCK_TOTAL;
$out = $STOCK_OUT;
$need = $STOCK_NEEDED;
$in = $STOCK_IN;

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

header("refresh:0; url=stockItemsView.php");

?>