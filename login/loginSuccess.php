<?php
	include '../include/head.php';
	include '../include/header.php';
?>

			<div id="login">
				<h2 style="color:green;">Login was successful, redirecting you to the home page</h2>
				<a href = "../home/index.php">Continue</a>
			</div>

<?php
header("refresh:1.5; url=../home/index.php");
?>

<?php include '../include/footer.php';?>