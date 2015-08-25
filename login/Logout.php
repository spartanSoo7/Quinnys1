<?php
//Access only via login
require("../include/securitycheck.php");
include '../include/head.php';
include '../include/header.php';
?>
		<main style = "width: 90%">	
		<body>
<?php
//session_start();

session_destroy();
echo "<br />
<h2 style='color:green;'>Logout successful</h2> <br /><a href='../home/index.php'>Click here</a> go go back to the home page";
header("Location: ../home/index.php");
die();
?>
<?php
include '../include/footer.php';
?>