<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <div id = "backBtn">
        <a href="stockItemsView.php" > Back </a>
    </div>

    <div id = "centerTitle">
        <h2>Stock Item Details: </h2>
    </div>


<?php
    include 'stockItemsDetails.php';
    include '../include/footer.php';
?>