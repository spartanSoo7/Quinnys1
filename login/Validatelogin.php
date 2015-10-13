<?php
include '../include/head.php';
include '../include/header.php';
include_once("../include/databaselogin.php");

/**
**Page was built by Kane Wardle
**/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password)
{

	$sql = "SELECT * FROM `login_table`";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		// output data of each row
		while ($row = $result->fetch_assoc() )
		{
			 $dbusername = $row["LOGIN_NAME"];
			 $dbpassword = $row["LOGIN_PASSWORD"];

			if ($username==$dbusername&&$password==$dbpassword)
			{
				header ("Location: loginSuccess.php");
				$_SESSION["username"] = $dbusername;
				$_SESSION['logininfo'] = "1";
			}
			else
			{
				header ("Location: ../login/login.php");
			}
		}

	}
}
else
{
	header ("Location: ../login/adminlogin.php");
}
$conn->close();
include '../include/footer.php';
?>