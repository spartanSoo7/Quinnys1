<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");

//MYSQLI
$STOCK_TYPE_ID = $_POST['STOCK_TYPE_ID'];
$STOCK_TYPE_NAME = $conn->real_escape_string($_POST['STOCK_TYPE_NAME']);

// prepare and bind
$stmt = $conn->prepare("UPDATE STOCK_TYPE_TABLE SET
    STOCK_TYPE_NAME = ?
WHERE STOCK_TYPE_ID = '$STOCK_TYPE_ID' ");

if ( false===$stmt )
{
    //if not a valid/ready statement object
    include '../include/header.php';
    include '../include/Error.php';
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("s", $name);

if ( false===$stmt )
{
    //if can't bind the parameters.
    include '../include/header.php';
    include '../include/Error.php';
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$name = $STOCK_TYPE_NAME;

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
header("refresh:0; url=stockTypeView.php");
?>