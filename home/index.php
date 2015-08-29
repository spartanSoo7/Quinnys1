<?php
    include '../include/head.php';
    include '../include/header.php';
    require("../include/securitycheck.php");
?>

<h2>Hello</br>This is the home page</h2>
<ul>
    <li><a href='../customer/customerView.php'>View/ Add/ Edit/ Delete Customers</a></li>
    <li><a href='../stockType/stockTypeView.php'>View/ Add/ Edit/ Delete stock types</a></li>
    <li><a href='../stockItems/stockItemsView.php'>View/ Add/ Edit/ Delete stock items</a></li>
</ul>
<?php include '../include/footer.php';?>

<!--HTML 5 NUMBER validation isnt allowing decimals-->