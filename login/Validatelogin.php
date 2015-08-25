<?php
include '../include/head.php';
include '../include/header.php';
include_once("../include/databaselogin.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password)
{
	$query = mysql_query("SELECT * FROM login_table");
	
	$numrow = mysql_num_rows($query);
	
	if ($numrow != 0)
		{
		while ($row = mysql_fetch_assoc($query))
			{
			 $dbusername = $row['LOGIN_NAME'];
			 $dbpassword = $row['LOGIN_PASSWORD'];
			}
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
		else echo "That user doesn't exist!";
	}
else
{
	header ("Location: ../login/adminlogin.php");
}

include '../include/footer.php';
?>