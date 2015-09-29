<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");

$CUSTOMER_NAME = $conn->real_escape_string($_POST['CUSTOMER_NAME']);
$CUSTOMER_EMAIL = $conn->real_escape_string($_POST['CUSTOMER_EMAIL']);
$CUSTOMER_PHONE1 = $conn->real_escape_string($_POST['CUSTOMER_PHONE1']);
$CUSTOMER_PHONE2 = $conn->real_escape_string($_POST['CUSTOMER_PHONE2']);
$CUSTOMER_POSTAL_ADDRESS = $conn->real_escape_string($_POST['CUSTOMER_POSTAL_ADDRESS']);
$CUSTOMER_PHYSICAL_ADDRESS = $conn->real_escape_string($_POST['CUSTOMER_PHYSICAL_ADDRESS']);
$CUSTOMER_CONTACT_NAME = $conn->real_escape_string($_POST['CUSTOMER_CONTACT_NAME']);

/*if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
    header( 'Location:customerView.php' );
} else {
	echo "Error: " . $conn->error;
}*/

// prepare and bind
$stmt = $conn->prepare("INSERT INTO CUSTOMER_TABLE (
  CUSTOMER_NAME,
  CUSTOMER_EMAIL,
  CUSTOMER_PHONE1,
  CUSTOMER_PHONE2,
  CUSTOMER_POSTAL_ADDRESS,
  CUSTOMER_PHYSICAL_ADDRESS,
  CUSTOMER_CONTACT_NAME
)
VALUES (?, ?, ?, ?, ?, ?, ?)");

if ( false===$stmt )
{
  //if not a valid/ready statement object
  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("sssssss", $name, $email, $phone1, $phone2, $post_add, $phys_add, $con_name);

if ( false===$rc )
{
    //if can't bind the parameters.
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// set parameters and execute
$name = $CUSTOMER_NAME;
$email = $CUSTOMER_EMAIL;
$phone1 = $CUSTOMER_PHONE1;
$phone2 = $CUSTOMER_PHONE2;
$post_add = $CUSTOMER_POSTAL_ADDRESS;
$phys_add = $CUSTOMER_PHYSICAL_ADDRESS;
$con_name = $CUSTOMER_CONTACT_NAME;

$stmt->execute();

if ( false===$rc )
{
    //if execute() failed
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

echo "<h1 style='text-align: center'>Customer added successfully </h1> </br>";

include '../include/footer.php';

$stmt->close();
$conn->close();

header("refresh:3; url=customerView.php");
?>