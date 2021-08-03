<?php include('login.php')?>
<?php 
	session_destroy();
	unset($_SESSION['username']);
	header("location:base.php");
?>