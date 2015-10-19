<?php
	include '../include/head.php';
?>
	<!--
    --Page was built by Kane Wardle
    -->

			<div id="login">
				<!--<h2 style="color:green;">Login was successful, redirecting you to the home page</h2>-->

				<a href = "../home/index.php">Click here if not redirected Continue</a>
			</div>

<?php
header("refresh:0; url=../home/index.php");
?>

<?php include '../include/footer.php';?>