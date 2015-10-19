<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");

$STOCK_ID = $_POST['STOCK_ID'];
$STOCK_NAME = $conn->real_escape_string($_POST['STOCK_NAME']);
$STOCK_TYPE_ID  = $_POST['STOCK_TYPE_ID'];
$HIRE_COST  = $_POST['HIRE_COST'];
$REPLACE_COST  = $_POST['REPLACE_COST'];
$SIZE = $conn->real_escape_string($_POST['SIZE']);
$COLOUR1 = $conn->real_escape_string($_POST['COLOUR1']);
$COLOUR2 = $conn->real_escape_string($_POST['COLOUR2']);
$COLOUR3 = $conn->real_escape_string($_POST['COLOUR3']);


// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_ITEMS_TABLE SET
      STOCK_TYPE_ID = ?,
      STOCK_NAME = ?,
      HIRE_COST = ?,
      REPLACE_COST = ?,
      SIZE = ?,
      COLOUR1 = ?,
      COLOUR2 = ?,
      COLOUR3 = ?
WHERE STOCK_ID = '$STOCK_ID'");

if ( false===$stmt )
{
      //if not a valid/ready statement object
      include '../include/header.php';
      include '../include/Error.php';
      die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("isddssss",$type,  $name, $hire, $replace, $stock_size, $col1, $col2, $col3);

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
