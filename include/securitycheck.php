<?php
if (session_status() == PHP_SESSION_NONE) {
     session_start();
}
if (!isset($_SESSION['logininfo'])) {
     header("Location:../login/adminlogin.php");
     die();     // End everything
}
?>
