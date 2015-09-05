<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
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


$sql = "UPDATE CUSTOMER_TABLE SET
  CUSTOMER_NAME = '$CUSTOMER_NAME',
  CUSTOMER_EMAIL = '$CUSTOMER_EMAIL',
  CUSTOMER_PHONE1 = '$CUSTOMER_PHONE1',
  CUSTOMER_PHONE2 = '$CUSTOMER_PHONE2',
  CUSTOMER_POSTAL_ADDRESS = '$CUSTOMER_POSTAL_ADDRESS',
  CUSTOMER_PHYSICAL_ADDRESS = '$CUSTOMER_PHYSICAL_ADDRESS',
  CUSTOMER_CONTACT_NAME = '$CUSTOMER_CONTACT_NAME'
WHERE CUSTOMER_ID ='$CUSTOMER_ID'";


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully </br>";
    header( 'Location:customerView.php' );
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();
include '../include/footer.php';
?>