 <?php 
 	// Connects to Our Database 
 	/*mysql_connect("127.0.0.1", "test", "password") or die(mysql_error());
 	mysql_select_db("quinn") or die(mysql_error());*/
 $servername = "127.0.0.1";
 $username = "test";
 $password = "password";
 $dbname = "quinn";

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
     include '../include/Error.php';
     die("Connection failed: " . $conn->connect_error);
 }



 ?> 
