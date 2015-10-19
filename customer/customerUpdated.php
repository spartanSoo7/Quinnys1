<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include_once("../include/databaselogin.php");


//MYSQLI
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$CUSTOMER_NAME = $conn->real_escape_string($_POST['CUSTOMER_NAME']);
$CUSTOMER_EMAIL = $conn->real_escape_string($_POST['CUSTOMER_EMAIL']);
$CUSTOMER_PHONE1 = $conn->real_escape_string($_POST['CUSTOMER_PHONE1']);
$CUSTOMER_PHONE2 = $conn->real_escape_string($_POST['CUSTOMER_PHONE2']);
$CUSTOMER_POSTAL_ADDRESS = $conn->real_escape_string($_POST['CUSTOMER_POSTAL_ADDRESS']);
$CUSTOMER_PHYSICAL_ADDRESS = $conn->real_escape_string($_POST['CUSTOMER_PHYSICAL_ADDRESS']);
$CUSTOMER_CONTACT_NAME = $conn->real_escape_string($_POST['CUSTOMER_CONTACT_NAME']);


// prepare and bind
$stmt = $conn->prepare("UPDATE CUSTOMER_TABLE SET
  CUSTOMER_NAME = ?,
  CUSTOMER_EMAIL = ?,
  CUSTOMER_PHONE1 = ?,
  CUSTOMER_PHONE2 = ?,
  CUSTOMER_POSTAL_ADDRESS = ?,
  CUSTOMER_PHYSICAL_ADDRESS = ?,
  CUSTOMER_CONTACT_NAME = ?
WHERE CUSTOMER_ID ='$CUSTOMER_ID'");

if ( false===$stmt )
{
  //if not a valid/ready statement object
  include '../include/header.php';
  include '../include/Error.php';
  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("sssssss", $name, $email, $phone1, $phone2, $post_add, $phys_add, $con_name);


// set parameters and execute
$name = $CUSTOMER_NAME;
$email = $CUSTOMER_EMAIL;
$phone1 = $CUSTOMER_PHONE1;
$phone2 = $CUSTOMER_PHONE2;
$post_add = $CUSTOMER_POSTAL_ADDRESS;
$phys_add = $CUSTOMER_PHYSICAL_ADDRESS;
$con_name = $CUSTOMER_CONTACT_NAME;

$stmt->execute();

if ( false===$stmt )
{
  //if execute() failed
  include '../include/header.php';
  include '../include/Error.php';
  die('execute() failed: ' . htmlspecialchars($stmt->error));
}

include '../include/footer.php';

$stmt->close();
$conn->close();

header("refresh:0; url=customerView.php");
?>