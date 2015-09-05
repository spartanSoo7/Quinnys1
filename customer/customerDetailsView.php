<?php
    include '../include/head.php';
    require("../include/securitycheck.php");
    include '../include/header.php';
    include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="customerView.php" > Back </a>
</div>

<div id = "centerTitle">
    <h2>Customer Details:</h2>
</div>


<?php
    include 'customerDetails.php';
    include '../include/footer.php';
?>