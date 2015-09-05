<?php
include_once("../include/databaselogin.php");
require("../include/securitycheck.php");


$CUSTOMER_NAME = $conn->real_escape_string($_POST['CUSTOMER_NAME']);
$CUSTOMER_EMAIL = $conn->real_escape_string($_POST['CUSTOMER_EMAIL']);
$CUSTOMER_PHONE1 = $conn->real_escape_string($_POST['CUSTOMER_PHONE1']);
$CUSTOMER_PHONE2 = $conn->real_escape_string($_POST['CUSTOMER_PHONE2']);
$CUSTOMER_POSTAL_ADDRESS = $conn->real_escape_string($_POST['CUSTOMER_POSTAL_ADDRESS']);
$CUSTOMER_PHYSICAL_ADDRESS = $conn->real_escape_string($_POST['CUSTOMER_PHYSICAL_ADDRESS']);
$CUSTOMER_CONTACT_NAME = $conn->real_escape_string($_POST['CUSTOMER_CONTACT_NAME']);


$sql = "INSERT INTO CUSTOMER_TABLE (CUSTOMER_NAME, CUSTOMER_EMAIL, CUSTOMER_PHONE1, CUSTOMER_PHONE2, CUSTOMER_POSTAL_ADDRESS, CUSTOMER_PHYSICAL_ADDRESS, CUSTOMER_CONTACT_NAME)
VALUES (
  '$CUSTOMER_NAME',
  '$CUSTOMER_EMAIL',
  '$CUSTOMER_PHONE1',
  '$CUSTOMER_PHONE2',
  '$CUSTOMER_POSTAL_ADDRESS',
  '$CUSTOMER_PHYSICAL_ADDRESS',
  '$CUSTOMER_CONTACT_NAME'

)";


if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
    header( 'Location:customerView.php' );
} else {
	echo "Error: " . $conn->error;
}

$conn->close();
?>